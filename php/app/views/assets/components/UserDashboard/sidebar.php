<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/IsFor-Website/App/public/assets/css/animations.css">
    <title>Sidebar User</title>
</head>
<body>
    <nav class="w-64 h-screen bg-white border-r border-gray-200 fixed left-0 top-0">
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200">
                <a href="<?= BASEURL; ?>" class="flex items-center space-x-3">
                    <img src="<?= ASSETS; ?>/images/Logo1.png" alt="Logo" class="h-8">
                    <span class="text-sm font-semibold text-blue-900">IsFor</span>
                </a>
            </div>

            <!-- Menu Navigasi -->
            <div class="flex-1 overflow-y-auto py-6">
                <div class="px-4 space-y-4">
                    <!-- Navigation Links -->
                    <div class="space-y-1">
                        <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Navigasi</p>
                        <a href="<?= BASEURL; ?>/dashboarduser" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-900 hover:bg-blue-50">
                            <svg class="w-5 h-5 mr-3 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                        <a href="<?= BASEURL; ?>" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-900 hover:bg-blue-50">
                            <svg class="w-5 h-5 mr-3 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Beranda
                        </a>
                    </div>

                    <!-- Pengajuan Section -->
                    <div class="space-y-1">
                        <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Pengajuan</p>
                        <a href="<?= BASEURL; ?>/papers/addPaperView" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-900 hover:bg-blue-50">
                            <svg class="w-5 h-5 mr-3 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Ajukan Surat
                        </a>
                        <a href="<?= BASEURL; ?>/galleries/uploadImgView" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-900 hover:bg-blue-50">
                            <svg class="w-5 h-5 mr-3 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Upload Gambar
                        </a>
                    </div>

                    <!-- Riwayat Section -->
                    <div class="space-y-1">
                        <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Riwayat</p>
                        <a href="/isFor-website/App/views/user/letter-history.php" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-900 hover:bg-blue-50">
                            <svg class="w-5 h-5 mr-3 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Riwayat Surat
                        </a>
                        <a href="/isFor-website/App/views/user/image-history.php" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-900 hover:bg-blue-50">
                            <svg class="w-5 h-5 mr-3 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Riwayat Gambar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Logout Button -->
            <div class="p-4 border-t border-gray-200">
                <form action="<?= BASEURL; ?>/login/logout" method="POST">
                    <input type="hidden" name="action" value="logout">
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>
</body>
</html> 