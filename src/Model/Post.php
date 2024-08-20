<?php
namespace App\Model;

use PDO;
use PDOException;

class Post {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function createPost($title, $content, $authorId) {
        $stmt = $this->db->prepare("INSERT INTO posts (title, content, author_id) VALUES (:title, :content, :authorId)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':authorId', $authorId);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function getPostById($id) {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllPosts() {
        $stmt = $this->db->prepare("SELECT * FROM posts");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePost($id, $title, $content) {
        $stmt = $this->db->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->execute();
    }

    public function deletePost($id) {
        $stmt = $this->db->prepare("DELETE FROM posts WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->execute();
    }
}
