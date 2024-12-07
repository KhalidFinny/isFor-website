<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Agenda</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in { animation: fadeIn 0.4s ease-out forwards; }

        .agenda-card {
            transition: all 0.3s ease;
            background-size: 20px 20px;
            background-image: radial-gradient(circle, #fee2e2 0.5px, transparent 0.5px);
        }

        .agenda-card:hover {
            transform: translateY(-2px);
            background-color: #FEF2F2;
        }

        /* Alert Animation */
        @keyframes slideIn {
            from { transform: translateY(-100%); }
            to { transform: translateY(0); }
        }

        .alert-animate {
            animation: slideIn 0.3s ease-out forwards;
        }
    </style>
</head>
<body class="bg-white">
<?php include_once '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>
<!-- Main Content Area -->
<div class="flex-1 min-h-screen ml-64 bg-gray-50">
    <main class="py-10 px-8">
        <!-- Swiss-inspired Header -->
        <div class="max-w-7xl mx-auto mb-12 fade-in">
            <div class="flex items-center space-x-4 mb-4">
                <span class="h-px w-12 bg-red-600"></span>
                <span class="text-red-600 font-medium">Manajemen</span>
            </div>
            <div class="flex justify-between items-end">
                <h1 class="text-5xl font-bold text-red-900 mb-2">Kelola Agenda</h1>
                <button onclick="openAgendaModal('add')" 
                        class="px-6 py-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transform hover:-translate-y-1 transition-all duration-300">
                    + Tambah Agenda
                </button>
            </div>
        </div>

        <!-- Grid Layout with Sample Data -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 max-w-7xl mx-auto">
            <?php
            $sampleAgendas = [
                [
                    "id" => 1,
                    "number" => "01",
                    "title" => "Artificial Intelligence & Machine Learning",
                    "description" => "Pengembangan sistem cerdas dan pembelajaran mesin untuk solusi inovatif"
                ],
                [
                    "id" => 2,
                    "number" => "02",
                    "title" => "Internet of Things (IoT)",
                    "description" => "Implementasi teknologi IoT untuk smart city dan industri 4.0"
                ],
                [
                    "id" => 3,
                    "number" => "03",
                    "title" => "Cybersecurity",
                    "description" => "Penelitian keamanan siber dan perlindungan infrastruktur digital"
                ]
            ];

            if (empty($data['agenda'])): ?>
                <?php foreach ($sampleAgendas as $agenda): ?>
                    <div class="agenda-card bg-white p-6 rounded-2xl border-2 border-red-100">
                        <div class="flex justify-between items-start mb-4">
                            <span class="text-4xl font-bold text-red-500"><?= $agenda['number'] ?></span>
                            <div class="flex space-x-2">
                                <button onclick="openAgendaModal('edit', <?= htmlspecialchars(json_encode($agenda)) ?>)" 
                                        class="p-2 text-red-400 hover:text-red-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button onclick="confirmDelete(<?= $agenda['id'] ?>)" 
                                        class="p-2 text-red-400 hover:text-red-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-red-800 mb-2"><?= $agenda['title'] ?></h3>
                        <p class="text-red-600"><?= $agenda['description'] ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php foreach ($data['agenda'] as $agenda): ?>
                    <div class="agenda-card bg-white p-6 rounded-2xl border-2 border-red-100">
                        <div class="flex justify-between items-start mb-4">
                            <span class="text-4xl font-bold text-red-500"><?= $data['no']++ ?></span>
                            <div class="flex space-x-2">
                                <button onclick="openAgendaModal('edit', <?= htmlspecialchars(json_encode($agenda)) ?>)" 
                                        class="p-2 text-red-400 hover:text-red-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button onclick="confirmDelete(<?= $agenda['agenda_id'] ?>)" 
                                        class="p-2 text-red-400 hover:text-red-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-red-800 mb-2"><?= $agenda['title'] ?></h3>
                        <p class="text-red-600"><?= $agenda['description'] ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>            
        </div>
    </main>
</div>

<!-- Modal Form -->
<div id="agendaModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-8 w-full max-w-lg mx-4 fade-in">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-red-900" id="modalTitle">Tambah Agenda Baru</h3>
            <button onclick="closeAgendaModal()" class="text-red-400 hover:text-red-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form action="<?= BASEURL; ?>/agenda/addAgenda" method="POST" id="agendaForm" class="space-y-6">
            <input type="hidden" name="agenda_id" id="agendaId">
            
            <div class="flex space-x-4">
                <div class="w-1/3">
                    <label class="block text-sm font-medium text-red-700 mb-1">Nomor</label>
                    <input type="text" id="agendaNumber" required readonly
                           class="w-full px-4 py-2 border-2 border-red-100 rounded-xl text-center bg-red-50 text-red-600 font-semibold focus:border-red-500 focus:ring-0">
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-red-700 mb-1">Judul Agenda</label>
                    <input type="text" name="title" id="agendaTitle" required
                           class="w-full px-4 py-2 border-2 border-red-100 rounded-xl focus:border-red-500 focus:ring-0"
                           placeholder="Contoh: Artificial Intelligence & Machine Learning">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-red-700 mb-1">Deskripsi</label>
                <textarea name="description" id="agendaDescription" required
                          class="w-full px-4 py-2 border-2 border-red-100 rounded-xl focus:border-red-500 focus:ring-0 h-32"
                          placeholder="Contoh: Pengembangan sistem cerdas dan pembelajaran mesin untuk solusi inovatif"></textarea>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="closeAgendaModal()"
                        class="px-4 py-2 text-red-700 hover:text-red-900">
                    Batal
                </button>
                <button type="submit"
                        class="px-6 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600 transform hover:-translate-y-1 transition-all duration-300">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Confirm Delete Alert -->
<div id="confirmAlert" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-8 w-full max-w-md mx-4 fade-in">
        <div class="text-center">
            <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-red-900 mb-2">Konfirmasi Hapus</h3>
            <p class="text-red-500 mb-6">Apakah Anda yakin ingin menghapus agenda ini?</p>
            <div class="flex justify-center space-x-3">
                <button onclick="closeConfirmAlert()" 
                        class="px-4 py-2 text-red-700 hover:text-red-900">
                    Batal
                </button>
                <button onclick="deleteAgenda()" 
                        class="px-6 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600 transform hover:-translate-y-1 transition-all duration-300">
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Simplify the JavaScript to only handle fixed numbers
function getHighestNumber() {
    const agendaCards = document.querySelectorAll('.agenda-card');
    let highest = 0;
    agendaCards.forEach(card => {
        const numberText = card.querySelector('.text-4xl').textContent;
        const number = parseInt(numberText);
        if (number > highest) highest = number;
    });
    return highest;
}

function formatNumber(num) {
    return num.toString().padStart(2, '0');
}

function openAgendaModal(mode, agenda = null) {
    const modal = document.getElementById('agendaModal');
    const form = document.getElementById('agendaForm');
    const title = document.getElementById('modalTitle');

    if (mode === 'edit' && agenda) {
        title.textContent = 'Edit Agenda';
        // console.log(agenda);

        const agendaId = agenda.agenda_id;

        $.ajax({
            url: '<?= BASEURL ?>/agenda/getAgendaById',
            method: 'POST',
            data: { agenda_id: agendaId },
            dataType: 'json',
            success(data) {
                // console.log(data); 
                document.getElementById('agendaId').value = data.agenda_id;
                document.getElementById('agendaNumber').value = agenda.number;
                document.getElementById('agendaTitle').value = data.title;
                document.getElementById('agendaDescription').value = data.description;
            },
            error: function (xhr, status, error) {
                console.error('Error Status:', status);
                console.error('Error Details:', error);
                console.error('Response Text:', xhr.responseText);
                alert('Gagal mengambil data agenda');
            }
        });

        form.action = "<?= BASEURL; ?>/agenda/editAgenda";

    } else {
        title.textContent = 'Tambah Agenda Baru';
        form.reset();
        // Set next fixed number
        const nextNumber = formatNumber(getHighestNumber() + 1);
        document.getElementById('agendaNumber').value = nextNumber;
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeAgendaModal() {
    const modal = document.getElementById('agendaModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function confirmDelete(id) {
    agendaIdToDelete = id;

    const alert = document.getElementById('confirmAlert');
    alert.classList.remove('hidden');
    alert.classList.add('flex');
}

function closeConfirmAlert() {
    const alert = document.getElementById('confirmAlert');
    alert.classList.add('hidden');
    alert.classList.remove('flex');
}

function deleteAgenda() {
    if (agendaIdToDelete !== null) {
        // Kirim AJAX untuk menghapus agenda
        $.ajax({
            url: '<?= BASEURL ?>/agenda/deleteAgenda/' + agendaIdToDelete,
            method: 'POST',
            data: { agenda_id: agendaIdToDelete },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Jika berhasil, tutup modal dan reload atau hapus elemen agenda dari halaman
                    closeConfirmAlert();
                    alert('Agenda berhasil dihapus!');
                    location.reload();  // Reload halaman untuk melihat perubahan
                } else {
                    alert('Gagal menghapus agenda!');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus agenda.');
            }
        });
    }
}

// Simple form handler for demo
// document.getElementById('agendaForm').addEventListener('submit', function(e) {
//     e.preventDefault();
//     closeAgendaModal();
// });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>