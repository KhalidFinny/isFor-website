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
                    <p class="text-gray-600 mt-2">Selamat datang kembali, <?= $data['user']['username'] ?></p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="font-semibold text-blue-900"><?= $data['user']['username'] ?></p>
                        <p class="text-sm text-gray-600">Peneliti</p>
                    </div>
                    <img src="../app/img/profile/<?= $data['user']['profile_picture'] ?>" alt="User Profile" class="w-12 h-12 rounded-full object-cover">
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
                            <p class="text-2xl font-bold text-blue-900">0</p>
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
                            <p class="text-2xl font-bold text-blue-900">0</p>
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
                            <p class="text-2xl font-bold text-blue-900">0</p>
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
                        <tr class="border-t border-gray-100">
                            <td class="py-4">Surat Penelitian</td>
                            <td class="py-4">2024-03-20</td>
                            <td class="py-4">
                                        <span class="px-3 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">
                                            Tertunda
                                        </span>
                            </td>
                            <td class="py-4">
                                <button class="text-blue-600 hover:text-blue-800">Lihat Detail</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>