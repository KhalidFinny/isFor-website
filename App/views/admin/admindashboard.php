<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - IsFor PRI</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/IsFor-Website/App/public/assets/css/styles.css">
</head>
<body class="bg-gray-50">
    <div class="flex">
        <?php include '../../public/assets/components/AdminDashboard/sidebar.php'; ?>
        <div class="flex-1 min-h-screen ml-64">
            <main class="py-10 px-8">
                <!-- Admin Info -->
                <div class="max-w-7xl mx-auto mb-12 flex justify-between items-center">
                    <div>
                        <h1 class="text-4xl font-bold text-blue-900">Dashboard</h1>
                        <p class="text-gray-600 mt-2">Selamat datang kembali, Admin</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="font-semibold text-blue-900">John Doe</p>
                            <p class="text-sm text-gray-600">Super Admin</p>
                        </div>
                        <img src="/isFor-Website/App/public/assets/images/coding-image.png" alt="Admin Profile" class="w-12 h-12 rounded-full">
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    <div class="bg-white p-6 rounded-2xl border-2 border-blue-100">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-50 rounded-xl">
                                <svg class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Disetujui</p>
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
                                <p class="text-sm font-medium text-gray-500">Ditolak</p>
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
                                <p class="text-sm font-medium text-gray-500">Tertunda</p>
                                <p class="text-2xl font-bold text-blue-900">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl border-2 border-blue-100">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-50 rounded-xl">
                                <svg class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                                <p class="text-2xl font-bold text-blue-900">0</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User List -->
                <div class="bg-white rounded-2xl border-2 border-blue-100 overflow-hidden">
                    <div class="p-6 border-b border-blue-100">
                        <h2 class="text-xl font-semibold text-blue-900">Daftar Pengguna</h2>
                    </div>
                    <div class="p-6">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left text-sm font-medium text-gray-500">
                                    <th class="pb-4">Nama</th>
                                    <th class="pb-4">Email</th>
                                    <th class="pb-4">Role</th>
                                    <th class="pb-4">Status</th>
                                    <th class="pb-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Sample user row -->
                                <tr class="border-t border-gray-100">
                                    <td class="py-4">John Doe</td>
                                    <td class="py-4">john@example.com</td>
                                    <td class="py-4">Peneliti</td>
                                    <td class="py-4">
                                        <span class="px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                            Aktif
                                        </span>
                                    </td>
                                    <td class="py-4">
                                        <button class="text-blue-600 hover:text-blue-800">Edit</button>
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