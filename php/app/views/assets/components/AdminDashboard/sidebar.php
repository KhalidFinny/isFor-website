<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/IsFor-Website/App/public/assets/css/animations.css">
    <title>Sidebar Admin</title>
</head>
<body>
    <!-- Sidebar with Red Theme -->
    <div class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-100">
        <!-- Logo & Brand -->
        <div class="flex items-center h-16 px-6 border-b border-gray-100">
            <a href="<?= BASEURL ?>" class="flex items-center space-x-2">
                <img src="<?= ASSETS ?>/images/Logo1.png" alt="IsFor Logo" class="h-8 w-auto">
                <span class="text-xl font-medium text-red-600">IsFor</span>
            </a>
        </div>

        <!-- Navigation -->
        <nav class="p-4 space-y-1">
            <!-- Main Dashboard -->
            <a href="<?= BASEURL ?>/dashboardAdmin"
               class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>

            <!-- Content Management Section -->
            <div class="pt-4">
                <span class="px-4 text-xs font-semibold text-red-500 uppercase tracking-wider">Konten</span>
                <div class="mt-2 space-y-1">
                    <!-- Beranda -->
                    <a href="<?= BASEURL ?>/home" 
                       class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span class="font-medium">Beranda</span>
                    </a>

                    <!-- Agenda -->
                    <a href="http://localhost/IsFor-website/php/app/views/admin/manage-agenda.php" 
                       class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span class="font-medium">Agenda</span>
                    </a>

                    <!-- Roadmap -->
                    <a href="http://localhost/IsFor-website/php/app/views/admin/manage-roadmap.php" 
                       class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                  d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        <span class="font-medium">Roadmap</span>
                    </a>
                </div>
            </div>

            <!-- Media Management Section -->
            <div class="pt-4">
                <span class="px-4 text-xs font-semibold text-red-500 uppercase tracking-wider">Media</span>
                <div class="mt-2 space-y-1">
                    <!-- Upload Image -->
                    <a href="http://localhost/IsFor-website/php/app/views/admin/upload-image.php" 
                       class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-medium">Upload Gambar</span>
                    </a>
                </div>
            </div>

            <!-- Verification Section -->
            <div class="pt-4">
                <span class="px-4 text-xs font-semibold text-red-500 uppercase tracking-wider">Verifikasi</span>
                <div class="mt-2 space-y-1">
                    <!-- Verify Images -->
                    <a href="http://localhost/IsFor-website/php/app/views/admin/verifyImages.php" 
                       class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-medium">Verifikasi Gambar</span>
                    </a>

                    <!-- Verify Letters -->
                    <a href="http://localhost/IsFor-website/php/app/views/admin/verifyLetters.php" 
                       class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="font-medium">Verifikasi Surat</span>
                    </a>
                </div>
            </div>

            <!-- User Management Section -->
            <div class="pt-4">
                <span class="px-4 text-xs font-semibold text-red-500 uppercase tracking-wider">Pengguna</span>
                <div class="mt-2 space-y-1">
                    <!-- Manage Users -->
                    <a href="http://localhost/IsFor-website/php/app/views/admin/users.php" 
                       class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span class="font-medium">Kelola Pengguna</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</body>
</html>