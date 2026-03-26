# Script PowerShell pour corriger les permissions des dossiers production
# Corrige les permissions à 755 (répertoires) et 644 (fichiers)

param(
    [string]$FtpHost = "ftp.cluster030.hosting.ovh.net",
    [string]$FtpUser = "kastecj",
    [string]$FtpPassword = ""
)

Write-Host "╔════════════════════════════════════════╗" -ForegroundColor Cyan
Write-Host "║  KAS Production Permissions Fix       ║" -ForegroundColor Cyan
Write-Host "╚════════════════════════════════════════╝" -ForegroundColor Cyan
Write-Host ""

if ([string]::IsNullOrEmpty($FtpPassword)) {
    Write-Host "[!] Le paramètre -FtpPassword est required" -ForegroundColor Red
    Write-Host "    Usage: .\.deploy\fix-production-permissions.ps1 -FtpPassword 'votre_mot_de_passe_ovh'" -ForegroundColor Cyan
    exit 1
}

# Dossiers qui nécessitent des permissions 777 (lecture/écriture/exécution)
$DirsNeed777 = @(
    "/kas/storage",
    "/kas/storage/app",
    "/kas/storage/framework",
    "/kas/storage/logs",
    "/kas/bootstrap/cache"
)

# Dossiers qui nécessitent 755 (lecture/exécution publique, écriture propriétaire)
$DirsNeed755 = @(
    "/kas/app",
    "/kas/config",
    "/kas/database",
    "/kas/resources",
    "/kas/routes",
    "/www"
)

function Set-FtpPermission {
    param([string]$Path, [int]$Permission)

    try {
        $OctalPerm = $Permission.ToString("000")
        $FtpRequest = [System.Net.FtpWebRequest]::Create("ftp://$FtpHost$Path")
        $FtpRequest.Method = [System.Net.WebRequestMethods+Ftp]::SendCommandOnly
        $FtpRequest.Credentials = New-Object System.Net.NetworkCredential($FtpUser, $FtpPassword)
        $FtpRequest.UseBinary = $true
        $FtpRequest.KeepAlive = $false

        # Commande brute FTP: SITE CHMOD
        $FtpRequest.SetCommandToSendToServer($true)
        $Stream = $FtpRequest.GetRequestStream()
        $Command = "SITE CHMOD $OctalPerm $Path`r`n"
        $Bytes = [System.Text.Encoding]::ASCII.GetBytes($Command)
        $Stream.Write($Bytes, 0, $Bytes.Length)
        $Stream.Close()

        $Response = $FtpRequest.GetResponse()
        $StatusCode = $Response.StatusCode
        $Response.Close()

        if ($StatusCode -match "Complete|Success") {
            Write-Host "[✓] $Path → $OctalPerm" -ForegroundColor Green
            return $true
        } else {
            Write-Host "[⚠] $Path → $OctalPerm (Status: $StatusCode)" -ForegroundColor Yellow
            return $false
        }
    } catch {
        Write-Host "[✗] $Path → Erreur: $_" -ForegroundColor Red
        return $false
    }
}

# OPTION ALTERNATIVE: Via SSH et CHMOD (si SSH est disponible)
function Set-PermissionsViaSsh {
    param([string]$SshHost, [string]$SshUser, [string]$SshPassword)

    Write-Host ""
    Write-Host "[INFO] Si vous préférez utiliser SSH (plus fiable):" -ForegroundColor Cyan
    Write-Host "  1. Assurez-vous que SSH est activé sur OVH Manager" -ForegroundColor White
    Write-Host "  2. Installez Posh-SSH: Install-Module -Name Posh-SSH -Force" -ForegroundColor White
    Write-Host "  3. Exécutez ce commande:" -ForegroundColor White
    Write-Host ""
    Write-Host '      chmod -R 777 ~/kas/storage ~/kas/bootstrap/cache' -ForegroundColor Gray
    Write-Host '      chmod -R 755 ~/kas/app ~/kas/config ~/kas/database ~/kas/resources ~/kas/routes ~/www' -ForegroundColor Gray
    Write-Host ""
}

Write-Host "[1/3] Correction permissions 777 (stockage + cache)..." -ForegroundColor Yellow
$Success777 = 0
foreach ($Dir in $DirsNeed777) {
    if (Set-FtpPermission -Path $Dir -Permission 777) {
        $Success777++
    }
}
Write-Host ""

Write-Host "[2/3] Correction permissions 755 (répertoires applicatifs)..." -ForegroundColor Yellow
$Success755 = 0
foreach ($Dir in $DirsNeed755) {
    if (Set-FtpPermission -Path $Dir -Permission 755) {
        $Success755++
    }
}
Write-Host ""

Write-Host "[3/3] Permissions corriges:" -ForegroundColor Yellow
Write-Host "  • 777 (writable): $Success777/$(($DirsNeed777).Count)" -ForegroundColor Green
Write-Host "  • 755 (readable):  $Success755/$(($DirsNeed755).Count)" -ForegroundColor Green

Set-PermissionsViaSsh

Write-Host ""
Write-Host "Note importante:" -ForegroundColor Gray
Write-Host "  Les permissions via FTP peuvent ne pas fonctionner correctement sur" -ForegroundColor Gray
Write-Host "  certains serveurs OVH. SSH est la méthode recommandée." -ForegroundColor Gray
Write-Host ""
