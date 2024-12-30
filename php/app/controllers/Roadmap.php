<?php 

class Roadmap extends Controller{
    public function index(){
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if($role == 1){
            $this->saveLastVisitedPage();
            $data['roadmaps'] = $this->groupingRoadmap();
            $this->view('admin/manage-roadmap', $data);
        }else{
            header('Location: ' . $this->getLastVisitedPage());
        }
    }
    

    public function groupingRoadmap() {
        $uniqueYears = $this->model('RoadmapsModel')->getYears();
        $groupedRoadmaps = []; // Inisialisasi awal untuk menghindari error
    
        if (!empty($uniqueYears)) {
            foreach ($uniqueYears as $year) {
                $roadmaps = $this->model('RoadmapsModel')->getRoadmaps($year['year_start'], $year['year_end']);
    
                // Mengurutkan roadmap berdasarkan year_start
                usort($roadmaps, function($a, $b) {
                    return $a['year_start'] <=> $b['year_start'];
                });
    
                foreach ($roadmaps as $roadmap) {
                    $period = $roadmap['year_start'] . '-' . $roadmap['year_end'];
                    $category = $roadmap['category'];
    
                    // Memeriksa apakah periode sudah ada dalam kelompok
                    if (!isset($groupedRoadmaps[$period])) {
                        $groupedRoadmaps[$period] = [];
                    }
    
                    // Memeriksa apakah kategori sudah ada dalam kelompok untuk periode ini
                    if (!isset($groupedRoadmaps[$period][$category])) {
                        $groupedRoadmaps[$period][$category] = [];
                    }
    
                    // Mencegah duplikasi data
                    if (!in_array($roadmap['topic'], $groupedRoadmaps[$period][$category])) {
                        $groupedRoadmaps[$period][$category][] = $roadmap['topic'];
                    }
                }
            }
        }
    
        // Mengurutkan kelompok berdasarkan period secara keseluruhan
        if (!empty($groupedRoadmaps)) {
            ksort($groupedRoadmaps);
        }
    
        // Kembalikan hasil
        return $groupedRoadmaps;
    }

    public function checkyear(){
        $uniqueYears = $this->model('RoadmapsModel')->getYears();

        foreach ($uniqueYears as $year) {
            var_dump("Periode: " . $year['year_start'] . " - " . $year['year_end']);
        }
    }

    public function addRoadmap() {
        $year_start = $_POST['year_start'];
        $year_end = $_POST['year_end'];
        $data = [];
    
        // Iterasi untuk memproses setiap topik yang diterima dari form
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'topic_') === 0) {
                $parts = explode('_', $key); // Hasil: ['topic', '0', '0']
                $category_index = $parts[1]; // Ambil index kategori dari $parts
                $category_key = "category_" . $category_index; // Key kategori
                $category_name = $_POST[$category_key] ?? null; // Ambil kategori jika ada
    
                // Pastikan kategori dan topik ada, dan topik tidak kosong
                if ($category_name && !empty($value)) {
                    // Cek apakah kombinasi kategori dan topik sudah ada dalam array $data
                    $isDuplicate = false;
                    foreach ($data as $existingRoadmap) {
                        if ($existingRoadmap['category'] == $category_name && $existingRoadmap['topic'] == $value) {
                            $isDuplicate = true;
                            break; // Jika sudah ada, berhenti memeriksa
                        }
                    }
    
                    // Jika kombinasi kategori dan topik belum ada, tambahkan ke dalam data
                    if (!$isDuplicate) {
                        $data[] = [
                            'year_start' => $year_start,
                            'year_end' => $year_end,
                            'category' => $category_name,
                            'topic' => $value
                        ];
                    }
                }
            }
        }
    
        // Jika tidak ada data yang valid untuk disimpan, tampilkan pesan kesalahan
        if (empty($data)) {
            $_SESSION['message'] = "Tidak ada data yang valid untuk ditambahkan!";
            header('Location: ' . BASEURL . '/roadmap');
            return;
        }
    
        // Simpan data roadmap ke database
        if ($this->model('RoadmapsModel')->addRoadmaps($data) > 0) {
            // Redirect setelah berhasil menambah data
            header('Location: ' . BASEURL . '/roadmap');
            exit; // Pastikan script berhenti setelah redirect
        } else {
            // Jika gagal menambah data
            $_SESSION['message'] = "Tambah data gagal!";
            header('Location: ' . BASEURL . '/roadmap');
        }
    }    

    public function delete(){
        $year = explode('-', $_POST['periode']);
        $year_start = $year[0];
        $year_end = $year[1];

        if ($this->model('RoadmapsModel')->deleteRoadmap($year_start, $year_end) > 0) {
            echo json_encode(['status' => 'hapus data berhasil']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data']);
        }
    }

    public function getUpdate(){
        $year = explode('-', $_POST['periode']);
        $year_start = $year[0];
        $year_end = $year[1];

        echo json_encode($this->model('RoadmapsModel')->getRoadmapByPeriode($year_start, $year_end));
    }

    public function editRoadmap() {
        $year_start = $_POST['old_year_start'];
        $year_end = $_POST['old_year_end'];
        $new_year_start = $_POST['year_start'];
        $new_year_end = $_POST['year_end'];
        $data = [];
    
        // Menghapus data lama terlebih dahulu
        if ($this->model('RoadmapsModel')->deleteRoadmap($year_start, $year_end) > 0) {
            // Iterasi untuk memproses setiap topik yang diterima dari form
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'topic_') === 0) {
                    $parts = explode('_', $key); // Hasil: ['topic', '0', '0']
                    $category_index = $parts[1]; // Ambil index kategori dari $parts
                    $category_key = "category_" . $category_index; // Key kategori
                    $category_name = $_POST[$category_key] ?? null; // Ambil kategori jika ada
    
                    // Pastikan kategori dan topik ada, dan topik tidak kosong
                    if ($category_name && !empty($value)) {
                        // Cek apakah kombinasi kategori dan topik sudah ada dalam array $data
                        $isDuplicate = false;
                        foreach ($data as $existingRoadmap) {
                            if ($existingRoadmap['category'] == $category_name && $existingRoadmap['topic'] == $value) {
                                $isDuplicate = true;
                                break; // Jika sudah ada, berhenti memeriksa
                            }
                        }
    
                        // Jika kombinasi kategori dan topik belum ada, tambahkan ke dalam data
                        if (!$isDuplicate) {
                            $data[] = [
                                'year_start' => $new_year_start,
                                'year_end' => $new_year_end,
                                'category' => $category_name,
                                'topic' => $value
                            ];
                        }
                    }
                }
            }
    
            // Jika tidak ada data yang valid untuk disimpan
            if (empty($data)) {
                $_SESSION['message'] = "Tidak ada data yang valid untuk ditambahkan!";
                header('Location: ' . BASEURL . '/roadmap');
                return;
            }
    
            // Simpan data roadmap yang baru ke database
            if ($this->model('RoadmapsModel')->addRoadmaps($data) > 0) {
                header('Location: ' . BASEURL . '/roadmap');
                exit; // Pastikan script berhenti setelah redirect
            } else {
                // Jika gagal menambah data
                $_SESSION['message'] = "Update data gagal!";
                header('Location: ' . BASEURL . '/roadmap');
            }
        } else {
            // Jika gagal menghapus data lama
            $_SESSION['message'] = "Gagal menghapus data lama!";
            header('Location: ' . BASEURL . '/roadmap');
        }
    }    
}