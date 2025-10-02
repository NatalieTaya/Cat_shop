<?php

includeTemplate('header.php');


if (isset($_POST['submit_query'])) {
    $querytext=$_POST['name'] ?? '';
    $products = Product::getQueryProducts($querytext);
} else {
    $products = Product::getQueryProducts(null);
}


if (isset($_POST['extended_search'])) {
    $queryColors=$_POST['colors'] ?? '';
    $queryCategories=$_POST['categories'] ?? '';
    $querySlider=$_POST['price_range'] ?? '';
    $products = Product::getFilters($queryColors, $queryCategories, $querySlider);
}
?>

    <form class="form" method="post" >
        <input type="text" name="name">
        <button  type="submit" name="submit_query"><img src="/public/css/magnifying-glass-silhouette.png">  </button>
    </form>

<div class="products_window">
    <aside>
    <h2>Расширенный поиск </h2>
        <form id="form_extended_search" method="POST">
            <label class="label_search">Цена</label>
                <input type="text" name="minPrice">
                <input type="text" name="maxPrice">
            <label class="label_search">Цвет</label><br>
                <?php foreach($products['colors'] as $color) {?>
                    <input name="colors[]"  value="<?= $color['id'] ?>" type="checkbox" checked>
                    <label > <?= $color['color'] ?> </label><br>
                <?php }?>
            <label for="">Категория товара</label><br>        
                <?php foreach($products['categories'] as $category) {?>
                    <input name="categories[]" value="<?= $category['id'] ?>"  type="checkbox" checked>
                    <label > <?= $category['name'] ?> </label><br>
                <?php }?>
            <button type="submit" name="extended_search">Применить</button>
        </form>
    </aside>
    <?php   includeTemplate('products/product.php', ['products' => $products['products']]); ?>
</div>



<?php   includeTemplate('footer.php');  ?>

