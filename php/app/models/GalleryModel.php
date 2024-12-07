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
    public function create($image, $category, $title, $status, $uploaded_by)
    {
        $status = 1;  // 1 untuk pending

        $query = "INSERT INTO " . $this->table . " (image, category, title, status, uploaded_by, created_at)
              VALUES (:image, :category, :title, :status, :uploaded_by, GETDATE())";

        // Gunakan metode query dari kelas Database
        $this->db->query($query);

        // Bind parameter menggunakan metode bind dari kelas Database
        $this->db->bind(':image', $image);
        $this->db->bind(':category', $category);
        $this->db->bind(':title', $title);
        $this->db->bind(':status', $status);
        $this->db->bind(':uploaded_by', $uploaded_by);

        try {
            $this->db->execute();
            return true; // Return true jika eksekusi berhasil
        } catch (PDOException $e) {
            // Log atau tampilkan error jika diperlukan
            return false; // Return false jika terjadi kesalahan
        }
    }

    // Read all gallery entries
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPendingImages()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE status = 1";
        $this->db->query($query);
        $result = $this->db->resultSet();
        return $result;
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
    public function update($id, $image, $category, $title, $status)
    {
        $query = "UPDATE " . $this->table . "
                  SET image = :image, category = :category, title = :title, status = :status
                  WHERE gallery_id = :id";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }

    // Update status to "verified" or "rejected"
    public function updateStatus($id, $status)
    {
        $query = "UPDATE " . $this->table . " SET status = :status WHERE gallery_id = :id";
        $this->db->query($query);
        $this->db->bind('status', $status);
        $this->db->bind('id', $id);

        return $this->db->execute();
    }

    // GalleryModel.php

    public function countImagesByUser($userId)
    {
        $query = "SELECT COUNT(*) as total FROM " . $this->table . " WHERE uploaded_by = :uploaded_by";
        $this->db->query($query);
        $this->db->bind(':uploaded_by', $userId);
        $result = $this->db->single();
        return $result['total'];
    }

    public function getImagesByUser($userId)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE uploaded_by = :uploaded_by ORDER BY created_at DESC";
        $this->db->query($query);
        $this->db->bind(':uploaded_by', $userId);
        return $this->db->resultSet(); // Mengembalikan semua hasil dalam bentuk array
    }

    public function getImagesByUserAndStatus($userId, $status)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE uploaded_by = :user_id AND status = :status";
        $this->db->query($query);
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':status', $status);
        return $this->db->resultSet();
    }

    // 1. Mengambil semua gambar berdasarkan ID User
    public function getImageByUserId($userId)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE uploaded_by = :uploaded_by ORDER BY created_at DESC";
        $this->db->query($query);
        $this->db->bind(':uploaded_by', $userId);
        return $this->db->resultSet();
    }

    // 2. Mengambil gambar tertunda (status = 1) berdasarkan ID User
    public function getImageByUserIdPending($userId)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE uploaded_by = :uploaded_by AND status = 1 ORDER BY created_at DESC";
        $this->db->query($query);
        $this->db->bind(':uploaded_by', $userId);
        return $this->db->resultSet();
    }

    // 3. Mengambil gambar disetujui (status = 2) berdasarkan ID User
    public function getImageByUserIdVerify($userId)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE uploaded_by = :uploaded_by AND status = 2 ORDER BY created_at DESC";
        $this->db->query($query);
        $this->db->bind(':uploaded_by', $userId);
        return $this->db->resultSet();
    }

    // 4. Mengambil gambar ditolak (status = 3) berdasarkan ID User
    public function getImageByUserIdReject($userId)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE uploaded_by = :uploaded_by AND status = 3 ORDER BY created_at DESC";
        $this->db->query($query);
        $this->db->bind(':uploaded_by', $userId);
        return $this->db->resultSet();
    }

//    public function getImageByUserIdPaginate($id, $awalData, $jumlahDataPerhalaman) {
//        // Query untuk mengambil data dengan pagination
//        $query = "SELECT *
//              FROM ". $this->table . "
//              WHERE user_id = :id AND status = :status_id
//              ORDER BY created_at DESC
//              OFFSET :awalData ROWS
//              FETCH NEXT :jumlahDataPerhalaman ROWS ONLY";
//
//        // Menjalankan query
//        $this->db->query($query);
//
//        // Mengikat parameter
//        $this->db->bind(':id', $id, PDO::PARAM_INT);
//        $this->db->bind(':status_id', 1, PDO::PARAM_INT);  // Asumsi status = 1
//        $this->db->bind(':awalData', $awalData, PDO::PARAM_INT);
//        $this->db->bind(':jumlahDataPerhalaman', $jumlahDataPerhalaman, PDO::PARAM_INT);
//
//        // Mengembalikan hasil query
//        return $this->db->resultSet();
//    }


    // Delete a gallery entry
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE gallery_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}