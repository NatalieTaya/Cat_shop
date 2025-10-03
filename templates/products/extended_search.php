<aside>
<h2>Расширенный поиск </h2>
    <form id="form_extended_search" method="POST">
        <div class="extended_param">
            <label class="label_search">Цена</label><br> 
            <label class="label_price">От</label>    <input type="text" class="extendedInp" name="minPrice">
            <label class="label_price">До</label>    <input type="text" class="extendedInp" name="maxPrice">
        </div>
        <div class="extended_param">
            <label class="label_search">Цвет</label><br> 
            <?php foreach($products['colors'] as $color) {?>
                <input name="colors[]"  value="<?= $color['id'] ?>" class="extendedInp" type="checkbox" >
                <label > <?= $color['color'] ?> </label><br>
            <?php }?>
        </div>
        <div class="extended_param">
            <label for="">Категория товара</label><br>        
            <?php foreach($products['categories'] as $category) {?>
                <input name="categories[]" value="<?= $category['id'] ?>"   class="extendedInp" type="checkbox" >
                <label > <?= $category['name'] ?> </label><br>
            <?php }?>
        </div>
        <button type="submit"  name="extended_search">Применить</button>
    </form>
</aside>