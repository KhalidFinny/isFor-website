<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File - IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS; ?>/user/upload-file.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Mobile responsive adjustments */
        @media (max-width: 768px) {
            .page-container {
                margin-left: 0 !important;
            }

            .main-content {
                padding: 1rem;
            }

            .header-section h1 {
                font-size: 2rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .upload-section {
                padding: 1rem;
            }

            .upload-zone {
                height: 200px;
            }

            .upload-button {
                padding: 0.75rem;
                font-size: 0.875rem;
            }

            .preview-section {
                padding: 1rem;
            }

            .form-sidebar {
                position: static;
                padding: 1rem;
            }

            .form-input {
                padding: 0.75rem;
            }

            .submit-button {
                padding: 0.75rem;
            }

            .modal-content {
                width: 90%;
                padding: 1rem;
            }
        }

        /* Desktop styles */
        @media (min-width: 769px) {
            .page-container {
                margin-left: 16rem;
            }
        }
    </style>
</head>

<body class="bg-white">
    <div class="flex">
        <?php include '../app/views/assets/components/UserDashboard/sidebar.php'; ?>
        <div class="flex-1 min-h-screen page-container bg-white">
            <main class="main-content py-6 pt-20 md:py-10 px-4 md:px-8">
                <div class="max-w-7xl mx-auto mb-6 md:mb-12">
                    <a href="<?= BASEURL ?>/dashboardAdmin"
                        class="inline-flex items-center space-x-2 text-red-500 hover:text-red-600 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Kembali</span>
                    </a>
                </div>

                <!-- Swiss-inspired Header -->
                <div class="max-w-7xl mx-auto mb-6 md:mb-12 fade-in">
                    <div class="flex items-center space-x-4 mb-4">
                        <span class="h-px w-12 bg-red-600"></span>
                        <span class="text-red-600 font-medium">Pengajuan</span>
                    </div>
                    <h1 class="text-3xl md:text-5xl font-bold text-red-900 mb-2">Upload File</h1>
                </div>

                <!-- Upload Form -->
                <form action="<?= BASEURL; ?>/researchoutput/uploadFile" method="POST" enctype="multipart/form-data"
                    id="uploadForm" class="max-w-7xl mx-auto">
                    <div class="form-grid grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-8">
                        <!-- Left Column -->
                        <div class="md:col-span-8">
                            <!-- Upload Section -->
                            <section class="upload-section bg-white rounded-xl md:rounded-2xl border-2 border-red-100 overflow-hidden fade-in mb-6 md:mb-8">
                                <div class="p-4 md:p-6 border-b border-red-100">
                                    <h2 class="text-lg md:text-xl font-semibold text-red-800">Area Unggah</h2>
                                </div>
                                <div class="p-4 md:p-8">
                                    <div class="upload-zone group h-48 md:h-72 border-2 border-dashed border-red-200 rounded-lg md:rounded-xl relative">
                                        <input type="file" id="file-upload" name="file" class="hidden">
                                        <div class="absolute inset-0 flex flex-col items-center justify-center transform group-hover:-translate-y-2 transition-all duration-300">
                                            <div class="w-16 h-16 md:w-20 md:h-20 mb-4 md:mb-6 rounded-full bg-red-50 flex items-center justify-center group-hover:bg-red-100 transition-all duration-300">
                                                <!-- File Icon -->
                                                <svg class="w-8 h-8 md:w-10 md:h-10 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div class="space-y-3 pt-4">
                                                <!-- Preview Button -->
                                                <button type="button" onclick="document.getElementById('file-upload').click()"
                                                    class="upload-button w-full px-4 py-2 md:px-6 md:py-4 bg-white text-red-600 border-2 border-red-200 rounded-lg md:rounded-xl
                                                           hover:bg-red-50 hover:border-red-300 transform hover:-translate-y-1
                                                           transition-all duration-300 flex items-center justify-center space-x-2">
                                                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                    </svg>
                                                    <span class="text-sm md:text-base">Pilih File</span>
                                                </button>
                                            </div>
                                            <p class="mt-2 md:mt-4 text-xs md:text-sm text-gray-400">atau drag & drop file Anda di sini</p>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- Preview Section -->
                            <div id="filePreview" class="hidden bg-white rounded-xl md:rounded-2xl border-2 border-red-100 p-4 md:p-6 mt-6 md:mt-8">
                                <h3 class="text-base md:text-lg font-semibold text-red-800 mb-3 md:mb-4">Preview File</h3>
                                <div class="bg-red-50 rounded-lg md:rounded-xl p-3 md:p-4">
                                    <div class="flex items-start space-x-3 md:space-x-4">
                                        <!-- File Icon -->
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-red-100 flex items-center justify-center">
                                                <svg class="w-5 h-5 md:w-6 md:h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        </div>

                                        <!-- File Info -->
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm md:text-base font-medium text-red-900" id="fileName">filename.pdf</p>
                                            <p class="text-xs md:text-sm text-red-500" id="fileSize">0 MB</p>

                                            <!-- Progress Bar -->
                                            <div class="mt-2 w-full bg-red-200 rounded-full h-2">
                                                <div id="uploadProgress"
                                                    class="bg-red-500 h-2 rounded-full transition-all duration-300"
                                                    style="width: 0%">
                                                </div>
                                            </div>
                                            <p class="text-xs text-red-400 mt-1" id="uploadStatus">Menunggu upload...</p>
                                        </div>

                                        <!-- Remove Button -->
                                        <button type="button" onclick="removeFile()"
                                            class="flex-shrink-0 text-red-400 hover:text-red-600 transition-colors">
                                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="md:col-span-4">
                            <div class="form-sidebar bg-white rounded-xl md:rounded-2xl p-4 md:p-8 border-2 border-red-100 space-y-4 md:space-y-6 md:sticky md:top-8">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-600">Judul File</label>
                                    <input type="text" id="fileTitle" name="fileTitle" required
                                        class="form-input w-full px-3 py-2 md:px-4 md:py-3 bg-white border-2 border-red-50 rounded-lg md:rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300"
                                        placeholder="Masukkan judul file">
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-600">Skema Penelitian</label>
                                    <select id="category" name="category" required
                                        class="form-input w-full px-3 py-2 md:px-4 md:py-3 bg-white border-2 border-red-50 rounded-lg md:rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300 hover:bg-red-50">
                                        <option value="">Pilih Skema Penelitian</option>
                                        <option value="DIPA SWADANA">DIPA SWADANA</option>
                                        <option value="DIPA PNBP">DIPA PNBP</option>
                                        <option value="Tesis Magister">Tesis Magister</option>
                                    </select>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-600">Deskripsi</label>
                                    <textarea id="description" name="description" required
                                        class="form-input w-full px-3 py-2 md:px-4 md:py-3 bg-white border-2 border-red-50 rounded-lg md:rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300 h-24 md:h-32"
                                        placeholder="Masukkan deskripsi file"></textarea>
                                </div>

                                <button type="submit" id="uploadButton"
                                    class="submit-button w-full px-4 py-2 md:px-6 md:py-4 bg-red-500 text-white rounded-lg md:rounded-xl hover:bg-red-600 transform hover:-translate-y-1 transition-all duration-300">
                                    Upload File
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div id="modalContent" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
                                 bg-white rounded-xl md:rounded-2xl p-6 md:p-8 w-11/12 md:w-96 opacity-0 scale-95 
                                 transition-all duration-300">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-10 w-10 md:h-12 md:w-12 rounded-full bg-red-100 mb-3 md:mb-4">
                    <svg class="h-5 w-5 md:h-6 md:w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h2 class="text-xl md:text-2xl font-semibold text-red-800 mb-2">Konfirmasi Upload</h2>
                <p class="text-gray-600 mb-4 md:mb-6">Apakah Anda yakin ingin mengunggah file ini?</p>
                <div class="flex justify-center space-x-2 md:space-x-3">
                    <button id="cancelButton"
                        class="px-4 py-2 md:px-6 md:py-3 bg-white text-red-600 border-2 border-red-200 rounded-lg md:rounded-xl
                               hover:bg-red-50 hover:border-red-300 transform hover:-translate-y-1 
                               transition-all duration-300">
                        Batal
                    </button>
                    <button id="confirmButton"
                        class="px-4 py-2 md:px-6 md:py-3 bg-red-500 text-white rounded-lg md:rounded-xl hover:bg-red-600
                               transform hover:-translate-y-1 transition-all duration-300">
                        Upload
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    <div id="alertMessage"
        class="hidden fixed top-2 md:top-4 right-2 md:right-4 max-w-xs md:max-w-md w-full shadow-lg rounded-xl md:rounded-2xl overflow-hidden transform transition-all duration-300 translate-y-[-100%]">
    </div>

    <script>
        // File preview functionality
        document.getElementById('file-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                updateFilePreview(file);
            }
        });

        // Form submission and modal handling
        const form = document.getElementById('uploadForm');
        const modal = document.getElementById('confirmationModal');
        const modalContent = document.getElementById('modalContent');
        const cancelButton = document.getElementById('cancelButton');
        const confirmButton = document.getElementById('confirmButton');
        const uploadButton = document.getElementById('uploadButton');

        // Show modal on form submit
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validate form fields
            const fileTitle = document.getElementById('fileTitle').value.trim();
            const category = document.getElementById('category').value.trim();
            const description = document.getElementById('description').value.trim();
            const file = document.getElementById('file-upload').files[0];

            if (!file) {
                showAlert('Silakan pilih file untuk diunggah.', 'error');
                return;
            }
            if (!fileTitle) {
                showAlert('Silakan masukkan judul file.', 'error');
                return;
            }
            if (!category) {
                showAlert('Silakan pilih kategori.', 'error');
                return;
            }
            if (!description) {
                showAlert('Silakan masukkan deskripsi file.', 'error');
                return;
            }

            // Show modal with animation
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('opacity-0', 'scale-95');
                modalContent.classList.add('opacity-100', 'scale-100');
            }, 50);
        });

        // Cancel button closes modal
        cancelButton.addEventListener('click', function() {
            modalContent.classList.remove('opacity-100', 'scale-100');
            modalContent.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        });

        // Handle final upload
        confirmButton.addEventListener('click', function() {
            const formData = new FormData(form);

            // Hide modal with animation
            modalContent.classList.remove('opacity-100', 'scale-100');
            modalContent.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);

            // Update button state
            uploadButton.disabled = true;
            uploadButton.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-4 w-4 md:h-5 md:w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Uploading...`;

            // Create and configure XMLHttpRequest
            const xhr = new XMLHttpRequest();
            const uploadProgress = document.getElementById('uploadProgress');
            const uploadStatus = document.getElementById('uploadStatus');

            xhr.upload.addEventListener('progress', function(e) {
                if (e.lengthComputable) {
                    const percentComplete = (e.loaded / e.total) * 100;
                    uploadProgress.style.width = percentComplete + '%';
                    uploadStatus.textContent = `Mengupload... ${Math.round(percentComplete)}%`;
                }
            });

            xhr.onload = function() {
                if (xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            uploadStatus.textContent = 'Upload berhasil!';
                            uploadProgress.style.width = '100%';
                            showAlert('File berhasil diunggah!', 'success');
                            form.reset();
                            removeFile();
                        } else {
                            uploadStatus.textContent = 'Upload gagal';
                            showAlert(response.message || 'Gagal mengunggah file.', 'error');
                        }
                    } catch (error) {
                        uploadStatus.textContent = 'Upload gagal';
                        showAlert('Terjadi kesalahan saat mengunggah.', 'error');
                    }
                } else {
                    uploadStatus.textContent = 'Upload gagal';
                    showAlert('Terjadi kesalahan saat mengunggah.', 'error');
                }

                // Reset upload button
                uploadButton.disabled = false;
                uploadButton.innerHTML = 'Upload File';
            };

            xhr.onerror = function() {
                uploadStatus.textContent = 'Upload gagal';
                showAlert('Terjadi kesalahan saat mengunggah.', 'error');
                uploadButton.disabled = false;
                uploadButton.innerHTML = 'Upload File';
            };

            xhr.open('POST', '<?= BASEURL; ?>/researchoutput/uploadFile', true);
            xhr.send(formData);
        });



        function updateFilePreview(file) {
            const preview = document.getElementById('filePreview');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');
            const uploadStatus = document.getElementById('uploadStatus');
            const uploadProgress = document.getElementById('uploadProgress');

            preview.classList.remove('hidden');
            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);
            uploadStatus.textContent = 'File siap untuk diunggah';
            uploadProgress.style.width = '0%';
        }

        function removeFile() {
            const fileInput = document.getElementById('file-upload');
            const preview = document.getElementById('filePreview');

            fileInput.value = '';
            preview.classList.add('hidden');
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function showAlert(message, type = 'success') {
            const alertElement = document.getElementById('alertMessage');
            const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
            const icon = type === 'success' ?
                `<svg class="w-5 h-5 md:w-6 md:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
               </svg>` :
                `<svg class="w-5 h-5 md:w-6 md:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
               </svg>`;

            alertElement.className = `fixed top-2 md:top-4 right-2 md:right-4 max-w-xs md:max-w-md w-full shadow-lg rounded-xl md:rounded-2xl overflow-hidden transform transition-all duration-300 ${bgColor}`;
            alertElement.innerHTML = `
            <div class="p-3 md:p-4 flex items-center">
                <div class="flex-shrink-0 text-white">
                    ${icon}
                </div>
                <div class="ml-2 md:ml-3 text-white text-sm md:text-base font-medium">${message}</div>
                <button onclick="closeAlert()" class="ml-auto text-white hover:text-gray-200">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
    </script>
</body>

</html>