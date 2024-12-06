<?php

class ResearchOutput extends Controller
{
    public function index()
    {
        $this->view("main/hasilpenelitian");
    }

    public function uploadResearchView()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if ($role == 2) {
            $this->saveLastVisitedPage();
            $this->view('user/uploadImage');
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function verifyResearchView()
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

    public function researchHistoryView($status = 'all')
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


}