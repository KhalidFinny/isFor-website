<?php

class User extends Controller
{
    public function index()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        if ($role == 1) {
            // Pagination setup
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman saat ini, default 1
            $limit = 5; // Jumlah pengguna per halaman
            $offset = ($page - 1) * $limit; // Hitung offset untuk query

            $usersModel = $this->model('UsersModel');
            $data['limit'] = $limit;
            $data['allUsersWithPagination'] = $usersModel->getUsersWithPagination($limit, $offset);
            $data['totalUsers'] = $usersModel->getTotalUsers(); // Total pengguna

            // Hitung jumlah halaman
            $data['currentPage'] = $page;
            $data['totalPages'] = ceil($data['totalUsers'] / $limit);

            // Kirim data ke view
            $this->saveLastVisitedPage();
            $this->view('admin/users', $data);
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }


    public function create()
    {
        session_start();

        $photo = $this->upload();

        // if (!$photo) {
        //     return false;
        // }

        // var_dump($_POST);
        // var_dump($photo);
        // exit;
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $name = $_POST['name'];
        $username = $_POST['username'];

        // Validasi data pengguna (nama, username, email)
        $validationResult = $this->model('UsersModel')->validateUser($name, $username, $email);

        if ($validationResult['name_exists']) {
            $_SESSION['message'] = "Nama sudah terdaftar.";
            header('Location: ' . BASEURL . '/User');
            return false;
        }
        if ($validationResult['username_exists']) {
            $_SESSION['message'] = "Username sudah terdaftar.";
            header('Location: ' . BASEURL . '/User');
            return false;
        }
        if ($validationResult['email_exists']) {
            $_SESSION['message'] = "Email sudah terdaftar.";
            header('Location: ' . BASEURL . '/User');
            return false;
        }

        if ($this->model('UsersModel')->addUser($email, $_POST, $photo) == 0) {
            $_SESSION['message'] = "Tambah data berhasil.";
        } else {
            $_SESSION['message'] = "Tambah data gagal.";
        }

        // var_dump($_SESSION['message']);
        header('Location: ' . BASEURL . '/User');
    }

    public function upload()
    {
        // var_dump($_FILES);

        $nameFile = $_FILES['profile_picture']['name'];
        $sizeFile = $_FILES['profile_picture']['size'];
        $error = $_FILES['profile_picture']['error'];
        $tmpName = $_FILES['profile_picture']['tmp_name'];

        //cek apakah tidak ada gambar yang diupload
        // if ($error == 4) {
        //     echo "pilih gambar terlebih dahulu";
        //     return false;
        // }

        if (!isset($nameFile) || $error === 4) {
            return null; // Tidak ada file yang diunggah
        }

        //cek yang diupload adalah gambar
        $extensionImageValid = ['jpg', 'jpeg', 'png'];
        $extensionImage = explode('.', $nameFile);
        $extensionImage = strtolower(end($extensionImage));

        if (!in_array($extensionImage, $extensionImageValid)) {
            echo "yang anda upload bukan gambar";
            return false;
        }

        //cek jika ukurannya terlalu besar
        if ($sizeFile > 5000000) {
            echo "ukuran gambar terlalu besar";
            return false;
        }

        //lolos pengecekan, gambar siap diupload
        // generate nama file baru
        $newFileName = uniqid();
        $newFileName .= '.';
        $newFileName .= $extensionImage;

        move_uploaded_file($tmpName, '../app/img/profile/' . $newFileName);


        return $newFileName;
    }

    public function editView($id)
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if ($role == 1) {
            $this->saveLastVisitedPage();
            $data['user'] = $this->model('UsersModel')->getUserById($id);
            $this->view('admin/editUser', $data);
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function edit()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $id = $_POST['user_id'];
        $oldPhoto = $_POST["oldImage"];
        $oldPass = $_POST["oldPass"];
        $newPass = $_POST["password"];
        $username = $_POST['username'];
        $userModel = $this->model('UsersModel');

        if (!$email) {
            echo json_encode(['status' => 'error', 'message' => 'Email tidak valid.']);
            return;
        }

        if ($userModel->isEmailExists($email, $id)) {
            echo json_encode(['status' => 'error', 'message' => 'email telah terdaftar. Silakan pilih email lain.']);
            return;
        }

        if ($userModel->isUsernameExists($username, $id)) {
            echo json_encode(['status' => 'error', 'message' => 'Username telah terdaftar. Silakan pilih username lain.']);
            return;
        }

        $password = !empty($newPass) ? password_hash($newPass, PASSWORD_DEFAULT) : $oldPass;

        if ($_FILES["profile_picture"]["error"] === 4) {
            $photo = $oldPhoto;
        } else {
            $photo = $this->upload();
            $image_name = $userModel->deleteImage($id);
            if ($image_name['profile_picture'] && file_exists('../app/img/profile/' . $image_name['profile_picture'])) {
                unlink('../app/img/profile/' . $image_name['profile_picture']);
            }
        }

        if ($userModel->editUser($email, $id, $_POST, $photo, $password) > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil diperbarui.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak berhasil diperbarui.']);
        }
    }

    private function redirectWithError($error)
    {
        // Kirim kembali ke form edit dengan pesan error
        $_SESSION['error'] = $error;
        header('Location: ' . BASEURL . '/User/edit/' . $_POST['user_id']);
        exit;
    }

    public function delete($id)
    {
        $image_name = $this->model('UsersModel')->deleteImage($id);

        if ($image_name['profile_picture'] && file_exists('../app/img/profile/' . $image_name['profile_picture'])) {
            unlink('../app/img/profile/' . $image_name['profile_picture']);
        }

        if ($this->model('UsersModel')->deleteUser($id) > 0) {
            header('Location: ' . BASEURL . '/dashboardAdmin');
            echo "tambah data berhasil";
        } else {
            echo "delete user gagal";
        }
    }

    public function search()
    {
        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $userModel = $this->model('UsersModel');
            $results = $userModel->searchUsers($keyword);
            try {

                header('Content-Type: application/json');
                echo json_encode($results);
            } catch (Exception $e) {
                error_log($e->getMessage());
                echo json_encode(['error' => 'Terjadi kesalahan di server.']);
            }
        }
    }

}