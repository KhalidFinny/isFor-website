<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Manajemen Agenda</title>
=======
    <title>Manajemen Agenda
    </title>
>>>>>>> 8639620b71c9b917fee5804e0e39385a6ab50d6a
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
<<<<<<< HEAD
            background: white;
            border-radius: 1rem;
            padding: 2rem;
=======
>>>>>>> 8639620b71c9b917fee5804e0e39385a6ab50d6a
            transition: all 0.3s ease;
        }

        .agenda-card:hover {
<<<<<<< HEAD
            transform: translateY(-4px);
        }

        .number-label {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 5rem;
            font-weight: 700;
            color: #F3F4F6;
            line-height: 1;
        }

        .swiss-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .title-text {
            color: #4B5563;
            font-size: 1.5rem;
            font-weight: 600;
            line-height: 1.2;
            margin-bottom: 0.75rem;
        }

        .description-text {
            color: #6B7280;
            font-size: 0.975rem;
            line-height: 1.6;
        }

        .action-buttons {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .agenda-card:hover .action-buttons {
            opacity: 1;
=======
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.1);
        }

        .form-input {
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: #ef4444;
            transform: translateY(-1px);
>>>>>>> 8639620b71c9b917fee5804e0e39385a6ab50d6a
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex">
<<<<<<< HEAD
        <?php include_once '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>
        <div class="flex-1 min-h-screen ml-64">
            <main class="py-10 px-8">
                <!-- Header Section -->
                <div class="max-w-7xl mx-auto mb-12">
                    <span class="inline-block px-4 py-2 bg-red-50 text-red-600 rounded-full text-sm font-medium mb-4">
                        Manajemen Agenda
                    </span>
                    <h1 class="text-5xl font-bold text-red-900 mb-6">
                        Fokus Penelitian
                    </h1>
                    <div class="flex justify-between items-center">
                        <div class="w-24 h-1 bg-gradient-to-r from-red-600 to-red-800 rounded-full"></div>
                        <button onclick="showAddAgendaModal()"
                                class="px-6 py-3 bg-white border-2 border-red-200 text-red-600 rounded-xl hover:bg-red-50 transition-all flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span>Tambah Agenda</span>
                        </button>
                    </div>
                </div>

                <!-- Swiss Grid Layout -->
                <div class="swiss-grid max-w-7xl mx-auto">
                    <!-- Dynamic content will be rendered here -->
                </div>
            </main>
        </div>
    </div>

    <!-- Updated Modal Template -->
    <div id="agendaModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-8 w-full max-w-lg mx-4">
            <form id="agendaForm" class="space-y-6">
                <div>
                    <label class="block text-gray-500 text-sm font-medium mb-2">Nomor Agenda</label>
                    <input type="text" 
                           name="number"
                           class="w-full px-4 py-3 border-2 border-gray-100 rounded-xl focus:border-red-300 focus:ring-0 text-gray-600"
                           readonly>
                </div>
                
                <div>
                    <label class="block text-gray-500 text-sm font-medium mb-2">Judul Agenda</label>
                    <input type="text" 
                           name="title"
                           class="w-full px-4 py-3 border-2 border-gray-100 rounded-xl focus:border-red-300 focus:ring-0 text-gray-600"
                           placeholder="Masukkan judul agenda">
                </div>

                <div>
                    <label class="block text-gray-500 text-sm font-medium mb-2">Deskripsi</label>
                    <textarea name="description"
                              class="w-full px-4 py-3 border-2 border-gray-100 rounded-xl focus:border-red-300 focus:ring-0 text-gray-600 h-32"
                              placeholder="Masukkan deskripsi agenda"></textarea>
                </div>

                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-100">
                    <button type="button" onclick="closeAgendaModal()" 
                            class="px-6 py-2 text-gray-500 hover:text-gray-600 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-6 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Enhanced Delete Confirmation Modal -->
    <template id="deleteConfirmTemplate">
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center modal">
            <div class="bg-white rounded-2xl p-8 max-w-md mx-4 modal-content shadow-2xl">
                <div class="text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-red-50 flex items-center justify-center">
                        <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-red-900 mb-4">Konfirmasi Hapus</h3>
                    <p class="text-gray-600 mb-8">Apakah Anda yakin ingin menghapus agenda ini? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="flex justify-center space-x-4">
                        <button onclick="this.closest('.modal').remove()" 
                                class="px-6 py-3 text-gray-700 hover:bg-gray-100 rounded-xl transition-colors">
                            Batal
                        </button>
                        <button onclick="deleteAgenda(AGENDA_ID)" 
                                class="px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors shadow-lg shadow-red-100">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <script>
        // Placeholder data matching agenda.php structure
        let agendas = [
            {
                "id": 1,
                "number": "01",
                "title": "Artificial Intelligence & Machine Learning",
                "description": "Pengembangan sistem cerdas dan pembelajaran mesin untuk solusi inovatif"
            },
            {
                "id": 2,
                "number": "02",
                "title": "Internet of Things (IoT)",
                "description": "Implementasi teknologi IoT untuk smart city dan industri 4.0"
            },
            {
                "id": 3,
                "number": "03",
                "title": "Cybersecurity",
                "description": "Penelitian keamanan siber dan perlindungan infrastruktur digital"
            },
            {
                "id": 4,
                "number": "04",
                "title": "Big Data Analytics",
                "description": "Analisis data skala besar untuk pengambilan keputusan"
            },
            {
                "id": 5,
                "number": "05",
                "title": "Cloud Computing",
                "description": "Pengembangan infrastruktur dan layanan berbasis cloud"
            },
            {
                "id": 6,
                "number": "06",
                "title": "Software Engineering",
                "description": "Metodologi dan praktik terbaik dalam pengembangan perangkat lunak"
            }
        ];

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
            agendas.sort((a, b) => parseInt(a.number) - parseInt(b.number));
            agendas.forEach((agenda, index) => {
                agenda.number = formatNumber(index + 1);
            });
        }

        // Updated form submission handler
        document.getElementById('agendaForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                id: currentId || agendas.length + 1,
                number: this.number.value.padStart(2, '0'),
                title: this.title.value,
                description: this.description.value
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

        // Updated renderAgendas function with animation
        function renderAgendas() {
            const container = document.querySelector('.swiss-grid');
            
            container.innerHTML = agendas.map((agenda, index) => `
                <div class="agenda-card border-2 border-gray-100 hover:border-red-100">
                    <div class="flex flex-col h-full">
                        <div class="number-label mb-4">
                            ${agenda.number}
                        </div>
                        <div class="flex-1">
                            <h3 class="title-text">
                                ${agenda.title}
                            </h3>
                            <p class="description-text">
                                ${agenda.description}
                            </p>
                        </div>
                        <div class="action-buttons flex space-x-2 mt-4 pt-4 border-t border-gray-100">
                            <button onclick="editAgenda(${agenda.id})"
                                    class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <button onclick="confirmDelete(${agenda.id})"
                                    class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');

            // Add fade-in animation to cards
            document.querySelectorAll('.agenda-card').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        }

        function showAddAgendaModal() {
            const modal = document.getElementById('agendaModal');
            const form = document.getElementById('agendaForm');
            const numberInput = form.querySelector('[name="number"]');
            
            if (!currentId) {
                numberInput.value = getNextNumber();
                numberInput.disabled = true;
                document.getElementById('modalTitle').textContent = 'Tambah Agenda Baru';
            }
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeAgendaModal() {
            const modal = document.getElementById('agendaModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.getElementById('agendaForm').reset();
            currentId = null;
        }

        // Updated edit function to include description
        function editAgenda(id) {
            currentId = id;
            const agenda = agendas.find(a => a.id === id);
            const form = document.getElementById('agendaForm');
            
            form.number.value = agenda.number;
            form.title.value = agenda.title;
            form.description.value = agenda.description;
            
            document.getElementById('modalTitle').textContent = 'Edit Agenda';
            showAddAgendaModal();
        }

        function confirmDelete(id) {
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

        function deleteAgenda(id) {
            agendas = agendas.filter(a => a.id !== id);
            reorderAgendas(); // Reorder remaining agendas
            renderAgendas();
            document.querySelector('.fixed').remove();
        }

        // Add animation keyframes to existing styles
        const styleSheet = document.createElement("style");
        styleSheet.textContent = `
            @keyframes fadeIn {
                from { 
                    opacity: 0;
                    transform: translateY(20px);
                }
                to { 
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(styleSheet);

        // Initial render
        document.addEventListener('DOMContentLoaded', renderAgendas);
    </script>
=======
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


>>>>>>> 8639620b71c9b917fee5804e0e39385a6ab50d6a
</body>
</html>