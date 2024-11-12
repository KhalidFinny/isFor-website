<?php

class User_Model{
    private $table = 'users';
    private $db;


    public function __construct() {
        $this->db = new Database;
    }

    // Cek apakah ada user dalam tabel
    public function checkUserExists() {
        $this->db->query("SELECT COUNT(*) AS user_count FROM users");
        $result = $this->db->single();
        return $result['user_count'] > 0;
    }

    // Fungsi untuk menambahkan user default
    public function addDefaultUser() {
        // Data user default
        $username = 'admin';
        $email = 'admin@example.com';
        $password = password_hash('123', PASSWORD_BCRYPT); // Hash password default
        $role_id = 1; // Misalkan role 1 adalah admin

        // Query untuk memasukkan user default
        $this->db->query("INSERT INTO users (username, email, password, role_id) VALUES (:username, :email, :password, :role_id)");
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);
        $this->db->bind(':role_id', $role_id);
        $this->db->execute();
    }


    public function getUser(){
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function addUser($data){
        $query = "INSERT INTO users (username, password, email, role_id)
                    VALUES
                    (:username, :password, :email, :role)";

        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', password_hash($data['password'], PASSWORD_BCRYPT));
        $this->db->bind('email', $data['email']);
        $this->db->bind('role', $data['role']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getUserByUsername($username){
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind(':username', $username);
        return $this->db->single();
        
        // $nilai = $this->db->single();
        // var_dump($nilai);
        // exit();
    }
}