<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>IsFor Pusat Riset Informatika</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .researcher-card {
            animation: fadeInUp 0.5s ease-out forwards;
            opacity: 0;
            border-width: 2px;
            border-style: solid;
            transition: transform 0.3s ease, border-color 0.3s ease;
        }
        .researcher-card:hover {
            transform: translateY(-2px);
        }
        .researcher-card:nth-child(n) {
            animation-delay: calc(n * 0.1s);
        }
    </style>
</head>

<!-- Researchers Section -->
<section class="min-h-screen py-20 relative overflow-hidden">
    <div class="container mx-auto px-6">
        <div class="swiss-grid">
            <div class="col-span-12 text-center mb-16">
                <span class="inline-block px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-sm font-medium mb-4">
                    Tim Kami
                </span>
                <h2 class="display-font text-4xl lg:text-5xl font-bold mb-4 text-blue-900">
                    Peneliti
                </h2>
                <div class="w-24 h-1 mx-auto bg-gradient-to-r from-blue-600 to-blue-800 rounded-full"></div>
            </div>

            <div class="col-span-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <?php
                $researchers = [
                    ["name" => "Vipkas Al Hadid Firdaus, ST., MT"],
                    ["name" => "Ade Ismail, S.Kom., M.TI"],
                    ["name" => "Habibie Ed Dien, S.Kom., MT"],
                    ["name" => "Septian Enggar Sukmana, S.Pd., MT"],
                    ["name" => "Vivi Nur Wijayaningrum, S.Kom., M.Kom"],
                    ["name" => "Rokhimatul Wakhidah, S.Pd., M.T."],
                    ["name" => "Noprianto, S.Kom., M.Eng."],
                    ["name" => "Anugrah Nur Rahmanto"],
                    ["name" => "Maskur, S.Kom., M.Kom"],
                    ["name" => "Nurul Hidayatinnisa', SE., MM"],
                    ["name" => "Sapto Wibowo, S.T., M.Sc., Ph.D."],
                    ["name" => "Ir. Nugroho Suharto, M.T"],
                    ["name" => "Galih Putra Riatma, S.ST., M.T."]
                ];

                foreach ($researchers as $index => $researcher): ?>
                    <div class="researcher-card group p-5 bg-white rounded-xl border-2 border-blue-200 hover:border-blue-400 transition-all duration-300 ease-in-out"
                         style="animation-delay: <?php echo $index * 0.1; ?>s">
                        <h3 class="text-lg font-medium text-blue-900 group-hover:text-blue-600 transition-colors duration-300">
                            <?php echo $researcher['name']; ?>
                        </h3>
                        <div class="w-0 group-hover:w-full h-0.5 bg-gradient-to-r from-blue-400 to-blue-600 transition-all duration-300 ease-in-out mt-2"></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.researcher-card');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                    }
                });
            }, {
                threshold: 0.1
            });

            cards.forEach(card => {
                card.style.animationPlayState = 'paused';
                observer.observe(card);
            });
        });
    </script>
</section>
</html>


<!--<!DOCTYPE html>-->
<!--<html lang="id">-->
<!--<head>-->
<!--    <meta charset="utf-8"/>-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>-->
<!--    <title>IsFor Pusat Riset Informatika</title>-->
<!--    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"-->
<!--          rel="stylesheet">-->
<!--    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">-->
<!--</head>-->
<!--<body>-->
<!-- Other Sections -->-->
<!---->
<!-- Researchers Section -->-->
<!--<section id="researchers-section" class="py-20">-->
<!--    <div id="researchers-list" class="container mx-auto"></div>-->
<!--</section>-->
<!---->
<!--<script>-->
<!--    const researchers = {-->
<!--        teknologiInformasi: [-->
<!--            {name: "Vipkas Al Hadid Firdaus, ST., MT"},-->
<!--            {name: "Ade Ismail, S.Kom., M.TI"},-->
<!--            {name: "Habibie Ed Dien, S.Kom., MT"},-->
<!--            {name: "Septian Enggar Sukmana, S.Pd., MT"},-->
<!--            {name: "Vivi Nur Wijayaningrum, S.Kom., M.Kom"},-->
<!--            {name: "Rokhimatul Wakhidah, S.Pd., M.T."},-->
<!--            {name: "Noprianto, S.Kom., M.Eng."},-->
<!--            {name: "Anugrah Nur Rahmanto"}-->
<!--        ],-->
<!--        administrasiNiaga: [-->
<!--            {name: "Maskur, S.Kom., M.Kom"},-->
<!--            {name: "Nurul Hidayatinnisa', SE., MM"}-->
<!--        ],-->
<!--        teknikElektro: [-->
<!--            {name: "Sapto Wibowo, S.T., M.Sc., Ph.D."},-->
<!--            {name: "Ir. Nugroho Suharto, M.T"},-->
<!--            {name: "Galih Putra Riatma, S.ST., M.T."}-->
<!--        ]-->
<!--    };-->
<!---->
<!--    const renderResearchers = () => {-->
<!--        const container = document.getElementById('researchers-list');-->
<!--        Object.keys(researchers).forEach(category => {-->
<!--            const categoryDiv = document.createElement('div');-->
<!--            categoryDiv.className = 'bg-blue-50/50 rounded-2xl p-8 border-2 border-blue-100 animate-scale';-->
<!--            categoryDiv.innerHTML = `-->
<!--                    <h2 class="text-2xl font-bold text-blue-700 mb-8 flex items-center">-->
<!--                        <div class="w-3 h-12 bg-blue-400 mr-4 rounded-full"></div>-->
<!--                        <span class="border-b-2 border-dashed border-blue-200 pb-2">-->
<!--                            ${category.replace(/([A-Z])/g, ' $1')}-->
<!--                        </span>-->
<!--                    </h2>-->
<!--                    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">-->
<!--                        ${researchers[category].map(researcher => `-->
<!--                            <li class="flex items-center group p-3 rounded-xl border-2 border-transparent hover:border-blue-200 hover:bg-white transition-all">-->
<!--                                <div class="w-2 h-2 rounded-full bg-blue-300 group-hover:bg-blue-500 mr-3 transition-all group-hover:scale-150"></div>-->
<!--                                <span class="text-gray-600 group-hover:text-blue-700 transition-colors">-->
<!--                                    ${researcher.name}-->
<!--                                </span>-->
<!--                            </li>-->
<!--                        `).join('')}-->
<!--                    </ul>-->
<!--                `;-->
<!--            container.appendChild(categoryDiv);-->
<!--        });-->
<!--    };-->
<!---->
<!--    document.addEventListener('DOMContentLoaded', () => {-->
<!--        renderResearchers();-->
<!--    });-->
<!--</script>-->
<!--</body>-->
<!--</html>-->
