<?php

require $_SERVER['DOCUMENT_ROOT'] . '/app/core/core.php';

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

<h2>Авторизация</h2>

    <?php 
        if ($showSuccess) { includeTemplate('messages/success.php');   }
    ?>
    <?php 
        if ($showErrorAcceess) {
      //      includeTemplate('messages/successAuthorize', ['message' => 'Доступ запрещен']);
        }
    ?>
    <?php 
        if ($showError) {
        //    includeTemplate('messages/successAuthorize', ['message' => 'Неверный пароль или логин']);
        }
    ?>
    <?php 
        if (!AuthController::isAuthorized()) {
            includeTemplate('messages/authorize.php');
        }
    ?>

<?php includeTemplate('footer.php'); ?>

