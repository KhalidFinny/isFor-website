<?php
//var_dump($data);
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS; ?>/user/dashboard-user.css?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-white">
    <div class="flex">
        <?php include '../app/views/assets/components/UserDashboard/sidebar.php'; ?>
        <div class="flex-1 min-h-screen md:ml-64">

            <!-- Main Content -->
            <main class="flex-1 main-content p-8 pt-20 bg-white" id="mainContent">
                <div class="max-w-7xl mx-auto">
                    <!-- Modern Header with Profile Section -->
                    <div class="header-section flex justify-between items-center mb-8">
                        <div class="space-y-6">
                            <h1 class="text-3xl font-bold text-red-600">Dashboard Overview</h1>
                            <!-- Logout Button -->
                            <div class="logout-button absolute top-0 right-10">
                                <form action="<?= BASEURL ?>/login/logout" method="POST">
                                    <input type="hidden" name="action" value="logout">
                                    <button type="submit"
                                        class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>

                            <!-- Swiss-style Date Time Display -->
                            <div class="date-time-display inline-flex items-center space-x-8 bg-white border-2 border-red-100 rounded-2xl p-4 shadow-sm">
                                <!-- Date Display -->
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-red-50 rounded-xl">
                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs uppercase tracking-wider text-gray-500 font-medium">Date</span>
                                        <span id="currentDate" class="text-lg font-bold text-gray-800"></span>
                                    </div>
                                </div>

                                <!-- Vertical Divider -->
                                <div class="divider h-12 w-px bg-red-100"></div>

                                <!-- Time Display -->
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-red-50 rounded-xl">
                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs uppercase tracking-wider text-gray-500 font-medium">Time</span>
                                        <span id="currentTime" class="text-lg font-bold text-gray-800 tabular-nums"></span>
                                    </div>
                                </div>
                            </div>

                            <h2 class="font-bold text-xl text-gray-600">Welcome back!</h2>
                            <span class="font-medium text-2xl text-red-600"><?php echo htmlspecialchars($data['user']['name']); ?></span>
                        </div>

                        <!-- Profile Section -->
                        <div class="flex items-center space-x-4">
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($data['user']['name']); ?></p>
                                <p class="text-xs text-gray-500">
                                    <?php echo ($data['user']['role_id'] == 1) ? 'Administrator' : 'Researcher'; ?>
                                </p>
                            </div>
                            <div class="h-10 w-10 rounded-full overflow-hidden bg-gray-100">
                                <?php if ($data['user']['profile_picture'] == null): ?>
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden bg-red-50">
                                        <svg class="h-full w-full object-cover rounded-full"
                                            viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 6C13.66 6 15 7.34 15 9C15 10.66 13.66 12 12 12C10.34 12 9 10.66 9 9C9 7.34 10.34 6 12 6ZM12 20.2C9.5 20.2 7.29 18.92 6 16.98C6.03 14.99 10 13.9 12 13.9C13.99 13.9 17.97 14.99 18 16.98C16.71 18.92 14.5 20.2 12 20.2Z"
                                                fill="#ef4444" />
                                        </svg>
                                    </div>
                                <?php else: ?>
                                    <img class="h-full w-full object-cover"
                                        src="<?= PHOTOPROFILE . $data['user']['profile_picture'] ?>" alt="Profile">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                        <!-- Approved Letters -->
                        <div class="bg-white p-6 rounded-2xl border-2 border-red-100 hover:border-green-200 transition-colors duration-300">
                            <div class="flex items-center">
                                <div class="p-3 bg-green-50 rounded-xl">
                                    <i class="fas fa-check-circle text-green-600 w-8 h-8"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Surat Disetujui</p>
                                    <p class="text-2xl font-bold text-red-900"><?= $data['verify']['total'] ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Rejected Letters -->
                        <div class="bg-white p-6 rounded-2xl border-2 border-red-100 hover:border-red-200 transition-colors duration-300">
                            <div class="flex items-center">
                                <div class="p-3 bg-red-50 rounded-xl">
                                    <i class="fas fa-times-circle text-red-600 w-8 h-8"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Surat Ditolak</p>
                                    <p class="text-2xl font-bold text-red-900"><?= $data['reject']['total'] ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Letters -->
                        <div class="bg-white p-6 rounded-2xl border-2 border-red-100 hover:border-yellow-200 transition-colors duration-300">
                            <div class="flex items-center">
                                <div class="p-3 bg-yellow-50 rounded-xl">
                                    <i class="fas fa-clock text-yellow-600 w-8 h-8"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Surat Tertunda</p>
                                    <p class="text-2xl font-bold text-red-900"><?= $data['pending']['total'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Submissions Table -->
                    <div class="bg-white rounded-2xl border-2 border-red-100 overflow-hidden">
                        <div class="p-6 border-b border-red-100">
                            <h2 class="text-xl font-semibold text-red-900">Pengajuan Terbaru</h2>
                        </div>
                        <div class="p-6 overflow-x-auto">
                            <table class="w-full min-w-[600px]">
                                <thead>
                                    <tr class="text-left text-sm font-medium text-gray-500">
                                        <th class="pb-4">Jenis Dokumen</th>
                                        <th class="pb-4">Tanggal</th>
                                        <th class="pb-4">Status</th>
                                        <th class="pb-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['letter'] as $letter) : ?>
                                        <tr class="border-t border-gray-100 hover:bg-red-50/30 transition-colors duration-200">
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
                                                <button onclick="viewLetter(<?= $letter['letter_id']; ?>)"
                                                    class="text-red-600 hover:text-red-800 transition-colors duration-200">
                                                    Lihat Detail
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                    // Hitung data "Showing X to Y of Z results"
                    $start = ($data['currentPage'] - 1) * $data['limit'] + 1;
                    $end = $start + $data['limit'] - 1;
                    if ($end > $data['totalLetters']) {
                        $end = $data['totalLetters'];
                    }

                    // Helper function untuk membuat rentang halaman dengan ellipsis
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
                    $pageRange = getPaginationRange($data['totalPages'], $data['currentPage']);
                    ?>

                    <!-- Pagination Container -->
                    <div class="mt-4 flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0">
                        <!-- Showing X to Y of Z results -->
                        <div class="text-sm text-gray-500">
                            Showing <span class="font-medium"><?= $start ?></span>
                            to <span class="font-medium"><?= $end ?></span>
                            of <span class="font-medium"><?= $data['totalLetters'] ?></span> results
                        </div>

                        <!-- Page X of Y + Navigation -->
                        <div class="flex items-center space-x-2">
                            <!-- "Page X of Y" -->
                            <div class="text-sm text-gray-500">
                                Page <span class="font-medium"><?= $data['currentPage'] ?></span>
                                of <span class="font-medium"><?= $data['totalPages'] ?></span>
                            </div>

                            <!-- Page Number Controls -->
                            <nav aria-label="Page navigation example" id="pagination-nav">
                                <ul class="flex items-center space-x-1 text-sm">
                                    <!-- Tombol Previous -->
                                    <?php if ($data['currentPage'] > 1) : ?>
                                        <li>
                                            <a href="?page=<?= $data['currentPage'] - 1 ?>"
                                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 transition-colors">
                                                <span class="sr-only">Previous</span>
                                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 1 1 5l4 4" />
                                                </svg>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <!-- Tombol Halaman dengan Ellipsis -->
                                    <?php foreach ($pageRange as $item) : ?>
                                        <?php if ($item === '...') : ?>
                                            <li>
                                                <span class="flex items-center justify-center px-3 h-8 text-gray-500 bg-white border border-gray-300">...</span>
                                            </li>
                                        <?php elseif ($item == $data['currentPage']) : ?>
                                            <li>
                                                <a href="?page=<?= $item ?>" aria-current="page"
                                                    class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-red-600 border border-red-300 bg-red-50 hover:bg-red-100 hover:text-red-700 transition-colors">
                                                    <?= $item ?>
                                                </a>
                                            </li>
                                        <?php else : ?>
                                            <li>
                                                <a href="?page=<?= $item ?>"
                                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 transition-colors">
                                                    <?= $item ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                    <!-- Tombol Next -->
                                    <?php if ($data['currentPage'] < $data['totalPages']) : ?>
                                        <li>
                                            <a href="?page=<?= $data['currentPage'] + 1 ?>"
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

            </main>
        </div>

        <!-- View Letter Modal -->
        <div id="letterModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-2xl p-8 max-w-2xl w-full mx-4 modal-enter">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-red-900">Detail Surat</h3>
                    <button onclick="closeLetterModal()" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                <div id="letterContent">
                    <!-- Letter content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
    <script>
        function updateDateTime() {
            const now = new Date();

            // Date formatting
            const dateOptions = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const dateFormatter = new Intl.DateTimeFormat('id-ID', dateOptions);
            $('#currentDate').text(dateFormatter.format(now));

            // Time formatting
            const timeOptions = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            const timeFormatter = new Intl.DateTimeFormat('id-ID', timeOptions);
            const newTime = timeFormatter.format(now);

            const $timeElement = $('#currentTime');
            if ($timeElement.text() !== newTime) {
                $timeElement.addClass('animate-pulse');
                setTimeout(() => {
                    $timeElement.removeClass('animate-pulse');
                }, 500);
            }

            $timeElement.text(newTime);
        }

        function viewLetter(id) {
            $('#letterModal').removeClass('hidden').addClass('flex');

            $.ajax({
                url: '<?= BASEURL ?>/letter/getLetter',
                method: 'POST',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#letterContent').html(`
                <iframe src="${data}" width="100%" height="500px" class="rounded-lg border border-red-100"></iframe>
            `);
                },
                error: function() {
                    alert('Gagal memuat dokumen');
                }
            });
        }

        function closeLetterModal() {
            $('#letterModal').addClass('hidden').removeClass('flex');
        }

        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
</body>

</html>