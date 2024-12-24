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

    public function updateStatus($id, $status)
    {
        $query = "EXEC sp_updateStatus @id = :id, @status = :status";
        $this->db->query($query);
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        $this->db->bind(':status', $status, PDO::PARAM_INT);
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

    public function countFilesByUserandStatus($userId, $status)
    {
        $this->db->query('SELECT COUNT(*) AS total FROM research_outputs WHERE uploaded_by = :uploaded_by AND status = :status;');
        $this->db->bind(':uploaded_by', $userId);
        $this->db->bind(':status', $status);
        $result = $this->db->single();
        return $result;
    }

    // Get research outputs by user
    public function getFilesByUser($userId)
    {
        $this->db->query('EXEC sp_GetResearchOutputsByUser :uploaded_by');
        $this->db->bind(':uploaded_by', $userId);
        return $this->db->resultSet();
    }

    public function getFilesByUserAndStatus($userId, $status, $awalData, $jumlahDataPerhalaman)
    {
        $this->db->query('SELECT * FROM research_outputs WHERE uploaded_by = :uploaded_by AND status = :status ORDER BY [uploaded_at] DESC OFFSET :awalData ROWS FETCH NEXT :jumlahDataPerhalaman ROWS ONLY;');
        $this->db->bind(':uploaded_by', $userId);
        $this->db->bind(':status', $status);
        $this->db->bind(':awalData', $awalData);
        $this->db->bind(':jumlahDataPerhalaman', $jumlahDataPerhalaman);
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

//    public function delete($id)
//    {
//        $this->db->query('EXEC sp_DeleteResearchOutput :id');
//        $this->db->bind(':id', $id);
//        return $this->db->execute();
//    }
    public function delete($id)
    {
        // Query untuk mendapatkan file URL
        $queryGetFile = "SELECT file_url FROM research_outputs WHERE research_output_id = :id";
        $this->db->query($queryGetFile);
        $this->db->bind(':id', $id);
        $result = $this->db->single();

        // Jika data tidak ditemukan
        if (!$result) {
            return ['dbDeleteSuccess' => false, 'unlinkFileSuccess' => false, 'unlinkMetaSuccess' => false];
        }

        // Ambil nama file
        $fileUrl = $result['file_url'];
        $uploadDir = __DIR__ . '/../files/research_output/';
        $metaDir = __DIR__ . '/../files/meta/';
        $filePath = $uploadDir . $fileUrl;
        $metaFilePath = $metaDir . $fileUrl . '.meta';

        // Hapus file dan metadata
        $unlinkFileSuccess = false;
        $unlinkMetaSuccess = false;

        if (file_exists($filePath)) {
            $unlinkFileSuccess = unlink($filePath);
        }

        if (file_exists($metaFilePath)) {
            $unlinkMetaSuccess = unlink($metaFilePath);
        }

        // Hapus data dari database dengan try-catch
        try {
            $queryDelete = "DELETE FROM research_outputs WHERE research_output_id = :id";
            $this->db->query($queryDelete);
            $this->db->bind(':id', $id);
            $dbDeleteSuccess = $this->db->execute();

            // Cek jumlah baris yang terpengaruh
            $affectedRows = $this->db->rowCount();

            return [
                'dbDeleteSuccess' => $affectedRows > 0,
                'unlinkFileSuccess' => $unlinkFileSuccess,
                'unlinkMetaSuccess' => $unlinkMetaSuccess,
            ];
        } catch (Exception $e) {
            return [
                'dbDeleteSuccess' => false,
                'unlinkFileSuccess' => $unlinkFileSuccess,
                'unlinkMetaSuccess' => $unlinkMetaSuccess,
            ];
        }
    }

    public function getResearchDIPASWA()
    {
        $this->db->query("EXEC sp_getResearchDIPASWA");
        return $this->db->resultSet();
    }

    public function getResearchDIPAPNBP()
    {
        $this->db->query("EXEC sp_getResearchDIPAPNBP");
        return $this->db->resultSet();
    }

    public function getResearchTesis()
    {
        $this->db->query("EXEC sp_getResearchTesis");
        return $this->db->resultSet();
    }

    public function countAllFiles()
    {
        $this->db->query("EXEC sp_countAllFiles");
        return $this->db->single()['total'];
    }

    public function getAllPaginatedFiles($itemsPerPage, $offset)
    {
        $this->db->query("EXEC sp_getAllPaginatedFiles @itemsPerPage = :itemsPerPage, @offset = :offset");
        $this->db->bind(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function countAllFilesByStatus($status)
    {
        $this->db->query("EXEC sp_countAllFilesByStatus @status = :status");
        $this->db->bind(':status', $status, PDO::PARAM_INT);
        return $this->db->single()['total'];
    }

    public function getAllPaginatedFilesByStatus($status, $itemsPerPage, $offset)
    {
        $this->db->query("EXEC sp_getAllPaginatedFilesByStatus @status = :status, @itemsPerPage = :items, @offset = :offset");
        $this->db->bind(':status', $status, PDO::PARAM_INT);
        $this->db->bind(':items', $itemsPerPage, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function countPendingFiles()
    {
        $this->db->query("EXEC sp_countPendingFiles");
        return $this->db->single()['total'];
    }

    public function countRejectedFiles()
    {
        $this->db->query("EXEC sp_countRejectedFiles");
        return $this->db->single()['total'];
    }

    public function searchResearchOutputs($keyword, $limit, $offset)
    {
        $query = "EXEC sp_searchFiles @Keyword = :keyword, @Limit = :limit, @Offset = :offset";
        $this->db->query($query);
        $this->db->bind(':keyword', $keyword);
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        return $this->db->resultSet();
    }

    public function countSearchResults($keyword)
    {
        $query = "EXEC sp_countSearchFiles @Keyword = :keyword";
        $this->db->query($query);
        $this->db->bind(':keyword', $keyword);
        return $this->db->single()['total'];
    }

    public function getAllFiles()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function getFilesByStatus($status, $awalData, $jumlahDataPerhalaman)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE status = :status ORDER BY [uploaded_at] DESC OFFSET :awalData ROWS FETCH NEXT :jumlahDataPerhalaman ROWS ONLY;");
        $this->db->bind(':status', $status);
        $this->db->bind(':awalData', $awalData);
        $this->db->bind(':jumlahDataPerhalaman', $jumlahDataPerhalaman);
        return $this->db->resultSet();
    }

    public function getAllVerifiedResearchOutputs()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE status = :status";
        $this->db->query($query);
        $this->db->bind(':status', 2);
        return $this->db->resultSet();
    }

    public function getNameById($userId) {
        $query = "SELECT name FROM users WHERE user_id = :user_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $userId, PDO::PARAM_INT);
        return $this->db->single()['name'] ?? null;
    }

}

