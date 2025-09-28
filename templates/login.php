<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require $_SERVER['DOCUMENT_ROOT'] . '/app/core/core.php';

AuthController::redirect();

$showSuccess = false;
$showErrorAcceess = false;
$showError = false;
        
if (isset($_POST['authorization'])) {
    $email_form=$_POST['email'] ?? '';
    $password_form=$_POST['password'] ?? '';

    $user = User::findByEmail($email_form);

    if ($user && $user['is_active'] && password_verify($password_form,$user['password'])){
        $showSuccess=true;
        AuthController::auth($user['email'],$user['id']);
    } else if(! $user['is_active']) {
        $showErrorAcceess = true;
    } else {
        $showError = true;
    }
}
?>

<?php includeTemplate('header.php'); ?>

<h2 class="title">Авторизация</h2>

    <?php if ($showSuccess) { includeTemplate('messages/success.php', ['message' => 'Доступ разрешен']);   }?>
    <?php if ($showErrorAcceess) { includeTemplate('messages/success.php', ['message' => 'Доступ запрещен']);} ?>
    <?php if ($showError) { includeTemplate('messages/success.php', ['message' => 'Неверный пароль или логин']); } ?>
    <?php 
        if (!AuthController::isAuthorized()) {
            includeTemplate('auth/authorize.php');
        }
    ?>

<?php includeTemplate('footer.php'); ?>

