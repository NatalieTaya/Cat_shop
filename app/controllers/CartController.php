<?php

class CartController {
    private $cart;
    public function showCartPage(){
        require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/cart.php';
    }
    public function __construct(){
        $this->cart = new Cart();
    }




    public function addorRemove(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['add_cart_button']) || isset($_POST['add_plus'])) {
                $product_id=$_POST['product_id'] ?? '';
                $cart_id = $this->cart->getCartId();
                $cartItem = $this->cart->findItem($cart_id, $product_id);
                $this->cart->addToCart($cartItem, $cart_id, $product_id);
            } elseif (isset($_POST['add_minus'])) {
                $product_id=$_POST['product_id'] ?? '';
                $cart_id = $this->cart->getCartId();
                $cartItem = $this->cart->findItem($cart_id, $product_id);
                $this->cart->removeFromCart($cartItem, $cart_id, $product_id);
            }
        } 
    }

    public function quantity($product_id){
        $cart_id = $this->cart->getCartId();
        $cartItem = $this->cart->findItem($cart_id, $product_id);
        return $quantity = $this->cart->getQuantity($cartItem, $cart_id, $product_id);
    }
    public function findItem($product_id){
        $cart_id = $this->cart->getCartId();
        return $cartItem = $this->cart->findItem($cart_id, $product_id);
    }

    public function getCart(){
        return $this->cart->showAllItems();
    }
}