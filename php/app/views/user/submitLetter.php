<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Surat - IsFor PRI</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS; ?>/user/submit-letter.css">
    <script src="https://cdn.jsdelivr.net/npm/docx@7.1.0/dist/docx.js"></script>
</head>
<body class="bg-white">
<div class="flex">
    <?php include '../app/views/assets/components/UserDashboard/sidebar.php';?>
    <div class="flex-1 min-h-screen ml-64 bg-white">
        <main class="py-10 px-8">
        <div class="max-w-7xl mx-auto mb-12">
                <a href="<?= BASEURL ?>/dashboardAdmin"
                   class="inline-flex items-center space-x-2 text-red-500 hover:text-red-600 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Kembali</span>
                </a>
            </div>
            <!-- Swiss-inspired Header -->
            <div class="max-w-7xl mx-auto mb-12 fade-in">
                <div class="flex items-center space-x-4 mb-4">
                    <span class="h-px w-12 bg-red-600"></span>
                    <span class="text-red-600 font-medium">Pengajuan</span>
                </div>
                <h1 class="text-5xl font-bold text-red-900 mb-2">Surat Rekomendasi</h1>
            </div>

            <!-- Form Section -->
            <form action="<?=BASEURL?>/letter/sendletter" method="POST" id="letterForm" class="max-w-7xl mx-auto">
                <div class="grid grid-cols-12 gap-8">
                    <!-- Left Column -->
                    <div class="col-span-8">
                        <section class="bg-white rounded-2xl border-2 border-red-100 overflow-hidden fade-in mb-8">
                            <div class="p-6 border-b border-red-100">
                                <h2 class="text-xl font-semibold text-red-800">Detail Penelitian</h2>
                            </div>
                            <div class="p-8 space-y-6">
                                <!-- Research Title -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-600">Judul Penelitian</label>
                                    <input type="text" id="researchTitle" name="researchTitle" required
                                           class="w-full px-4 py-3 bg-white border-2 border-red-50 rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300"
                                           placeholder="Masukkan judul penelitian">
                                </div>

                                <!-- Lead Researcher -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-600">Ketua Peneliti</label>
                                    <input type="text" id="leadResearcher" name="leadResearcher" required
                                           class="w-full px-4 py-3 bg-white border-2 border-red-50 rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300"
                                           placeholder="Nama ketua peneliti">
                                </div>

                                <!-- Research Topic -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-600">Topik Riset</label>
                                    <input type="text" id="researchTopic" name="researchTopic" required
                                           class="w-full px-4 py-3 bg-white border-2 border-red-50 rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300"
                                           placeholder="Masukkan topik riset">
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Right Column -->
                    <div class="col-span-4">
                        <div class="sticky top-8 bg-white rounded-2xl p-8 border-2 border-red-100 space-y-6">
                            <input type="hidden" name="user_id" value="<?=$_SESSION["user_id"]?>">
                            <input type="hidden" name="letterType" value="research_recommendation">

                            <!-- Research Scheme -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-600">Skema Penelitian</label>
                                <select id="researchScheme" name="researchScheme" required
                                        class="w-full px-4 py-3 bg-white border-2 border-red-50 rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300 hover:bg-red-50">
                                    <option value="">Pilih Skema Penelitian</option>
                                    <option value="DIPA SWADANA">DIPA SWADANA</option>
                                    <option value="DIPA PNBP">DIPA PNBP</option>
                                    <option value="Tesis Magister">Tesis Magister</option>
                                </select>
                            </div>

                            <!-- Research Center -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-600">Pusat Riset</label>
                                <input type="text" id="researchCenter" name="researchCenter"
                                       value="Pusat Riset iSFor" readonly
                                       class="w-full px-4 py-3 bg-white border-2 border-red-50 rounded-xl text-gray-500">
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3 pt-4">
                                <!-- Preview Button -->
                                <button type="button" onclick="previewLetter()"
                                        class="w-full px-6 py-4 bg-white text-red-600 border-2 border-red-200 rounded-xl
                                               hover:bg-red-50 hover:border-red-300 transform hover:-translate-y-1
                                               transition-all duration-300 flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <span>Preview Surat</span>
                                </button>

                                <!-- Submit Button -->
                                <button type="submit"
                                        class="w-full px-6 py-4 bg-red-500 text-white rounded-xl
                                               hover:bg-red-600 transform hover:-translate-y-1
                                               transition-all duration-300 flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Ajukan Surat</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>
</div>

<!-- Container utama untuk preview surat -->
<div id="letterPreview" class="hidden bg-white rounded-2xl border-2 border-red-100 p-6 mt-8">
    <!-- Judul bagian preview -->
    <h3 class="text-lg font-semibold text-red-800 mb-4">Status Pengajuan Surat</h3>
    <!-- Wrapper untuk konten preview -->
    <div class="bg-red-50 rounded-xl p-4">
        <div class="flex items-start space-x-4">
            <!-- Icon surat (bagian kiri) -->
            <div class="flex-shrink-0">
                <div class="w-12 h-12 rounded-lg bg-red-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <!-- Informasi progress (bagian kanan) -->
            <div class="flex-1 min-w-0">
                <!-- Judul preview surat -->
                <p class="text-sm font-medium text-red-900" id="previewTitle">Mengirim Surat Penelitian</p>
                <!-- Progress bar -->
                <div class="mt-2 w-full bg-red-200 rounded-full h-2.5">
                    <div id="previewProgress"
                         class="bg-red-500 h-2.5 rounded-full transition-all duration-300"
                         style="width: 0%">
                    </div>
                </div>
                <!-- Text status progress -->
                <p class="text-xs text-red-400 mt-1" id="previewStatus">Menunggu pengiriman...</p>
            </div>
        </div>
    </div>
</div>
<!-- Modal konfirmasi pengajuan surat -->
<div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <!-- Wrapper konten modal -->
    <div id="modalContent"
         class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
                bg-white rounded-2xl p-8 w-96 opacity-0 scale-95
                transition-all duration-300">
        <!-- Konten modal -->
        <div class="text-center">
            <!-- Icon peringatan -->
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <!-- Judul modal -->
            <h2 class="text-2xl font-semibold text-red-800 mb-2">Konfirmasi Pengajuan</h2>
            <!-- Pesan konfirmasi -->
            <p class="text-gray-600 mb-6">Apakah Anda yakin ingin mengajukan surat ini?</p>
            <!-- Tombol-tombol aksi -->
            <div class="flex justify-center space-x-3">
                <!-- Tombol batal -->
                <button id="cancelButton"
                        class="px-6 py-3 bg-white text-red-600 border-2 border-red-200 rounded-xl
                               hover:bg-red-50 hover:border-red-300 transform hover:-translate-y-1
                               transition-all duration-300">
                    Batal
                </button>
                <!-- Tombol konfirmasi -->
                <button id="confirmButton"
                        class="px-6 py-3 bg-red-500 text-white rounded-xl hover:bg-red-600
                               transform hover:-translate-y-1 transition-all duration-300">
                    Ajukan
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Container untuk pesan alert -->
<div id="alertMessage" class="hidden fixed top-4 right-4 max-w-md w-full">
    <!-- Konten alert akan di-inject melalui JavaScript -->
</div>
<div id="submitProgress" class="hidden bg-white rounded-2xl border-2 border-red-100 p-6 mt-8">
    <h3 class="text-lg font-semibold text-red-800 mb-4">Status Pengiriman</h3>
    <div class="bg-red-50 rounded-xl p-4">
        <div class="flex items-start space-x-4">
            <!-- Letter Icon -->
            <div class="flex-shrink-0">
                <div class="w-12 h-12 rounded-lg bg-red-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <!-- Progress Info -->
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-red-900">Mengirim Surat</p>
                <!-- Progress Bar -->
                <div class="mt-2 w-full bg-red-200 rounded-full h-2.5">
                    <div id="progressBar"
                         class="bg-red-500 h-2.5 rounded-full transition-all duration-300"
                         style="width: 0%">
                    </div>
                </div>
                <p class="text-xs text-red-400 mt-1" id="submitStatus">Menunggu pengiriman...</p>
            </div>
        </div>
    </div>
</div>

<script>
    function previewLetter() {
        const formData = new FormData(document.getElementById('letterForm'));

        fetch('<?=BASEURL?>/letter/previewletter', {
            method: 'POST',
            body: formData
        })
            .then(response => response.blob())
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                window.open(url, '_blank');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat preview surat');
            });
    }
</script>
<script>
// Inisialisasi variabel untuk mengakses elemen-elemen DOM
const form = document.getElementById('letterForm');                    // Form utama pengajuan surat
const modal = document.getElementById('confirmationModal');           // Modal konfirmasi
const modalContent = document.getElementById('modalContent');         // Konten modal
const cancelButton = document.getElementById('cancelButton');         // Tombol batal pada modal
const confirmButton = document.getElementById('confirmButton');       // Tombol konfirmasi pada modal
const submitButton = document.querySelector('button[type="submit"]'); // Tombol submit form
const letterPreview = document.getElementById('letterPreview');       // Preview surat
const previewProgress = document.getElementById('previewProgress');   // Progress bar preview
const previewStatus = document.getElementById('previewStatus');       // Status text preview
const previewTitle = document.getElementById('previewTitle');         // Judul preview

// Event listener untuk submit form
form.addEventListener('submit', function(e) {
    e.preventDefault(); // Mencegah form melakukan submit langsung

    // Validasi field-field yang diperlukan
    const researchTitle = document.getElementById('researchTitle').value.trim();
    const leadResearcher = document.getElementById('leadResearcher').value.trim();
    const researchTopic = document.getElementById('researchTopic').value.trim();
    const researchScheme = document.getElementById('researchScheme').value.trim();

    // Pengecekan validasi untuk setiap field
    if (!researchTitle) {
        showAlert('Silakan masukkan judul penelitian.', 'error');
        return;
    }
    if (!leadResearcher) {
        showAlert('Silakan masukkan nama ketua peneliti.', 'error');
        return;
    }
    if (!researchTopic) {
        showAlert('Silakan masukkan topik riset.', 'error');
        return;
    }
    if (!researchScheme) {
        showAlert('Silakan pilih skema penelitian.', 'error');
        return;
    }

    // Menampilkan modal konfirmasi
    modal.classList.remove('hidden');
    modalContent.classList.remove('scale-95', 'opacity-0');
    modalContent.classList.add('scale-100', 'opacity-100');
});

// Event listener untuk tombol batal
cancelButton.addEventListener('click', function() {
    // Animasi menutup modal
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
});

// Event listener untuk tombol konfirmasi
confirmButton.addEventListener('click', function() {
    // Menutup modal konfirmasi
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);

    // Menampilkan preview pengajuan surat
    letterPreview.classList.remove('hidden');
    previewTitle.textContent = `Mengirim: ${document.getElementById('researchTitle').value}`;

    // Mengubah tampilan tombol submit menjadi loading
    submitButton.disabled = true;
    submitButton.innerHTML = `
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Mengirim...
    `;

    const formData = new FormData(form);
    fetch('<?=BASEURL?>/letter/sendletter', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(data => {
        // Simulasi progress pengiriman
        let progress = 0;
        const progressInterval = setInterval(() => {
            progress += 5;
            if (progress <= 90) {
                previewProgress.style.width = progress + '%';
                previewStatus.textContent = `Mengirim... ${progress}%`;
            }
        }, 100);

        // Simulasi selesai pengiriman
        setTimeout(() => {
            clearInterval(progressInterval);
            previewProgress.style.width = '100%';
            previewStatus.textContent = 'Pengiriman selesai!';

            // Menampilkan pesan sukses
            showAlert('Surat berhasil diajukan!', 'success');

            // Redirect to dashboard after successful submission
            setTimeout(() => {
                window.location.href = '<?=BASEURL?>/dashboardUser';
            }, 2000);
        }, 2000);
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Gagal mengirim surat. Silakan coba lagi.', 'error');
        submitButton.disabled = false;
        submitButton.innerHTML = `
            <svg class="w-5 h-5 mr-2 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Ajukan Surat
        `;
    });
});

/**
 * Fungsi untuk menampilkan pesan alert
 * @param {string} message - Pesan yang akan ditampilkan
 * @param {string} type - Tipe alert ('success' atau 'error')
 */
function showAlert(message, type = 'success') {
    const alertElement = document.getElementById('alertMessage');
    const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';

    // Memilih icon berdasarkan tipe alert
    const icon = type === 'success'
        ? `<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
           </svg>`
        : `<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
           </svg>`;

    // Menyusun HTML alert
    alertElement.className = `fixed top-4 right-4 max-w-md w-full shadow-lg rounded-2xl overflow-hidden transform transition-all duration-300 ${bgColor}`;
    alertElement.innerHTML = `
        <div class="p-4 flex items-center">
            <div class="flex-shrink-0 text-white">
                ${icon}
            </div>
            <div class="ml-3 text-white font-medium">${message}</div>
            <button onclick="closeAlert()" class="ml-auto text-white hover:text-gray-200">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    `;

    // Menampilkan alert dengan animasi
    alertElement.style.transform = 'translateY(0)';
    alertElement.classList.remove('hidden');

    // Otomatis sembunyikan alert setelah 5 detik
    setTimeout(closeAlert, 5000);
}

/**
 * Fungsi untuk menutup alert
 */
function closeAlert() {
    const alertElement = document.getElementById('alertMessage');
    alertElement.style.transform = 'translateY(-100%)';
    setTimeout(() => alertElement.classList.add('hidden'), 300);
}
</script>
</body>
</html>