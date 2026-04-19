@echo off
REM Script para iniciar servidor local em Windows

echo.
echo =========================================
echo  LISTA DE PRESENTES - SERVIDOR LOCAL
echo =========================================
echo.

REM Tenta com Python 3
python --version >nul 2>&1
if %ERRORLEVEL% EQU 0 (
    echo [OK] Python 3 encontrado
    echo Iniciando servidor em http://localhost:8000
    echo.
    python -m http.server 8000
    goto end
)

REM Tenta com Python 2
python --version >nul 2>&1
if %ERRORLEVEL% EQU 0 (
    echo [OK] Python 2 encontrado
    echo Iniciando servidor em http://localhost:8000
    echo.
    python -m SimpleHTTPServer 8000
    goto end
)

REM Tenta com Node.js
where npx >nul 2>&1
if %ERRORLEVEL% EQU 0 (
    echo [OK] Node.js encontrado
    echo Iniciando servidor em http://localhost:8000
    echo.
    npx http-server -p 8000
    goto end
)

echo [ERRO] Nenhuma opção encontrada!
echo.
echo Instale uma das seguintes opcoes:
echo - Python: https://www.python.org/downloads
echo - Node.js: https://nodejs.org
echo.
pause

:end
