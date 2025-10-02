<?php

class Product{
    private $id;
    private $name;
    private $price;
    private $color_id;

    private $db;

    public function __construct() {
        $this->db=Database::getInstance()->getConnection();
    }

    public static function createProduct($name, $price, $color_id, $categoryName,$filepath){
        $instance = new self();
        $stmt = $instance->db->prepare('INSERT INTO products (`name`, `price`, `color_id`) 
                                            VALUES (:name, :price, :color_id) ');
        $stmt->bindParam(':name', $name);      
        $stmt->bindParam(':price', $price);                                    
        $stmt->bindParam(':color_id', $color_id);                                    
        $stmt->execute();
        $product_id = $instance->db->lastInsertId();

        Image::create($filepath,$product_id);
        $category_id = Category::findOrCreate($categoryName);

        $stmt = $instance->db->prepare("INSERT INTO product_category (`product_id`, `category_id`)
                                                 VALUES (:product_id, :category_id)");
        $stmt->bindParam(':product_id', $product_id);      
        $stmt->bindParam(':category_id', $category_id); 
        $stmt->execute();
    }

    public static function getQueryProducts($name=null) {
        $instance = new self();
        $sql = 'SELECT  products.id as product_id,
                        products.name,
                        products.price, 
                        images.id as image_id,
                        images.filepath
                FROM products JOIN images ON images.product_id = products.id ';
        if ($name!=null) {
            $sql .= 'WHERE name REGEXP :name';
        } else {
            $sql .= 'ORDER BY RAND()';
        };                                
        $stmt= $instance->db->prepare($sql);   
        if ($name!=null) {
            $stmt->bindParam(':name', $name);                    
        }  
        $stmt->execute();
        $products = $stmt->fetchAll();

        // getting array of colors
        $productIds = array_column($products, 'product_id');
        $placeholders = str_repeat('?,', count($productIds) - 1) . '?';
        $sql = "SELECT DISTINCT colors.color, colors.id 
                FROM products 
                JOIN colors ON colors.id = products.color_id 
                WHERE products.id IN ($placeholders)";
        $stmt = $instance->db->prepare($sql);
        $stmt->execute($productIds);
        $colors = $stmt->fetchAll();

        // getting array of categories
        $sql = "SELECT DISTINCT categories.name , categories.id
                FROM product_category
                JOIN categories ON categories.id = product_category.category_id 
                WHERE product_category.product_id IN ($placeholders)";
        $stmt = $instance->db->prepare($sql);
        $stmt->execute($productIds);
        $categories = $stmt->fetchAll();

        $_SESSION['query_products_id'] = $productIds;
        $_SESSION['query_products_colors'] = $colors;
        $_SESSION['query_products_categories'] = $categories;

        return [
            'products' => $products,
            'colors' => $colors,
            'categories' => $categories
        ];
    }    

    public static function getFilters ($colorIds, $categoriesIds, $maxCost) {
        $product_IDs = $_SESSION['query_products_id'];

        $placeholders_prod = str_repeat('?,', count($product_IDs) - 1) . '?';
        $placeholders_colors = str_repeat('?,', count($colorIds) - 1) . '?';
        $placeholders_categories = str_repeat('?,', count($categoriesIds) - 1) . '?';
        $params = array_merge($product_IDs, $colorIds,$categoriesIds);

        $instance = new self(); 
        $sql = "SELECT  products.id as product_id,
                        products.name,
                        products.price, 
                        images.id as image_id,
                        images.filepath
                FROM products 
                JOIN images ON images.product_id = products.id
                JOIN product_category ON product_category.product_id = products.id
                WHERE products.id IN ($placeholders_prod) 
                AND products.color_id IN ($placeholders_colors)
                AND product_category.category_id IN ($placeholders_categories)";
        $stmt = $instance->db->prepare($sql);
        $stmt->execute($params);
        $products = $stmt->fetchAll();
        return [
            'products' => $products,
            'colors' => $_SESSION['query_products_colors'],
            'categories' => $_SESSION['query_products_categories']
        ];        
    }
}