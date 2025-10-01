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

    public static function getProducts() {
        $instance = new self();
        $stmt = $instance->db->prepare('SELECT * FROM products JOIN images ON images.product_id = products.id');                          
        $stmt->execute();
        return $stmt->fetchAll();
    }
        

}