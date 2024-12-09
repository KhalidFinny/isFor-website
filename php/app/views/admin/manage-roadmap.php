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
<!-- Elegant Modal with Red Accents -->
<div id="roadmapModal" 
     class="fixed inset-0 z-50 hidden items-center justify-center"
     style="background: rgba(0, 0, 0, 0);">
    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm opacity-0 transition-all duration-300"
         id="modalBackdrop"></div>
    <div id="modalContent"
         class="relative bg-white w-[90%] h-[85vh] max-w-6xl mx-auto rounded-lg shadow-2xl border border-red-100 
                opacity-0 translate-y-4 scale-95 transition-all duration-300">
        <!-- Minimal Header with Red Accent -->
        <div class="px-8 py-6 border-b border-red-50">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl text-gray-800 font-light tracking-tight" id="modalTitle">
                    <span class="text-red-500">Edit</span> Periode Roadmap
                </h3>
                <button onclick="closeModal()" 
                        class="text-gray-400 hover:text-red-500 transition-colors duration-200
                               active:scale-95 transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Two-column Layout -->
        <form id="roadmapForm" action="<?= BASEURL ?>/roadmap/addRoadmap" method="post" class="grid grid-cols-5 h-[calc(85vh-73px)]">
            <!-- Left Column - Timeline -->
            <div class="col-span-1 border-r border-red-50 p-8">
                <div class="space-y-8">
                    <!-- Year Inputs -->
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm text-red-500 mb-2 font-medium">Tahun Mulai</label>
                            <input type="number" name="year_start" required
                                   class="w-full px-4 py-2.5 bg-white border border-red-100 rounded-md
                                          focus:border-red-500 focus:ring-1 focus:ring-red-500 
                                          transition-all duration-200 text-gray-700
                                          active:scale-[0.99] transform">
                        </div>
                        <div>
                            <label class="block text-sm text-red-500 mb-2 font-medium">Tahun Selesai</label>
                            <input type="number" name="year_end" required
                                   class="w-full px-4 py-2.5 bg-white border border-red-100 rounded-md
                                          focus:border-red-500 focus:ring-1 focus:ring-red-500 
                                          transition-all duration-200 text-gray-700
                                          active:scale-[0.99] transform">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-3 pt-6 border-t border-red-50">
                        <button type="submit" id="submitButton" 
                                class="w-full py-2.5 bg-red-500 text-white rounded-md hover:bg-red-600 
                                       transition-all duration-200 text-sm font-medium
                                       active:scale-[0.98] transform active:bg-red-700">
                            Tambah Roadmap
                        </button>
                        <button type="button" onclick="closeModal()" 
                                class="w-full py-2.5 text-red-500 bg-red-50 rounded-md hover:bg-red-100 
                                       transition-all duration-200 text-sm
                                       active:scale-[0.98] transform">
                            Batal
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column - Categories -->
            <div class="col-span-4 bg-gray-50/50 p-8">
                <div class="flex justify-between items-center mb-6">
                    <h4 class="text-base text-red-500 font-medium">Kategori dan Topik</h4>
                    <button type="button"  onclick="addCategory()" 
                            class="inline-flex items-center px-4 py-2 text-sm text-red-500 hover:text-red-600 
                                   transition-all duration-200 border border-red-100 rounded-md
                                   hover:bg-red-50 active:scale-[0.98] transform">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Kategori
                    </button>
                </div>

                <!-- Categories Grid -->
                <div id="categoriesContainer" 
                     class="grid grid-cols-2 gap-5 h-[calc(100%-3.5rem)] overflow-y-auto pr-2 custom-scrollbar">
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    /* Base Modal Animation */
    #roadmapModal {
        transition: visibility 0s linear 0.3s;
    }

    #roadmapModal.flex {
        transition-delay: 0s;
        visibility: visible;
    }

    #roadmapModal.flex #modalBackdrop {
        opacity: 1;
    }

    #roadmapModal.flex #modalContent {
        opacity: 1;
        transform: translateY(0) scale(1);
        transition-timing-function: cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    /* Hide State */
    #roadmapModal.hidden {
        visibility: hidden;
    }

    #roadmapModal.hidden #modalBackdrop {
        opacity: 0;
    }

    #roadmapModal.hidden #modalContent {
        opacity: 0;
        transform: translateY(4rem) scale(0.95);
    }

    /* Category Card Animations */
    .category-card {
        animation: categoryEntrance 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        transform-origin: top center;
    }

    @keyframes categoryEntrance {
        0% {
            opacity: 0;
            transform: scale(0.9) translateY(30px);
        }
        70% {
            transform: scale(1.02) translateY(-2px);
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    /* Topic Input Animations */
    .topic-input {
        animation: topicSlide 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes topicSlide {
        0% {
            opacity: 0;
            transform: translateX(-20px);
        }
        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Form Elements Staggered Animation */
    .form-element {
        opacity: 0;
        animation: formElementFade 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    @keyframes formElementFade {
        0% {
            opacity: 0;
            transform: translateY(15px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Staggered animation delays */
    .form-element:nth-child(1) { animation-delay: 0.1s; }
    .form-element:nth-child(2) { animation-delay: 0.2s; }
    .form-element:nth-child(3) { animation-delay: 0.3s; }

    /* Interactive Elements Animation */
    button, input {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Press States */
    button:active:not(:disabled) {
        transform: scale(0.97);
    }

    input:active {
        transform: scale(0.99);
    }

    /* Focus States with Smooth Transition */
    input:focus {
        transform: translateY(-1px);
        box-shadow: 0 2px 15px -3px rgba(239, 68, 68, 0.15);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    /* Category Removal Animation */
    .category-card.removing {
        animation: categoryRemove 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    @keyframes categoryRemove {
        0% {
            opacity: 1;
            transform: scale(1);
        }
        50% {
            opacity: 0.5;
            transform: scale(0.95) translateY(-10px);
        }
        100% {
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }
    }

    /* Scrollbar Styling */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #fee2e2;
        border-radius: 2px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #ef4444;
        border-radius: 2px;
    }
    
    .custom-scrollbar:hover::-webkit-scrollbar-thumb {
        background: #dc2626;
    }
</style>

<script>
    // Updated modal functions
    function showModal() {
        const modal = document.getElementById('roadmapModal');
        modal.style.display = 'flex';
        // Force reflow
        modal.offsetHeight;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('roadmapModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        // Wait for animation to complete before hiding
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    // Smooth category removal
    function removeCategory(element) {
        const card = element.closest('.category-card');
        card.classList.add('removing');
        setTimeout(() => {
            card.remove();
        }, 300);
    }

    // Updated category addition
    function addCategory() {
        const categoryId = categoryCounter++;
        const categoryDiv = document.createElement('div');
        categoryDiv.className = 'category-card bg-white border border-red-100 rounded-lg p-6 space-y-4';
        
        categoryDiv.innerHTML = `
            <div class="flex items-center justify-between form-element">
                <input type="text" name="category_${categoryId}" placeholder="Nama Kategori"
                       class="flex-1 px-3 py-2 border border-red-100 rounded-md text-sm
                              focus:border-red-500 focus:ring-1 focus:ring-red-500 
                              transition-all duration-200">
                <button type="button" onclick="removeCategory(this)" 
                        class="ml-3 text-red-400 hover:text-red-600 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="space-y-3 form-element">
                <div class="topics-${categoryId} space-y-2">
                    <input type="text" name="topic_${categoryId}_0" placeholder="Topik"
                           class="w-full px-3 py-2 border border-red-100 rounded-md text-sm topic-input
                                  focus:border-red-500 focus:ring-1 focus:ring-red-500 
                                  transition-all duration-200">
                </div>
                <button type="button" onclick="addTopic(${categoryId})" 
                        class="text-sm text-red-500 hover:text-red-600 transition-all duration-200 
                               inline-flex items-center">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                              d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Topik
                </button>
            </div>
        `;
        
        document.getElementById('categoriesContainer').appendChild(categoryDiv);
        categoryDiv.offsetHeight; // Force reflow
    }

    function addTopic(categoryId) {
        const topicInput = document.createElement('input');
        topicInput.type = 'text';
        topicInput.name = `topic_${categoryId}_${Date.now()}`;
        topicInput.placeholder = 'Topik';
        topicInput.className = 'w-full px-3 py-2 border border-red-100 rounded-md text-sm topic-input ' +
                              'focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all duration-200';
        
        document.querySelector(`.topics-${categoryId}`).appendChild(topicInput);
        topicInput.offsetHeight; // Force reflow
    }

    let currentId = null;
    let categoryCounter = 0;
    function showAddModal() {
        currentId = null;
        document.getElementById('modalTitle').textContent = 'Tambah Periode Roadmap';
        document.getElementById('roadmapForm').reset();
        document.getElementById('categoriesContainer').innerHTML = '';
        addCategory(); // Add initial category field
        showModal();
    }

    function editRoadmap(periode) {
        document.getElementById('modalTitle').textContent = 'Edit Periode Roadmap';
        document.getElementById('submitButton').textContent = 'simpan perubahan';
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
    // document.getElementById('roadmapForm').addEventListener('submit', function(e) {
    //     // e.preventDefault();
        
    //     const formData = {
    //         id: currentId || roadmaps.length + 1,
    //         year_start: parseInt(this.year_start.value),
    //         year_end: parseInt(this.year_end.value),
    //         categories: {}
    //     };

    //     // Collect categories and topics
    //     const categoryInputs = document.querySelectorAll('[name^="category_"]');
    //     categoryInputs.forEach(categoryInput => {
    //         const categoryId = categoryInput.name.split('_')[1];
    //         const categoryName = categoryInput.value;
    //         const topicInputs = document.querySelectorAll(`[name^="topic_${categoryId}_"]`);
    //         const topics = Array.from(topicInputs).map(input => input.value).filter(Boolean);
            
    //         if (categoryName && topics.length > 0) {
    //             formData.categories[categoryName] = topics;
    //         }
    //     });

    //     if (currentId) {
    //         // Edit existing roadmap
    //         roadmaps = roadmaps.map(r => r.id === currentId ? formData : r);
    //     } else {
    //         // Add new roadmap
    //         roadmaps.push(formData);
    //     }

    //     renderRoadmap();
    //     closeModal();
    // });

    // Initial render
    document.addEventListener('DOMContentLoaded', renderRoadmap);
</script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>