<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .gallery-item {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .gallery-item.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .image-container {
            position: relative;
            overflow: hidden;
            aspect-ratio: 4/3;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(37, 99, 235, 0.9);
            opacity: 0;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2rem;
            cursor: pointer;
        }

        .gallery-item:hover .image-overlay {
            opacity: 1;
        }

        .image-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #f1f5f9 25%, #e2e8f0 25%);
            transition: transform 0.3s ease;
        }

        .gallery-item.zoomed .image-placeholder {
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
            background: #2563eb;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .topic-button:hover::after,
        .topic-button.active::after {
            width: 100%;
        }

        .topic-button.active {
            color: #2563eb;
        }
    </style>
</head>
<body class="bg-white">
    <section class="min-h-screen py-20 relative overflow-hidden">
        <div class="container mx-auto px-6 max-w-7xl">
            <!-- Header -->
            <div class="mb-20">
                <span class="inline-block px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-sm font-medium mb-4">
                    Dokumentasi
                </span>
                <h2 class="text-5xl font-bold mb-6 text-blue-900">
                    Galeri Kegiatan
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full"></div>
            </div>

            <!-- Topics Navigation -->
            <div class="flex gap-8 mb-16 overflow-x-auto pb-4 -mx-6 px-6">
                <?php
$topics = ['Semua', 'Penelitian', 'Workshop', 'Seminar', 'Kolaborasi', 'Publikasi'];
foreach ($topics as $index => $topic): ?>
                    <button class="topic-button px-4 py-2 text-gray-600 hover:text-blue-600 font-medium transition-all whitespace-nowrap <?php echo $index === 0 ? 'active' : ''; ?>">
                        <?php echo $topic; ?>
                    </button>
                <?php endforeach;?>
            </div>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
$galleryItems = [
    [
        "title" => "Workshop AI & Machine Learning",
        "category" => "Workshop",
        "date" => "15 Oktober 2023",
        "description" => "Sesi pembelajaran mendalam tentang implementasi AI dalam industri modern",
    ],
    [
        "title" => "Seminar IoT Development",
        "category" => "Seminar",
        "date" => "3 November 2023",
        "description" => "Diskusi tentang perkembangan IoT dalam smart city",
    ],
    [
        "title" => "Kolaborasi Riset Cybersecurity",
        "category" => "Kolaborasi",
        "date" => "8 Desember 2023",
        "description" => "Kerjasama penelitian dengan institusi internasional",
    ],
    [
        "title" => "Publikasi Penelitian Big Data",
        "category" => "Publikasi",
        "date" => "22 Januari 2024",
        "description" => "Hasil penelitian analisis big data untuk smart governance",
    ],
    [
        "title" => "Workshop Cloud Computing",
        "category" => "Workshop",
        "date" => "15 Februari 2024",
        "description" => "Pelatihan implementasi cloud infrastructure",
    ],
    [
        "title" => "Seminar Software Engineering",
        "category" => "Seminar",
        "date" => "1 Maret 2024",
        "description" => "Best practices dalam pengembangan software modern",
    ],
];

foreach ($galleryItems as $index => $item): ?>
                    <div class="gallery-item group" style="animation-delay: <?php echo $index * 0.1; ?>s">
                        <div class="image-container">
                            <div class="image-placeholder"></div>
                            <div class="image-overlay">
                                <span class="text-sm font-semibold text-blue-100 mb-2">
                                    <?php echo $item['category']; ?> • <?php echo $item['date']; ?>
                                </span>
                                <h3 class="text-xl font-bold text-white mb-3">
                                    <?php echo $item['title']; ?>
                                </h3>
                                <p class="text-blue-100 text-sm leading-relaxed">
                                    <?php echo $item['description']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-lg font-bold text-blue-900 group-hover:text-blue-600 transition-colors duration-300">
                                <?php echo $item['title']; ?>
                            </h3>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Intersection Observer for fade-in animation
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

            // Topic button interactions
            const topicButtons = document.querySelectorAll('.topic-button');
            topicButtons.forEach(button => {
                button.addEventListener('click', () => {
                    topicButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                });
            });

            // Gallery item zoom functionality
            const galleryItems = document.querySelectorAll('.gallery-item');
            galleryItems.forEach(item => {
                observer.observe(item);
                item.addEventListener('click', () => {
                    item.classList.toggle('zoomed');
                });
            });
        });
    </script>
</body>
</html>