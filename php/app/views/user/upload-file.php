<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File - IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
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

        .form-input:focus {
            border-color: #ef4444;
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-white">
<div class="flex">
    <?php include '../app/views/assets/components/UserDashboard/sidebar.php';?>
    <div class="flex-1 min-h-screen ml-64 bg-white">
        <main class="py-10 px-8">
            <!-- Swiss-inspired Header -->
            <div class="max-w-7xl mx-auto mb-12 fade-in">
                <div class="flex items-center space-x-4 mb-4">
                    <span class="h-px w-12 bg-red-600"></span>
                    <span class="text-red-600 font-medium">Pengajuan</span>
                </div>
                <h1 class="text-5xl font-bold text-red-900 mb-2">Upload File</h1>
            </div>

            <!-- Upload Form -->
            <form action="<?=BASEURL;?>/researchoutput/uploadFile" method="POST" enctype="multipart/form-data"
                  id="uploadForm" class="max-w-7xl mx-auto">
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
                                    <input type="file" id="file-upload" name="file" class="hidden">
                                    <div class="absolute inset-0 flex flex-col items-center justify-center transform group-hover:-translate-y-2 transition-all duration-300">
                                        <div class="w-20 h-20 mb-6 rounded-full bg-red-50 flex items-center justify-center group-hover:bg-red-100 transition-all duration-300">
                                            <!-- File Icon (Changed from image icon) -->
                                            <svg class="w-10 h-10 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                      d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div class="space-y-3 pt-4">
                                            <!-- Preview Button -->
                                            <button type="button" onclick="document.getElementById('file-upload').click()"
                                                    class="w-full px-6 py-4 bg-white text-red-600 border-2 border-red-200 rounded-xl
                                                           hover:bg-red-50 hover:border-red-300 transform hover:-translate-y-1
                                                           transition-all duration-300 flex items-center justify-center space-x-2">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                </svg>
                                                <span>Pilih File</span>
                                            </button>
                                        </div>
                                        <p class="mt-4 text-sm text-gray-400">atau drag & drop file Anda di sini</p>

                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Preview Section -->
                        <div id="filePreview" class="hidden bg-white rounded-2xl border-2 border-red-100 p-6 mt-8">
                            <h3 class="text-lg font-semibold text-red-800 mb-4">Preview File</h3>
                            <div class="bg-red-50 rounded-xl p-4">
                                <div class="flex items-start space-x-4">
                                    <!-- File Icon -->
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 rounded-lg bg-red-100 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    
                                    <!-- File Info -->
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-red-900" id="fileName">filename.pdf</p>
                                        <p class="text-sm text-red-500" id="fileSize">0 MB</p>
                                        
                                        <!-- Progress Bar -->
                                        <div class="mt-2 w-full bg-red-200 rounded-full h-2.5">
                                            <div id="uploadProgress" 
                                                 class="bg-red-500 h-2.5 rounded-full transition-all duration-300" 
                                                 style="width: 0%">
                                            </div>
                                        </div>
                                        <p class="text-xs text-red-400 mt-1" id="uploadStatus">Menunggu upload...</p>
                                    </div>
                                    
                                    <!-- Remove Button -->
                                    <button type="button" onclick="removeFile()" 
                                            class="flex-shrink-0 text-red-400 hover:text-red-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-span-4">
                        <div class="sticky top-8 bg-white rounded-2xl p-8 border-2 border-red-100 space-y-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-600">Judul File</label>
                                <input type="text" id="fileTitle" name="fileTitle" required
                                       class="w-full px-4 py-3 bg-gray-50 border-2 border-red-50 rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300"
                                       placeholder="Masukkan judul file">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-600">Skema Penelitian</label>
                                <select id="category" name="category" required
                                        class="w-full px-4 py-3 bg-gray-50 border-2 border-red-50 rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300">
                                    <option value="">Pilih Skema Penelitian</option>
                                    <option value="DIPA SWADANA">DIPA SWADANA</option>
                                    <option value="DIPA PNBP">DIPA PNBP</option>
                                    <option value="Tesis Magister">Tesis Magister</option>
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-600">Deskripsi</label>
                                <textarea id="description" name="description" required
                                          class="w-full px-4 py-3 bg-gray-50 border-2 border-red-50 rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300 h-32"
                                          placeholder="Masukkan deskripsi file"></textarea>
                            </div>

                            <button type="submit" id="uploadButton"
                                    class="w-full px-6 py-4 bg-red-500 text-white rounded-xl hover:bg-red-600 transform hover:-translate-y-1 transition-all duration-300">
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
                                 bg-white rounded-2xl p-8 w-96 opacity-0 scale-95 
                                 transition-all duration-300">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-semibold text-red-800 mb-2">Konfirmasi Upload</h2>
            <p class="text-gray-600 mb-6">Apakah Anda yakin ingin mengunggah file ini?</p>
            <div class="flex justify-center space-x-3">
                <button id="cancelButton" 
                        class="px-6 py-3 bg-white text-red-600 border-2 border-red-200 rounded-xl
                               hover:bg-red-50 hover:border-red-300 transform hover:-translate-y-1 
                               transition-all duration-300">
                    Batal
                </button>
                <button id="confirmButton" 
                        class="px-6 py-3 bg-red-500 text-white rounded-xl hover:bg-red-600
                               transform hover:-translate-y-1 transition-all duration-300">
                    Upload
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Alert Messages -->
<div id="alertMessage"
     class="hidden fixed top-4 right-4 max-w-md w-full shadow-lg rounded-2xl overflow-hidden transform transition-all duration-300 translate-y-[-100%]">
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
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Uploading...
        `;

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

        // Send the request
        xhr.open('POST', '<?=BASEURL;?>/researchoutput/uploadFile', true);
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
        const icon = type === 'success'
            ? `<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
               </svg>`
            : `<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
               </svg>`;

        alertElement.className = `fixed top-4 right-4 max-w-md w-full shadow-lg rounded-2xl overflow-hidden transform transition-all duration-300 ${bgColor}`;
        alertElement.innerHTML = `
            <div class="p-4 flex items-center">
                <div class="flex-shrink-0 text-white">
                    ${icon}
                </div>
                <div class="ml-3 text-white font-medium">${message}</div>
                <button onclick="closeAlert()" class="ml-auto text-white hover:text-gray-200">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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