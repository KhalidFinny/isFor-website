<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Agenda - IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .fade-in { 
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
        }
        
        .slide-up { 
            animation: slideUp 0.5s ease-out forwards;
            opacity: 0;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { 
                opacity: 0; 
                transform: translateY(20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        .agenda-card {
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .agenda-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -10px rgba(51, 65, 85, 0.1);
        }
    </style>
</head>
<body class="bg-white">
    <div class="flex">
        <div class="flex-1 min-h-screen ml-64">
            <main class="py-10 px-8">
                <div class="max-w-7xl mx-auto">
                    <!-- Header Section -->
                    <div class="mb-8 fade-in">
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Manajemen Agenda
                        </h1>
                        <p class="mt-2 text-blue-600">Kelola agenda dan fokus penelitian pusat riset</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mb-8 flex justify-between items-center">
                        <button onclick="showAddModal()" class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 
                                transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span>Tambah Agenda</span>
                        </button>
                        
                        <button onclick="showUploadModal()" class="px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 
                                transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Upload Gambar</span>
                        </button>
                    </div>

                    <!-- Agenda List -->
                    <div class="bg-white rounded-xl border-2 border-blue-100 overflow-hidden slide-up">
                        <div class="p-6 border-b border-blue-100">
                            <div class="flex justify-between items-center">
                                <h2 class="text-xl font-bold text-blue-900">Daftar Agenda</h2>
                                <div class="relative">
                                    <input type="text" placeholder="Cari agenda..." 
                                           class="pl-10 pr-4 py-2 bg-blue-50 border-0 rounded-lg text-blue-900 placeholder-blue-400
                                                  focus:ring-2 focus:ring-blue-500">
                                    <svg class="w-5 h-5 text-blue-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 space-y-4">
                            <?php
                            $agendaTopics = [
                                [
                                    "number" => "01",
                                    "title" => "Artificial Intelligence & Machine Learning",
                                    "description" => "Pengembangan sistem cerdas dan pembelajaran mesin untuk solusi inovatif"
                                ],
                                [
                                    "number" => "02",
                                    "title" => "Internet of Things (IoT)",
                                    "description" => "Implementasi teknologi IoT untuk smart city dan industri 4.0"
                                ],
                                [
                                    "number" => "03",
                                    "title" => "Cybersecurity",
                                    "description" => "Penelitian keamanan siber dan perlindungan infrastruktur digital"
                                ],
                                [
                                    "number" => "04",
                                    "title" => "Big Data Analytics",
                                    "description" => "Analisis data skala besar untuk pengambilan keputusan"
                                ],
                                [
                                    "number" => "05",
                                    "title" => "Cloud Computing",
                                    "description" => "Pengembangan infrastruktur dan layanan berbasis cloud"
                                ],
                                [
                                    "number" => "06",
                                    "title" => "Software Engineering",
                                    "description" => "Metodologi dan praktik terbaik dalam pengembangan perangkat lunak"
                                ]
                            ];

                            foreach ($agendaTopics as $agenda): ?>
                                <div class="agenda-card bg-white p-6 rounded-xl border-2 border-blue-100 hover:border-blue-300">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-start space-x-4">
                                            <span class="text-4xl font-bold text-blue-200"><?= $agenda['number'] ?></span>
                                            <div>
                                                <h3 class="text-xl font-bold text-blue-900 mb-2"><?= $agenda['title'] ?></h3>
                                                <p class="text-blue-600"><?= $agenda['description'] ?></p>
                                            </div>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button onclick="previewAgenda('<?= $agenda['number'] ?>')" 
                                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </button>
                                            <button onclick="editAgenda('<?= $agenda['number'] ?>')" 
                                                    class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </button>
                                            <button onclick="deleteAgenda('<?= $agenda['number'] ?>')" 
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div id="agendaModal" class="fixed inset-0 bg-blue-900/50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl max-w-2xl w-full mx-4">
            <div class="p-6 border-b border-blue-100">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-blue-900" id="modalTitle">Tambah Agenda</h3>
                    <button onclick="closeModal('agendaModal')" class="text-blue-600 hover:text-blue-800">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            <form id="agendaForm" class="p-6">
                <input type="hidden" id="agendaId" name="id">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-blue-900 mb-2">Judul Agenda</label>
                        <input type="text" id="title" name="title" required
                               class="w-full px-4 py-2 border-2 border-blue-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-blue-900 mb-2">Deskripsi</label>
                        <textarea id="description" name="description" rows="4" required
                                  class="w-full px-4 py-2 border-2 border-blue-100 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('agendaModal')"
                            class="px-6 py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Upload Modal -->
    <div id="uploadModal" class="fixed inset-0 bg-blue-900/50 backdrop-blur-sm hidden items-center justify-center z-50">
        <!-- Similar structure to agendaModal but with file upload functionality -->
    </div>

    <!-- Preview Modal -->
    <div id="previewModal" class="fixed inset-0 bg-blue-900/50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl max-w-4xl w-full mx-4">
            <!-- Similar structure to agendaModal but with preview functionality -->
        </div>
    </div>

    <script>
        // Modal functions similar to verify-letters.php
        // References lines 105-124 from verify-letters.php for modal functionality
    </script>
</body>
</html> 