<?php

namespace Service;

use Model\User;

class UserService
{

    private \mysqli $connection;
    private string $table;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->table = 'users';
    }

    public function register(string $username, string $email, string $password): bool
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query_check = "SELECT * FROM " . $this->table . " WHERE username = ? OR email = ?";
        $stmt_check = $this->connection->prepare($query_check);

        try {
            $stmt_check = $this->connection->prepare($query_check);
            if (!$stmt_check) {
                throw new \Exception("Query preparation failed: " . $this->connection->error);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }


        $stmt_check->bind_param("ss", $username, $email);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            return false;
        }

        $query = "INSERT INTO " . $this->table . " (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($query);

        try {
            $stmt_check = $this->connection->prepare($query_check);
            if (!$stmt_check) {
                throw new \Exception("Query preparation failed: " . $this->connection->error);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }


        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function login(string $username, string $password): array|bool
    {
        $query = "SELECT * FROM " . $this->table . " WHERE username = ?";
        $stmt = $this->connection->prepare($query);

        if (!$stmt) {
            die("Query preparation failed: " . $this->connection->error);
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }
}