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
<body>
<script>
    const pengelolaList = [
        {
            name: "Erfan Rohadi, ST., M.Eng., Ph.D",
            role: "Ketua",
            nip: "197201232008011006",
            img: "http://localhost/IsFor-website/php/app/views/assets/images/PakErfan.png"
        },
        {
            name: "Dr. Rakhmat Arianto, S.ST., M.Kom",
            role: "Sekretaris Umum",
            nip: "198701082019031004",
            img: "http://localhost/IsFor-website/php/app/views/assets/images/rakhmatarianto.png"
        },
        {
            name: "Usman Nurhasan, S.Kom., MT",
            role: "Bendahara",
            nip: "198609232015041001",
            img: "http://localhost/IsFor-website/php/app/views/assets/images/usmannurhasan.png"
        },
        {
            name: "Indrazno Siradjuddin, ST., MT., Ph.D",
            role: "Kadiv Penelitian dan Inovasi",
            nip: "197406242000121001",
            img: "http://localhost/IsFor-website/php/app/views/assets/images/Indrazno.png"
        },
        {
            name: "Imam Fahrur Rozi, S.T., M.T",
            role: "Kadiv. Pengabdian Masyarakat",
            nip: "198406102008121004",
            img: "http://localhost/IsFor-website/php/app/views/assets/images/imam.png"
        },
        {
            name: "Rudy Ariyanto, ST., M.Cs",
            role: "Kadiv. Kerjasama",
            nip: "197111101999031002",
            img: "http://localhost/IsFor-website/php/app/views/assets/images/rudy.png"
        },
        {
            name: "Ahmadi Yuli Ananta, ST., M.M.",
            role: "Kadiv. Publikasi dan Sistem Informasi",
            nip: "198107052005011002",
            img: "http://localhost/IsFor-website/php/app/views/assets/images/ahmadi.png"
        }
    ];

    const renderPengelola = () => {
        const container = document.getElementById('pengelola-list');
        pengelolaList.forEach((person, index) => {
            const pengelolaDiv = document.createElement('div');
            pengelolaDiv.className = 'pengelola-card animate-scale';
            pengelolaDiv.style.animationDelay = `${index * 0.1}s`;

            pengelolaDiv.innerHTML = `
                <div class="pengelola-image-container">
                    <img
                        class="pengelola-image"
                        src="${person.img}" 
                        alt="${person.name}" 
                        loading="lazy"
                    />
                </div>
                <div class="pengelola-info">
                    <h4 class="display-font text-lg font-bold text-white mb-1">${person.name}</h4>
                    <p class="text-blue-200 text-sm mb-2">${person.role}</p>
                    <p class="text-blue-100 text-xs">
                        NIP: ${person.nip}
                    </p>
                </div>
            `;

            container.appendChild(pengelolaDiv);
        });
    };

    document.addEventListener('DOMContentLoaded', renderPengelola);
</script>
<!-- Pengelola Section -->
<section class="min-h-screen py-20 relative overflow-hidden">
    <div class="container mx-auto px-6">
        <div class="swiss-grid">
            <div class="col-span-12 text-center mb-16">
                <span class="inline-block px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-sm font-medium mb-4">
                    Tim Kami
                </span>
                <h2 class="display-font text-4xl lg:text-5xl font-bold mb-4 text-blue-900">
                    Pengelola
                </h2>
                <div class="w-24 h-1 mx-auto bg-gradient-to-r from-blue-600 to-blue-800 rounded-full"></div>
            </div>

            <div id="pengelola-list" class="col-span-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"></div>
        </div>
    </div>
</section>
</body>
</html>