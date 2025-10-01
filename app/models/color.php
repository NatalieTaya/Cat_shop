<?php

class Color {
    public $id;
    public $name;
    private $db;
    
    public function __construct() {
        $this->db=Database::getInstance()->getConnection();
    }

    public static function findOrCreate($colorName){
        $instance = new self();
        $stmt = $instance->db->prepare('SELECT * FROM colors WHERE color = :color');
        $stmt->bindParam(':color', $colorName);
        $stmt->execute();
        $color = $stmt->fetch();
        if($color) {
            return $color['id'];
        }

        $stmt=$instance->db->prepare('INSERT INTO colors (`color`) 
                                        VALUES (:color) ');
        $stmt->bindParam(':color', $colorName);
        $stmt->execute();
        return  $instance->db->lastInsertId();
    }

    public static function getAllColors()  {
        $instance = new self();
        $stmt = $instance->db->prepare('SELECT color FROM colors');
        $stmt->execute();
        $colors = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $colors;
    }
}