<?php
namespace App\Model;

class Post extends BaseModel {

    /**
     * Retrieve all posts from the database.
     * @return array
     */
    public function getAllPosts() {
        $queryString = "SELECT * FROM posts";
        return $this->executeReadQuery($queryString);
    }

    /**
     * Retrieve a single post by ID.
     * @param int $postId
     * @return array
     */
    public function getPostById($postId) {
        $queryString = "SELECT * FROM posts WHERE id = :id";
        return $this->executeReadQuery($queryString, [':id' => $postId], true);
    }

    /**
     * Insert a new post into the database.
     * @param string $title
     * @param string $content
     * @param int $authorId
     * @return int The last inserted ID.
     */
    public function createPost($title, $content, $authorId) {
        $queryString = "INSERT INTO posts (title, content, author_id) VALUES (:title, :content, :author_id)";
        $params = [
            ':title' => $title,
            ':content' => $content,
            ':author_id' => $authorId
        ];
        return $this->executeWriteQuery($queryString, $params);
    }

    /**
     * Update an existing post.
     * @param int $postId
     * @param string $title
     * @param string $content
     * @return int The number of affected rows.
     */
    public function updatePost($postId, $title, $content) {
        $queryString = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
        $params = [
            ':id' => $postId,
            ':title' => $title,
            ':content' => $content
        ];
        return $this->executeWriteQuery($queryString, $params);
    }

    /**
     * Delete a post by ID.
     * @param int $postId
     * @return int The number of affected rows.
     */
    public function deletePost($postId) {
        $queryString = "DELETE FROM posts WHERE id = :id";
        return $this->executeWriteQuery($queryString, [':id' => $postId]);
    }
}
