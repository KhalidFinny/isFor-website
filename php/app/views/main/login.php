<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
          rel="stylesheet">
    <style>

.card-container {
            background-color: white;
            border: 2px solid #E5E7EB;
        }
        
        .input-wrapper input {
            background-color: #F3F4F6;
            transition: all 0.3s ease;
        }
        
        .input-wrapper input:focus {
            background-color: white;
            border-color: #3B82F6;
        }
        
        .submit-btn {
            background-color: #2563EB;
            border: 2px solid #1D4ED8;
            transition: all 0.2s ease;
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            background-color: #1D4ED8;
        }
        
        .custom-alert {
            display: none;
            position: fixed;
            top: 1rem;
            right: 1rem;
            background-color: #EFF6FF;
            border: 2px solid #3B82F6;
            color: #1E40AF;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
        }
        
        /* Animation classes */
        .fade-enter-active {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        .fade-exit {
            animation: fadeOutDown 0.4s ease-in forwards;
        }
        
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeOutDown {
            0% {
                opacity: 1;
                transform: translateY(0);
            }
            100% {
                opacity: 0;
                transform: translateY(20px);
            }
        }

    </style>
</head>
<body class="grid-pattern min-h-screen flex items-center justify-center p-6">
<div class="w-full max-w-md fade-enter-active">
    <div class="card-container rounded-2xl p-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <img src="http://localhost/IsFor-website/php/app/views/assets/images/Logo1.png" alt="IsFor Logo"
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

            <!-- Button Group with modern styling -->
            <div class="flex flex-col space-y-3">
                <button type="submit" class="submit-btn bg-blue-600 text-white py-2.5 rounded-lg font-medium w-full">
                    Masuk
                </button>
                <button 
                    onclick="window.history.back();" 
                    type="button"
                    class="px-4 py-2.5 rounded-lg font-medium text-gray-600 hover:text-gray-800 border-2 border-gray-200 hover:border-gray-300 transition-all duration-300 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </button>
            </div>

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
<script>
    // Add this before the closing </body> tag
    document.addEventListener('DOMContentLoaded', function() {
        // Entry animation is handled by the fade-enter-active class already present
        
        // Handle exit animations when clicking links or back button
        document.querySelectorAll('a, button').forEach(element => {
            element.addEventListener('click', function(e) {
                // Don't animate for submit button
                if (this.type === 'submit') return;
                
                e.preventDefault();
                const href = this.href;
                const isBackButton = this.onclick && this.onclick.toString().includes('history.back');
                
                // Add exit animation
                document.querySelector('.fade-enter-active').classList.add('fade-exit');
                
                // Wait for animation to complete before navigating
                setTimeout(() => {
                    if (isBackButton) {
                        window.history.back();
                    } else if (href) {
                        window.location.href = href;
                    }
                }, 400); // Match this with animation duration
            });
        });
    });
</script>
</body>
</html>