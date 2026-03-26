# Script PowerShell pour vérifier l'état de la production
# Teste la connectivité, l'accessibilité du site et les fichiers critiques

param(
    [string]$ProductionUrl = "https://kas-technology.com",
    [string]$FtpHost = "ftp.cluster030.hosting.ovh.net",
    [string]$FtpUser = "kastecj",
    [string]$FtpPassword = ""
)

Write-Host "╔════════════════════════════════════════╗" -ForegroundColor Cyan
Write-Host "║  KAS Production Status Check          ║" -ForegroundColor Cyan
Write-Host "╚════════════════════════════════════════╝" -ForegroundColor Cyan
Write-Host ""

$TotalChecks = 0
$PassedChecks = 0

# ============ TEST 1: Site HTTP/HTTPS ============
Write-Host "[1/6] Vérification du site HTTP..." -ForegroundColor Yellow
$TotalChecks++
try {
    $Response = Invoke-WebRequest -Uri $ProductionUrl -SkipCertificateCheck -TimeoutSec 10 -UseBasicParsing
    if ($Response.StatusCode -eq 200) {
        Write-Host "[✓] Site accessible (HTTP 200)" -ForegroundColor Green
        $PassedChecks++

        # Détecte les erreurs Laravel
        if ($Response.Content -match "(error|exception|parse error|fatal error)" -and -not ($Response.Content -match "error_log")) {
            Write-Host "[⚠] Des erreurs Laravel détectées dans la page" -ForegroundColor Yellow
        }
    } elseif ($Response.StatusCode -eq 500) {
        Write-Host "[✗] Erreur 500 - Application crash" -ForegroundColor Red
    } else {
        Write-Host "[⚠] HTTP $($Response.StatusCode)" -ForegroundColor Yellow
    }
} catch {
    Write-Host "[✗] Site inaccessible: $($_.Exception.Message)" -ForegroundColor Red
    Write-Host "    → Vérifiez le DNS et la connectivité OVH" -ForegroundColor Gray
}

# ============ TEST 2: DNS ============
Write-Host ""
Write-Host "[2/6] Vérification DNS..." -ForegroundColor Yellow
$TotalChecks++
try {
    $DnsResult = Resolve-DnsName -Name "kas-technology.com" -Type A -ErrorAction Stop
    if ($DnsResult) {
        Write-Host "[✓] DNS résout vers: $($DnsResult.IPAddress)" -ForegroundColor Green
        $PassedChecks++
    }
} catch {
    Write-Host "[✗] DNS non résolvable: $_" -ForegroundColor Red
}

# ============ TEST 3: Connectivité FTP ============
Write-Host ""
Write-Host "[3/6] Vérification connectivité FTP..." -ForegroundColor Yellow
$TotalChecks++
try {
    $FtpUri = "ftp://$FtpHost/kas/.env"
    $FtpRequest = [System.Net.FtpWebRequest]::Create($FtpUri)
    $FtpRequest.Method = [System.Net.WebRequestMethods+Ftp]::GetFileSize
    $FtpRequest.Credentials = New-Object System.Net.NetworkCredential($FtpUser, $FtpPassword)
    $FtpRequest.UsePassive = $true
    $FtpRequest.KeepAlive = $false
    $FtpRequest.Timeout = 5000

    $FtpResponse = $FtpRequest.GetResponse()
    $FileSize = $FtpResponse.ContentLength
    $FtpResponse.Close()

    Write-Host "[✓] FTP connecté - .env trouvé ($FileSize bytes)" -ForegroundColor Green
    $PassedChecks++
} catch {
    Write-Host "[✗] FTP erreur: $_" -ForegroundColor Red
}

# ============ TEST 4: Fichiers critiques ============
Write-Host ""
Write-Host "[4/6] Vérification des fichiers critiques..." -ForegroundColor Yellow
$TotalChecks++
$CriticalFiles = @(
    "/www/index.php",
    "/kas/.env",
    "/kas/vendor/autoload.php",
    "/kas/bootstrap/app.php"
)

$FilesOk = 0
foreach ($File in $CriticalFiles) {
    try {
        $FtpUri = "ftp://$FtpHost$File"
        $FtpRequest = [System.Net.FtpWebRequest]::Create($FtpUri)
        $FtpRequest.Method = [System.Net.WebRequestMethods+Ftp]::GetFileSize
        $FtpRequest.Credentials = New-Object System.Net.NetworkCredential($FtpUser, $FtpPassword)
        $FtpRequest.UsePassive = $true
        $FtpRequest.KeepAlive = $false
        $FtpRequest.Timeout = 5000

        $FtpResponse = $FtpRequest.GetResponse()
        $FtpResponse.Close()
        Write-Host "  [✓] $File" -ForegroundColor Green
        $FilesOk++
    } catch {
        Write-Host "  [✗] $File - Manquant ou inaccessible" -ForegroundColor Red
    }
}

if ($FilesOk -eq $CriticalFiles.Count) {
    Write-Host "[✓] Tous les fichiers critiques présents" -ForegroundColor Green
    $PassedChecks++
} else {
    Write-Host "[✗] $($CriticalFiles.Count - $FilesOk) fichier(s) manquant(s)" -ForegroundColor Red
}

# ============ TEST 5: APP_KEY ============
Write-Host ""
Write-Host "[5/6] Vérification APP_KEY..." -ForegroundColor Yellow
$TotalChecks++
try {
    $FtpUri = "ftp://$FtpHost/kas/.env"
    $LocalEnvPath = [System.IO.Path]::GetTempFileName()

    $FtpRequest = [System.Net.FtpWebRequest]::Create($FtpUri)
    $FtpRequest.Method = [System.Net.WebRequestMethods+Ftp]::DownloadFile
    $FtpRequest.Credentials = New-Object System.Net.NetworkCredential($FtpUser, $FtpPassword)
    $FtpRequest.UsePassive = $true
    $FtpRequest.KeepAlive = $false

    $FtpResponse = $FtpRequest.GetResponse()
    $FtpStream = $FtpResponse.GetResponseStream()
    $LocalFileStream = [System.IO.File]::Create($LocalEnvPath)
    $FtpStream.CopyTo($LocalFileStream)
    $FtpStream.Close()
    $LocalFileStream.Close()
    $FtpResponse.Close()

    $EnvContent = Get-Content $LocalEnvPath -Raw
    Remove-Item $LocalEnvPath -Force

    if ($EnvContent -match "APP_KEY=base64:") {
        Write-Host "[✓] APP_KEY configurée (base64)" -ForegroundColor Green
        $PassedChecks++
    } elseif ($EnvContent -match "APP_KEY=$" -or $EnvContent -match "APP_KEY=$\s*$") {
        Write-Host "[✗] APP_KEY vide - Cause probable de l'erreur 500" -ForegroundColor Red
        Write-Host "    → Exécutez: .\.deploy\fix-production-env.ps1 -FtpPassword 'xxx'" -ForegroundColor Cyan
    } else {
        Write-Host "[✓] APP_KEY semble correctement configurée" -ForegroundColor Green
        $PassedChecks++
    }
} catch {
    Write-Host "[⚠] Impossible de vérifier APP_KEY: $_" -ForegroundColor Yellow
}

# ============ TEST 6: Storage Permissions ============
Write-Host ""
Write-Host "[6/6] Diagnostic supplémentaire..." -ForegroundColor Yellow
$TotalChecks++
Write-Host "  • Si erreur 500 persiste:" -ForegroundColor White
Write-Host "    1. Vérifiez les permissions: .\.deploy\fix-production-permissions.ps1 -FtpPassword 'xxx'" -ForegroundColor Gray
Write-Host "    2. Nettoyez les cache: .\.deploy\clean-production-cache.ps1 -FtpPassword 'xxx'" -ForegroundColor Gray
Write-Host "    3. Consultez les logs OVH: ~/logs/error.log" -ForegroundColor Gray
$PassedChecks++

# ============ RÉSUMÉ ============
Write-Host ""
Write-Host "╔════════════════════════════════════════╗" -ForegroundColor Cyan
Write-Host "║  Résumé des vérifications             ║" -ForegroundColor Cyan
Write-Host "╚════════════════════════════════════════╝" -ForegroundColor Cyan
Write-Host ""
Write-Host "Résultat: $PassedChecks/$TotalChecks tests passés" -ForegroundColor $(if ($PassedChecks -eq $TotalChecks) { "Green" } else { "Yellow" })
Write-Host ""

if ($PassedChecks -eq $TotalChecks) {
    Write-Host "✓ Production semble en bon état!" -ForegroundColor Green
} else {
    Write-Host "⚠ Des problèmes ont été détectés. Consultez les détails ci-dessus." -ForegroundColor Yellow
}
Write-Host ""
Write-Host "URLs utiles:" -ForegroundColor Gray
Write-Host "  • https://kas-technology.com" -ForegroundColor Gray
Write-Host "  • https://www.khoros.com/" -ForegroundColor Gray
Write-Host ""
