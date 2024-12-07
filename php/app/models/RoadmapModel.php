<?php 

class RoadmapsModel {
    private $table = 'roadmaps';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function addRoadmaps($data){
        foreach($data as $row){
            $query = "INSERT INTO " . $this->table . "(year_start, year_end, category, topic)
                        VALUES (:year_start, :year_end, :category, :topic)";
            $this->db->query($query);
            $this->db->bind(':year_start', $row['year_start']);
            $this->db->bind(':year_end', $row['year_end']);
            $this->db->bind(':category', $row['category']);
            $this->db->bind(':topic', $row['topic']);
            $this->db->execute();
        }

        return $this->db->rowCount();
    }

    public function getYears() {
        // Query untuk mengambil year_start dan year_end yang unik
        $query = "SELECT DISTINCT year_start, year_end FROM " . $this->table;
        $this->db->query($query);
        
        return $this->db->resultSet(); // Mengembalikan hasil query tanpa duplikat
    }

    public function getRoadmaps($year_start, $year_end) {
        $query = "SELECT * FROM " . $this->table . " 
                    WHERE year_start = :year_start AND year_end = :year_end 
                    ORDER BY category, topic";
        $this->db->query($query);
        $this->db->bind(':year_start', $year_start);
        $this->db->bind(':year_end', $year_end);

        return $this->db->resultSet(); // Mengembalikan hasil query sebagai array
    }

    public function deleteRoadmap($year_start, $year_end){
        $query = "DELETE FROM roadmaps WHERE year_start = :year_start AND year_end = :year_end";
        $this->db->query($query);
        $this->db->bind(':year_start', $year_start);
        $this->db->bind(':year_end', $year_end);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getRoadmapByPeriode($year_start, $year_end){
        $query = "SELECT * FROM roadmaps WHERE year_start = :year_start AND year_end = :year_end";
        $this->db->query($query);
        $this->db->bind(':year_start', $year_start);
        $this->db->bind(':year_end', $year_end);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function updateRoadmap($data){
        foreach($data as $row){
            if ($row == null) {
                $query = "DELETE FROM roadmaps WHERE roadmap_id = :roadmap_id";
            }else{
                $query = "UPDATE " . $this->table . " SET
                            year_start = :year_start, 
                            year_end = :year_end, 
                            category = :category, 
                            topic = :topic
                            WHERE roadmap_id = :roadmap_id";
            }

            $this->db->query($query);
            $this->db->bind(':year_start', $row['year_start']);
            $this->db->bind(':year_end', $row['year_end']);
            $this->db->bind(':category', $row['category']);
            $this->db->bind(':topic', $row['topic']);
            $this->db->bind(':roadmap_id', $row['roadmap_id']);
            $this->db->execute();
        }

        return $this->db->rowCount();
    }
}