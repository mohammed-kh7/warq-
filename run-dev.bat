@echo off
chcp 65001 >nul
cd /d "%~dp0"

REM جرّب php من PATH أولاً
where php >nul 2>&1 && (
  php artisan serve
  goto :end
)

REM وإلا استخدم XAMPP إن وُجد
if exist "C:\xampp\php\php.exe" (
  "C:\xampp\php\php.exe" artisan serve
  goto :end
)

echo لم يُعثر على PHP. ثبّت XAMPP أو أضف مجلد php إلى PATH.
pause
:end
