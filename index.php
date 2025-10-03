<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require $_SERVER['DOCUMENT_ROOT'] . '/app/core/core.php';


session_start();

$controllerPath = $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/AuthController.php';
require_once $controllerPath;
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
$path = rtrim($path, '/');


switch ($path) {
    case '':
    case '/':
        require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/index.php';
        break;
    case '/login':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case '/register':
        $controller = new AuthController();
        $controller->showRegister();
        break;
    case '/logout':
        AuthController::logout();
        AuthController::redirect();
        break;
    case '/admin':
        $controller = new ProductController();
        $controller->showAdminPage();
        break;
    case '/query':
        $controller = new ProductController();
        $controller->showQueryPage();
        break;
    case '/cart':
        $controller = new CartController();
        $controller->showCartPage();
        break;
    default:
        http_response_code(404);
        echo "404 - Page not found";
        break;
}