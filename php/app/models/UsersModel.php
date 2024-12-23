<?php

class UsersModel
{
    private $table = 'users';
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    // Cek apakah ada user dalam tabel
    public function checkUserExists()
    {
        $this->db->query('EXEC sp_CheckUserExists');
        $result = $this->db->single();
        return $result['user_count'] > 0;
    }

    // Fungsi untuk menambahkan user default
    public function addDefaultUser()
    {
        $defaultData = [
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'profile_picture' => NULL,
            'password' => password_hash('123', PASSWORD_BCRYPT), // Hash password default
            'role_id' => 1
        ];

        $this->db->query('EXEC sp_AddDefaultUser :name, :username, :email, :profile_picture, :password, :role_id');
        $this->db->bind(':name', $defaultData['name']);
        $this->db->bind(':username', $defaultData['username']);
        $this->db->bind(':email', $defaultData['email']);
        $this->db->bind(':profile_picture', $defaultData['profile_picture']);
        $this->db->bind(':password', $defaultData['password']);
        $this->db->bind(':role_id', $defaultData['role_id']);
        $this->db->execute();
    }

    // fungsi mengambil seluruh data user
    public function getUser()
    {
        $this->db->query('EXEC sp_GetUsers');
        return $this->db->resultSet();
    }

    public function getUserByRole($role)
    {
        $this->db->query('EXEC sp_GetUsersByRole :role_id');
        $this->db->bind(':role_id', $role);
        return $this->db->resultSet();
    }

    public function addUser($email, $data, $photo)
    {
        $this->db->query('EXEC AddUser @name = :name, @username = :username, @password = :password, 
                                @profile_picture = :profile_picture, @role_id = :role_id, @user_email = :email');

        $this->db->bind('name', $data['name']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', password_hash($data['password'], PASSWORD_BCRYPT));
        $this->db->bind('email', $email);
        $this->db->bind('profile_picture', $photo);
        $this->db->bind('role_id', $data['role']);
        try {
            $this->db->execute();
            return $this->db->rowCount();
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage());
            return false;
        }
    }

    //fungsi mencari user berdasarkan username
    public function getUserByUsername($username)
    {
        $this->db->query('EXEC sp_GetUserByUsername @username = :username');
        $this->db->bind(':username', $username);
        return $this->db->single();
    }

    //fungsi mencari user berdasarkan id
    public function getUserById($id)
    {
        $this->db->query('EXEC sp_GetUserById @user_id = :user_id');
        $this->db->bind(':user_id', $id);
        return $this->db->single();
    }

    //fungsi menghapus img di files profile
    public function deleteImage($id)
    {
        $this->db->query('EXEC sp_GetProfilePicture @user_id = :user_id');
        $this->db->bind(':user_id', $id);
        return $this->db->single();
    }


    //fungsi menghapus user
    public function deleteUser($id)
    {
        $this->db->query('EXEC sp_DeleteUser :user_id');
        $this->db->bind(':user_id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }


    //fungsi mengedit user
    public function editUser($email, $id, $data, $photo, $password)
    {
        $this->db->query('EXEC sp_EditUser :user_id, :name, :username, :email, :profile_picture, :password, :role_id');
        $this->db->bind(':user_id', $id);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $email);
        $this->db->bind(':profile_picture', $photo);
        $this->db->bind(':password', $password);
        $this->db->bind(':role_id', $data['role_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function isEmailExists($email, $userId = null)
    {
        if ($userId === null) {
            // Jika userId tidak diberikan, cukup cek berdasarkan email
            $query = "SELECT * FROM users WHERE email = :email";
            $this->db->query($query);
            $this->db->bind('email', $email);
        } else {
            // Jika userId diberikan, tambahkan kondisi untuk mengecualikan user_id
            $query = "SELECT * FROM users WHERE email = :email AND user_id != :user_id";
            $this->db->query($query);
            $this->db->bind('email', $email);
            $this->db->bind('user_id', $userId);
        }

        return $this->db->single() ? true : false;
    }


    public function isUsernameExists($username, $userId = null)
    {
        $query = "SELECT * FROM users WHERE username = :username AND user_id != :user_id";
        $this->db->query($query);
        $this->db->bind('username', $username);
        $this->db->bind('user_id', $userId);
        return $this->db->single() ? true : false;
    }

    public function getUsersWithPagination($limit, $offset)
    {
        $query = "EXEC GetUsersWithPagination :Limit, :Offset";

        $this->db->query($query);
        $this->db->bind(':Limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':Offset', $offset, PDO::PARAM_INT);

        return $this->db->resultSet();
    }

    public function getTotalUsers()
    {
        $query = "EXEC GetTotalUsers";
        $this->db->query($query);
        $result = $this->db->single();
        return $result ? (int)$result['Total'] : 0;
    }

    public function validateUser($name, $username, $email)
    {
        // Query untuk SQL Server
        $this->db->query("
            SELECT 
                SUM(CASE WHEN name = :name THEN 1 ELSE 0 END) AS name_count,
                SUM(CASE WHEN username = :username THEN 1 ELSE 0 END) AS username_count,
                SUM(CASE WHEN email = :email THEN 1 ELSE 0 END) AS email_count
            FROM users
        ");
        $this->db->bind(':name', $name);
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);

        $result = $this->db->single();

        // Mengembalikan hasil validasi
        return [
            'name_exists' => $result['name_count'] > 0,
            'username_exists' => $result['username_count'] > 0,
            'email_exists' => $result['email_count'] > 0
        ];
    }

    public function searchUsers($keyword, $pageNumber, $pageSize)
    {
        $query = "EXEC dbo.sp_searchUsers @Keyword = ?, @PageNumber = ?, @PageSize = ?";
        $this->db->query($query);
        $this->db->bind(1, $keyword);
        $this->db->bind(2, $pageNumber);
        $this->db->bind(3, $pageSize);
        return [
            'data' => $this->db->resultSet(),
            'totalCount' => $this->db->single()['TotalCount'] ?? 0
        ];
    }

}