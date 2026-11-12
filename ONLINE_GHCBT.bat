@echo off
TITLE GHCBT TUNNEL - SEARCHING ACCESS...
echo ========================================
echo   GHCBT ONLINE BRIDGE (TryCloudflare)
echo ========================================
echo.
echo Sedang membuka jalur rahasia...
echo SILAKAN SALIN LINK YANG BERAKHIRAN .trycloudflare.com
echo.
cloudflared tunnel --url http://localhost/GHCBT
pause
