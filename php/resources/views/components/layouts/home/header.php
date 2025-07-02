<?php
// Selalu letakkan session_start() di baris paling awal
session_start();

// Anda bisa mendefinisikan konstanta path di sini atau di file konfigurasi terpisah
define('BASE_URL', '/isfor-web/');
define('CSS_PATH', BASE_URL . 'path/to/your/css'); // Ganti dengan path CSS Anda
define('JS_PATH', BASE_URL . 'path/to/your/js');   // Ganti dengan path JS Anda
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?= isset($pageTitle) ? $pageTitle : "IsFor - Internet of Things For Human Life's" ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <link rel="stylesheet" href="<?= CSS_PATH; ?>/navbaranimation.css">
    <link rel="stylesheet" href="<?= CSS_PATH; ?>/animations.css">
    <link rel="stylesheet" href="<?= CSS_PATH; ?>/cross-browser.css">
    <link rel="stylesheet" href="<?= CSS_PATH; ?>/inandout.css">

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
</head>
<body class="grid-pattern">

<?php
// Logika untuk menampilkan navbar berdasarkan status login
if (!isset($_SESSION['user_id'])) {
    // Path relatif dari file header.php ke komponen navbar
    include_once __DIR__ . '/../app/views/assets/components/navbar.php';
} else {
    // Path relatif dari file header.php ke komponen navbarafterlogin
    include_once __DIR__ . '/../app/views/assets/components/navbarafterlogin.php';
}
?>

<main>