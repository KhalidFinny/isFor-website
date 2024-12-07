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
        .file-card {
        transform: translateY(20px);
        opacity: 0;
        animation: cardAppear 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    .file-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.05);
    }

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

    .btn-hover-effect {
        position: relative;
        overflow: hidden;
    }

    /* Modal styles */
    .modal {
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease-in-out;
    }

    .modal.active {
        opacity: 1;
        visibility: visible;
    }

    .modal-content {
        transform: translateY(-20px);
        transition: all 0.3s ease-in-out;
    }

    .modal.active .modal-content {
        transform: translateY(0);
    }

    /* Alert styles */
    .alert {
        transform: translateY(-100%);
        transition: all 0.3s ease-in-out;
    }

    .alert.active {
        transform: translateY(0);
    }
    </style>
</head>

<body class="bg-gray-50">
<div class="flex min-h-screen bg-white">
    <?php include '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>
    
    <div class="flex-1 ml-64 page-content">
        <main class="p-8 max-w-[1600px] mx-auto">
            <!-- Header -->
            <div class="max-w-7xl mx-auto mb-12 fade-in">
                <div class="flex items-center space-x-4 mb-4">
                    <span class="h-px w-12 bg-red-600"></span>
                    <span class="text-red-600 font-medium">Files</span>
                </div>
                <h1 class="text-5xl font-bold text-red-900 mb-2">Verifikasi File</h1>
            </div>

            <!-- Grid untuk file -->
            <div class="grid grid-cols-2 gap-8">
                <?php if (empty($data['files'])): ?>
                    <div class="col-span-2">
                        <div class="flex flex-col items-center justify-center h-[400px]">
                            <div class="w-20 h-20 border-2 border-red-200 rounded-full flex items-center justify-center mb-6 relative">
                                <div class="absolute inset-0 border-2 border-green-200 rounded-full animate-ping opacity-100"></div>
                                <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-medium text-red-900 mb-2">Tidak Ada File</h3>
                            <p class="text-sm text-red-600">File yang membutuhkan verifikasi akan muncul di sini</p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($data['files'] as $file): ?>
                        <div class="file-card group relative bg-white border border-gray-200 rounded-lg p-6 transition-all duration-300 hover:border-red-200"
                             data-file-id="<?= $file['research_output_id']; ?>">
                            
                            <!-- Badge status -->
                            <div class="absolute -top-2.5 right-6">
                                <span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-2"></span>
                                    Menunggu Verifikasi
                                </span>
                            </div>

                            <!-- File info -->
                            <div class="mb-8">
                                <div class="flex items-center gap-4 mb-4">
                                    <!-- File type icon -->
                                    <?php
                                    $extension = pathinfo($file['file_url'], PATHINFO_EXTENSION);
                                    $iconClass = match(strtolower($extension)) {
                                        'pdf' => 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z',
                                        'doc', 'docx' => 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z M12 11h4M12 15h4M12 7h1.5',
                                        'xls', 'xlsx' => 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z M12 7v8m-4-4h8',
                                        default => 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z'
                                    };
                                    ?>
                                    <div class="w-12 h-12 flex-shrink-0 bg-red-50 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                  d="<?= $iconClass ?>"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold text-red-900"><?= htmlspecialchars($file['title']); ?></h3>
                                        <p class="text-sm text-gray-500"><?= htmlspecialchars($file['original_name']); ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Action buttons -->
                            <div class="grid grid-cols-4 gap-3">
                                <button onclick="window.open('<?= FILES; ?>/<?= $file['file_url']; ?>', '_blank')"
                                        class="btn-hover-effect flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-all">
                                    Preview
                                </button>
                                <a href="<?= FILES; ?>/<?= $file['file_url']; ?>" download
                                   class="btn-hover-effect flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-all">
                                    Download
                                </a>
                                <button onclick="verifyFile(<?= $file['research_output_id']; ?>)"
                                        class="btn-hover-effect flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-all">
                                    Verifikasi
                                </button>
                                <button onclick="rejectFile(<?= $file['research_output_id']; ?>)"
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

<!-- Confirmation Modal -->
<div id="confirmationModal" class="modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="modal-content bg-white rounded-xl shadow-xl max-w-md w-full mx-4 overflow-hidden">
        <div class="p-6">
            <div class="mb-4 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Konfirmasi Aksi</h3>
                <p class="text-sm text-gray-500 mt-2" id="modalMessage">Apakah Anda yakin ingin melakukan aksi ini?</p>
            </div>
            <div class="flex gap-3">
                <button id="confirmButton" class="flex-1 justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                    Konfirmasi
                </button>
                <button onclick="closeModal()" class="flex-1 justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Alert Component -->
<div id="alert" class="alert fixed top-4 right-4 max-w-sm bg-white rounded-lg shadow-lg border-l-4 border-green-500 p-4 hidden">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium text-gray-900" id="alertMessage"></p>
        </div>
    </div>
</div>

<script>
    let currentFileId = null;
    let currentAction = null;

    function showModal(fileId, action, title, message) {
        currentFileId = fileId;
        currentAction = action;
        
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalMessage').textContent = message;
        document.getElementById('confirmationModal').classList.add('active');
    }

    function closeModal() {
        document.getElementById('confirmationModal').classList.remove('active');
    }

    function showAlert(message, type = 'success') {
        const alert = document.getElementById('alert');
        const alertMessage = document.getElementById('alertMessage');
        
        alert.classList.remove('hidden');
        alert.classList.add('active');
        alertMessage.textContent = message;
        
        // Auto hide after 3 seconds
        setTimeout(() => {
            alert.classList.remove('active');
            setTimeout(() => alert.classList.add('hidden'), 300);
        }, 3000);
    }

    function verifyFile(fileId) {
        showModal(
            fileId,
            'verify',
            'Konfirmasi Verifikasi',
            'Apakah Anda yakin ingin memverifikasi file ini?'
        );
    }

    function rejectFile(fileId) {
        showModal(
            fileId,
            'reject',
            'Konfirmasi Penolakan',
            'Apakah Anda yakin ingin menolak file ini?'
        );
    }

    // Add event listener for confirm button
    document.getElementById('confirmButton').addEventListener('click', async () => {
        if (!currentFileId || !currentAction) return;

        try {
            const response = await fetch('/admin/verify-file/action', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    fileId: currentFileId,
                    action: currentAction
                })
            });

            if (response.ok) {
                showAlert(
                    currentAction === 'verify' 
                        ? 'File berhasil diverifikasi!' 
                        : 'File berhasil ditolak!'
                );
                
                // Remove the card from the UI
                const fileCard = document.querySelector(`[data-file-id="${currentFileId}"]`);
                fileCard.style.opacity = '0';
                setTimeout(() => fileCard.remove(), 300);
            } else {
                throw new Error('Failed to process request');
            }
        } catch (error) {
            showAlert('Terjadi kesalahan. Silakan coba lagi.', 'error');
        }

        closeModal();
    });
</script>
</body>
</html>

</rewritten_file>