<?php

class UsersModel{
    private $table = 'users';
    private $db;


    public function __construct() {
        $this->db = new Database;
    }

    //fungsi untuk menambah user pertama kali jika di database tidak ada user

    // Cek apakah ada user dalam tabel
    public function checkUserExists() {
        $this->db->query("SELECT COUNT(*) AS user_count FROM users");
        $result = $this->db->single();
        return $result['user_count'] > 0;
    }

    // Fungsi untuk menambahkan user default
    public function addDefaultUser() {
        // Data user default
        $name = 'admin';
        $username = 'admin';
        $email = 'admin@example.com';
        $profile_picture = NULL;
        $password = password_hash('123', PASSWORD_BCRYPT); // Hash password default
        $role_id = 1; // Misalkan role 1 adalah admin

        // Query untuk memasukkan user default
        $this->db->query("INSERT INTO users (name, username, email, profile_picture, password, role_id) VALUES (:name, :username, :email, :profile_picture, :password, :role_id)");
        $this->db->bind(':name', $name);
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);
        $this->db->bind(':profile_picture', $profile_picture);
        $this->db->bind(':password', $password);
        $this->db->bind(':role_id', $role_id);
        $this->db->execute();
    }

    // fungsi menambah user pertama kali selesai------

    // fungsi mengambil seluruh data user
    public function getUser(){
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    // fungsi menambah user
    public function addUser($data, $photo){
        $query = "INSERT INTO users (name, username, password, email, profile_picture, role_id)
                    VALUES
                    (:name, :username, :password, :email, :profile_picture, :role)";

        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', password_hash($data['password'], PASSWORD_BCRYPT));
        $this->db->bind('email', $data['email']);
        $this->db->bind('profile_picture', $photo);
        $this->db->bind('role', $data['role']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    //fungsi mencari user berdasarkan username
    public function getUserByUsername($username){
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind(':username', $username);
        return $this->db->single();
    }

    //fungsi mencari user berdasarkan id
    public function getUserById($id){
        $this->db->query("SELECT * FROM users WHERE user_id = :user_id");
        $this->db->bind(':user_id', $id);
        return $this->db->single();
    }

    //fungsi menghapus img di file profile
    public function deleteImage($id){
        $this->db->query('SELECT profile_picture FROM users WHERE user_id = :user_id');
        $this->db->bind(':user_id', $id);
        return $this->db->single();
    }

    //fungsi menghapus user
    public function deleteUser($id){
        $this->db->query("DELETE FROM users WHERE user_id = :user_id");
        $this->db->bind(':user_id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    //fungsi mengedit user
    public function editUser($id, $data, $photo, $password){
        $query = "UPDATE users SET
                    name = :name,
                    username = :username,
                    password = :password,
                    email = :email,
                    profile_picture = :profile_picture,
                    role_id = :role_id
                    WHERE user_id = :user_id";

        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', $password);
        $this->db->bind('email', $data['email']);
        $this->db->bind('profile_picture', $photo);
        $this->db->bind('role_id', $data['role_id']);
        $this->db->bind('user_id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

}