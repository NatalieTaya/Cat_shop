<?php

includeTemplate('header.php');

$filtered = false;

if (isset($_POST['submit_query'])) {
    $querytext=$_POST['name'] ?? '';
    $products = Product::getQueryProducts($querytext);
    $filtered = false;
} else {
    $products = Product::getQueryProducts(null);
    if ($products) {
        $filtered = false;
    }
}

if (isset($_POST['extended_search'])) {
    $queryColors=$_POST['colors'] ?? '';
    $queryCategories=$_POST['categories'] ?? '';
    $querySlider=$_POST['price_range'] ?? '';
    $products_filtered = Product::getFilters($queryColors, $queryCategories, $querySlider);
    $filtered = true;
}
?>

<div class="form-container">
    <form class="submit_query_form" method="post" >
        <input type="text" name="name"><!--
     --><button  type="submit" name="submit_query"><img src="/public/css/icon.png">  </button>
    </form>
</div>


<div class="products_window">
    <?php if ($products) { 
        includeTemplate('products/extended_search.php', ['products' => $products]); 
    } ?> 
    
    <?php   
    if ($products && !$filtered) {
        includeTemplate('products/product.php', ['products' => $products['products']]); 
    } else if (!$products){
        includeTemplate('messages/product_msg.php', ['message' => 'По вашему запросу ничего не нашли']); 
    } else if(gettype($products_filtered)=='string'){
        includeTemplate('messages/product_msg.php', ['message' => $products_filtered]); 
    } else if(gettype($products_filtered)=='array'){
        includeTemplate('products/product.php', ['products' => $products_filtered['products']]); 
    } 
    
    ?>
</div>



<?php   includeTemplate('footer.php');  ?>

