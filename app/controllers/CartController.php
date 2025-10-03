<?php

class CartController {
    public function showCartPage(){
        require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/cart.php';
    }

}