<?php
// src/Model/BaseModel.php
namespace App\Model;

use PDO;
use PDOException;

class BaseModel {
    protected $db;

    /**
     * Constructor to initialize the database connections.
     */
    public function __construct() {
        // 여기에서 각 데이터베이스 연결을 초기화
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Execute a read-only SQL query with optional parameters and return the result.
     *
     * @param string $queryString The SQL query string.
     * @param array $params Parameters to bind to the SQL query.
     * @param bool $single Whether to return a single row or all rows.
     * @return array The query result set.
     */
    protected function executeReadQuery($queryString, $params = [], $single = false) {
        try {
            $stmt = $this->db->prepare($queryString);
            $stmt->execute($params);
            return $single ? $stmt->fetch(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Read Query Error: ' . $e->getMessage());
        }
    }

    /**
     * Execute a write SQL query with optional parameters and process the effect.
     *
     * @param string $queryString The SQL query string.
     * @param array $params Parameters to bind to the SQL query.
     * @return int The number of affected rows or last inserted ID.
     */
    protected function executeWriteQuery($queryString, $params = []) {
        try {
            $stmt = $this->db->prepare($queryString);
            $stmt->execute($params);
            return (strpos($queryString, 'INSERT') === 0) ? $this->db->lastInsertId() : $stmt->rowCount();
        } catch (PDOException $e) {
            die('Write Query Error: ' . $e->getMessage());
        }
    }
}
