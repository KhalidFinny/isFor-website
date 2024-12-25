<!-- Remove all DOCTYPE, html, head, and body tags. Keep only the section content -->
<section class="min-h-screen flex items-center relative overflow-hidden" id="beranda">
    <div class="container mx-auto px-6">
        <div class="swiss-grid items-center">
            <div class="col-span-12 lg:col-span-5 space-y-8 stagger-animation">
                <div class="flex items-center space-x-4">
                    <span class="h-px w-12 bg-red-500"></span>
                    <span class="text-red-500 font-medium">Internet of Things For Human Life's</span>
                </div>

                <h1 class="display-font text-5xl lg:text-6xl font-bold">
                    <span class="block text-red-700">IsFor</span>
                    <span class="text-red-500">Internet of Things</span>
                    <span class="relative inline-block">
                        <span class="absolute -bottom-2 left-0 w-full h-3 bg-red-100 -z-10"></span>
                        <span class="text-red-500">For Human Life's</span>
                    </span>
                </h1>

                <p class="text-lg text-gray-600 max-w-xl">
                    Mewadahi berbagai riset dosen dan mahasiswa tentang IoT dalam memenuhi kebutuhan regional dan kebutuhan nasional yang berbasis Teknologi IoT.
                </p>
                <?php if (!isset($_SESSION['user_id'])) : ?>
                    <a href="<?= BASEURL; ?>/login" class="group inline-flex items-center px-8 py-4 bg-red-500 text-white rounded-full hover:bg-red-600 transition-all duration-300">
                        <span>Masuk</span>
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                <?php else : ?>
                    <?php if ($_SESSION['role_id'] == 1) : ?>
                        <a href="<?= BASEURL; ?>/dashboardadmin" class="group inline-flex items-center px-8 py-4 bg-red-500 text-white rounded-full hover:bg-red-600 transition-all duration-300">
                            <span>admin dashboard</span>
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    <?php else : ?>
                        <a href="<?= BASEURL; ?>/dashboarduser" class="group inline-flex items-center px-8 py-4 bg-red-500 text-white rounded-full hover:bg-red-600 transition-all duration-300">
                            <span>user dashboard</span>
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                <?php endif;?>
            </div>

            <div class="col-span-12 lg:col-span-6 lg:col-start-7 mt-12 lg:mt-0">
                <div class="relative animate-scale">
                    <div class="absolute inset-0"></div>
                    <img src="<?= ASSETS; ?>/images/coding-image.png"
                         alt="IsFor Illustration"
                         class="relative rounded-3xl animate-float"/>
                </div>
            </div>
        </div>
    </div>
</section>