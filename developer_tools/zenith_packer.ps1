# ZENITH PACKER ENGINE v1.3 (Shield Integrated)
# Core logic for building Sale and Update packages

param (
    [Parameter(Mandatory=$true)]
    [ValidateSet("SALE", "UPDATE")]
    $Mode
)

# Menentukan root proyek (satu tingkat di atas lokasi skrip ini)
$ScriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
if (!$ScriptDir) { $ScriptDir = Get-Location } # Fallback jika dijalankan secara interaktif
$RootDir = (Get-Item $ScriptDir).Parent.FullName

$Version = (Get-Content "$RootDir\version.txt" -ErrorAction SilentlyContinue)
if (!$Version) { $Version = "1.0.0" }

$Timestamp = Get-Date -Format "yyyyMMdd_HHmm"
$CleanVersion = $Version -replace " ", "_" -replace "\.", "_"
$ZipName = "GHCBT_$($Mode)_$($CleanVersion)_$($Timestamp).zip"
$OutputDir = "$RootDir\backups\releases"

if (!(Test-Path $OutputDir)) { New-Item -ItemType Directory -Path $OutputDir }

$OutFile = "$OutputDir\$ZipName"

Write-Host "--- ZENITH PACKER ENGINE ---" -ForegroundColor Cyan
Write-Host "Mode: $Mode" -ForegroundColor Yellow
Write-Host "Target: $OutFile" -ForegroundColor Green

# Exclusions
$ExcludeList = @(
    "backups",
    "developer_tools",
    "license.key",
    "application/logs/log-*.php",
    "application/cache/*",
    "public/uploads/*",
    ".git",
    ".vscode",
    ".gemini",
    "scratch",
    "create_history_table.php",
    "test_licensing.php",
    "ZENITH_BUILD_SALE.bat",
    "ZENITH_BUILD_UPDATE.bat",
    "zenith_packer.ps1"
)

# For Update mode, we might want to exclude even more (like config)
if ($Mode -eq "UPDATE") {
    $ExcludeList += "application/config/database.php"
}

# Protected Files (Zenith Shield)
$ShieldList = @(
    "application/libraries/Licensing.php",
    "application/controllers/Tes_kerjakan.php",
    "application/controllers/manager/Dashboard.php",
    "application/helpers/soal_helper.php",
    "application/controllers/activation.php"
)

# Create Temporary Build Folder
$TempDir = "$env:TEMP\zenith_build_$Timestamp"
New-Item -ItemType Directory -Path $TempDir | Out-Null

Write-Host "Copying files to temporary staging..." -ForegroundColor Gray

# Copy only what's needed
Get-ChildItem -Path $RootDir -Recurse | Where-Object {
    $RelativePath = $_.FullName.Substring($RootDir.Length + 1).Replace("\", "/")
    
    $Keep = $true
    foreach ($Ex in $ExcludeList) {
        if ($RelativePath -like "$Ex*") {
            $Keep = $false
            break
        }
    }
    return $Keep -and !$_.PSIsContainer
} | ForEach-Object {
    $RelPath = $_.FullName.Substring($RootDir.Length + 1)
    $DestFilePath = Join-Path $TempDir $RelPath
    $DestFileDir = Split-Path $DestFilePath -Parent
    if (!(Test-Path $DestFileDir)) { New-Item -ItemType Directory -Path $DestFileDir | Out-Null }
    Write-Host "  -> Copying: $RelPath" -ForegroundColor Gray
    Copy-Item $_.FullName $DestFilePath
}

# Apply Zenith Shield to Staged Files
Write-Host "`nApplying Zenith Shield to critical files..." -ForegroundColor Cyan
$ShieldScript = "$RootDir\developer_tools\zenith_shield.php"

foreach ($SFile in $ShieldList) {
    $TargetPath = Join-Path $TempDir $SFile.Replace("/", "\")
    if (Test-Path $TargetPath) {
        C:\xampp\php\php.exe $ShieldScript $TargetPath
    }
}

# Reset Database Config for SALE build
if ($Mode -eq "SALE") {
    Write-Host "`nCleaning database config for SALE build..." -ForegroundColor Cyan
    $DbConfigPath = Join-Path $TempDir "application\config\database.php"
    if (Test-Path $DbConfigPath) {
        $Content = Get-Content $DbConfigPath -Raw
        $Content = $Content -replace "'hostname' => '.*?'", "'hostname' => 'localhost'"
        $Content = $Content -replace "'username' => '.*?'", "'username' => ''"
        $Content = $Content -replace "'password' => '.*?'", "'password' => ''"
        $Content = $Content -replace "'database' => '.*?'", "'database' => ''"
        Set-Content -Path $DbConfigPath -Value $Content
        Write-Host "  -> Database credentials reset to default." -ForegroundColor Gray
    }
}

# Compress
Write-Host "Compressing package..." -ForegroundColor Cyan
Compress-Archive -Path "$TempDir\*" -DestinationPath $OutFile -Force

# Cleanup
Remove-Item -Path $TempDir -Recurse -Force

Write-Host "`nBUILD SUCCESS!" -ForegroundColor Green
Write-Host "File created at: $OutFile" -ForegroundColor Yellow
Write-Host "----------------------------" -ForegroundColor Cyan
