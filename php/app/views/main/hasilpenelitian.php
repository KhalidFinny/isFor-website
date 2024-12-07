<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Penelitian</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        .poster-item {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .poster-item.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .poster-container {
            position: relative;
            overflow: hidden;
            aspect-ratio: 3/4; /* Portrait ratio for posters */
        }

        .poster-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 50, 50, 0.9);
            opacity: 0;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2rem;
            cursor: pointer;
        }

        .poster-item:hover .poster-overlay {
            opacity: 1;
        }

        .poster-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #fcf8fa 0%, #f0e2e8 100%);
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed #f0e2e8;
        }

        .poster-item.zoomed .poster-placeholder {
            transform: scale(1.1);
        }

        .topic-button {
            position: relative;
            transition: all 0.3s ease;
        }

        .topic-button::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: #eb2563;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .topic-button:hover::after,
        .topic-button.active::after {
            width: 100%;
        }

        .topic-button.active {
            color: #eb2563;
        }
    </style>
</head>
<body class="bg-white">
    <?php if (!isset($_SESSION['user_id'])) : ?>
        <?php include_once '../app/views/assets/components/navbar.php'; ?>
    <?php else : ?>
        <?php include_once '../app/views/assets/components/navbarafterlogin.php'; ?>
    <?php endif; ?>
    <section class="min-h-screen py-20 relative overflow-hidden">
        <div class="container mx-auto px-6 max-w-7xl">
            <!-- Header -->
            <div class="mb-20">
                <span class="inline-block px-4 py-2 bg-red-50 text-red-600 rounded-full text-sm font-medium mb-4">
                    Hasil Penelitian
                </span>
                <h2 class="text-5xl font-bold mb-6 text-red-900">
                    Poster & Publikasi
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-red-600 to-red-800 rounded-full"></div>
            </div>

            <!-- Topics Navigation -->
            <div class="flex gap-8 mb-16 overflow-x-auto pb-4 -mx-6 px-6">
                <?php
                $topics = ['Semua', 'AI & ML', 'IoT', 'Cybersecurity', 'Big Data', 'Cloud Computing', 'Software Engineering'];
                foreach ($topics as $index => $topic): ?>
                    <button class="topic-button px-4 py-2 text-gray-600 hover:text-red-600 font-medium transition-all whitespace-nowrap <?php echo $index === 0 ? 'active' : ''; ?>">
                        <?php echo $topic; ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- Poster Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <?php
                $posterItems = [
                    [
                        "title" => "Implementasi Deep Learning untuk Deteksi Anomali",
                        "category" => "AI & ML",
                        "authors" => "Dr. Budi Santoso, et al.",
                        "year" => "2024",
                        "abstract" => "Penelitian tentang penggunaan deep learning dalam mendeteksi anomali pada sistem keamanan"
                    ],
                    [
                        "title" => "Smart City IoT Framework",
                        "category" => "IoT",
                        "authors" => "Prof. Dewi Putri, et al.",
                        "year" => "2023",
                        "abstract" => "Framework IoT untuk implementasi smart city di Indonesia"
                    ],
                    [
                        "title" => "Blockchain untuk Keamanan Data",
                        "category" => "Cybersecurity",
                        "authors" => "Dr. Ahmad Wijaya, et al.",
                        "year" => "2024",
                        "abstract" => "Implementasi blockchain dalam pengamanan data sensitif"
                    ],
                    [
                        "title" => "Analisis Big Data untuk Smart Governance",
                        "category" => "Big Data",
                        "authors" => "Dr. Sarah Putri, et al.",
                        "year" => "2023",
                        "abstract" => "Pemanfaatan big data analytics dalam tata kelola pemerintahan"
                    ]
                ];

                foreach ($posterItems as $index => $item): ?>
                    <div class="poster-item group" style="animation-delay: <?php echo $index * 0.1; ?>s">
                        <div class="poster-container">
                            <div class="poster-placeholder">
                                <span class="text-gray-400">Poster Preview</span>
                            </div>
                            <div class="poster-overlay">
                                <span class="text-sm font-semibold text-red-100 mb-2">
                                    <?php echo $item['category']; ?> • <?php echo $item['year']; ?>
                                </span>
                                <h3 class="text-xl font-bold text-white mb-3">
                                    <?php echo $item['title']; ?>
                                </h3>
                                <p class="text-red-100 text-sm mb-4">
                                    <?php echo $item['authors']; ?>
                                </p>
                                <p class="text-red-100 text-sm leading-relaxed">
                                    <?php echo $item['abstract']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-sm font-medium text-red-600">
                                <?php echo $item['category']; ?>
                            </span>
                            <h3 class="text-lg font-bold text-red-900 group-hover:text-red-600 transition-colors duration-300 mt-1">
                                <?php echo $item['title']; ?>
                            </h3>
                            <p class="text-gray-600 text-sm mt-1">
                                <?php echo $item['authors']; ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

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

            const topicButtons = document.querySelectorAll('.topic-button');
            topicButtons.forEach(button => {
                button.addEventListener('click', () => {
                    topicButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                });
            });

            const posterItems = document.querySelectorAll('.poster-item');
            posterItems.forEach(item => {
                observer.observe(item);
                
                item.addEventListener('click', () => {
                    item.classList.toggle('zoomed');
                });
            });
        });
    </script>
</body>
</html>