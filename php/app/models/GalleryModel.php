<?php

class GalleryModel
{
    private $db;
    private $table = 'galleries';

    public function __construct()
    {
        $this->db = new Database;
    }


    public function create($image, $category, $title, $uploaded_by, $description)
    {
        $query = "INSERT INTO galleries (image, category, title, uploaded_by, description, created_at)
                  VALUES (:image, :category, :title, :uploaded_by, :description, NOW())";
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

    public function getAll()
    {
        $query = "SELECT * FROM galleries ORDER BY created_at DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getImageById($id)
    {
        $query = "SELECT * FROM galleries WHERE gallery_id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function update($id, $image, $category, $title)
    {
        $query = "UPDATE galleries 
                  SET image = :image, 
                      category = :category, 
                      title = :title 
                  WHERE gallery_id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->bind(':image', $image);
        $this->db->bind(':category', $category);
        $this->db->bind(':title', $title);
        return $this->db->execute();
    }

    public function countImagesByUser($userId)
    {
        $query = "SELECT COUNT(*) AS total FROM galleries WHERE uploaded_by = :uploaded_by";
        $this->db->query($query);
        $this->db->bind(':uploaded_by', $userId);
        $result = $this->db->single();
        return $result['total'];
    }

    public function getImagesByUser($userId)
    {
        $query = "SELECT * FROM galleries WHERE uploaded_by = :uploaded_by ORDER BY created_at DESC";
        $this->db->query($query);
        $this->db->bind(':uploaded_by', $userId);
        return $this->db->resultSet();
    }

    public function getGalleriesWithPagination($limit, $offset)
    {
        $query = "SELECT gallery_id, image, category, title, uploaded_by, created_at, description 
              FROM galleries 
              ORDER BY created_at DESC 
              LIMIT :offset, :limit";
        $this->db->query($query);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getTotalGalleries()
    {
        $query = "SELECT COUNT(1) AS total FROM galleries";
        $this->db->query($query);
        $result = $this->db->single();
        return $result ? (int)$result['total'] : 0;
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
        $uploadDir = __DIR__ . '/../img/gallery/';
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

    public function getGaleryDIPASWA()
    {
        $query = "SELECT * FROM galleries WHERE category LIKE :category";
        $this->db->query($query);
        $this->db->bind(':category', 'DIPA SWADANA');
        return $this->db->resultSet();
    }

    public function getGaleryDIPAPNBP()
    {
        $query = "SELECT * FROM galleries WHERE category LIKE :category";
        $this->db->query($query);
        $this->db->bind(':category', 'DIPA PNBP');
        return $this->db->resultSet();
    }

    public function getGaleryTesis()
    {
        $query = "SELECT * FROM galleries WHERE category LIKE :category";
        $this->db->query($query);
        $this->db->bind(':category', 'Tesis Magister');
        return $this->db->resultSet();
    }

    public function getGaleryBerita()
    {
        $query = "SELECT * FROM galleries WHERE category LIKE :category";
        $this->db->query($query);
        $this->db->bind(':category', 'Berita');
        return $this->db->resultSet();
    }

    public function getGaleryByCategory($category, $page, $limit)
    {
        $offset = ($page - 1) * $limit;
        $query = "
        SELECT * 
        FROM galleries 
        WHERE category LIKE :category
        ORDER BY gallery_id
        LIMIT :offset, :limit
    ";
        $this->db->query($query);
        $this->db->bind(':category', $category);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getTotalGalleriesByCategory($category)
    {
        $query = "SELECT COUNT(*) as total FROM galleries WHERE category LIKE :category";
        $this->db->query($query);
        $this->db->bind(':category', $category);
        $result = $this->db->single();
        return $result ? (int)$result['total'] : 0;
    }

    public function getAllPaginateGallery($page, $limit)
    {
        $offset = ($page - 1) * $limit;

        // Query data paginasi
        $query = "
        SELECT * 
        FROM galleries
        ORDER BY created_at DESC
        LIMIT :offset, :limit
    ";
        $this->db->query($query);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $data = $this->db->resultSet();

        // Query total record
        $this->db->query('SELECT COUNT(*) AS Total FROM galleries;');
        $total = $this->db->single();

        return ['data' => $data, 'total' => $total['Total']];
    }
}
