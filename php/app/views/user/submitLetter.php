<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Surat - IsFor PRI</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/docx@7.1.0/dist/docx.js"></script>
    <style>
        /* Simplified Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }

        .form-input:focus {
            border-color: #ef4444;
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-white">
<div class="flex">
    <?php include '../app/views/assets/components/UserDashboard/sidebar.php'; ?>
    <div class="flex-1 min-h-screen ml-64 bg-white">
        <main class="py-10 px-8">
            <!-- Swiss-inspired Header -->
            <div class="max-w-7xl mx-auto mb-12 fade-in">
                <div class="flex items-center space-x-4 mb-4">
                    <span class="h-px w-12 bg-red-600"></span>
                    <span class="text-red-600 font-medium">Pengajuan</span>
                </div>
                <h1 class="text-5xl font-bold text-red-900 mb-2">Surat Rekomendasi</h1>
            </div>

            <!-- Form Section -->
            <form action="<?= BASEURL ?>/letter/sendletter" method="POST" id="letterForm" class="max-w-7xl mx-auto">
                <div class="grid grid-cols-12 gap-8">
                    <!-- Left Column -->
                    <div class="col-span-8">
                        <section class="bg-white rounded-2xl border-2 border-red-100 overflow-hidden fade-in mb-8">
                            <div class="p-6 border-b border-red-100">
                                <h2 class="text-xl font-semibold text-red-800">Detail Penelitian</h2>
                            </div>
                            <div class="p-8 space-y-6">
                                <!-- Research Title -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-600">Judul Penelitian</label>
                                    <input type="text" id="researchTitle" name="researchTitle" required
                                           class="w-full px-4 py-3 bg-gray-50 border-2 border-red-50 rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300"
                                           placeholder="Masukkan judul penelitian">
                                </div>

                                <!-- Lead Researcher -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-600">Ketua Peneliti</label>
                                    <input type="text" id="leadResearcher" name="leadResearcher" required
                                           class="w-full px-4 py-3 bg-gray-50 border-2 border-red-50 rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300"
                                           placeholder="Nama ketua peneliti">
                                </div>

                                <!-- Research Topic -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-600">Topik Riset</label>
                                    <input type="text" id="researchTopic" name="researchTopic" required
                                           class="w-full px-4 py-3 bg-gray-50 border-2 border-red-50 rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300"
                                           placeholder="Masukkan topik riset">
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Right Column -->
                    <div class="col-span-4">
                        <div class="sticky top-8 bg-white rounded-2xl p-8 border-2 border-red-100 space-y-6">
                            <input type="hidden" name="user_id" value="<?= $_SESSION["user_id"] ?>">
                            <input type="hidden" name="letterType" value="research_recommendation">

                            <!-- Research Scheme -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-600">Skema Penelitian</label>
                                <select id="researchScheme" name="researchScheme" required
                                        class="w-full px-4 py-3 bg-gray-50 border-2 border-red-50 rounded-xl focus:border-red-300 focus:ring-0 transition-all duration-300">
                                    <option value="">Pilih Skema Penelitian</option>
                                    <option value="DIPA SWADANA">DIPA SWADANA</option>
                                    <option value="DIPA PNBP">DIPA PNBP</option>
                                    <option value="Tesis Magister">Tesis Magister</option>
                                </select>
                            </div>

                            <!-- Research Center -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-600">Pusat Riset</label>
                                <input type="text" id="researchCenter" name="researchCenter"
                                       value="Pusat Riset iSFor" readonly
                                       class="w-full px-4 py-3 bg-gray-50 border-2 border-red-50 rounded-xl text-gray-500">
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3 pt-4">
                                <!-- Preview Button -->
                                <button type="button" onclick="previewLetter()"
                                        class="w-full px-6 py-4 bg-white text-red-600 border-2 border-red-200 rounded-xl 
                                               hover:bg-red-50 hover:border-red-300 transform hover:-translate-y-1 
                                               transition-all duration-300 flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <span>Preview Surat</span>
                                </button>

                                <!-- Submit Button -->
                                <button type="submit"
                                        class="w-full px-6 py-4 bg-red-500 text-white rounded-xl 
                                               hover:bg-red-600 transform hover:-translate-y-1 
                                               transition-all duration-300 flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Ajukan Surat</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>
</div>

<script>
    function previewLetter() {
        const formData = new FormData(document.getElementById('letterForm'));

        fetch('<?= BASEURL ?>/letter/previewletter', {
            method: 'POST',
            body: formData
        })
            .then(response => response.blob())
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                window.open(url, '_blank');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat preview surat');
            });
    }
</script>
</body>
</html>