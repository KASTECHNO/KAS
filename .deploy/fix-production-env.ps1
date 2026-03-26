# Script PowerShell pour corriger le fichier .env en production via FTP
# Corrige l'APP_KEY vide qui cause l'erreur 500

param(
    [string]$FtpHost = "ftp.cluster030.hosting.ovh.net",
    [string]$FtpUser = "kastecj",
    [string]$FtpPassword = "",  # À remplir avec le mot de passe OVH
    [int]$FtpPort = 21,
    [string]$ProjectRoot = "C:\Users\User\Downloads\kas\github\mahmoud\Nouveau dossier\KAS"
)

Write-Host "╔════════════════════════════════════════╗" -ForegroundColor Cyan
Write-Host "║  KAS Production .env Fix via FTP      ║" -ForegroundColor Cyan
Write-Host "╚════════════════════════════════════════╝" -ForegroundColor Cyan
Write-Host ""

# 1. GENERATE APP_KEY locally
Write-Host "[1/5] Génération de l'APP_KEY locale..." -ForegroundColor Yellow
Push-Location $ProjectRoot
$AppKeyOutput = php artisan key:generate --show 2>&1
Pop-Location

if ($LASTEXITCODE -eq 0) {
    Write-Host "[✓] APP_KEY générée: $AppKeyOutput" -ForegroundColor Green
} else {
    Write-Host "[✗] Erreur lors de la génération. Assurez-vous que php et laravel sont installés." -ForegroundColor Red
    exit 1
}

# 2. VALIDATE FTP PASSWORD
Write-Host ""
Write-Host "[2/5] Validation des paramètres FTP..." -ForegroundColor Yellow
if ([string]::IsNullOrEmpty($FtpPassword)) {
    Write-Host "[!] Le paramètre -FtpPassword est vide" -ForegroundColor Red
    Write-Host "    Usage: .\.deploy\fix-production-env.ps1 -FtpPassword 'votre_mot_de_passe_ovh'" -ForegroundColor Cyan
    exit 1
}
Write-Host "[✓] Paramètres FTP validés" -ForegroundColor Green

# 3. CONNECT TO FTP AND DOWNLOAD .env
Write-Host ""
Write-Host "[3/5] Téléchargement du fichier .env depuis le serveur..." -ForegroundColor Yellow

$FtpUri = "ftp://$FtpHost/kas/.env"
$LocalEnvPath = Join-Path $ProjectRoot ".deploy\kas-env-backup.env"
$NewEnvPath = Join-Path $ProjectRoot ".deploy\kas-env-updated.env"

try {
    $FtpRequest = [System.Net.FtpWebRequest]::Create($FtpUri)
    $FtpRequest.Method = [System.Net.WebRequestMethods+Ftp]::DownloadFile
    $FtpRequest.Credentials = New-Object System.Net.NetworkCredential($FtpUser, $FtpPassword)
    $FtpRequest.UseBinary = $true
    $FtpRequest.KeepAlive = $false

    $FtpResponse = $FtpRequest.GetResponse()
    $FtpStream = $FtpResponse.GetResponseStream()
    $LocalFileStream = [System.IO.File]::Create($LocalEnvPath)
    $FtpStream.CopyTo($LocalFileStream)
    $FtpStream.Close()
    $LocalFileStream.Close()
    $FtpResponse.Close()

    Write-Host "[✓] Fichier .env téléchargé: $LocalEnvPath" -ForegroundColor Green
} catch {
    Write-Host "[✗] Erreur FTP: $_" -ForegroundColor Red
    exit 1
}

# 4. UPDATE .env WITH NEW APP_KEY
Write-Host ""
Write-Host "[4/5] Mise à jour du fichier .env avec la nouvelle APP_KEY..." -ForegroundColor Yellow

$EnvContent = Get-Content $LocalEnvPath -Raw

# Remplacer APP_KEY=vide par la nouvelle clé
$UpdatedContent = $EnvContent -replace "^APP_KEY=.*$", "APP_KEY=$AppKeyOutput"

# Vérifier si c'est une production
if ($UpdatedContent -notmatch "APP_KEY=base64:") {
    Write-Host "[✗] APP_KEY générée ne semble pas au bon format" -ForegroundColor Red
    exit 1
}

# Sauvegarder le fichier mis à jour
$UpdatedContent | Set-Content $NewEnvPath -Encoding UTF8
Write-Host "[✓] Fichier .env mis à jour localement" -ForegroundColor Green
Write-Host "    > Sauvegarde: $LocalEnvPath" -ForegroundColor Gray
Write-Host "    > Nouveau: $NewEnvPath" -ForegroundColor Gray

# 5. UPLOAD UPDATED .env BACK TO SERVER
Write-Host ""
Write-Host "[5/5] Envoi du fichier .env mis à jour au serveur..." -ForegroundColor Yellow

try {
    $FtpRequest = [System.Net.FtpWebRequest]::Create($FtpUri)
    $FtpRequest.Method = [System.Net.WebRequestMethods+Ftp]::UploadFile
    $FtpRequest.Credentials = New-Object System.Net.NetworkCredential($FtpUser, $FtpPassword)
    $FtpRequest.UseBinary = $true
    $FtpRequest.KeepAlive = $false
    $FtpRequest.ContentLength = (Get-Item $NewEnvPath).Length

    $FileStream = [System.IO.File]::OpenRead($NewEnvPath)
    $FtpStream = $FtpRequest.GetRequestStream()
    $FileStream.CopyTo($FtpStream)
    $FileStream.Close()
    $FtpStream.Close()

    $FtpResponse = $FtpRequest.GetResponse()
    $FtpResponse.Close()

    Write-Host "[✓] Fichier .env uploadé avec succès" -ForegroundColor Green
} catch {
    Write-Host "[✗] Erreur lors de l'upload: $_" -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "╔════════════════════════════════════════╗" -ForegroundColor Green
Write-Host "║  ✓ Déploiement terminé avec succès   ║" -ForegroundColor Green
Write-Host "╚════════════════════════════════════════╝" -ForegroundColor Green
Write-Host ""
Write-Host "Prochaines étapes:" -ForegroundColor Cyan
Write-Host "  1. Accédez à https://kas-technology.com/" -ForegroundColor White
Write-Host "  2. Vérifiez que l'erreur 500 a disparu" -ForegroundColor White
Write-Host "  3. Si des erreurs persistent, consultez les logs du serveur" -ForegroundColor White
Write-Host ""
Write-Host "Fichiers de sauvegarde:" -ForegroundColor Gray
Write-Host "  • Sauvegarde .env: $LocalEnvPath" -ForegroundColor Gray
Write-Host "  • Fichier mis à jour: $NewEnvPath" -ForegroundColor Gray
Write-Host ""
