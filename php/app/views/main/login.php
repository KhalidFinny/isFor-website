<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .animated-background {
            background: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(10px);
        }

        .circle-1 {
            width: 400px;
            height: 400px;
            background: linear-gradient(45deg, #fee2e2 0%, #fecaca 100%);
            top: -100px;
            right: -100px;
            animation: float1 20s ease-in-out infinite;
        }

        .circle-2 {
            width: 300px;
            height: 300px;
            background: linear-gradient(45deg, #fecaca 0%, #fca5a5 100%);
            bottom: -50px;
            left: -50px;
            animation: float2 15s ease-in-out infinite;
        }

        .circle-3 {
            width: 200px;
            height: 200px;
            background: linear-gradient(45deg, #fca5a5 0%, #f87171 100%);
            top: 50%;
            right: 15%;
            animation: float3 18s ease-in-out infinite;
        }

        @keyframes float1 {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(50px, 50px) rotate(90deg); }
            50% { transform: translate(0, 100px) rotate(180deg); }
            75% { transform: translate(-50px, 50px) rotate(270deg); }
        }

        @keyframes float2 {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -50px) rotate(120deg); }
            66% { transform: translate(-30px, 50px) rotate(240deg); }
        }

        @keyframes float3 {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(-40px, -40px) rotate(180deg); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid #f87171;
        }
        
        .hover-translate {
            transition: all 0.3s ease;
        }
        
        .hover-translate:hover {
            transform: translateX(4px);
        }

        .input-focus {
            transition: all 0.3s ease;
        }

        .input-focus:focus {
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="min-h-screen animated-background" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <!-- Animated Background Circles -->
    <div class="circle circle-1"></div>
    <div class="circle circle-2"></div>
    <div class="circle circle-3"></div>

    <!-- Back Button - Always Visible -->
    <div class="fixed top-6 left-6 z-20">
        <a href="<?= BASEURL; ?>/home" class="text-red-600 hover:text-red-700 font-medium hover-translate inline-flex items-center gap-2">
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
            <img src="<?= ASSETS ?>/images/Logo1.png" alt="IsFor Logo" class="h-16"/>
        </div>

        <!-- Login Container -->
        <div class="w-full max-w-md glass-effect rounded-2xl p-8 fade-in">
            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-red-600">Selamat Datang</h2>
                <p class="text-red-400 mt-2">Masuk untuk melanjutkan ke dashboard</p>
            </div>

            <!-- Error Message -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="p-4 mb-6 bg-red-50/50 rounded-lg">
                    <p class="text-red-600 text-sm"><?php echo $_SESSION['error']; ?></p>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <!-- Login Form -->
            <form method="POST" action="<?= BASEURL; ?>/login/authentication" class="space-y-6">
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
                    <a href="mailto:arianto@polinema.ac.id" class="text-red-500 hover:text-red-600 text-sm">
                        Lupa password? Hubungi admin pengelola: arianto@polinema.ac.id
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

    <script src="<?= ASSETS ?>/assets/js/login.js"></script>
</body>
</html>