<?php
//var_dump($data);
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat File - IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
        }

        .slide-up {
            animation: slideUp 0.5s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .image-card {
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .image-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -10px rgba(51, 65, 85, 0.1);
        }

        .status-badge {
            transition: all 0.3s ease;
        }

        .status-badge:hover {
            transform: scale(1.05);
        }

        .filter-btn {
            position: relative;
            transition: all 0.3s ease;
        }

        .filter-btn::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #dc2626;
            transition: width 0.3s ease;
        }

        .filter-btn.active {
            color: #dc2626;
        }

        .filter-btn.active::after {
            width: 100%;
        }

        .filter-btn:hover {
            background-color: #fee2e2;
        }
    </style>
</head>
<body class="bg-white">
<div class="flex">
    <?php include '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>
    <div class="flex-1 min-h-screen ml-64">
        <main class="py-10 px-8">
            <div class="max-w-7xl mx-auto">
                <!-- Header Section -->
                <div class="mb-8 fade-in">
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-red-600 to-red-600 bg-clip-text text-transparent">
                        Riwayat File
                    </h1>
                    <p class="mt-2 text-red-600">Kelola dan pantau riwayat file Anda</p>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl border-2 border-red-100 slide-up" style="animation-delay: 0.1s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-red-600">Total File</p>
                                <p class="text-2xl font-bold text-red-900"><?= $data['totalFiles'] ?></p>
                            </div>
                            <div class="p-3 bg-red-50 rounded-xl">
                                <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Files List Section -->
                <div class="bg-white rounded-xl border-2 border-red-100 overflow-hidden slide-up"
                     style="animation-delay: 0.2s">
                    <!-- Filters and Search -->
                    <div class="p-6 border-b border-red-100">
                        <div class="flex justify-between items-center">
                            <div class="relative flex items-center space-x-4">
                                <button class="px-4 py-2 text-red-600 rounded-lg transition-colors relative filter-btn active"
                                        data-status="all" onclick="filter('0')">
                                    Semua
                                </button>
                                <button class="px-4 py-2 text-red-600 rounded-lg transition-colors relative filter-btn"
                                        data-status="1" onclick="filter(1)">
                                    Tertunda
                                </button>
                                <button class="px-4 py-2 text-red-600 rounded-lg transition-colors relative filter-btn"
                                        data-status="2" onclick="filter(2)">
                                    Disetujui
                                </button>
                                <button class="px-4 py-2 text-red-600 rounded-lg transition-colors relative filter-btn"
                                        data-status="3" onclick="filter(3)">
                                    Ditolak
                                </button>
                            </div>
                            <div class="relative">
                                <input type="text" placeholder="Cari file..." id="keyword"
                                       class="pl-10 pr-4 py-2 bg-red-50 border-0 rounded-lg text-red-900 placeholder-red-400 focus:ring-2 focus:ring-red-500">
                                <svg class="w-5 h-5 text-red-400 absolute left-3 top-2.5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Search Results test search -->
                    <div id="results" class="mt-4"></div>
                    <!-- Files Grid -->
                    <div id="research-files" class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php if (empty($data['files'])) : ?>
                            <div class="col-span-full text-center py-12">
                                <svg class="w-16 h-16 text-red-200 mx-auto mb-4" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <h3 class="text-xl font-medium text-red-900 mb-2">Belum ada File</h3>
                                <p class="text-red-600 mb-6">Mulai unggah file penelitian Anda sekarang</p>
                            </div>
                        <?php else : ?>
                            <?php foreach ($data['files'] as $file) : ?>
                                <div class="bg-white p-6 rounded-xl border-2 border-red-100 hover:border-red-300 transition-all">
                                    <!-- File Info -->
                                    <div class="flex items-center space-x-4 mb-4">
                                        <div class="p-3 bg-red-50 rounded-xl">
                                            <svg class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-bold text-red-900"><?= $file['title'] ?? 'Untitled' ?></h3>
                                            <p class="text-sm text-red-600"><?= $file['category'] ?? 'Uncategorized' ?></p>
                                        </div>
                                    </div>

                                    <!-- Status and Actions -->
                                    <div class="flex items-center justify-between mt-4">
                                        <!-- Status Badge -->
                                        <span class="status-badge text-xs font-semibold px-2 py-1 rounded-lg
                                            <?= isset($file['status']) ?
                                            ($file['status'] == 1 ? 'bg-yellow-100 text-yellow-600' :
                                                ($file['status'] == 2 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600')) :
                                            'bg-gray-100 text-gray-600' ?>">
                                            <?= isset($file['status']) ?
                                                ($file['status'] == 1 ? 'Pending' :
                                                    ($file['status'] == 2 ? 'Approved' : 'Rejected')) :
                                                'Unknown' ?>
                                        </span>

                                        <!-- Action Buttons -->
                                        <div class="flex space-x-2">
                                            <!-- Preview Button -->
                                            <button onclick="previewFile('<?= FILES . '/' . ($file['file_url'] ?? '') ?>')"
                                                    class="flex items-center px-3 py-1.5 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                Preview
                                            </button>

                                            <!-- Download Button -->
                                            <a href="<?= FILES . '/' . ($file['file_url'] ?? '#') ?>"
                                               download
                                               class="flex items-center px-3 py-1.5 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                </svg>
                                                Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <!-- Pagination -->
                    <nav aria-label="Page navigation example" class="p-6">
                        <ul class="flex items-center -space-x-px h-8 text-sm">
                            <li>
                                <?php if ($data['currentPage'] > 1) : ?>
                                    <a href="?page=<?= $data['currentPage'] - 1 ?>&status=<?= $data['selectedStatus'] ?>"
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
                                        <a href="?page=<?= $i; ?>&status=<?= $data['selectedStatus'] ?>"
                                           aria-current="page"
                                           class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-red-600 border border-red-300 bg-red-50 hover:bg-red-100 hover:text-red-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"><?= $i; ?></a>
                                    </li>
                                <?php else : ?>
                                    <li>
                                        <a href="?page=<?= $i; ?>&status=<?= $data['selectedStatus'] ?>"
                                           class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><?= $i; ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endfor; ?>
                            <li>
                                <?php if ($data['currentPage'] < $data['totalPages']) : ?>
                                    <a href="?page=<?= $data['currentPage'] + 1 ?>&status=<?= $data['selectedStatus'] ?>"
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
            </div>
        </main>
    </div>
</div>

<!-- Preview Modal -->
<div id="fileModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-8 max-w-4xl w-full mx-4">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-red-900">Preview File</h3>
            <button onclick="closePreview()"
                    class="p-2 text-gray-500 hover:text-gray-700 rounded-lg transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div id="fileContent" class="w-full">
            <!-- File preview will be loaded here -->
        </div>
    </div>
</div>

<script>
    function previewFile(url) {
        if (!url) return;

        const modal = document.getElementById('fileModal');
        const content = document.getElementById('fileContent');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // Add file extension check for different preview types
        if (url.match(/\.(jpg|jpeg|png|gif)$/i)) {
            content.innerHTML = `<img src="${url}" class="max-w-full h-auto rounded-lg">`;
        } else if (url.match(/\.(pdf)$/i)) {
            content.innerHTML = `<iframe src="${url}" width="100%" height="600px" class="rounded-lg border border-red-100"></iframe>`;
        } else {
            content.innerHTML = `<div class="text-center p-8">
                <p class="text-gray-600 mb-4">Preview not available for this file type</p>
                <a href="${url}" download class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download File
                </a>
            </div>`;
        }
    }

    function closePreview() {
        const modal = document.getElementById('fileModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function filter(status) {
        $.ajax({
            url: '<?= BASEURL ?>/ResearchOutput/filterAdmin',
            method: 'POST',
            dataType: 'json',
            data: {status: status},
            success: function (data) {
                console.log('Success Response:', data);

                const fileContainer = document.querySelector("#research-files");
                const navElement = document.querySelector('nav[aria-label="Page navigation example"]');

                fileContainer.innerHTML = ''; // Bersihkan kontainer sebelum menambahkan konten baru
                navElement.innerHTML = '';

                data.forEach(file => {
                    const fileHTML = `
                    <div class="bg-white p-6 rounded-xl border-2 border-red-100 hover:border-red-300 transition-all">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="p-3 bg-red-50 rounded-xl">
                                <svg class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-red-900">${file.title}</h3>
                                <p class="text-sm text-red-600">${file.category}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <!-- Status Badge -->
                            ${file.status == 1 ? `
                            <span class="status-badge text-xs font-semibold px-2 py-1 rounded-lg bg-yellow-100 text-yellow-600">
                                Pending
                            </span>` : file.status == 2 ? `
                            <span class="status-badge text-xs font-semibold px-2 py-1 rounded-lg bg-green-100 text-green-600">
                                Approved
                            </span>` : file.status == 3 ? `
                            <span class="status-badge text-xs font-semibold px-2 py-1 rounded-lg bg-red-100 text-red-600">
                                Rejected
                            </span>` : `
                            <span class="status-badge text-xs font-semibold px-2 py-1 rounded-lg">
                                Unknown
                            </span>`}

                            <!-- Action Buttons -->
                            <div class="flex space-x-2">
                                <!-- Preview Button -->
                                <button onclick="previewFile('${file.file_url ?? ''}')" class="flex items-center px-3 py-1.5 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Preview
                                </button>

                                <!-- Download Button -->
                                <a href="${file.file_url ?? '#'}" download="" class="flex items-center px-3 py-1.5 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>`;

                    fileContainer.innerHTML += fileHTML; // Tambahkan konten ke DOM
                });

            },
            error: function (xhr, status, error) {
                console.error('Error Status:', status);
                console.error('Error Details:', error);
                console.error('Response Text:', xhr.responseText);
            }
        });
    }

        // Initialize animations
        document.addEventListener('DOMContentLoaded', function () {
            const filterButtons = document.querySelectorAll('.filter-btn');

            filterButtons.forEach(button => {
                button.addEventListener('click', function () {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    // filter(this.dataset.status);
                });
            });
        });

        $(document).ready(function () {
            $('#keyword').on('keyup', function () {
                let keyword = $(this).val(); // Ambil nilai input
                let resultsDiv = $('#results');

                $.ajax({
                    url: '<?= BASEURL; ?>/researchoutput/search',
                    type: 'POST',
                    data: {keyword: keyword},
                    dataType: 'json',
                    success: function (data) {
                        // Kosongkan elemen hasil pencarian
                        resultsDiv.empty();
                        console.log(data);

                        // Cek apakah ada hasil pencarian
                        if (data.length > 0) {
                            $.each(data, function (index, item) {
                                resultsDiv.append(`
                            <div class="p-2 border-b border-gray-200">
                                <h4 class="text-lg font-medium text-gray-800">${item.title}</h4>
                                <p class="text-sm text-gray-500">${item.category} - ${item.uploaded_at}</p>
                                <a href="${item.file_url}" class="text-red-500 underline">Download File</a>
                            </div>
                        `);
                            });
                        } else {
                            resultsDiv.html('<p class="text-gray-500">Hasil tidak ditemukan.</p>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
</script>
</body>
</html>