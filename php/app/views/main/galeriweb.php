<?php
session_start();
//var_dump($data);
?>
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
            background: rgba(255, 50, 50, 0.9);
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
            background: linear-gradient(135deg, #f9f1f5 25%, #f0e2e8 25%);
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
                    Dokumentasi
                </span>
            <h2 class="text-5xl font-bold mb-6 text-red-900">
                Galeri Kegiatan
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-red-600 to-red-800 rounded-full"></div>
        </div>

        <!-- Topics Navigation -->
        <div class="flex gap-8 mb-16 overflow-x-auto pb-4 -mx-6 px-6">
            <?php
            $topics = ['Semua', 'DIPA SWADANA', 'DIPA PNBP', 'Tesis Magister'];
            foreach ($topics as $index => $topic): ?>
                <button class="topic-button px-4 py-2 text-gray-600 hover:text-red-600 font-medium transition-all whitespace-nowrap <?php echo $index === 0 ? 'active' : ''; ?>">
                    <?php echo $topic; ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($data['galeri'] as $index => $item): ?>
                <div class="gallery-item group" style="animation-delay: <?php echo $index * 0.1; ?>s">
                    <div class="image-container">
                        <div class="image-placeholder">
                            <img src="<?= GALLERY; ?>/files/<?php echo $item['image']; ?>"
                                 alt="<?php echo $item['title']; ?>" class="w-full h-full object-cover">
                        </div>
                        <div class="image-overlay">
                    <span class="text-sm font-semibold text-red-100 mb-2">
                        <?php echo $item['category']; ?> • <?php echo date('d M Y', strtotime($item['created_at'])); ?>
                    </span>
                            <h3 class="text-xl font-bold text-white mb-3">
                                <?php echo $item['title']; ?>
                            </h3>
                            <p class="text-red-100 text-sm leading-relaxed">
                                <?php echo $item['description']; ?>
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-bold text-red-900 group-hover:text-red-600 transition-colors duration-300">
                            <?php echo $item['title']; ?>
                        </h3>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Add this modal HTML at the end of your body -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
    <div class="relative max-w-4xl w-full">
        <button id="closeModal" class="absolute top-2 right-2 text-white text-2xl">&times;</button>
        <img id="modalImage" class="w-full h-auto rounded-lg shadow-lg" src="" alt="Preview">
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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