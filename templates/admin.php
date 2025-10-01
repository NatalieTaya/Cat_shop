<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$is_created=false;
$colors = ProductController::getColors();
$categories = ProductController::getCategories();

if(isset($_POST['create_product'])) {
    $name=$_POST['name'] ?? '';
    $price=$_POST['price'] ?? '';
    $colorName= $_POST['color'] ?? '';
    $category=$_POST['category'] ?? '';

    // uploading pics
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/public/images/';
    $file = $_FILES['image'];
    $fileName = basename($file['name']);
    $filePath = $uploadDir . $fileName;
    $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    // generating unique filename
    $newFileName = uniqid() . '.' . $fileType;
    $newFilePath = $uploadDir . $newFileName;
    if (move_uploaded_file($file['tmp_name'], $newFilePath)) {
        echo "Изображение успешно загружено: " . $newFileName;
    } else {
        echo "Ошибка при загрузке файла.";
    }

    // Преобразуем абсолютный путь в относительный URL
    $normalizedPath = str_replace('\\', '/', $newFilePath);
    $webPath = str_replace('D:/MyWeb/Cat_shop/', '/', $normalizedPath);

    $result = ProductController::create($name, $price, $colorName,$category, $webPath);
    $is_created=true;

}
?>

<?php includeTemplate('header.php'); ?>

<h2 class="title">Создание нового товара</h2>

<?php if($is_created) {
    includeTemplate('messages/success.php', ['message' => 'Товар добавлен в магазин']);
}

    includeTemplate('products/creation_form.php',['colors' => $colors, 'categories' => $categories]);
?>

<?php includeTemplate('footer.php'); ?>