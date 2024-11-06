<?php


namespace app\services;

class RegisterService
{
    private \mysqli $connection;
    private string $table;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->table = 'users';
    }

    public function register(string $username, string $email, string $password, int $role_id = 2): bool
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query_check = "SELECT * FROM " . $this->table . " WHERE username = ? OR email = ?";
        $stmt_check = $this->connection->prepare($query_check);

        try {
            if (!$stmt_check) {
                throw new \Exception("Persiapan query gagal: " . $this->connection->error);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }

        $stmt_check->bind_param("ss", $username, $email);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            return false;
        }

        $query = "INSERT INTO " . $this->table . " (username, email, password, role_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);

        try {
            if (!$stmt) {
                throw new \Exception("Persiapan query gagal: " . $this->connection->error);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }

        $stmt->bind_param("sssi", $username, $email, $hashed_password, $role_id);

        return $stmt->execute();
    }

    public function getAllUsers(): array
    {
        $query = "SELECT user_id, username, email, role_id FROM " . $this->table;
        $stmt = $this->connection->prepare($query);

        if (!$stmt) {
            throw new \Exception("Persiapan query gagal: " . $this->connection->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        return $users;
    }

    public function getUserById(int $user_id): ?array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateUser(int $user_id, string $username, string $email, int $role_id): bool
    {
        $query = "UPDATE " . $this->table . " SET username = ?, email = ?, role_id = ? WHERE user_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssii", $username, $email, $role_id, $user_id);
        return $stmt->execute();
    }

    public function deleteUser(int $user_id): bool
    {
        $query = "DELETE FROM " . $this->table . " WHERE user_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }
}