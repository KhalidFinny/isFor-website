<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Modern Animations */
        @keyframes fadeScale {
            0% { opacity: 0; transform: scale(0.95); }
            100% { opacity: 1; transform: scale(1); }
        }

        @keyframes slideUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .title-animation {
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .gallery-item {
            opacity: 0;
            animation: fadeScale 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .hover-info {
            transform: translateY(100%);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .gallery-item:hover .hover-info {
            transform: translateY(0);
        }

        .gallery-item:hover .gallery-image {
            transform: scale(1.05);
        }

        .gallery-image {
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        /* Modern Lightbox */
        .lightbox {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(8px);
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .lightbox.active {
            display: flex;
            opacity: 1;
        }

        .lightbox-content {
            transform: scale(0.95);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .lightbox.active .lightbox-content {
            transform: scale(1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Include Navbar -->
    <?php include 'navbar.php'; ?>

    <main class="pt-24 pb-16">
        <!-- Header Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center space-y-6 mb-16 title-animation">
                <div class="flex items-center justify-center space-x-4 mb-4">
                    <span class="h-px w-12 bg-blue-600"></span>
                    <span class="text-blue-600 font-medium tracking-wide">GALERI</span>
                    <span class="h-px w-12 bg-blue-600"></span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-blue-900 floating-element">
                    Network Management System
                </h1>
                <p class="text-gray-500 max-w-2xl mx-auto">
                    Koleksi gambar dan dokumentasi sistem manajemen jaringan kami
                </p>
            </div>

            <!-- Gallery Grid -->
            <div id="gallery" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"></div>
        </div>
    </main>

    <!-- Modern Lightbox -->
    <div id="lightbox" class="lightbox justify-center items-center">
        <div class="lightbox-content max-w-4xl w-full mx-4 bg-white rounded-2xl overflow-hidden">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                <h3 id="lightbox-title" class="text-lg font-semibold text-gray-900"></h3>
                <button onclick="closeLightbox()" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="p-4">
                <img id="lightbox-img" src="" alt="" class="w-full rounded-lg">
                <div class="mt-4 flex justify-between items-center text-sm text-gray-500">
                    <p id="lightbox-author"></p>
                    <p id="lightbox-date"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const galleryItems = [
            {
                title: "Network Infrastructure Overview",
                author: "John Smith",
                date: "October 15, 2023",
                image: "/images/spicy1.jpg",
                alt: "Network infrastructure diagram and equipment"
            },
            {
                title: "System Performance Analysis",
                author: "Sarah Johnson",
                date: "November 3, 2023",
                image: "/images/spicy1.jpg",
                alt: "System performance graphs and metrics"
            },
            {
                title: "Security Implementation",
                author: "Mike Davis",
                date: "December 8, 2023",
                image: "/images/spicy1.jpg",
                alt: "Network security implementation diagram"
            },
            {
                title: "Network Monitoring Tools",
                author: "Emma Wilson",
                date: "January 22, 2024",
                image: "/images/spicy1.jpg",
                alt: "Network monitoring dashboard"
            },
            {
                title: "Data Center Management",
                author: "Alex Chen",
                date: "February 15, 2024",
                image: "/images/spicy1.jpg",
                alt: "Data center management interface"
            },
            {
                title: "Network Optimization",
                author: "David Park",
                date: "March 5, 2024",
                image: "/images/spicy1.jpg",
                alt: "Network optimization metrics"
            }
        ];

        document.addEventListener("DOMContentLoaded", () => {
            const galleryContainer = document.getElementById("gallery");
            
            galleryItems.forEach((item, index) => {
                const galleryItem = document.createElement("div");
                galleryItem.className = "gallery-item";
                galleryItem.style.animationDelay = `${index * 0.1}s`;
                
                galleryItem.innerHTML = `
                    <div class="relative overflow-hidden rounded-2xl bg-white shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="aspect-[4/3] overflow-hidden">
                            <img src="${item.image}" 
                                 alt="${item.alt}" 
                                 class="gallery-image w-full h-full object-cover"
                                 loading="lazy" />
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/0 to-transparent opacity-0 transition-opacity duration-300"></div>
                        <div class="absolute inset-x-0 bottom-0 p-6 hover-info">
                            <h3 class="text-white font-semibold text-xl mb-2">${item.title}</h3>
                            <div class="flex items-center justify-between text-sm text-gray-300">
                                <p class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    ${item.author}
                                </p>
                                <p class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    ${item.date}
                                </p>
                            </div>
                        </div>
                    </div>
                `;
                
                galleryItem.addEventListener("click", () => showLightbox(item));
                galleryContainer.appendChild(galleryItem);
            });
        });

        function showLightbox(item) {
            const lightbox = document.getElementById("lightbox");
            const lightboxImg = document.getElementById("lightbox-img");
            const lightboxTitle = document.getElementById("lightbox-title");
            const lightboxAuthor = document.getElementById("lightbox-author");
            const lightboxDate = document.getElementById("lightbox-date");

            lightboxImg.src = item.image;
            lightboxTitle.textContent = item.title;
            lightboxAuthor.textContent = `By ${item.author}`;
            lightboxDate.textContent = item.date;

            lightbox.classList.add("active");
            document.body.style.overflow = "hidden";
        }

        function closeLightbox() {
            const lightbox = document.getElementById("lightbox");
            lightbox.classList.remove("active");
            document.body.style.overflow = "";
        }
    </script>
</body>
</html>

