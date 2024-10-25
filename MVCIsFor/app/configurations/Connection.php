<?php

namespace app\configurations;

class Connection
{
    private ?\mysqli $connection = null;
    private string $host = "localhost";
    private string $db_name = "isfor";
    private string $username = "root";
    private string $password = "";

    public function getConnection(): ?\mysqli
    {
        try {
            $this->connection = new \mysqli($this->host, $this->username, $this->password, $this->db_name);
            if ($this->connection->connect_error) {
                throw new \Exception("Connection failed: " . $this->connection->connect_error);
            }
        } catch (\Exception $e) {
            echo "Connection error: " . $e->getMessage();
        }

        return $this->connection;
    }
}
