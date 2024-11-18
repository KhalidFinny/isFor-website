<?php

class RoadmapController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getRoadmap() {
        $stmt = $this->db->prepare("SELECT * FROM roadmap");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPeriod($period, $category, $item) {
        $stmt = $this->db->prepare("INSERT INTO roadmap (period, category, item) VALUES (?, ?, ?)");
        return $stmt->execute([$period, $category, $item]);
    }

    public function updateItem($id, $item) {
        $stmt = $this->db->prepare("UPDATE roadmap SET item = ? WHERE id = ?");
        return $stmt->execute([$item, $id]);
    }

    public function deleteItem($id) {
        $stmt = $this->db->prepare("DELETE FROM roadmap WHERE id = ?");
        return $stmt->execute([$id]);
    }
} 