<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-blue-900 mb-4">Roadmap Penelitian</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Rencana pengembangan penelitian kami untuk mencapai visi dan misi Pusat Riset Informatika
            </p>
        </div>
        
        <div id="mainRoadmap" class="space-y-20">
            <!-- Will be populated by JavaScript -->
        </div>
    </div>

    <script src="/isFor-website/App/public/assets/js/roadmap.js"></script>
    <script>
        function initializeRoadmap() {
            const roadmapDiv = document.getElementById('mainRoadmap');
            const data = loadTimelineData();
            
            let html = '';
            data.forEach(period => {
                html += `
                    <div class="fade-in">
                        <div class="flex items-center mb-8">
                            <div class="p-4 bg-blue-50 rounded-2xl">
                                <h3 class="text-2xl font-bold text-blue-700">${period.period}</h3>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            ${Object.entries(period.items).map(([category, items]) => {
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
                                                <li class="text-gray-600">${item}</li>
                                            `).join('')}
                                        </ul>
                                    </div>
                                `;
                            }).join('')}
                        </div>
                    </div>
                `;
            });

            roadmapDiv.innerHTML = html;
        }

        // Initialize roadmap on load
        document.addEventListener('DOMContentLoaded', initializeRoadmap);
        // Update when changes are made in admin panel
        window.addEventListener('roadmapUpdate', initializeRoadmap);
    </script>
</section>