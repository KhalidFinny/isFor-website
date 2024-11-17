<?php
namespace Core;
use PDO;
use PDOException;

class Database extends \PDO {
    private $host = 'localhost';
    private $dbname = 'isfordb';
    private $username = 'root';
    private $password = '';

    public function __construct() {
        try {
            parent::__construct(
                "mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (\PDOException $e) {
            throw new \PDOException("Connection failed: " . $e->getMessage());
        }
    }
}