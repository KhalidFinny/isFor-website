<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Gambar - IsFor PRI</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/IsFor-Website/App/public/assets/css/styles.css">
    <style>
        /* Atur modal untuk tampil di atas overlay */
        #confirmationModal {
            z-index: 50; /* Modal memiliki z-index lebih tinggi */
        }

        #confirmationModal .bg-black {
            z-index: 40; /* Overlay memiliki z-index lebih rendah */
        }

        /* Pastikan modal berada di tengah layar */
        #confirmationModal .flex {
            z-index: 50;
        }
    </style>

</head>
<body class="bg-gray-50">
<div class="flex">
    <?php include '../app/views/assets/components/UserDashboard/sidebar.php'; ?>

    <div class="flex-1 min-h-screen ml-64">
        <main class="py-10 px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="text-center mb-12">
                        <span class="inline-block px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-sm font-medium mb-4">
                            Pengajuan
                        </span>
                    <h1 class="text-4xl font-bold text-blue-900">
                        Upload File
                    </h1>
                </div>
                <!-- Form Section -->
                <div class="bg-white rounded-2xl border-2 border-blue-100 p-8">
                    <form id="uploadForm" action="<?= BASEURL; ?>/researchoutput/uploadFile" method="POST"
                          enctype="multipart/form-data">
                        <div class="space-y-6">
                            <!-- Judul Gambar -->
                            <div>
                                <label for="fileTitle" class="block text-sm font-medium text-gray-700 mb-2">
                                    Judul File
                                </label>
                                <input type="text" id="fileTitle" name="fileTitle" required
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Masukkan judul file">
                            </div>

                            <!-- Kategori -->
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kategori
                                </label>
                                <select id="category" name="category" required
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Kategori</option>
                                    <option value="event">Event</option>
                                    <option value="research">Penelitian</option>
                                    <option value="facility">Fasilitas</option>
                                    <option value="other">Lainnya</option>
                                </select>
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    Deskripsi
                                </label>
                                <textarea id="description" name="description" rows="4" required
                                          class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                          placeholder="Jelaskan secara singkat tentang file yang diupload"></textarea>
                            </div>

                            <!-- Image Upload -->
                            <div>
                                <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                                    Unggah File
                                </label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                             viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="file-upload"
                                                   class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Upload a file</span>
                                                <input id="file-upload" name="file" type="file"
                                                       accept=".pdf,.jpg,.jpeg,.png,.gif,.doc,.docx,.xlsx"
                                                       class="sr-only" required>
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, GIF up to 5MB
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Preview Modal -->
                            <div id="filePreview" class="hidden">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Preview
                                </label>
                                <img id="previewImage" src="#" alt="Preview Gambar"
                                     class="max-w-full h-auto rounded-lg hidden">
                                <p id="previewText" class="text-gray-700 text-sm mt-2 hidden"></p>
                            </div>


                            <!-- Submit Button -->
                            <div class="flex justify-end">
                                <button type="submit"
                                        class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Upload File
                                </button>
                            </div>
                        </div>
                    </form>
                    <div id="responseMessage" class="mt-4 text-sm"></div>
                </div>
            </div>
        </main>
    </div>
    <div id="confirmationModal" class="hidden fixed z-10 inset-0">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <!-- Modal Content -->
        <div class="flex items-center justify-center min-h-screen px-4 relative z-50">
            <div class="bg-white rounded-lg shadow-xl p-6 max-w-sm mx-auto">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi</h2>
                <p class="text-sm text-gray-600 mb-6">
                    Apakah Anda yakin ingin mengunggah file ini?
                </p>
                <div class="flex justify-end space-x-4">
                    <button id="cancelButton"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                        Batal
                    </button>
                    <button id="confirmButton"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Oke
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Konfirmasi -->
<script>
    // Image preview functionality
    document.getElementById('file-upload').addEventListener('change', function (e) {
        const file = e.target.files[0]; // Ambil file yang dipilih
        const filePreview = document.getElementById('filePreview'); // Kontainer preview
        const previewImage = document.getElementById('previewImage'); // Elemen gambar
        const previewText = document.getElementById('previewText'); // Elemen teks

        if (file) {
            const fileType = file.type;

            // Reset tampilan modal
            previewImage.classList.add('hidden');
            previewText.classList.add('hidden');
            filePreview.classList.remove('hidden');

            if (fileType.startsWith('image/')) {
                // Jika file adalah gambar
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden'); // Tampilkan gambar
                };
                reader.readAsDataURL(file);
            } else {
                // Jika file bukan gambar
                previewText.textContent = `Nama file: ${file.name}`;
                previewText.classList.remove('hidden'); // Tampilkan teks
            }
        }
    });
    document.getElementById('uploadForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const form = new FormData(this);
        const responseMessage = document.getElementById('responseMessage');
        let isValid = true;

        // Validasi field
        const fields = [
            {id: 'fileTitle', message: 'Judul file wajib diisi.'},
            {id: 'category', message: 'Kategori wajib dipilih.'},
            {id: 'description', message: 'Deskripsi wajib diisi.'},
            {id: 'file-upload', message: 'File wajib diunggah.'},
        ];

        // Reset peringatan
        fields.forEach(field => {
            const input = document.getElementById(field.id);
            const error = document.getElementById(`${field.id}-error`);
            if (error) error.textContent = ''; // Reset pesan error

            if (!form.get(field.id)) {
                isValid = false;
                if (error) {
                    error.textContent = field.message; // Tampilkan pesan error
                } else {
                    const errorMsg = document.createElement('p');
                    errorMsg.id = `${field.id}-error`;
                    errorMsg.textContent = field.message;
                    errorMsg.className = 'text-red-600 text-sm mt-1';
                    input.parentElement.appendChild(errorMsg);
                }
            }
        });

        if (!isValid) return; // Jangan kirim form jika ada error

        fetch('<?= BASEURL; ?>/researchoutput/uploadFile', {
            method: 'POST',
            body: form
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    responseMessage.textContent = data.message;
                    responseMessage.className = 'text-green-600';
                } else {
                    responseMessage.textContent = data.message;
                    responseMessage.className = 'text-red-600';
                }
            })
            .catch(error => {
                responseMessage.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                responseMessage.className = 'text-red-600';
            });
    });

    const form = document.getElementById('uploadForm');
    const confirmationModal = document.getElementById('confirmationModal');
    const cancelButton = document.getElementById('cancelButton');
    const confirmButton = document.getElementById('confirmButton');
    const responseMessage = document.getElementById('responseMessage');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        let isValid = true;

        // Validasi field
        ['fileTitle', 'category', 'description', 'file-upload'].forEach(fieldId => {
            const field = document.getElementById(fieldId);
            const error = document.getElementById(`${fieldId}-error`);
            if (error) error.remove(); // Hapus pesan error sebelumnya

            if (!field.value || field.value === '') {
                isValid = false;
                const errorMsg = document.createElement('p');
                errorMsg.id = `${fieldId}-error`;
                errorMsg.textContent = `${field.name || 'Field'} wajib diisi.`;
                errorMsg.className = 'text-red-600 text-sm mt-1';
                field.parentElement.appendChild(errorMsg);
            }
        });

        if (isValid) {
            // Tampilkan modal jika validasi lolos
            confirmationModal.classList.remove('hidden');
        }
    });

    // Jika pengguna membatalkan
    cancelButton.addEventListener('click', () => {
        confirmationModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });

    // Jika pengguna mengonfirmasi
    confirmButton.addEventListener('click', () => {
        confirmationModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');

        // Kirim data setelah konfirmasi
        const formData = new FormData(form);

        fetch('<?= BASEURL; ?>/researchoutput/uploadFile', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                responseMessage.textContent = data.message;
                responseMessage.className = data.success ? 'text-green-600' : 'text-red-600';

                if (data.success) {
                    form.reset(); // Reset form jika berhasil
                }
            })
            .catch(error => {
                responseMessage.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                responseMessage.className = 'text-red-600';
            });
    });


</script>
</body>
</html>