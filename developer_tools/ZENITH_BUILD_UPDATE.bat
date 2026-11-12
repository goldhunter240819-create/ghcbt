@echo off
TITLE ZENITH PACKER - UPDATE BUILDER
echo ========================================
echo   ZENITH PULSE - GENERATING UPDATE BUILD
echo ========================================
echo.
Powershell.exe -ExecutionPolicy Bypass -File zenith_packer.ps1 -Mode UPDATE
echo.
pause
