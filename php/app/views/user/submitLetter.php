<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Surat - IsFor PRI</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/docx@7.1.0/dist/docx.js"></script>
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
                        Surat Rekomendasi Pusat Riset
                    </h1>
                </div>

                <!-- Form Section -->
                <div class="bg-white rounded-2xl border-2 border-blue-100 p-8">
                    <form action="/IsFor-Website/App/controllers/lettercontroller.php" method="POST" id="letterForm">
                        <input type="hidden" name="letterType" value="research_recommendation">
                        <div class="space-y-6">
                            <!-- Research Title -->
                            <div>
                                <label for="researchTitle" class="block text-sm font-medium text-gray-700 mb-2">
                                    Judul Penelitian
                                </label>
                                <input type="text" id="researchTitle" name="researchTitle" required
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Masukkan judul penelitian">
                            </div>

                            <!-- Lead Researcher -->
                            <div>
                                <label for="leadResearcher" class="block text-sm font-medium text-gray-700 mb-2">
                                    Ketua Peneliti
                                </label>
                                <input type="text" id="leadResearcher" name="leadResearcher" required
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Nama ketua peneliti">
                            </div>

                            <!-- Research Scheme -->
                            <div>
                                <label for="researchScheme" class="block text-sm font-medium text-gray-700 mb-2">
                                    Skema Penelitian
                                </label>
                                <select id="researchScheme" name="researchScheme" required
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Skema Penelitian</option>
                                    <option value="DIPA SWADANA">DIPA SWADANA</option>
                                    <option value="DIPA PNBP">DIPA PNBP</option>
                                    <option value="Tesis Magister">Tesis Magister</option>
                                </select>
                            </div>

                            <!-- Research Center -->
                            <div>
                                <label for="researchCenter" class="block text-sm font-medium text-gray-700 mb-2">
                                    Pusat Riset
                                </label>
                                <input type="text" id="researchCenter" name="researchCenter"
                                       value="Pusat Riset iSFor" readonly
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50">
                            </div>

                            <!-- Research Topic -->
                            <div>
                                <label for="researchTopic" class="block text-sm font-medium text-gray-700 mb-2">
                                    Topik Riset
                                </label>
                                <input type="text" id="researchTopic" name="researchTopic" required
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Masukkan topik riset">
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end space-x-4">
                                <button type="button" onclick="previewLetter()"
                                        class="px-6 py-3 bg-gray-600 text-white rounded-xl hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                    Preview Surat
                                </button>
                                <button type="submit"
                                        class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Ajukan Surat
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
    function previewLetter() {
        const formData = new FormData(document.getElementById('letterForm'));

        fetch('/IsFor-Website/App/controllers/lettercontroller.php?action=preview', {
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