<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Surat - IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .fade-in { 
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
        }
        
        .slide-up { 
            animation: slideUp 0.5s ease-out forwards;
            opacity: 0;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { 
                opacity: 0; 
                transform: translateY(20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        .letter-card {
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .letter-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -10px rgba(51, 65, 85, 0.1);
        }

        .status-badge {
            transition: all 0.3s ease;
        }

        .status-badge:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-white">
    <div class="flex">        
        <div class="flex-1 min-h-screen ml-64">
            <main class="py-10 px-8">
                <div class="max-w-7xl mx-auto">
                    <!-- Header Section -->
                    <div class="mb-8 fade-in">
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Riwayat Surat
                        </h1>
                        <p class="mt-2 text-blue-600">Kelola dan pantau status pengajuan surat Anda</p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white p-6 rounded-xl border-2 border-blue-100 slide-up" style="animation-delay: 0.1s">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-blue-600">Total Surat</p>
                                    <p class="text-2xl font-bold text-blue-900">12</p>
                                </div>
                                <div class="p-3 bg-blue-50 rounded-xl">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- Similar stats cards for Approved and Pending -->
                    </div>

                    <!-- Letter List Section -->
                    <div class="bg-white rounded-xl border-2 border-blue-100 overflow-hidden slide-up" style="animation-delay: 0.2s">
                        <!-- Filters and Search -->
                        <div class="p-6 border-b border-blue-100">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-4">
                                    <button class="px-4 py-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                        Semua
                                    </button>
                                    <button class="px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                        Disetujui
                                    </button>
                                    <button class="px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                        Tertunda
                                    </button>
                                </div>
                                <div class="relative">
                                    <input type="text" placeholder="Cari surat..." 
                                           class="pl-10 pr-4 py-2 bg-blue-50 border-0 rounded-lg text-blue-900 placeholder-blue-400
                                                  focus:ring-2 focus:ring-blue-500">
                                    <svg class="w-5 h-5 text-blue-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Letters List -->
                        <div class="p-6 space-y-4">
                            <?php if (empty($letters)) : ?>
                                <div class="text-center py-12">
                                    <svg class="w-16 h-16 text-blue-200 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <h3 class="text-xl font-medium text-blue-900 mb-2">Belum ada surat</h3>
                                    <p class="text-blue-600 mb-6">Mulai ajukan surat penelitian Anda sekarang</p>
                                    <a href="<?= BASEURL; ?>/papers/addPaperView" 
                                       class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 
                                              transition-colors">
                                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Ajukan Surat
                                    </a>
                                </div>
                            <?php else : ?>
                                <!-- Letter Cards -->
                                <?php foreach ($letters as $letter) : ?>
                                    <div class="letter-card bg-white p-6 rounded-xl border-2 border-blue-100 hover:border-blue-300">
                                        <!-- Letter content here -->
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Preview Modal -->
    <div id="previewModal" class="fixed inset-0 bg-blue-900/50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl max-w-3xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-blue-100">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-blue-900">Preview Surat</h3>
                    <button onclick="closePreview()" class="text-blue-600 hover:text-blue-800">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="p-6">
                <iframe id="pdfPreview" class="w-full h-[60vh] rounded-lg border-2 border-blue-100"></iframe>
            </div>
        </div>
    </div>

    <script>
        function previewLetter(url) {
            document.getElementById('pdfPreview').src = url;
            document.getElementById('previewModal').classList.remove('hidden');
            document.getElementById('previewModal').classList.add('flex');
        }

        function closePreview() {
            document.getElementById('previewModal').classList.add('hidden');
            document.getElementById('previewModal').classList.remove('flex');
        }

        // Animation observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.slide-up, .fade-in').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>