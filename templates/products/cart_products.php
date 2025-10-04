<div class="products_show">   
    <?php foreach ($products as $product) { ?>
        <div class="product">
            <div class="product_image"> <img src="<?= $product['filepath']?>" alt="" height="300"> </div>
            <h3 class="product_name"> <?= $product['name']?>  </h3>
            <p class="product_cost"> <?= $product['price']?> ₽ </p>
            <form class="add_cart_form" action="" method="post">
                <input type="hidden" name="product_id" value="<?=$product['product_id']?>">
                <?php if ( $cartController->findItem($product['product_id']) &&
                            !(int)$cartController->quantity($product['product_id'])==0) { ?>
                    <button class="add_plus" name="add_minus" type="submit">-</button>
                    <p class="quantity"> <?= (int)$cartController->quantity($product['product_id'])?> </p>
                    <button class="add_minus" name="add_plus" type="submit">+</button>
                    <button class="remove_cart_button" name="remove_cart_button" type="submit">Убрать из корзины</button>
                <?php } ?>
            </form>
        </div>
    <?php }?>
</div>    
