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
        $query = 'SELECT *, ROW_NUMBER() OVER (ORDER BY agenda_id) AS number FROM agenda';
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getAgendaById($id)
    {
        $query = 'SELECT * FROM agenda WHERE agenda_id = :id';
        $this->db->query($query);
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function addAgenda($data)
    {
        $query = 'INSERT INTO agenda (title, description) VALUES (:title, :description)';
        $this->db->query($query);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function editAgenda($data)
    {
        $query = 'UPDATE agenda 
                  SET title = :title, 
                      description = :description 
                  WHERE agenda_id = :id';
        $this->db->query($query);
        $this->db->bind(':id', $data['agenda_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteAgenda($id)
    {
        $query = 'DELETE FROM agenda WHERE agenda_id = :id';
        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}