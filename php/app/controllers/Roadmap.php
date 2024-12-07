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
    

    public function groupingRoadmap(){
        $uniqueYears = $this->model('RoadmapsModel')->getYears();

        foreach ($uniqueYears as $year) {
            $roadmaps = $this->model('RoadmapsModel')->getRoadmaps($year['year_start'], $year['year_end']);
            
            foreach($roadmaps as $roadmap){
                $period = $roadmap['year_start'] . '-' . $roadmap['year_end'];
                $category = $roadmap['category'];

                // Memeriksa apakah periode sudah ada dalam kelompok
                if (!isset($groupedRoadmaps[$period])) {
                    // Jika belum ada, buat array kosong untuk periode ini
                    $groupedRoadmaps[$period] = [];
                }

                // Memeriksa apakah kategori sudah ada dalam kelompok untuk periode ini
                if (!isset($groupedRoadmaps[$period][$category])) {
                    // Jika belum ada, buat array kosong untuk kategori ini dalam periode tersebut
                    $groupedRoadmaps[$period][$category] = [];
                }

                // Menambahkan topik ke kategori yang sesuai dalam periode ini
                $groupedRoadmaps[$period][$category][] = $roadmap['topic'];
            }
        }

        return $groupedRoadmaps;
    }

    public function checkyear(){
        $uniqueYears = $this->model('RoadmapsModel')->getYears();

        foreach ($uniqueYears as $year) {
            var_dump("Periode: " . $year['year_start'] . " - " . $year['year_end']);
        }
    }

    public function addRoadmap(){

        $year_start = $_POST['year_start'];
        $year_end = $_POST['year_end'];
        $data = [];
    
        foreach($_POST as $key => $value){
            if (strpos($key, 'topic_') === 0) {
                $parts = explode('_', $key); // Hasil: ['topic', '0', '0'], ['category', '0']
    
                $category_index = $parts[1]; // Ambil index ke 1 dari $parts'
                $category_key = "category_" . $category_index; // Buat key kategori berdasarkan index kategori
                $category_name = $_POST[$category_key] ?? null; // mengecek apakah $_POST[$category_key] ada di $_POST atau tidak contoh : $category_key = 'category_0'.Apakah $_POST['category_0'] ada di post atau tidak.
    
                // Cek apakah kategori ditemukan, jika ya, simpan data
                if ($category_name  && !empty($value)) {
                    $data[] = [
                        'year_start' => $year_start,
                        'year_end' => $year_end,
                        'category' => $category_name,
                        'topic' => $value
                    ];
                }
            }
        }
    
        if ($this->model('RoadmapsModel')->addRoadmaps($data) > 0) {
            header('Location: ' . BASEURL . '/roadmap');
            echo "tambah data berhasil";
        } else {
            echo
            '<script/>
                    alert("tambah data gagal");
                </script>';
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
        $year_start = $_POST['year_start'];
        $year_end = $_POST['year_end'];

        if ($this->model('RoadmapsModel')->deleteRoadmap($year_start, $year_end) > 0) {
            foreach($_POST as $key => $value){
                if (strpos($key, 'topic_') === 0) {
                    $parts = explode('_', $key); // Hasil: ['topic', '0', '0'], ['category', '0']
        
                    $category_index = $parts[1]; // Ambil index ke 1 dari $parts'
                    $category_key = "category_" . $category_index; // Buat key kategori berdasarkan index kategori
                    $category_name = $_POST[$category_key] ?? null; // mengecek apakah $_POST[$category_key] ada di $_POST atau tidak contoh : $category_key = 'category_0'.Apakah $_POST['category_0'] ada di post atau tidak.
        
                    // Cek apakah kategori ditemukan, jika ya, simpan data
                    if ($category_name  && !empty($value)) {
                        $data[] = [
                            'year_start' => $year_start,
                            'year_end' => $year_end,
                            'category' => $category_name,
                            'topic' => $value
                        ];
                    }
                }
            }
        
            if ($this->model('RoadmapsModel')->addRoadmaps($data) > 0) {
                header('Location: ' . BASEURL . '/roadmap');
                echo "update data berhasil";
            } else {
                echo
                '<script/>
                        alert("update data gagal");
                    </script>';
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data']);
        }

        // var_dump($_POST);

        // var_dump($year_start);
        // var_dump($year_end);
    }
}