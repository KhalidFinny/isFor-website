<?php

namespace app\services;

class LoginService
{
    private \mysqli $connection;
    private string $table;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->table = 'users';
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
