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
        if ($role == 2) {
            $this->saveLastVisitedPage();
            $this->view('user/uploadImage');
        } else if ($role == 1) {
            $this->saveLastVisitedPage();
            $this->view('admin/upload-image');
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function verifyImgView()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if ($role == 1) {
            $this->saveLastVisitedPage();
            $galleryModel = $this->model('GalleryModel');
            $images = $galleryModel->getPendingImages();
//            echo '<pre>';
//            print_r($images);
//            echo '</pre>';
            $this->view('admin/verifyImages', compact('images'));
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }


    public function imgHistoryView($status = 'all')
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        if ($role == 2) {
            $this->saveLastVisitedPage();

            $galleryModel = $this->model('GalleryModel');
            $userId = $_SESSION['user_id'];

            // Filter berdasarkan status
            if ($status === 'all') {
                $images = $galleryModel->getImagesByUser($userId);
            } else {
                $images = $galleryModel->getImagesByUserAndStatus($userId, $status);
            }

            $totalImages = count($images);

            $this->view('user/image-history', [
                'totalImages' => $totalImages,
                'images' => $images,
                'selectedStatus' => $status  // Menggunakan 'selectedStatus' secara konsisten
            ]);
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }


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

        if ($role == 2) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $title = htmlspecialchars(trim($_POST['imageTitle']));
                $category = htmlspecialchars(trim($_POST['category']));
                $description = htmlspecialchars(trim($_POST['description']));

                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $targetDir = __DIR__ . "/../img/gallery/files/";
                    $fileName = basename($_FILES['image']['name']);
                    $uniqueName = uniqid() . "_" . $fileName; // Nama file dengan unique ID
                    $targetFilePath = $targetDir . $uniqueName;
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                    $status = 'pending';

                    $allowedTypes = ['jpg', 'png', 'gif', 'jpeg'];
                    if (in_array(strtolower($fileType), $allowedTypes)) {
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                            // Simpan nama file unik ke database
                            $uploadSuccess = $this->model('GalleryModel')->create($uniqueName, $category, $title, $status, $_SESSION['user_id']);
                            if ($uploadSuccess) {
                                header('Location: ' . BASEURL . '/galleries/uploadImgView');
                                exit();
                            } else {
                                error_log("Database insert failed for image upload.");
                                echo "Gagal menyimpan informasi gambar.";
                            }
                        } else {
                            error_log("Failed to move uploaded files.");
                            echo "Gagal mengunggah files.";
                        }
                    } else {
                        echo "Tipe files tidak diizinkan. Hanya JPG, PNG, dan GIF.";
                    }
                } else {
                    echo "Tidak ada files yang diunggah atau terjadi kesalahan.";
                }
            } else {
                $this->view('user/uploadImage');
            }
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function uploadImgAdmin()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        if ($role == 2) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $title = htmlspecialchars(trim($_POST['imageTitle']));
                $category = htmlspecialchars(trim($_POST['category']));
                $description = htmlspecialchars(trim($_POST['description']));

                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $targetDir = __DIR__ . "/../img/gallery/files/";
                    $fileName = basename($_FILES['image']['name']);
                    $uniqueName = uniqid() . "_" . $fileName; // Nama file dengan unique ID
                    $targetFilePath = $targetDir . $uniqueName;
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                    $status = 'pending';

                    $allowedTypes = ['jpg', 'png', 'gif', 'jpeg'];
                    if (in_array(strtolower($fileType), $allowedTypes)) {
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                            // Simpan nama file unik ke database
                            $uploadSuccess = $this->model('GalleryModel')->create($uniqueName, $category, $title, $status, $_SESSION['user_id']);
                            if ($uploadSuccess) {
                                header('Location: ' . BASEURL . '/galleries/uploadImgView');
                                exit();
                            } else {
                                error_log("Database insert failed for image upload.");
                                echo "Gagal menyimpan informasi gambar.";
                            }
                        } else {
                            error_log("Failed to move uploaded files.");
                            echo "Gagal mengunggah files.";
                        }
                    } else {
                        echo "Tipe files tidak diizinkan. Hanya JPG, PNG, dan GIF.";
                    }
                } else {
                    echo "Tidak ada files yang diunggah atau terjadi kesalahan.";
                }
            } else {
                $this->view('admin/upload-image');
            }
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function verifyImage($id)
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        if ($role == 1) { // Pastikan hanya admin yang bisa memverifikasi
            $model = $this->model("GalleryModel");
            $images = $model->getPendingImages();
            if ($model->updateStatus($id, 2)) { // Status 2 untuk verified
                echo json_encode(['success' => true, 'message' => 'Image verified successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to verify image.']);
            }
        } else {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Unauthorized action.']);
        }
    }

    public function rejectImage($id)
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        if ($role == 1) { // Pastikan hanya admin yang bisa menolak
            $model = $this->model("GalleryModel");
            if ($model->updateStatus($id, 3)) { // Status 3 untuk rejected
                echo json_encode(['success' => true, 'message' => 'Image rejected successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to reject image.']);
            }
        } else {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Unauthorized action.']);
        }
    }

}