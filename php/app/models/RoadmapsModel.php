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
        $rowCount = 0;
        foreach ($data as $row) {
            $this->db->query('CALL sp_AddRoadmap(:year_start, :year_end, :category, :topic)');
            $this->db->bind(':year_start', $row['year_start'], PDO::PARAM_INT);
            $this->db->bind(':year_end', $row['year_end'], PDO::PARAM_INT);
            $this->db->bind(':category', $row['category'], PDO::PARAM_STR);
            $this->db->bind(':topic', $row['topic'], PDO::PARAM_STR);
            $this->db->execute();
            $rowCount += $this->db->rowCount();
        }
        return $rowCount;
    }

    public function getYears()
    {
        $this->db->query('CALL sp_GetYears()');
        return $this->db->resultSet();
    }

    public function getRoadmaps($year_start, $year_end)
    {
        $this->db->query('CALL sp_GetRoadmaps(:year_start, :year_end)');
        $this->db->bind(':year_start', $year_start, PDO::PARAM_INT);
        $this->db->bind(':year_end', $year_end, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function deleteRoadmap($year_start, $year_end)
    {
        $this->db->query('CALL sp_DeleteRoadmap(:year_start, :year_end)');
        $this->db->bind(':year_start', $year_start, PDO::PARAM_INT);
        $this->db->bind(':year_end', $year_end, PDO::PARAM_INT);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getRoadmapByPeriode($year_start, $year_end)
    {
        $this->db->query('CALL sp_GetRoadmapByPeriode(:year_start, :year_end)');
        $this->db->bind(':year_start', $year_start, PDO::PARAM_INT);
        $this->db->bind(':year_end', $year_end, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function updateRoadmap($data)
    {
        $rowCount = 0;
        foreach ($data as $row) {
            if (isset($row['delete']) && $row['delete'] === true) {
                $this->db->query('CALL sp_DeleteRoadmapById(:roadmap_id)');
                $this->db->bind(':roadmap_id', $row['roadmap_id'], PDO::PARAM_INT);
                $this->db->execute();
                $rowCount += $this->db->rowCount();
            } else {
                $this->db->query('CALL sp_UpdateRoadmap(:roadmap_id, :year_start, :year_end, :category, :topic)');
                $this->db->bind(':roadmap_id', $row['roadmap_id'], PDO::PARAM_INT);
                $this->db->bind(':year_start', $row['year_start'], PDO::PARAM_INT);
                $this->db->bind(':year_end', $row['year_end'], PDO::PARAM_INT);
                $this->db->bind(':category', $row['category'], PDO::PARAM_STR);
                $this->db->bind(':topic', $row['topic'], PDO::PARAM_STR);
                $this->db->execute();
                $rowCount += $this->db->rowCount();
            }
        }
        return $rowCount;
    }
}