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

}