<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Admin Sidebar</title>
    <style>
        /* Custom scrollbar styling */
        .scrollable-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .scrollable-sidebar::-webkit-scrollbar-track {
            background: #f8f8f8;
            border-radius: 3px;
        }

        .scrollable-sidebar::-webkit-scrollbar-thumb {
            background: #e2e2e2;
            border-radius: 3px;
        }

        .scrollable-sidebar::-webkit-scrollbar-thumb:hover {
            background: #cfcfcf;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                z-index: 50;
                width: 250px; /* Slightly narrower on mobile */
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 40;
            }
            .overlay.active {
                display: block;
            }
        }

        /* Ensure main content doesn't get pushed */
        body {
            position: relative;
        }
    </style>
</head>
<body>
    <!-- Mobile Hamburger Button -->
    <div class="md:hidden fixed top-4 left-4 z-50">
        <button id="hamburger" class="text-gray-600 focus:outline-none">
            <i class="fas fa-bars text-2xl"></i>
        </button>
    </div>

    <!-- Overlay -->
    <div id="overlay" class="overlay"></div>

    <!-- Sidebar with Red Theme -->
    <div id="sidebar" class="sidebar fixed inset-y-0 left-0 w-64 bg-white border-r border-red-200 flex flex-col md:translate-x-0">
        <!-- Close Button for Mobile -->
        <button id="close-sidebar" class="md:hidden absolute top-4 right-4 text-gray-600 focus:outline-none">
            <i class="fas fa-times text-2xl"></i>
        </button>

        <!-- Logo & Brand -->
        <div class="flex items-center justify-center h-16 px-6 border-b border-gray-100">
            <a href="<?=BASEURL?>" class="flex items-center">
                <img src="<?= IMAGES;?>/Logo1.webp" alt="IsFor Logo" class="h-10 w-auto">
            </a>
        </div>

        <!-- Scrollable Navigation Section -->
        <div class="flex-1 overflow-y-auto scrollable-sidebar p-4">
            <!-- Main Dashboard -->
            <a href="<?=BASEURL?>/dashboardAdmin"
               class="flex items-center px-4 py-2 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                <i class="fas fa-dashboard w-5 h-5 mr-3"></i>
                <span class="font-medium">Dashboard</span>
            </a>

            <!-- User Management Section -->
            <div class="pt-2">
                <span class="px-4 text-xs font-semibold text-red-500 uppercase tracking-wider">Pengguna</span>
                <div class="mt-2 space-y-1">
                    <!-- Manage Users -->
                    <a href="<?=BASEURL?>/user"
                       class="flex items-center px-4 py-2 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <i class="fas fa-users w-5 h-5 mr-3"></i>
                        <span class="font-medium">Kelola Pengguna</span>
                    </a>
                </div>
            </div>

            <!-- Content Management Section -->
            <div class="pt-2">
                <span class="px-4 text-xs font-semibold text-red-500 uppercase tracking-wider">Konten</span>
                <div class="mt-2 space-y-1">
                    <!-- Agenda -->
                    <a href="<?=BASEURL?>/agenda"
                       class="flex items-center px-4 py-2 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <i class="fas fa-calendar w-5 h-5 mr-3"></i>
                        <span class="font-medium">Agenda</span>
                    </a>

                    <!-- Roadmap -->
                    <a href="<?=BASEURL?>/roadmap"
                       class="flex items-center px-4 py-2 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <i class="fas fa-map-signs w-5 h-5 mr-3"></i>
                        <span class="font-medium">Roadmap</span>
                    </a>
                </div>
            </div>

            <!-- Media Management Section -->
            <div class="pt-2">
                <span class="px-4 text-xs font-semibold text-red-500 uppercase tracking-wider">Media</span>
                <div class="mt-2 space-y-1">
                    <!-- Upload Image -->
                    <a href="<?=BASEURL?>/galleries/uploadImgView"
                       class="flex items-center px-4 py-2 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <i class="fas fa-image w-5 h-5 mr-3"></i>
                        <span class="font-medium">Upload Gambar</span>
                    </a>
                </div>
            </div>

            <!-- Verification Section -->
            <div class="pt-2">
                <span class="px-4 text-xs font-semibold text-red-500 uppercase tracking-wider">Verifikasi</span>
                <div class="mt-2 space-y-1">
                    <!-- Verify Files -->
                    <a href="<?=BASEURL?>/researchoutput/verifyResearchView"
                       class="flex items-center px-4 py-2 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <i class="fas fa-check-circle w-5 h-5 mr-3"></i>
                        <span class="font-medium">Verifikasi File</span>
                    </a>

                    <!-- Verify Letters -->
                    <a href="<?=BASEURL?>/letter/verifyLetterview"
                       class="flex items-center px-4 py-2 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <i class="fas fa-file-alt w-5 h-5 mr-3"></i>
                        <span class="font-medium">Verifikasi Surat</span>
                    </a>
                </div>
            </div>

            <!-- History Section -->
            <div class="pt-2">
                <span class="px-4 text-xs font-semibold text-red-500 uppercase tracking-wider">Riwayat</span>
                <div class="mt-2 space-y-1">
                    <a href="<?= BASEURL ?>/letter/adminLetterHistoryView"
                       class="flex items-center px-4 py-2 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <i class="fas fa-history w-5 h-5 mr-3"></i>
                        <span class="font-medium">Riwayat Surat</span>
                    </a>
                    <a href="<?= BASEURL ?>/researchoutput/adminHistoryView"
                       class="flex items-center px-4 py-2 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg group transition-colors">
                        <i class="fas fa-folder-open w-5 h-5 mr-3"></i>
                        <span class="font-medium">Riwayat File</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Fixed Beranda Button -->
        <div class="p-4 border-t border-gray-100">
            <a href="<?=BASEURL?>"
               class="w-full flex items-center justify-center px-4 py-3 text-base font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                <i class="fas fa-home w-6 h-6 mr-2"></i>
                Beranda
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.getElementById('hamburger');
            const sidebar = document.getElementById('sidebar');
            const closeSidebar = document.getElementById('close-sidebar');
            const overlay = document.getElementById('overlay');

            hamburger.addEventListener('click', function() {
                sidebar.classList.add('active');
                overlay.classList.add('active');
            });

            closeSidebar.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });

            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        });
    </script>
</body>
</html>