@echo off
setlocal enabledelayedexpansion
title GHCBT - Auto Version Bump & Push to GitHub
color 0e

echo ========================================================
echo       GHCBT ELITE - AUTO VERSION BUMP ^& GIT PUSH        
echo ========================================================
echo.

:: 1. Jalankan script PHP untuk menaikkan nomor versi
for /f "delims=" %%v in ('C:\xampp\php\php.exe developer_tools\bump_version.php') do set NEW_VER=%%v

if "%NEW_VER%"=="" (
    echo [ERROR] Gagal membaca atau menaikkan versi.
    pause
    exit /b
)

echo [OK] Versi sistem berhasil dinaikkan menjadi: %NEW_VER%
echo.

:: 2. Minta keterangan update (Commit Message)
set /p MSG="Masukkan pesan update (atau tekan Enter untuk default): "
if "%MSG%"=="" set MSG=Pembaruan sistem dan optimasi fitur

:: 3. Git Add & Commit
echo.
echo Menyiapkan file ke Git...
git add .
git commit -m "release: v%NEW_VER% - %MSG%"

:: 4. Git Push
echo.
echo Mengunggah ke GitHub (git push origin main)...
git push origin main

if %ERRORLEVEL% EQU 0 (
    color 0a
    echo.
    echo ========================================================
    echo   [SUKSES] Rilis v%NEW_VER% berhasil di-push ke GitHub!
    echo ========================================================
) else (
    color 0c
    echo.
    echo ========================================================
    echo   [GAGAL] Terjadi kesalahan saat melakukan git push.
    echo ========================================================
)

echo.
pause
