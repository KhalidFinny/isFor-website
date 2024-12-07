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
    <link rel="stylesheet" href="<?= ASSETS; ?>/css/animations.css">

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
        .file-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .file-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .file-card:nth-child(3) {
            animation-delay: 0.3s;
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
                    <span class="h-px w-12 bg-red-600"></span>
                    <span class="text-red-600 font-medium">Verifikasi</span>
                </div>
                <h1 class="text-4xl font-bold text-red-900">
                    Verifikasi
                </h1>
            </div>

            <!-- Images Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (empty($data['files'])): ?>
                    <div class="col-span-full text-center py-16 bg-white rounded-2xl border-2 border-red-100">
                        <p class="mt-4 text-lg text-red-900">Belum ada file yang perlu diverifikasi</p>
                        <p class="text-sm text-gray-500">Gambar yang membutuhkan verifikasi akan muncul di sini</p>
                    </div>
                <?php else: ?>
                    <!-- Loop untuk menampilkan setiap file -->
                    <?php foreach ($data['files'] as $file): ?>
                        <div class="file-card group relative bg-white border border-gray-200 rounded-lg overflow-hidden transition-all duration-300 hover:border-red-200"
                             data-file-id="<?= $file['research_output_id']; ?>">
                            <!-- Area preview file -->
                            <div class="aspect-[4/3] bg-gray-50 border-b border-gray-100">
                                <?php
                                // Deteksi tipe file berdasarkan ekstensi
                                $extension = pathinfo($file['file_url'], PATHINFO_EXTENSION);
                                $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                                ?>
                                <?php if ($isImage): ?>
                                    <!-- Preview untuk file gambar -->
                                    <img src="<?= FILES ?>/<?= $file['file_url'] ?>" alt="Preview"
                                         class="w-full h-full object-cover">
                                <?php else: ?>
                                    <!-- Ikon untuk file non-gambar -->
                                    <div class="w-full h-full flex items-center justify-center">
                                        <div class="text-center">
                                            <div class="w-16 h-16 mx-auto mb-3 bg-red-50 rounded-full flex items-center justify-center">
                                                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="1.5"
                                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                            <!-- Menampilkan ekstensi file -->
                                            <span class="text-sm font-medium text-gray-500 uppercase"><?= $extension ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <!-- Badge status file -->
                            <div class="absolute top-4 right-4">
        <span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">
            <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-2"></span>
            Menunggu Verifikasi
        </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- Kartu file dengan animasi hover -->
                <div class="file-card group relative bg-white border border-gray-200 rounded-lg overflow-hidden transition-all duration-300 hover:border-red-200"
                     data-file-id="<?= $file['research_output_id']; ?>">

                    <!-- Area preview file -->
                    <div class="aspect-[4/3] bg-gray-50 border-b border-gray-100">
                        <?php
                        // Deteksi tipe file berdasarkan ekstensi
                        $extension = pathinfo($file['file_url'], PATHINFO_EXTENSION);
                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                        ?>

                        <?php if ($isImage): ?>
                            <!-- Preview untuk file gambar -->
                            <img src="<?= FILES ?>/<?= $file['file_url'] ?>"
                                 alt="Preview"
                                 class="w-full h-full object-cover">
                        <?php else: ?>
                            <!-- Ikon untuk file non-gambar -->
                            <div class="w-full h-full flex items-center justify-center">
                                <div class="text-center">
                                    <div class="w-16 h-16 mx-auto mb-3 bg-red-50 rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <!-- Menampilkan ekstensi file -->
                                    <span class="text-sm font-medium text-gray-500 uppercase"><?= $extension ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Badge status file -->
                    <div class="absolute top-4 right-4">
                                    <span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-2"></span>
                                        Menunggu Verifikasi
                                    </span>
                    </div>

                    <!-- Image Preview Modal -->
                    <div id="imageModal"
                         class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50">
                        <div class="max-w-4xl w-full mx-4">
                            <div class="bg-white rounded-2xl overflow-hidden">
                                <div class="flex justify-between items-center p-4 border-b border-red-100">
                                    <h3 class="text-xl font-bold text-red-900">Preview Gambar</h3>
                                    <button onclick="closeImageModal()" class="text-gray-500 hover:text-gray-700">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="p-4">
                                    <img id="previewImage" src="" alt="Preview" class="max-w-full h-auto rounded-lg">
                                </div>
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
                                showCustomConfirm(function (confirm) {
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
                                        data: {id: id, status: status},
                                        success: function (msg) {
                                            // Hapus card jika berhasil
                                            setTimeout(() => {
                                                fileCard.remove();
                                                if (document.querySelectorAll('.file-card').length === 0) {
                                                    location.reload();
                                                }
                                            }, 500);
                                            showAlert('Status file berhasil diperbarui!', false);
                                        },
                                        error: function (msg) {
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
                            document.addEventListener('DOMContentLoaded', function () {
                                const cards = document.querySelectorAll('.file-card');
                                cards.forEach((card, index) => {
                                    card.style.animationDelay = `${index * 0.1}s`;
                                });
                            });
                        </script>
</body>
</html>
