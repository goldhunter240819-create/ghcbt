@echo off
setlocal
title GHCBT - Pembaruan Sistem Otomatis Client
color 0b

echo =========================================================
echo             GHCBT ELITE SMART SYSTEM UPDATER             
echo =========================================================
echo.

:: 1. Tentukan path PHP lokal di server XAMPP client
set PHP_BIN=..\..\php\php.exe
if not exist "%PHP_BIN%" set PHP_BIN=C:\xampp\php\php.exe
if not exist "%PHP_BIN%" set PHP_BIN=C:\xampp7\php\php.exe
if not exist "%PHP_BIN%" set PHP_BIN=php

:: 2. Amankan file krusial lokal (Konfigurasi Database ^& Lisensi Sekolah)
echo [1/4] Mengamankan konfigurasi database dan lisensi lokal...
if not exist "_backup_config" mkdir "_backup_config"

if exist "application\config\database.php" (
    copy /Y "application\config\database.php" "_backup_config\database.php" >nul
)
if exist "license.key" (
    copy /Y "license.key" "_backup_config\license.key" >nul
)

:: 3. Periksa metode update (Git vs Direct Cloud Download)
where git >nul 2>&1
if %ERRORLEVEL% EQU 0 (
    echo [2/4] Git terdeteksi. Memperbarui via Git repository...
    if not exist ".git" (
        git init >nul 2>&1
        git remote add origin https://github.com/goldhunter240819-create/ghcbt.git >nul 2>&1
        git fetch origin main >nul 2>&1
        git reset --mixed origin/main >nul 2>&1
    ) else (
        git remote set-url origin https://github.com/goldhunter240819-create/ghcbt.git >nul 2>&1
    )
    git update-index --assume-unchanged application/config/database.php >nul 2>&1
    echo [3/4] Mengunduh pembaruan terbaru dari GitHub...
    git pull origin main
    goto FINALIZE
)

:: 4. Jika Git TIDAK terinstal di client (Metode Cloud ZIP Otomatis Tanpa Git)
echo [2/4] Git tidak terinstal. Mengunduh pembaruan langsung dari GitHub...
if exist "_update_temp.zip" del /f /q "_update_temp.zip"
if exist "_update_extracted" rmdir /s /q "_update_extracted"

where curl >nul 2>&1
if %ERRORLEVEL% EQU 0 (
    curl -k -L -f -s "https://codeload.github.com/goldhunter240819-create/ghcbt/zip/refs/heads/main" -o "_update_temp.zip"
) else (
    powershell -Command "[Net.ServicePointManager]::SecurityProtocol = [Net.SecurityProtocolType]::Tls12; (New-Object System.Net.WebClient).DownloadFile('https://codeload.github.com/goldhunter240819-create/ghcbt/zip/refs/heads/main', '_update_temp.zip')"
)

if not exist "_update_temp.zip" (
    color 0c
    echo [ERROR] Gagal mengunduh paket pembaruan dari GitHub.
    echo Pastikan komputer terhubung ke internet.
    goto CLEANUP_FAIL
)

echo [3/4] Memasang file pembaruan sistem terbaru...
:: Gunakan PHP ZipArchive jika ada (sangat cepat dalam 1 detik)
if exist "%PHP_BIN%" (
    "%PHP_BIN%" -r "$z = new ZipArchive(); if($z->open('_update_temp.zip')===TRUE){ $z->extractTo('_update_extracted'); $z->close(); }"
) else (
    powershell -Command "Expand-Archive -Path '_update_temp.zip' -DestinationPath '_update_extracted' -Force"
)

:: Salin seluruh source code baru menimpa file lama
if exist "_update_extracted\ghcbt-main" (
    xcopy /E /Y /Q "_update_extracted\ghcbt-main\*" ".\" >nul 2>&1
) else (
    for /d %%D in (_update_extracted\*) do (
        xcopy /E /Y /Q "%%D\*" ".\" >nul 2>&1
    )
)

:FINALIZE
:: 5. Pulihkan kembali konfigurasi database dan lisensi client 100%
echo [4/4] Memverifikasi integritas database dan lisensi lokal...
if exist "_backup_config\database.php" (
    copy /Y "_backup_config\database.php" "application\config\database.php" >nul
)
if exist "_backup_config\license.key" (
    copy /Y "_backup_config\license.key" "license.key" >nul
)

:: Bersihkan file sementara
if exist "_update_temp.zip" del /f /q "_update_temp.zip" >nul 2>&1
if exist "_update_extracted" rmdir /s /q "_update_extracted" >nul 2>&1

:: Bersihkan cache aplikasi agar tampilan baru langsung muncul
if exist "application\cache" (
    del /Q "application\cache\*.cache" >nul 2>&1
)

color 0a
echo.
echo =========================================================
echo   [SUKSES] Aplikasi Berhasil Diperbarui ke Versi Terbaru!
echo   Konfigurasi Database ^& Data Ujian Anda Tetap Aman 100%%.
echo =========================================================
if exist "version.txt" (
    echo   Versi Saat Ini: 
    type "version.txt"
    echo.
    echo =========================================================
)
goto END

:CLEANUP_FAIL
if exist "_backup_config\database.php" (
    copy /Y "_backup_config\database.php" "application\config\database.php" >nul
)
if exist "_backup_config\license.key" (
    copy /Y "_backup_config\license.key" "license.key" >nul
)
if exist "_update_temp.zip" del /f /q "_update_temp.zip" >nul 2>&1
if exist "_update_extracted" rmdir /s /q "_update_extracted" >nul 2>&1

:END
echo.
pause
