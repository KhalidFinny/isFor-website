<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/IsFor-Website/App/public/assets/css/animations.css">
    <title>Sidebar User</title>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
</head>
<body class="relative">
    <!-- Mobile Hamburger Button -->
    <button onclick="toggleSidebar()" class="md:hidden fixed top-4 left-4 z-50 text-gray-600 p-2">
        <i class="fas fa-bars text-2xl"></i>
    </button>

    <!-- Sidebar Overlay -->
    <div id="sidebar-overlay" 
         onclick="toggleSidebar()" 
         class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"></div>

    <!-- Sidebar with Red Theme -->
    <div id="mobile-sidebar" 
         class="fixed inset-y-0 left-0 w-64 bg-white border-r border-red-200 
                transform -translate-x-full md:translate-x-0 
                transition-transform duration-300 ease-in-out z-50">
        <!-- Logo & Brand -->
        <div class="flex items-center justify-center h-16 px-6 border-b border-gray-100">
            <a href="<?= BASEURL ?>" class="flex items-center">
                <img src="<?= IMAGES;?>/Logo1.webp" alt="IsFor Logo" class="h-10 w-auto">
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
                        <i class="fas fa-dashboard w-5 h-5 mr-3"></i>
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
                        <i class="fas fa-file-alt w-5 h-5 mr-3"></i>
                        <span class="font-medium">Ajukan Surat</span>
                    </a>
                    <a href="<?= BASEURL ?>/researchoutput/uploadResearchView" 
                       class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <i class="fas fa-file-upload w-5 h-5 mr-3"></i>
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
                        <i class="fas fa-history w-5 h-5 mr-3"></i>
                        <span class="font-medium">Riwayat Surat</span>
                    </a>
                    <a href="<?= BASEURL ?>/researchoutput/researchHistoryView" 
                       class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <i class="fas fa-folder-open w-5 h-5 mr-3"></i>
                        <span class="font-medium">Riwayat File</span>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Beranda Button -->
        <div class="absolute bottom-[88px] left-0 right-0 p-4 border-t border-gray-100">
            <a href="<?= BASEURL?>"
               class="w-full flex items-center justify-center px-4 py-3 text-base font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                <i class="fas fa-home w-6 h-6 mr-2"></i>
                Beranda
            </a>
        </div>
    </div>
</body>
</html>