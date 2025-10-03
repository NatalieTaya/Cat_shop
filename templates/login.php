<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

AuthController::redirect();

$showSuccess = false;
$showErrorAcceess = false;
$showErrorWrong = false;
$showError = false;

if (isset($_POST['authorization'])) {
    $email_form=$_POST['email'] ?? '';
    $password_form=$_POST['password'] ?? '';

    $user = User::findByEmail($email_form);

    if (    $user 
            && $user['is_active'] 
            && password_verify($password_form,$user['password']) 
            && !User::validateLogin($_POST)){
        $showSuccess=true;
        AuthController::auth($user['email'],$user['id']);
    } else if($user && ! $user['is_active'] ) {
        $showErrorAcceess = true;
    } else if (User::validateLogin($_POST)){
        $showErrorWrong = true;
    } else {
        $showError = true;
    }
}
?>

<?php includeTemplate('header.php'); ?>

<h2 class="title">Авторизация</h2>

    <?php if ($showSuccess) { includeTemplate('messages/success.php', ['message' => 'Доступ разрешен']);   }?>
    <?php if ($showErrorAcceess) { includeTemplate('messages/success.php', ['message' => 'Доступ запрещен']);} ?>
    <?php if ($showErrorWrong) { includeTemplate('messages/success.php', ['message' => 'Неверный пароль или логин']); } ?>
    <?php if ($showErrorWrong) { includeTemplate('messages/success.php', ['message' => User::validateLogin($_POST)]); } ?>
    <?php 
        if (!AuthController::isAuthorized()) {
            includeTemplate('auth/authorize.php');
        }
    ?>

<?php includeTemplate('footer.php'); ?>

