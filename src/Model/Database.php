<?php
// Database.php
namespace App\Model;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();
        } catch (Exception $e) {
            die('Failed to load .env file: ' . $e->getMessage());
        }

        try {
            $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_NAME'];
            $this->pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}
