<?php
session_start();
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
    <link rel="stylesheet" href="<?= CSS; ?>/main/gallery-web.css">
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
            <div class="container-galleries grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 p-6">
                <?php if (empty($data['galleries'])): ?>
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-10">
                        <p class="text-gray-500 text-lg">
                            Belum ada data saat ini.
                        </p>
                    </div>
                <?php else: ?>
                    <?php foreach ($data['galleries'] as $index => $item): ?>
                        <div class="gallery-item group border border-red-600 bg-white rounded-xl hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-red-500"
                            style="animation-delay: <?php echo $index * 0.1; ?>s">
                            <div class="image-container cursor-pointer relative" onclick="showImagePreview(
                                '<?= GALLERY; ?>/<?php echo $item['image']; ?>',
                                '<?php echo htmlspecialchars($item['title'], ENT_QUOTES); ?>',
                                '<?php echo htmlspecialchars($item['category'], ENT_QUOTES); ?>',
                                '<?php echo date('d M Y', strtotime($item['created_at'])); ?>',
                                '<?php echo htmlspecialchars($item['description'], ENT_QUOTES); ?>'
                                )">
                                <div class="image-placeholder aspect-video">
                                    <img src="<?= GALLERY; ?>/<?php echo $item['image']; ?>"
                                        alt="<?php echo htmlspecialchars($item['title'], ENT_QUOTES); ?>"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="image-overlay absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-6 flex flex-col justify-end">
                                    <span class="text-sm font-medium text-gray-200 mb-2">
                                        <?php echo $item['category']; ?> · <?php echo date('d M Y', strtotime($item['created_at'])); ?>
                                    </span>
                                    <h3 class="text-xl font-bold text-white mb-2">
                                        <?php echo $item['title']; ?>
                                    </h3>
                                    <p class="text-gray-200 text-sm leading-relaxed line-clamp-2">
                                        <?php echo $item['description']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="px-6 py-4 flex justify-between items-center border-t border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-800 group-hover:text-red-600 transition-colors duration-300 line-clamp-1">
                                    <?php echo $item['title']; ?>
                                </h3>
                                <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1): ?>
                                    <button onclick="deleteImage(<?= $item['gallery_id']; ?>)"
                                        class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                        title="Delete">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php
            // Fungsi helper untuk membuat rentang halaman dengan ellipsis
            function getPaginationRange($totalPages, $currentPage, $delta = 2)
            {
                $range = [];
                $left = $currentPage - $delta;
                $right = $currentPage + $delta;
                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i == 1 || $i == $totalPages || ($i >= $left && $i <= $right)) {
                        $range[] = $i;
                    } elseif (end($range) !== '...') {
                        $range[] = '...';
                    }
                }
                return $range;
            }
            ?>

            <!-- Pagination -->
            <nav aria-label="Page navigation example" id="pagination">
                <ul class="flex items-center -space-x-px h-8 text-sm">
                    <!-- Tombol Previous -->
                    <?php if ($data['currentPage'] > 1) : ?>
                        <li>
                            <a href="?page=<?= $data['currentPage'] - 1 ?>"
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                                <span class="sr-only">Previous</span>
                                <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php
                    $pageRange = getPaginationRange($data['totalPages'], $data['currentPage']);
                    foreach ($pageRange as $item) :
                        if ($item === '...') : ?>
                            <li>
                                <span class="flex items-center justify-center px-3 h-8 text-gray-500">...</span>
                            </li>
                        <?php elseif ($item == $data['currentPage']) : ?>
                            <li>
                                <a href="?page=<?= $item; ?>" aria-current="page"
                                    class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-red-600 border border-red-300 bg-red-50 hover:bg-red-100 hover:text-red-700">
                                    <?= $item; ?>
                                </a>
                            </li>
                        <?php else : ?>
                            <li>
                                <a href="?page=<?= $item; ?>"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                    <?= $item; ?>
                                </a>
                            </li>
                    <?php endif;
                    endforeach; ?>

                    <!-- Tombol Next -->
                    <?php if ($data['currentPage'] < $data['totalPages']) : ?>
                        <li>
                            <a href="?page=<?= $data['currentPage'] + 1 ?>"
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                                <span class="sr-only">Next</span>
                                <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Container gambar dan info dengan animasi -->
            <div class="relative max-w-7xl w-full flex flex-col md:flex-row gap-8 items-center 
                    opacity-0 translate-y-4 transition-all duration-500 ease-out" id="previewContent">
                <!-- Container gambar dengan zoom -->
                <div class="flex-1 relative overflow-hidden rounded-2xl">
                    <!-- Container gambar dengan padding -->
                    <img id="previewImage"
                        class="w-full h-auto max-h-[80vh] max-w-[80vw] object-contain transition-transform duration-300 ease-in-out"
                        src="" alt="" style="max-width: 100vw; max-height: 90vh; object-fit: contain;"
                        onload="adjustImageSize(this)"
                        onmousemove="zoomImage(event)"
                        onmouseout="resetZoom()">

                </div>

                <!-- Floating info panel dengan animasi -->
                <div class="flex-1 md:w-64 bg-white rounded-2xl p-4 space-y-2 transform transition-all duration-500 shadow-lg text-center">
                    <h3 id="previewTitle" class="text-xl font-bold text-red-900"></h3>
                    <div class="space-y-1">
                        <p id="previewCategory" class="text-lg font-bold text-red-600"></p>
                        <p id="previewDate" class="text-lg font-bold text-red-600"></p>
                    </div>
                    <p id="previewDescription" class="text-gray-600 text-sm leading-relaxed"></p>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteImage(imageId) {
            if (confirm('Are you sure you want to delete this file?')) {
                $.ajax({
                    url: '<?= BASEURL ?>/galleries/deleteImage',
                    type: 'POST',
                    data: {
                        gallery_id: imageId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            window.location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            }
        }

        function filter(status, page = 1) {
            $.ajax({
                url: '<?= BASEURL ?>/home/filterGallery',
                method: 'POST',
                contentType: 'application/json',
                dataType: 'json',
                data: JSON.stringify({
                    status: status,
                    page: page
                }),
                success: function(response) {
                    const galleryContainer = document.querySelector(".container-galleries");
                    const navElement = document.querySelector('nav[aria-label="Page navigation example"]');
                    const ul = document.createElement('ul');

                    galleryContainer.innerHTML = '';
                    navElement.innerHTML = '';
                    ul.className = 'flex items-center -space-x-px h-8 text-sm';

                    // Menampilkan data galeri
                    if (response.data && response.data.length > 0) {
                        response.data.forEach(gallery => {
                            const formattedDate = new Date(gallery.created_at).toLocaleDateString('id-ID', {
                                day: '2-digit',
                                month: 'short',
                                year: 'numeric',
                            });

                            const fileHTML = `
                        <div class="gallery-item group visible" style="animation-delay: 0.1s">
                            <div class="image-container cursor-pointer" onclick="showImagePreview(
                                '<?= GALLERY; ?>/${gallery.image}',
                                '${gallery.title.replace(/'/g, "\\'")}',
                                '${gallery.category.replace(/'/g, "\\'")}',
                                '${formattedDate}',
                                '${gallery.description.replace(/'/g, "\\'")}'
                            )">
                                <div class="image-placeholder">
                                    <img src="<?= GALLERY; ?>/${gallery.image}" alt="${gallery.title}" class="w-full h-full object-cover">
                                </div>
                                <div class="image-overlay">
                                    <span class="text-xl font-bold text-white mb-2">
                                        ${gallery.category} · ${formattedDate}
                                    </span>
                                    <h3 class="text-xl font-bold text-white mb-3">
                                        ${gallery.title}
                                    </h3>
                                    <p class="text-red-100 text-sm leading-relaxed">
                                        ${gallery.description}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-4 flex justify-between items-center">
                                <h3 class="text-lg font-bold text-red-900 group-hover:text-red-600 transition-colors duration-300">
                                    ${gallery.title}
                                </h3>
                                <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1): ?>
                                    <button onclick="deleteImage(${gallery.gallery_id})"
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
                    } else {
                        // Jika tidak ada data
                        galleryContainer.innerHTML = `
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-10">
                        <p class="text-gray-500 text-lg">Belum ada data saat ini.</p>
                    </div>`;
                    }

                    // Cek apakah perlu pagination
                    if (response.total > response.limit) {
                        const totalPages = response.totalPages;
                        const currentPage = response.page;

                        // Fungsi helper untuk membuat rentang halaman + ellipsis
                        function getPaginationRange(totalPages, currentPage, delta = 2) {
                            const range = [];
                            const left = currentPage - delta;
                            const right = currentPage + delta;
                            for (let i = 1; i <= totalPages; i++) {
                                if (i === 1 || i === totalPages || (i >= left && i <= right)) {
                                    range.push(i);
                                } else if (range[range.length - 1] !== '...') {
                                    range.push('...');
                                }
                            }
                            return range;
                        }

                        const pageRange = getPaginationRange(totalPages, currentPage);

                        // Tombol "Previous"
                        if (currentPage > 1) {
                            ul.innerHTML += `
                        <li>
                            <a href="javascript:void(0)" onclick="filter(${status}, ${currentPage - 1})"
                               class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                                <span class="sr-only">Previous</span>
                                <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="M5 1 1 5l4 4"/>
                                </svg>
                            </a>
                        </li>
                    `;
                        }

                        // Loop berdasarkan pageRange
                        pageRange.forEach(item => {
                            if (item === '...') {
                                ul.innerHTML += `
                            <li>
                                <span class="flex items-center justify-center px-3 h-8 text-gray-500">...</span>
                            </li>
                        `;
                            } else if (item === currentPage) {
                                // Halaman aktif
                                ul.innerHTML += `
                            <li>
                                <a href="javascript:void(0)" aria-current="page"
                                   class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-red-600 border border-red-300 bg-red-50 hover:bg-red-100 hover:text-red-700">
                                    ${item}
                                </a>
                            </li>
                        `;
                            } else {
                                // Halaman biasa
                                ul.innerHTML += `
                            <li>
                                <a href="javascript:void(0)" onclick="filter(${status}, ${item})"
                                   class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                    ${item}
                                </a>
                            </li>
                        `;
                            }
                        });

                        // Tombol "Next"
                        if (currentPage < totalPages) {
                            ul.innerHTML += `
                        <li>
                            <a href="javascript:void(0)" onclick="filter(${status}, ${currentPage + 1})"
                               class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                                <span class="sr-only">Next</span>
                                <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                            </a>
                        </li>
                    `;
                        }

                        navElement.appendChild(ul);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memuat galeri.');
                }
            });
        }

        function showImagePreview(imageUrl, title, category, date, description) {
            const $modal = $('#imagePreviewModal');
            const $content = $('#previewContent');
            const $image = $('#previewImage');
            const $titleEl = $('#previewTitle');
            const $categoryEl = $('#previewCategory');
            const $dateEl = $('#previewDate');
            const $descriptionEl = $('#previewDescription');

            $image.attr('src', imageUrl);
            $titleEl.text(title);
            $categoryEl.text(category);
            $dateEl.text(date);
            $descriptionEl.text(description);

            $modal.addClass('modal-open');
            setTimeout(() => {
                $content.addClass('content-show');
            }, 100);

            $('body').css('overflow', 'hidden');

            initializeZoom($image[0]);
        }

        function initializeZoom(image) {
            const $image = $(image);
            let scale = 1;
            let panning = false;
            let pointX = 0;
            let pointY = 0;
            let start = {
                x: 0,
                y: 0
            };

            $image.addClass('zoom-active');

            // Double click to reset zoom
            $image.on('dblclick', () => {
                scale = 1;
                pointX = 0;
                pointY = 0;
                $image.css('transform', `translate(0px, 0px) scale(1)`);
                $image.removeClass('zoomed');
            });

            // Mouse wheel zoom
            $image.on('wheel', (e) => {
                e.preventDefault();
                const xs = (e.originalEvent.clientX - pointX) / scale;
                const ys = (e.originalEvent.clientY - pointY) / scale;

                if (e.originalEvent.deltaY < 0) {
                    scale *= 1.1;
                    $image.addClass('zoomed');
                } else {
                    scale /= 1.1;
                    if (scale <= 1) {
                        scale = 1;
                        $image.removeClass('zoomed');
                    }
                }

                scale = Math.min(Math.max(1, scale), 4);
                pointX = e.originalEvent.clientX - xs * scale;
                pointY = e.originalEvent.clientY - ys * scale;

                $image.css('transform', `translate(${pointX}px, ${pointY}px) scale(${scale})`);
            });

            // Pan functionality
            $image.on('mousedown', (e) => {
                e.preventDefault();
                if (scale > 1) {
                    start = {
                        x: e.clientX - pointX,
                        y: e.clientY - pointY
                    };
                    panning = true;
                }
            });

            $(document).on('mousemove', (e) => {
                if (!panning) return;
                e.preventDefault();
                pointX = e.clientX - start.x;
                pointY = e.clientY - start.y;
                $image.css('transform', `translate(${pointX}px, ${pointY}px) scale(${scale})`);
            });

            $(document).on('mouseup mouseleave', () => {
                panning = false;
            });
        }

        function closeImagePreview() {
            const $modal = $('#imagePreviewModal');
            const $content = $('#previewContent');
            const $image = $('#previewImage');

            $content.removeClass('content-show');
            setTimeout(() => {
                $modal.removeClass('modal-open');
                $image.css('transform', 'translate(0px, 0px) scale(1)');
                $image.removeClass('zoomed');
                $('body').css('overflow', '');
            }, 300);
        }

        // Atur ulang ukuran gambar agar memenuhi container jika gambar lebih kecil dari container
        function adjustImageSize(image) {
            const $img = $(image);
            // Misalnya, jika container berukuran 80vw x 80vh, dan kita ingin gambar memenuhi container
            const containerWidth = $(window).width() * 0.8;
            const containerHeight = $(window).height() * 0.8;
            // Ambil dimensi asli gambar
            const naturalWidth = image.naturalWidth;
            const naturalHeight = image.naturalHeight;
            // Hitung faktor skala berdasarkan container dan dimensi gambar
            const scaleWidth = containerWidth / naturalWidth;
            const scaleHeight = containerHeight / naturalHeight;
            const scale = Math.min(scaleWidth, scaleHeight, 1); // jangan lebih besar dari 1 untuk gambar asli
            $img.css('transform', `scale(${scale})`);
        }

        // Implementasi fungsi zoomImage dengan menggunakan wheel event
        function zoomImage(event) {
            event.preventDefault();
            if (!event.originalEvent || typeof event.originalEvent.deltaY === 'undefined') {
                return; // Jika tidak ada properti deltaY, jangan lakukan apa-apa.
            }
            const $image = $('#previewImage');
            const transform = $image.css('transform');
            let scale = 1,
                translateX = 0,
                translateY = 0;
            if (transform !== 'none') {
                const values = transform.match(/matrix.*\((.+)\)/)[1].split(', ');
                scale = parseFloat(values[0]);
                translateX = parseFloat(values[4]);
                translateY = parseFloat(values[5]);
            }

            const zoomFactor = 1.1;
            const mouseX = event.clientX;
            const mouseY = event.clientY;

            if (event.originalEvent.deltaY < 0) {
                scale *= zoomFactor;
            } else {
                scale /= zoomFactor;
            }
            scale = Math.min(Math.max(scale, 1), 4);

            $image.css('transform', `translate(${translateX}px, ${translateY}px) scale(${scale})`);
        }


        // Reset zoom mengembalikan transform ke nilai default
        function resetZoom() {
            const $image = $('#previewImage');
            $image.css('transform', 'translate(0px, 0px) scale(1)');
        }


        $(document).ready(function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            $(entry.target).addClass('visible');
                        }, index * 100);
                    }
                });
            }, {
                threshold: 0.1
            });

            const $topicButtons = $('.topic-button');
            $topicButtons.on('click', function() {
                $topicButtons.removeClass('active');
                $(this).addClass('active');
            });

            const $galleryItems = $('.gallery-item');
            $galleryItems.each(function() {
                observer.observe(this);
            });

            $galleryItems.on('click', function() {
                $(this).toggleClass('zoomed');
            });
        });
    </script>

</body>

</html>