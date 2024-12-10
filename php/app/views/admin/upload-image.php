<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Gambar - Modern Design</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

        .alert-show {
            opacity: 1 !important;
            transform: translateY(0) !important;
            pointer-events: auto !important;
        }

        .alert-hide {
            opacity: 0 !important;
            transform: translateY(-100%) !important;
            pointer-events: none !important;
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
                                    <option value="">Pilih Skema Penelitian</option>
                                    <option value="DIPA SWADANA">DIPA SWADANA</option>
                                    <option value="DIPA PNBP">DIPA PNBP</option>
                                    <option value="Tesis Magister">Tesis Magister</option>
                                </select>
<!--                                --><?php //echo '<select name="category" required class="w-full px-4 py-3 bg-gray-50 border-2 border-red-50 rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300">';
//                                echo '<option value="">Pilih Skema Penelitian</option>';
//                                foreach ($categories as $category) {
//                                    echo "<option value=\"{$category['category_name']}\">{$category['category_name']}</option>";
//                                }
//                                echo '</select>';
//                                ?>
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
     class="fixed top-4 right-4 max-w-md w-full opacity-0 transform translate-y-[-100%] transition-all duration-300 ease-out pointer-events-none">
</div>

<!-- Add this modal HTML before the closing body tag -->
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
            <p class="text-gray-600 mb-6">Apakah Anda yakin ingin mengunggah gambar ini?</p>
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

<script>
    $(document).ready(function () {
        const $form = $('#uploadForm');
        const $fileInput = $('#fileInput');
        const $uploadButton = $('#uploadButton');
        const $confirmModal = $('#confirmModal');
        const $cancelButton = $('#cancelButton');
        const $confirmUploadButton = $('#confirmUploadButton');
        const $previewContainer = $('#imagePreview');
        const $dropZone = $('.upload-zone');

        // Event listeners
        $fileInput.on('change', handleFileSelect);
        $uploadButton.on('click', handleUploadButtonClick);
        $cancelButton.on('click', () => $confirmModal.addClass('hidden'));
        $confirmUploadButton.on('click', submitForm);

        // Drag and drop event listeners
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            $dropZone.on(eventName, preventDefaults);
        });
        $dropZone.on('dragenter dragover', highlight);
        $dropZone.on('dragleave drop', unhighlight);
        $dropZone.on('drop', handleDrop);

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function highlight() {
            $dropZone.addClass('border-red-500 bg-red-50');
        }

        function unhighlight() {
            $dropZone.removeClass('border-red-500 bg-red-50');
        }

        function handleDrop(e) {
            unhighlight();
            const files = e.originalEvent.dataTransfer.files;
            handleFiles(files);
        }

        function handleFileSelect(e) {
            handleFiles(e.target.files);
        }

        function handleFiles(files) {
            $previewContainer.empty(); // Clear existing previews
            $.each(files, (i, file) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const preview = createPreviewElement(e.target.result, file.name);
                        $previewContainer.append(preview);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        function createPreviewElement(src, filename) {
            const $div = $('<div>', {class: 'preview-image relative rounded-lg overflow-hidden'});
            $div.html(`
            <img src="${src}" alt="${filename}" class="w-full h-48 object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                <p class="text-white text-sm px-4 text-center">${filename}</p>
            </div>
        `);
            return $div;
        }

        function handleUploadButtonClick(e) {
            e.preventDefault();

            const title = $('input[name="imageTitle"]').val().trim();
            const category = $('select[name="category"]').val().trim();
            const description = $('textarea[name="description"]').val().trim();
            const file = $fileInput[0].files[0];

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

            $confirmModal.removeClass('hidden');
        }

        function submitForm() {
            const formData = new FormData();
            const image = $fileInput[0].files[0];
            const title = $('input[name="imageTitle"]').val().trim();
            const category = $('select[name="category"]').val().trim();
            const description = $('textarea[name="description"]').val().trim();

            formData.append('image', image);
            formData.append('imageTitle', title);
            formData.append('category', category);
            formData.append('description', description);
            formData.append('confirmUpload', 'true');

            $uploadButton.prop('disabled', true).text('Uploading...');

            $.ajax({
                url: '<?=BASEURL;?>/galleries/uploadImg',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    alert('Upload berhasil!');
                    window.location.href = '<?=BASEURL;?>/galleries/uploadImgView';

                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengunggah.');
                },
                complete: function () {
                    $uploadButton.prop('disabled', false).text('Upload Gambar');
                }
            });
        }
    });

    // Update the form submission handling
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('uploadForm');
        const uploadButton = document.getElementById('uploadButton');
        const confirmModal = document.getElementById('confirmModal');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate form fields
            const title = document.querySelector('input[name="imageTitle"]').value.trim();
            const category = document.querySelector('select[name="category"]').value.trim();
            const description = document.querySelector('textarea[name="description"]').value.trim();
            const file = document.querySelector('input[type="file"]').files[0];

            if (!file) {
                showAlert('Silakan pilih file gambar untuk diunggah.', 'error');
                return;
            }
            if (!title) {
                showAlert('Silakan masukkan judul gambar.', 'error');
                return;
            }
            if (!category) {
                showAlert('Silakan pilih kategori.', 'error');
                return;
            }
            if (!description) {
                showAlert('Silakan masukkan deskripsi gambar.', 'error');
                return;
            }

            // Show confirmation modal
            confirmModal.classList.remove('hidden');
        });

        // Handle confirmation button click
        document.getElementById('confirmButton').addEventListener('click', function() {
            const formData = new FormData(form);
            
            // Hide modal
            confirmModal.classList.add('hidden');
            
            // Show loading state
            uploadButton.disabled = true;
            uploadButton.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Mengunggah...
            `;

            fetch('<?=BASEURL;?>/galleries/uploadImg', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showAlert('Gambar berhasil diunggah!', 'success');
                    form.reset();
                    if (document.getElementById('imagePreview')) {
                        document.getElementById('imagePreview').innerHTML = '';
                    }
                    // Optional: redirect after successful upload
                    setTimeout(() => {
                        window.location.href = '<?=BASEURL;?>/galleries/uploadImgView';
                    }, 2000);
                } else {
                    throw new Error(data.message || 'Gagal mengunggah gambar');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert(error.message || 'Terjadi kesalahan saat mengunggah.', 'error');
            })
            .finally(() => {
                uploadButton.disabled = false;
                uploadButton.innerHTML = 'Upload Gambar';
            });
        });

        // Handle cancel button click
        document.getElementById('cancelButton').addEventListener('click', function() {
            confirmModal.classList.add('hidden');
        });
    });

    function showAlert(message, type = 'success') {
        const alertMessage = document.getElementById('alertMessage');
        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        const icon = type === 'success'
            ? `<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
               </svg>`
            : `<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
               </svg>`;

        alertMessage.innerHTML = `
            <div class="shadow-lg rounded-2xl overflow-hidden ${bgColor}">
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
            </div>
        `;

        alertMessage.classList.remove('hidden', 'alert-hide');
        void alertMessage.offsetWidth; // Force reflow
        alertMessage.classList.add('alert-show');

        setTimeout(closeAlert, 5000);
    }

    function closeAlert() {
        const alertMessage = document.getElementById('alertMessage');
        alertMessage.classList.remove('alert-show');
        alertMessage.classList.add('alert-hide');
        setTimeout(() => {
            alertMessage.classList.add('hidden');
        }, 300);
    }
</script>
</body>
</html>