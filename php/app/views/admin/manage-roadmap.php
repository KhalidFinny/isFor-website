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

        .period-table {
            border-collapse: separate;
            border-spacing: 0;
        }
        .period-table th {
            background-color: #f8fafc;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .category-cell {
            background-color: #f0f9ff;
            position: sticky;
            left: 0;
            z-index: 5;
        }
        .topic-input {
            min-height: 40px;
            transition: all 0.2s;
        }
        .topic-input:focus {
            min-height: 80px;
        }
    </style>
</head>
<body class="bg-gray-50">
<div class="flex">

    <div class="flex-1 min-h-screen ml-64">
        <main class="py-10 px-8">
            <div class="max-w-7xl mx-auto px-4 py-8">
                <div class="mb-6 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Research Roadmap Management</h1>
                    <button onclick="saveAllChanges()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Save All Changes
                    </button>
                </div>

                <!-- Period Tabs -->
                <div class="mb-6 border-b border-gray-200">
                    <nav class="flex space-x-4" aria-label="Periods">
                        <button class="px-4 py-2 text-sm font-medium text-blue-600 border-b-2 border-blue-600" 
                                onclick="switchPeriod('2018-2022')">
                            2018-2022
                        </button>
                        <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700" 
                                onclick="switchPeriod('2022-2025')">
                            2022-2025
                        </button>
                        <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700" 
                                onclick="switchPeriod('2026-2028')">
                            2026-2028
                        </button>
                    </nav>
                </div>

                <!-- Roadmap Table -->
                <div class="overflow-x-auto shadow-sm rounded-lg">
                    <table class="period-table w-full bg-white">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Topics
                                </th>
                                <th class="px-6 py-3 w-24 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody id="roadmapTableBody">
                            <!-- Will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Add Topic Modal -->
<div id="addTopicModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <!-- Modal content -->
</div>

<script>
    const categories = [
        { id: 1, name: 'Smart ICT' },
        { id: 2, name: 'IoT Applications' },
        { id: 3, name: 'Data Science & Analytics' },
        { id: 4, name: 'Business Management' }
    ];

    let currentPeriod = '2018-2022';
    let roadmapData = {};

    function fetchRoadmapData() {
        fetch('/api/roadmap')
            .then(response => response.json())
            .then(data => {
                roadmapData = data;
                renderRoadmapTable();
            });
    }

    function renderRoadmapTable() {
        const tbody = document.getElementById('roadmapTableBody');
        tbody.innerHTML = '';

        categories.forEach(category => {
            const topics = roadmapData[currentPeriod]?.[category.name] || [];
            const row = `
                <tr>
                    <td class="category-cell px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        ${category.name}
                    </td>
                    <td class="px-6 py-4">
                        <div class="space-y-2">
                            ${topics.map(topic => `
                                <div class="flex items-start gap-2">
                                    <textarea
                                        class="topic-input flex-1 text-sm text-gray-700 border rounded-md p-2"
                                        onchange="updateTopic('${category.name}', this.value, ${topic.id})"
                                    >${topic.text}</textarea>
                                    <button onclick="deleteTopic(${topic.id})" 
                                            class="text-red-500 hover:text-red-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            `).join('')}
                            <button onclick="addTopic('${category.name}')"
                                    class="text-sm text-blue-600 hover:text-blue-700">
                                + Add Topic
                            </button>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button class="text-gray-500 hover:text-gray-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </button>
                    </td>
                </tr>
            `;
            tbody.insertAdjacentHTML('beforeend', row);
        });
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', fetchRoadmapData);
</script>
</body>
</html>