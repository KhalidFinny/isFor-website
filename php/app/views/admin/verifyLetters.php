<?php
$filteredLetters = isset($data['allLetters']) ? array_filter($data['allLetters'], function ($letter) {
    return $letter['status'] == 1;
}) : [];
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Surat - IsFor</title>
    <link rel="stylesheet" href="<?= CSS; ?>/admin/verify-letters.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Mobile responsive adjustments */
        @media (max-width: 768px) {
            .page-content {
                margin-left: 0 !important;
                padding: 1rem;
            }
            
            .letter-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .letter-card {
                padding: 1rem;
            }
            
            .letter-card h3 {
                font-size: 1.125rem;
            }
            
            .action-buttons {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }
            
            .action-buttons button {
                padding: 0.5rem;
                font-size: 0.875rem;
            }
            
            .modal-content {
                width: 90%;
                padding: 1rem;
            }
            
            .empty-state {
                height: 300px;
            }
            
            .empty-state h3 {
                font-size: 1.125rem;
            }
            
            .alert {
                max-width: 90%;
                right: 1rem;
            }
        }
        
        /* Desktop styles */
        @media (min-width: 769px) {
            .page-content {
                margin-left: 16rem;
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
<!-- Layout utama dengan sidebar -->
<div class="flex min-h-screen bg-white">
    <!-- Sidebar admin -->
    <?php include '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>

    <!-- Konten utama -->
    <div class="flex-1 page-content">
        <main class="max-w-[1600px] mx-auto">
            <div class="mb-8 md:mb-12">
                <a href="<?= BASEURL ?>/dashboardAdmin"
                   class="inline-flex items-center space-x-2 text-red-500 hover:text-red-600 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Kembali</span>
                </a>
            </div>
            <!-- Header dengan desain Swiss -->
            <div class="mb-8 md:mb-12 fade-in">
                <div class="flex items-center space-x-4 mb-4">
                    <span class="h-px w-12 bg-red-600"></span>
                    <span class="text-red-600 font-medium">Letters</span>
                </div>
                <h1 class="text-3xl md:text-5xl font-bold text-red-900 mb-2">Verifikasi Surat</h1>
            </div>

            <!-- Grid untuk menampilkan surat -->
            <div class="letter-grid grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
                <?php if (empty($filteredLetters)): ?>
                    <!-- Tampilan saat tidak ada surat -->
                    <div class="col-span-2">
                        <div class="empty-state flex flex-col items-center justify-center h-[300px] md:h-[400px]">
                            <!-- Ikon dengan animasi ping -->
                            <div class="w-16 h-16 md:w-20 md:h-20 border-2 border-red-200 rounded-full flex items-center justify-center mb-4 md:mb-6 relative">
                                <div class="absolute inset-0 border-2 border-green-200 rounded-full animate-ping opacity-100"></div>
                                <svg class="w-8 h-8 md:w-10 md:h-10 text-red-500" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <!-- Pesan empty state -->
                            <h3 class="text-lg md:text-xl font-medium text-red-900 mb-2">Tidak Ada Surat</h3>
                            <p class="text-xs md:text-sm text-red-600">Surat yang membutuhkan verifikasi akan muncul di sini</p>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Loop untuk menampilkan setiap surat -->
                    <?php foreach ($filteredLetters as $letter): ?>
                        <!-- Kartu surat dengan animasi hover -->
                        <div class="letter-card group relative bg-white border border-gray-200 rounded-lg p-4 md:p-6 transition-all duration-300 hover:border-red-200"
                             data-letter-id="<?= $letter['letter_id']; ?>">

                            <!-- Badge status surat -->
                            <div class="absolute -top-2 right-2 md:right-6">
                                <span class="status-badge inline-flex items-center px-2 py-0.5 md:px-3 md:py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1 md:mr-2"></span>
                                    Menunggu Verifikasi
                                </span>
                            </div>

                            <!-- Informasi surat -->
                            <div class="mb-6 md:mb-8">
                                <!-- ID Surat -->
                                <div class="flex items-center gap-2 text-xs md:text-sm text-gray-500 mb-2 md:mb-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                    </svg>
                                    <span class="font-mono">ID Surat: <?= str_pad($letter['letter_id'], 4, '0', STR_PAD_LEFT); ?></span>
                                </div>
                                <!-- Nama Pengguna -->
                                <p class="text-xs md:text-sm text-gray-600 mb-1">
                                    <strong>Pengirim:</strong> <?= $letter['name']; ?>
                                </p>
                                <!-- Judul surat -->
                                <h3 class="text-lg md:text-xl font-semibold text-red-900"><?= $letter['title']; ?></h3>
                            </div>

                            <!-- Tombol-tombol aksi -->
                            <div class="action-buttons grid grid-cols-1 md:grid-cols-3 gap-2 md:gap-3">
                                <!-- Tombol detail -->
                                <button onclick="viewLetter(<?= $letter['letter_id']; ?>)"
                                        class="btn-hover-effect flex items-center justify-center px-3 py-1.5 md:px-4 md:py-2.5 text-xs md:text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-all">
                                    Detail
                                </button>
                                <!-- Tombol verifikasi -->
                                <button onclick="verifyLetter(<?= $letter['letter_id']; ?>)"
                                        class="btn-hover-effect flex items-center justify-center px-3 py-1.5 md:px-4 md:py-2.5 text-xs md:text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-all">
                                    Verifikasi
                                </button>
                                <!-- Tombol tolak -->
                                <button onclick="rejectLetter(<?= $letter['letter_id']; ?>)"
                                        class="btn-hover-effect flex items-center justify-center px-3 py-1.5 md:px-4 md:py-2.5 text-xs md:text-sm font-medium text-red-600 bg-white border border-red-200 rounded-lg hover:bg-red-50 transition-all">
                                    Tolak
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <!-- Pagination -->
            <?php if ($data['totalPages'] > 1): ?>
                <nav aria-label="Page navigation" class="mt-6 md:mt-10">
                    <ul class="inline-flex items-center space-x-1 md:space-x-2">
                        <!-- Nomor Halaman -->
                        <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                            <li>
                                <a href="?page=<?= $i; ?>"
                                   class="flex items-center justify-center w-7 h-7 md:w-9 md:h-9 <?= $i == $data['currentPage'] ? 'border border-red-500 text-red-400' : 'text-red-400 border duration-300 hover:border-red-300' ?> rounded-md">
                                    <?= $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                </nav>
            <?php endif; ?>
        </main>
    </div>
</div>

<!-- Modal konfirmasi -->
<div id="confirmModal"
     class="fixed inset-0 flex items-center justify-center bg-black/30 backdrop-blur-sm opacity-0 invisible transition-all duration-300 z-50">
    <div class="modal-content bg-white rounded-xl md:rounded-3xl p-4 md:p-8 w-full max-w-xs md:max-w-[420px] mx-2 md:mx-4 shadow-2xl transform translate-y-8 transition-all duration-300">
        <!-- Elemen dekoratif atas -->
        <div class="absolute -top-1 left-4 md:left-8 right-4 md:right-8 h-1 md:h-2 bg-gradient-to-r from-red-500/20 via-red-500 to-red-500/20 rounded-full blur-sm"></div>

        <!-- Konten modal -->
        <div class="relative">
            <!-- Header modal -->
            <div class="flex items-start justify-between mb-4 md:mb-6">
                <div class="flex items-center space-x-2 md:space-x-3">
                    <div class="w-1 h-4 md:h-6 bg-gradient-to-b from-red-600 to-red-400 rounded-full"></div>
                    <h3 class="text-xl md:text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-red-600 to-red-500">
                        Konfirmasi
                    </h3>
                </div>
                <!-- Tombol tutup -->
                <button onclick="closeModal()"
                        class="text-gray-400 hover:text-red-600 transition-colors duration-300 transform hover:rotate-90">
                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Pesan konfirmasi -->
            <div class="mb-3 md:mb-4">
                <p class="text-sm md:text-base text-gray-600">Apakah Anda yakin ingin melanjutkan?</p>
            </div>

            <!-- Comment Section -->
            <div class="mb-4 md:mb-6">
                <label for="comment" class="block text-xs md:text-sm font-medium text-gray-700 mb-1 md:mb-2">Komentar:</label>
                <textarea id="comment" rows="3" class="w-full p-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>
            </div>

            <div class="flex justify-end items-center gap-2 md:gap-3">
                <button id="cancelButton"
                        class="px-4 py-1.5 md:px-6 md:py-2.5 text-xs md:text-sm font-medium text-gray-600 hover:text-gray-800 bg-gray-100/80 hover:bg-gray-100 rounded-lg md:rounded-xl transition-all duration-300">
                    Batal
                </button>
                <button id="confirmButton"
                        class="group relative px-4 py-1.5 md:px-6 md:py-2.5 text-xs md:text-sm font-medium text-white bg-gradient-to-r from-red-600 to-red-500 rounded-lg md:rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-red-500/30 hover:-translate-y-0.5">
                    <span class="relative z-10">Ya, Lanjutkan</span>
                    <div class="absolute inset-0 rounded-lg md:rounded-xl bg-gradient-to-r from-red-600 to-red-500 opacity-0 group-hover:opacity-100 blur transition-all duration-300 -z-10"></div>
                </button>
            </div>
        </div>

        <!-- Elemen dekoratif bawah -->
        <div class="absolute -bottom-1 left-4 md:left-8 right-4 md:right-8 h-1 md:h-2 bg-gradient-to-r from-red-500/20 via-red-500 to-red-500/20 rounded-full blur-sm"></div>
    </div>
</div>

<!-- Komponen alert -->
<div id="alert" class="fixed top-2 md:top-4 right-2 md:right-4 transform translate-y-[-100%] opacity-0 transition-all duration-300 z-50"
     role="alert">
    <div class="flex items-center p-3 md:p-4 min-w-[250px] md:min-w-[320px] rounded-lg md:rounded-xl shadow-lg border-l-4 alert-style">
        <div class="flex-shrink-0 w-6 h-6 md:w-8 md:h-8 flex items-center justify-center rounded-lg alert-icon-style mr-2 md:mr-3">
            <svg id="alertIcon" class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 20 20"></svg>
        </div>
        <div class="flex-1 mr-1 md:mr-2">
            <h3 class="text-xs md:text-sm font-medium alert-title">Notification</h3>
            <p class="text-xs md:text-sm alert-message" id="alertMessage">Message here</p>
        </div>
        <button onclick="closeAlert()" class="flex-shrink-0 ml-2 md:ml-4">
            <svg class="w-3 h-3 md:w-4 md:h-4 text-gray-500 hover:text-gray-700" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>

<script>
    function viewLetter(id) {
        $.ajax({
            url: '<?= BASEURL ?>/letter/getLetter',
            method: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function (data) {
                window.open(data, '_blank');
            },
            error: function (data) {
                showAlert('error', 'Gagal', 'Gagal memuat surat');
            }
        });
    }

    let currentAction, currentId, currentStatus;

    function openModal(id, status, action) {
        currentId = id;
        currentStatus = status;
        currentAction = action;

        const actionMessage = action === "verifikasi" ?
            "memverifikasi surat dengan ID " :
            "menolak surat dengan ID ";

        // Perbarui pesan modal
        $('#confirmModal p').text("Apakah Anda yakin ingin " + actionMessage + id + "?");
        $('#confirmModal').removeClass('opacity-0 invisible').addClass('opacity-100 visible');
    }

    function closeModal() {
        $('#confirmModal').removeClass('opacity-100 visible').addClass('opacity-0 invisible');
        $('#comment').val(''); // Clear the comment field
    }

    $('#confirmButton').on('click', function () {
        const comment = $('#comment').val().trim(); // Get the comment from the textarea and trim whitespace

        // Validasi jika komentar kosong
        if (!comment) {
            showAlert('error', 'Komentar tidak boleh kosong!', 'Silakan isi komentar terlebih dahulu.');
            return; // Hentikan eksekusi jika komentar kosong
        }

        // Lakukan AJAX setelah validasi berhasil
        $.ajax({
            url: '<?= BASEURL ?>/letter/updateStatusLetter',
            method: 'POST',
            dataType: 'json',
            data: {id: currentId, status: currentStatus, comment: comment}, // Include the comment in the data
            success: function () {
                closeModal();
                showAlert('success', 'Berhasil', `Surat berhasil ${currentAction}`);
                location.reload();
            },
            error: function () {
                closeModal();
                showAlert('error', 'Gagal', 'Gagal memperbarui status');
            }
        });
    });

    $('#cancelButton').on('click', closeModal);

    function showAlert(type, title, message) {
        const alertStyles = {
            success: {
                style: 'bg-green-500 text-white border-green-600',
                icon: '<path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>'
            },
            error: {
                style: 'bg-red-500 text-white border-red-600',
                icon: '<path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>'
            }
        };

        $('#alert')
            .removeClass()
            .addClass(`fixed top-2 md:top-4 right-2 md:right-4 translate-y-0 opacity-100 transition-all duration-300 z-50 alert-style ${alertStyles[type].style}`);
        $('#alertIcon').html(alertStyles[type].icon);
        $('.alert-title').text(title);
        $('#alertMessage').text(message);

        setTimeout(closeAlert, 3000);
    }

    function closeAlert() {
        $('#alert').removeClass('translate-y-0 opacity-100').addClass('translate-y-[-100%] opacity-0');
    }

    // Integrasikan ke tombol verifikasi dan penolakan
    function verifyLetter(id) {
        openModal(id, 2, "verifikasi");
    }

    function rejectLetter(id) {
        openModal(id, 3, "tolak");
    }

    $(document).ready(function () {
        $('.letter-card').each(function (index) {
            $(this).css('animation-delay', `${index * 0.1}s`);
        });
    });
</script>
</body>
</html>