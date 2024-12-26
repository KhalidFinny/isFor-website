<?php
    session_start();
    if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    echo "<script>alert('$message');</script>";
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
    <link rel="stylesheet" href="<?=CSS;?>/login.css">
</head>
<body class="min-h-screen animated-background" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <!-- Animated Background Circles -->
    <div class="circle circle-1"></div>
    <div class="circle circle-2"></div>
    <div class="circle circle-3"></div>

    <!-- Back Button - Always Visible -->
    <div class="fixed top-6 left-6 z-20">
        <a href="<?=BASEURL;?>/home" class="text-red-600 hover:text-red-700 font-medium hover-translate inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex flex-col items-center justify-center p-6 relative z-10">
        <!-- Logo -->
        <div class="mb-8">
            <img src="<?=ASSETS?>/images/Logo1.webp" alt="IsFor Logo" class="h-16"/>
        </div>

        <!-- Login Container -->
        <div class="w-full max-w-md glass-effect rounded-2xl p-8 fade-in">
            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-red-600">Selamat Datang</h2>
                <p class="text-red-600 mt-2">Masuk untuk melanjutkan ke dashboard</p>
            </div>

            <!-- Error Message -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="p-4 mb-6 bg-red-50/50 rounded-lg">
                    <p class="text-red-600 text-sm"><?php echo $_SESSION['error']; ?></p>
                </div>
                <?php unset($_SESSION['error']);?>
            <?php endif;?>

            <!-- Login Form -->
            <form method="POST" action="<?=BASEURL;?>/login/authentication" class="space-y-6">
                <!-- Username Field -->
                <div class="space-y-2">
                    <label for="username" class="block text-red-600 text-sm font-medium">
                        Username
                    </label>
                    <input type="text"
                           id="username"
                           name="username"
                           required
                           class="w-full px-4 py-3 bg-white/50 rounded-xl border border-red-200
                                  focus:border-red-500 focus:outline-none input-focus"
                           placeholder="Masukkan username anda"/>
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <label for="password" class="block text-red-600 text-sm font-medium">
                        Password
                    </label>
                    <input type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full px-4 py-3 bg-white/50 rounded-xl border border-red-200
                                focus:border-red-500 focus:outline-none input-focus"
                        placeholder="Masukkan password anda"/>
                </div>

                <!-- Password Reset Info -->
                <div class="text-center">
                    <span class="text-red-600 text-sm">Lupa password?</span>
                    <span class="text-red-500 text-sm">Hubungi admin pengelola</span>
                    <a href="mailto:arianto@polinema.ac.id" class="text-red-700 hover:text-red-900 text-sm font-medium">
                        arianto@polinema.ac.id
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl
                            font-medium transition-all duration-300 hover:-translate-y-0.5">
                    Masuk
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-red-400 text-sm">
            © 2024 ISFOR. All rights reserved.
        </div>
    </div>

    <!-- Alert Component -->
    <div id="customAlert" class="fixed bottom-4 right-4 glass-effect rounded-xl p-4 hidden fade-in z-50">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span id="alertMessage" class="text-red-600 font-medium">Please fill in all fields</span>
        </div>
    </div>

    <script src="<?=JS;?>/login.js"></script>
</body>
</html>