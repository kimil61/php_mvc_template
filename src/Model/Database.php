<?php
// Database.php
namespace App\Model;

use PDO;
use PDOException;
use Dotenv\Dotenv;
class Database {
    private static $instance = null;
    private $readPdo;
    private $writePdo;

    private function __construct() {
        $this->connect();
    }

    private function connect() {
        try {
            Dotenv::createImmutable(__DIR__ . '/../../')->load();
            $readDsn = 'mysql:host=' . $_ENV['DB_READ_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_NAME'];
            $writeDsn = 'mysql:host=' . $_ENV['DB_WRITE_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_NAME'];
            $this->readPdo = new PDO($readDsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            $this->writePdo = new PDO($writeDsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
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

    public function getReadConnection() {
        return $this->readPdo;
    }

    public function getWriteConnection() {
        return $this->writePdo;
    }
}
