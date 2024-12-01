<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Surat - IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/IsFor-website/php/app/views/assets/css/inandout.css">
    <script src="http://localhost/IsFor-website/php/app/views/assets/js/animations.js" defer></script>
</head>
<body class="bg-gray-50">
    <div class="flex fade-in">
        <?php include '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>
        <div class="flex-1 min-h-screen ml-64">
            <main class="py-10 px-8 slide-up">
                <!-- Header -->
                <div class="max-w-7xl mx-auto mb-12 slide-in-right">
                    <div class="flex items-center space-x-4 mb-4">
                        <span class="h-px w-12 bg-blue-600"></span>
                        <span class="text-blue-600 font-medium">Verifikasi</span>
                    </div>
                    <h1 class="text-4xl font-bold text-blue-900">
                        Verifikasi Surat
                    </h1>
                </div>

                <!-- Letters Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 stagger-children">
                    <?php if (empty($letters)): ?>
                        <div class="col-span-full text-center py-16 bg-white rounded-2xl border-2 border-blue-100 fade-in">
                            <p class="mt-4 text-lg text-blue-900">Belum ada surat yang perlu diverifikasi</p>
                            <p class="text-sm text-gray-500">Surat yang membutuhkan verifikasi akan muncul di sini</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($letters as $index => $letter): ?>
                        <div class="stagger-item scale-in bg-white rounded-2xl border-2 border-blue-100 overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="px-3 py-1 bg-yellow-50 text-yellow-700 rounded-full text-sm font-medium">
                                        Menunggu Verifikasi
                                    </span>
                                    <span class="text-sm text-gray-500"><?php echo $letter['date']; ?></span>
                                </div>
                                <h3 class="text-lg font-semibold text-blue-900 mb-2"><?php echo $letter['title']; ?></h3>
                                <p class="text-gray-600 text-sm mb-4"><?php echo $letter['description']; ?></p>
                                <!-- Action Buttons -->
                                <div class="flex space-x-3">
                                    <button onclick="viewLetter(<?php echo $letter['id']; ?>)" 
                                            class="flex-1 px-4 py-2 bg-blue-50 text-blue-700 rounded-xl hover:bg-blue-100 transition-colors">
                                        Lihat Detail
                                    </button>
                                    <button onclick="verifyLetter(<?php echo $letter['id']; ?>)" 
                                            class="flex-1 px-4 py-2 bg-green-50 text-green-700 rounded-xl hover:bg-green-100 transition-colors">
                                        Verifikasi
                                    </button>
                                    <button onclick="rejectLetter(<?php echo $letter['id']; ?>)" 
                                            class="flex-1 px-4 py-2 bg-red-50 text-red-700 rounded-xl hover:bg-red-100 transition-colors">
                                        Tolak
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Letter Modal -->
    <div id="letterModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl p-8 max-w-2xl w-full mx-4 scale-in">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-blue-900">Detail Surat</h3>
                <button onclick="closeLetterModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="letterContent">
                <!-- Letter content will be loaded here -->
            </div>
        </div>
    </div>

    <script>
        function viewLetter(id) {
            const modal = document.getElementById('letterModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex', 'fade-in');
            modal.querySelector('.max-w-2xl').classList.add('scale-in');
        }

        function closeLetterModal() {
            const modal = document.getElementById('letterModal');
            modal.classList.add('fade-out');
            modal.querySelector('.max-w-2xl').classList.add('scale-out');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex', 'fade-out');
                modal.querySelector('.max-w-2xl').classList.remove('scale-out');
            }, 300);
        }

        function verifyLetter(id) {
            // Implementation for verifying letter
        }

        function rejectLetter(id) {
            // Implementation for rejecting letter
        }
    </script>
</body>
</html> 