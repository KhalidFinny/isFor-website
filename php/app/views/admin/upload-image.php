<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Gambar - Modern Design</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Simplified Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }

        .upload-zone {
            background-size: 40px 40px;
            background-image: radial-gradient(circle, #fee2e2 1px, transparent 1px);
            transition: all 0.3s ease;
        }

        .upload-zone:hover {
            background-color: #FEF2F2;
        }

        .form-input {
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: #ef4444;
            transform: translateY(-2px);
        }

        .preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .fade-up {
            animation: fadeUp 0.4s ease-out forwards;
        }

        @keyframes fadeUp {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        .preview-image {
            animation: scaleIn 0.3s ease-out forwards;
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .form-control {
            transition: all 0.3s ease;
        }

        .form-control:focus {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>
<body class="bg-white">
    <div class="flex">
    <?php include_once '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>
        <div class="flex-1 min-h-screen ml-64 bg-gray-50">
            <main class="py-10 px-8">
                <!-- Swiss-inspired Header (Matching manage-roadmap.php) -->
                <div class="max-w-7xl mx-auto mb-12 fade-in">
                    <div class="flex items-center space-x-4 mb-4">
                        <span class="h-px w-12 bg-red-600"></span>
                        <span class="text-red-600 font-medium">Media</span>
                    </div>
                    <h1 class="text-5xl font-bold text-red-900 mb-2">Upload Gambar</h1>
                </div>

                <!-- Upload Form -->
                <form action="" method="POST" enctype="multipart/form-data" id="uploadForm" class="max-w-7xl mx-auto">
                    <div class="grid grid-cols-12 gap-8">
                        <!-- Left Column -->
                        <div class="col-span-8">
                            <!-- Upload Section -->
                            <section class="bg-white rounded-2xl border-2 border-red-100 overflow-hidden fade-in mb-8">
                                <div class="p-6 border-b border-red-100">
                                    <h2 class="text-xl font-semibold text-red-800">Area Unggah</h2>
                                </div>
                                <div class="p-8">
                                    <div class="upload-zone group h-72 border-2 border-dashed border-red-200 rounded-xl relative">
                                        <input type="file" name="images[]" id="fileInput" class="hidden" accept="image/*" multiple required>
                                        <div class="absolute inset-0 flex flex-col items-center justify-center transform group-hover:-translate-y-2 transition-all duration-300">
                                            <div class="w-20 h-20 mb-6 rounded-full bg-red-50 flex items-center justify-center group-hover:bg-red-100 transition-all duration-300">
                                                <svg class="w-10 h-10 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <button type="button" onclick="document.getElementById('fileInput').click()" 
                                                    class="px-8 py-4 bg-red-500 text-white rounded-xl hover:bg-red-600 transform hover:-translate-y-1 transition-all duration-300">
                                                Pilih File Gambar
                                            </button>
                                            <p class="mt-4 text-sm text-gray-400">atau drag & drop file Anda di sini</p>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- Preview Grid -->
                            <div id="imagePreview" class="grid grid-cols-3 gap-4">
                                <!-- Preview images will be inserted here -->
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-span-4">
                            <div class="sticky top-8 bg-white rounded-2xl p-8 border-2 border-red-100 space-y-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-600">Judul Penelitian</label>
                                    <select name="research_id" required class="w-full px-4 py-3 bg-gray-50 border-2 border-red-50 rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300">
                                        <option value="">Pilih Judul Penelitian</option>
                                        <?php foreach($data['researches'] as $research): ?>
                                            <option value="<?= $research['id'] ?>"><?= $research['title'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-600">Judul Gambar</label>
                                    <input type="text" name="title" required 
                                           class="w-full px-4 py-3 bg-gray-50 border-2 border-red-50 rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300"
                                           placeholder="Masukkan judul gambar">
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-600">Deskripsi</label>
                                    <textarea name="description" required
                                              class="w-full px-4 py-3 bg-gray-50 border-2 border-red-50 rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300 h-32"
                                      placeholder="Masukkan deskripsi gambar"></textarea>
                                </div>

                                <button type="submit" 
                                        class="w-full px-6 py-4 bg-red-500 text-white rounded-xl hover:bg-red-600 transform hover:-translate-y-1 transition-all duration-300">
                                    Upload Gambar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('uploadForm');
        const fileInput = document.getElementById('fileInput');
        const previewContainer = document.getElementById('imagePreview');
        const progressBar = document.querySelector('.progress-bar');
        const progressText = document.getElementById('uploadProgress');

        // Handle file selection
        fileInput.addEventListener('change', handleFileSelect);
        
        // Handle drag and drop
        const dropZone = document.querySelector('.upload-zone');
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults);
        });
        
        dropZone.addEventListener('dragenter', highlight);
        dropZone.addEventListener('dragover', highlight);
        dropZone.addEventListener('dragleave', unhighlight);
        dropZone.addEventListener('drop', handleDrop);

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function highlight() {
            dropZone.classList.add('border-red-500', 'bg-red-50');
        }

        function unhighlight() {
            dropZone.classList.remove('border-red-500', 'bg-red-50');
        }

        function handleDrop(e) {
            unhighlight();
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
        }

        function handleFileSelect(e) {
            handleFiles(e.target.files);
        }

        function handleFiles(files) {
            previewContainer.innerHTML = ''; // Clear existing previews
            [...files].forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const preview = createPreviewElement(e.target.result, file.name, index);
                        previewContainer.appendChild(preview);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        function createPreviewElement(src, filename, index) {
            const div = document.createElement('div');
            div.className = 'preview-image relative rounded-lg overflow-hidden';
            div.innerHTML = `
                <img src="${src}" alt="${filename}" class="w-full h-48 object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <p class="text-white text-sm px-4 text-center">${filename}</p>
                </div>
            `;
            return div;
        }

        // Form submission with progress
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);

            try {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '<?= BASEURL; ?>/galleries/upload', true);

                xhr.upload.onprogress = (e) => {
                    if (e.lengthComputable) {
                        const percentComplete = Math.round((e.loaded / e.total) * 100);
                        progressBar.style.width = percentComplete + '%';
                        progressText.textContent = percentComplete + '%';
                    }
                };

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        progressBar.classList.add('bg-green-500');
                        setTimeout(() => {
                            window.location.href = '<?= BASEURL; ?>/galleries';
                        }, 1000);
                    } else {
                        throw new Error('Upload failed');
                    }
                };

                xhr.onerror = function() {
                    progressBar.classList.add('bg-red-500');
                    alert('Upload failed. Please try again.');
                };

                xhr.send(formData);
            } catch (error) {
                console.error('Upload error:', error);
                alert('An error occurred during upload.');
            }
        });
    });
    </script>
</body>
</html>