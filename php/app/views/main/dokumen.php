<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Resource Archive - IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/IsFor-website/php/app/views/assets/css/inandout.css">
    <script src="http://localhost/IsFor-website/php/app/views/assets/js/animations.js" defer></script>
    <style>
        .document-item {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .document-item.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .category-label {
            font-family: 'Space Grotesk', sans-serif;
            transition: all 0.3s ease;
        }
        
        .document-item:hover {
            border-color: #F6523B;
        }
        
        .search-container {
            position: relative;
            margin-bottom: 2rem;
        }
        
        .search-input {
            width: 100%;
            padding: 1rem 1.5rem;
            padding-left: 3rem;
            border: 2px solid #F6523B;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            border-color: #F6523B;
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <?php if (!isset($_SESSION['user_id'])) : ?>
        <?php include_once '../app/views/assets/components/navbar.php'; ?>
    <?php else : ?>
        <?php include_once '../app/views/assets/components/navbarafterlogin.php'; ?>
    <?php endif; ?>

    <section class="min-h-screen py-20 relative overflow-hidden">
        <div class="container mx-auto px-6 max-w-4xl">
            <!-- Header -->
            <div class="mb-20">
                <span class="inline-block px-4 py-2 bg-red-50 text-red-600 rounded-full text-sm font-medium mb-4">
                    Resource Archive
                </span>
                <h2 class="text-5xl font-bold mb-6 text-red-900">
                    Dokumen & Panduan
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-red-600 to-red-800 rounded-full"></div>
            </div>

            <!-- Document Items -->
            <div class="space-y-6">
    <div class="document-item group">
        <div class="flex items-start space-x-8 p-8 border-2 border-gray-100 rounded-xl hover:bg-white hover:shadow-lg transition-all duration-300">
            <div class="flex-1">
                <h3 class="text-xl font-bold text-red-900 mb-3 group-hover:text-red-600 transition-colors duration-300">
                    Dokumen Renstra Penelitian Bab 1 - 6
                </h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Dokumen Rencana Strategis Penelitian
                </p>
                <a href="<?= BASEURL ?>/document/Dokumen Renstra Penelitian Bab 1 - 6 (fix fix).pdf" download
                    class="inline-flex items-center space-x-2 text-red-600 hover:text-red-700 font-medium"
                    target="_blank">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span>Download Document</span>
                </a>
            </div>
        </div>
    </div>
    <div class="document-item group">
        <div class="flex items-start space-x-8 p-8 border-2 border-gray-100 rounded-xl hover:bg-white hover:shadow-lg transition-all duration-300">
            <div class="flex-1">
                <h3 class="text-xl font-bold text-red-900 mb-3 group-hover:text-red-600 transition-colors duration-300">
                    Panduan Penelitian dan PPM Tahun 2023
                </h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Panduan untuk Penelitian dan PPM
                </p>
                <a href="<?= BASEURL ?>/document/Panduan Penelitian dan PPM Tahun 2023.pdf" download
                    class="inline-flex items-center space-x-2 text-red-600 hover:text-red-700 font-medium"
                    target="_blank">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span>Download Document</span>
                </a>
            </div>
        </div>
    </div>
    <div class="document-item group">
        <div class="flex items-start space-x-8 p-8 border-2 border-gray-100 rounded-xl hover:bg-white hover:shadow-lg transition-all duration-300">
            <div class="flex-1">
                <h3 class="text-xl font-bold text-red-900 mb-3 group-hover:text-red-600 transition-colors duration-300">
                    Narasi Visi & Misi Pusat Riset IsFoR
                </h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Dokumen yang berisi penjelasan detail tentang visi dan misi Pusat Riset IsFoR
                </p>
                <a href="<?= BASEURL ?>/document/Pusat Riset IsFoR - narasi-visi-misi.docx" download
                    class="inline-flex items-center space-x-2 text-red-600 hover:text-red-700 font-medium"
                    target="_blank">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span>Download Document</span>
                </a>
            </div>
        </div>
    </div>
    <div class="document-item group">
        <div class="flex items-start space-x-8 p-8 border-2 border-gray-100 rounded-xl hover:bg-white hover:shadow-lg transition-all duration-300">
            <div class="flex-1">
                <h3 class="text-xl font-bold text-red-900 mb-3 group-hover:text-red-600 transition-colors duration-300">
                    Narasi Pusat Riset IsFoR
                </h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Dokumen narasi lengkap tentang Pusat Riset IsFoR
                </p>
                <a href="<?= BASEURL ?>/document/Pusat Riset IsFoR - narasi.docx" download
                    class="inline-flex items-center space-x-2 text-red-600 hover:text-red-700 font-medium"
                    target="_blank">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span>Download Document</span>
                </a>
            </div>
        </div>
    </div>
    <div class="document-item group">
        <div class="flex items-start space-x-8 p-8 border-2 border-gray-100 rounded-xl hover:bg-white hover:shadow-lg transition-all duration-300">
            <div class="flex-1">
                <h3 class="text-xl font-bold text-red-900 mb-3 group-hover:text-red-600 transition-colors duration-300">
                    Rekomendasi Pusat Riset IsFoR
                </h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Dokumen rekomendasi untuk Pusat Riset IsFoR
                </p>
                <a href="<?= BASEURL ?>/document/Rekom pusat riset isfor.docx" download
                    class="inline-flex items-center space-x-2 text-red-600 hover:text-red-700 font-medium"
                    target="_blank">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span>Download Document</span>
                </a>
            </div>
        </div>
    </div>
    <div class="document-item group">
        <div class="flex items-start space-x-8 p-8 border-2 border-gray-100 rounded-xl hover:bg-white hover:shadow-lg transition-all duration-300">
            <div class="flex-1">
                <h3 class="text-xl font-bold text-red-900 mb-3 group-hover:text-red-600 transition-colors duration-300">
                    Roadmap Pusat Riset IsFoR
                </h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Peta jalan pengembangan Pusat Riset IsFoR
                </p>
                <a href="<?= BASEURL ?>/document/Roadmap Pusat Riset IsFoR.pdf" download
                    class="inline-flex items-center space-x-2 text-red-600 hover:text-red-700 font-medium"
                    target="_blank">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span>Download Document</span>
                </a>
            </div>
        </div>
    </div>
    <div class="document-item group">
        <div class="flex items-start space-x-8 p-8 border-2 border-gray-100 rounded-xl hover:bg-white hover:shadow-lg transition-all duration-300">
            <div class="flex-1">
                <h3 class="text-xl font-bold text-red-900 mb-3 group-hover:text-red-600 transition-colors duration-300">
                    SK Pengangkatan Pengelola Pusat Riset IsFoR
                </h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    SK NO 556 TAHUN 2023 tentang Pengangkatan Pengelola Pusat Riset IoT for Human Life
                </p>
                <a href="<?= BASEURL ?>/document/SK NO 556 TAHUN 2023 PENGANGKATAN PENGELOLA PUSAT RISET (RESEARCH CENTER) IOT FOR HUMAN LIFE.pdf" download
                    class="inline-flex items-center space-x-2 text-red-600 hover:text-red-700 font-medium"
                    target="_blank">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span>Download Document</span>
                </a>
            </div>
        </div>
    </div>
    <div class="document-item group">
        <div class="flex items-start space-x-8 p-8 border-2 border-gray-100 rounded-xl hover:bg-white hover:shadow-lg transition-all duration-300">
            <div class="flex-1">
                <h3 class="text-xl font-bold text-red-900 mb-3 group-hover:text-red-600 transition-colors duration-300">
                    Materi Sosialisasi Pusat Riset IoT
                </h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Presentasi sosialisasi tentang Pusat Riset IoT for Human Life
                </p>
                <a href="<?= BASEURL ?>/document/Sosialisasi Pusat Riset IoT.pptx" download
                    class="inline-flex items-center space-x-2 text-red-600 hover:text-red-700 font-medium" 
                    target="_blank">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span>Download Document</span>
                </a>
            </div>
        </div>
    </div>
    <div class="document-item group">
        <div class="flex items-start space-x-8 p-8 border-2 border-gray-100 rounded-xl hover:bg-white hover:shadow-lg transition-all duration-300">
            <div class="flex-1">
                <h3 class="text-xl font-bold text-red-900 mb-3 group-hover:text-red-600 transition-colors duration-300">
                    Struktur Organisasi Pusat Riset IoT
                </h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Struktur Organisasi terbaru Pusat Riset IoT for Human Life
                </p>
                <a href="document/Struktur Organisasi Pusat Riset IoT for Human Life_Baru.docx" download
                    class="inline-flex items-center space-x-2 text-red-600 hover:text-red-700 font-medium"
                    target="_blank">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span>Download Document</span>
                </a>
            </div>
        </div>
    </div>
</div>
            <div class="text-center py-12">
                <p class="text-gray-500">Tidak ada dokumen tersedia saat ini.</p>
            </div>
        </div>
    </section>
<script>
        // Animation Observer
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('visible');
                        }, index * 100);
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.document-item').forEach(item => {
                observer.observe(item);
            });
        });

        // Search Functionality
        document.getElementById('search-bar').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('.document-item').forEach(item => {
                const title = item.querySelector('h3').textContent.toLowerCase();
                const description = item.querySelector('p').textContent.toLowerCase();
                const category = item.querySelector('.category-label').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || 
                    description.includes(searchTerm) || 
                    category.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>