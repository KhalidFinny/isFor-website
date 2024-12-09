<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>IsFor Pusat Riset Informatika</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ASSETS; ?>/css/animations.css">
</head>
<!-- Sejarah Section -->
<section class="min-h-screen py-20 relative overflow-hidden">
    <div class="container mx-auto px-6">
        <div class="swiss-grid">
            <div class="col-span-12 text-center mb-16">
                <span class="inline-block px-4 py-2 bg-red-50 text-red-500 rounded-full text-sm font-medium mb-4">
                    Perjalanan Kami
                </span>
                <h2 class="display-font text-4xl lg:text-5xl font-bold mb-4 text-red-700">
                    Sejarah IsFor
                </h2>
            </div>

            <div class="col-span-12 lg:col-span-6 space-y-12 stagger-animation">
                <div class="relative pl-8 border-l-2 border-red-200">
                    <div class="absolute -left-2.5 top-0 w-5 h-5 bg-red-500 rounded-full animate-float"></div>
                    <h3 class="text-xl font-bold text-red-500 mb-2">Awal Mula</h3>
                    <p class="text-gray-600">
                        Pusat Riset IsFoR (Internet of Things for Human Life) didirikan pada Tahun 2021 untuk mewadahi
                        berbagai riset dosen dan mahasiswa tentang IoT.
                    </p>
                </div>

                <div class="relative pl-8 border-l-2 border-red-200">
                    <div class="absolute -left-2.5 top-0 w-5 h-5 bg-red-500 rounded-full animate-float"
                         style="animation-delay: 0.2s"></div>
                    <h3 class="text-xl font-bold text-red-500 mb-2">Perkembangan</h3>
                    <p class="text-gray-600">
                        Fokus pada pengembangan teknologi IoT untuk meningkatkan kualitas hidup manusia melalui berbagai
                        inovasi dan kolaborasi.
                    </p>
                </div>

                <div class="grid grid-cols-3 gap-6 mt-12">
                    <div class="p-6 bg-red-50 rounded-2xl animate-float text-center">
                        <div class="text-4xl font-bold text-red-500">3+</div>
                        <div class="text-sm text-gray-600">Partner</div>
                    </div>
                    <div class="p-6 bg-red-50 rounded-2xl animate-float" style="animation-delay: 0.2s">
                        <div class="text-4xl font-bold text-red-500">5+</div>
                        <div class="text-sm text-gray-600">Produk</div>
                    </div>
                    <div class="p-6 bg-red-50 rounded-2xl animate-float" style="animation-delay: 0.4s">
                        <div class="text-4xl font-bold text-red-500">2021</div>
                        <div class="text-sm text-gray-600">Tahun</div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-5 lg:col-start-8">
                <div class="relative">
                    <div class="absolute inset-0 blob-shape bg-red-100 animate-float"></div>
                    <img src="<?= ASSETS; ?>/images/Logo1.webp"
                         alt="IsFor Logo"
                         class="relative rounded-3xl animate-float"/>
                </div>
            </div>
        </div>
    </div>
</section>
