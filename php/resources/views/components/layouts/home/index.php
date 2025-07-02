<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?= $title ?? 'IsFor Internet of Things For Human Life\'s' ?></title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= CSS; ?>/navbaranimation.css">
    <link rel="stylesheet" href="<?= CSS; ?>/animations.css">
    <link rel="stylesheet" href="<?= CSS; ?>/cross-browser.css">
    <link rel="stylesheet" href="http://localhost/IsFor-website/php/app/views/assets/css/inandout.css">

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <script src="http://localhost/IsFor-website/php/app/views/assets/js/animations.js" defer></script>
</head>
<body class="grid-pattern">

<?php if (!isset($_SESSION['user_id'])): ?>
    <?php include_once __DIR__ . '/../components/navbar.php'; ?>
<?php else: ?>
    <?php include_once __DIR__ . '/../components/navbarafterlogin.php'; ?>
<?php endif; ?>

<?= $slot ?>

<?php include_once __DIR__ . '/../components/footer.php'; ?>

<script src="<?= JS; ?>/data.js"></script>
</body>
</html>
