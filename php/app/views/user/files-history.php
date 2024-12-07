<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Gambar - IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
        }

        .slide-up {
            animation: slideUp 0.5s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .image-card {
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .image-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -10px rgba(51, 65, 85, 0.1);
        }

        .status-badge {
            transition: all 0.3s ease;
        }

        .status-badge:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-white">
<div class="flex">
    <?php include '../app/views/assets/components/UserDashboard/sidebar.php'; ?>
    <div class="flex flex-col flex-1 ml-64 min-h-screen bg-gray-50">
        <header class="py-6 px-8 bg-white shadow-md">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-red-600 to-red-600 bg-clip-text text-transparent">
                Riwayat File
            </h1>
            <p class="mt-2 text-red-600">Kelola dan pantau riwayat file Anda</p>
        </header>

        <main class="py-6 px-8 flex-1">
            <div class="max-w-7xl mx-auto">
                <!-- Tombol Filter -->
                <div class="flex space-x-4 mb-8">
                    <button class="filter-button bg-red-700 text-white px-4 py-2 rounded-lg hover:bg-red-600"
                            data-status="all" onclick="filterFile('all')">Semua
                    </button>
                    <button class="filter-button bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600"
                            data-status="1" onclick="filterFile(1)">Pending
                    </button>
                    <button class="filter-button bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600"
                            data-status="2" onclick="filterFile(2)">Disetujui
                    </button>
                    <button class="filter-button bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600"
                            data-status="3" onclick="filterFile(3)">Ditolak
                    </button>
                </div>

                <!-- Statistik Gambar -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
                        <p class="text-sm font-medium text-red-600">Total File</p>
                        <p class="text-2xl font-bold text-red-900"><?= htmlspecialchars($data['totalFiles']); ?></p>
                    </div>
                    <!-- Tambahkan statistik lainnya jika diperlukan -->
                </div>

                <!-- Daftar Gambar -->
                <div id="imageListContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php if (empty($data['files'])) : ?>
                        <div class="col-span-full text-center py-12">
                            <svg class="w-16 h-16 text-red-200 mx-auto mb-4" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <h3 class="text-xl font-medium text-red-900 mb-2">Belum ada File</h3>
                        </div>
                    <?php else : ?>
                        <?php foreach ($data['files'] as $files) : ?>
                            <div class="bg-white p-4 rounded-xl shadow-md border border-gray-200 image-card">
                                <h3 class="text-lg font-bold text-red-900 mt-3"><?= htmlspecialchars($files['title']); ?></h3>
                                <p class="text-sm text-red-600"><?= htmlspecialchars($files['category']); ?></p>
                                <span class="status-badge text-xs font-semibold px-2 py-1 rounded-lg mt-2 inline-block
                                <?= $files['status'] == 1 ? 'bg-yellow-100 text-yellow-600' :
                                    ($files['status'] == 2 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600'); ?>">
                                    <?= $files['status'] == 1 ? 'Pending' : ($files['status'] == 2 ? 'Approved' : 'Rejected'); ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    function previewImage(url, title, description) {
        document.getElementById('previewImage').src = url;
        document.getElementById('previewTitle').textContent = title;
        document.getElementById('previewDescription').textContent = description;
        document.getElementById('imageModal').classList.remove('hidden');
        document.getElementById('imageModal').classList.add('flex');
    }

    function closePreview() {
        document.getElementById('imageModal').classList.add('hidden');
        document.getElementById('imageModal').classList.remove('flex');
    }

    // Intersection Observer for scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.image-card').forEach(card => {
        observer.observe(card);
    });

    document.querySelectorAll('.filter-button').forEach(button => {
        button.addEventListener('click', function () {
            const status = this.getAttribute('data-status');
            filterFile(status);
        });
    });

    function filterFile(status) {
        fetch('<?= BASEURL; ?>/galleries/filter', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `status=${status}`
        })
            .then(response => response.json())
            .then(data => {
                const imageListContainer = document.getElementById('imageListContainer');
                imageListContainer.innerHTML = '';

                if (data.length === 0) {
                    imageListContainer.innerHTML = `
                <div class="col-span-full text-center py-12">
                    <h3 class="text-xl font-medium text-red-900 mb-2">Belum ada gambar</h3>
                    <p class="text-red-600 mb-6">Mulai unggah File Anda sekarang</p>
                </div>
            `;
                    return;
                }

                data.forEach(image => {
                    imageListContainer.innerHTML += `
                <div class="bg-white p-4 rounded-xl shadow-md image-card">
                    <img src="<?= GALLERY; ?>/files/${image.image}" alt="${image.title}"
                         class="w-full h-32 object-cover rounded-t-md">
                    <h3 class="text-lg font-bold text-red-900 mt-2">${image.title}</h3>
                    <p class="text-sm text-red-600">${image.category}</p>
                    <p class="text-xs text-red-500 mt-2">Diunggah pada ${new Date(image.created_at).toLocaleDateString()}</p>
                    <span class="status-badge text-xs font-semibold px-2 py-1 rounded-lg mt-2 inline-block ${
                        image.status == 1 ? 'bg-yellow-100 text-yellow-600' :
                            image.status == 2 ? 'bg-green-100 text-green-600' :
                                'bg-red-100 text-red-600'
                    }">
                        ${image.status == 1 ? 'Pending' : image.status == 2 ? 'Approved' : 'Rejected'}
                    </span>
                </div>
            `;
                });
            })
            .catch(error => console.error('Error:', error));
    }


</script>
</body>
</html> 