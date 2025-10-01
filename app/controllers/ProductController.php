<?php



class ProductController {
    
    public function showAdminPage(){
        require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin.php';
    }
    public function showQueryPage(){
        require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/query.php';
    }

    public static function create($name, $price, $colorName,$categoryName,$filepath) {
        $color_id=Color::findOrCreate($colorName);
        Product::createProduct($name, $price, $color_id, $categoryName,$filepath);
    }

    public static function getColors() {
        return Color::getAllColors();
    }
    public static function getCategories() {
        return Category::getAllCategories();
    }

}