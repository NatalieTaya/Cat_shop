<?php

class Cart {
    public $db;
    public function __construct() {
        $this->db=Database::getInstance()->getConnection();
    }
    public function getCartId() {
        $instance = new self();
        // getting id of the cart
        if ($_SESSION['auth']) {
            $sql = "SELECT id FROM carts 
                    WHERE user_id = :user_id";
            $stmt = $instance->db->prepare( $sql);
            $stmt -> bindParam(':user_id', $_SESSION['id']);
            $stmt->execute(); 
            return $cart_id = $stmt->fetchColumn();
        } else {
            return 'Авторизуйтесь';
        }
    }
    public function findItem($cart_id, $product_id) {
        $instance = new self();
        // seeing if the item is already in the cart 
        $sql = "SELECT * FROM cart_items 
                WHERE cart_id = :cart_id AND product_id = :product_id";
        $stmt = $instance->db->prepare( $sql);
        $stmt -> bindParam(':cart_id', $cart_id);
        $stmt -> bindParam(':product_id', $product_id);
        $stmt->execute();
        return $result = $stmt->fetch();
    }
    public function getQuantity($cartItem, $cart_id,$product_id) {
        $instance = new self();
        // getting id of the cart
        return $cartItem['quantity'];
    }
    public function addToCart($cartItem, $cart_id, $product_id) {
        $instance = new self();

        if ($cartItem) {
            // increase quantity if added
            $quantity = $cartItem['quantity'] + 1;
            $sql = "UPDATE cart_items 
                    SET quantity = ? 
                    WHERE cart_id = {$cart_id} 
                    AND product_id = {$product_id}";
            $stmt = $instance->db->prepare( $sql);
            $stmt->execute([$quantity]); 
        } else {
            // add for the firs time
            $params =[1,$product_id,$cart_id];
            $sql = "INSERT INTO cart_items (`quantity`,`product_id`,`cart_id`)
                    VALUES (?,?,?)";
            $stmt = $instance->db->prepare( $sql);
            $stmt->execute($params); 
        }


        
    }
    public function removeFromCart($cartItem,$cart_id,$product_id) {
        $instance = new self();

        if ($cartItem) {
            // decrease quantity if added
            $quantity = $cartItem['quantity'] - 1;
            if ($quantity == 0){
                $sql = "DELETE FROM cart_items 
                        WHERE cart_id = :cart_id 
                        AND product_id = :product_id";
                $stmt = $instance->db->prepare($sql);
                $stmt->execute([
                    'cart_id' => $cart_id,
                    'product_id' => $product_id
                ]);
            } else {
                $sql = "UPDATE cart_items 
                        SET quantity = ? 
                        WHERE cart_id = {$cart_id} 
                        AND product_id = {$product_id}";
                $stmt = $instance->db->prepare( $sql);
                $stmt->execute([$quantity]); 
            }
            
        } 
    }

    public function showAllItems() {
        $instance= new self();

        $sql = "SELECT 
                    cart_items.quantity, 
                    products.id as product_id,
                    products.name,
                    products.price,
                    images.filepath
                FROM cart_items 
                JOIN products ON cart_items.product_id = products.id   
                JOIN images ON products.id = images.product_id
                JOIN carts ON cart_items.cart_id = carts.id
                WHERE carts.user_id = {$_SESSION['id']}";
        $stmt = $instance->db->prepare( $sql);
        $stmt->execute();      
        return $stmt->fetchAll();
    }
}
