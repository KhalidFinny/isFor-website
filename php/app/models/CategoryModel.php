<?php

class CategoryModel
{
    private $db;
    private $table = 'category';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $this->db->query($query);
        return $this->db->resultSet();
    }
}
