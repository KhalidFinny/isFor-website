<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/isfor-web/App/public/assets/css/navbaranimation.css">
    <link rel="stylesheet" href="/isfor-web/App/public/assets/css/animations.css">

    <style>
        .dropdown-content {
            visibility: hidden;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease-in-out;
        }

        .nav-item:hover .dropdown-content {
            visibility: visible;
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body class="bg-gray-50">
<header>
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 fade-enter-active">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo Section -->
                <a href="/isfor-web/App/views/main/home.php" class="flex-shrink-0 flex items-center space-x-3">
                    <img src="<?= ASSETS; ?>/images/Logo1.png" alt="IsFor Logo" class="h-10 w-auto"/>
                    <span class="text-lg font-semibold text-blue-900">IsFor Pusat Riset Informatika</span>
                </a>

                <!-- Navigation Items -->
                <div class="hidden lg:flex lg:items-center">
                    <div class="flex items-center space-x-6" id="nav-items"></div>
                    <div class="ml-8">
                        <a href="/IsFor-Website/App/views/auth/loginpage.php"
                           class="text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 px-4 py-2 rounded-md transition-all duration-300">
                            Masuk
                        </a>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="lg:hidden">
                    <button type="button"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors"
                            onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden lg:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t" id="mobile-nav-items"></div>
            <div class="p-3">
                <a href="/IsFor-Website/App/views/auth/loginpage.php"
                   class="block text-center text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 px-4 py-2 rounded-md transition-all duration-300">
                    Masuk
                </a>
            </div>
        </div>
    </nav>
</header>
<script src="<?= ASSETS; ?>/js/navbar.js"></script>
</body>
</html>
