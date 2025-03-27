<?php

class Galleries extends Controller
{
    public function index()
    {
        $this->view("main/galeri");
    }

    public function uploadImgView()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if ($role == 1) {
            $this->saveLastVisitedPage();
            $this->view('admin/upload-image');
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function uploadImg()
    {
        // Mulai session dan output buffering
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        ob_start();
        header('Content-Type: application/json; charset=utf-8');

        // Variabel upload
        $nameFile = $_FILES['image']['name'] ?? '';
        $sizeFile = $_FILES['image']['size'] ?? 0;
        $error    = $_FILES['image']['error'] ?? 4;
        $tmpName  = $_FILES['image']['tmp_name'] ?? '';
        $extensionImage = strtolower(pathinfo($nameFile, PATHINFO_EXTENSION));

        // Validasi file
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        if (empty($nameFile) || $error === 4) {
            $response = ['success' => false, 'message' => 'Tidak ada file yang diunggah.'];
            echo json_encode($response);
            return;
        }
        if (!in_array($extensionImage, $allowedExtensions)) {
            $response = ['success' => false, 'message' => 'File tidak didukung. Hanya file JPG, JPEG, dan PNG yang diperbolehkan.'];
            echo json_encode($response);
            return;
        }
        if ($sizeFile > 5000000) {
            $response = ['success' => false, 'message' => 'Ukuran file terlalu besar.'];
            echo json_encode($response);
            return;
        }

        // Proses upload file ke folder
        $newFileName = uniqid() . '.' . $extensionImage;
        $destination = '../app/img/gallery/' . $newFileName;
        if (!move_uploaded_file($tmpName, $destination)) {
            $response = ['success' => false, 'message' => 'Gagal mengupload file ke server.'];
            echo json_encode($response);
            return;
        }

        // Ambil data tambahan dari POST dan session
        $category    = $_POST['category'] ?? '';
        $title       = $_POST['imageTitle'] ?? '';
        $description = $_POST['description'] ?? '';

        // Ambil uploaded_by dari session jika tidak dikirim melalui POST
        $uploaded_by = $_POST['uploaded_by'] ?? '';
        if (empty($uploaded_by) && isset($_SESSION['user_id'])) {
            $uploaded_by = $_SESSION['user_id'];
        }

        // Validasi data tambahan
        if (empty($category) || empty($title) || empty($uploaded_by)) {
            $response = ['success' => false, 'message' => 'Data kategori, judul, atau pengunggah tidak lengkap.'];
            echo json_encode($response);
            return;
        }

        // Simpan informasi file ke database dengan memanggil method create() pada GalleryModel
        $saveResult = $this->model('GalleryModel')->create($newFileName, $category, $title, $uploaded_by, $description);
        if (!$saveResult) {
            $response = ['success' => false, 'message' => 'Gagal menyimpan informasi file ke database.'];
            echo json_encode($response);
            return;
        }

        $filePath = GALLERY . $newFileName;
        $response = ['success' => true, 'filePath' => $filePath];
        echo json_encode($response);
    }


    public function deleteImage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['gallery_id'] ?? null;

            if ($id) {
                $result = $this->model('GalleryModel')->delete($id);

                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'File deleted successfully.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to delete file.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid request.']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
        }
        exit();
    }
}
