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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ASSETS; ?>/css/animations.css">
    <style>
        .letter-card {
            animation: slideIn 0.5s ease-out forwards;
            opacity: 0;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex">
        <?php include '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>
        <div class="flex-1 min-h-screen ml-64">
            <main class="py-10 px-8">
                <!-- Header -->
                <div class="max-w-7xl mx-auto mb-12">
                    <div class="flex items-center space-x-4 mb-4">
                        <span class="h-px w-12 bg-blue-600"></span>
                        <span class="text-blue-600 font-medium">Verifikasi</span>
                    </div>
                    <h1 class="text-4xl font-bold text-blue-900">
                        Verifikasi
                        <span class="relative inline-block">
                            <span class="absolute -bottom-2 left-0 w-full h-4 bg-blue-100 -z-10"></span>
                            <span>Surat</span>
                        </span>
                    </h1>
                </div>

                <!-- Letters Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php if (empty($filteredLetters)): ?>
                    <!-- Empty State -->
                    <div class="col-span-full text-center py-16 bg-white rounded-2xl border-2 border-blue-100">
                        <img src="<?= ASSETS; ?>/images/empty-letters.png" alt="No Letters" class="mx-auto h-40 animate-bounce">
                        <p class="mt-4 text-lg text-blue-900">Belum ada surat yang perlu diverifikasi</p>
                        <p class="text-sm text-gray-500">Surat yang membutuhkan verifikasi akan muncul di sini</p>
                    </div>
                    <?php else: ?>
                    <!-- Letter Cards -->
                    <?php foreach ($filteredLetters as $letter): ?>
                    <div class="letter-card bg-white rounded-2xl border-2 border-blue-100 overflow-hidden" style="animation-delay: <?php echo $index * 0.1; ?>s">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <span class="px-3 py-1 bg-yellow-50 text-yellow-700 rounded-full text-sm font-medium">
                                    Menunggu Verifikasi
                                </span>
                                <!-- <span class="text-sm text-gray-500"><?php echo $letter['date']; ?></span> -->
                            </div>
                            <h3 class="text-lg font-semibold text-blue-900 mb-2"><?= $letter['title']; ?></h3>
                            <!-- <p class="text-gray-600 text-sm mb-4"><?php echo $letter['description']; ?></p> -->
                            <!-- Action Buttons -->
                            <div class="flex space-x-3">
                                <button onclick="viewLetter(<?= $letter['letter_id']; ?>)" 
                                        class="flex-1 px-4 py-2 bg-blue-50 text-blue-700 rounded-xl hover:bg-blue-100 transition-colors">
                                    Lihat Detail
                                </button>
                                <button onclick="verifyLetter(<?= $letter['letter_id']; ?>)" 
                                        class="flex-1 px-4 py-2 bg-green-50 text-green-700 rounded-xl hover:bg-green-100 transition-colors">
                                    Verifikasi
                                </button>
                                <button onclick="rejectLetter(<?= $letter['letter_id']; ?>)" 
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

    <!-- View Letter Modal -->
    <div id="letterModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl p-8 max-w-2xl w-full mx-4">
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
    <!-- Pastikan jQuery dimuat -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html> 