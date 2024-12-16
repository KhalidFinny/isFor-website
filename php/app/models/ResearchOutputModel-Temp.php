<?php

class ResearchOutputModel
{
    private $db;
    private $table = 'research_outputs';

    public function __construct()
    {
        $this->db = new Database;
    }

    // Create a new research output entry
    public function create($file_url, $uploaded_by, $title, $category, $description, $status = 1)
    {
        $query = "INSERT INTO " . $this->table . " (file_url, uploaded_by, title, category, description, status, uploaded_at)
              VALUES (:file_url, :uploaded_by, :title, :category, :description, :status, GETDATE())";

        $this->db->query($query);
        $this->db->bind(':file_url', $file_url);
        $this->db->bind(':uploaded_by', $uploaded_by);
        $this->db->bind(':title', $title);
        $this->db->bind(':category', $category);
        $this->db->bind(':description', $description);
        $this->db->bind(':status', $status);

        try {
            $this->db->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Read all research outputs
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $this->db->query($query);
        return $this->db->resultSet();
    }

    // Get pending research outputs
    public function getPendingFiles()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE status = 1";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getVerifyFiles()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE status = 2 ORDER BY uploaded_at DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    // Read a specific research output by ID
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE research_output_id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Update a research output entry
    public function update($id, $file_url, $title, $category, $status)
    {
        $query = "UPDATE " . $this->table . "
                  SET file_url = :file_url, title = :title, category = :category, status = :status
                  WHERE research_output_id = :id";

        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->bind(':file_url', $file_url);
        $this->db->bind(':title', $title);
        $this->db->bind(':category', $category);
        $this->db->bind(':status', $status);

        try {
            $this->db->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Update status of a research output
    public function updateStatus($id, $status)
    {
        $query = "UPDATE " . $this->table . " SET status = :status WHERE research_output_id = :id";
        $this->db->query($query);
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        try {
            $this->db->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Count research outputs by user
    public function countByUser($userId)
    {
        $query = "SELECT COUNT(*) as total FROM " . $this->table . " WHERE uploaded_by = :uploaded_by";
        $this->db->query($query);
        $this->db->bind(':uploaded_by', $userId);
        $result = $this->db->single();
        return $result['total'];
    }

    // Get research outputs by user
    public function getFilesByUser($userId)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE uploaded_by = :uploaded_by ORDER BY uploaded_at DESC";
        $this->db->query($query);
        $this->db->bind(':uploaded_by', $userId);
        return $this->db->resultSet();
    }

    // Get research outputs by user and status
    public function getFilesByUserAndStatus($userId, $status)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE uploaded_by = :uploaded_by AND status = :status";
        $this->db->query($query);
        $this->db->bind(':uploaded_by', $userId);
        $this->db->bind(':status', $status);
        return $this->db->resultSet();
    }

    public function getPaginatedFilesByUser($userId, $limit, $offset)
    {
        $sql = "SELECT * FROM research_outputs WHERE uploaded_by = :userId ORDER BY uploaded_at DESC OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";
        $this->db->query($sql);
        $this->db->bind(':userId', $userId);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getPaginatedFilesByUserAndStatus($userId, $status, $limit, $offset)
    {
        $sql = "SELECT * FROM research_outputs WHERE uploaded_by = :userId AND status = :status ORDER BY uploaded_at DESC OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";
        $this->db->query($sql);
        $this->db->bind(':userId', $userId);
        $this->db->bind(':status', $status);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getPendingFilesWithPagination($limit, $offset)
    {
        $limit = (int)$limit;
        $offset = (int)$offset;
        $query = "SELECT * 
                  FROM research_outputs 
                  WHERE status = :status 
                  ORDER BY uploaded_at DESC 
                  OFFSET :offset ROWS 
                  FETCH NEXT :limit ROWS ONLY";

        $this->db->query($query);
        $this->db->bind(':status', 1, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);

        return $this->db->resultSet();
    }

    public function getTotalPendingFiles()
    {
        $query = "SELECT COUNT(1) as total 
                  FROM research_outputs 
                  WHERE status = :status";

        $this->db->query($query);
        $this->db->bind(':status', 1, PDO::PARAM_INT);

        $result = $this->db->single();
        return $result ? (int)$result['total'] : 0;
    }

    // Delete a research output
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE research_output_id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getVerifiedResearchOutputs($limit, $offset)
    {
        $query = "SELECT research_output_id, file_url, uploaded_by, uploaded_at, title, category, status, description
              FROM isfor_database.dbo.research_outputs
              WHERE status = 2
              ORDER BY uploaded_at DESC
              OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";

        $this->db->query($query);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);

        return $this->db->resultSet();
    }

    public function getTotalVerifiedResearchOutputs()
    {
        $query = "SELECT COUNT(1) AS total FROM isfor_database.dbo.research_outputs WHERE status = 2";

        $this->db->query($query);
        $result = $this->db->single();

        return $result ? (int)$result['total'] : 0;
    }
}