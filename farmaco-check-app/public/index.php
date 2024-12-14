<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

try {
    // Define headers de segurança
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('X-XSS-Protection: 1; mode=block');

    // Verifica se o app está em modo de manutenção
    $maintenance = __DIR__.'/../storage/framework/maintenance.php';
    if (is_readable($maintenance)) {
        require $maintenance;
    }

    // Registra o autoloader do Composer
    require realpath(__DIR__.'/../vendor/autoload.php');

    // Bootstrap da aplicação Laravel e tratamento da request
    (require_once realpath(__DIR__.'/../bootstrap/app.php'))
        ->handleRequest(Request::capture());
} catch (Throwable $e) {
    // Tratamento de erros
    error_log($e->getMessage());
    http_response_code(500);
    echo "Ocorreu um erro. Por favor, tente novamente mais tarde.";
    exit(1);
}
