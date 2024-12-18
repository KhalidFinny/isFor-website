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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        .modal-open {
            opacity: 1 !important;
            visibility: visible !important;
        }

        .content-show {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }

        .zoom-active {
            cursor: zoom-in;
        }

        .zoom-active.zoomed {
            cursor: grab;
        }

        .zoom-active.zoomed:active {
            cursor: grabbing;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .gallery-item {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="bg-white">
<?php if (!isset($_SESSION['user_id'])): ?>
    <?php include_once '../app/views/assets/components/navbar.php'; ?>
<?php else: ?>
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
            $topics = ['Semua', 'DIPA SWADANA', 'DIPA PNBP', 'Tesis Magister', 'Berita'];
            foreach ($topics as $index => $topic): ?>
                <button class="topic-button px-4 py-2 text-gray-600 hover:text-red-600 font-medium transition-all whitespace-nowrap <?php echo $index === 0 ? 'active' : ''; ?>"
                        onclick="filter(<?php echo $index; ?>)">
                    <?php echo $topic; ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Gallery Grid -->
        <div class="container-galleries grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($data['galleries'] as $index => $item): ?>
                <div class="gallery-item group" style="animation-delay: <?php echo $index * 0.1; ?>s">
                    <div class="image-container cursor-pointer" onclick="showImagePreview(
                            '<?= GALLERY; ?>/files/<?php echo $item['image']; ?>',
                            '<?php echo htmlspecialchars($item['title'], ENT_QUOTES); ?>',
                            '<?php echo htmlspecialchars($item['category'], ENT_QUOTES); ?>',
                            '<?php echo date('d M Y', strtotime($item['created_at'])); ?>',
                            '<?php echo htmlspecialchars($item['description'], ENT_QUOTES); ?>'
                            )">
                        <div class="image-placeholder">
                            <img src="<?= GALLERY; ?>/files/<?php echo $item['image']; ?>"
                                 alt="<?php echo htmlspecialchars($item['title'], ENT_QUOTES); ?>"
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="image-overlay">
                    <span class="text-xl font-bold text-white mb-2">
                        <?php echo $item['category']; ?> · <?php echo date('d M Y', strtotime($item['created_at'])); ?>
                    </span>
                            <h3 class="text-xl font-bold text-white mb-3">
                                <?php echo $item['title']; ?>
                            </h3>
                            <p class="text-red-100 text-sm leading-relaxed">
                                <?php echo $item['description']; ?>
                            </p>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-red-900 group-hover:text-red-600 transition-colors duration-300">
                            <?php echo $item['title']; ?>
                        </h3>

                        <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1): ?>
                            <button onclick="deleteImage(<?= $item['gallery_id']; ?>)"
                                    class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                    title="Delete">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="flex items-center -space-x-px h-8 text-sm">
                <li>
                    <?php if ($data['currentPage'] > 1) : ?>
                        <a href="?halaman=<?= $data['currentPage'] - 1 ?>"
                           class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Previous</span>
                            <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </li>
                <?php for ($i = 1; $i <= $data['totalPages']; $i++) : ?>
                    <?php if ($i == $data['currentPage']) : ?>
                        <li>
                            <a href="?page=<?= $i; ?>" aria-current="page"
                               class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-red-600 border border-red-300 bg-red-50 hover:bg-red-100 hover:text-red-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"><?= $i; ?></a>
                        </li>
                    <?php else : ?>
                        <li>
                            <a href="?page=<?= $i; ?>"
                               class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><?= $i; ?></a>
                        </li>
                    <?php endif; ?>
                <?php endfor; ?>
                <li>
                    <?php if ($data['currentPage'] < $data['totalPages']) : ?>
                        <a href="?page=<?= $data['currentPage'] + 1 ?>"
                           class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Next</span>
                            <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </div>
</section>

<!-- Add this modal HTML at the end of your body -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
    <div class="relative max-w-4xl w-full">
        <button id="closeModal" class="absolute top-2 right-2 text-white text-2xl">&times;</button>
        <img id="modalImage" class="w-full h-auto rounded-lg shadow-lg" src="" alt="Preview">
    </div>
</div>
<!-- Add this modal HTML at the end of your body -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
    <div class="relative max-w-4xl w-full">
        <button id="closeModal" class="absolute top-2 right-2 text-white text-2xl">&times;</button>
        <img id="modalImage" class="w-full h-auto rounded-lg shadow-lg" src="" alt="Preview">
    </div>
</div>

<!-- Tambahkan modal preview di akhir body sebelum script -->
<div id="imagePreviewModal"
     class="fixed inset-0 bg-black opacity-0 invisible transition-all duration-300 ease-out z-50">
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <!-- Tombol close dengan animasi -->
        <button onclick="closeImagePreview()"
                class="absolute top-4 right-4 text-white hover:text-red-500 z-50 transform hover:scale-110 transition-all duration-300">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Container gambar dan info dengan animasi -->
        <div class="relative max-w-7xl w-full flex flex-col md:flex-row gap-8 items-center 
                    opacity-0 translate-y-4 transition-all duration-500 ease-out" id="previewContent">
            <!-- Container gambar dengan zoom -->
            <div class="flex-1 relative overflow-hidden rounded-2xl">
                <img id="previewImage"
                     class="w-full h-auto max-h-[80vh] object-contain transform transition-all duration-300"
                     src="" alt="">
            </div>

            <!-- Info panel dengan animasi -->
            <div class="w-full md:w-96 bg-white rounded-2xl p-6 space-y-4 transform transition-all duration-500">
                <h3 id="previewTitle" class="text-2xl font-bold text-red-900"></h3>
                <div class="space-y-2">
                    <p id="previewCategory" class="text-xl font-bold text-red-600"></p>
                    <p id="previewDate" class="text-xl font-bold text-red-600"></p>
                </div>
                <p id="previewDescription" class="text-gray-600 leading-relaxed"></p>
            </div>
        </div>
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

    function deleteImage(ImageId) {
        if (confirm('Are you sure you want to delete this file?')) {
            $.ajax({
                url: '<?= BASEURL ?>/galleries/deleteImage',
                type: 'POST',
                data: {gallery_id: ImageId},
                success: function (response) {
                    console.log(response); // Debug response dari server
                    let result = JSON.parse(response);
                    console.log(result); // Lihat detail debug
                    if (result.success) {
                        alert(result.message);
                        window.location.reload();
                    } else {
                        alert(result.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        }
    }

    // Fungsi untuk menampilkan preview gambar
    function showImagePreview(imageUrl, title, category, date, description) {
        const modal = document.getElementById('imagePreviewModal');
        const content = document.getElementById('previewContent');
        const image = document.getElementById('previewImage');
        const titleEl = document.getElementById('previewTitle');
        const categoryEl = document.getElementById('previewCategory');
        const dateEl = document.getElementById('previewDate');
        const descriptionEl = document.getElementById('previewDescription');

        // Set content
        image.src = imageUrl;
        titleEl.textContent = title;
        categoryEl.textContent = category;
        dateEl.textContent = date;
        descriptionEl.textContent = description;

        // Show modal with animation
        modal.classList.add('modal-open');
        setTimeout(() => {
            content.classList.add('content-show');
        }, 100);

        // Prevent body scroll
        document.body.style.overflow = 'hidden';

        // Initialize zoom functionality
        initializeZoom(image);
    }

    // Separate zoom functionality into its own function
    function initializeZoom(image) {
        let scale = 1;
        let panning = false;
        let pointX = 0;
        let pointY = 0;
        let start = {x: 0, y: 0};

        image.classList.add('zoom-active');

        // Double click to reset zoom
        image.addEventListener('dblclick', () => {
            scale = 1;
            pointX = 0;
            pointY = 0;
            image.style.transform = `translate(0px, 0px) scale(1)`;
            image.classList.remove('zoomed');
        });

        // Mouse wheel zoom
        image.addEventListener('wheel', (e) => {
            e.preventDefault();
            const xs = (e.clientX - pointX) / scale;
            const ys = (e.clientY - pointY) / scale;

            if (e.deltaY < 0) {
                scale *= 1.1;
                image.classList.add('zoomed');
            } else {
                scale /= 1.1;
                if (scale <= 1) {
                    scale = 1;
                    image.classList.remove('zoomed');
                }
            }

            scale = Math.min(Math.max(1, scale), 4);
            pointX = e.clientX - xs * scale;
            pointY = e.clientY - ys * scale;

            image.style.transform = `translate(${pointX}px, ${pointY}px) scale(${scale})`;
        });

        // Pan functionality
        image.addEventListener('mousedown', (e) => {
            e.preventDefault();
            if (scale > 1) {
                start = {x: e.clientX - pointX, y: e.clientY - pointY};
                panning = true;
            }
        });

        image.addEventListener('mousemove', (e) => {
            e.preventDefault();
            if (!panning) return;
            pointX = e.clientX - start.x;
            pointY = e.clientY - start.y;
            image.style.transform = `translate(${pointX}px, ${pointY}px) scale(${scale})`;
        });

        image.addEventListener('mouseup', () => panning = false);
        image.addEventListener('mouseleave', () => panning = false);
    }

    // Make sure closeImagePreview is defined
    function closeImagePreview() {
        const modal = document.getElementById('imagePreviewModal');
        const content = document.getElementById('previewContent');
        const image = document.getElementById('previewImage');

        content.classList.remove('content-show');

        setTimeout(() => {
            modal.classList.remove('modal-open');
            image.style.transform = 'translate(0px, 0px) scale(1)';
            image.classList.remove('zoomed');
            document.body.style.overflow = '';
        }, 300);
    }

    // Remove any existing click handlers from DOMContentLoaded
    document.addEventListener('DOMContentLoaded', function () {
        // Only initialize necessary functionality
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

        document.querySelectorAll('.gallery-item').forEach(item => {
            observer.observe(item);
        });
    });

    function filter(status) {
        $.ajax({
            url: '<?= BASEURL ?>/home/filterGaleri',
            method: 'POST',
            dataType: 'json',
            data: {status: status},
            success: function (data) {
                console.log('Success Response:', data);

                const galleryContainer = document.querySelector(".container-galleries");
                const navElement = document.querySelector('nav[aria-label="Page navigation example"]');

                galleryContainer.innerHTML = '';
                navElement.innerHTML = '';

                data.forEach(galery => {
                    // Format tanggal menggunakan JavaScript
                    const formattedDate = new Date(galery.created_at).toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric',
                    });

                    // Escaping data untuk menghindari error parsing
                    const title = galery.title.replace(/'/g, "\\'");
                    const category = galery.category.replace(/'/g, "\\'");
                    const description = galery.description.replace(/'/g, "\\'");

                    // Template HTML
                    const fileHTML = `
                    <div class="gallery-item group visible" style="animation-delay: 0.1s">
                        <div class="image-container cursor-pointer" onclick="showImagePreview(
                                '<?= GALLERY; ?>/files/${galery.image}',
                                '${title}',
                                '${category}',
                                '${formattedDate}',
                                '${description}'
                            )">
                            <div class="image-placeholder">
                                <img src="<?= GALLERY; ?>/files/${galery.image}" alt="${title}" class="w-full h-full object-cover">
                            </div>
                            <div class="image-overlay">
                                <span class="text-xl font-bold text-white mb-2">
                                    ${category} · ${formattedDate}
                                </span>
                                <h3 class="text-xl font-bold text-white mb-3">
                                    ${title}
                                </h3>
                                <p class="text-red-100 text-sm leading-relaxed">
                                    ${description}
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <h3 class="text-lg font-bold text-red-900 group-hover:text-red-600 transition-colors duration-300">
                                ${title}
                            </h3>
                            <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1): ?>
                                <button onclick="deleteImage(${galery.gallery_id})"
                                        class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                        title="Delete">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    `;

                    galleryContainer.innerHTML += fileHTML;
                });
            },
            error: function (xhr, status, error) {
                alert('An error occurred: ' + error);
            }
        });
    }
</script>
</body>
</html>