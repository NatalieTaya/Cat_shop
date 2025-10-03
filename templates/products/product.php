<div class="products_show">   
    <?php foreach ($products as $product) {?>
        <div class="product">
            <h3 class="product_name"> <?= $product['name']?>  </h3>
            <div class="product_image"> <img src="<?= $product['filepath']?>" alt="" height="300"> </div>
            <p class="product_cost"> <?= $product['price']?> Р </p>
            <form action="" method="post">
                <button type="submit">Добавить в корзину</button>
            </form>
        </div>
    <?php }?>
</div>    
