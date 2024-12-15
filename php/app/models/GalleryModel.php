<?php

class GalleryModel
{
    private $db;
    private $table = 'galleries';

    public function __construct()
    {
        $this->db = new Database;
    }

    // Create a new gallery entry
    public function create($image, $category, $title, $uploaded_by, $description)
    {
        $this->db->query('EXEC sp_CreateGallery :image, :category, :title, :uploaded_by, :description');
        $this->db->bind(':image', $image);
        $this->db->bind(':category', $category);
        $this->db->bind(':title', $title);
        $this->db->bind(':uploaded_by', $uploaded_by);
        $this->db->bind(':description', $description);

        try {
            $this->db->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Read all gallery entries
    public function getAll()
    {
        $this->db->query('EXEC sp_GetAllGalleries');
        return $this->db->resultSet();
    }

    // Read a specific gallery entry by ID
    public function getImageById($id)
    {
        $this->db->query('EXEC sp_GetGalleryById :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function update($id, $image, $category, $title)
    {
        $this->db->query('EXEC sp_UpdateGallery :id, :image, :category, :title');
        $this->db->bind(':id', $id);
        $this->db->bind(':image', $image);
        $this->db->bind(':category', $category);
        $this->db->bind(':title', $title);
        return $this->db->execute();
    }

    public function countImagesByUser($userId)
    {
        $this->db->query('EXEC sp_CountImagesByUser :uploaded_by');
        $this->db->bind(':uploaded_by', $userId);
        $result = $this->db->single();
        return $result['total'];
    }

    public function getImagesByUser($userId)
    {
        $this->db->query('EXEC sp_GetImagesByUser :uploaded_by');
        $this->db->bind(':uploaded_by', $userId);
        return $this->db->resultSet();
    }

    public function delete($id)
    {
        $this->db->query('EXEC sp_DeleteGallery :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
