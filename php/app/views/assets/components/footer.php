<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <footer class="bg-red-100">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="flex flex-col items-center justify-center space-y-4">
                <div class="flex items-center space-x-3">
                    <img src="<?= ASSETS; ?>/images/Logo1.png" alt="IsFor Logo" class="h-8 w-auto" />
                    <span class="text-red-700 font-medium">IsFor</span>
                </div>
                <div class="w-24 h-1 bg-red-300 rounded-full"></div>
                <p class="text-red-600 text-center text-sm" id="footer-year"></p>
            </div>
        </div>
    </footer>

    <script>
        const currentYear = new Date().getFullYear();
        document.getElementById('footer-year').textContent = `© ${currentYear} Pusat Riset Informatika Politeknik Negeri Malang`;
    </script>
</body>
</html>