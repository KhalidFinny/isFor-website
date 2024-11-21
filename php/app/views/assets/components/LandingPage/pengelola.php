<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>IsFor Pusat Riset Informatika</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ASSETS; ?>/css/animations.css">
</head>

<!-- Pengelola Section -->
<section class="min-h-screen py-20 relative overflow-hidden">
    <div class="container mx-auto px-6">
        <div class="swiss-grid">
            <div class="col-span-12 text-center mb-16">
                <span class="inline-block px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-sm font-medium mb-4">
                    Tim Kami
                </span>
                <h2 class="display-font text-4xl lg:text-5xl font-bold mb-4 text-blue-900">
                    Pengelola
                </h2>
                <div class="w-24 h-1 mx-auto bg-gradient-to-r from-blue-600 to-blue-800 rounded-full"></div>
            </div>

            <div id="pengelola-list" class="col-span-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"></div>
        </div>
    </div>
</section>