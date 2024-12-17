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

//    public function delete($id)
//    {
//        $this->db->query('EXEC sp_DeleteGallery :id');
//        $this->db->bind(':id', $id);
//        return $this->db->execute();
//    }
//    public function delete($id)
//    {
//        $query = "DELETE FROM " . $this->table . " WHERE gallery_id = :id";
//        $this->db->query($query);
//        $this->db->bind(':id', $id);
//        return $this->db->execute();
//    }
//    public function delete($id)
//    {
//        // Ambil nama file berdasarkan ID dari database
//        $queryGetImage = "SELECT image FROM " . $this->table . " WHERE gallery_id = :id";
//        $this->db->query($queryGetImage);
//        $this->db->bind(':id', $id);
//        $imageName = $this->db->single()['image'];
//
//        // Lokasi file gambar di server (sesuaikan dengan lokasi uploadImg)
//        $uploadDir = __DIR__ . '/../img/gallery/files/';
//        $filePath = $uploadDir . $imageName;
//
//        // Hapus file fisik jika ada
//        if (file_exists($filePath)) {
//            unlink($filePath);
//        }
//
//        // Hapus data dari database
//        $queryDelete = "DELETE FROM " . $this->table . " WHERE gallery_id = :id";
//        $this->db->query($queryDelete);
//        $this->db->bind(':id', $id);
//        return $this->db->execute();
//    }
    public function delete($id)
    {
        $queryGetImage = "SELECT image FROM " . $this->table . " WHERE gallery_id = :id";
        $this->db->query($queryGetImage);
        $this->db->bind(':id', $id);
        $imageName = $this->db->single()['image'];

        $uploadDir = __DIR__ . '/../img/gallery/files/';
        $filePath = $uploadDir . $imageName;

        $debug = [
            'filePath' => $filePath,
            'fileExists' => file_exists($filePath),
        ];

        if (file_exists($filePath)) {
            $debug['unlinkSuccess'] = unlink($filePath);
        } else {
            $debug['unlinkSuccess'] = false;
        }

        $queryDelete = "DELETE FROM " . $this->table . " WHERE gallery_id = :id";
        $this->db->query($queryDelete);
        $this->db->bind(':id', $id);
        $debug['dbDeleteSuccess'] = $this->db->execute();

        // Tulis hasil debug ke log file
        file_put_contents(__DIR__ . '/../debug.log', print_r($debug, true), FILE_APPEND);

        return $debug['dbDeleteSuccess'];
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
}
