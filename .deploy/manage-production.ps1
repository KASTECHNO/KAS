# Script PowerShell Maître pour gérer l'environnement de production KAS
# Permet d'accéder à tous les outils de déploiement et maintenance

param(
    [string]$Action = "menu",
    [string]$FtpPassword = ""
)

$DeployPath = Split-Path -Parent $MyInvocation.MyCommand.Path

function Show-Menu {
    Write-Host ""
    Write-Host "╔════════════════════════════════════════╗" -ForegroundColor Cyan
    Write-Host "║     KAS Production Management          ║" -ForegroundColor Cyan
    Write-Host "║              Menu Principal            ║" -ForegroundColor Cyan
    Write-Host "╚════════════════════════════════════════╝" -ForegroundColor Cyan
    Write-Host ""
    Write-Host "DÉPLOIEMENT & CONFIGURATION:" -ForegroundColor Yellow
    Write-Host "  1) Corriger APP_KEY (erreur 500) →     fix-production-env.ps1" -ForegroundColor White
    Write-Host "  2) Corriger les permissions (755/777) → fix-production-permissions.ps1" -ForegroundColor White
    Write-Host ""
    Write-Host "MAINTENANCE:" -ForegroundColor Yellow
    Write-Host "  3) Vérifier l'état de production →    check-production-status.ps1" -ForegroundColor White
    Write-Host "  4) Nettoyer cache et logs →           clean-production-cache.ps1" -ForegroundColor White
    Write-Host ""
    Write-Host "UTILITAIRES:" -ForegroundColor Yellow
    Write-Host "  5) Afficher la génération d'APP_KEY locale" -ForegroundColor White
    Write-Host "  6) Quitter" -ForegroundColor White
    Write-Host ""
}

function Get-FtpPassword {
    if ([string]::IsNullOrEmpty($FtpPassword)) {
        Write-Host ""
        Write-Host "Entrez votre mot de passe FTP OVH:" -ForegroundColor Yellow
        $SecurePassword = Read-Host -AsSecureString
        $FtpPassword = [System.Runtime.InteropServices.Marshal]::PtrToStringAuto(
            [System.Runtime.InteropServices.Marshal]::SecureStringToCoTaskMemUnicode($SecurePassword)
        )
    }
    return $FtpPassword
}

function Execute-Script {
    param([string]$ScriptName)

    $ScriptPath = Join-Path $DeployPath $ScriptName

    if (-not (Test-Path $ScriptPath)) {
        Write-Host "[✗] Script non trouvé: $ScriptPath" -ForegroundColor Red
        return
    }

    $Password = Get-FtpPassword

    Write-Host ""
    Write-Host "Exécution: $ScriptName..." -ForegroundColor Cyan
    Write-Host "─────────────────────────────────────────" -ForegroundColor Gray

    & $ScriptPath -FtpPassword $Password
}

# ============ LOGIQUE PRINCIPALE ============
if ($Action -eq "menu" -or $Action -eq "") {
    while ($true) {
        Show-Menu
        $Choice = Read-Host "Sélectionnez une option (1-6)"

        switch ($Choice) {
            "1" { Execute-Script "fix-production-env.ps1" }
            "2" { Execute-Script "fix-production-permissions.ps1" }
            "3" { Execute-Script "check-production-status.ps1" }
            "4" { Execute-Script "clean-production-cache.ps1" }
            "5" {
                Write-Host ""
                Write-Host "Génération APP_KEY locale..." -ForegroundColor Yellow
                $ProjectRoot = Split-Path -Parent (Split-Path -Parent $DeployPath)
                Push-Location $ProjectRoot
                $AppKey = php artisan key:generate --show 2>&1
                Pop-Location
                Write-Host "APP_KEY générée:" -ForegroundColor Green
                Write-Host "  $AppKey" -ForegroundColor Cyan
                Write-Host ""
                Write-Host "Copiez cette clé dans le fichier .env sur le serveur." -ForegroundColor Gray
                Read-Host "Appuyez sur Entrée pour revenir au menu"
            }
            "6" {
                Write-Host "Au revoir!" -ForegroundColor Cyan
                exit 0
            }
            default {
                Write-Host "[✗] Option invalide. Veuillez choisir 1-6." -ForegroundColor Red
            }
        }
    }
} else {
    # Mode ligne de commande directe
    switch ($Action.ToLower()) {
        "fix-env" { Execute-Script "fix-production-env.ps1" }
        "fix-permissions" { Execute-Script "fix-production-permissions.ps1" }
        "check-status" { Execute-Script "check-production-status.ps1" }
        "clean-cache" { Execute-Script "clean-production-cache.ps1" }
        default {
            Write-Host "Actions disponibles:" -ForegroundColor Yellow
            Write-Host "  fix-env" -ForegroundColor White
            Write-Host "  fix-permissions" -ForegroundColor White
            Write-Host "  check-status" -ForegroundColor White
            Write-Host "  clean-cache" -ForegroundColor White
        }
    }
}
