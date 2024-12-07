<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Gambar - IsFor</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ASSETS; ?>/css/animations.css">
    <style>
        .image-card {
            animation: scaleIn 0.5s ease-out forwards;
            opacity: 0;
        }

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

        .image-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .image-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .image-card:nth-child(3) {
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
                    <span class="h-px w-12 bg-blue-600"></span>
                    <span class="text-blue-600 font-medium">Verifikasi</span>
                </div>
                <h1 class="text-4xl font-bold text-blue-900">
                    Verifikasi
                </h1>
            </div>

            <!-- Images Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (empty($data['files'])): ?>
                    <div class="col-span-full text-center py-16 bg-white rounded-2xl border-2 border-blue-100">

                        <p class="mt-4 text-lg text-blue-900">Belum ada file yang perlu diverifikasi</p>
                        <p class="text-sm text-gray-500">Gambar yang membutuhkan verifikasi akan muncul di sini</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($data['files'] as $files): ?>
                        <div class="image-card bg-white rounded-2xl border-2 border-blue-100 overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-blue-900 mb-2"><?= htmlspecialchars($files['title']); ?></h3>

                                <!-- Preview File -->
                                <p class="text-sm text-gray-500 mb-4">
                                    Nama file:
                                    <a href="<?= FILES; ?>/<?= htmlspecialchars($files['file_url']); ?>"
                                       target="_blank"
                                       class="text-blue-600 hover:underline">
                                        <?= htmlspecialchars($files['original_name']); ?>
                                    </a>
                                </p>

                                <div class="flex items-center justify-between mt-4">
                                    <button onclick="verifyFile(<?= $files['research_output_id']; ?>)"
                                            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                        Verifikasi
                                    </button>
                                    <button onclick="rejectFile(<?= $files['research_output_id']; ?>)"
                                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
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

<!-- Image Preview Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50">
    <div class="max-w-4xl w-full mx-4">
        <div class="bg-white rounded-2xl overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b border-blue-100">
                <h3 class="text-xl font-bold text-blue-900">Preview Gambar</h3>
                <button onclick="closeImageModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="p-4">
                <img id="previewImage" src="" alt="Preview" class="max-w-full h-auto rounded-lg">
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50">
    <div class="max-w-md w-full mx-4 bg-white rounded-2xl overflow-hidden">
        <div class="p-6">
            <h3 id="confirmationMessage" class="text-lg font-semibold text-blue-900 mb-4">Apakah Anda yakin?</h3>
            <div class="flex justify-end space-x-4">
                <button onclick="closeConfirmationModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-900 rounded hover:bg-gray-400">
                    Batal
                </button>
                <button id="confirmActionButton"
                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                    Ya
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function viewImage(url) {
        document.getElementById('previewImage').src = url;
        document.getElementById('imageModal').classList.remove('hidden');
        document.getElementById('imageModal').classList.add('flex');
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
        document.getElementById('imageModal').classList.remove('flex');
    }

    let actionToConfirm = null; // Variable untuk menyimpan action sementara
    let actionId = null; // Variable untuk menyimpan ID sementara

    function showConfirmationModal(message, action, id) {
        document.getElementById('confirmationMessage').textContent = message;
        actionToConfirm = action;
        actionId = id;
        document.getElementById('confirmationModal').classList.remove('hidden');
        document.getElementById('confirmationModal').classList.add('flex');
    }

    function closeConfirmationModal() {
        document.getElementById('confirmationModal').classList.add('hidden');
        document.getElementById('confirmationModal').classList.remove('flex');
        actionToConfirm = null;
        actionId = null;
    }

    document.getElementById('confirmActionButton').onclick = function () {
        if (actionToConfirm && actionId) {
            actionToConfirm(actionId);
        }
        closeConfirmationModal();
    };

    function verifyFile(id) {
        showConfirmationModal(
            "Apakah Anda yakin ingin memverifikasi file ini?",
            function (id) {
                fetch(`<?= BASEURL; ?>/researchoutput/verifyFile/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Gambar berhasil diverifikasi');
                            location.reload();
                        } else {
                            alert('Gagal memverifikasi gambar: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memverifikasi gambar.');
                    });
            },
            id
        );
    }

    function rejectFile(id) {
        showConfirmationModal(
            "Apakah Anda yakin ingin menolak file ini?",
            function (id) {
                fetch(`<?= BASEURL; ?>/researchoutput/rejectFile/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('File berhasil ditolak');
                            location.reload();
                        } else {
                            alert('Gagal menolak File: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menolak File.');
                    });
            },
            id
        );
    }

</script>
</body>
</html> 