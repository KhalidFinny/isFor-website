<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>/assets/css/login.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>/assets/css/animations.css">

</head>
<body class="grid-pattern min-h-screen flex items-center justify-center p-6">
<div class="w-full max-w-md fade-enter-active">
    <div class="card-container rounded-2xl p-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <img src="<?php echo BASEURL; ?>/assets/images/Logo1.png" alt="IsFor Logo"
                 class="h-16 mx-auto mb-4 hover:scale-110 transition-transform duration-300"/>
            <h2 class="text-2xl font-bold text-blue-700">Pusat Riset Informatika</h2>
            <h3 class="text-small font-regular text-blue-700">Masuk untuk lanjut</h3>
        </div>

        <!-- Error Message -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="p-3 mb-4 bg-red-50 rounded-lg border-2 border-red-200">
                <p class="text-sm font-medium text-red-700"><?php echo $_SESSION['error']; ?></p>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Login Form -->
        <form id="loginForm" class="space-y-4" method="POST" action="<?= BASEURL; ?>/login/authentication">
            <!-- Username Input -->
            <div>
                <label for="username" class="block text-sm font-medium text-blue-700 mb-1.5">
                    Username
                </label>
                <div class="input-wrapper">
                    <input
                            type="text"
                            id="username"
                            name="username"
                            required
                            placeholder="Enter your username"
                            class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-200 focus:outline-none"
                    />
                </div>
            </div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-sm font-medium text-blue-700 mb-1.5">
                    Password
                </label>
                <div class="input-wrapper">
                    <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            placeholder="Enter your password"
                            class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-200 focus:outline-none"
                    />
                </div>
            </div>

            <!-- Password Reset Info -->
            <div class="p-3 bg-blue-50 rounded-lg border-2 border-blue-200">
                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-blue-700">Lupa password?</p>
                        <p class="text-sm text-blue-600 mt-0.5">Hubungi admin pengelola untuk mengubah password.</p>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <!-- <button type="submit" class="submit-btn w-full text-white py-2.5 rounded-lg font-medium">
                Masuk
            </button> -->
            <button type="submit" class="submit-btn bg-blue-600 text-white py-2.5 rounded-lg font-medium w-full">
                Masuk
            </button>

            <input type="hidden" name="action" value="login">
        </form>
    </div>
</div>

<!-- Custom Alert -->
<div id="customAlert" class="custom-alert">
    <div class="flex items-center space-x-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span id="alertMessage" class="text-sm font-medium">Please fill in all fields</span>
    </div>
</div>
<script src="<?php echo BASEURL; ?>/assets/js/login.js"></script>
</body>
</html>