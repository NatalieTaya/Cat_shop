<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require $_SERVER['DOCUMENT_ROOT'] . '/app/core/core.php';

AuthController::redirect();

$is_created=false;

if(isset($_POST['registration'])) {
    $email=$_POST['email'] ?? '';
    $password=$_POST['password'] ?? '';
    $first_name=$_POST['first_name'] ?? '';
    $last_name=$_POST['last_name'] ?? '';
    $is_active=1;
    $is_admin=0;
    
    $result = User::createUser($email,$password,$first_name, $last_name, $is_active, $is_admin);
    $is_created=true;

}
?>

<?php includeTemplate('header.php'); ?>

<h2 class="title">Регистрация</h2>

<?php if($is_created) {
    includeTemplate('messages/success.php', ['message' => 'Пользователь создан']);
} else if(!$is_created) {
    includeTemplate('auth/register.php');
} ?>

<?php includeTemplate('footer.php'); ?>