<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Surat - IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS; ?>/user/letter-history.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-white">
    <div class="flex flex-col md:flex-row">
        <?php include '../app/views/assets/components/UserDashboard/sidebar.php'; ?>

        <div class="flex-1 min-h-screen md:ml-64">
            <main class="py-4 pt-20 md:py-10 px-4 md:px-8">
                <div class="max-w-7xl mx-auto">
                    <a href="<?= BASEURL ?>/dashboardAdmin"
                        class="inline-flex items-center space-x-2 text-red-500 hover:text-red-600 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Kembali</span>
                    </a>
                </div>

                <!-- Swiss-inspired Header -->
                <div class="max-w-7xl mx-auto mb-6 md:mb-12 fade-in">
                    <div class="flex items-center space-x-4 mb-4">
                        <span class="h-px w-12 bg-red-600"></span>
                        <span class="text-red-600 font-medium">Riwayat</span>
                    </div>
                    <h1 class="text-3xl md:text-5xl font-bold text-red-900 mb-2">Riwayat Surat</h1>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-6 md:mb-8">
                    <div class="bg-white p-4 md:p-6 rounded-xl border-2 border-red-100 slide-up"
                        style="animation-delay: 0.1s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-red-600">Total Surat</p>
                                <p class="text-xl md:text-2xl font-bold text-red-900" id="total-letters"><?= $data['letters'] ?></p>
                            </div>
                            <div class="p-2 md:p-3 bg-red-50 rounded-xl">
                                <svg class="w-5 md:w-6 h-5 md:h-6 text-red-600" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Letter List Section -->
                <div class="bg-white rounded-xl border-2 border-red-100 overflow-hidden slide-up" style="animation-delay: 0.2s">
                    <!-- Filters and Search -->
                    <div class="p-4 md:p-6 border-b border-red-100">
                        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                            <div class="relative flex items-center space-x-2 md:space-x-4 w-full md:w-auto overflow-x-auto">
                                <div class="absolute bottom-0 h-0.5 bg-red-600 transition-all duration-300" id="activeIndicator"></div>
                                <button class="px-3 py-1.5 md:px-4 md:py-2 text-red-600 rounded-lg transition-colors relative filter-btn active" data-status="0" onclick="filter(0)">Semua</button>
                                <button class="px-3 py-1.5 md:px-4 md:py-2 text-red-600 rounded-lg transition-colors relative filter-btn" data-status="2" onclick="filter(2)">Disetujui</button>
                                <button class="px-3 py-1.5 md:px-4 md:py-2 text-red-600 rounded-lg transition-colors relative filter-btn" data-status="1" onclick="filter(1)">Tertunda</button>
                                <button class="px-3 py-1.5 md:px-4 md:py-2 text-red-600 rounded-lg transition-colors relative filter-btn" data-status="3" onclick="filter(3)">Ditolak</button>
                            </div>
                            <div class="relative w-full md:w-auto">
                                <input type="text" placeholder="Cari surat..." id="keyword" class="w-full pl-10 pr-4 py-2 bg-red-50 border-0 rounded-lg text-red-900 placeholder-red-400 focus:ring-2 focus:ring-red-500">
                                <svg class="w-5 h-5 text-red-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Letters List -->
                    <div class="p-4 md:p-6 space-y-4">
                        <div class="letter-card bg-white rounded-xl border-2 border-red-100 hover:border-red-300 overflow-x-auto">
                            <?php if (!isset($data['allLetters']) || empty($data['allLetters'])) : ?>
                                <div class="text-center py-8 md:py-12">
                                    <svg class="w-12 md:w-16 h-12 md:h-16 text-red-200 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <h3 class="text-lg md:text-xl font-medium text-red-900 mb-2">Belum ada surat</h3>
                                    <p class="text-red-600 mb-4 md:mb-6">Mulai ajukan surat penelitian Anda sekarang</p>
                                </div>
                            <?php else : ?>
                                <table class="w-full min-w-[800px]">
                                    <thead>
                                        <tr class="text-left text-sm font-medium text-gray-500">
                                            <th class="pb-4 pl-4">Jenis Dokumen</th>
                                            <th class="pb-4">Tanggal</th>
                                            <th class="pb-4">Status</th>
                                            <th class="pb-4">Komentar</th>
                                            <th class="pb-4 pr-4">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['allLetters'] as $letter) : ?>
                                            <tr class="border-t border-gray-100">
                                                <td class="py-4 pl-4"><?= htmlspecialchars($letter['title']) ?></td>
                                                <td class="py-4"><?= htmlspecialchars($letter['date']) ?></td>
                                                <td class="py-4">
                                                    <?php if ($letter['status'] == 1) : ?>
                                                        <span class="px-3 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">Tertunda</span>
                                                    <?php elseif ($letter['status'] == 2) : ?>
                                                        <span class="px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">Disetujui</span>
                                                    <?php else : ?>
                                                        <span class="px-3 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">Ditolak</span>
                                                    <?php endif ?>
                                                </td>
                                                <td class="py-4">
                                                    <?php
                                                    $comment = $letter['comment'] ?? 'Tidak ada komentar';
                                                    if (strlen($comment) > 50) {
                                                        echo '<span class="truncated-comment">' . substr(htmlspecialchars($comment), 0, 50) . '...</span>';
                                                        echo '<button onclick="showCommentModal(\'' . htmlspecialchars(addslashes($comment)) . '\')" class="text-red-600 hover:text-red-800 ml-2">Read More</button>';
                                                    } else {
                                                        echo htmlspecialchars($comment);
                                                    }
                                                    ?>
                                                </td>
                                                <td class="py-4 pr-4">
                                                    <button onclick="viewLetter(<?= htmlspecialchars($letter['letter_id']) ?>)" class="text-red-600 hover:text-red-800">Lihat Detail</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Pagination Container -->
                <div class="mt-4 flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0">
                    <!-- Showing X to Y of Z results -->
                    <div class="text-sm text-gray-500">
                        Showing <span class="font-medium" id="pagination-start"><?= ($data['currentPage'] - 1) * $data['limit'] + 1 ?></span>
                        to <span class="font-medium" id="pagination-end"><?= min(($data['currentPage'] - 1) * $data['limit'] + $data['limit'], $data['totalLetters']) ?></span>
                        of <span class="font-medium" id="pagination-total"><?= $data['totalLetters'] ?></span> results
                    </div>

                    <!-- Page X of Y + Navigation -->
                    <div class="flex items-center space-x-2">
                        <!-- "Page X of Y" -->
                        <div class="text-sm text-gray-500">
                            Page <span class="font-medium" id="pagination-current"><?= $data['currentPage'] ?></span>
                            of <span class="font-medium" id="pagination-total-pages"><?= $data['totalPages'] ?></span>
                        </div>

                        <!-- Page Number Controls -->
                        <nav aria-label="Page navigation example" id="pagination-nav">
                            <ul class="flex items-center space-x-1 text-sm">
                                <?php if ($data['currentPage'] > 1) : ?>
                                    <li>
                                        <a href="javascript:void(0)" onclick="filter(0, <?= $data['currentPage'] - 1 ?>)"
                                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 transition-colors">
                                            <span class="sr-only">Previous</span>
                                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 1 1 5l4 4" />
                                            </svg>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php
                                $delta = 2;
                                $range = [];
                                $left = $data['currentPage'] - $delta;
                                $right = $data['currentPage'] + $delta;
                                for ($i = 1; $i <= $data['totalPages']; $i++) {
                                    if ($i == 1 || $i == $data['totalPages'] || ($i >= $left && $i <= $right)) {
                                        $range[] = $i;
                                    } elseif (end($range) !== '...') {
                                        $range[] = '...';
                                    }
                                }
                                ?>

                                <?php foreach ($range as $item) : ?>
                                    <?php if ($item === '...') : ?>
                                        <li>
                                            <span class="flex items-center justify-center px-3 h-8 text-gray-500 bg-white border border-gray-300">...</span>
                                        </li>
                                    <?php elseif ($item == $data['currentPage']) : ?>
                                        <li>
                                            <a href="javascript:void(0)" onclick="filter(0, <?= $item ?>)"
                                                class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-red-600 border border-red-300 bg-red-50 hover:bg-red-100 hover:text-red-700 transition-colors">
                                                <?= $item ?>
                                            </a>
                                        </li>
                                    <?php else : ?>
                                        <li>
                                            <a href="javascript:void(0)" onclick="filter(0, <?= $item ?>)"
                                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 transition-colors">
                                                <?= $item ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <?php if ($data['currentPage'] < $data['totalPages']) : ?>
                                    <li>
                                        <a href="javascript:void(0)" onclick="filter(0, <?= $data['currentPage'] + 1 ?>)"
                                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 transition-colors">
                                            <span class="sr-only">Next</span>
                                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m1 9 4-4-4-4" />
                                            </svg>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Preview Modal -->
                <div id="letterModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
                    <div class="bg-white rounded-2xl p-8 max-w-2xl w-full mx-4">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-red-900">Detail Surat</h3>
                            <button onclick="closeLetterModal()" class="text-gray-500 hover:text-gray-700">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div id="commentContent" class="text-gray-700">
                            <!-- Comment content will be loaded here -->
                        </div>
                    </div>
                </div>

                <!-- Alert Container -->
                <div id="alertMessage"
                    class="fixed top-0 right-0 m-8 transition-transform duration-300 transform translate-y-[-100%] hidden">
                    <!-- Alert content will be injected here by showAlert() -->
                </div>
            </main>
        </div>
    </div>

    <script>
        let currentStatus = 0; // Untuk melacak status filter saat ini
        let currentKeyword = ''; // Untuk melacak kata kunci pencarian saat ini

        function viewLetter(id) {
            $('#letterModal').removeClass('hidden').addClass('flex');
            $.ajax({
                url: '<?= BASEURL ?>/letter/getLetter',
                method: 'POST',
                dataType: 'json',
                data: { id: id },
                success: function(data) {
                    const $letterContent = $('#letterContent');
                    $letterContent.html(`<iframe src="${data}" width="100%" height="500px"></iframe>`);
                },
                error: function() {
                    alert('Gagal memuat detail surat');
                }
            });
        }

        function closeLetterModal() {
            $('#letterModal').addClass('hidden').removeClass('flex');
        }

        function showCommentModal(comment) {
            const $commentModal = $('#commentModal');
            const $commentContent = $('#commentContent');
            $commentContent.text(comment);
            $commentModal.removeClass('hidden').addClass('flex');
        }

        function closeCommentModal() {
            const $commentModal = $('#commentModal');
            $commentModal.addClass('hidden').removeClass('flex');
        }

        function filter(status, currentPage = 1) {
            currentStatus = status;
            currentKeyword = ''; // Reset keyword saat filter
            $('#keyword').val(''); // Reset input pencarian
            $.ajax({
                url: '<?= BASEURL ?>/letter/filter',
                method: 'POST',
                dataType: 'json',
                data: {
                    status: status,
                    halamanAktif: currentPage
                },
                success: function(data) {
                    updateLetterList(data);
                },
                error: function(xhr, status, error) {
                    console.error('Error Status:', status);
                    console.error('Error Details:', error);
                    console.error('Response Text:', xhr.responseText);
                }
            });
        }

        function searchLetters(keyword, page = 1) {
            currentKeyword = keyword;
            currentStatus = 0; // Reset status saat pencarian
            $('.filter-btn').removeClass('active');
            $('.filter-btn[data-status="0"]').addClass('active');
            let debounceTimeout;
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => {
                $.ajax({
                    url: '<?= BASEURL ?>/letter/searchUser',
                    method: 'POST',
                    data: {
                        keyword: keyword,
                        page: page
                    },
                    dataType: 'json',
                    success: function(data) {
                        updateLetterList(data, true);
                    },
                    error: function() {
                        console.log('Error terjadi dalam request');
                    }
                });
            }, 500);
        }

        function updateLetterList(data, isSearch = false) {
            const $letterContainer = $(".letter-card");
            const $navElement = $('#pagination-nav');
            const $tbody = $(".letter-card table tbody");

            $letterContainer.empty();
            $navElement.empty();

            const letters = isSearch ? (data.results || []) : (data.letters || []);
            const totalLetters = parseInt(isSearch ? (data.totalLetters || 0) : (data.totalLetters || 0));
            const currentPage = parseInt(isSearch ? (data.currentPage || 1) : (data.pagination?.halamanAktif || 1));
            const totalPages = parseInt(isSearch ? (data.totalPages || 1) : (data.pagination?.jumlahHalaman || 1));
            const limit = <?= $data['limit'] ?> || 4;

            if (letters.length === 0) {
                $letterContainer.html(`
                    <div class="text-center py-8 md:py-12">
                        <svg class="w-12 md:w-16 h-12 md:h-16 text-red-200 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="text-lg md:text-xl font-medium text-red-900 mb-2">Belum ada surat</h3>
                    </div>
                `);
                $('#pagination-start').text(0);
                $('#pagination-end').text(0);
                $('#pagination-total').text(0);
                $('#pagination-current').text(0);
                $('#pagination-total-pages').text(0);
                return;
            }

            $letterContainer.html(`
                <table class="w-full min-w-[800px]">
                    <thead>
                        <tr class="text-left text-sm font-medium text-gray-500">
                            <th class="pb-4 pl-4">Jenis Dokumen</th>
                            <th class="pb-4">Tanggal</th>
                            <th class="pb-4">Status</th>
                            <th class="pb-4">Komentar</th>
                            <th class="pb-4 pr-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            `);

            const $newTbody = $(".letter-card table tbody");
            letters.forEach(letter => {
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
                        <td class="py-4 pl-4">${letter.title}</td>
                        <td class="py-4">${letter.date}</td>
                        <td class="py-4">${statusBadge}</td>
                        <td class="py-4">
                            <span class="truncated-comment">${truncatedComment}</span>
                            ${readMoreButton}
                        </td>
                        <td class="py-4 pr-4">
                            <button onclick="viewLetter(${letter.letter_id})" class="text-red-600 hover:text-red-800">Lihat Detail</button>
                        </td>
                    </tr>
                `;
                $newTbody.append(row);
            });

            const start = totalLetters > 0 ? ((currentPage - 1) * limit + 1) : 0;
            const end = totalLetters > 0 ? Math.min(start + limit - 1, totalLetters) : 0;

            $('#pagination-start').text(start);
            $('#pagination-end').text(end);
            $('#pagination-total').text(totalLetters);
            $('#pagination-current').text(currentPage);
            $('#pagination-total-pages').text(totalPages);

            if ($navElement.length) {
                generatePagination($navElement[0], currentPage, totalPages, isSearch);
            }
        }

        function generatePagination(navElement, currentPage, totalPages, isSearch) {
            const $ul = $('<ul>', { class: 'flex items-center space-x-1 text-sm' });
            const delta = 2;
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

            if (currentPage > 1) {
                const $prevLi = $(`
                    <li>
                        <a href="javascript:void(0)" onclick="${isSearch ? `searchLetters('${currentKeyword}', ${currentPage - 1})` : `filter(${currentStatus}, ${currentPage - 1})`}"
                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">
                            <span class="sr-only">Previous</span>
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                            </svg>
                        </a>
                    </li>
                `);
                $ul.append($prevLi);
            }

            range.forEach(item => {
                if (item === '...') {
                    const $ellipsisLi = $(`
                        <li>
                            <span class="flex items-center justify-center px-3 h-8 text-gray-500 bg-white border border-gray-300">...</span>
                        </li>
                    `);
                    $ul.append($ellipsisLi);
                } else {
                    const activeClass = item === currentPage ? 'z-10 text-red-600 border-red-300 bg-red-50' : 'text-gray-500 bg-white';
                    const $pageLi = $(`
                        <li>
                            <a href="javascript:void(0)" onclick="${isSearch ? `searchLetters('${currentKeyword}', ${item})` : `filter(${currentStatus}, ${item})`}"
                                class="flex items-center justify-center px-3 h-8 leading-tight ${activeClass} border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                ${item}
                            </a>
                        </li>
                    `);
                    $ul.append($pageLi);
                }
            });

            if (currentPage < totalPages) {
                const $nextLi = $(`
                    <li>
                        <a href="javascript:void(0)" onclick="${isSearch ? `searchLetters('${currentKeyword}', ${currentPage + 1})` : `filter(${currentStatus}, ${currentPage + 1})`}"
                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">
                            <span class="sr-only">Next</span>
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                        </a>
                    </li>
                `);
                $ul.append($nextLi);
            }

            $(navElement).append($ul);
        }

        function showAlert(message, type = 'success') {
            const alertElement = $('#alertMessage');
            const bgColor = type === 'success' ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200';
            const textColor = type === 'success' ? 'text-green-600' : 'text-red-600';
            const iconColor = type === 'success' ? 'text-green-400' : 'text-red-400';

            const alertHtml = `
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

            alertElement.html(alertHtml)
                .removeClass('hidden')
                .css('transform', 'translateY(0)');

            setTimeout(closeAlert, 5000);
        }

        function closeAlert() {
            $('#alertMessage').css('transform', 'translateY(-100%)');
            setTimeout(() => $('#alertMessage').addClass('hidden'), 300);
        }

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

        $('#keyword').on('keyup', function() {
            const keyword = $(this).val();
            searchLetters(keyword);
        });

        $(document).ready(function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    filter(this.dataset.status);
                });
            });

            // Inisialisasi filter saat halaman dimuat
            filter(0, <?= $data['currentPage'] ?>);
        });
    </script>
</body>

</html>