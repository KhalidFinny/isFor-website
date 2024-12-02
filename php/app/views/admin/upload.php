<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Gambar - IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
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
            from { opacity: 0; }
            to { opacity: 1; }
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

        .drop-zone {
            transition: all 0.3s ease;
        }

        .drop-zone.dragover {
            background-color: #EFF6FF;
            border-color: #3B82F6;
        }

        .preview-image {
            transition: all 0.3s ease;
        }

        .preview-image:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-white">
    <div class="flex">
        <div class="flex-1 min-h-screen ml-64">
            <main class="py-10 px-8">
                <div class="max-w-7xl mx-auto">
                    <!-- Header Section -->
                    <div class="mb-8 fade-in">
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Upload Gambar
                        </h1>
                        <p class="mt-2 text-blue-600">Unggah dan kelola gambar untuk konten website</p>
                    </div>

                    <form action="<?= BASEURL; ?>/admin/processUpload" method="POST" enctype="multipart/form-data" class="space-y-8">
                        <!-- Upload Section -->
                        <div class="bg-white rounded-xl shadow-sm border-2 border-blue-100 p-8 slide-up">
                            <div id="dropZone" class="drop-zone border-2 border-dashed border-blue-200 rounded-xl p-8 text-center">
                                <div class="space-y-4">
                                    <svg class="w-16 h-16 mx-auto text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <h3 class="text-lg font-semibold text-blue-900">Drag & drop gambar di sini</h3>
                                    <p class="text-blue-600">atau</p>
                                    <button type="button" onclick="document.getElementById('fileInput').click()" 
                                            class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors">
                                        Pilih File
                                    </button>
                                    <input type="file" id="fileInput" name="images[]" multiple accept="image/*" class="hidden">
                                    <p class="text-sm text-blue-600">Format yang didukung: JPG, PNG, GIF (Max. 5MB)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Details -->
                        <div class="bg-white rounded-xl shadow-sm border-2 border-blue-100 p-8 slide-up" style="animation-delay: 0.1s">
                            <h2 class="text-2xl font-semibold text-blue-900 mb-6">Detail Upload</h2>
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-blue-900 mb-2">Kategori</label>
                                    <select name="category" class="w-full px-4 py-2 border-2 border-blue-100 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="gallery">Galeri</option>
                                        <option value="research">Hasil Penelitian</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-blue-900 mb-2">Judul</label>
                                    <input type="text" name="title" required
                                           class="w-full px-4 py-2 border-2 border-blue-100 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-blue-900 mb-2">Deskripsi</label>
                                    <textarea name="description" rows="4"
                                              class="w-full px-4 py-2 border-2 border-blue-100 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Preview Section -->
                        <div id="previewSection" class="space-y-6 slide-up" style="animation-delay: 0.2s">
                            <h2 class="text-2xl font-semibold text-blue-900">Preview Gambar</h2>
                            <div id="imagePreview" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <!-- Preview images will be inserted here -->
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 
                                transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 slide-up" 
                                style="animation-delay: 0.3s">
                            Upload Gambar
                        </button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script>
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const imagePreview = document.getElementById('imagePreview');

        // Drag and drop handlers
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropZone.classList.add('dragover');
        }

        function unhighlight(e) {
            dropZone.classList.remove('dragover');
        }

        // Handle dropped files
        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
        }

        fileInput.addEventListener('change', function() {
            handleFiles(this.files);
        });

        function handleFiles(files) {
            [...files].forEach(previewFile);
        }

        function previewFile(file) {
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.readAsDataURL(file);

            reader.onload = function() {
                const div = document.createElement('div');
                div.className = 'preview-image bg-white p-4 rounded-xl border-2 border-blue-100 hover:border-blue-300 transition-all';
                div.innerHTML = `
                    <img src="${reader.result}" class="w-full h-48 object-cover rounded-lg mb-4">
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-blue-900 truncate">${file.name}</p>
                        <p class="text-xs text-blue-600">${(file.size / (1024 * 1024)).toFixed(2)} MB</p>
                        <button onclick="this.parentElement.parentElement.remove()" 
                                class="w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                            Hapus
                        </button>
                    </div>
                `;
                imagePreview.appendChild(div);
            };
        }

        // Animation observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.slide-up, .fade-in').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>
