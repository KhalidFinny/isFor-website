<?php

use Core\Database;
use PDO;
use PDOException;

class UserModel {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function addUser($data) {
        try {
            $query = "INSERT INTO users (username, password, role, avatar) VALUES (:username, :password, :role, :avatar)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $data['username']);
            $stmt->bindParam(':password', password_hash($data['password'], PASSWORD_BCRYPT));
            $stmt->bindParam(':role', $data['role']);
            $stmt->bindParam(':avatar', $data['avatar']);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function getUserByUsername($username) {
        try {
            $query = "SELECT * FROM users WHERE username = :username";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function checkUserExists($username) {
        $user = $this->getUserByUsername($username);
        return $user !== false;
    }
}