<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../public/index.php?page=login');  // Redirect ke login jika belum login
    exit();
}
?>

<!-- Konten Dashboard Anda -->
<h1>Welcome to the Dashboard, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
