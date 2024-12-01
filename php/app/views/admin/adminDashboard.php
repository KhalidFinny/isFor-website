<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>/assets/css/styles.css">
    <link rel="stylesheet" href="http://localhost/IsFor-website/php/app/views/assets/css/inandout.css">
    <script src="http://localhost/IsFor-website/php/app/views/assets/js/animations.js" defer></script>
</head>
<body class="bg-white">
    <div class="flex fade-in">
        <?php include '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>
        <div class="flex-1 min-h-screen ml-64">
            <main class="py-10 px-8 slide-up delay-200">
                <!-- User Info -->
                <div class="max-w-7xl mx-auto mb-12 flex justify-between items-center slide-in-right delay-300">
                    <div>
                        <h1 class="text-4xl font-bold text-blue-900">Dashboard</h1>
                        <p class="text-gray-600 mt-2">Selamat datang kembali, <?= $data['user']['username'] ?></p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="font-semibold text-blue-900"><?= $data['user']['username'] ?></p>
                            <p class="text-sm text-gray-600">Pengelola</p>
                        </div>
                        <img src="<?= PHOTOPROFILE . $data['user']['profile_picture'] ?>" alt="User Profile" class="w-12 h-12 rounded-full object-cover">
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 stagger-children">
                    <!-- Letter Stats -->
                    <div class="bg-white p-6 rounded-2xl border-2 border-blue-100">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-50 rounded-xl">
                                <svg class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Surat Masih Pending</p>
                                <p class="text-2xl font-bold text-blue-900">0</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border-2 border-blue-100">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-50 rounded-xl">
                                <svg class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Surat Terverifikasi</p>
                                <p class="text-2xl font-bold text-blue-900">0</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border-2 border-blue-100">
                        <div class="flex items-center">
                            <div class="p-3 bg-yellow-50 rounded-xl">
                                <svg class="w-8 h-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Gambar Masih Pending</p>
                                <p class="text-2xl font-bold text-blue-900">0</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border-2 border-blue-100">
                        <div class="flex items-center">
                            <div class="p-3 bg-red-50 rounded-xl">
                                <svg class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Dokumen Ditolak</p>
                                <p class="text-2xl font-bold text-blue-900">0</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add User Button -->
                <div class="mb-6">
                    <a href="<?= BASEURL; ?>/User" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah User
                    </a>
                </div>

                <!-- Recent Users Table -->
                <div class="bg-white rounded-2xl border-2 border-blue-100 overflow-hidden">
                    <div class="p-6 border-b border-blue-100">
                        <h2 class="text-xl font-semibold text-blue-900">Daftar User</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr class="text-left text-sm font-medium text-gray-500">
                                    <th class="px-6 py-4">Nama</th>
                                    <th class="px-6 py-4">Role</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php foreach ($data['allUser'] as $allUser) :?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                <img class="h-10 w-10 rounded-full object-cover" src="<?= PHOTOPROFILE . $allUser['profile_picture']?>" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900"><?= $allUser['username'] ?></div>
                                                <div class="text-sm text-gray-500"><?= $allUser['email'] ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <?php if ($allUser['role_id'] == 1) : ?>
                                                <p>Pengelola</p>
                                            <?php elseif ($allUser['role_id'] == 2) : ?>
                                                <p>Peneliti</p>
                                            <?php else : ?>
                                                <p>Role tidak ada</p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="<?= BASEURL; ?>/User/editView/<?= $allUser['user_id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                        <?php if ($allUser['user_id'] != $_SESSION['user_id']) : ?>
                                            <a href="<?= BASEURL; ?>/User/Delete/<?= $allUser['user_id'] ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Delete</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>