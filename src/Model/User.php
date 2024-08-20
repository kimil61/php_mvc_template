<?php
// User.php
namespace App\Model;

class User extends BaseModel {

    /**
     * Retrieve all users from the database.
     * @return array
     */
    public function getAllUsers() {
        $queryString = "SELECT * FROM users";
        return $this->executeReadQuery($queryString);
    }

    /**
     * Retrieve a single user by ID.
     * @param int $id
     * @return array
     */
    public function getUserById($id) {
        $queryString = "SELECT * FROM users WHERE id = :id";
        return $this->executeReadQuery($queryString, [':id' => $id], true);
    }

    /**
     * Insert a new user into the database.
     * @param string $name
     * @param string $email
     * @return int The last inserted ID.
     */
    public function createUser($name, $email) {
        $queryString = "INSERT INTO users (name, email) VALUES (:name, :email)";
        $params = [
            ':name' => $name,
            ':email' => $email
        ];
        return $this->executeWriteQuery($queryString, $params);
    }

    /**
     * Update an existing user.
     * @param int $id
     * @param string $name
     * @param string $email
     * @return int The number of affected rows.
     */
    public function updateUser($id, $name, $email) {
        $queryString = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $params = [
            ':id' => $id,
            ':name' => $name,
            ':email' => $email
        ];
        return $this->executeWriteQuery($queryString, $params);
    }

    /**
     * Delete a user by ID.
     * @param int $id
     * @return int The number of affected rows.
     */
    public function deleteUser($id) {
        $queryString = "DELETE FROM users WHERE id = :id";
        return $this->executeWriteQuery($queryString, [':id' => $id]);
    }
}
