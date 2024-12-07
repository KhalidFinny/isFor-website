<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Agenda - IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/IsFor-website/php/app/views/assets/css/inandout.css">
    <script src="http://localhost/IsFor-website/php/app/views/assets/js/animations.js" defer></script>
    <style>
        .agenda-item {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .agenda-item.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .number-label {
            font-family: 'Space Grotesk', sans-serif;
            color: #E5E7EB;
            transition: color 0.3s ease;
        }
        
        .agenda-item:hover .number-label {
            color: #93C5FD;
        }
    </style>
    <title>Agenda - IsFor Internet of Things For Human Life's</title>
</head>
    <?php if (!isset($_SESSION['user_id'])) : ?>
        <?php include_once '../app/views/assets/components/navbar.php'; ?>
    <?php else : ?>
        <?php include_once '../app/views/assets/components/navbarafterlogin.php'; ?>
    <?php endif; ?>
<section class="min-h-screen py-20 relative overflow-hidden bg-white">
    <div class="container mx-auto px-6 max-w-4xl">
        <!-- Header -->
        <div class="mb-20">
            <span class="inline-block px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-sm font-medium mb-4">
                Agenda Riset
            </span>
            <h2 class="text-5xl font-bold mb-6 text-blue-900">
                Fokus Penelitian
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full"></div>
        </div>

        <!-- Agenda Items -->
        <div class="space-y-8">
            <?php
            $agendaTopics = [
                [
                    "number" => "01",
                    "title" => "Artificial Intelligence & Machine Learning",
                    "description" => "Pengembangan sistem cerdas dan pembelajaran mesin untuk solusi inovatif"
                ],
                [
                    "number" => "02",
                    "title" => "Internet of Things (IoT)",
                    "description" => "Implementasi teknologi IoT untuk smart city dan industri 4.0"
                ],
                [
                    "number" => "03",
                    "title" => "Cybersecurity",
                    "description" => "Penelitian keamanan siber dan perlindungan infrastruktur digital"
                ],
                [
                    "number" => "04",
                    "title" => "Big Data Analytics",
                    "description" => "Analisis data skala besar untuk pengambilan keputusan"
                ],
                [
                    "number" => "05",
                    "title" => "Cloud Computing",
                    "description" => "Pengembangan infrastruktur dan layanan berbasis cloud"
                ],
                [
                    "number" => "06",
                    "title" => "Software Engineering",
                    "description" => "Metodologi dan praktik terbaik dalam pengembangan perangkat lunak"
                ]
            ];

            if(empty($data['agenda'])){
                foreach ($agendaTopics as $topic){
                    ?>
                    <div class="agenda-item group">
                        <div class="flex items-start space-x-8 p-8 border-2 border-gray-100 hover:border-blue-200 transition-all duration-300">
                            <div class="number-label text-6xl font-bold leading-none">
                                <?php echo $topic['number']; ?>
                            </div>
                            <div class="flex-1 pt-2">
                                <h3 class="text-2xl font-bold text-blue-900 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                                    <?php echo $topic['title']; ?>
                                </h3>
                                <p class="text-gray-600 leading-relaxed">
                                    <?php echo $topic['description']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                foreach ($data['agenda'] as $topic):
                    ?>
                    <div class="agenda-item group">
                        <div class="flex items-start space-x-8 p-8 border-2 border-gray-100 hover:border-blue-200 transition-all duration-300">
                            <div class="number-label text-6xl font-bold leading-none">
                                <?php echo $data['no']++; ?>
                            </div>
                            <div class="flex-1 pt-2">
                                <h3 class="text-2xl font-bold text-blue-900 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                                    <?php echo $topic['title']; ?>
                                </h3>
                                <p class="text-gray-600 leading-relaxed">
                                    <?php echo $topic['description']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php } ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('visible');
                        }, index * 100);
                    }
                });
            }, {
                threshold: 0.1
            });

            const items = document.querySelectorAll('.agenda-item');
            items.forEach(item => {
                observer.observe(item);
            });
        });
    </script>
</section>
</html>