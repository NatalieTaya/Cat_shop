<?php

class AuthController {
    public function showLogin() {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/login.php';
    }
    public function showRegister() {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/register.php';
    }

    public static function auth($email,$id) {
        session_start();
        $_SESSION['auth'] = true;
        $_SESSION['id'] = $id;
        setcookie('email', $email, [
            'expires' => time() + 3600 * 24 * 30,
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
    }
    public static function isAuthorized() {
        return (bool) ($_SESSION['auth'] ?? false);
    }
    public static function logout() {
        session_destroy();
        $_SESSION['auth'] = false;
        $_SESSION['id'] = '';
    }
    public static function redirect() {
        if (isset($_SESSION['auth'])) {
            header('Location: ' . '/');
            exit();
        }
    }

}