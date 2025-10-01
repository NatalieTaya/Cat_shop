<?php

class Image {
    public $id;
    public $filepath;
    private $db;
    
    public function __construct() {
        $this->db=Database::getInstance()->getConnection();
    }

    public static function create($filepath,$product_id){
        $instance = new self();
        $stmt=$instance->db->prepare('INSERT INTO images (`filepath`,`product_id`) 
                                        VALUES (:filepath, :product_id) ');
        $stmt->bindParam(':filepath', $filepath);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        return  $instance->db->lastInsertId();
    }

    public static function getImage()  {
        $instance = new self();
        $stmt = $instance->db->prepare('SELECT filepath FROM images');
        $stmt->execute();
        $colors = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $colors;
    }
}