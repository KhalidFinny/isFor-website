<?php
session_start();
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    echo "<script>
            window.addEventListener('DOMContentLoaded', (event) => {
                const alertDiv = document.getElementById('customAlert');
                const alertMessage = document.getElementById('alertMessage');
                if(alertDiv && alertMessage) {
                    alertMessage.textContent = '$message';
                    alertDiv.style.display = 'flex';
                    setTimeout(() => {
                        alertDiv.style.display = 'none';
                    }, 3000);
                }
            });
          </script>";
    unset($_SESSION['message']);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=CSS;?>/main/login.css">
</head>
<body class="bg-white" style="font-family: 'Plus Jakarta Sans', sans-serif;">

<div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10">
    <div class="circle circle-1"></div>
    <div class="circle circle-2"></div>
    <div class="circle circle-3"></div>
</div>

<div class="w-full min-h-screen flex flex-col relative z-10">
    <header class="flex-shrink-0 hidden sm:flex">
        <div class="fixed top-0 left-0 p-4 sm:p-6 transform-gpu z-30">
            <a href="<?=BASEURL;?>/home" class="text-red-600 hover:text-red-700 font-medium hover-translate inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </header>

    <main class="w-full flex-grow flex flex-col items-center justify-center px-4 pt-12 sm:pt-24 pb-12">
        <div class="mb-6">
            <img src="<?=IMAGES;?>/Logo1.webp" alt="IsFor Logo" class="h-14 sm:h-16 mx-auto"/>
        </div>

        <div class="w-full max-w-md glass-effect rounded-2xl p-6 sm:p-8 fade-in">
            <div class="text-center mb-6">
                <h2 class="text-2xl sm:text-3xl font-bold text-red-600">Selamat Datang</h2>
                <p class="text-red-600 mt-2 text-base">Masuk untuk melanjutkan</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="p-4 mb-6 bg-red-50/50 rounded-lg">
                    <p class="text-red-600 text-sm"><?php echo $_SESSION['error']; ?></p>
                </div>
                <?php unset($_SESSION['error']);?>
            <?php endif;?>

            <form id="loginForm" method="POST" action="<?=BASEURL;?>/login/authentication" class="space-y-6">
                <div>
                    <label for="username" class="block text-red-600 text-sm font-medium mb-2">Username</label>
                    <input type="text" id="username" name="username" required class="w-full px-4 py-3 bg-white/50 rounded-xl border border-red-200 focus:border-red-500 focus:outline-none input-focus" placeholder="Masukkan username anda"/>
                </div>
                <div>
                    <label for="password" class="block text-red-600 text-sm font-medium mb-2">Password</label>
                    <input type="password" id="password" name="password" required class="w-full px-4 py-3 bg-white/50 rounded-xl border border-red-200 focus:border-red-500 focus:outline-none input-focus" placeholder="Masukkan password anda"/>
                </div>
                <div class="text-center text-sm flex flex-col sm:flex-row sm:items-center sm:justify-center sm:gap-1">
                    <span class="text-red-600">Lupa password? Hubungi</span>
                    <a href="mailto:arianto@polinema.ac.id" class="text-red-700 hover:text-red-900 font-medium">arianto@polinema.ac.id</a>
                </div>
                <button type="submit" class="w-full py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl font-medium transition-all duration-300 hover:-translate-y-0.5">
                    Masuk
                </button>
            </form>

            <div class="mt-4 text-center sm:hidden">
                <a href="<?=BASEURL;?>/home"
                   class="inline-flex items-center justify-center gap-2 w-full py-3 text-red-500 border border-red-500 rounded-xl font-medium transition-all duration-300 hover:bg-red-100">
                    Kembali
                </a>
            </div>
        </div>
    </main>

    <footer class="flex-shrink-0 w-full p-4">
        <div class="text-red-400 text-sm text-center">
            © 2024 ISFOR. All rights reserved.
        </div>
    </footer>
</div>

<div id="customAlert" class="fixed bottom-4 right-4 glass-effect rounded-xl p-4 hidden items-center gap-2 fade-in z-50" style="display: none;">
    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <span id="alertMessage" class="text-red-600 font-medium"></span>
</div>

<script src="<?=JS;?>/login.js"></script>
</body>
</html>