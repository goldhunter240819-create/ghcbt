@echo off
TITLE ZENITH PACKER - SALE BUILDER
echo ========================================
echo   ZENITH PULSE - GENERATING SALE BUILD
echo ========================================
echo.
Powershell.exe -ExecutionPolicy Bypass -File zenith_packer.ps1 -Mode SALE
echo.
pause
