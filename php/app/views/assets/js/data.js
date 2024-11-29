//PENGELOLA
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
