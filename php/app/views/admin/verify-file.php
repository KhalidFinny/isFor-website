<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <!-- Meta tags untuk SEO dan responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Gambar - IsFor</title>

    <!-- Font dan stylesheet eksternal -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS; ?>/admin/verify-files.css">
    <link rel="stylesheet" href="<?= ASSETS; ?>/css/animations.css">
    <style>
        /* Ensure the body doesn't have horizontal overflow */
        body {
            overflow-x: hidden;
        }

        /* Responsive adjustments for mobile view */
        @media (max-width: 768px) {
            .page-content {
                margin-left: 0 !important;
                padding: 1rem;
            }

            .page-content.sidebar-open {
                margin-left: 0;
                transform: translateX(16rem);
            }

            .back-button-section {
                margin-bottom: 1.5rem;
            }

            .header-section {
                margin-bottom: 1.5rem;
            }

            .header-section h1 {
                font-size: 2rem;
            }

            .file-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .file-card {
                padding: 1rem;
            }

            .file-card .grid-cols-4 {
                grid-template-columns: 1fr 1fr;
                grid-template-rows: auto auto;
                gap: 0.5rem;
            }

            .file-card .grid-cols-4 button,
            .file-card .grid-cols-4 a {
                padding: 0.5rem;
                font-size: 0.875rem;
            }

            .pagination {
                margin-top: 1.5rem;
            }

            .modal-content {
                width: 95%;
                padding: 1rem;
            }

            .empty-state {
                height: 250px;
                padding: 1rem;
            }

            .empty-state h3 {
                font-size: 1.25rem;
            }

            .alert {
                top: 0.5rem;
                right: 0.5rem;
                max-width: calc(100% - 1rem);
            }
        }

        /* Ensure desktop view remains unchanged */
        @media (min-width: 769px) {
            .page-content {
                margin-left: 16rem;
                padding: 2rem;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
<div class="flex min-h-screen bg-white">
    <?php include '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>
    <div class="flex-1 page-content" id="mainContent">
        <main class="max-w-[1600px] mx-auto">
            <div class="back-button-section">
                <a href="<?= BASEURL ?>/dashboardAdmin"
                   class="inline-flex items-center space-x-2 text-red-500 hover:text-red-600 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Kembali</span>
                </a>
            </div>

            <!-- Header -->
            <div class="header-section fade-in">
                <div class="flex items-center space-x-4 mb-4">
                    <span class="h-px w-12 bg-red-600"></span>
                    <span class="text-red-600 font-medium">Files</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-red-900 mb-2">Verifikasi File</h1>
            </div>

            <!-- Grid untuk file -->
            <div class="file-grid grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
                <?php if (empty($data['files'])): ?>
                    <div class="col-span-2">
                        <div class="empty-state flex flex-col items-center justify-center">
                            <div class="w-16 h-16 md:w-20 md:h-20 border-2 border-red-200 rounded-full flex items-center justify-center mb-4 md:mb-6 relative">
                                <div class="absolute inset-0 border-2 border-green-200 rounded-full animate-ping opacity-100"></div>
                                <svg class="w-8 h-8 md:w-10 md:h-10 text-red-500" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg md:text-xl font-medium text-red-900 mb-2">Tidak Ada File</h3>
                            <p class="text-xs md:text-sm text-red-600">File yang membutuhkan verifikasi akan muncul di sini</p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($data['files'] as $file): ?>
                        <div class="file-card group relative bg-white border border-gray-200 rounded-lg p-4 md:p-6 transition-all duration-300 hover:border-red-200"
                             data-file-id="<?= $file['research_output_id']; ?>">
                            <div class="absolute -top-2 right-2 md:right-6">
                                <span class="status-badge inline-flex items-center px-2 py-0.5 md:px-3 md:py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1 md:mr-2"></span>
                                    Menunggu Verifikasi
                                </span>
                            </div>

                            <div class="mb-6 md:mb-8">
                                <div class="flex items-center gap-3 md:gap-4 mb-3 md:mb-4">
                                    <?php
                                    $extension = pathinfo($file['file_url'], PATHINFO_EXTENSION);
                                    $iconClass = match (strtolower($extension)) {
                                        'pdf' => 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z',
                                        'doc', 'docx' => 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z M12 11h4M12 15h4M12 7h1.5',
                                        'xls', 'xlsx' => 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z M12 7v8m-4-4h8',
                                        default => 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z'
                                    };
                                    ?>
                                    <div class="w-10 h-10 md:w-12 md:h-12 flex-shrink-0 bg-red-50 rounded-lg md:rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 md:w-6 md:h-6 text-red-500" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="<?= $iconClass ?>"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg md:text-xl font-semibold text-red-900"><?= htmlspecialchars($file['title']); ?></h3>
                                        <p class="text-xs md:text-sm text-gray-500"><?= htmlspecialchars($file['original_name']); ?></p>
                                        <p class="text-xs md:text-sm text-gray-700">Nama
                                            Pengguna: <?= htmlspecialchars($file['name']); ?></p>
                                        <p class="text-xs md:text-sm text-gray-700">ID
                                            File: <?= htmlspecialchars($file['research_output_id']); ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Action buttons -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-3">
                                <button onclick="window.open('<?= FILES; ?>/<?= $file['file_url']; ?>', '_blank')"
                                        class="btn-hover-effect flex items-center justify-center px-2 md:px-4 py-1.5 md:py-2.5 text-xs md:text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-all">
                                    Preview
                                </button>
                                <a href="<?= FILES; ?>/<?= $file['file_url']; ?>" download
                                   class="btn-hover-effect flex items-center justify-center px-2 md:px-4 py-1.5 md:py-2.5 text-xs md:text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-all">
                                    Download
                                </a>
                                <button onclick="verifyFile(<?= $file['research_output_id']; ?>)"
                                        class="btn-hover-effect flex items-center justify-center px-2 md:px-4 py-1.5 md:py-2.5 text-xs md:text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-all">
                                    Verifikasi
                                </button>
                                <button onclick="rejectFile(<?= $file['research_output_id']; ?>)"
                                        class="btn-hover-effect flex items-center justify-center px-2 md:px-4 py-1.5 md:py-2.5 text-xs md:text-sm font-medium text-red-600 bg-white border border-red-200 rounded-lg hover:bg-red-50 transition-all">
                                    Tolak
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if ($data['totalPages'] > 1): ?>
                <nav aria-label="Page navigation" class="mt-6 md:mt-10">
                    <ul class="pagination inline-flex items-center space-x-1 md:space-x-2">
                        <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                            <li>
                                <a href="?page=<?= $i; ?>"
                                   class="flex items-center justify-center w-7 h-7 md:w-9 md:h-9 <?= $i == $data['page'] ? 'border border-red-500 text-red-400' : 'text-red-400 border duration-300 hover:border-red-300' ?> rounded-md">
                                    <?= $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </main>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmationModal" class="modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="modal-content bg-white rounded-lg md:rounded-xl shadow-xl w-full max-w-md mx-2 md:mx-4 overflow-hidden">
        <div class="p-4 md:p-6">
            <div class="mb-3 md:mb-4 text-center">
                <div class="mx-auto flex items-center justify-center h-10 w-10 md:h-12 md:w-12 rounded-full bg-red-100 mb-3 md:mb-4">
                    <svg class="h-5 w-5 md:h-6 md:w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-base md:text-lg font-medium text-gray-900" id="modalTitle">Konfirmasi Aksi</h3>
                <p class="text-xs md:text-sm text-gray-500 mt-1 md:mt-2" id="modalMessage">Apakah Anda yakin ingin melakukan aksi ini?</p>
            </div>
            <!-- Comment Section -->
            <div class="mb-3 md:mb-4">
                <label for="comment" class="block text-xs md:text-sm font-medium text-gray-700 mb-1 md:mb-2">Komentar:</label>
                <textarea id="comment" rows="3" class="w-full p-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>
            </div>
            <div class="flex gap-2 md:gap-3">
                <button id="confirmButton"
                        class="flex-1 justify-center rounded-md bg-red-600 px-2 py-1.5 md:px-3 md:py-2 text-xs md:text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                    Konfirmasi
                </button>
                <button onclick="closeModal()"
                        class="flex-1 justify-center rounded-md bg-white px-2 py-1.5 md:px-3 md:py-2 text-xs md:text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Alert Component -->
<div id="alert"
     class="alert fixed top-2 right-2 md:top-4 md:right-4 max-w-xs md:max-w-sm bg-white rounded-lg shadow-lg border-l-4 border-green-500 p-2 md:p-4 hidden">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <svg class="h-4 w-4 md:h-5 md:w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <div class="ml-2">
            <p class="text-xs md:text-sm font-medium text-gray-900" id="alertMessage"></p>
        </div>
    </div>
</div>

<script>
    let currentFileId = null;
    let currentAction = null;

    function showModal(fileId, action, title, message) {
        currentFileId = fileId;
        currentAction = action;
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalMessage').textContent = message;
        document.getElementById('confirmationModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('confirmationModal').classList.add('hidden');
        document.getElementById('comment').value = '';
    }

    function showAlert(message, type = 'success') {
        const alert = document.getElementById('alert');
        const alertMessage = document.getElementById('alertMessage');

        alert.classList.remove('hidden');
        alertMessage.textContent = message;

        if (type === 'error') {
            alert.classList.remove('border-green-500');
            alert.classList.add('border-red-500');
            alert.querySelector('svg').classList.remove('text-green-500');
            alert.querySelector('svg').classList.add('text-red-500');
        } else {
            alert.classList.remove('border-red-500');
            alert.classList.add('border-green-500');
            alert.querySelector('svg').classList.remove('text-red-500');
            alert.querySelector('svg').classList.add('text-green-500');
        }

        setTimeout(() => {
            alert.classList.add('hidden');
        }, 3000);
    }

    function verifyFile(fileId) {
        showModal(
            fileId,
            'verify',
            'Konfirmasi Verifikasi',
            'Apakah Anda yakin ingin memverifikasi file ini?'
        );
    }

    function rejectFile(fileId) {
        showModal(
            fileId,
            'reject',
            'Konfirmasi Penolakan',
            'Apakah Anda yakin ingin menolak file ini?'
        );
    }

    document.getElementById('confirmButton').addEventListener('click', async () => {
        if (!currentFileId || !currentAction) return;

        const comment = document.getElementById('comment').value;
        if (!comment) {
            showAlert('Komentar tidak boleh kosong!', 'error');
            return;
        }

        let endpoint = currentAction === 'verify'
            ? `<?= BASEURL; ?>/researchoutput/verifyFile/${currentFileId}/${comment}`
            : `<?= BASEURL; ?>/researchoutput/rejectFile/${currentFileId}/${comment}`;

        try {
            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({fileId: currentFileId, comment: comment})
            });

            if (response.ok) {
                showAlert(
                    currentAction === 'verify'
                        ? 'File berhasil diverifikasi!'
                        : 'File berhasil ditolak!'
                );

                const fileCard = document.querySelector(`[data-file-id="${currentFileId}"]`);
                if (fileCard) {
                    fileCard.style.opacity = '0';
                    setTimeout(() => {
                        fileCard.remove();

                        const remainingFiles = document.querySelectorAll('.file-card');
                        if (remainingFiles.length === 0) {
                            const grid = document.querySelector('.file-grid');
                            grid.innerHTML = `
                                <div class="col-span-2">
                                    <div class="empty-state flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 md:w-20 md:h-20 border-2 border-red-200 rounded-full flex items-center justify-center mb-4 md:mb-6 relative">
                                            <div class="absolute inset-0 border-2 border-green-200 rounded-full animate-ping opacity-100"></div>
                                            <svg class="w-8 h-8 md:w-10 md:h-10 text-red-500" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg md:text-xl font-medium text-red-900 mb-2">Tidak Ada File</h3>
                                        <p class="text-xs md:text-sm text-red-600">File yang membutuhkan verifikasi akan muncul di sini</p>
                                    </div>
                                </div>
                            `;
                        }
                    }, 300);
                }
            } else {
                throw new Error('Gagal memproses permintaan.');
            }
        } catch (error) {
            showAlert('Terjadi kesalahan. Silakan coba lagi.', 'error');
        }
        closeModal();
    });

    document.addEventListener('DOMContentLoaded', () => {
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        if (menuToggle && sidebar && mainContent) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                if (window.innerWidth <= 768) {
                    mainContent.classList.toggle('sidebar-open');
                }
            });

            document.addEventListener('click', (e) => {
                if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                    sidebar.classList.remove('open');
                    mainContent.classList.remove('sidebar-open');
                }
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth > 768) {
                    mainContent.classList.remove('sidebar-open');
                }
            });
        }
    });
</script>
</body>
</html>