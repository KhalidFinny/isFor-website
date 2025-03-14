<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Surat - IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS; ?>/admin/letter-history.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-white">
<div class="flex">
    <?php include '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>

    <div class="flex-1 min-h-screen ml-64">
        <main class="py-10 px-8">
            <div class="max-w-7xl mx-auto">
                <a href="<?= BASEURL ?>/dashboardAdmin" class="inline-flex items-center space-x-2 text-red-500 hover:text-red-600 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Kembali</span>
                </a>
            </div>
            <!-- Swiss-inspired Header -->
            <div class="max-w-7xl mx-auto mb-12 fade-in">
                <div class="flex items-center space-x-4 mb-4">
                    <span class="h-px w-12 bg-red-600"></span>
                    <span class="text-red-600 font-medium">Riwayat</span>
                </div>
                <h1 class="text-5xl font-bold text-red-900 mb-2">Riwayat File</h1>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl border-2 border-red-100 slide-up" style="animation-delay: 0.1s">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-red-600">Total Surat</p>
                            <p class="text-2xl font-bold text-red-900"><?= $data['totalLetters'] ?></p>
                        </div>
                        <div class="p-3 bg-red-50 rounded-xl">
                            <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Similar stats cards for Approved and Pending -->
            </div>

            <!-- Letter List Section -->
            <div class="bg-white rounded-xl border-2 border-red-100 overflow-hidden slide-up" style="animation-delay: 0.2s">
                <!-- Filters and Search -->
                <div class="p-6 border-b border-red-100">
                    <div class="flex justify-between items-center">
                        <div class="relative flex items-center space-x-4">
                            <!-- Animated Underline -->
                            <div class="absolute bottom-0 h-0.5 bg-red-600 transition-all duration-300" id="activeIndicator"></div>

                            <button class="px-4 py-2 text-red-600 rounded-lg transition-colors relative filter-btn active" data-status="0" onclick="filter(0)">
                                Semua
                            </button>
                            <button class="px-4 py-2 text-red-600 rounded-lg transition-colors relative filter-btn" data-status="2" onclick="filter(2)">
                                Disetujui
                            </button>
                            <button class="px-4 py-2 text-red-600 rounded-lg transition-colors relative filter-btn" data-status="1" onclick="filter(1)">
                                Tertunda
                            </button>
                            <button class="px-4 py-2 text-red-600 rounded-lg transition-colors relative filter-btn" data-status="3" onclick="filter(3)">
                                Ditolak
                            </button>
                        </div>
                        <div class="relative">
                            <input type="text" placeholder="Cari surat..." id="keyword" class="pl-10 pr-4 py-2 bg-red-50 border-0 rounded-lg text-red-900 placeholder-red-400 focus:ring-2 focus:ring-red-500">
                            <svg class="w-5 h-5 text-red-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Letters List -->
                <div class="p-6 space-y-4">
                    <?php if (empty($data['allLetters'])) : ?>
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-red-200 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <h3 class="text-xl font-medium text-red-900 mb-2">Belum ada surat</h3>
                        </div>
                    <?php else : ?>
                        <!-- Letter Cards -->
                        <div class="letter-card bg-white p-6 rounded-xl border-2 border-red-100 hover:border-red-300">
                            <!-- Letter content here -->
                            <table class="w-full">
                                <thead>
                                <tr class="text-left text-sm font-medium text-gray-500">
                                    <th class="pb-4">Jenis Dokumen</th>
                                    <th class="pb-4">Tanggal</th>
                                    <th class="pb-4">Status</th>
                                    <th class="pb-4">Komentar</th>
                                    <th class="pb-4">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- Sample submission row -->
                                <?php foreach ($data['allLetters'] as $letter) : ?>
                                    <tr class="border-t border-gray-100">
                                        <td class="py-4"><?= $letter['title'] ?></td>
                                        <td class="py-4"><?= $letter['date'] ?></td>
                                        <td class="py-4">
                                            <?php if ($letter['status'] == 1) : ?>
                                                <span class="px-3 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">
                                                    Tertunda
                                                </span>
                                            <?php elseif ($letter['status'] == 2) : ?>
                                                <span class="px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                                    Disetujui
                                                </span>
                                            <?php else : ?>
                                                <span class="px-3 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">
                                                    Ditolak
                                                </span>
                                            <?php endif ?>
                                        </td>
                                        <td class="py-4">
                                            <?php
                                            $comment = $letter['comment'] ?? 'Tidak ada komentar';
                                            if (strlen($comment) > 50) {
                                                echo '<span class="truncated-comment">' . substr($comment, 0, 50) . '...</span>';
                                                echo '<button onclick="showCommentModal(`' . htmlspecialchars($comment) . '`)" class="text-red-600 hover:text-red-800 ml-2">Read More</button>';
                                            } else {
                                                echo $comment;
                                            }
                                            ?>
                                        </td>
                                        <td class="py-4">
                                            <button onclick="viewLetter(<?= $letter['letter_id']; ?>)" class="text-red-600 hover:text-red-800">Lihat Detail</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                    <nav aria-label="Page navigation example">
                        <ul class="flex items-center -space-x-px h-8 text-sm">
                            <li>
                                <?php if ($data['halamanAktif'] > 1) : ?>
                                    <a href="?halaman=<?= $data['halamanAktif'] - 1 ?>" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <span class="sr-only">Previous</span>
                                        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </li>
                            <?php for ($i = 1; $i <= $data['jumlahHalaman']; $i++) : ?>
                                <?php if ($i == $data['halamanAktif']) : ?>
                                    <li>
                                        <a href="?halaman=<?= $i; ?>" aria-current="page" class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-red-600 border border-red-300 bg-red-50 hover:bg-red-100 hover:text-red-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"><?= $i; ?></a>
                                    </li>
                                <?php else : ?>
                                    <li>
                                        <a href="?halaman=<?= $i; ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><?= $i; ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endfor; ?>
                            <li>
                                <?php if ($data['halamanAktif'] < $data['jumlahHalaman']) : ?>
                                    <a href="?halaman=<?= $data['halamanAktif'] + 1 ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <span class="sr-only">Next</span>
                                        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
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
<div id="letterModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl p-8 max-w-2xl w-full mx-4">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-red-900">Detail Surat</h3>
            <button onclick="closeLetterModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div id="letterContent">
            <!-- Letter content will be loaded here -->
        </div>
    </div>
</div>

<!-- Comment Modal -->
<div id="commentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl p-8 max-w-2xl w-full mx-4">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-red-900">Komentar</h3>
            <button onclick="closeCommentModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div id="commentContent" class="text-gray-700">
            <!-- Comment content will be loaded here -->
        </div>
    </div>
</div>

<!-- Alert Container -->
<div id="alertMessage" class="fixed top-0 right-0 m-8 transition-transform duration-300 transform translate-y-[-100%] hidden">
    <!-- Alert content will be injected here by showAlert() -->
</div>

<script>
    function viewLetter(id) {
        // Implementation for viewing letter
        document.getElementById('letterModal').classList.remove('hidden');
        document.getElementById('letterModal').classList.add('flex');

        $.ajax({
            url: '<?= BASEURL ?>/letter/getLetter',
            method: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function (data) {
                console.log(data);
                // Implementation for viewing letter
                const letterContent = document.getElementById('letterContent');
                letterContent.innerHTML = `
                        <iframe src="${data}" width="100%" height="500px"></iframe>
                    `;
            },
            error: function (data) {
                alert('Gagal');
            }
        });
    }

    function closeLetterModal() {
        document.getElementById('letterModal').classList.add('hidden');
        document.getElementById('letterModal').classList.remove('flex');
    }

    function showCommentModal(comment) {
        const commentModal = document.getElementById('commentModal');
        const commentContent = document.getElementById('commentContent');

        // Set the comment content
        commentContent.textContent = comment;

        // Show the modal
        commentModal.classList.remove('hidden');
        commentModal.classList.add('flex');
    }

    function closeCommentModal() {
        const commentModal = document.getElementById('commentModal');
        commentModal.classList.add('hidden');
        commentModal.classList.remove('flex');
    }

    function filter(status, currentPage = 1) {
        // console.log('Filter called with status:', status, 'and page:', currentPage);
        $.ajax({
            url: '<?= BASEURL ?>/letter/filterAdmin',
            method: 'POST',
            dataType: 'json',
            data: JSON.stringify({status: status, halamanAktif: currentPage}), // Kirim JSON ke server
            contentType: 'application/json',
            success: function (data) {
                console.log('Received Data:', data);

                const letterContainer = document.querySelector(".letter-card tbody");
                const navElement = document.querySelector('nav[aria-label="Page navigation example"]');

                const tableHeader = `
                <thead>
                    <tr class="text-left text-sm font-medium text-gray-500">
                        <th class="pb-4">Jenis Dokumen</th>
                        <th class="pb-4">Tanggal</th>
                        <th class="pb-4">Status</th>
                        <th class="pb-4">Komentar</th>
                        <th class="pb-4">Aksi</th>
                    </tr>
                </thead>
            `;

                letterContainer.innerHTML = ''; // Hanya hapus isi tbody
                navElement.innerHTML = '';

                // Populate table rows with data
                data.letters.forEach(letter => {
                    console.log(letter.status);

                    let statusBadge = '';

                    if (letter.status == 1) {
                        statusBadge = '<span class="px-3 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">Tertunda</span>';
                    } else if (letter.status == 2) {
                        statusBadge = '<span class="px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">Disetujui</span>';
                    } else {
                        statusBadge = '<span class="px-3 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">Ditolak</span>';
                    }

                    const comment = letter.comment || 'Tidak ada komentar';
                    const truncatedComment = comment.length > 50 ? comment.substring(0, 50) + '...' : comment;
                    const readMoreButton = comment.length > 50 ? `<button onclick="showCommentModal(\`${comment}\`)" class="text-red-600 hover:text-red-800 ml-2">Read More</button>` : '';

                    const row = `
                    <tr class="border-t border-gray-100">
                        <td class="py-4">${letter.title}</td>
                        <td class="py-4">${letter.date}</td>
                        <td class="py-4">${statusBadge}</td>
                        <td class="py-4">
                            <span class="truncated-comment">${truncatedComment}</span>
                            ${readMoreButton}
                        </td>
                        <td class="py-4">
                            <button onclick="viewLetter(${letter.letter_id})" class="text-red-600 hover:text-red-800">Lihat Detail</button>
                        </td>
                    </tr>
                `;
                    letterContainer.innerHTML += row;
                });

                // Generate pagination
                if (navElement) {
                    generatePagination(navElement, data.pagination.halamanAktif, data.pagination.jumlahHalaman, status);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error Status:', status);
                console.error('Error Details:', error);
                console.error('Response Text:', xhr.responseText);
            }
        });
    }

    function generatePagination(navElement, currentPage, totalPages, status) {
        const ul = document.createElement('ul');
        ul.className = 'flex items-center -space-x-px h-8 text-sm';

        // Previous button
        if (currentPage > 1) {
            const prevLi = `
            <li>
                <a href="javascript:void(0)" onclick="filter(${status}, ${currentPage - 1})"
                    class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                    <span class="sr-only">Previous</span>
                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                </a>
            </li>
        `;
            ul.innerHTML += prevLi;
        }

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            const activeClass = i === currentPage ? 'z-10 text-red-600 border-red-300 bg-red-50' : 'text-gray-500 bg-white';
            const pageLi = `
            <li>
                <a href="javascript:void(0)" onclick="filter(${status}, ${i})"
                    class="flex items-center justify-center px-3 h-8 leading-tight ${activeClass} border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    ${i}
                </a>
            </li>
        `;
            ul.innerHTML += pageLi;
        }

        // Next button
        if (currentPage < totalPages) {
            const nextLi = `
            <li>
                <a href="javascript:void(0)" onclick="filter(${status}, ${currentPage + 1})"
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                    <span class="sr-only">Next</span>
                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                </a>
            </li>
        `;
            ul.innerHTML += nextLi;
        }

        navElement.appendChild(ul);
    }

    function showAlert(message, type = 'success') {
        const alertElement = document.getElementById('alertMessage');
        const bgColor = type === 'success' ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200';
        const textColor = type === 'success' ? 'text-green-600' : 'text-red-600';
        const iconColor = type === 'success' ? 'text-green-400' : 'text-red-400';

        alertElement.innerHTML = `
            <div class="max-w-md w-full ${bgColor} border-2 rounded-xl p-4 flex items-center shadow-lg">
                <div class="flex-shrink-0 ${iconColor}">
                    ${type === 'success'
            ? '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
            : '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
        }
                </div>
                <div class="ml-3 ${textColor} font-medium">${message}</div>
                <button onclick="closeAlert()" class="ml-auto ${textColor} hover:${textColor}">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        `;

        alertElement.style.transform = 'translateY(0)';
        alertElement.classList.remove('hidden');

        // Auto hide after 5 seconds
        setTimeout(closeAlert, 5000);
    }

    function closeAlert() {
        const alertElement = document.getElementById('alertMessage');
        alertElement.style.transform = 'translateY(-100%)';
        setTimeout(() => alertElement.classList.add('hidden'), 300);
    }

    // Animation observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.slide-up, .fade-in').forEach(el => {
        observer.observe(el);
    });

    function loadSearchResults(keyword, page = 1) {
        let letterContainer = document.querySelector(".letter-card table tbody");
        let navElement = document.querySelector('nav[aria-label="Page navigation example"]');

        $.ajax({
            url: '<?= BASEURL; ?>/letter/search',
            type: 'POST',
            data: {keyword: keyword, page: page},
            dataType: 'json',
            success: function (data) {
                console.log(data);
                letterContainer.innerHTML = ''; // Clear table
                navElement.innerHTML = ''; // Clear pagination

                if (data.results && data.results.length > 0) {
                    data.results.forEach(item => {
                        let statusBadge = '';
                        if (item.status == 1) {
                            statusBadge = '<span class="px-3 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">Tertunda</span>';
                        } else if (item.status == 2) {
                            statusBadge = '<span class="px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">Disetujui</span>';
                        } else {
                            statusBadge = '<span class="px-3 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">Ditolak</span>';
                        }

                        const comment = item.comment || 'Tidak ada komentar';
                        const truncatedComment = comment.length > 50 ? comment.substring(0, 50) + '...' : comment;
                        const readMoreButton = comment.length > 50 ? `<button onclick="showCommentModal(\`${comment}\`)" class="text-red-600 hover:text-red-800 ml-2">Read More</button>` : '';

                        letterContainer.innerHTML += `
                            <tr class="border-t border-gray-100">
                                <td class="py-4">${item.title}</td>
                                <td class="py-4">${item.date}</td>
                                <td class="py-4">${statusBadge}</td>
                                <td class="py-4">
                                    <span class="truncated-comment">${truncatedComment}</span>
                                    ${readMoreButton}
                                </td>
                                <td class="py-4">
                                    <button onclick="viewLetter(${item.letter_id})" class="text-red-600 hover:text-red-800">Lihat Detail</button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    letterContainer.innerHTML = `<tr><td colspan="5" class="text-center">Hasil tidak ditemukan</td></tr>`;
                }

                // Tampilkan pagination berdasarkan total halaman
                if (data.totalPages > 1) {
                    let paginationHTML = `<ul class="flex items-center -space-x-px h-8 text-sm">`;

                    // Tombol Previous
                    if (data.currentPage > 1) {
                        paginationHTML += `
                    <li>
                        <a href="#" data-page="${data.currentPage - 1}"
                           class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                            <svg class="w-2.5 h-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                            </svg>
                        </a>
                    </li>`;
                    }

                    // Halaman
                    for (let i = 1; i <= data.totalPages; i++) {
                        paginationHTML += `
                    <li>
                        <a href="#" data-page="${i}"
                           class="flex items-center justify-center px-3 h-8 leading-tight ${i === data.currentPage ? 'text-red-600 border-red-300 bg-red-50' : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700'}">
                            ${i}
                        </a>
                    </li>`;
                    }

                    // Tombol Next
                    if (data.currentPage < data.totalPages) {
                        paginationHTML += `
                    <li>
                        <a href="#" data-page="${data.currentPage + 1}"
                           class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-s-0 border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                            <svg class="w-2.5 h-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l4 4-4 4"/>
                            </svg>
                        </a>
                    </li>`;
                    }

                    paginationHTML += `</ul>`;
                    navElement.innerHTML = paginationHTML;

                    navElement.addEventListener('click', function (e) {
                        if (e.target.tagName === 'A') {
                            e.preventDefault();
                            const selectedPage = e.target.dataset.page;
                            loadSearchResults(keyword, selectedPage);
                        }
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                console.error('Response Text:', xhr.responseText);
            }
        });
    }

    $(document).ready(function () {
        $('#keyword').on('keyup', function () {
            const keyword = $(this).val();
            loadSearchResults(keyword);
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const filterButtons = document.querySelectorAll('.filter-btn');

        filterButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));

                // Add active class to clicked button
                this.classList.add('active');

                // Call the existing filter function
                filter(this.dataset.status);
            });
        });
    });

</script>
</body>
</html>