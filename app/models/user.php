<?php

class User {
    private $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    public static function isAdmin($id) {
        $instance = new self();
        $stmt = $instance->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['is_admin'];
    }

    public static function findById($id) {
        $instance = new self();
        $stmt = $instance->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
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
            $sql = "INSERT INTO carts (`user_id`)
            VALUES (?)";
            $stmt = $instance->db->prepare( $sql);
            $stmt->execute([$_SESSION['id']]);
            return true; 
        } else {
            print_r($stmt->errorInfo());
            return false;
        }
    }
    public static function validateLogin(array $fields) {
        if (empty($fields['email'])) {
            return 'Введите email';
        }
        if (empty($fields['password'])) {
            return 'Введите пароль';
        }
        return false;
    }
    public static function validateRegister(array $fields) {
        if (empty($fields['email'])) {
            return 'Введите email';
        }
        if (empty($fields['password'])) {
            return 'Введите пароль';
        }
        if (empty($fields['first_name'])) {
            return 'Введите имя';
        }
        if (empty($fields['last_name'])) {
            return 'Введите фамилию';
        }
        if ($fields['password'] != $fields['repeat_password']) {
            return 'Пароли не совпадают';
        }
        return false;
    }
    
}