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
    <!-- Sidebar with Red Theme -->
    <div class="fixed inset-y-0 left-0 w-64 bg-white border-r border-red-200">
        <!-- Logo & Brand -->
        <div class="flex items-center justify-center h-16 px-6 border-b border-gray-100">
            <a href="<?= BASEURL ?>" class="flex items-center">
                <img src="<?= ASSETS ?>/images/Logo1.webp" alt="IsFor Logo" class="h-10 w-auto">
            </a>
        </div>

        <!-- Navigation -->
        <nav class="p-4 space-y-1">
            <!-- Main Navigation -->
            <div>
                <span class="px-4 text-xs font-semibold text-red-500 uppercase tracking-wider">Navigasi</span>
                <div class="mt-2 space-y-1">
                    <a href="<?= BASEURL ?>/dashboarduser" 
                       class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                  d="M12 2a10 10 0 110 20 10 10 0 010-20zm1 14h-2v-2h2v2zm0-4h-2V7h2v5z"/>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </div>
            </div>

            <!-- Pengajuan Section -->
            <div class="pt-4">
                <span class="px-4 text-xs font-semibold text-red-500 uppercase tracking-wider">Pengajuan</span>
                <div class="mt-2 space-y-1">
                    <a href="<?= BASEURL ?>/letter/addLetterView" 
                       class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="font-medium">Ajukan Surat</span>
                    </a>
                    <a href="<?= BASEURL ?>/researchoutput/uploadResearchView" 
                       class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                  d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-medium">Upload File</span>
                    </a>
                </div>
            </div>

            <!-- Riwayat Section -->
            <div class="pt-4">
                <span class="px-4 text-xs font-semibold text-red-500 uppercase tracking-wider">Riwayat</span>
                <div class="mt-2 space-y-1">
                    <a href="<?= BASEURL ?>/letter/letterHistoryView" 
                       class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span class="font-medium">Riwayat Surat</span>
                    </a>
                    <a href="<?= BASEURL ?>/researchoutput/researchHistoryView" 
                       class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                  d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        </svg>
                        <span class="font-medium">Riwayat File</span>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Beranda Button -->
        <div class="absolute bottom-[88px] left-0 right-0 p-4 border-t border-gray-100">
            <a href="<?= BASEURL ?>" 
               class="w-full flex items-center justify-center px-4 py-3 text-base font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                <svg class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Beranda
            </a>
        </div>

        <!-- Logout Button -->
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-100">
            <form action="<?= BASEURL ?>/login/logout" method="POST">
                <input type="hidden" name="action" value="logout">
                <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </div>
</body>
</html> 