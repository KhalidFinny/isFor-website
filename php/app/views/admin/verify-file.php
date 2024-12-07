<?php
# =================================================================
# Halaman Verifikasi File
# =================================================================
# Menampilkan dan mengelola file yang membutuhkan verifikasi
# Mendukung preview file, download, dan aksi verifikasi
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <!-- Meta tags untuk SEO dan responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Gambar - IsFor</title>

    <!-- Font dan stylesheet eksternal -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=ASSETS;?>/css/animations.css">

    <!-- Animasi untuk kartu file -->
    <style>
        /* Animasi dasar untuk kartu dengan efek fade dan scale */
        .file-card {
            animation: scaleIn 0.5s ease-out forwards;
            opacity: 0;
        }

        /* Definisi animasi scaleIn */
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Delay bertahap untuk setiap kartu */
        .file-card:nth-child(1) { animation-delay: 0.1s; }
        .file-card:nth-child(2) { animation-delay: 0.2s; }
        .file-card:nth-child(3) { animation-delay: 0.3s; }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Layout utama dengan sidebar -->
    <div class="flex min-h-screen bg-white">
        <!-- Sidebar admin -->
        <?php include '../app/views/assets/components/AdminDashboard/sidebar.php';?>

        <!-- Konten utama -->
        <div class="flex-1 ml-64 page-content">
            <main class="p-8 max-w-[1600px] mx-auto">
                <!-- Header dengan desain Swiss -->
                <div class="max-w-7xl mx-auto mb-12 fade-in">
                    <div class="flex items-center space-x-4 mb-4">
                        <span class="h-px w-12 bg-red-600"></span>
                        <span class="text-red-600 font-medium">Files</span>
                    </div>
                    <h1 class="text-5xl font-bold text-red-900 mb-2">Verifikasi File</h1>
                </div>

                <!-- Grid untuk menampilkan file -->
                <div class="grid grid-cols-2 gap-8">
                    <?php if (empty($data['files'])): ?>
                        <!-- Tampilan saat tidak ada file -->
                        <div class="col-span-2">
                            <div class="flex flex-col items-center justify-center">
                                <!-- Ikon dengan animasi ping -->
                                <div class="w-20 h-20 border-2 border-red-200 rounded-full flex items-center justify-center mb-6 relative">
                                    <div class="absolute inset-0 border-2 border-green-200 rounded-full animate-ping opacity-100"></div>
                                    <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <!-- Pesan empty state -->
                                <h3 class="text-xl font-medium text-red-900 mb-2">Tidak Ada File</h3>
                                <p class="text-sm text-red-600">File yang membutuhkan verifikasi akan muncul di sini</p>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Loop untuk menampilkan setiap file -->
                        <?php foreach ($data['files'] as $file): ?>
                            <!-- Kartu file dengan animasi hover -->
                            <div class="file-card group relative bg-white border border-gray-200 rounded-lg overflow-hidden transition-all duration-300 hover:border-red-200"
                                 data-file-id="<?=$file['research_output_id'];?>">

                                <!-- Area preview file -->
                                <div class="aspect-[4/3] bg-gray-50 border-b border-gray-100">
                                    <?php
// Deteksi tipe file berdasarkan ekstensi
$extension = pathinfo($file['file_url'], PATHINFO_EXTENSION);
$isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
?>

                                    <?php if ($isImage): ?>
                                        <!-- Preview untuk file gambar -->
                                        <img src="<?=FILES?>/<?=$file['file_url']?>"
                                             alt="Preview"
                                             class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <!-- Ikon untuk file non-gambar -->
                                        <div class="w-full h-full flex items-center justify-center">
                                            <div class="text-center">
                                                <div class="w-16 h-16 mx-auto mb-3 bg-red-50 rounded-full flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                </div>
                                                <!-- Menampilkan ekstensi file -->
                                                <span class="text-sm font-medium text-gray-500 uppercase"><?=$extension?></span>
                                            </div>
                                        </div>
                                    <?php endif;?>
                                </div>

                                <!-- Badge status file -->
                                <div class="absolute top-4 right-4">
                                    <span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-2"></span>
                                        Menunggu Verifikasi
                                    </span>
                                </div>

                                <!-- Informasi file dan tombol aksi -->
                                <div class="p-6">
                                    <!-- ID File -->
                                    <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                        </svg>
                                        <span class="font-mono">ID: <?=str_pad($file['research_output_id'], 4, '0', STR_PAD_LEFT);?></span>
                                    </div>

                                    <!-- Judul file -->
                                    <h3 class="text-xl font-semibold text-red-900 mb-4"><?=$file['title'];?></h3>

                                    <!-- Tombol-tombol aksi -->
                                    <div class="grid grid-cols-4 gap-3">
                                        <!-- Tombol preview -->
                                        <button onclick="previewFile('<?=FILES?>/<?=$file['file_url']?>')"
                                                class="btn-hover-effect flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-all">
                                            Preview
                                        </button>
                                        <!-- Tombol download -->
                                        <a href="<?=FILES?>/<?=$file['file_url']?>"
                                           download="<?=$file['original_name']?>"
                                           class="btn-hover-effect flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-all">
                                            Download
                                        </a>
                                        <!-- Tombol verifikasi -->
                                        <button onclick="verifyFile(<?=$file['research_output_id'];?>)"
                                                class="btn-hover-effect flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-all col-span-2">
                                            Verifikasi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    <?php endif;?>
                </div>
            </main>
        </div>
    </div>

    <!-- Script untuk interaktivitas -->
    <script>
        /**
         * Membuka file dalam tab baru untuk preview
         * @param {string} url - URL file yang akan ditampilkan
         */
        function previewFile(url) {
            window.open(url, '_blank');
        }

        /**
         * Menampilkan konfirmasi sebelum verifikasi file
         * @param {number} id - ID file yang akan diverifikasi
         */
        function verifyFile(id) {
            showCustomConfirm(function(confirm) {
                if (confirm) {
                    updateFileStatus(id, 2);
                }
            });
        }

        /**
         * Menampilkan alert notifikasi
         * @param {string} message - Pesan yang akan ditampilkan
         * @param {boolean} isError - Status error (true) atau success (false)
         */
        function showAlert(message, isError = false) {
            const alertBox = document.getElementById('alert');
            const alertDiv = alertBox.querySelector('div');
            const alertMessage = document.getElementById('alertMessage');
            const alertIcon = document.getElementById('alertIcon');
            const alertTitle = alertBox.querySelector('.alert-title');

            // Reset kelas alert
            alertDiv.className = 'flex items-center p-4 min-w-[320px] rounded-xl shadow-lg border-l-4';

            // Atur tampilan berdasarkan tipe alert
            if (isError) {
                alertDiv.classList.add('alert-error');
                alertTitle.textContent = 'Error';
                alertIcon.innerHTML = `<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>`;
            } else {
                alertDiv.classList.add('alert-success');
                alertTitle.textContent = 'Success';
                alertIcon.innerHTML = `<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>`;
            }

            alertMessage.textContent = message;

            // Tampilkan alert dengan animasi
            alertBox.style.display = 'block';
            setTimeout(() => {
                alertBox.style.transform = 'translateY(0)';
                alertBox.style.opacity = '1';
            }, 10);

            // Auto-hide setelah 3 detik
            setTimeout(closeAlert, 3000);
        }

        /**
         * Menutup alert dengan animasi
         */
        function closeAlert() {
            const alertBox = document.getElementById('alert');
            alertBox.style.transform = 'translateY(-100%)';
            alertBox.style.opacity = '0';
            setTimeout(() => {
                alertBox.style.display = 'none';
            }, 300);
        }

        /**
         * Mengupdate status file dengan animasi
         * @param {number} id - ID file yang akan diupdate
         * @param {number} status - Status baru (2 = terverifikasi)
         */
        function updateFileStatus(id, status) {
            const fileCard = document.querySelector(`[data-file-id="${id}"]`);

            // Animasi slide out
            fileCard.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
            fileCard.style.transform = 'translateX(50px)';
            fileCard.style.opacity = '0';

            // Kirim request update
            setTimeout(() => {
                $.ajax({
                    url: '<?=BASEURL?>/researchoutput/updateStatusFile',
                    method: 'POST',
                    dataType: 'json',
                    data: { id: id, status: status },
                    success: function(msg) {
                        // Hapus card jika berhasil
                        setTimeout(() => {
                            fileCard.remove();
                            if (document.querySelectorAll('.file-card').length === 0) {
                                location.reload();
                            }
                        }, 500);
                        showAlert('Status file berhasil diperbarui!', false);
                    },
                    error: function(msg) {
                        // Kembalikan posisi card jika gagal
                        fileCard.style.transform = 'translateX(0)';
                        fileCard.style.opacity = '1';
                        showAlert('Gagal memperbarui status file', true);
                    }
                });
            }, 10);
        }

        /**
         * Menambahkan animasi stagger pada kartu file
         */
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.file-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>

</rewritten_file>
```
</```rewritten_file>