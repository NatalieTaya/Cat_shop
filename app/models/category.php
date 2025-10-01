<?php

class Category {
    public $id;
    public $name;
    private $db;

    public function __construct() {
        $this->db=Database::getInstance()->getConnection();
    }

    public static function findOrCreate($categoryName){
        $instance = new self();
        $stmt = $instance->db->prepare('SELECT * FROM categories WHERE name = :name');
        $stmt->bindParam(':name', $categoryName);
        $stmt->execute();
        $category = $stmt->fetch();

        if($category) {
            return (int)[$category['id']];
        }

        $stmt=$instance->db->prepare('INSERT INTO categories (`name`) 
                                        VALUES (:name) ');
        $stmt->bindParam(':name', $categoryName);
        $stmt->execute();
        return $instance->db->lastInsertId();
    }

    public static function getAllCategories()  {
        $instance = new self();
        $stmt = $instance->db->prepare('SELECT name FROM categories');
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $categories;
    }
}