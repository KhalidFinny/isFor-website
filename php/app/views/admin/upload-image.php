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
    <?php include_once '../app/views/assets/components/AdminDashboard/sidebar.php';?>
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
            <form action="<?=BASEURL;?>/galleries/uploadImg" method="POST" enctype="multipart/form-data"
                  id="uploadForm" name="confirmUpload" class="max-w-7xl mx-auto" onsubmit="return disableSubmitButton();">
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
                                                class="w-half px-6 py-4 bg-white text-red-600 border-2 border-red-200 rounded-xl
                                                       hover:bg-red-50 hover:border-red-300 transform hover:-translate-y-1
                                                       transition-all duration-300 flex items-center justify-center space-x-2">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                            <span>Pilih File Gambar</span>
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
                                    class="w-full px-6 py-4 bg-red-500 text-white rounded-xl
                                           hover:bg-red-600 transform hover:-translate-y-1
                                           transition-all duration-300 flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                <span>Upload Gambar</span>
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

<!-- Alert Container -->
<div id="alertMessage" 
     class="hidden fixed top-4 right-4 max-w-md w-full shadow-lg rounded-2xl overflow-hidden transform transition-all duration-300 translate-y-[-100%]">
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


        function disableSubmitButton() {
            const uploadButton = document.getElementById('uploadButton');
            uploadButton.disabled = true;
            uploadButton.textContent = 'Uploading...';
            return true;
        }

        document.getElementById('uploadButton').addEventListener('click', () => {
            const formData = new FormData();
            const fileInput = document.getElementById('fileInput');
            const title = document.querySelector('input[name="imageTitle"]').value;
            const category = document.querySelector('select[name="category"]').value;
            const description = document.querySelector('textarea[name="description"]').value;

            if (!fileInput.files.length) {
                alert('Silakan pilih file untuk diunggah.');
                e.preventDefault();
            }

            if (fileInput.files.length > 0) {
                formData.append('image', fileInput.files[0]);
            }
            formData.append('imageTitle', title);
            formData.append('category', category);
            formData.append('description', description);

            fetch('<?=BASEURL;?>/galleries/uploadImg', {
                method: 'POST',
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert('Upload berhasil!');
                        window.location.href = '<?=BASEURL;?>/galleries/uploadImgView';
                    } else {
                        alert(`Upload gagal: ${data.message}`);
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengunggah.');
                })
                .finally(() => {
                    document.getElementById('uploadButton').disabled = false;
                });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const uploadButton = document.getElementById('uploadButton');
            uploadButton.addEventListener('click', (e) => {
                e.preventDefault(); // Mencegah submit form default

                // Ambil nilai input
                const title = document.querySelector('input[name="imageTitle"]').value.trim();
                const category = document.querySelector('select[name="category"]').value.trim();
                const description = document.querySelector('textarea[name="description"]').value.trim();
                const file = document.getElementById('fileInput').files[0];

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

                // Konfirmasi sebelum mengunggah
                const confirmation = confirm("Apakah Anda yakin ingin mengunggah gambar ini?");
                if (!confirmation) {
                    return; // Jika batal, hentikan proses
                }

                // Semua input valid, lanjutkan upload
                const formData = new FormData();
                formData.append('image', file);
                formData.append('imageTitle', title);
                formData.append('category', category);
                formData.append('description', description);

                // Nonaktifkan tombol upload saat proses berlangsung
                uploadButton.disabled = true;
                uploadButton.textContent = 'Uploading...';

                // Kirim data menggunakan fetch API
                fetch('<?=BASEURL;?>/galleries/uploadImg', {
                    method: 'POST',
                    body: formData,
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            alert('Upload berhasil!');
                            window.location.href = '<?=BASEURL;?>/galleries/uploadImgView';
                        } else {
                            alert(`Upload gagal: ${data.message}`);
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengunggah.');
                    })
                    .finally(() => {
                        uploadButton.disabled = false;
                        uploadButton.textContent = 'Upload Gambar';
                    });
            });
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('uploadForm');
        const uploadButton = document.getElementById('uploadButton');
        const confirmModal = document.getElementById('confirmModal');
        const cancelButton = document.getElementById('cancelButton');
        const confirmUploadButton = document.getElementById('confirmUploadButton');

        uploadButton.addEventListener('click', (e) => {
            e.preventDefault(); // Cegah form dari submit langsung
            confirmModal.classList.remove('hidden'); // Tampilkan modal konfirmasi
        });

        cancelButton.addEventListener('click', () => {
            confirmModal.classList.add('hidden'); // Sembunyikan modal saat dibatalkan
        });

        confirmUploadButton.addEventListener('click', () => {
            confirmModal.classList.add('hidden'); // Sembunyikan modal
            form.submit(); // Submit form jika pengguna konfirmasi
        });
    });

    // Add alert functions
    function showAlert(message, type = 'success') {
        const alertElement = document.getElementById('alertMessage');
        const bgColor = type === 'success' ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200';
        const textColor = type === 'success' ? 'text-green-600' : 'text-red-600';
        const iconColor = type === 'success' ? 'text-green-400' : 'text-red-400';

        alertElement.innerHTML = `
            <div class="max-w-md w-full ${bgColor} border-2 rounded-xl p-4 flex items-center shadow-lg">
                <div class="flex-shrink-0 ${iconColor}">
                    ${type === 'success' 
                        ? '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                        : '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                    }
                </div>
                <div class="ml-3 ${textColor} font-medium">${message}</div>
                <button onclick="closeAlert()" class="ml-auto ${textColor} hover:${textColor}">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        `;

        alertElement.style.transform = 'translateY(0)';
        alertElement.classList.remove('hidden');

        // Auto hide after 5 seconds
        setTimeout(closeAlert, 5000);
    }

    function closeAlert() {
        const alertElement = document.getElementById('alertMessage');
        alertElement.style.transform = 'translateY(-100%)';
        setTimeout(() => alertElement.classList.add('hidden'), 300);
    }

    // Update your fetch call to use the new alert system
    confirmUploadButton.addEventListener('click', () => {
        confirmModal.classList.add('hidden');
        const formData = new FormData(form);

        fetch('<?=BASEURL;?>/galleries/uploadImg', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('Gambar berhasil diunggah!', 'success');
                form.reset();
                setTimeout(() => {
                    window.location.href = '<?=BASEURL;?>/galleries/uploadImgView';
                }, 2000);
            } else {
                showAlert(data.message || 'Gagal mengunggah gambar.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan saat mengunggah.', 'error');
        })
        .finally(() => {
            uploadButton.disabled = false;
            uploadButton.textContent = 'Upload Gambar';
        });
    });
</script>
</body>
</html>