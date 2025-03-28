<?php

class LettersModel
{
    private $table = 'letters';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllLetter()
    {
        $this->db->query('CALL sp_GetAllLetters()');
        return $this->db->resultSet();
    }

    public function addLetter($data, $fileName)
    {
        $this->db->query('CALL sp_AddLetter(:title, :date, :file_url, :status, :user_id)');
        $this->db->bind(':title', $data["researchTitle"]);
        $this->db->bind(':date', date("Y-m-d")); // Format tanggal sesuai kebutuhan
        $this->db->bind(':file_url', $fileName);
        $this->db->bind(':status', 1);
        $this->db->bind(':user_id', (int)$data["user_id"]);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getLetterById($id)
    {
        $this->db->query('CALL sp_GetLetterById(:id)');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getLetterByUserIdLimit($id)
    {
        $this->db->query('CALL sp_GetLetterByUserIdLimit(:id)');
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }

    public function getLetterByUserId($id)
    {
        $this->db->query('CALL sp_GetLetterByUserId(:user_id)');
        $this->db->bind(':user_id', $id);
        return $this->db->resultSet();
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

    public function getLetterByUserIdPaginate($id, $awalData, $jumlahDataPerhalaman)
    {
        $this->db->query('CALL sp_GetLetterByUserIdPaginate(:id, :awalData, :jumlahDataPerhalaman)');
        $this->db->bind(':id', $id);
        $this->db->bind(':awalData', $awalData, PDO::PARAM_INT);
        $this->db->bind(':jumlahDataPerhalaman', $jumlahDataPerhalaman, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getLetterByUserIdStatus($id, $status, $awalData, $jumlahDataPerhalaman)
    {
        $query = "SELECT * FROM letters 
                  WHERE status = :status AND user_id = :id 
                  ORDER BY `date` DESC 
                  LIMIT :awalData, :jumlahDataPerhalaman";
        $this->db->query($query);
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        $this->db->bind(':awalData', $awalData, PDO::PARAM_INT);
        $this->db->bind(':jumlahDataPerhalaman', $jumlahDataPerhalaman, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function countAllLettersByUserandStatus($id, $status)
    {
        $query = "SELECT COUNT(*) AS total FROM letters 
                  WHERE user_id = :id AND status = :status";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        return $this->db->single();
    }

    public function updateStatusLetter($id, $status, $comment)
    {
        $query = "UPDATE letters SET status = :status, comment = :comment 
                  WHERE letter_id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        $this->db->bind(':comment', $comment);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function countAllLeterbyUserId($user_id)
    {
        $this->db->query('CALL sp_CountAllLettersByUserId(:user_id)');
        $this->db->bind(':user_id', $user_id);
        return $this->db->single()['total'];
    }

    public function countPendingStat($user_id)
    {
        $this->db->query('CALL sp_CountPendingStatus(:user_id)');
        $this->db->bind(':user_id', $user_id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function countVerifyStat($user_id)
    {
        $this->db->query('CALL sp_CountVerifyStatus(:user_id)');
        $this->db->bind(':user_id', $user_id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function countRejectStat($user_id)
    {
        $this->db->query('CALL sp_CountRejectStat(:user_id)');
        $this->db->bind(':user_id', $user_id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function countPending()
    {
        $this->db->query('CALL sp_CountPending()');
        return $this->db->single();
    }

    public function countVerify()
    {
        $this->db->query('CALL sp_CountVerify()');
        return $this->db->single();
    }

    public function getPendingLettersWithPagination($limit, $offset)
    {
        $query = "CALL sp_GetPendingLettersWithPagination(:offset, :limit)";
        $this->db->query($query);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getTotalPendingLetters()
    {
        $query = "CALL sp_GetTotalPendingLetters()";
        $this->db->query($query);
        $result = $this->db->single();
        return $result ? (int)$result['total'] : 0;
    }

    public function countAllLetters()
    {
        $query = "CALL sp_CountAllLetters()";
        $this->db->query($query);
        return $this->db->single()['total'];
    }

    public function getAllLettersPaginate($offset, $limit)
    {
        $query = "CALL sp_GetAllLettersPaginate(:offset, :limit)";
        $this->db->query($query);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function countRejectedLetters()
    {
        $query = "CALL sp_CountRejectedLetters()";
        $this->db->query($query);
        return $this->db->single()['total'];
    }

    public function searchLetters($keyword, $itemsPerPage, $offset)
    {
        try {
            $query = "SELECT * 
                      FROM letters 
                      WHERE (title LIKE ? OR `date` LIKE ?)
                      ORDER BY `date` DESC 
                      LIMIT ?, ?";

            $this->db->query($query);
            $this->db->bind(1, '%' . $keyword . '%', PDO::PARAM_STR);
            $this->db->bind(2, '%' . $keyword . '%', PDO::PARAM_STR);
            $this->db->bind(3, $offset, PDO::PARAM_INT);
            $this->db->bind(4, $itemsPerPage, PDO::PARAM_INT);

            // Log query dan parameter (opsional)
            error_log("Query: $query");
            error_log("Keyword: %$keyword%");

            $results = $this->db->resultSet();
            if (empty($results)) {
                error_log('Tidak ada hasil ditemukan.');
                return [];
            }
            return $results;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function countSearchResults($keyword)
    {
        try {
            $query = "SELECT COUNT(*) AS total
                      FROM letters 
                      WHERE (title LIKE ? OR `date` LIKE ?)";

            $this->db->query($query);
            $this->db->bind(1, '%' . $keyword . '%', PDO::PARAM_STR);
            $this->db->bind(2, '%' . $keyword . '%', PDO::PARAM_STR);

            error_log("Query: $query");
            error_log("Keyword: %$keyword%");

            $result = $this->db->single();
            $totalResults = isset($result['total']) ? (int)$result['total'] : 0;
            error_log("Total results: $totalResults");
            return $totalResults;
        } catch (Exception $e) {
            error_log("Error in countSearchResults: " . $e->getMessage());
            return false;
        }
    }

    public function getAllLetters()
    {
        $this->db->query("SELECT * FROM letters");
        return $this->db->resultSet();
    }

    public function getLettersByStatus($status, $awalData, $jumlahDataPerhalaman)
    {
        $query = "
            SELECT * 
            FROM letters 
            WHERE status = :status 
            ORDER BY `date` DESC 
            LIMIT :awalData, :jumlahDataPerhalaman
        ";
        $this->db->query($query);
        $this->db->bind(':status', $status);
        $this->db->bind(':awalData', $awalData, PDO::PARAM_INT);
        $this->db->bind(':jumlahDataPerhalaman', $jumlahDataPerhalaman, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function countAllLettersByStatus($status)
    {
        $query = "SELECT COUNT(*) AS total FROM letters WHERE status = :status";
        $this->db->query($query);
        $this->db->bind(':status', $status);
        return $this->db->single();
    }

    public function getNameById($userId)
    {
        $query = "SELECT name FROM users WHERE user_id = :user_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $userId, PDO::PARAM_INT);
        return $this->db->single()['name'] ?? null;
    }

    public function searchLettersUser($keyword, $userId, $limit, $offset)
    {
        $this->db->query('CALL sp_SearchLettersUser(:keyword, :userId, :limit, :offset)');
        $this->db->bind(':keyword', $keyword);
        $this->db->bind(':userId', $userId, PDO::PARAM_INT);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function countUserSearchResults($keyword, $userId)
    {
        $this->db->query('CALL sp_CountSearchLettersUser(:keyword, :userId)');
        $this->db->bind(':keyword', $keyword);
        $this->db->bind(':userId', $userId, PDO::PARAM_INT);
        return $this->db->single()['total'];
    }
}
