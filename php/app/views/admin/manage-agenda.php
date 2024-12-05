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


</body>
</html>