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
    <title>Verifikasi Surat</title>
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
    <?php include '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>
        <div class="flex-1 ml-64">
            <main class="p-8">
                <!-- Header Section -->
                <div class="max-w-7xl mx-auto mb-12 fade-in">
                    <div class="flex items-center space-x-4 mb-4">
                        <span class="h-px w-12 bg-red-600"></span>
                        <span class="text-red-600 font-medium">Verifikasi</span>
                    </div>
                    <h1 class="text-5xl font-bold text-red-900 mb-2">Verifikasi Surat</h1>
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
                                    <h3 class="text-lg font-semibold text-red-700"><?= $letter['title']; ?></h3>
                                    <!-- <p class="text-sm text-gray-500 mt-1">Dikirim pada <?= date('d F Y', strtotime($letter['date'])); ?></p> -->
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

    <div id="alert" class="fixed top-4 right-4 hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline" id="alertMessage">Something went wrong.</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" onclick="closeAlert()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z"/>
            </svg>
        </span>
    </div>

    <!-- Custom Confirm Modal -->
    <div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white rounded-2xl p-6 w-80 mx-4 fade-in relative transform transition-transform duration-300 scale-95">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-red-800">Konfirmasi</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-red-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <p class="text-sm text-gray-500 mb-6">Apakah Anda yakin ingin melanjutkan tindakan ini?</p>
            <div class="flex justify-end gap-3">
                <button id="cancelButton" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">Batal</button>
                <button id="confirmButton" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">Ya, Lanjutkan</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function viewLetter(id) {
            $.ajax({
                url: '<?= BASEURL ?>/letter/getLetter',
                method: 'POST',
                dataType: 'json',
                data: { id : id},
                success: function(data){
                    window.open(data, '_blank');
                },
                error: function(data){
                    alert('Gagal memuat surat');
                }
            });
        }

        function showCustomConfirm(callback) {
            const modal = document.getElementById('confirmModal');
            modal.classList.remove('hidden');
            modal.querySelector('.fade-in').classList.add('scale-100');

            const confirmButton = document.getElementById('confirmButton');
            const cancelButton = document.getElementById('cancelButton');

            confirmButton.onclick = function() {
                closeModal();
                callback(true);
            };

            cancelButton.onclick = function() {
                closeModal();
                callback(false);
            };
        }

        function closeModal() {
            const modal = document.getElementById('confirmModal');
            modal.querySelector('.fade-in').classList.remove('scale-100');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        function verifyLetter(id) {
            showCustomConfirm(function(confirm) {
                if (confirm) {
                    updateLetterStatus(id, 2);
                }
            });
        }

        function rejectLetter(id) {
            showCustomConfirm(function(confirm) {
                if (confirm) {
                    updateLetterStatus(id, 3);
                }
            });
        }

        function showAlert(message, isError = true) {
            const alertBox = document.getElementById('alert');
            const alertMessage = document.getElementById('alertMessage');
            alertMessage.textContent = message;
            alertBox.classList.remove('hidden');
            alertBox.classList.toggle('bg-red-100', isError);
            alertBox.classList.toggle('bg-green-100', !isError);
            alertBox.classList.toggle('border-red-400', isError);
            alertBox.classList.toggle('border-green-400', !isError);
            alertBox.classList.toggle('text-red-700', isError);
            alertBox.classList.toggle('text-green-700', !isError);
        }

        function closeAlert() {
            document.getElementById('alert').classList.add('hidden');
        }

        function updateLetterStatus(id, status){
            $.ajax({
                url: '<?= BASEURL ?>/letter/updateStatusLetter',
                method: 'POST',
                dataType: 'json',
                data: { id : id, status : status },
                success: function(msg){
                    showAlert('Status surat berhasil diperbarui!', false);
                    setTimeout(() => location.reload(), 2000);
                },
                error: function(msg){
                    showAlert('Gagal memperbarui status surat');
                }
            });
        }
    </script>
</body>
</html>