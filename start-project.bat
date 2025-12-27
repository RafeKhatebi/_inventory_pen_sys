@echo off
title Inventory System Launcher
color 0A

echo ========================================
echo    Inventory System Launcher
echo ========================================
echo.

:: Start XAMPP Apache
echo [1/4] Starting XAMPP Apache...
net start Apache2.4 >nul 2>&1
if %errorlevel% equ 0 (
    echo ✓ Apache started successfully
) else (
    echo ! Apache may already be running or failed to start
)

:: Start XAMPP MySQL
echo [2/4] Starting XAMPP MySQL...
net start MySQL >nul 2>&1
if %errorlevel% equ 0 (
    echo ✓ MySQL started successfully
) else (
    echo ! MySQL may already be running or failed to start
)

:: Wait a moment for services to fully start
timeout /t 2 /nobreak >nul

:: Find available port starting from 8000
echo [3/4] Finding available port...
set PORT=8000
:checkport
netstat -an | find ":%PORT%" >nul
if %errorlevel% equ 0 (
    set /a PORT+=1
    if %PORT% gtr 8010 (
        echo ! No available ports found between 8000-8010
        pause
        exit /b 1
    )
    goto checkport
)
echo ✓ Using port %PORT%

:: Start Laravel development server
echo [4/4] Starting Laravel server on port %PORT%...
start /min cmd /c "php artisan serve --port=%PORT%"

:: Wait for server to start
timeout /t 3 /nobreak >nul

:: Try to open in Edge first, then Chrome
echo Opening in browser...
start msedge http://127.0.0.1:%PORT% >nul 2>&1
if %errorlevel% neq 0 (
    start chrome http://127.0.0.1:%PORT% >nul 2>&1
    if %errorlevel% neq 0 (
        start http://127.0.0.1:%PORT%
    )
)

echo.
echo ========================================
echo ✓ Project started successfully!
echo ✓ URL: http://127.0.0.1:%PORT%
echo ✓ Press Ctrl+C in server window to stop
echo ========================================
echo.
pause