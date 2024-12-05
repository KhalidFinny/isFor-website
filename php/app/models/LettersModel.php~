<?php 

class LettersModel{
    private $table = 'letters';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllLetter(){
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function addLetter($data, $fileName){
        $query = "INSERT INTO letters(title, date, file_url, status, user_id)
                    VALUES 
                    (:title, :date, :file_url, :status, :user_id)";

        $this->db->query($query);
        $this->db->bind(":title", $data["researchTitle"]);
        $this->db->bind(":date", date("Y-m-d"));
        $this->db->bind(":file_url", $fileName);
        $this->db->bind(":status", 1);
        $this->db->bind(":user_id", (int) $data["user_id"]);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getLetterById($id) {
        $this->db->query('SELECT file_url FROM ' . $this->table . ' WHERE letter_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getLetterByUserIdLimit($id) {
        $this->db->query('SELECT TOP 5 * FROM letters WHERE user_id = :id ORDER BY date DESC');
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }

    public function getLetterByUserId($id) {
        $this->db->query('SELECT * FROM letters WHERE user_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }

    public function getLetterByUserIdPaginate($id, $awalData, $jumlahDataPerhalaman) {
        $this->db->query('SELECT * FROM letters WHERE user_id = :id LIMIT :awalData, :jumlahDataPerhalaman');
        $this->db->bind(':id', $id);
        $this->db->bind(':awalData', $awalData);
        $this->db->bind(':jumlahDataPerhalaman', $jumlahDataPerhalaman);
        return $this->db->resultSet();
    }

    public function getLetterByUserIdPending($id) {
        $this->db->query('SELECT * FROM letters WHERE status = 1 AND user_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }

    public function getLetterByUserIdVerify($id) {
        $this->db->query('SELECT * FROM letters WHERE status = 2 AND user_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }
    public function getLetterByUserIdReject($id) {
        $this->db->query('SELECT * FROM letters WHERE status = 3 AND user_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }
    
    public function updateStatusLetter($id, $status){
        $this->db->query('UPDATE ' . $this->table . ' SET status = :status WHERE letter_id = :id ');
        $this->db->bind(':status', $status) ;
        $this->db->bind(':id', $id);
        $this->db->execute();
        $rowcount = $this->db->rowCount();
        if ($rowcount > 0) {
            return $rowcount;  // Jika ada baris yang terpengaruh, kembalikan jumlahnya
        } else {
            return 0;  // Jika tidak ada baris yang terpengaruh
        }
    }

    public function countAllLeterbyUserId($user_id){
        $this->db->query('SELECT COUNT(file_url) AS total FROM letters WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        return $this->db->single();
    }

    public function countPendingStat($user_id){
        $this->db->query('SELECT COUNT(status) AS total FROM letters WHERE status = 1 AND user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        return $this->db->single();
    }

    public function countVerifyStat($user_id){
        $this->db->query('SELECT COUNT(status) AS total FROM letters WHERE status = 2 AND user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        return $this->db->single();
    }
    
    public function countRejectStat($user_id){
        $this->db->query('SELECT COUNT(status) AS total FROM letters WHERE status = 3 AND user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        return $this->db->single();
    }

    public function countPending(){
        $this->db->query('SELECT COUNT(status) AS total FROM letters WHERE status = 1');
        $this->db->execute();
        return $this->db->single();
    }

    public function countVerify(){
        $this->db->query('SELECT COUNT(status) AS total FROM letters WHERE status = 2');
        $this->db->execute();
        return $this->db->single();
    }

    public function searchLetter($user_id, $keyword){
        $this->db->query('SELECT * FROM letters WHERE user_id = :user_id AND title LIKE :keyword OR date LIKE :keyword');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':keyword', '%' . $keyword . '%');
        $this->db->execute();
        return $this->db->resultSet();
    }

}