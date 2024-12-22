function filter(status, page = 1) {
    $.ajax({
        url: `${BASEURL}/home/filterGallery`, // Endpoint backend
        method: 'POST', // Metode POST
        contentType: 'application/json', // Header Content-Type
        dataType: 'json', // Format respons JSON
        data: JSON.stringify({status: status, page: page}), // Kirim data dalam format JSON
        success: function (response) {
            console.log('Success Response:', response);

            // Seleksi elemen HTML
            const galleryContainer = document.querySelector(".container-galleries");
            const navElement = document.querySelector('nav[aria-label="Page navigation example"]');

            // Kosongkan elemen sebelumnya
            galleryContainer.innerHTML = '';
            navElement.innerHTML = '';

            // Jika ada data galeri
            if (response.data && response.data.length > 0) {
                response.data.forEach(galery => {
                    const formattedDate = new Date(galery.created_at).toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric',
                    });

                    const fileHTML = `
                    <div class="gallery-item group visible" style="animation-delay: 0.1s">
                        <div class="image-container cursor-pointer" onclick="showImagePreview(
                                '${GALLERY}/files/${galery.image}',
                                '${galery.title.replace(/'/g, "\\'")}',
                                '${galery.category.replace(/'/g, "\\'")}',
                                '${formattedDate}',
                                '${galery.description.replace(/'/g, "\\'")}'
                            )">
                            <div class="image-placeholder">
                                <img src="${GALLERY}/files/${galery.image}" alt="${galery.title}" class="w-full h-full object-cover">
                            </div>
                            <div class="image-overlay">
                                <span class="text-xl font-bold text-white mb-2">
                                    ${galery.category} · ${formattedDate}
                                </span>
                                <h3 class="text-xl font-bold text-white mb-3">
                                    ${galery.title}
                                </h3>
                                <p class="text-red-100 text-sm leading-relaxed">
                                    ${galery.description}
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <h3 class="text-lg font-bold text-red-900 group-hover:text-red-600 transition-colors duration-300">
                                ${galery.title}
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
            } else {
                galleryContainer.innerHTML = '<p class="text-center">Tidak ada data yang ditemukan.</p>';
            }

            // Tambahkan navigasi halaman jika diperlukan
            if (response.total > response.limit) {
                const totalPages = response.totalPages; // Jumlah total halaman
                const currentPage = response.page; // Halaman saat ini

                // Tombol "Previous"
                if (currentPage > 1) {
                    navElement.innerHTML += `
    <li>
        <a href="javascript:void(0)" onclick="filter(${status}, ${currentPage - 1})"
           class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <span class="sr-only">Previous</span>
            <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round"
                      stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
        </a>
    </li>
    `;
                }

// Tombol halaman
                for (let i = 1; i <= totalPages; i++) {
                    navElement.innerHTML += `
    <li>
        <a href="javascript:void(0)" onclick="filter(${status}, ${i})"
           class="flex items-center justify-center px-3 h-8 leading-tight ${
                        i === currentPage
                            ? 'text-red-600 border border-red-300 bg-red-50 hover:bg-red-100 hover:text-red-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white'
                            : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
                    }">
            ${i}
        </a>
    </li>
    `;
                }

// Tombol "Next"
                if (currentPage < totalPages) {
                    navElement.innerHTML += `
    <li>
        <a href="javascript:void(0)" onclick="filter(${status}, ${currentPage + 1})"
           class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <span class="sr-only">Next</span>
            <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round"
                      stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
        </a>
    </li>
    `;
                }

            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memuat galeri.');
        }
    });
}

function deleteImage(ImageId) {
    if (confirm('Are you sure you want to delete this file?')) {
        $.ajax({
            url: `${BASEURL}/galleries/deleteImage`,
            type: 'POST',
            data: {gallery_id: ImageId},
            success: function (response) {
                let result = JSON.parse(response);
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
    let start = {x: 0, y: 0};

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
            start = {x: e.clientX - pointX, y: e.clientY - pointY};
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

$(document).ready(function () {
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
    $topicButtons.on('click', function () {
        $topicButtons.removeClass('active');
        $(this).addClass('active');
    });

    const $galleryItems = $('.gallery-item');
    $galleryItems.each(function () {
        observer.observe(this);
    });

    $galleryItems.on('click', function () {
        $(this).toggleClass('zoomed');
    });
});