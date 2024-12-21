<?php

class Galleries extends Controller
{
    public function index()
    {
        $this->view("main/galeri");
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

    public function getImages()
    {
        $id = $_POST['id'];
        $image = $this->model('GalleryModel')->getImageById($id);
        $filePath = GALLERY . $image['file_url'];
        echo json_encode(['success' => true, 'filePath' => $filePath]);
    }

    public function uploadImg()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        if ($role == 1) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $response = ['success' => false, 'message' => ''];

                // Periksa konfirmasi dari pengguna
                if (empty($_POST['confirmUpload']) || $_POST['confirmUpload'] !== 'true') {
                    $response['message'] = 'Konfirmasi upload tidak diterima.';
                    echo json_encode($response);
                    return;
                }

                $title = htmlspecialchars(trim($_POST['imageTitle']));
                $category = htmlspecialchars(trim($_POST['category']));
                $description = htmlspecialchars(trim($_POST['description']));

                if (empty($title) || empty($category) || empty($description)) {
                    $response['message'] = 'Semua field wajib diisi.';
                    echo json_encode($response);
                    error_log("Data yang diterima: " . json_encode($_POST));
                    return;
                }

                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    // Tentukan direktori tujuan
                    $uploadDir = __DIR__ . '/../img/gallery/files/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $fileName = basename($_FILES['image']['name']);
                    $uniqueName = uniqid() . "_" . $fileName;
                    $targetFilePath = $uploadDir . $uniqueName;
                    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

                    // Validasi ekstensi file
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                    if (in_array($fileType, $allowedExtensions)) {
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                            // Simpan data ke database
                            $uploadSuccess = $this->model('GalleryModel')->create(
                                $uniqueName,
                                $category,
                                $title,
                                $_SESSION['user_id'],
                                $description
                            );

                            if ($uploadSuccess) {
                                $response['success'] = true;
                                $response['message'] = 'File berhasil diunggah.';
                            } else {
                                error_log("Gagal menyimpan informasi ke database: " . json_encode([$uniqueName, $category, $title]));
                                unlink($targetFilePath); // Hapus file jika gagal disimpan ke database
                                $response['message'] = 'Gagal menyimpan informasi file ke database.';
                            }
                        } else {
                            $response['message'] = 'Gagal memindahkan file yang diunggah.';
                        }
                    } else {
                        $response['message'] = 'Ekstensi file tidak didukung.';
                    }
                } else {
                    $response['message'] = 'Tidak ada file yang diunggah atau terjadi kesalahan.';
                }

                echo json_encode($response);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Metode tidak valid.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Akses ditolak.']);
        }
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