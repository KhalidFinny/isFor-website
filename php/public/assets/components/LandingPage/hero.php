<!-- Remove all DOCTYPE, html, head, and body tags. Keep only the section content -->
<section class="min-h-screen flex items-center relative overflow-hidden">
    <div class="container mx-auto px-6">
        <div class="swiss-grid items-center">
            <div class="col-span-12 lg:col-span-5 space-y-8 stagger-animation">
                <div class="flex items-center space-x-4">
                    <span class="h-px w-12 bg-blue-600"></span>
                    <span class="text-blue-600 font-medium">Pusat Riset Informatika</span>
                </div>

                <h1 class="display-font text-5xl lg:text-7xl font-bold">
                    <span class="block text-blue-900">IsFor</span>
                    <span class="text-blue-600">Pusat Riset</span>
                    <span class="relative inline-block">
                        <span class="absolute -bottom-2 left-0 w-full h-4 bg-blue-100 -z-10"></span>
                        <span class="text-blue-900">Informatika</span>
                    </span>
                </h1>

                <p class="text-lg text-gray-600 max-w-xl">
                    Memajukan riset informatika melalui inovasi dan kolaborasi.
                    Pusat dari segala penelitian terkait informatika untuk masa depan teknologi Indonesia.
                </p>

                <a href="#" onclick="window.location.href='/isfor-web/App/views/auth/loginpage.php'" class="group inline-flex items-center px-8 py-4 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all duration-300">
                    <span>Masuk</span>
                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            <div class="col-span-12 lg:col-span-6 lg:col-start-7 mt-12 lg:mt-0">
                <div class="relative animate-scale">
                    <div class="absolute inset-0 blob-shape bg-gradient-to-br from-purple-100 to-blue-100"></div>
                    <img src="/isfor-web/App/public/assets/images/coding-image.png"
                        alt="IsFor Illustration"
                        class="relative rounded-3xl animate-float"/>
                </div>
            </div>
        </div>
    </div>
</section>