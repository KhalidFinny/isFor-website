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
        :root {
        --primary-red: #E53E3E;
        --primary-dark: #742A2A;
        --primary-light: #FEB2B2;
        --accent-red: #FC8181;
        }

        body {
        background-color: #FFF5F5;
        font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .custom-gradient {
        background: linear-gradient(135deg, var(--primary-red) 0%, var(--primary-dark) 100%);
        }

        .custom-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(229, 62, 62, 0.1);
        transition: all 0.3s ease;
        }

        .custom-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -8px rgba(229, 62, 62, 0.15);
        }

        .custom-button {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-weight: 600;
        border: none;
        cursor: pointer;
    }

        .custom-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(229, 62, 62, 0.2);
        }
    </style>
</head>
    <body class="bg-white">
    <div class="flex">
        <?php include '../app/views/assets/components/UserDashboard/sidebar.php'; ?>
        <div class="flex flex-col flex-1 ml-64 min-h-screen bg-gray-50">
        <header class="py-8 px-8 bg-white shadow-lg rounded-b-3xl">
    <h1 class="text-4xl font-bold custom-gradient text-transparent bg-clip-text">
        Riwayat File
    </h1>
    <p class="mt-2 text-red-700">Kelola dan pantau riwayat file Anda</p>
</header>

        <main class="py-6 px-8 flex-1">
            <div class="max-w-7xl mx-auto">
                <!-- Tombol Filter -->
                <div class="flex flex-wrap gap-4 mb-8">
                    <button class="custom-button custom-gradient text-white" data-status="all" onclick="filterFile('all')">
                        Semua
                    </button>
                    <button class="custom-button bg-yellow-400 text-white" data-status="1" onclick="filterFile(1)">
                        Pending
                    </button>
                    <button class="custom-button bg-green-500 text-white" data-status="2" onclick="filterFile(2)">
                        Disetujui
                    </button>
                    <button class="custom-button bg-red-500 text-white" data-status="3" onclick="filterFile(3)">
                        Ditolak
                    </button>
                </div>

                <!-- Statistik Gambar -->
                <div class="custom-card p-6 border-l-4 border-red-500">
                <p class="text-sm font-medium text-red-700">Total File</p>
                <p class="text-3xl font-bold text-red-900"><?= htmlspecialchars($data['totalFiles']); ?></p>
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
                            <div class="custom-card p-6 hover:border-red-400 border-2 border-transparent">
                                <h3 class="text-lg font-bold text-red-900 mt-3"><?= htmlspecialchars($files['title']); ?></h3>
                                <p class="text-sm text-red-700"><?= htmlspecialchars($files['category']); ?></p>
                                <span class="status-badge text-xs font-semibold px-3 py-1.5 rounded-full mt-3 inline-block
                                <?= $files['status'] == 1 ? 'bg-yellow-100 text-yellow-700' :
                                    ($files['status'] == 2 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'); ?>">
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