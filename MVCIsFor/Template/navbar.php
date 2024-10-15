<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="../View/Css/styleweb.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    var images = [
        "./images/2020-08-22.jpg", 
        "./images/Polinema-Malang.png", 
        "./images/DSC_0746-scaled.jpg"
    ];
    var currentImage = 0;
    var mainImage = document.getElementById("main-image");

    setInterval(function() {
        mainImage.style.opacity = 0; 
        setTimeout(function() {
            currentImage = (currentImage + 1) % images.length;
            mainImage.src = images[currentImage];
            mainImage.style.opacity = 1;
        }, 1000);
    }, 10000);
});

document.addEventListener("DOMContentLoaded", function() {
    var tentangKamiSection = document.querySelector('.tentangkami');
    var showAboutUsButton = document.getElementById('showAboutUs');

    function showTentangKami() {
        tentangKamiSection.classList.add('show');
    }

    showAboutUsButton.addEventListener('click', function(event) {
        event.preventDefault();
        showTentangKami();
    });

    window.addEventListener('scroll', function() {
        var sectionPosition = tentangKamiSection.getBoundingClientRect().top;
        var screenPosition = window.innerHeight * 0.8;

        if (sectionPosition < screenPosition) {
            showTentangKami();
        }
    });
});
    </script>
</head>
<body>
    <header>
        <div class="logo-title">
            <img src="../View/Images/polinema_logo%202.png" alt="Logo IsFor" class="logo">
            <h3 class="title">IsFor Pusat Riset Informatika</h3>
        </div>
        <nav>
            <ul>
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Tentang Kami</a></li>
                <li><a href="#">Riset & Publikasi</a></li>
                <li><a href="#">Agenda</a></li>
                <li><a href="#">Arsip</a></li>
                <li><a href="#">Galeri</a></li>
            </ul>
        </nav>
        <div class="profile-icon"></div>
    </header>
</body>
</html>