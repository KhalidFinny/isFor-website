<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="../View/Css/styleweb.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            var images = [
                "./images/2020-08-22.jpg", 
                "./images/Polinema-Malang.png", 
                "./images/DSC_0746-scaled.jpg"  
            ];
            var currentImage = 0;

            setInterval(function() {
                $("#main-image").fadeOut(1000, function() {
                    currentImage = (currentImage + 1) % images.length; 
                    $(this).attr("src", images[currentImage]);
                    $(this).fadeIn(1000); 
                });
            }, 10000); 
        });
    </script>
<script>
$(document).ready(function () {
    const $tentangKamiSection = $('.tentangkami');

    function showTentangKami() {
        $tentangKamiSection.addClass('show');
    }

    $('#showAboutUs').click(function (event) {
        event.preventDefault(); 
        showTentangKami();
    });

    $(window).scroll(function () {
        const sectionPosition = $tentangKamiSection.offset().top;
        const screenPosition = $(window).height() * 0.8;

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