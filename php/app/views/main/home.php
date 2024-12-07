<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASEURL;?>/assets/css/navbaranimation.css">
    <link rel="stylesheet" href="<?= BASEURL;?>/assets/css/animations.css">
    <link rel="stylesheet" href="<?= ASSETS; ?>/css/cross-browser.css">
    <base href="/isfor-web/"/>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <link rel="stylesheet" href="http://localhost/IsFor-website/php/app/views/assets/css/inandout.css">
    <script src="http://localhost/IsFor-website/php/app/views/assets/js/animations.js" defer></script>
</head>
<body class="grid-pattern">
<?php if (!isset($_SESSION['user_id'])) : ?>
    <?php include_once '../app/views/assets/components/navbar.php'; ?>
<?php else : ?>
    <?php include_once '../app/views/assets/components/navbarafterlogin.php'; ?>
<?php endif; ?>
<?php include_once '../app/views/assets/components/LandingPage/hero.php'; ?>
<div id="Sejarah">
    <?php include_once '../app/views/assets/components/LandingPage/sejarah.php'; ?>
</div>
<div id="Visimisi">
    <?php include_once '../app/views/assets/components/LandingPage/visimisi.php'; ?>
</div>
<div id="Roadmap">
    <?php include_once '../app/views/assets/components/LandingPage/roadmap.php'; ?>
</div>
<div id="Organisasi">
    <?php include_once '../app/views/assets/components/LandingPage/strukturOrganisasi.php'; ?>
</div>
<div id="Pengelola">
    <?php include_once '../app/views/assets/components/LandingPage/pengelola.php'; ?>
</div>
<div id="Peneliti">
    <?php include_once '../app/views/assets/components/LandingPage/researchers-list.php'; ?>
</div>
<?php include_once '../app/views/assets/components/footer.php'; ?>
<!-- Add data.js script -->
<script src="<?= ASSETS; ?>/js/data.js"></script>
</body>
</html>
