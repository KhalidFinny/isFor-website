<?php
//// sql server
//class Database {
//    private $host = DB_HOST;
//    private $user = DB_USER;
//    private $pass = DB_PASS;
//    private $db_name = DB_NAME;
//
//    private $dbh;
//    private $stmt;
//
//    public function __construct() {
//        $dsn = "sqlsrv:Server={$this->host};Database={$this->db_name};Encrypt=false";
//
//        $options = [
//            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//        ];
//
//        try {
//            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
//        } catch (PDOException $e) {
//            die("Connection failed: " . $e->getMessage());
//        }
//    }
//
//    public function query($query) {
//        $this->stmt = $this->dbh->prepare($query);
//    }
//
//    public function bind($param, $value, $type = null) {
//        if (is_null($type)) {
//            switch (true) {
//                case is_int($value):
//                    $type = PDO::PARAM_INT;
//                    break;
//                case is_bool($value):
//                    $type = PDO::PARAM_BOOL;
//                    break;
//                case is_null($value):
//                    $type = PDO::PARAM_NULL;
//                    break;
//                default:
//                    $type = PDO::PARAM_STR;
//            }
//        }
//        $this->stmt->bindValue($param, $value, $type);
//    }
//
//    public function execute() {
//        $this->stmt->execute();
//    }
//
//    public function resultSet() {
//        $this->execute();
//        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
//    }
//
//    public function single() {
//        $this->execute();
//        return $this->stmt->fetch(PDO::FETCH_ASSOC);
//    }
//
//    public function rowCount() {
//        return $this->stmt->rowCount();
//    }
//
//    public function nextRowset() {
//        return $this->stmt->nextRowset();
//    }
//
//    public function getLastQuery()
//    {
//        return $this->stmt->queryString;
//    }
//
//    public function getLastCountQuery()
//    {
//        return $this->stmt->queryString;
//    }
//}


// mysql
class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    private $dbh;
    private $stmt;

    public function __construct()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            die("Koneksi gagal: " . $e->getMessage());
        }
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        $this->stmt->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    public function nextRowset()
    {
        return $this->stmt->nextRowset();
    }

    public function getLastQuery()
    {
        return $this->stmt->queryString;
    }

    public function getLastCountQuery()
    {
        return $this->stmt->queryString;
    }
}

