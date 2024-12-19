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
        $queryGetImage = "SELECT image FROM " . $this->table . " WHERE gallery_id = :id";
        $this->db->query($queryGetImage);
        $this->db->bind(':id', $id);
        $result = $this->db->single();

        if (!$result) {
            return false;
        }

        $imageName = $result['image'];
        $uploadDir = __DIR__ . '/../img/gallery/files/';
        $filePath = $uploadDir . $imageName;

        $unlinkSuccess = false;
        if (file_exists($filePath)) {
            $unlinkSuccess = unlink($filePath);
        }

        $queryDelete = "DELETE FROM " . $this->table . " WHERE gallery_id = :id";
        $this->db->query($queryDelete);
        $this->db->bind(':id', $id);
        $this->db->execute();

        return [
            'dbDeleteSuccess' => $this->db->rowCount() > 0,
            'unlinkSuccess' => $unlinkSuccess,
        ];
    }

    public function getGalleriesWithPagination($limit, $offset)
    {
        $query = "EXEC sp_GetGalleriesWithPagination @Limit = :limit, @Offset = :offset";
        $this->db->query($query);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getTotalGalleries()
    {
        $query = "EXEC sp_GetTotalGalleries";
        $this->db->query($query);
        $result = $this->db->single();
        return $result ? (int)$result['total'] : 0;
    }

    public function getGaleryDIPASWA()
    {
        $query = " SELECT * FROM galleries WHERE category LIKE 'DIPA SWADANA'";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getGaleryDIPAPNBP()
    {
        $query = " SELECT * FROM galleries WHERE category LIKE 'DIPA PNBP'";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getGaleryTesis()
    {
        $query = " SELECT * FROM galleries WHERE category LIKE 'Tesis Magister'";
        $this->db->query($query);
        return $this->db->resultSet();
    }
}
