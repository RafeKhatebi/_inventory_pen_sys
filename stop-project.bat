@echo off
title Stop Inventory System
color 0C

echo ========================================
echo    Stopping Inventory System
echo ========================================
echo.

:: Kill Laravel development server
echo [1/2] Stopping Laravel server...
taskkill /f /im php.exe >nul 2>&1
if %errorlevel% equ 0 (
    echo ✓ Laravel server stopped
) else (
    echo ! No Laravel server found running
)

:: Stop XAMPP services (optional)
echo [2/2] Stopping XAMPP services...
choice /c YN /m "Do you want to stop XAMPP services (Apache & MySQL)?"
if %errorlevel% equ 1 (
    net stop Apache2.4 >nul 2>&1
    net stop MySQL >nul 2>&1
    echo ✓ XAMPP services stopped
) else (
    echo ! XAMPP services left running
)

echo.
echo ========================================
echo ✓ Project stopped successfully!
echo ========================================
echo.
pause