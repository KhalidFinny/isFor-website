<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IsFor Pusat Riset Informatika</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ASSETS; ?>/css/animations.css">
</head>

    <!-- Roadmap Section -->
    <section id="roadmap" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Research Roadmap</h2>
                <p class="text-gray-600 text-lg">Our strategic research direction for the coming years</p>
            </div>

            <!-- Timeline Container -->
            <div class="relative">
                <!-- Timeline Line -->
                <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-0.5 bg-blue-200"></div>

                <!-- Timeline Content -->
                <div class="space-y-24" id="roadmapContent">
                    <!-- Will be populated by JavaScript -->
                </div>
            </div>
        </div>

        <style>
            .timeline-period {
                opacity: 0;
                transform: translateY(20px);
                transition: all 0.6s ease-out;
            }

            .timeline-period.visible {
                opacity: 1;
                transform: translateY(0);
            }

            .category-card {
                transition: all 0.3s ease;
                opacity: 0;
                transform: translateX(-20px);
            }

            .category-card.visible {
                opacity: 1;
                transform: translateX(0);
            }

            .topic-item {
                transition: all 0.2s ease;
            }

            .topic-item:hover {
                transform: translateX(5px);
                color: #3b82f6;
            }

            .period-badge {
                background: linear-gradient(135deg, #3b82f6, #2563eb);
                box-shadow: 0 4px 14px rgba(59, 130, 246, 0.25);
                transition: all 0.3s ease;
            }

            .period-badge:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
            }
        </style>

        <script>
            const roadmapData = {
                periods: [
                    {
                        years: '2018-2022',
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
                        years: '2022-2025',
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
                        years: '2026-2028',
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
                ]
            };

            function renderRoadmap() {
                const container = document.getElementById('roadmapContent');
                container.innerHTML = '';

                roadmapData.periods.forEach((period, periodIndex) => {
                    const periodHtml = `
                        <div class="timeline-period relative" data-period="${period.years}">
                            <div class="text-center mb-12">
                                <span class="period-badge inline-flex items-center justify-center w-40 py-3 text-white rounded-full text-lg font-semibold">
                                    ${period.years}
                                </span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                ${Object.entries(period.categories).map(([category, topics], categoryIndex) => `
                                    <div class="category-card bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:border-blue-300"
                                         style="animation-delay: ${categoryIndex * 100}ms">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-4">${category}</h3>
                                        <ul class="space-y-3">
                                            ${topics.map(topic => `
                                                <li class="topic-item flex items-start space-x-2 text-gray-600 text-sm">
                                                    <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                    </svg>
                                                    <span>${topic}</span>
                                                </li>
                                            `).join('')}
                                        </ul>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', periodHtml);
                });

                // Initialize animations
                initializeAnimations();
            }

            function initializeAnimations() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                            // Animate child category cards
                            entry.target.querySelectorAll('.category-card').forEach((card, index) => {
                                setTimeout(() => {
                                    card.classList.add('visible');
                                }, index * 100);
                            });
                        }
                    });
                }, {
                    threshold: 0.1
                });

                document.querySelectorAll('.timeline-period').forEach(period => {
                    observer.observe(period);
                });
            }

            // Initialize
            document.addEventListener('DOMContentLoaded', () => {
                renderRoadmap();
            });
        </script>
    </section>
