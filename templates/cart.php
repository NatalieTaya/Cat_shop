<?php

includeTemplate('header.php');

$cartController = new CartController();
$products = $cartController->getCart();
$cartController->addorRemove();
?>

<h2 class="title">Корзина</h2>

<div class="products_window">
    <?php if ($products) { 
        includeTemplate('products/cart_products.php', ['products' => $products, 'cartController' => $cartController]); 
    } ?> 
    
</div>




<?php includeTemplate('footer.php'); ?>

