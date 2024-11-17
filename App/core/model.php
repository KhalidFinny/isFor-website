<?php

use PDO;
use PDOException;

// ... existing code ...

class Model {
    protected $db;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $config = require 'App/config/config.php';
        $dbConfig = $config['database'];

        $dsn = "{$dbConfig['driver']}:host={$dbConfig['host']};dbname={$dbConfig['dbname']}";

        try {
            $this->db = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    // Additional common methods for database operations can be added here
}