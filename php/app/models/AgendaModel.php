<?php

class AgendaModel
{
    private $table = 'agenda';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllAgenda()
    {
        $this->db->query('CALL sp_GetAllAgenda()');
        return $this->db->resultSet();
    }

    public function getAgendaById($id)
    {
        $this->db->query('CALL sp_GetAgendaById(:id)');
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function addAgenda($data)
    {
        $this->db->query('CALL sp_AddAgenda(:title, :description)');
        $this->db->bind(':title', $data['title'], PDO::PARAM_STR);
        $this->db->bind(':description', $data['description'], PDO::PARAM_STR);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function editAgenda($data)
    {
        $this->db->query('CALL sp_EditAgenda(:id, :title, :description)');
        $this->db->bind(':id', $data['agenda_id'], PDO::PARAM_INT);
        $this->db->bind(':title', $data['title'], PDO::PARAM_STR);
        $this->db->bind(':description', $data['description'], PDO::PARAM_STR);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteAgenda($id)
    {
        $this->db->query('CALL sp_DeleteAgenda(:id)');
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        $this->db->execute();
        return $this->db->rowCount();
    }
}