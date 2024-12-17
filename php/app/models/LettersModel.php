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
        $this->db->query('EXEC sp_GetAllLetters');
        return $this->db->resultSet();
    }

    public function addLetter($data, $fileName)
    {
        $this->db->query('EXEC sp_AddLetter :title, :date, :file_url, :status, :user_id');
        $this->db->bind(':title', $data["researchTitle"]);
        $this->db->bind(':date', date("Y-m-d"));
        $this->db->bind(':file_url', $fileName);
        $this->db->bind(':status', 1);
        $this->db->bind(':user_id', (int)$data["user_id"]);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getLetterById($id)
    {
        $this->db->query('EXEC sp_GetLetterById :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getLetterByUserIdLimit($id)
    {
        $this->db->query('EXEC sp_GetLetterByUserIdLimit :id');
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }

    public function getLetterByUserId($id)
    {
        $this->db->query('EXEC sp_GetLetterByUserId :user_id');
        $this->db->bind(':user_id', $id);
        return $this->db->resultSet();
    }

    public function getLetterByUserIdPaginate($id, $awalData, $jumlahDataPerhalaman)
    {
        $this->db->query('EXEC sp_GetLetterByUserIdPaginate :id, :awalData, :jumlahDataPerhalaman');
        $this->db->bind(':id', $id);
        $this->db->bind(':awalData', $awalData, PDO::PARAM_INT);
        $this->db->bind(':jumlahDataPerhalaman', $jumlahDataPerhalaman, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getLetterByUserIdPending($id)
    {
        $this->db->query('EXEC sp_GetLetterByUserIdPending :user_id');
        $this->db->bind(':user_id', $id);
        return $this->db->resultSet();
    }

    public function getLetterByUserIdVerify($id)
    {
        $this->db->query('EXEC sp_GetLetterByUserIdVerify :user_id');
        $this->db->bind(':user_id', $id);
        return $this->db->resultSet();
    }

    public function getLetterByUserIdReject($id)
    {
        $this->db->query('EXEC sp_GetLetterByUserIdReject :user_id');
        $this->db->bind(':user_id', $id);
        return $this->db->resultSet();
    }

    public function updateStatusLetter($id, $status)
    {
        $this->db->query('EXEC sp_UpdateStatusLetter :id, :status');
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function countAllLeterbyUserId($user_id)
    {
        $this->db->query('EXEC sp_CountAllLettersByUserId :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        return $this->db->single();
    }

    public function countPendingStat($user_id)
    {
        $this->db->query('EXEC sp_CountPendingStat :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }

    public function countVerifyStat($user_id)
    {
        $this->db->query('EXEC sp_CountVerifyStat :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }

    public function countRejectStat($user_id)
    {
        $this->db->query('EXEC sp_CountRejectStat :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }

    public function countPending()
    {
        $this->db->query('EXEC sp_CountPending');
        return $this->db->single();
    }

    public function countVerify()
    {
        $this->db->query('EXEC sp_CountVerify');
        return $this->db->single();
    }

    public function getPendingLettersWithPagination($limit, $offset)
    {
        $query = "EXEC GetPendingLettersWithPagination @Limit = :limit, @Offset = :offset";

        $this->db->query($query);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);

        return $this->db->resultSet();
    }

    public function getTotalPendingLetters()
    {
        $query = "EXEC GetTotalPendingLetters";

        $this->db->query($query);

        $result = $this->db->single();
        return $result ? (int)$result['total'] : 0;
    }

    public function countAllLetters()
    {
        $this->db->query("EXEC sp_countAllLetters");
        return $this->db->single()['total'];
    }

    public function getAllLettersPaginate($offset, $limit)
    {
        $this->db->query("EXEC sp_getAllLettersPaginate @offset = :offset, @limit = :limit");
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function countRejectedLetters()
    {
        $this->db->query("EXEC sp_countRejectedLetters");
        return $this->db->single()['total'];
    }


//    public function searchLetter($user_id, $keyword){
//        $this->db->query('SELECT * FROM letters WHERE user_id = :user_id AND title LIKE :keyword OR date LIKE :keyword');
//        $this->db->bind(':user_id', $user_id);
//        $this->db->bind(':keyword', '%' . $keyword . '%');
//        $this->db->execute();
//        return $this->db->resultSet();
//    }

}