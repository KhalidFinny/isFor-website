<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Roadmap - IsFor PRI</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="bg-gray-50">
<div class="flex">
    <?php include_once '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>

    <div class="flex-1 min-h-screen ml-64">
        <main class="py-10 px-8">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="text-center mb-12">
                        <span class="inline-block px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-sm font-medium mb-4">
                            Manajemen
                        </span>
                    <h1 class="text-4xl font-bold text-blue-900">
                        Kelola Roadmap
                    </h1>
                </div>

                <!-- Edit Button -->
                <div class="flex justify-center mb-16">
                    <button onclick="showRoadmapEditor()"
                            class="group px-8 py-4 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-300">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                            <span class="text-lg font-semibold">Edit Roadmap</span>
                        </div>
                    </button>
                </div>

                <!-- Preview Section -->
                <div id="roadmapPreview" class="space-y-20 bg-white rounded-2xl border-2 border-blue-100 p-8">
                    <!-- Will be populated by JavaScript -->
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Editor Modal -->
<div id="roadmapModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-8 max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-blue-900">Edit Roadmap</h3>
            <button onclick="closeRoadmapModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div id="roadmapEditor" class="space-y-8">
            <!-- Will be populated by JavaScript -->
        </div>
        <div class="flex justify-end space-x-3 mt-6 pt-4 border-t">
            <button onclick="closeRoadmapModal()"
                    class="px-4 py-2 text-gray-700 hover:text-gray-900">
                Cancel
            </button>
            <button onclick="saveChanges()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Save Changes
            </button>
        </div>
    </div>
</div>

<script>
    // Initial load
    document.addEventListener('DOMContentLoaded', () => {
        fetchRoadmapData();
    });

    function fetchRoadmapData() {
        fetch('/isfor-web/App/api/getRoadmap.php')
            .then(response => response.json())
            .then(data => {
                renderRoadmap(data);
            });
    }

    function renderRoadmap(data) {
        const preview = document.getElementById('roadmapPreview');
        let html = '';
        const groupedData = groupByPeriod(data);

        for (const [period, items] of Object.entries(groupedData)) {
            html += `
                    <div class="fade-in">
                        <div class="flex items-center mb-8">
                            <div class="p-4 bg-blue-50 rounded-2xl">
                                <h3 class="text-2xl font-bold text-blue-700">${period}</h3>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            ${Object.entries(items).map(([category, items]) => {
                const cat = categories.find(c => c.name === category);
                return `
                                    <div class="bg-white p-6 rounded-2xl border-2 border-blue-100">
                                        <div class="flex items-center mb-4">
                                            <div class="text-${cat.color}-600">
                                                ${cat.symbol}
                                            </div>
                                            <h4 class="text-lg font-semibold ml-3">${category}</h4>
                                        </div>
                                        <ul class="space-y-2">
                                            ${items.map(item => `
                                                <li class="text-gray-600">${item.item}</li>
                                            `).join('')}
                                        </ul>
                                    </div>
                                `;
            }).join('')}
                        </div>
                    </div>
                `;
        }

        preview.innerHTML = html;
    }

    function groupByPeriod(data) {
        return data.reduce((acc, curr) => {
            if (!acc[curr.period]) {
                acc[curr.period] = {};
            }
            if (!acc[curr.period][curr.category]) {
                acc[curr.period][curr.category] = [];
            }
            acc[curr.period][curr.category].push(curr);
            return acc;
        }, {});
    }

    function showRoadmapEditor() {
        const modal = document.getElementById('roadmapModal');
        const editor = document.getElementById('roadmapEditor');
        fetch('/isfor-web/App/api/getRoadmap.php')
            .then(response => response.json())
            .then(data => {
                let html = '';
                const groupedData = groupByPeriod(data);

                for (const [period, items] of Object.entries(groupedData)) {
                    html += generatePeriodEditor(period, items);
                }

                html += `
                        <button onclick="addNewPeriod()" 
                                class="w-full p-4 text-blue-600 border-2 border-dashed border-blue-200 rounded-xl hover:border-blue-400">
                            + Add New Period
                        </button>
                    `;

                editor.innerHTML = html;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
    }

    function generatePeriodEditor(period, items) {
        return `
                <div class="p-6 bg-gray-50 rounded-xl">
                    <div class="flex justify-between items-center mb-4">
                        <input type="text" value="${period}" 
                               onchange="updatePeriod('${period}', this.value)" 
                               class="text-2xl font-bold text-blue-700 w-full bg-transparent border-none focus:outline-none">
                        <button onclick="removePeriod('${period}')" class="text-red-500 hover:text-red-700">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        ${Object.entries(items).map(([category, items]) => {
            return `
                                <div class="bg-white p-6 rounded-2xl border-2 border-blue-100">
                                    <div class="flex items-center mb-4">
                                        <div class="text-${categories.find(c => c.name === category).color}-600">
                                            ${categories.find(c => c.name === category).symbol}
                                        </div>
                                        <h4 class="text-lg font-semibold ml-3">${category}</h4>
                                    </div>
                                    <ul class="space-y-2">
                                        ${items.map(item => `
                                            <li class="flex justify-between items-center">
                                                <input type="text" value="${item.item}" 
                                                       onchange="updateItem(${item.id}, this.value)" 
                                                       class="text-gray-600 w-full bg-transparent border-none focus:outline-none">
                                                <button onclick="removeItem(${item.id})" class="text-red-500 hover:text-red-700">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </li>
                                        `).join('')}
                                    </ul>
                                    <button onclick="addItem('${period}', '${category}')" 
                                            class="w-full p-2 text-sm text-blue-600 border border-dashed border-blue-300 rounded hover:border-blue-500">
                                        + Add New Item
                                    </button>
                                </div>
                            `;
        }).join('')}
                    </div>
                </div>
            `;
    }

    function updateItem(id, value) {
        fetch('/isfor-web/App/api/updateItem.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({id, item: value})
        }).then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    fetchRoadmapData();
                }
            });
    }

    function addItem(period, category) {
        fetch('/isfor-web/App/api/addPeriod.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({period, category, item: 'New Item'})
        }).then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    showRoadmapEditor();
                    fetchRoadmapData();
                }
            });
    }

    function removeItem(id) {
        fetch('/isfor-web/App/api/deleteItem.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({id})
        }).then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    showRoadmapEditor();
                    fetchRoadmapData();
                }
            });
    }

    function addNewPeriod() {
        // Logic to add a new period
    }

    function removePeriod(period) {
        // Logic to remove a period
    }

    function closeRoadmapModal() {
        document.getElementById('roadmapModal').classList.add('hidden');
        document.getElementById('roadmapModal').classList.remove('flex');
    }

    function saveChanges() {
        closeRoadmapModal();
        fetchRoadmapData();
    }
</script>
</body>
</html>