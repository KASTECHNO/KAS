# Script PowerShell pour nettoyer les cache et logs en production
# Nettoie: cache Laravel, logs, fichiers temporaires

param(
    [string]$FtpHost = "ftp.cluster030.hosting.ovh.net",
    [string]$FtpUser = "kastecj",
    [string]$FtpPassword = "",
    [switch]$DryRun = $false
)

Write-Host "╔════════════════════════════════════════╗" -ForegroundColor Cyan
Write-Host "║  KAS Production Cache & Logs Clean    ║" -ForegroundColor Cyan
Write-Host "╚════════════════════════════════════════╝" -ForegroundColor Cyan
Write-Host ""

if ([string]::IsNullOrEmpty($FtpPassword)) {
    Write-Host "[!] Le paramètre -FtpPassword est required" -ForegroundColor Red
    Write-Host "    Usage: .\.deploy\clean-production-cache.ps1 -FtpPassword 'xxx'" -ForegroundColor Cyan
    exit 1
}

if ($DryRun) {
    Write-Host "[Mode DRY-RUN] Aucun fichier ne sera supprimé" -ForegroundColor Yellow
    Write-Host ""
}

# ============ OPTION SSH (RECOMMANDÉE) ============
Write-Host "OPTION 1: Via SSH (RECOMMANDÉ)" -ForegroundColor Green
Write-Host "  Exécutez ces commandes sur le serveur via SSH:" -ForegroundColor White
Write-Host ""
Write-Host "  # Nettoyer cache Laravel" -ForegroundColor Gray
Write-Host "  rm -rf ~/kas/bootstrap/cache/*" -ForegroundColor Gray
Write-Host "  rm -rf ~/kas/storage/framework/cache/*" -ForegroundColor Gray
Write-Host "  rm -rf ~/kas/storage/framework/views/*" -ForegroundColor Gray
Write-Host ""
Write-Host "  # Nettoyer logs" -ForegroundColor Gray
Write-Host "  rm -rf ~/kas/storage/logs/*.log" -ForegroundColor Gray
Write-Host "  rm -rf ~/logs/*.log 2>/dev/null" -ForegroundColor Gray
Write-Host ""
Write-Host "  # Nettoyer temp Laravel" -ForegroundColor Gray
Write-Host "  rm -rf ~/kas/storage/app/cache/*" -ForegroundColor Gray
Write-Host "  rm -rf ~/kas/storage/app/uploads/*temp*" -ForegroundColor Gray
Write-Host ""

# ============ OPTION FTP (ALTERNATIVE) ============
Write-Host ""
Write-Host "OPTION 2: Via FTP (PowerShell)" -ForegroundColor Green
Write-Host ""

$DirsToClean = @(
    "/kas/bootstrap/cache",
    "/kas/storage/framework/cache",
    "/kas/storage/framework/views",
    "/kas/storage/logs",
    "/kas/storage/app/cache"
)

function Delete-FtpFile {
    param([string]$Path)

    try {
        if ($DryRun) {
            Write-Host "  [DRY-RUN] rm: $Path" -ForegroundColor Gray
            return $true
        }

        $FtpUri = "ftp://$FtpHost$Path"
        $FtpRequest = [System.Net.FtpWebRequest]::Create($FtpUri)
        $FtpRequest.Method = [System.Net.WebRequestMethods+Ftp]::DeleteFile
        $FtpRequest.Credentials = New-Object System.Net.NetworkCredential($FtpUser, $FtpPassword)
        $FtpRequest.UsePassive = $true
        $FtpRequest.KeepAlive = $false

        $FtpResponse = $FtpRequest.GetResponse()
        $StatusCode = $FtpResponse.StatusCode
        $FtpResponse.Close()

        if ($StatusCode -match "Delete") {
            Write-Host "  [✓] Supprimé: $Path" -ForegroundColor Green
            return $true
        }
    } catch {
        # FTP ne peut pas supprimer les répertoires, seulement les fichiers
        return $false
    }
}

function List-FtpDirectory {
    param([string]$Path)

    try {
        $FtpUri = "ftp://$FtpHost$Path"
        $FtpRequest = [System.Net.FtpWebRequest]::Create($FtpUri)
        $FtpRequest.Method = [System.Net.WebRequestMethods+Ftp]::ListDirectory
        $FtpRequest.Credentials = New-Object System.Net.NetworkCredential($FtpUser, $FtpPassword)
        $FtpRequest.UsePassive = $true
        $FtpRequest.KeepAlive = $false

        $FtpResponse = $FtpRequest.GetResponse()
        $FtpStream = $FtpResponse.GetResponseStream()
        $StreamReader = New-Object System.IO.StreamReader($FtpStream)
        $Files = @()

        while ($null -ne ($Line = $StreamReader.ReadLine())) {
            if ($Line -and $Line.Trim() -notmatch "^d" -and $Line.Trim() -notmatch "^\.") {
                $Files += $Line.Trim()
            }
        }

        $StreamReader.Close()
        $FtpStream.Close()
        $FtpResponse.Close()

        return $Files
    } catch {
        return @()
    }
}

$FilesRemoved = 0
$DirsProcessed = 0

Write-Host "[Processing] Nettoyage en cours..." -ForegroundColor Yellow
Write-Host ""

foreach ($Dir in $DirsToClean) {
    Write-Host "  Répertoire: $Dir" -ForegroundColor Cyan

    $Files = List-FtpDirectory -Path $Dir

    if ($Files.Count -eq 0) {
        Write-Host "    → Vide ou inaccessible" -ForegroundColor Gray
    } else {
        Write-Host "    → $($Files.Count) fichier(s) trouvé(s)" -ForegroundColor White

        foreach ($File in $Files) {
            $FilePath = "$Dir/$($File.Split()[8])" # Extraction du nom de fichier
            if (Delete-FtpFile -Path $FilePath) {
                $FilesRemoved++
            }
        }
    }

    $DirsProcessed++
}

Write-Host ""
Write-Host "╔════════════════════════════════════════╗" -ForegroundColor $(if ($DryRun) { "Yellow" } else { "Green" })
Write-Host "║  Nettoyage Terminé                    ║" -ForegroundColor $(if ($DryRun) { "Yellow" } else { "Green" })
Write-Host "╚════════════════════════════════════════╝" -ForegroundColor $(if ($DryRun) { "Yellow" } else { "Green" })
Write-Host ""
Write-Host "Résulmé:" -ForegroundColor White
Write-Host "  • Répertoires traités: $DirsProcessed" -ForegroundColor Gray
Write-Host "  • Fichiers supprimés: $FilesRemoved" -ForegroundColor Gray
Write-Host "  • Mode: $(if ($DryRun) { 'DRY-RUN (simulation)' } else { 'ACTIF (modifications réelles)' })" -ForegroundColor Gray
Write-Host ""

if (-not $DryRun) {
    Write-Host "✓ Cache et logs nettoyés. Rechargez le site pour voir les changements." -ForegroundColor Green
} else {
    Write-Host "Pour appliquer le nettoyage réel, exécutez without le flag -DryRun" -ForegroundColor Yellow
}

Write-Host ""
Write-Host "Conseil: SSH est beaucoup plus efficace pour cette opération." -ForegroundColor Gray
Write-Host ""
