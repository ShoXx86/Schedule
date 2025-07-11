<?php
class Database {
    private static $instance = null;
    private $conn;

    private $host = 'database-5018200052.webspace-host.com'; // Host
    private $user = 'dbu2502342'; // Username
    private $pass = 'Schedule-DomeJason002'; // PW
    private $name = 'dbs14423634'; // DataBase Name

    private function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Verbindung hergestellt";  
        } catch(PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}







