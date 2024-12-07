<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Gambar - Modern Design</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Simplified Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
    <div class="flex-1 min-h-screen ml-64 bg-white">
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
            <form action="<?= BASEURL; ?>/galleries/uploadImg" method="POST" enctype="multipart/form-data"
                  id="uploadForm" name="confirmUpload" class="max-w-7xl mx-auto"
                  onsubmit="return disableSubmitButton();">
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
                                    <input type="file" name="image" id="fileInput" class="hidden" accept="image/*"
                                           required>
                                    <div class="absolute inset-0 flex flex-col items-center justify-center transform group-hover:-translate-y-2 transition-all duration-300">
                                        <div class="w-20 h-20 mb-6 rounded-full bg-red-50 flex items-center justify-center group-hover:bg-red-100 transition-all duration-300">
                                            <svg class="w-10 h-10 text-red-400" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
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
                                <label class="block text-sm font-medium text-gray-600">Topik Penelitian</label>
                                <select name="category" required
                                        class="w-full px-4 py-3 bg-gray-50 border-2 border-red-50 rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300">
                                    <option value="">Pilih Kategori</option>
                                    <option value="event">Event</option>
                                    <option value="research">Penelitian</option>
                                    <option value="facility">Fasilitas</option>
                                    <option value="other">Lainnya</option>
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-600">Judul Gambar</label>
                                <input type="text" name="imageTitle" required
                                       class="w-full px-4 py-3 bg-gray-50 border-2 border-red-50 rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300"
                                       placeholder="Masukkan judul gambar">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-600">Deskripsi</label>
                                <textarea name="description" required
                                          class="w-full px-4 py-3 bg-gray-50 border-2 border-red-50 rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300 h-32"
                                          placeholder="Masukkan deskripsi gambar"></textarea>
                            </div>

                            <button type="submit" id="uploadButton"
                                    class="w-full px-6 py-4 bg-red-500 text-white rounded-xl hover:bg-red-600 transform hover:-translate-y-1 transition-all duration-300">
                                Upload Gambar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>
    <!-- Modal Konfirmasi -->
    <div id="confirmModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-semibold mb-4 text-red-800">Konfirmasi Upload</h2>
            <p class="text-gray-600">Apakah Anda yakin ingin mengunggah gambar ini?</p>
            <div class="mt-6 flex justify-end space-x-4">
                <button id="cancelButton" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    Batal
                </button>
                <button id="confirmUploadButton" class="px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600">
                    Upload
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('uploadForm');
        const fileInput = document.getElementById('fileInput');
        const uploadButton = document.getElementById('uploadButton');
        const confirmModal = document.getElementById('confirmModal');
        const cancelButton = document.getElementById('cancelButton');
        const confirmUploadButton = document.getElementById('confirmUploadButton');
        const previewContainer = document.getElementById('imagePreview');
        const dropZone = document.querySelector('.upload-zone');

        // Event listeners
        fileInput.addEventListener('change', handleFileSelect);
        uploadButton.addEventListener('click', handleUploadButtonClick);
        cancelButton.addEventListener('click', () => confirmModal.classList.add('hidden'));
        confirmUploadButton.addEventListener('click', submitForm);

        // Drag and drop event listeners
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults);
        });
        dropZone.addEventListener('dragenter', highlight);
        dropZone.addEventListener('dragover', highlight);
        dropZone.addEventListener('dragleave', unhighlight);
        dropZone.addEventListener('drop', handleDrop);

        // Fungsi untuk mencegah aksi default (drag dan drop)
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        // Highlight tampilan saat file di-drag
        function highlight() {
            dropZone.classList.add('border-red-500', 'bg-red-50');
        }

        // Menghapus highlight tampilan saat drag selesai
        function unhighlight() {
            dropZone.classList.remove('border-red-500', 'bg-red-50');
        }

        // Fungsi saat file di-drop ke area
        function handleDrop(e) {
            unhighlight();
            const files = e.dataTransfer.files;
            handleFiles(files);
        }

        // Fungsi untuk menangani file dari input file
        function handleFileSelect(e) {
            handleFiles(e.target.files);
        }

        // Fungsi untuk memproses file
        function handleFiles(files) {
            previewContainer.innerHTML = ''; // Clear existing previews
            [...files].forEach((file) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const preview = createPreviewElement(e.target.result, file.name);
                        previewContainer.appendChild(preview);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Fungsi untuk membuat elemen preview gambar
        function createPreviewElement(src, filename) {
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

        // Fungsi yang dipanggil saat tombol upload diklik
        function handleUploadButtonClick(e) {
            e.preventDefault();

            // Ambil nilai input
            const title = document.querySelector('input[name="imageTitle"]').value.trim();
            const category = document.querySelector('select[name="category"]').value.trim();
            const description = document.querySelector('textarea[name="description"]').value.trim();
            const file = fileInput.files[0];

            // Validasi input
            if (!file) {
                alert('Silakan pilih file gambar untuk diunggah.');
                return;
            }
            if (!title) {
                alert('Silakan masukkan judul gambar.');
                return;
            }
            if (!category) {
                alert('Silakan pilih kategori.');
                return;
            }
            if (!description) {
                alert('Silakan masukkan deskripsi gambar.');
                return;
            }

            // Tampilkan modal konfirmasi
            confirmModal.classList.remove('hidden');
        }

        // Fungsi untuk mengirimkan form setelah konfirmasi
        function submitForm() {
            const formData = new FormData();
            const file = fileInput.files[0];
            const title = document.querySelector('input[name="imageTitle"]').value.trim();
            const category = document.querySelector('select[name="category"]').value.trim();
            const description = document.querySelector('textarea[name="description"]').value.trim();

            formData.append('image', file);
            formData.append('imageTitle', title);
            formData.append('category', category);
            formData.append('description', description);

            // Nonaktifkan tombol upload
            uploadButton.disabled = true;
            uploadButton.textContent = 'Uploading...';

            // Kirim data ke server
            fetch('<?=BASEURL;?>/galleries/uploadImg', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Upload berhasil!');
                        window.location.href = '<?=BASEURL;?>/galleries/uploadImgView';
                    } else {
                        alert(`Upload gagal: ${data.message}`);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengunggah.');
                })
                .finally(() => {
                    uploadButton.disabled = false;
                    uploadButton.textContent = 'Upload Gambar';
                });
        }
    });

</script>
</body>
</html>