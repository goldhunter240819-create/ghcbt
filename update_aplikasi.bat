@echo off
title GHCBT - Pembaruan Sistem Otomatis
color 0b
echo ===================================================
echo             GHCBT ELITE SYSTEM UPDATER             
echo ===================================================
echo Sedang memeriksa dan mengunduh pembaruan terbaru...
echo.

git pull origin main

echo.
if %ERRORLEVEL% EQU 0 (
    color 0a
    echo ===================================================
    echo       [SUKSES] Aplikasi Berhasil Diperbarui!        
    echo ===================================================
) else (
    color 0c
    echo ===================================================
    echo       [GAGAL] Gagal memperbarui aplikasi.           
    echo   Pastikan koneksi internet aktif dan terhubung.    
    echo ===================================================
)

echo.
pause

