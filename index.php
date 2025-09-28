<?php

$controllerPath = $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/AuthController.php';

require_once $controllerPath;

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
$path = rtrim($path, '/');


switch ($path) {
    case '':
    case '/':
        echo "Welcome to homepage";
        break;
    case '/login':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case '/register':
        $controller = new AuthController();
        $controller->showRegister();
        break;
    default:
        http_response_code(404);
        echo "404 - Page not found";
        break;
}