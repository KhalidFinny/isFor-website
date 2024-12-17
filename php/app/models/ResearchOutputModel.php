<?php

class ResearchOutputModel
{
    private $db;
    private $table = 'research_outputs';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function create($file_url, $uploaded_by, $title, $category, $description, $status = 1)
    {
        $this->db->query('EXEC sp_CreateResearchOutput :file_url, :uploaded_by, :title, :category, :description, :status');
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

    public function getAll()
    {
        $this->db->query('EXEC sp_GetAllResearchOutputs');
        return $this->db->resultSet();
    }

    public function getPendingFiles()
    {
        $this->db->query('EXEC sp_GetResearchOutputsByStatus :status');
        $this->db->bind(':status', 1);
        return $this->db->resultSet();
    }

    public function getVerifyFiles()
    {
        $this->db->query('EXEC sp_GetResearchOutputsByStatus :status');
        $this->db->bind(':status', 2);
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('EXEC sp_GetResearchOutputById :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function update($id, $file_url, $title, $category, $status)
    {
        $this->db->query('EXEC sp_UpdateResearchOutput :id, :file_url, :title, :category, :status');
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

    public function countFilesByUser($userId)
    {
        $this->db->query('EXEC sp_CountResearchOutputsByUser :uploaded_by');
        $this->db->bind(':uploaded_by', $userId);
        $result = $this->db->single();
        return $result['total'];
    }

    // Get research outputs by user
    public function getFilesByUser($userId)
    {
        $this->db->query('EXEC sp_GetResearchOutputsByUser :uploaded_by');
        $this->db->bind(':uploaded_by', $userId);
        return $this->db->resultSet();
    }

    public function getFilesByUserAndStatus($userId, $status)
    {
        $this->db->query('EXEC sp_GetResearchOutputsByUserAndStatus :uploaded_by, :status');
        $this->db->bind(':uploaded_by', $userId);
        $this->db->bind(':status', $status);
        return $this->db->resultSet();
    }

    public function getPaginatedFilesByUser($userId, $limit, $offset)
    {
        $this->db->query("EXEC sp_GetPaginatedFilesByUser :UserId, :Limit, :Offset");
        $this->db->bind(':UserId', $userId, PDO::PARAM_INT);
        $this->db->bind(':Limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':Offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getPaginatedFilesByUserAndStatus($userId, $status, $limit, $offset)
    {
        $this->db->query("EXEC sp_GetPaginatedFilesByUserAndStatus :UserId, :Status, :Limit, :Offset");
        $this->db->bind(':UserId', $userId, PDO::PARAM_INT);
        $this->db->bind(':Status', $status, PDO::PARAM_INT);
        $this->db->bind(':Limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':Offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getPendingFilesWithPagination($limit, $offset)
    {
        $this->db->query("EXEC sp_GetPendingFilesWithPagination :Limit, :Offset");
        $this->db->bind(':Limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':Offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getTotalPendingFiles()
    {
        $this->db->query("EXEC sp_GetTotalPendingFiles");
        $result = $this->db->single();
        return $result ? (int)$result['total'] : 0;
    }

    public function getVerifiedResearchOutputs($limit, $offset)
    {
        $query = "EXEC sp_GetVerifiedResearchOutputs @Limit = :limit, @Offset = :offset";
        $this->db->query($query);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getTotalVerifiedResearchOutputs()
    {
        $query = "EXEC sp_GetTotalVerifiedResearchOutputs";

        $this->db->query($query);
        $result = $this->db->single();

        return $result ? (int)$result['total'] : 0;
    }

    public function delete($id)
    {
        $this->db->query('EXEC sp_DeleteResearchOutput :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function countAllFiles()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM research_outputs");
        return $this->db->single()['total'];
    }

    public function getAllPaginatedFiles($itemsPerPage, $offset)
    {
        $this->db->query("SELECT * FROM research_outputs ORDER BY uploaded_at DESC OFFSET :offset ROWS FETCH NEXT :items ROWS ONLY");
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        $this->db->bind(':items', $itemsPerPage, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function countAllFilesByStatus($status)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM research_outputs WHERE status = :status");
        $this->db->bind(':status', $status, PDO::PARAM_INT);
        return $this->db->single()['total'];
    }

    public function getAllPaginatedFilesByStatus($status, $itemsPerPage, $offset)
    {
        $this->db->query("SELECT * FROM research_outputs WHERE status = :status ORDER BY uploaded_at DESC OFFSET :offset ROWS FETCH NEXT :items ROWS ONLY");
        $this->db->bind(':status', $status, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        $this->db->bind(':items', $itemsPerPage, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function countPendingFiles() {
        $this->db->query("SELECT COUNT(*) as total FROM research_outputs WHERE status = 1");
        return $this->db->single()['total'];
    }

    public function countRejectedFiles() {
        $this->db->query("SELECT COUNT(*) as total FROM research_outputs WHERE status = 3");
        return $this->db->single()['total'];
    }

}
