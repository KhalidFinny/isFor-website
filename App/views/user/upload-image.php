<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Gambar - IsFor PRI</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/IsFor-Website/App/public/assets/css/styles.css">
</head>
<body class="bg-gray-50">
    <div class="flex">
        <?php include '../../public/assets/components/UserDashboard/sidebar.php'; ?>
        
        <div class="flex-1 min-h-screen ml-64">
            <main class="py-10 px-8">
                <div class="max-w-4xl mx-auto">
                    <!-- Header -->
                    <div class="text-center mb-12">
                        <span class="inline-block px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-sm font-medium mb-4">
                            Pengajuan
                        </span>
                        <h1 class="text-4xl font-bold text-blue-900">
                            Upload Gambar
                        </h1>
                    </div>

                    <!-- Form Section -->
                    <div class="bg-white rounded-2xl border-2 border-blue-100 p-8">
                        <form action="/IsFor-Website/App/controllers/imagecontroller.php" method="POST" enctype="multipart/form-data">
                            <div class="space-y-6">
                                <!-- Judul Gambar -->
                                <div>
                                    <label for="imageTitle" class="block text-sm font-medium text-gray-700 mb-2">
                                        Judul Gambar
                                    </label>
                                    <input type="text" id="imageTitle" name="imageTitle" required
                                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="Masukkan judul gambar">
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
                                              placeholder="Jelaskan secara singkat tentang gambar yang diupload"></textarea>
                                </div>

                                <!-- Image Upload -->
                                <div>
                                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                        Unggah Gambar
                                    </label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                    <span>Upload a file</span>
                                                    <input id="file-upload" name="image" type="file" accept="image/*" class="sr-only" required>
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                PNG, JPG, GIF up to 5MB
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Preview Image -->
                                <div id="imagePreview" class="hidden">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Preview
                                    </label>
                                    <img id="preview" src="#" alt="Preview" class="max-w-full h-auto rounded-lg">
                                </div>

                                <!-- Submit Button -->
                                <div class="flex justify-end">
                                    <button type="submit" 
                                            class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        Upload Gambar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Image preview functionality
        document.getElementById('file-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>