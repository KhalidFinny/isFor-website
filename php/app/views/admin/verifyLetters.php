<?php 
$filteredLetters = isset($data['allLetters']) ? array_filter($data['allLetters'], function($letter) {
    return $letter['status'] == 1;
}) : [];
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Surat - IsFor</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .fade-in { animation: fadeIn 0.3s ease-out forwards; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .letter-card {
            transition: all 0.3s ease;
            border: 1px solid #fee2e2;
        }
        .letter-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgb(254 226 226 / 0.3);
            border-color: #fecaca;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        
        <div class="flex-1 ml-64">
            <main class="p-8">
                <!-- Header Section -->
                <div class="mb-8 fade-in">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Verifikasi Surat</h1>
                            <p class="text-sm text-gray-500 mt-1">Kelola dan verifikasi surat masuk</p>
                        </div>
                        <div class="flex gap-3">
                            <span class="inline-flex items-center px-3 py-1 text-sm bg-red-50 text-red-700 rounded-full">
                                <span class="w-2 h-2 mr-2 bg-red-500 rounded-full"></span>
                                <?= count($filteredLetters) ?> Surat Menunggu
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Letters Container -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <?php if (empty($filteredLetters)): ?>
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <div class="w-20 h-20 mx-auto mb-4 bg-red-50 rounded-full flex items-center justify-center">
                            <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Tidak Ada Surat</h3>
                        <p class="text-sm text-gray-500">Surat yang membutuhkan verifikasi akan muncul di sini</p>
                    </div>
                    <?php else: ?>
                    <div class="space-y-4">
                        <?php foreach ($filteredLetters as $letter): ?>
                        <div class="letter-card bg-white rounded-xl p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700">
                                            Menunggu Verifikasi
                                        </span>
                                        <span class="text-sm text-gray-500">
                                            ID: <?= str_pad($letter['letter_id'], 4, '0', STR_PAD_LEFT); ?>
                                        </span>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900"><?= $letter['title']; ?></h3>
                                    <p class="text-sm text-gray-500 mt-1">Dikirim pada <?= date('d F Y', strtotime($letter['created_at'])); ?></p>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex items-center gap-2">
                                <button onclick="viewLetter(<?= $letter['letter_id']; ?>)" 
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat Detail
                                </button>
                                <button onclick="verifyLetter(<?= $letter['letter_id']; ?>)" 
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Verifikasi
                                </button>
                                <button onclick="rejectLetter(<?= $letter['letter_id']; ?>)" 
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 bg-white border border-red-200 rounded-lg hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Tolak
                                </button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Modern Modal -->
    <div id="letterModal" class="fixed inset-0 bg-gray-900/50 hidden items-center justify-center backdrop-blur-sm z-50">
        <div class="bg-white rounded-2xl shadow-xl max-w-3xl w-full mx-4 transform transition-all">
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Detail Surat</h3>
                <button onclick="closeLetterModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 rounded-lg p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div id="letterContent" class="p-6">
                <!-- Letter content will be loaded here -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function viewLetter(id) {
            document.getElementById('letterModal').classList.remove('hidden');
            document.getElementById('letterModal').classList.add('flex');
            document.body.style.overflow = 'hidden';

            $.ajax({
                url: '<?= BASEURL ?>/letter/getLetter',
                method: 'POST',
                dataType: 'json',
                data: { id : id},
                success: function(data){
                    const letterContent = document.getElementById('letterContent');
                    letterContent.innerHTML = `
                        <iframe src="${data}" class="w-full h-[600px] rounded-lg border border-gray-100" />
                    `;
                },
                error: function(data){
                    alert('Gagal memuat surat');
                }
            });
        }

        function closeLetterModal() {
            document.getElementById('letterModal').classList.add('hidden');
            document.getElementById('letterModal').classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        function verifyLetter(id) {
            if(confirm('Apakah Anda yakin ingin memverifikasi surat ini?')) {
                updateLetterStatus(id, 2);
            }
        }

        function rejectLetter(id) {
            if(confirm('Apakah Anda yakin ingin menolak surat ini?')) {
                updateLetterStatus(id, 3);
            }
        }

        function updateLetterStatus(id, status){
            $.ajax({
                url: '<?= BASEURL ?>/letter/updateStatusLetter',
                method: 'POST',
                dataType: 'json',
                data: { id : id, status : status },
                success: function(msg){
                    location.reload();
                },
                error: function(msg){
                    alert('Gagal memperbarui status surat');
                }
            });
        }
    </script>
</body>
</html>