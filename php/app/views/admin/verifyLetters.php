<?php 
$filteredLetters = array_filter($data['allLetters'], function($letter) {
    return $letter['status'] == 1;
});
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
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }
        .letter-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        .letter-card:hover {
            border-left-color: #ef4444;
            transform: translateX(4px);
        }
        .status-badge {
            position: relative;
            overflow: hidden;
        }
        .status-badge::before {
            content: '';
            position: absolute;
            left: -2px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 60%;
            background-color: currentColor;
            border-radius: 2px;
        }
    </style>
</head>
<body class="bg-white">
    <div class="flex">
        <?php include '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>
        <div class="flex-1 min-h-screen ml-64">
            <main class="py-10 px-8">
                <!-- Header -->
                <div class="max-w-7xl mx-auto mb-12 fade-in">
                    <div class="flex items-center space-x-4 mb-4">
                        <span class="h-px w-12 bg-red-600"></span>
                        <span class="text-red-600 font-medium">Verifikasi</span>
                    </div>
                    <h1 class="text-5xl font-bold text-red-900 mb-2">Verifikasi Surat</h1>
                    <p class="text-gray-500">Kelola dan verifikasi surat masuk</p>
                </div>

                <!-- Letters Grid -->
                <div class="max-w-7xl mx-auto">
                    <?php if (empty($filteredLetters)): ?>
                    <!-- Empty State -->
                    <div class="text-center py-32 bg-white rounded-2xl border-2 border-red-100 fade-in">
                        <div class="max-w-md mx-auto">
                            <svg class="w-16 h-16 mx-auto mb-6 text-red-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-2xl font-bold text-red-900 mb-2">Tidak Ada Surat</p>
                            <p class="text-gray-500">Surat yang membutuhkan verifikasi akan muncul di sini</p>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="space-y-6">
                        <?php foreach ($filteredLetters as $index => $letter): ?>
                        <div class="letter-card bg-white rounded-2xl border-2 border-red-100 p-8 fade-in" style="animation-delay: <?php echo $index * 0.1; ?>s">
                            <div class="flex items-start justify-between mb-8">
                                <div>
                                    <span class="status-badge inline-flex items-center px-4 py-1.5 rounded-full text-yellow-600 bg-yellow-50 text-sm font-medium mb-4">
                                        Menunggu Verifikasi
                                    </span>
                                    <h3 class="text-2xl font-bold text-red-900 mb-2"><?= $letter['title']; ?></h3>
                                    <p class="text-gray-500 text-sm">
                                        ID Surat: <?= str_pad($letter['letter_id'], 4, '0', STR_PAD_LEFT); ?>
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex items-center gap-4">
                                <button onclick="viewLetter(<?= $letter['letter_id']; ?>)" 
                                        class="flex-1 px-6 py-3 bg-white border-2 border-red-100 text-red-900 rounded-xl hover:bg-red-50 transition-colors text-sm font-medium">
                                    Lihat Detail
                                </button>
                                <button onclick="verifyLetter(<?= $letter['letter_id']; ?>)" 
                                        class="flex-1 px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors text-sm font-medium">
                                    Verifikasi
                                </button>
                                <button onclick="rejectLetter(<?= $letter['letter_id']; ?>)" 
                                        class="flex-1 px-6 py-3 border-2 border-red-200 text-red-600 rounded-xl hover:bg-red-50 transition-colors text-sm font-medium">
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

    <!-- View Letter Modal -->
    <div id="letterModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center backdrop-blur-sm">
        <div class="bg-white rounded-2xl border-2 border-red-100 p-8 max-w-2xl w-full mx-4 fade-in">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-bold text-red-900">Detail Surat</h3>
                <button onclick="closeLetterModal()" class="text-gray-400 hover:text-red-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="letterContent" class="rounded-xl overflow-hidden border-2 border-red-100">
                <!-- Letter content will be loaded here -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function viewLetter(id) {
            // Implementation for viewing letter
            document.getElementById('letterModal').classList.remove('hidden');
            document.getElementById('letterModal').classList.add('flex');

            $.ajax({
                url: '<?= BASEURL ?>/letter/getLetter',
                method: 'POST',
                dataType: 'json',
                data: { id : id},
                success: function(data){
                    console.log(data);
                    // Implementation for viewing letter
                    const letterContent = document.getElementById('letterContent');
                    letterContent.innerHTML = `
                        <iframe src="${data}" width="100%" height="500px"></iframe>
                    `;
                },
                error: function(data){
                    alert('Gagal');
                }
            });
        }

        function closeLetterModal() {
            document.getElementById('letterModal').classList.add('hidden');
            document.getElementById('letterModal').classList.remove('flex');
        }

        function verifyLetter(id) {
            // Implementation for verifying letter
            updateLetterStatus(id, 2);
        }

        function rejectLetter(id) {
            // Implementation for rejecting letter
            updateLetterStatus(id, 3);
        }

        function updateLetterStatus(id, status){
            $.ajax({
                url: '<?= BASEURL ?>/letter/updateStatusLetter',
                method: 'POST',
                dataType: 'json',
                data: { id : id, status : status },
                success: function(msg){
                    console.log(msg);
                    location.reload();
                },
                error: function(msg){
                    alert('Gagal memperbarui status');
                }
            });
        }
    </script>
</body>
</html> 