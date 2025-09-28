<?php

class User {
    private $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    public static function findByEmail($email) {
        $instance = new self();
        $stmt = $instance->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }
    public static function createUser($email,$password,$first_name, $last_name, $is_active=1, $is_admin=0) {
        $instance = new self();
        $stmt = $instance->db->prepare("INSERT INTO users (`email`, `password`, `first_name`, `last_name`, `is_active`, `is_admin`) 
                                    VALUES (:email, :password, :first_name, :last_name, :is_active, :is_admin)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':is_active', $is_active);
        $stmt->bindParam(':is_admin', $is_admin);
        if ($stmt->execute()) {
            return true;
        } else {
            // Вывести ошибку для отладки
            print_r($stmt->errorInfo());
            return false;
        }
    }
}