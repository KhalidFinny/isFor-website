<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Agenda - IsFor PRI</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/isfor-web/App/public/assets/css/animations.css">
    <style>
        .agenda-card {
            animation: slideUp 0.5s ease-out forwards;
            opacity: 0;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex">
        <?php include '../../public/assets/components/AdminDashboard/sidebar.php'; ?>
        <div class="flex-1 min-h-screen ml-64">
            <main class="py-10 px-8">
                <!-- Header -->
                <div class="max-w-7xl mx-auto mb-12">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="flex items-center space-x-4 mb-4">
                                <span class="h-px w-12 bg-blue-600"></span>
                                <span class="text-blue-600 font-medium">Manajemen</span>
                            </div>
                            <h1 class="text-4xl font-bold text-blue-900">
                                Kelola
                                <span class="relative inline-block">
                                    <span class="absolute -bottom-2 left-0 w-full h-4 bg-blue-100 -z-10"></span>
                                    <span>Agenda</span>
                                </span>
                            </h1>
                        </div>
                        <button onclick="showAddAgendaModal()" class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Tambah Agenda</span>
                        </button>
                    </div>
                </div>

                <!-- Agenda List -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php if (empty($agendas)): ?>
                    <!-- Empty State -->
                    <div class="col-span-full text-center py-16 bg-white rounded-2xl border-2 border-blue-100">
                        <img src="/isfor-web/App/public/assets/images/empty-agenda.png" alt="No Agenda" class="mx-auto h-40 animate-bounce">
                        <p class="mt-4 text-lg text-blue-900">Belum ada agenda yang terdaftar</p>
                        <p class="text-sm text-gray-500">Mulai dengan menambahkan agenda baru</p>
                    </div>
                    <?php else: ?>
                    <!-- Agenda Cards -->
                    <?php foreach ($agendas as $index => $agenda): ?>
                    <div class="agenda-card bg-white rounded-2xl border-2 border-blue-100 overflow-hidden" style="animation-delay: <?php echo $index * 0.1; ?>s">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-sm font-medium">
                                    <?php echo $agenda['category']; ?>
                                </span>
                                <span class="text-sm text-gray-500"><?php echo $agenda['date']; ?></span>
                            </div>
                            <h3 class="text-lg font-semibold text-blue-900 mb-2"><?php echo $agenda['title']; ?></h3>
                            <p class="text-gray-600 text-sm mb-4"><?php echo $agenda['description']; ?></p>
                            
                            <!-- Action Buttons -->
                            <div class="flex space-x-3">
                                <button onclick="editAgenda(<?php echo $agenda['id']; ?>)" 
                                        class="flex-1 px-4 py-2 bg-blue-50 text-blue-700 rounded-xl hover:bg-blue-100 transition-colors">
                                    Edit
                                </button>
                                <button onclick="deleteAgenda(<?php echo $agenda['id']; ?>)" 
                                        class="flex-1 px-4 py-2 bg-red-50 text-red-700 rounded-xl hover:bg-red-100 transition-colors">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Add/Edit Agenda Modal -->
    <div id="agendaModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl p-8 max-w-2xl w-full mx-4">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-blue-900" id="modalTitle">Tambah Agenda Baru</h3>
                <button onclick="closeAgendaModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="agendaForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Agenda</label>
                    <input type="text" name="title" class="w-full px-4 py-2 border-2 border-blue-100 rounded-xl focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="category" class="w-full px-4 py-2 border-2 border-blue-100 rounded-xl focus:border-blue-500 focus:ring-blue-500">
                        <option value="seminar">Seminar</option>
                        <option value="workshop">Workshop</option>
                        <option value="meeting">Meeting</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="date" class="w-full px-4 py-2 border-2 border-blue-100 rounded-xl focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-2 border-2 border-blue-100 rounded-xl focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeAgendaModal()" class="px-4 py-2 text-gray-700 hover:text-gray-900">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal functions similar to verify-letters.php
        // References lines 105-124 from verify-letters.php for modal functionality
    </script>
</body>
</html> 