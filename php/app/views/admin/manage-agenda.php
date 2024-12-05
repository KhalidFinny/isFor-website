<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Agenda
    </title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=ASSETS;?>/css/animations.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }

        .agenda-card {
            transition: all 0.3s ease;
        }

        .agenda-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.1);
        }

        .form-input {
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: #ef4444;
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex">
        <?php include_once '../app/views/assets/components/AdminDashboard/sidebar.php';?>

        <div class="flex-1 min-h-screen ml-64">
            <main class="py-10 px-8">
                <!-- Header -->
                <div class="max-w-7xl mx-auto mb-12 fade-in">
                    <div class="flex items-center space-x-4 mb-4">
                        <span class="h-px w-12 bg-red-600"></span>
                        <span class="text-red-600 font-medium">Manajemen</span>
                    </div>
                    <h1 class="text-5xl font-bold text-red-900 mb-2">Kelola Agenda</h1>
                </div>

                <!-- Add New Button -->
                <button onclick="showAddAgendaModal()"
                        class="mb-8 px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Tambah Agenda Baru</span>
                </button>

                <!-- Agenda Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php
// Simplified placeholder data
$agendas = [
    [
        'id' => 1,
        'number' => '01',
        'title' => 'Artificial Intelligence & Machine Learning',
    ],
    [
        'id' => 2,
        'number' => '02',
        'title' => 'Internet of Things (IoT)',
    ],
    [
        'id' => 3,
        'number' => '03',
        'title' => 'Cybersecurity',
    ],
    [
        'id' => 4,
        'number' => '04',
        'title' => 'Big Data Analytics',
    ],
    [
        'id' => 5,
        'number' => '05',
        'title' => 'Cloud Computing',
    ],
    [
        'id' => 6,
        'number' => '06',
        'title' => 'Software Engineering',
    ],
];
?>

                    <?php if (empty($agendas)): ?>
                        <div class="col-span-full text-center py-16 bg-white rounded-2xl border-2 border-red-50">
                            <img src="<?=ASSETS;?>/images/empty-agenda.png" alt="No Agenda" class="mx-auto h-40 animate-bounce">
                            <p class="mt-4 text-lg text-red-900">Belum ada agenda yang terdaftar</p>
                            <p class="text-sm text-gray-500">Mulai dengan menambahkan agenda baru</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($agendas as $index => $agenda): ?>
                            <div class="agenda-card bg-white rounded-2xl border-2 border-red-50 overflow-hidden fade-in hover:border-red-200 group"
                                 style="animation-delay: <?php echo $index * 0.1; ?>s">
                                <div class="p-6">
                                    <div class="flex items-start justify-between">
                                        <span class="text-6xl font-bold text-gray-100 transition-colors duration-300 group-hover:text-red-100">
                                            <?php echo $agenda['number']; ?>
                                        </span>
                                        <div class="flex space-x-2">
                                            <button onclick="editAgenda(<?php echo $agenda['id']; ?>)"
                                                    class="p-2 text-gray-400 hover:text-red-600 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </button>
                                            <button onclick="confirmDelete(<?php echo $agenda['id']; ?>)"
                                                    class="p-2 text-gray-400 hover:text-red-600 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-900 mt-4 group-hover:text-red-900 transition-colors duration-300">
                                        <?php echo $agenda['title']; ?>
                                    </h3>
                                </div>
                            </div>
                        <?php endforeach;?>
                    <?php endif;?>
                </div>
            </main>
        </div>
    </div>

    <!-- Add Agenda Modal -->
    <div id="agendaModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 w-full max-w-lg mx-4 fade-in">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-red-900" id="modalTitle">Tambah Agenda Baru</h3>
                <button onclick="closeAgendaModal()" class="text-gray-400 hover:text-red-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form id="agendaForm" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Agenda</label>
                    <input type="text"
                           name="number"
                           placeholder="Contoh: 01"
                           class="w-full px-4 py-2 border-2 border-red-100 rounded-xl focus:border-red-500 focus:ring-red-500 placeholder-gray-400">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Agenda</label>
                    <input type="text"
                           name="title"
                           placeholder="Masukkan judul agenda"
                           class="w-full px-4 py-2 border-2 border-red-100 rounded-xl focus:border-red-500 focus:ring-red-500 placeholder-gray-400">
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeAgendaModal()"
                            class="px-4 py-2 text-gray-700 hover:text-gray-900">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let agendas = <?php echo json_encode($agendas); ?>;
        let currentId = null;

        // Helper function to format number with leading zero
        function formatNumber(num) {
            return num.toString().padStart(2, '0');
        }

        // Helper function to get next available number
        function getNextNumber() {
            if (agendas.length === 0) return "01";
            const maxNumber = Math.max(...agendas.map(a => parseInt(a.number)));
            return formatNumber(maxNumber + 1);
        }

        // Helper function to reorder numbers
        function reorderAgendas() {
            return agendas
                .sort((a, b) => parseInt(a.number) - parseInt(b.number))
                .map((agenda, index) => ({
                    ...agenda,
                    number: formatNumber(index + 1)
                }));
        }

        // Form submission handler
        document.getElementById('agendaForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                id: currentId || agendas.length + 1,
                number: currentId ? this.number.value : getNextNumber(),
                title: this.title.value
            };

            if (currentId) {
                // Update existing agenda
                agendas = agendas.map(a => a.id === currentId ? formData : a);
            } else {
                // Add new agenda
                agendas.push(formData);
            }

            renderAgendas();
            closeAgendaModal();
            this.reset();
            currentId = null;
        });

        // Modified showAddAgendaModal to handle number field
        function showAddAgendaModal() {
            const modal = document.getElementById('agendaModal');
            const form = document.getElementById('agendaForm');
            const numberInput = form.querySelector('[name="number"]');
            
            // If adding new agenda, disable number field and set next number
            if (!currentId) {
                numberInput.value = getNextNumber();
                numberInput.disabled = true;
            } else {
                numberInput.disabled = false;
            }
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeAgendaModal() {
            document.getElementById('agendaModal').classList.add('hidden');
            document.getElementById('agendaModal').classList.remove('flex');
        }

        function editAgenda(id) {
            // Implementation for editing agenda
            showAddAgendaModal();
            // Populate form with existing data
        }

        // Modified delete agenda function with reordering
        function deleteAgenda(id) {
            agendas = agendas.filter(a => a.id !== id);
            // Reorder remaining agendas
            agendas = reorderAgendas();
            renderAgendas();
            // Remove the alert modal
            document.querySelector('.fixed').remove();
        }

        // Modified renderAgendas to handle animations better
        function renderAgendas() {
            const container = document.querySelector('.grid');
            
            if (agendas.length === 0) {
                container.innerHTML = `
                    <div class="col-span-full text-center py-16 bg-white rounded-2xl border-2 border-red-50">
                        <img src="${ASSETS}/images/empty-agenda.png" alt="No Agenda" class="mx-auto h-40 animate-bounce">
                        <p class="mt-4 text-lg text-red-900">Belum ada agenda yang terdaftar</p>
                        <p class="text-sm text-gray-500">Mulai dengan menambahkan agenda baru</p>
                    </div>
                `;
                return;
            }

            // Sort agendas by number before rendering
            const sortedAgendas = [...agendas].sort((a, b) => parseInt(a.number) - parseInt(b.number));

            container.innerHTML = sortedAgendas.map((agenda, index) => `
                <div class="agenda-card bg-white rounded-2xl border-2 border-red-50 overflow-hidden fade-in hover:border-red-200 group"
                     style="animation-delay: ${index * 0.1}s">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <span class="text-6xl font-bold text-gray-100 transition-colors duration-300 group-hover:text-red-100">
                                ${agenda.number}
                            </span>
                            <div class="flex space-x-2">
                                <button onclick="editAgenda(${agenda.id})"
                                        class="p-2 text-gray-400 hover:text-red-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button onclick="confirmDelete(${agenda.id})"
                                        class="p-2 text-gray-400 hover:text-red-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mt-4 group-hover:text-red-900 transition-colors duration-300">
                            ${agenda.title}
                        </h3>
                    </div>
                </div>
            `).join('');
        }

        // Edit agenda function
        function editAgenda(id) {
            currentId = id;
            const agenda = agendas.find(a => a.id === id);
            const form = document.getElementById('agendaForm');
            
            form.number.value = agenda.number;
            form.title.value = agenda.title;
            
            document.getElementById('modalTitle').textContent = 'Edit Agenda';
            showAddAgendaModal();
        }

        // Stylized confirm delete
        function confirmDelete(id) {
            // Add custom alert modal to the page
            const alertModal = document.createElement('div');
            alertModal.innerHTML = `
                <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
                    <div class="bg-white rounded-2xl p-8 max-w-md mx-4 fade-in">
                        <div class="text-center">
                            <svg class="mx-auto mb-4 w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Konfirmasi Hapus</h3>
                            <p class="text-gray-500 mb-6">Apakah Anda yakin ingin menghapus agenda ini?</p>
                            <div class="flex justify-center space-x-3">
                                <button onclick="this.closest('.fixed').remove()" 
                                        class="px-4 py-2 text-gray-700 hover:text-gray-900">
                                    Batal
                                </button>
                                <button onclick="deleteAgenda(${id})" 
                                        class="px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(alertModal);
        }

        // Initial render
        document.addEventListener('DOMContentLoaded', renderAgendas);
    </script>
</body>
</html>