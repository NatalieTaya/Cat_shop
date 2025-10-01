<div class="products_show">   
    <?php foreach ($products as $product) {?>
        <div class="">
            <h3> <?= $product['name']?>  </h3>
            <div> <img src="<?= $product['filepath']?>" alt="" height="300"> </div>
            <p> <?= $product['price']?> </p>
        </div>
    <?php }?>
</div>    
