<?php
// /src/Model/User.php
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
    public function createUser($username, $email) {
        $queryString = "INSERT INTO users (username, email) VALUES (:username, :email)";
        $params = [
            ':username' => $username,
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
    public function updateUser($id, $username, $email) {
        $queryString = "UPDATE users SET username = :username, email = :email WHERE id = :id";
        $params = [
            ':id' => $id,
            ':username' => $username,
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
