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
    </style>
</head>
<body class="bg-white">
    <div class="flex">
<!--        --><?php //include '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>
        <div class="flex-1 min-h-screen ml-64">
            <main class="py-10 px-8">
                <!-- Header -->
                <div class="max-w-7xl mx-auto mb-12 fade-in">
                    <div class="flex items-center space-x-4 mb-4">
                        <span class="h-px w-12 bg-red-600"></span>
                        <span class="text-red-600 font-medium">Media</span>
                    </div>
                    <h1 class="text-5xl font-bold text-red-900 mb-2">Upload Gambar</h1>
                    <p class="text-gray-500">Unggah dan kelola gambar penelitian Anda</p>
                </div>

                <!-- Main Content -->
                <div class="grid grid-cols-12 gap-8">
                    <!-- Left Column -->
                    <div class="col-span-8">
                        <!-- Upload Section -->
                        <section class="bg-white rounded-2xl border-2 border-red-100 overflow-hidden fade-in mb-8">
                            <div class="p-6 border-b border-red-100">
                                <h2 class="text-xl font-semibold text-red-800">Area Unggah</h2>
                            </div>
                            <div class="p-8">
                                <div class="upload-zone h-72 border-2 border-dashed border-red-200 rounded-xl relative">
                                    <input type="file" id="fileInput" class="hidden" accept="image/*" multiple>
                                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-red-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <button onclick="document.getElementById('fileInput').click()" 
                                                class="px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all">
                                            Pilih File
                                        </button>
                                        <p class="mt-4 text-sm text-gray-500">atau drag & drop file Anda di sini</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Preview Section -->
                        <section class="bg-white rounded-2xl border-2 border-red-100 overflow-hidden fade-in">
                            <div class="p-6 border-b border-red-100">
                                <h2 class="text-xl font-semibold text-red-800">Preview</h2>
                            </div>
                            <div class="p-8">
                                <div id="imagePreview" class="preview-grid">
                                    <!-- Preview images will be inserted here -->
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Right Column -->
                    <div class="col-span-4">
                        <section class="bg-white rounded-2xl border-2 border-red-100 overflow-hidden fade-in sticky top-8">
                            <div class="p-6 border-b border-red-100">
                                <h2 class="text-xl font-semibold text-red-800">Detail Unggahan</h2>
                            </div>
                            <div class="p-8 space-y-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-600">Judul Penelitian</label>
                                    <select class="w-full px-4 py-3 border-2 border-red-100 rounded-xl form-input bg-white text-gray-700">
                                        <option value="">Pilih Judul Penelitian</option>
                                        <option value="ai-ml">Artificial Intelligence & Machine Learning</option>
                                        <option value="iot">Internet of Things (IoT)</option>
                                        <option value="cybersecurity">Cybersecurity</option>
                                        <option value="big-data">Big Data Analytics</option>
                                        <option value="cloud">Cloud Computing</option>
                                        <option value="software">Software Engineering</option>
                                    </select>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-600">Judul Gambar</label>
                                    <input type="text" class="w-full px-4 py-3 border-2 border-red-100 rounded-xl form-input text-gray-700" 
                                           placeholder="Masukkan judul gambar">
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-600">Deskripsi</label>
                                    <textarea class="w-full px-4 py-3 border-2 border-red-100 rounded-xl form-input h-32 text-gray-700" 
                                              placeholder="Masukkan deskripsi gambar"></textarea>
                                </div>

                                <div class="space-y-2">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-sm text-gray-500">Upload Progress</span>
                                        <span class="text-sm text-gray-500" id="uploadProgress">0%</span>
                                    </div>
                                    <div class="h-1 bg-red-50 rounded-full overflow-hidden">
                                        <div class="progress-bar w-0" id="progressBar"></div>
                                    </div>
                                </div>

                                <button class="w-full px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all">
                                    Upload Gambar
                                </button>
                            </div>
                        </section>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        const fileInput = document.getElementById('fileInput');
        const imagePreview = document.getElementById('imagePreview');
        const progressBar = document.getElementById('progressBar');
        const uploadProgress = document.getElementById('uploadProgress');

        // Simplified drag and drop
        const dropZone = document.querySelector('.upload-zone');
        
        dropZone.addEventListener('dragover', e => {
            e.preventDefault();
            dropZone.classList.add('bg-red-50');
        });

        dropZone.addEventListener('dragleave', e => {
            e.preventDefault();
            dropZone.classList.remove('bg-red-50');
        });

        dropZone.addEventListener('drop', e => {
            e.preventDefault();
            dropZone.classList.remove('bg-red-50');
            handleFiles(e.dataTransfer.files);
        });

        fileInput.addEventListener('change', function() {
            handleFiles(this.files);
        });

        function handleFiles(files) {
            imagePreview.innerHTML = '';
            [...files].forEach(file => previewFile(file));
            simulateUploadProgress();
        }

        function previewFile(file) {
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.readAsDataURL(file);

            reader.onload = function() {
                const div = document.createElement('div');
                div.className = 'fade-in';
                div.innerHTML = `
                    <div class="relative group rounded-xl overflow-hidden border-2 border-red-100">
                        <img src="${reader.result}" class="w-full aspect-square object-cover" alt="${file.name}">
                        <div class="absolute inset-0 bg-red-600/80 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <button onclick="this.closest('.fade-in').remove()" 
                                    class="px-4 py-2 bg-white text-red-600 rounded-lg text-sm">
                                Remove
                            </button>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2 truncate">${file.name}</p>
                `;
                imagePreview.appendChild(div);
            };
        }

        function simulateUploadProgress() {
            let progress = 0;
            const interval = setInterval(() => {
                progress += 5;
                progressBar.style.width = `${progress}%`;
                uploadProgress.textContent = `${progress}%`;
                if (progress >= 100) clearInterval(interval);
            }, 100);
        }
    </script>
</body>
</html>