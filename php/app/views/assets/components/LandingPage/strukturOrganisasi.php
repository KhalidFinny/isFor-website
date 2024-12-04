<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .fade-in-scale {
            opacity: 0;
            transform: scale(0.95);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .fade-in-scale.visible {
            opacity: 1;
            transform: scale(1);
        }
        
        .image-container {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            border: 2px solid #E5E7EB;
            transition: border-color 0.3s ease;
        }
        
        .image-container:hover {
            border-color: #F87171;
        }
        
        .image-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent
            );
            animation: shine 3s infinite;
        }
        
        @keyframes shine {
            to {
                left: 100%;
            }
        }
    </style>
</head>

<!-- Struktur Organisasi Section -->
<section class="min-h-screen py-20 relative overflow-hidden">
    <div class="container mx-auto px-6">
        <div class="swiss-grid">
            <!-- Header -->
            <div class="col-span-12 text-center mb-16">
                <span class="inline-block px-4 py-2 bg-red-50 text-red-500 rounded-full text-sm font-medium mb-4">
                    Struktur
                </span>
                <h2 class="display-font text-4xl lg:text-5xl font-bold mb-4 text-red-700">
                    Struktur Organisasi
                </h2>
                <div class="w-24 h-1 mx-auto bg-red-700 rounded-full"></div>
            </div>

            <!-- Image Container -->
            <div class="col-span-12 max-w-5xl mx-auto">
                <div class="fade-in-scale image-container">
                    <img 
                        src="<?= ASSETS ?>/images/Organisasi.webp" 
                        alt="Struktur Organisasi" 
                        class="w-full h-auto object-cover"
                        loading="lazy"
                    >
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            const fadeElements = document.querySelectorAll('.fade-in-scale');
            fadeElements.forEach(element => {
                observer.observe(element);
            });
        });
    </script>
</section>
</html>
