@echo off
echo ========================================
echo    MENJALANKAN GHCBT UPDATE PACKAGER
echo ========================================
echo.

:: --- CONFIGURASI EXCLUDE ---
:: Tambahkan folder yang ingin dikecualikan (pisahkan dengan koma)
:: Contoh: SET "EX_DIRS=folder_a,folder_b"
SET "EX_DIRS="

if "%EX_DIRS%"=="" (
    SET "ARGS="
) else (
    SET "ARGS=--exclude=%EX_DIRS%"
)

C:\xampp\php\php.exe build_update.php %ARGS%

echo.
echo ========================================
pause
