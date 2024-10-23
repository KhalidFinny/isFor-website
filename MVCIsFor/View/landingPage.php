<?php include '../Template/navbar.php'; ?>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../View/Css/styleweb.css">
<main>
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

    // About Us Section Script
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
    <section class="utama">
        <div class="deskripsi">
            <h1>IsFor Pusat Riset Informatika</h1>
            <p>IsFor merupakan website untuk pusat riset informatika yang merupakan pusat dari segala penelitian untuk yang berhubungan dengan informatika.</p>
            <div class="buttons">
                <a href="#" class="btn-secondary">Contact us!</a>
            </div>
            <div class="leader">
                <img src="Images/THeVLo6.jpeg" alt="Pak Erfan">
                <p>Pak Erfan<br><span>Leading Informatics Researcher</span></p>
            </div>
        </div>
        <div class="image-utama">
            <img id="main-image" src="Images/2020-08-22.jpg" alt="Gedung Riset">
        </div>
</main>
