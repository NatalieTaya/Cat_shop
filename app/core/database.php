<?php 

class Database {
    private $connection;
    private static $instance = null;

    private function __construct() {
        $config = require $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
        try {
            $this->connection = new PDO(
                "mysql:host={$config['hostname']};
                port=3307;
                dbname={$config['database']}",
                $config['username'],
                $config['password'] 
            );
        } catch (\Throwable $th) {
            die("Database connection error: " . $th->getMessage());
        }
    }
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function getConnection() {
        return $this->connection;
    }
}