<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white">
    <div class="flex">
        <?php include '../app/views/assets/components/UserDashboard/sidebar.php'; ?>
        <div class="flex-1 min-h-screen ml-64">
            <main class="py-10 px-8">
                <!-- Header Section with DateTime -->
                <div class="max-w-7xl mx-auto mb-12">
                    <div class="flex justify-between items-start">
                        <div class="space-y-6">
                            <h1 class="text-4xl font-bold text-red-900">Dashboard</h1>
                            <!-- Logout Button -->
                            <div class="absolute top-0 right-10">
                            <form action="<?=BASEURL?>/login/logout" method="POST">
                                <input type="hidden" name="action" value="logout">
                                <button type="submit"
                                        class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Keluar
                                </button>
                            </form>
                        </div>

                            <!-- Swiss-style Date Time Display -->
                            <div class="inline-flex items-center space-x-8 bg-white border-2 border-red-100 rounded-2xl p-4 shadow-sm">
                                <!-- Date Display -->
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-red-50 rounded-xl">
                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs uppercase tracking-wider text-gray-500 font-medium">Tanggal</span>
                                        <span id="currentDate" class="text-lg font-bold text-gray-800"></span>
                                    </div>
                                </div>

                                <!-- Vertical Divider -->
                                <div class="h-12 w-px bg-red-100"></div>

                                <!-- Time Display -->
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-red-50 rounded-xl">
                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs uppercase tracking-wider text-gray-500 font-medium">Waktu</span>
                                        <span id="currentTime" class="text-lg font-bold text-gray-800 tabular-nums"></span>
                                    </div>
                                </div>
                            </div>

                            <p class="text-gray-600">Selamat datang kembali, <?= $data['user']['name'] ?></p>
                        </div>

                        <!-- Profile Info -->
                        <div class="flex items-center space-x-4 mt-10">
                            <div class="text-right">
                                <p class="font-semibold text-red-900"><?= $data['user']['name'] ?></p>
                                <p class="text-sm text-gray-600">Peneliti</p>
                            </div>
                            <?php if($data['user']['profile_picture'] == NULL) :?>
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-red-100"
                                    src="<?= ASSETS ?>/images/empty-user.png" alt="">
                            <?php else :?>
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-red-100"
                                    src="<?= PHOTOPROFILE . $data['user']['profile_picture']?>" alt="">
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
                                <svg class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
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
                                <svg class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
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
                                <svg class="w-8 h-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
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
                    <div class="p-6">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left text-sm font-medium text-gray-500">
                                    <th class="pb-4">Jenis Dokumen</th>
                                    <th class="pb-4">Tanggal</th>
                                    <th class="pb-4">Status</th>
                                    <th class="pb-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data['letter'] AS $letter) :?>
                                <tr class="border-t border-gray-100 hover:bg-red-50/30 transition-colors duration-200">
                                    <td class="py-4"><?= $letter['title'] ?></td>
                                    <td class="py-4"><?= $letter['date'] ?></td>
                                    <td class="py-4">
                                        <?php if($letter['status'] == 1) :?>
                                            <span class="px-3 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">
                                                Tertunda
                                            </span>
                                        <?php elseif($letter['status'] == 2) :?>
                                            <span class="px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                                Disetujui
                                            </span>
                                        <?php else :?>
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
            </main>
        </div>

        <!-- View Letter Modal -->
        <div id="letterModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-2xl p-8 max-w-2xl w-full mx-4 modal-enter">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-red-900">Detail Surat</h3>
                    <button onclick="closeLetterModal()" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
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
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // DateTime Update Function
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
            document.getElementById('currentDate').textContent = dateFormatter.format(now);

            // Time formatting
            const timeOptions = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            const timeFormatter = new Intl.DateTimeFormat('id-ID', timeOptions);
            const timeElement = document.getElementById('currentTime');
            const newTime = timeFormatter.format(now);

            if (timeElement.textContent !== newTime) {
                timeElement.classList.add('animate-pulse');
                setTimeout(() => {
                    timeElement.classList.remove('animate-pulse');
                }, 500);
            }

            timeElement.textContent = newTime;
        }

        // Modal Functions
        function viewLetter(id) {
            document.getElementById('letterModal').classList.remove('hidden');
            document.getElementById('letterModal').classList.add('flex');

            $.ajax({
                url: '<?= BASEURL ?>/letter/getLetter',
                method: 'POST',
                dataType: 'json',
                data: { id : id},
                success: function(data){
                    const letterContent = document.getElementById('letterContent');
                    letterContent.innerHTML = `
                        <iframe src="${data}" width="100%" height="500px" class="rounded-lg border border-red-100"></iframe>
                    `;
                },
                error: function(data){
                    alert('Gagal memuat dokumen');
                }
            });
        }

        function closeLetterModal() {
            document.getElementById('letterModal').classList.add('hidden');
            document.getElementById('letterModal').classList.remove('flex');
        }

        // Initialize DateTime
        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .tabular-nums {
            font-variant-numeric: tabular-nums;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .animate-pulse {
            animation: pulse 0.5s ease-in-out;
        }

        @keyframes modalEnter {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(-10px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .modal-enter {
            animation: modalEnter 0.3s ease-out;
        }
    </style>
</body>
</html>