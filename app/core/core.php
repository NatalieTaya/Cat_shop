<?php

define('APP_DIR', dirname(__DIR__));

require __DIR__.'/includeTemplate.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/core/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/user.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/AuthController.php';
