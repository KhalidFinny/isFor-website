<?php

class UsersModel
{
    private $table = 'users';
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function checkUserExists()
    {
        $this->db->query('SELECT COUNT(*) AS user_count FROM users');
        $result = $this->db->single();
        return $result['user_count'] > 0;
    }

    public function addDefaultUser()
    {
        $defaultData = [
            'name' => 'Dr.Rakhmat Arianto, S.ST., M.Kom',
            'username' => 'admin',
            'email' => 'arianto@polinema.ac.id',
            'profile_picture' => null,
            'password' => password_hash('123', PASSWORD_BCRYPT),
            'role_id' => 1
        ];

        $this->db->query('INSERT INTO users (name, username, email, profile_picture, password, role_id) VALUES (:name, :username, :email, :profile_picture, :password, :role_id)');
        $this->db->bind(':name', $defaultData['name']);
        $this->db->bind(':username', $defaultData['username']);
        $this->db->bind(':email', $defaultData['email']);
        $this->db->bind(':profile_picture', $defaultData['profile_picture']);
        $this->db->bind(':password', $defaultData['password']);
        $this->db->bind(':role_id', $defaultData['role_id']);
        $this->db->execute();
    }

    public function getUser()
    {
        $this->db->query('SELECT * FROM users');
        return $this->db->resultSet();
    }

    public function getUserByRole($role)
    {
        $this->db->query('SELECT * FROM users WHERE role_id = :role_id');
        $this->db->bind(':role_id', $role);
        return $this->db->resultSet();
    }

    public function addUser($email, $data, $photo)
    {
        $query = "INSERT INTO users
                    (name, username, password, email, profile_picture, role_id)
                  VALUES
                    (:name, :username, :password, :email, :profile_picture, :role_id)";

        $this->db->query($query);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':username', $data['username']);
        // Hash password menggunakan BCRYPT
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_BCRYPT));
        $this->db->bind(':email', $email);
        $this->db->bind(':profile_picture', $photo);
        $this->db->bind(':role_id', $data['role']);

        try {
            $this->db->execute();
            return $this->db->rowCount();
        } catch (PDOException $e) {
            error_log('Database Error (addUser): ' . $e->getMessage());
            return false;
        }
    }

    public function getUserByUsername($username)
    {
        $query = "SELECT * FROM users WHERE username = :username";
        $this->db->query($query);
        $this->db->bind(':username', $username);
        return $this->db->single();
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $id);
        return $this->db->single();
    }

    public function getProfilePicture($id)
    {
        $query = "SELECT profile_picture FROM users WHERE user_id = :user_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $id);
        return $this->db->single();
    }

    public function deleteUser($id)
    {
        $query = "DELETE FROM users WHERE user_id = :user_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $id);
        try {
            $this->db->execute();
            return $this->db->rowCount();
        } catch (PDOException $e) {
            error_log('Database Error (deleteUser): ' . $e->getMessage());
            return false;
        }
    }

    public function deleteImage($id)
    {
        $this->db->query("SELECT profile_picture FROM users WHERE user_id = :id");
        $this->db->bind(":id", $id);
        $user = $this->db->single();

        return $user;
    }


    public function editUser($email, $id, $data, $photo, $password)
    {
        $query = "UPDATE users
                  SET name = IFNULL(:name, name),
                      username = :username,
                      email = :email,
                      profile_picture = :profile_picture,
                      password = :password,
                      role_id = IFNULL(:role_id, role_id)
                  WHERE user_id = :user_id";
        $this->db->query($query);
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

    public function getLettersByUserIdPaginate($userId, $limit, $offset)
    {
        $this->db->query("
            SELECT *
            FROM letters
            WHERE user_id = :user_id
            ORDER BY letter_id DESC
            LIMIT :limit OFFSET :offset
        ");
        $this->db->bind(':user_id', $userId, PDO::PARAM_INT);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function countLettersByUserId($userId)
    {
        $this->db->query("
        SELECT COUNT(*) AS total
        FROM letters
        WHERE user_id = :user_id
    ");
        $this->db->bind(':user_id', $userId, PDO::PARAM_INT);
        $row = $this->db->single();
        return $row['total'];
    }

    public function isEmailExists($email, $userId = null)
    {
        if ($userId === null) {
            $query = "SELECT * FROM users WHERE email = :email";
            $this->db->query($query);
            $this->db->bind(':email', $email);
        } else {
            $query = "SELECT * FROM users WHERE email = :email AND user_id != :user_id";
            $this->db->query($query);
            $this->db->bind(':email', $email);
            $this->db->bind(':user_id', $userId);
        }
        return $this->db->single() ? true : false;
    }

    public function isUsernameExists($username, $userId = null)
    {
        if ($userId === null) {
            $query = "SELECT * FROM users WHERE username = :username";
            $this->db->query($query);
            $this->db->bind(':username', $username);
        } else {
            $query = "SELECT * FROM users WHERE username = :username AND user_id != :user_id";
            $this->db->query($query);
            $this->db->bind(':username', $username);
            $this->db->bind(':user_id', $userId);
        }
        return $this->db->single() ? true : false;
    }

    public function getUsersWithPagination($limit, $offset)
    {
        $query = "SELECT user_id, name, username, email, profile_picture, role_id
                  FROM users
                  ORDER BY user_id ASC
                  LIMIT :offset, :limit";
        $this->db->query($query);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getTotalUsers()
    {
        $query = "SELECT COUNT(1) AS Total FROM users";
        $this->db->query($query);
        $result = $this->db->single();
        return $result ? (int)$result['Total'] : 0;
    }

    public function validateUser($name, $username, $email)
    {
        $query = "
            SELECT
                SUM(CASE WHEN name = :name THEN 1 ELSE 0 END) AS name_count,
                SUM(CASE WHEN username = :username THEN 1 ELSE 0 END) AS username_count,
                SUM(CASE WHEN email = :email THEN 1 ELSE 0 END) AS email_count
            FROM users
        ";
        $this->db->query($query);
        $this->db->bind(':name', $name);
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);

        $result = $this->db->single();
        return [
            'name_exists'     => $result['name_count'] > 0,
            'username_exists' => $result['username_count'] > 0,
            'email_exists'    => $result['email_count'] > 0
        ];
    }

    public function searchUsers($keyword, $pageNumber, $pageSize)
    {
        $startRow = (($pageNumber - 1) * $pageSize) + 1;
        $endRow   = $pageNumber * $pageSize;

        $query = "
            SELECT *
            FROM (
                SELECT *,
                       ROW_NUMBER() OVER (ORDER BY user_id) AS RowNum,
                       COUNT(*) OVER() AS TotalCount
                FROM users
                WHERE name LIKE CONCAT('%', :keyword, '%')
                   OR username LIKE CONCAT('%', :keyword, '%')
                   OR email LIKE CONCAT('%', :keyword, '%')
            ) AS PaginatedResults
            WHERE RowNum BETWEEN :startRow AND :endRow
        ";

        $this->db->query($query);
        $this->db->bind(':keyword', $keyword);
        $this->db->bind(':startRow', $startRow, PDO::PARAM_INT);
        $this->db->bind(':endRow', $endRow, PDO::PARAM_INT);

        $results = $this->db->resultSet();
        $totalCount = (count($results) > 0) ? $results[0]['TotalCount'] : 0;

        return [
            'data'       => $results,
            'totalCount' => $totalCount
        ];
    }
}
