<?php

define('APP_DIR', dirname(__DIR__));

require_once __DIR__.'/includeTemplate.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/core/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/user.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/AuthController.php';
