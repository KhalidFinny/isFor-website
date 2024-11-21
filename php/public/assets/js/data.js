
//PENGELOLA
const pengelolaList = [
    {
        name: "Erfan Rohadi, ST., M.Eng., Ph.D",
        role: "Ketua",
        nip: "197201232008011006",
        img: "/isfor-web/App/public/assets/images/PakErfan.png"
    },
    {
        name: "Dr. Rakhmat Arianto, S.ST., M.Kom",
        role: "Sekretaris Umum",
        nip: "198701082019031004",
        img: "/isfor-web/App/public/assets/images/rakhmatarianto.png"
    },
    {
        name: "Usman Nurhasan, S.Kom., MT",
        role: "Bendahara",
        nip: "198609232015041001",
        img: "/isfor-web/App/public/assets/images/usmannurhasan.png"
    },
    {
        name: "Indrazno Siradjuddin, ST., MT., Ph.D",
        role: "Kadiv Penelitian dan Inovasi",
        nip: "197406242000121001",
        img: "/isfor-web/App/public/assets/images/Indrazno.png"
    },
    {
        name: "Imam Fahrur Rozi, S.T., M.T",
        role: "Kadiv. Pengabdian Masyarakat",
        nip: "198406102008121004",
        img: "/isfor-web/App/public/assets/images/imam.png"
    },
    {
        name: "Rudy Ariyanto, ST., M.Cs",
        role: "Kadiv. Kerjasama",
        nip: "197111101999031002",
        img: "/isfor-web/App/public/assets/images/rudy.png"
    },
    {
        name: "Ahmadi Yuli Ananta, ST., M.M.",
        role: "Kadiv. Publikasi dan Sistem Informasi",
        nip: "198107052005011002",
        img: "/isfor-web/App/public/assets/images/ahmadi.png"
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
// Add after pengelolaList
const researchers = {
    teknologiInformasi: [
        { name: "Vipkas Al Hadid Firdaus, ST., MT" },
        { name: "Ade Ismail, S.Kom., M.TI" },
        { name: "Habibie Ed Dien, S.Kom., MT" },
        { name: "Septian Enggar Sukmana, S.Pd., MT" },
        { name: "Vivi Nur Wijayaningrum, S.Kom., M.Kom" },
        { name: "Rokhimatul Wakhidah, S.Pd., M.T." },
        { name: "Noprianto, S.Kom., M.Eng." },
        { name: "Anugrah Nur Rahmanto" }
    ],
    administrasiNiaga: [
        { name: "Maskur, S.Kom., M.Kom" },
        { name: "Nurul Hidayatinnisa', SE., MM" }
    ],
    teknikElektro: [
        { name: "Sapto Wibowo, S.T., M.Sc., Ph.D." },
        { name: "Ir. Nugroho Suharto, M.T" },
        { name: "Galih Putra Riatma, S.ST., M.T." }
    ]
};

// Add the render function
const renderResearchers = () => {
    const container = document.getElementById('researchers-list');
    Object.keys(researchers).forEach(category => {
        const categoryDiv = document.createElement('div');
        categoryDiv.className = 'bg-blue-50/50 rounded-2xl p-8 border-2 border-blue-100 animate-scale';
        categoryDiv.innerHTML = `
            <h2 class="text-2xl font-bold text-blue-700 mb-8 flex items-center">
                <div class="w-3 h-12 bg-blue-400 mr-4 rounded-full"></div>
                <span class="border-b-2 border-dashed border-blue-200 pb-2">
                    ${category.replace(/([A-Z])/g, ' $1')}
                </span>
            </h2>
            <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                ${researchers[category].map(researcher => `
                    <li class="flex items-center group p-3 rounded-xl border-2 border-transparent hover:border-blue-200 hover:bg-white transition-all">
                        <div class="w-2 h-2 rounded-full bg-blue-300 group-hover:bg-blue-500 mr-3 transition-all group-hover:scale-150"></div>
                        <span class="text-gray-600 group-hover:text-blue-700 transition-colors">
                            ${researcher.name}
                        </span>
                    </li>
                `).join('')}
            </ul>
        `;
        container.appendChild(categoryDiv);
    });
};

// Update the DOMContentLoaded event listener
document.addEventListener('DOMContentLoaded', () => {
    // renderTimeline(); // Uncomment if needed
    renderPengelola();
    renderResearchers();
});
