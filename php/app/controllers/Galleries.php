<?php


class Galleries extends Controller
{
    public function index()
    {
        $this->view("main/galeri");
    }

//    public function uploadImgView()
//    {
//        $this->checkLogin();
//        $role = $this->checkRole();
//        $this->checkSessionTimeOut();
//        if ($role == 2) {
//            $this->saveLastVisitedPage();
//            $this->view('user/uploadImage');
//        } else if ($role == 1) {
//            $this->saveLastVisitedPage();
//            $this->view('admin/upload-image');
//        } else {
//            header('Location: ' . $this->getLastVisitedPage());
//        }
//    }

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

//    public function verifyImgView()
//    {
//        $this->checkLogin();
//        $role = $this->checkRole();
//        $this->checkSessionTimeOut();
//        if ($role == 1) {
//            $this->saveLastVisitedPage();
//            $galleryModel = $this->model('GalleryModel');
//            $images = $galleryModel->getPendingImages();
////            echo '<pre>';
////            print_r($images);
////            echo '</pre>';
//            $this->view('admin/verifyImages', compact('images'));
//        } else {
//            header('Location: ' . $this->getLastVisitedPage());
//        }
//    }


//    public function imgHistoryView($status = 'all')
//    {
//        $this->checkLogin();
//        $role = $this->checkRole();
//        $this->checkSessionTimeOut();
//
//        if ($role == 2) {
//            $this->saveLastVisitedPage();
//
//            $galleryModel = $this->model('GalleryModel');
//            $userId = $_SESSION['user_id'];
//
//            // Filter berdasarkan status
//            if ($status === 'all') {
//                $images = $galleryModel->getImagesByUser($userId);
//            } else {
//                $images = $galleryModel->getImagesByUserAndStatus($userId, $status);
//            }
//
//            $totalImages = count($images);
//
//            $this->view('user/image-history', [
//                'totalImages' => $totalImages,
//                'images' => $images,
//                'selectedStatus' => $status  // Menggunakan 'selectedStatus' secara konsisten
//            ]);
//        } else {
//            header('Location: ' . $this->getLastVisitedPage());
//        }
//    }


    public function getImages()
    {
        $id = $_POST['id'];
        $image = $this->model('GalleryModel')->getImageById($id);
        $filePath = GALLERY . '/files/' . $image['file_url'];
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

                $title = htmlspecialchars(trim($_POST['fileTitle']));
                $category = htmlspecialchars(trim($_POST['category']));
                $description = htmlspecialchars(trim($_POST['description']));

                // Validasi data wajib diisi
                if (empty($title)) {
                    $response['message'] = 'Judul file harus diisi.';
                    echo json_encode($response);
                    return;
                }

                if (empty($category)) {
                    $response['message'] = 'Kategori harus dipilih.';
                    echo json_encode($response);
                    return;
                }

                if (empty($description)) {
                    $response['message'] = 'Deskripsi harus diisi.';
                    echo json_encode($response);
                    return;
                }

                if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                    // Tentukan direktori tujuan
                    $uploadDir = __DIR__ . '/../files/research_output/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $fileName = basename($_FILES['file']['name']);
                    $uniqueName = uniqid() . "_" . $fileName;
                    $targetFilePath = $uploadDir . $uniqueName;
                    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

                    // Validasi ekstensi file
                    $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'doc', 'docx', 'xlsx'];
                    if (in_array($fileType, $allowedExtensions)) {
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                            // Simpan data ke database
                            $uploadSuccess = $this->model('ResearchOutputModel')->create(
                                $uniqueName,
                                $category,
                                $title,
                                'pending', // Status default
                                $_SESSION['user_id']
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





//    public function filter()
//    {
//        session_start();
//        $status = $_POST['status'];
//        $userId = $_SESSION['user_id'];
//
//        switch ($status) {
//            case 0: // Semua surat
//                $images = $this->model('GalleryModel')->getImageByUserId($userId);
//                break;
//            case 1: // Surat tertunda
//                $images = $this->model('GalleryModel')->getImageByUserIdPending($userId);
//                break;
//            case 2: // Surat disetujui
//                $images = $this->model('GalleryModel')->getImageByUserIdVerify($userId);
//                break;
//            case 3: // Surat ditolak
//                $images = $this->model('GalleryModel')->getImageByUserIdReject($userId);
//                break;
//            default:
//                echo json_encode(['error' => 'Invalid status']);
//                return; // Hentikan eksekusi
//        }
//
//        // Mengembalikan hasil sebagai JSON
//        echo json_encode($images);
//    }

//    public function verifyImage($id)
//    {
//        $this->checkLogin();
//        $role = $this->checkRole();
//        $this->checkSessionTimeOut();
//
//        if ($role == 1) { // Pastikan hanya admin yang bisa memverifikasi
//            $model = $this->model("GalleryModel");
//            $images = $model->getPendingImages();
//            if ($model->updateStatus($id, 2)) { // Status 2 untuk verified
//                echo json_encode(['success' => true, 'message' => 'Image verified successfully.']);
//            } else {
//                echo json_encode(['success' => false, 'message' => 'Failed to verify image.']);
//            }
//        } else {
//            http_response_code(403);
//            echo json_encode(['success' => false, 'message' => 'Unauthorized action.']);
//        }
//    }

//    public function rejectImage($id)
//    {
//        $this->checkLogin();
//        $role = $this->checkRole();
//        $this->checkSessionTimeOut();
//
//        if ($role == 1) { // Pastikan hanya admin yang bisa menolak
//            $model = $this->model("GalleryModel");
//            if ($model->updateStatus($id, 3)) { // Status 3 untuk rejected
//                echo json_encode(['success' => true, 'message' => 'Image rejected successfully.']);
//            } else {
//                echo json_encode(['success' => false, 'message' => 'Failed to reject image.']);
//            }
//        } else {
//            http_response_code(403);
//            echo json_encode(['success' => false, 'message' => 'Unauthorized action.']);
//        }
//    }

}