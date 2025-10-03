<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

AuthController::redirect();

$showSuccess = false;
$showError = false;

if(isset($_POST['registration'])) {
    $email=$_POST['email'] ?? '';
    $password=$_POST['password'] ?? '';
    $first_name=$_POST['first_name'] ?? '';
    $last_name=$_POST['last_name'] ?? '';
    $is_active=1;
    $is_admin=0;
    
    if (!User::validateRegister($_POST)) {
        $result = User::createUser($email,$password,$first_name, $last_name, $is_active, $is_admin);
        $showSuccess=true;
    } else {
        $showError=true;
    }

}
?>

<?php includeTemplate('header.php'); ?>

<h2 class="title">Регистрация</h2>

<?php if($showSuccess) {
    includeTemplate('messages/success.php', ['message' => 'Пользователь создан']);
} else if($showError) {
    includeTemplate('messages/error.php', ['message' => User::validateRegister($_POST)]);
} ?> 
<?php includeTemplate('auth/register.php'); ?>



<?php includeTemplate('footer.php'); ?>