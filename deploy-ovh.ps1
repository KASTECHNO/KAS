param(
    [string]$OutputDir = ".deploy\\server-root",
    [string]$ZipName = "kas-technology-server-root.zip"
)

$ErrorActionPreference = 'Stop'

$projectRoot = Split-Path -Parent $MyInvocation.MyCommand.Path
$packageRoot = Join-Path $projectRoot $OutputDir
$appRoot = Join-Path $packageRoot 'kas'
$publicHtmlRoot = Join-Path $packageRoot 'www'
$zipPath = Join-Path $projectRoot $ZipName

function Reset-Directory {
    param([string]$Path)

    if (Test-Path $Path) {
        Remove-Item -Path $Path -Recurse -Force
    }

    New-Item -ItemType Directory -Path $Path | Out-Null
}

Write-Host 'Preparation du package OVH...'

Reset-Directory -Path $packageRoot
New-Item -ItemType Directory -Path $appRoot | Out-Null
New-Item -ItemType Directory -Path $publicHtmlRoot | Out-Null

$robocopySource = $projectRoot
$robocopyDestination = $appRoot
$excludeDirs = @('.git', 'node_modules', 'tests', '.deploy')
$excludeFiles = @('.env', '.env.production', $ZipName)

$robocopyArgs = @(
    $robocopySource,
    $robocopyDestination,
    '/E',
    '/R:1',
    '/W:1',
    '/NFL',
    '/NDL',
    '/NJH',
    '/NJS',
    '/XD'
) + $excludeDirs + @('/XF') + $excludeFiles

& robocopy @robocopyArgs | Out-Null
if ($LASTEXITCODE -gt 7) {
    throw "Robocopy a echoue avec le code $LASTEXITCODE"
}

Copy-Item -Path (Join-Path $projectRoot 'public\*') -Destination $publicHtmlRoot -Recurse -Force
Copy-Item -Path (Join-Path $projectRoot 'public_html_index.php') -Destination (Join-Path $publicHtmlRoot 'index.php') -Force
Copy-Item -Path (Join-Path $projectRoot 'public\.htaccess') -Destination (Join-Path $publicHtmlRoot '.htaccess') -Force

if (Test-Path (Join-Path $projectRoot '.env.production')) {
    Copy-Item -Path (Join-Path $projectRoot '.env.production') -Destination (Join-Path $appRoot '.env') -Force
} else {
    Copy-Item -Path (Join-Path $projectRoot '.env.production.example') -Destination (Join-Path $appRoot '.env.production.example') -Force
}

if (Test-Path $zipPath) {
    Remove-Item -Path $zipPath -Force
}

Compress-Archive -Path (Join-Path $packageRoot '*') -DestinationPath $zipPath -Force

Write-Host ''
Write-Host 'Package genere avec succes:'
Write-Host $zipPath
Write-Host ''
Write-Host 'Contenu:'
Write-Host '- www/          -> racine web du serveur OVH'
Write-Host '- kas/          -> application Laravel hors racine web'
