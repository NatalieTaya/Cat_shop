<?php

define('APP_DIR', dirname(__DIR__));

require_once __DIR__.'/includeTemplate.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/core/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/user.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/product.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/color.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/image.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/AuthController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/CartController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/ProductController.php';
