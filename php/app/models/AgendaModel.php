<?php 

class AgendaModel{
    private $table = 'agenda';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllAgenda(){
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }
}