<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Roadmap</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }

        .category-card {
            transition: all 0.3s ease;
        }

        .category-card:hover {
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

        .topic-list {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .topic-list.show {
            max-height: 500px;
        }
        #categoriesContainer {
        scrollbar-width: thin;
        scrollbar-color: #ef4444 #fee2e2;
    }

    #categoriesContainer::-webkit-scrollbar {
        width: 6px;
    }

    #categoriesContainer::-webkit-scrollbar-track {
        background: #fee2e2;
        border-radius: 3px;
    }

    #categoriesContainer::-webkit-scrollbar-thumb {
        background-color: #ef4444;
        border-radius: 3px;
    }

    .modal-category {
        background: #fff;
        border: 1px solid #fee2e2;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 8px;
    }
    </style>
</head>
<body class="bg-gray-50">
    <?php include_once '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>
    <div class="flex">
        <div class="flex-1 min-h-screen ml-64">
            <main class="py-10 px-8">
                <!-- Header -->
                <div class="max-w-7xl mx-auto mb-12 fade-in">
                    <div class="flex items-center space-x-4 mb-4">
                        <span class="h-px w-12 bg-red-600"></span>
                        <span class="text-red-600 font-medium">Research</span>
                    </div>
                    <h1 class="text-5xl font-bold text-red-900 mb-2">Manajemen Roadmap</h1>
                </div>

                <!-- Add New Button -->
                <button onclick="showAddModal()" 
                        class="mb-8 px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Tambah Periode Baru</span>
                </button>

                <!-- Roadmap Grid -->
                <div class="grid gap-8" id="roadmapContent">
                    <!-- Will be populated by JavaScript -->
                    <?php if(!empty($data['roadmaps'])) :?>
                        <?php foreach($data['roadmaps'] as $periode => $categories) : ?>
                        <div class="bg-white rounded-2xl border-2 border-red-100 overflow-hidden fade-in mb-8">
                            <div class="p-6 border-b border-red-100 flex justify-between items-center">
                                <h2 class="text-xl font-semibold text-red-800">Periode <?= $periode ?></h2>
                                <div class="flex space-x-2">
                                    <button onclick="editRoadmap('<?= $periode ?>')" class="p-2 text-gray-600 hover:text-red-600 rounded-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <button onclick="deleteRoadmap('<?= $periode ?>')" class="p-2 text-gray-600 hover:text-red-600 rounded-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="p-8">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                    <?php foreach($categories as $category => $topics): ?>
                                        <div class="category-card bg-white p-6 rounded-xl border-2 border-red-50">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-4"><?= $category ?></h3>
                                            <?php foreach ($topics as $topic): ?>
                                                <ul class="space-y-3">
                                                    <li class="flex items-start space-x-2 text-gray-600 text-sm">
                                                        <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                        </svg>
                                                        <span><?= $topic ?></span>
                                                    </li>
                                                </ul>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>
<!-- Modal Form -->
<div id="roadmapModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-4 w-[90%] max-w-5xl mx-4 fade-in relative">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-red-800" id="modalTitle">Tambah Periode Roadmap</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-red-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <form id="roadmapForm" class="flex gap-4 h-[70vh]" action="<?= BASEURL ?>/roadmap/addRoadmap" method="POST">
            <!-- Left Side - Years -->
            <div class="w-[200px] flex-shrink-0">
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Tahun Mulai</label>
                        <input type="number" name="year_start" required
                               class="w-full px-3 py-2 border-2 border-red-100 rounded-lg form-input text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Tahun Selesai</label>
                        <input type="number" name="year_end" required
                               class="w-full px-3 py-2 border-2 border-red-100 rounded-lg form-input text-sm">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col space-y-2 mt-4">
                    <button type="submit" 
                            class="px-4 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all">
                        Simpan
                    </button>
                    <button type="button" onclick="closeModal()" 
                            class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900 rounded-lg border border-gray-200 hover:border-gray-300 transition-all">
                        Batal
                    </button>
                </div>
            </div>

            <!-- Right Side - Categories -->
            <div class="flex-1 border-l border-gray-200 pl-4">
                <div class="flex justify-between items-center mb-2">
                    <label class="block text-sm font-medium text-gray-600">Kategori dan Topik</label>
                    <button type="button" onclick="addCategory()" 
                            class="text-red-600 hover:text-red-700 text-sm flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Tambah Kategori</span>
                    </button>
                </div>

                <div id="categoriesContainer" class="overflow-y-auto pr-2" style="height: calc(70vh - 80px);">
                    <!-- Categories will be added here -->
                </div>
            </div>
        </form>
    </div>
</div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-2 pt-4 border-t border-gray-100">
                <button type="button" onclick="closeModal()" 
                        class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900 rounded-lg border border-gray-200 hover:border-gray-300 transition-all">
                    Batal
                </button>
                <button type="submit" 
                        class="px-4 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

    <script>
        let roadmaps = [
            {
                id: 1,
                year_start: 2018,
                year_end: 2022,
                categories: {
                    'Smart ICT': [
                        'Network management System',
                        'Network Topology',
                        'Concept Electronics and IT Embedded System'
                    ],
                    'IoT Applications': [
                        'IoT systems',
                        'Sensors for IoT Systems'
                    ],
                    'Data Science & Analytics': [
                        'Decision Support System',
                        'Classification System',
                        'Prediction System',
                        'Cluster Analysis'
                    ],
                    'Business Management': [
                        'Digital Marketing',
                        'Micro Commerce Management',
                        'Digital Tax Management'
                    ]
                }
            },
            {
                id: 2,
                year_start: 2022,
                year_end: 2025,
                categories: {
                    'Smart ICT': [
                        'LORA Systems',
                        'LORA mesh for IT Systems',
                        'LORA for Smart Systems'
                    ],
                    'IoT Applications': [
                        'IoT for urban farming',
                        'IoT for freshwater fish',
                        'Smart Home',
                        'IoT for Power Electric Distribution'
                    ],
                    'Data Science & Analytics': [
                        'Big Data Analysis',
                        'Natural Language Processing',
                        'Image Processing'
                    ],
                    'Business Management': [
                        'Governance Fiscal Independency',
                        'Commercial Port Management System',
                        'Document Archiving Management'
                    ]
                }
            },
            {
                id: 3,
                year_start: 2026,
                year_end: 2028,
                categories: {
                    'Smart ICT': [
                        'ICT for Industrial Automation',
                        'Integrated Data Transaction'
                    ],
                    'IoT Applications': [
                        'Smart City',
                        'Smart Ecosystem',
                        'Smart monitoring Systems'
                    ],
                    'Data Science & Analytics': [
                        'Voice Command Technology',
                        'Land & Building Mapping',
                        'Intelligence System',
                        'Integrated Information System: Trends & Prediction'
                    ],
                    'Business Management': [
                        'Customer Relation Management System',
                        'Supply Chain Management',
                        'Analytic of Documents Archiving'
                    ]
                }
            }
        ];

        let currentId = null;
        let categoryCounter = 0;
        function showAddModal() {
            currentId = null;
            document.getElementById('modalTitle').textContent = 'Tambah Periode Roadmap';
            document.getElementById('roadmapForm').reset();
            document.getElementById('categoriesContainer').innerHTML = '';
            addCategory(); // Add initial category field
            document.getElementById('roadmapModal').classList.remove('hidden');
            document.getElementById('roadmapModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('roadmapModal').classList.add('hidden');
            document.getElementById('roadmapModal').classList.remove('flex');
        }

        function addCategory() {
            const container = document.getElementById('categoriesContainer');
            const categoryId = categoryCounter++;
            
            const categoryDiv = document.createElement('div');
            categoryDiv.className = 'border-2 border-red-50 rounded-xl p-4 space-y-4';
            categoryDiv.innerHTML = `
                <div class="flex justify-between items-center">
                    <input type="text" name="category_${categoryId}" placeholder="Nama Kategori"
                           class="w-2/3 px-4 py-2 border-2 border-red-100 rounded-xl form-input">
                    <button type="button" onclick="this.closest('.border-2').remove()" 
                            class="text-red-600 hover:text-red-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="space-y-2">
                    <div class="topics-${categoryId}">
                        <input type="text" name="topic_${categoryId}_0" placeholder="Topik"
                               class="w-full px-4 py-2 border-2 border-red-100 rounded-xl form-input mb-2">
                    </div>
                    <button type="button" onclick="addTopic(${categoryId})" 
                            class="text-sm text-red-600 hover:text-red-700 flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Tambah Topik</span>
                    </button>
                </div>
            `;
            
            container.appendChild(categoryDiv);
        }

        function addTopic(categoryId) {
            const topicsContainer = document.querySelector(`.topics-${categoryId}`);
            const topicCount = topicsContainer.children.length;
            
            const topicInput = document.createElement('input');
            topicInput.type = 'text';
            topicInput.name = `topic_${categoryId}_${topicCount}`;
            topicInput.placeholder = 'Topik';
            topicInput.className = 'w-full px-4 py-2 border-2 border-red-100 rounded-xl form-input mb-2';
            
            topicsContainer.appendChild(topicInput);
        }

        function editRoadmap(periode) {
            showAddModal();
            document.getElementById('modalTitle').textContent = 'Edit Periode Roadmap';
            const form = document.getElementById('roadmapForm');
            
            form.action = `<?= BASEURL ?>/roadmap/editRoadmap`;

                $.ajax({
                    url: '<?= BASEURL ?>/roadmap/getUpdate',
                    method: 'POST',
                    dataType: 'json',
                    data: { periode: periode },
                    success: function(response) {
                        // console.log(response);

                        const roadmaps = (response) => {
                            // Ambil `year_start` dan `year_end` dari data pertama
                            const year_start = response[0]?.year_start;
                            const year_end = response[0]?.year_end;

                            // Kelompokkan topik berdasarkan kategori
                            const categories = response.reduce((acc, item) => {
                                if (!acc[item.category]) {
                                    acc[item.category] = [];
                                }
                                acc[item.category].push(item.topic);
                                return acc;
                            }, {});

                            // Gabungkan hasil
                            return { year_start, year_end, categories };
                        };

                        // Hasil akhir
                        const result = roadmaps(response);

                        console.log(result);

                        form.year_start.value = result.year_start;
                        form.year_end.value = result.year_end;
                        
                        // Clear and populate categories
                        const categoriesContainer = document.getElementById('categoriesContainer');
                        categoriesContainer.innerHTML = '';
                        
                        Object.entries(result.categories).forEach(([category, topics]) => {
                            const categoryId = categoryCounter++;
                            const categoryDiv = document.createElement('div');
                            categoryDiv.className = 'border-2 border-red-50 rounded-xl p-4 space-y-4';
                            categoryDiv.innerHTML = `
                                <div class="flex justify-between items-center">
                                    <input type="text" name="category_${categoryId}" value="${category}"
                                        class="w-2/3 px-4 py-2 border-2 border-red-100 rounded-xl form-input">
                                    <button type="button" onclick="this.closest('.border-2').remove()" 
                                            class="text-red-600 hover:text-red-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="space-y-2">
                                    <div class="topics-${categoryId}">
                                        ${topics.map((topic, index) => `
                                            <input type="text" name="topic_${categoryId}_${index}" value="${topic}"
                                                class="w-full px-4 py-2 border-2 border-red-100 rounded-xl form-input mb-2">
                                        `).join('')}
                                    </div>
                                    <button type="button" onclick="addTopic(${categoryId})" 
                                            class="text-sm text-red-600 hover:text-red-700 flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        <span>Tambah Topik</span>
                                    </button>
                                </div>
                            `;
                            categoriesContainer.appendChild(categoryDiv);
                        });
                        
                        document.getElementById('roadmapModal').classList.remove('hidden');
                        document.getElementById('roadmapModal').classList.add('flex');
                    },
                    error: function(response) {
                        alert('Gagal memperbarui status surat');
                    }
                });
            }

        function deleteRoadmap(periode) {
            if(confirm('Apakah Anda yakin ingin menghapus periode roadmap ini?')){
                $.ajax({
                    url: '<?= BASEURL ?>/roadmap/delete',
                    method: 'POST',
                    dataType: 'json',
                    data: { periode: periode },
                    success: function(response){
                            alert(response.status);
                            location.reload();
                    },
                    error: function(response){
                        alert('Gagal memperbarui status surat');
                    }
                });
            }
        }

        // Form submission handler
        document.getElementById('roadmapForm').addEventListener('submit', function(e) {
            // e.preventDefault();
            
            const formData = {
                id: currentId || roadmaps.length + 1,
                year_start: parseInt(this.year_start.value),
                year_end: parseInt(this.year_end.value),
                categories: {}
            };

            // Collect categories and topics
            const categoryInputs = document.querySelectorAll('[name^="category_"]');
            categoryInputs.forEach(categoryInput => {
                const categoryId = categoryInput.name.split('_')[1];
                const categoryName = categoryInput.value;
                const topicInputs = document.querySelectorAll(`[name^="topic_${categoryId}_"]`);
                const topics = Array.from(topicInputs).map(input => input.value).filter(Boolean);
                
                if (categoryName && topics.length > 0) {
                    formData.categories[categoryName] = topics;
                }
            });

            if (currentId) {
                // Edit existing roadmap
                roadmaps = roadmaps.map(r => r.id === currentId ? formData : r);
            } else {
                // Add new roadmap
                roadmaps.push(formData);
            }

            renderRoadmap();
            closeModal();
        });

        // Initial render
        document.addEventListener('DOMContentLoaded', renderRoadmap);
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>