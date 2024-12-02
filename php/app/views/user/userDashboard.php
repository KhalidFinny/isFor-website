<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - IsFor PRI</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>/assets/css/styles.css">
</head>
<body class="bg-gray-50">
<div class="flex">
    <?php include '../app/views/assets/components/UserDashboard/sidebar.php'; ?>
    <div class="flex-1 min-h-screen ml-64">
        <main class="py-10 px-8">
            <!-- User Info -->
            <div class="max-w-7xl mx-auto mb-12 flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold text-blue-900">Dashboard</h1>
                    <p class="text-gray-600 mt-2">Selamat datang kembali, <?= $data['user']['name'] ?></p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="font-semibold text-blue-900"><?= $data['user']['name'] ?></p>
                        <p class="text-sm text-gray-600">Peneliti</p>
                    </div>
                    <?php if($data['user']['profile_picture'] == NULL) :?>
                        <img class="h-10 w-10 rounded-full object-cover" src="<?= ASSETS ?>/images/empty-user.png" alt="">
                    <?php else :?>
                        <img class="h-10 w-10 rounded-full object-cover" src="<?= PHOTOPROFILE . $data['user']['profile_picture']?>" alt="">
                    <?php endif; ?>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                <div class="bg-white p-6 rounded-2xl border-2 border-blue-100">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-50 rounded-xl">
                            <svg class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Surat Disetujui</p>
                            <p class="text-2xl font-bold text-blue-900"><?= $data['verify']['total'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border-2 border-blue-100">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-50 rounded-xl">
                            <svg class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Surat Ditolak</p>
                            <p class="text-2xl font-bold text-blue-900"><?= $data['reject']['total'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border-2 border-blue-100">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-50 rounded-xl">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Surat Tertunda</p>
                            <p class="text-2xl font-bold text-blue-900"><?= $data['pending']['total'] ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Submissions -->
            <div class="bg-white rounded-2xl border-2 border-blue-100 overflow-hidden">
                <div class="p-6 border-b border-blue-100">
                    <h2 class="text-xl font-semibold text-blue-900">Pengajuan Terbaru</h2>
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
                        <!-- Sample submission row -->
                        <?php foreach($data['letter'] AS $letter) :?>
                        <tr class="border-t border-gray-100">
                            <td class="py-4"><?= $letter['title'] ?></td>
                            <td class="py-4"><?= $letter['date'] ?></td>
                            <td class="py-4">
                                <?php if($letter['status'] == 1) :?>
                                    <span class="px-3 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">
                                        Tertunda
                                    </span>
                                <?php elseif($letter['status'] == 2) :?>
                                    <span class="px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                        disetujui
                                    </span>
                                <?php else :?>
                                    <span class="px-3 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">
                                        ditolak
                                    </span>
                                <?php endif ?>
                            </td>
                            <td class="py-4">
                                <button onclick="viewLetter(<?= $letter['letter_id']; ?>)" class="text-blue-600 hover:text-blue-800">Lihat Detail</button>
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
    <div id="letterModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl p-8 max-w-2xl w-full mx-4">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-blue-900">Detail Surat</h3>
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

    <script>
        function viewLetter(id) {
            // Implementation for viewing letter
            document.getElementById('letterModal').classList.remove('hidden');
            document.getElementById('letterModal').classList.add('flex');

            $.ajax({
                url: '<?= BASEURL ?>/letter/getLetter',
                method: 'POST',
                dataType: 'json',
                data: { id : id},
                success: function(data){
                    console.log(data);
                    // Implementation for viewing letter
                    const letterContent = document.getElementById('letterContent');
                    letterContent.innerHTML = `
                        <iframe src="${data}" width="100%" height="500px"></iframe>
                    `;
                },
                error: function(data){
                    alert('Gagal');
                }
            });
        }

        function closeLetterModal() {
            document.getElementById('letterModal').classList.add('hidden');
            document.getElementById('letterModal').classList.remove('flex');
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</div>
</body>
</html>