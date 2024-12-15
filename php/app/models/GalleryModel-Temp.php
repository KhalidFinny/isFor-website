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
        $query = "INSERT INTO " . $this->table . " (image, category, title, uploaded_by, description, created_at)
              VALUES (:image, :category, :title, :uploaded_by, :description, GETDATE())";

        $this->db->query($query);
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
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    // Read a specific gallery entry by ID
    public function getImageById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE gallery_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a gallery entry
    public function update($id, $image, $category, $title)
    {
        $query = "UPDATE " . $this->table . "
                  SET image = :image, category = :category, title = :title
                  WHERE gallery_id = :id";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':title', $title);

        return $stmt->execute();
    }

    // Count images uploaded by a specific user
    public function countImagesByUser($userId)
    {
        $query = "SELECT COUNT(*) as total FROM " . $this->table . " WHERE uploaded_by = :uploaded_by";
        $this->db->query($query);
        $this->db->bind(':uploaded_by', $userId);
        $result = $this->db->single();
        return $result['total'];
    }

    // Get all images uploaded by a specific user
    public function getImagesByUser($userId)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE uploaded_by = :uploaded_by ORDER BY created_at DESC";
        $this->db->query($query);
        $this->db->bind(':uploaded_by', $userId);
        return $this->db->resultSet();
    }

    // Delete a gallery entry
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE gallery_id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
