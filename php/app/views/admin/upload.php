<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Gambar - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .upload-area {
            border: 2px dashed #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .upload-area.dragover {
            border-color: #3b82f6;
            background-color: #eff6ff;
        }

        .preview-image {
            transition: all 0.3s ease;
        }

        .preview-image:hover .delete-button {
            opacity: 1;
        }

        .delete-button {
            opacity: 0;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50">

    <div class="ml-64 p-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Upload Gambar</h1>
                <p class="text-gray-600">Upload gambar untuk galeri dan hasil penelitian</p>
            </div>

            <!-- Upload Form -->
            <form action="<?= BASEURL; ?>/admin/processUpload" method="POST" enctype="multipart/form-data" class="space-y-6">
                <!-- Drag & Drop Area -->
                <div class="upload-area p-8 rounded-lg text-center cursor-pointer" id="dropZone">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    <p class="text-gray-600 mb-2">Drag and drop gambar disini atau</p>
                    <button type="button" class="text-blue-600 font-medium hover:text-blue-700" onclick="document.getElementById('fileInput').click()">
                        Pilih File
                    </button>
                    <input type="file" id="fileInput" name="images[]" multiple accept="image/*" class="hidden" onchange="handleFiles(this.files)">
                </div>

                <!-- Preview Area -->
                <div id="previewArea" class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <!-- Preview images will be inserted here -->
                </div>

                <!-- Upload Details -->
                <div class="bg-white p-6 rounded-lg shadow-sm space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="gallery">Galeri</option>
                            <option value="research">Hasil Penelitian</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                        <input type="text" name="title" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Upload Gambar
                </button>
            </form>
        </div>
    </div>

    <script>
        const dropZone = document.getElementById('dropZone');
        const previewArea = document.getElementById('previewArea');

        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        // Highlight drop zone when item is dragged over it
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        
    </script>
</body>
</html>
