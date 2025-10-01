<form action="" class="form-register" method="post" enctype="multipart/form-data" >
    <div class="">
        <label for="name" class="form-label">Название товара</label>
        <input id="name" name="name" autocomplete="nope">
    </div>
    <div class="">
        <label for="price" class="form-label">Цена</label>
        <input id="price" name="price" autocomplete="off">
    </div>
    <div class="">
        <label for="color" class="form-label">Цвет</label>
        <input id="color" list="color-list" name="color" autocomplete="off">
        <datalist id="color-list">
            <?php foreach($colors as $color) {?>
                <option value="<?= $color ?>">
            <?php }?>
        </datalist>
    </div>
    <div class="">
        <label for="category" class="form-label">Категория товара</label>
        <input id="category" list="category-list" name="category" autocomplete="off">
        <datalist id="category-list">
            <?php foreach($categories as $category) {?>
                <option value="<?= $category ?>">
            <?php }?>
        </datalist>
    </div>
    <div class="">
        <label for="image" class="form-label">Изображение</label>
        <input type="file" id="image" name="image" accept="image/*" class="form-control">
    </div>
    <button type="submit" name="create_product">Создать товар</button>
</form>