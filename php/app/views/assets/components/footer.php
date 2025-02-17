<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<footer class="bg-white border-t border-red-100">
    <!-- Main Footer Content -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <!-- Brand Section -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <a href="<?= BASEURL ?>" class="flex-shrink-0 flex items-center space-x-3">
                        <img src="<?= IMAGES;?>/Logo1.webp" alt="IsFor Logo" class="h-12 w-auto"/>
                    </a>
                    <div class="flex flex-col">
                        <span class="text-red-600 font-bold text-xl">IsFor</span>
                        <span class="text-gray-500 text-sm">Internet Of Things For Human Life's</span>
                    </div>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed">
                    Sistem informasi penelitian dan pengabdian masyarakat Politeknik Negeri Malang.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="space-y-6">
                <h3 class="text-sm font-semibold text-red-600 uppercase tracking-wider">Research Links</h3>
                <div class="space-y-4">
                    <a href="https://www.scopus.com/" target="_blank"
                       class="flex items-center text-gray-600 hover:text-red-600 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                        Scopus
                    </a>
                    <a href="https://sinta.kemdikbud.go.id/" target="_blank"
                       class="flex items-center text-gray-600 hover:text-red-600 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                        SINTA Kemdikbud
                    </a>
                    <a href="https://scholar.google.com/" target="_blank"
                       class="flex items-center text-gray-600 hover:text-red-600 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Google Scholar
                    </a>
                    <a href="https://jurnal.polinema.ac.id/" target="_blank"
                       class="flex items-center text-gray-600 hover:text-red-600 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"/>
                        </svg>
                        Jurnal Polinema
                    </a>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="space-y-6">
                <h3 class="text-sm font-semibold text-red-600 uppercase tracking-wider">Contact</h3>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3 text-gray-600">
                        <svg class="w-5 h-5 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-sm">arianto@polinema.ac.id</span>
                    </div>
                    <div class="flex items-start space-x-3 text-gray-600">
                        <svg class="w-5 h-5 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div class="text-sm leading-relaxed">
                            Unit Pelayanan Teknis Penelitian dan Pengabdian Masyarakat<br>
                            Politeknik Negeri Malang (POLINEMA)<br>
                            Graha Polinema Lantai 3<br>
                            Jl. Soekarno Hatta No.9, Jatimulyo,<br>
                            Kec. Lowokwaru, Kota Malang,<br>
                            Jawa Timur 65141
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="space-y-6">
                <h3 class="text-sm font-semibold text-red-600 uppercase tracking-wider">Location</h3>
                <div class="rounded-lg overflow-hidden shadow-sm border border-red-200 h-48">
                    <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.4252022391557!2d112.61501431472726!3d-7.946845494277532!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78827687d272e7%3A0x789ce9a636cd3aa2!2sPoliteknik%20Negeri%20Malang!5e0!3m2!1sen!2sid!4v1645523425496!5m2!1sen!2sid"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-red-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <div class="flex justify-center">
                <p class="text-sm text-gray-600 text-center">
                    © <?= date('Y') ?> Pusat Riset Informatika Politeknik Negeri Malang. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>