<?php 

class AgendaModel{
    private $table = 'agenda';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllAgenda() {
        $this->db->query('EXEC sp_GetAllAgenda');
        return $this->db->resultSet();
    }

    public function getAgendaById($id) {
        $this->db->query('EXEC sp_GetAgendaById :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function addAgenda($data) {
        $this->db->query('EXEC sp_AddAgenda :title, :description');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function editAgenda($data) {
        $this->db->query('EXEC sp_EditAgenda :id, :title, :description');
        $this->db->bind(':id', $data['agenda_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteAgenda($id) {
        $this->db->query('EXEC sp_DeleteAgenda :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}