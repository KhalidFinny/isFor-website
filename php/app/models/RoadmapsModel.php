<?php

class RoadmapsModel
{
    private $table = 'roadmaps';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addRoadmaps($data)
    {
        foreach ($data as $row) {
            $this->db->query('EXEC sp_AddRoadmap :year_start, :year_end, :category, :topic');
            $this->db->bind(':year_start', $row['year_start']);
            $this->db->bind(':year_end', $row['year_end']);
            $this->db->bind(':category', $row['category']);
            $this->db->bind(':topic', $row['topic']);
            $this->db->execute();
        }
        return $this->db->rowCount();
    }


    public function getYears()
    {
        $this->db->query('EXEC sp_GetDistinctYears');
        return $this->db->resultSet();
    }


    public function getRoadmaps($year_start, $year_end)
    {
        $this->db->query('EXEC sp_GetRoadmapsByYears :year_start, :year_end');
        $this->db->bind(':year_start', $year_start);
        $this->db->bind(':year_end', $year_end);
        return $this->db->resultSet();
    }


    public function deleteRoadmap($year_start, $year_end)
    {
        $this->db->query('EXEC sp_DeleteRoadmap :year_start, :year_end');
        $this->db->bind(':year_start', $year_start);
        $this->db->bind(':year_end', $year_end);
        $this->db->execute();
        return $this->db->rowCount();
    }


    public function getRoadmapByPeriode($year_start, $year_end)
    {
        $query = "SELECT * FROM roadmaps WHERE year_start = :year_start AND year_end = :year_end";
        $this->db->query($query);
        $this->db->bind(':year_start', $year_start);
        $this->db->bind(':year_end', $year_end);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function updateRoadmap($data)
    {
        foreach ($data as $row) {
            if ($row == null) {
                $this->db->query('EXEC sp_DeleteRoadmap :roadmap_id');
                $this->db->bind(':roadmap_id', $row['roadmap_id']);
            } else {
                $this->db->query('EXEC sp_UpdateRoadmap :roadmap_id, :year_start, :year_end, :category, :topic');
                $this->db->bind(':roadmap_id', $row['roadmap_id']);
                $this->db->bind(':year_start', $row['year_start']);
                $this->db->bind(':year_end', $row['year_end']);
                $this->db->bind(':category', $row['category']);
                $this->db->bind(':topic', $row['topic']);
                $this->db->execute();
            }
        }
        return $this->db->rowCount();
    }
}