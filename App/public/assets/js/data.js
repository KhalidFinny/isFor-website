//ROADMAP
const categories = [
    {
        name: "Smart ICT",
        color: "blue",
        symbol: `<svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
        </svg>`
    },
    {
        name: "IoT Applications",
        color: "purple",
        symbol: `<svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
        </svg>`
    },
    {
        name: "Data Science & Analytics",
        color: "blue",
        symbol: `<svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
        </svg>`
    },
    {
        name: "Business Management",
        color: "purple",
        symbol: `<svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>`
    }
];

const timelineData = [
    {
        period: "2018-2022",
        items: {
            "Smart ICT": ["Network management System", "Network Topology", "Concept/Electronics and IT Embedded System"],
            "IoT Applications": ["IoT systems", "Sensors for IoT"],
            "Data Science & Analytics": ["Decision Support System", "Classification System", "Prediction System", "Cluster Analysis"],
            "Business Management": ["Digital Marketing", "Micro Commerce Management", "Digital Tax Management"]
        }
    },
    {
        period: "2022-2025",
        items: {
            "Smart ICT": ["LORA Systems", "LORA mesh for IT Systems", "LORA for Smart Systems"],
            "IoT Applications": ["IoT for urban farming", "IoT for freshwater fish", "Smart Home", "IoT for Power Electric Distribution"],
            "Data Science & Analytics": ["Big Data Analysis", "Natural Language Processing", "Image Processing"],
            "Business Management": ["Governance Fiscal Independence", "Commercial Port Management System", "Document Archiving Management"]
        }
    },
    {
        period: "2026-2028",
        items: {
            "Smart ICT": ["ICT for Industrial Automation", "Integrated Data Transaction"],
            "IoT Applications": ["Smart City", "Smart Ecosystem", "Smart monitoring Systems"],
            "Data Science & Analytics": ["Voice Command Technology", "Land & Building Mapping", "Intelligence System", "Integrated Information System"],
            "Business Management": ["Customer Relation Management System", "Supply Chain Management", "Analytic of Documents Archiving"]
        }
    }
];

const renderTimeline = () => {
    const container = document.getElementById('timeline');

    timelineData.forEach((phase, index) => {
        const phaseElement = document.createElement('div');
        phaseElement.className = `relative animate-scale`;
        phaseElement.style.animationDelay = `${index * 0.2}s`;

        phaseElement.innerHTML = `
            <div class="flex items-center mb-8">
                <div class="p-4 bg-blue-50 rounded-2xl">
                    <h3 class="display-font text-2xl font-bold text-blue-700">${phase.period}</h3>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                ${categories.map((category, catIndex) => `
                    <div class="p-6 bg-white rounded-3xl animate-float" style="animation-delay: ${catIndex * 0.1}s">
                        <div class="flex items-center mb-4">
                            <div class="text-blue-600 mr-3">
                                ${category.symbol}
                            </div>
                            <h4 class="display-font text-lg font-bold text-blue-600">${category.name}</h4>
                        </div>
                        <ul class="space-y-3">
                            ${phase.items[category.name]?.map(item => `
                                <li class="flex items-start group">
                                    <span class="flex-shrink-0 w-1.5 h-1.5 mt-2 bg-${category.color}-600 rounded-full mr-3"></span>
                                    <span class="text-gray-600 group-hover:text-gray-900 transition-colors">${item}</span>
                                </li>
                            `).join('')}
                        </ul>
                    </div>
                `).join('')}
            </div>
        `;
        container.appendChild(phaseElement);
    });
};
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
    renderTimeline();
    renderPengelola();
    renderResearchers();
});
