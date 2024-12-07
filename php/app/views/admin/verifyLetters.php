<?php
/**
 * Halaman Verifikasi Surat
 * ------------------------------
 * Menampilkan dan mengelola surat yang membutuhkan verifikasi
 * Mendukung preview surat, verifikasi, dan penolakan
 */

// Filter surat yang belum diverifikasi (status = 1)
$filteredLetters = isset($data['allLetters']) ? array_filter($data['allLetters'], function($letter) {
    return $letter['status'] == 1;
}) : [];
?>

<!-- Layout utama dengan sidebar -->
<div class="flex min-h-screen bg-white">
    <!-- Sidebar admin -->
    <?php include '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>
    
    <!-- Konten utama -->
    <div class="flex-1 ml-64 page-content">
        <main class="p-8 max-w-[1600px] mx-auto">
            <!-- Header dengan desain Swiss -->
            <div class="max-w-7xl mx-auto mb-12 fade-in">
                <div class="flex items-center space-x-4 mb-4">
                    <span class="h-px w-12 bg-red-600"></span>
                    <span class="text-red-600 font-medium">Letters</span>
                </div>
                <h1 class="text-5xl font-bold text-red-900 mb-2">Verifikasi Surat</h1>
            </div>

            <!-- Grid untuk menampilkan surat -->
            <div class="grid grid-cols-2 gap-8">
                <?php if (empty($filteredLetters)): ?>
                    <!-- Tampilan saat tidak ada surat -->
                    <div class="col-span-2">
                        <div class="flex flex-col items-center justify-center h-[400px]">
                            <!-- Ikon dengan animasi ping -->
                            <div class="w-20 h-20 border-2 border-red-200 rounded-full flex items-center justify-center mb-6 relative">
                                <div class="absolute inset-0 border-2 border-green-200 rounded-full animate-ping opacity-100"></div>
                                <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <!-- Pesan empty state -->
                            <h3 class="text-xl font-medium text-red-900 mb-2">Tidak Ada Surat</h3>
                            <p class="text-sm text-red-600">Surat yang membutuhkan verifikasi akan muncul di sini</p>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Loop untuk menampilkan setiap surat -->
                    <?php foreach ($filteredLetters as $letter): ?>
                        <!-- Kartu surat dengan animasi hover -->
                        <div class="letter-card group relative bg-white border border-gray-200 rounded-lg p-6 transition-all duration-300 hover:border-red-200"
                             data-letter-id="<?= $letter['letter_id']; ?>">
                            
                            <!-- Badge status surat -->
                            <div class="absolute -top-2.5 right-6">
                                <span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-2"></span>
                                    Menunggu Verifikasi
                                </span>
                            </div>

                            <!-- Informasi surat -->
                            <div class="mb-8">
                                <!-- ID Surat -->
                                <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                    </svg>
                                    <span class="font-mono">ID: <?= str_pad($letter['letter_id'], 4, '0', STR_PAD_LEFT); ?></span>
                                </div>
                                <!-- Judul surat -->
                                <h3 class="text-xl font-semibold text-red-900"><?= $letter['title']; ?></h3>
                            </div>

                            <!-- Tombol-tombol aksi -->
                            <div class="grid grid-cols-3 gap-3">
                                <!-- Tombol detail -->
                                <button onclick="viewLetter(<?= $letter['letter_id']; ?>)"
                                        class="btn-hover-effect flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-all">
                                    Detail
                                </button>
                                <!-- Tombol verifikasi -->
                                <button onclick="verifyLetter(<?= $letter['letter_id']; ?>)"
                                        class="btn-hover-effect flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-all">
                                    Verifikasi
                                </button>
                                <!-- Tombol tolak -->
                                <button onclick="rejectLetter(<?= $letter['letter_id']; ?>)"
                                        class="btn-hover-effect flex items-center justify-center px-4 py-2.5 text-sm font-medium text-red-600 bg-white border border-red-200 rounded-lg hover:bg-red-50 transition-all">
                                    Tolak
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>
</div>

<!-- Modal konfirmasi -->
<div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-black/30 backdrop-blur-sm opacity-0 invisible transition-all duration-300 z-50">
    <div class="bg-white rounded-3xl p-8 w-[420px] mx-4 shadow-2xl transform translate-y-8 transition-all duration-300">
        <!-- Elemen dekoratif atas -->
        <div class="absolute -top-1 left-8 right-8 h-2 bg-gradient-to-r from-red-500/20 via-red-500 to-red-500/20 rounded-full blur-sm"></div>

        <!-- Konten modal -->
        <div class="relative">
            <!-- Header modal -->
            <div class="flex items-start justify-between mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-1 h-6 bg-gradient-to-b from-red-600 to-red-400 rounded-full"></div>
                    <h3 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-red-600 to-red-500">
                        Konfirmasi
                    </h3>
                </div>
                <!-- Tombol tutup -->
                <button onclick="closeModal()"
                        class="text-gray-400 hover:text-red-600 transition-colors duration-300 transform hover:rotate-90">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Pesan konfirmasi -->
            <div class="mb-8">
                <p class="text-gray-600">Apakah Anda yakin ingin melanjutkan?</p>
            </div>

            <!-- Tombol aksi -->
            <div class="flex justify-end items-center gap-3">
                <button id="cancelButton"
                        class="px-6 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 bg-gray-100/80 hover:bg-gray-100 rounded-xl transition-all duration-300">
                    Batal
                </button>
                <button id="confirmButton"
                        class="group relative px-6 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-red-600 to-red-500 rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-red-500/30 hover:-translate-y-0.5">
                    <span class="relative z-10">Ya, Lanjutkan</span>
                    <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-red-600 to-red-500 opacity-0 group-hover:opacity-100 blur transition-all duration-300 -z-10"></div>
                </button>
            </div>
        </div>

        <!-- Elemen dekoratif bawah -->
        <div class="absolute -bottom-1 left-8 right-8 h-2 bg-gradient-to-r from-red-500/20 via-red-500 to-red-500/20 rounded-full blur-sm"></div>
    </div>
</div>

<!-- Komponen alert -->
<div id="alert" class="fixed top-4 right-4 transform translate-y-[-100%] opacity-0 transition-all duration-300 z-50" role="alert">
    <div class="flex items-center p-4 min-w-[320px] rounded-xl shadow-lg border-l-4 alert-style">
        <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg alert-icon-style mr-3">
            <svg id="alertIcon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"></svg>
        </div>
        <div class="flex-1 mr-2">
            <h3 class="text-sm font-medium alert-title">Notification</h3>
            <p class="text-sm alert-message" id="alertMessage">Message here</p>
        </div>
        <button onclick="closeAlert()" class="flex-shrink-0 ml-4">
            <svg class="w-4 h-4 text-gray-500 hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>

<!-- Styles untuk animasi dan efek -->
<style>
    /* Animasi kartu surat */
    .letter-card {
        transform: translateY(20px);
        opacity: 0;
        animation: cardAppear 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    /* Efek hover pada kartu */
    .letter-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.05);
    }

    /* Animasi kemunculan kartu */
    @keyframes cardAppear {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Animasi badge status */
    .status-badge span {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    /* Efek hover pada tombol */
    .btn-hover-effect {
        position: relative;
        overflow: hidden;
    }
</style>

<!-- Script untuk interaktivitas -->
<script>
    /**
     * Menampilkan detail surat dalam modal
     * @param {number} id - ID surat yang akan ditampilkan
     */
    function viewLetter(id) {
        // Implementasi view letter
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

    /**
     * Menampilkan konfirmasi sebelum verifikasi surat
     * @param {number} id - ID surat yang akan diverifikasi
     */
    function verifyLetter(id) {
        updateLetterStatus(id, 2);
        // showCustomConfirm(function(confirm) {
        //     if (confirm) {

        //     }
        // });
    }

    /**
     * Menampilkan konfirmasi sebelum penolakan surat
     * @param {number} id - ID surat yang akan ditolak
     */
    function rejectLetter(id) {
        updateLetterStatus(id, 3);
        // showCustomConfirm(function(confirm) {
        //     if (confirm) {

        //     }
        // });
    }

    /**
     * Mengupdate status surat dengan animasi
     * @param {number} id - ID surat yang akan diupdate
     * @param {number} status - Status baru (2 = terverifikasi, 3 = ditolak)
     */
    function updateLetterStatus(id, status) {
        if(confirm("Apakah Anda yakin ingin mengupdate data dengan ID " + id + "?")){
            $.ajax({
                url: '<?= BASEURL ?>/letter/updateStatusLetter',
                method: 'POST',
                dataType: 'json',
                data: { id : id, status : status },
                success: function(msg){
                    // console.log(msg);
                    location.reload();
                },
                error: function(msg){
                    alert('Gagal memperbarui status');
                }
            });
        }
    }

    /**
     * Menambahkan animasi stagger pada kartu surat
     */
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.letter-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>