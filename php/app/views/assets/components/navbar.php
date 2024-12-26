<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= COMPONENTS_CSS; ?>/navbar.css?>">
</head>

<body class="bg-gray-50">
<header>
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 fade-enter-active">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo Section -->
                <a href="<?=BASEURL?>" class="flex-shrink-0 flex items-center space-x-3">
                    <img src="<?= IMAGES;?>/Logo1.webp" alt="IsFor Logo" class="h-9 w-auto"/>
                    <span class="text-l font-semibold text-green-600">Internet of Things For Human Life's</span>
                </a>

                <!-- Navigation Items -->
                <div class="hidden lg:flex lg:items-center">
                    <div class="flex items-center space-x-6" id="nav-items"></div>
                    <div class="ml-8">
                        <a href="<?=BASEURL;?>/login"
                        class="text-sm font-medium text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md transition-all duration-300">
                            Masuk
                        </a>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="lg:hidden">
                    <button type="button"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-red-600 hover:bg-red-50 transition-colors"
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
                <a href="<?=BASEURL;?>/login"
                   class="block text-center text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md transition-all duration-300">
                    Masuk
                </a>
            </div>
        </div>
    </nav>
</header>
<script>
    // Navigation items data
    const navItems = [
        {name: 'Beranda', href: '<?=BASEURL?>'},
        {
            name: 'Tentang Kami',
            dropdownItems: [
                {name: 'Sejarah', href: '<?= BASEURL; ?>/#Sejarah'},
                {name: 'Visi Misi', href: '<?= BASEURL; ?>/#Visimisi'},
                {name: 'Roadmap', href: '<?= BASEURL; ?>/#Roadmap'},
                {name: 'Organisasi', href: '<?= BASEURL; ?>/#Organisasi'},
                {name: 'Pengelola', href: '<?= BASEURL; ?>/#Pengelola'},
                {name: 'List Peneliti', href: '<?= BASEURL; ?>/#Peneliti'},
            ],
        },
        {
            name: 'Riset & Publikasi',
            dropdownItems: [
                {name: 'Hasil Penelitian', href: '<?= BASEURL; ?>/home/hasilpenelitian'},
            ],
        },
        {name: 'Agenda', href: '<?= BASEURL; ?>/home/agenda'},
        {name: 'Arsip', dropdownItems: [{name: 'Dokumen', href: '<?= BASEURL; ?>/home/archives'}]},
        {name: 'Galeri', href: '<?= BASEURL; ?>/home/galeri'},
    ];

    // Render navigation items
    const renderNavItems = () => {
        const navContainer = document.getElementById('nav-items');
        const mobileNavContainer = document.getElementById('mobile-nav-items');

        navContainer.innerHTML = '';
        mobileNavContainer.innerHTML = '';

        navItems.forEach(item => {
            const navItem = document.createElement('div');
            navItem.className = 'nav-item relative group';
            navItem.innerHTML = `
                ${item.dropdownItems ? `
                    <button class="text-gray-700 hover:text-red-600 px-3 py-2 text-sm font-medium transition-colors inline-flex items-center">
                        ${item.name}
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                ` : `
                    <a href="${item.href}" class="text-gray-700 hover:text-red-600 px-3 py-2 text-sm font-medium transition-colors inline-flex items-center">
                        ${item.name}
                    </a>
                `}
                ${item.dropdownItems ? `
                    <div class="dropdown-content absolute left-0 mt-1 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <div class="py-1">
                            ${item.dropdownItems.map(dropItem => `
                                <a href="${dropItem.href}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors">
                                    ${dropItem.name}
                                </a>
                            `).join('')}
                        </div>
                    </div>
                ` : ''}
            `;
            navContainer.appendChild(navItem);

            // Mobile menu item
            const mobileNavItem = document.createElement('div');
            mobileNavItem.innerHTML = `
                <a href="${item.href || '#'}" 
                   class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors">
                    ${item.name}
                </a>
                ${item.dropdownItems ? `
                    <div class="pl-4 space-y-1">
                        ${item.dropdownItems
                            .map(dropItem => `
                                <a href="${dropItem.href}" 
                                   class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors">
                                    ${dropItem.name}
                                </a>
                            `)
                            .join('')}
                    </div>
                ` : ''}
            `;
            mobileNavContainer.appendChild(mobileNavItem);
        });
    };

    document.addEventListener('DOMContentLoaded', renderNavItems);
    document.addEventListener('DOMContentLoaded', () => {
        renderNavItems();

        // Update back/forward navigation handling
        window.addEventListener('popstate', (event) => {
            const currentPath = window.location.pathname;
            if (currentPath.includes('agenda.php') || 
                currentPath.includes('hasilpenelitian.php') || 
                currentPath.includes('galeriweb.php')) {
                window.location.href = '<?=BASEURL?>'; // Redirect to beranda
            } else if (document.referrer.includes('loginpage.php')) {
                window.location.reload();
            }
        });

        // Add smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start',
                    });

                    // Update URL without page reload
                    history.pushState(null, '', targetId);
                }
            });
        });

        // Handle back/forward navigation
        window.addEventListener('popstate', (event) => {
            if (document.referrer.includes('loginpage.php')) {
                window.location.reload();
            }
        });

        // Handle login button click
        const loginButtons = document.querySelectorAll('a[href*="loginpage.php"]');
        loginButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                document.body.classList.add('fade-exit-active');
                setTimeout(() => {
                    window.location.href = button.href;
                }, 300);
            });
        });
    });

    // Add after existing code
    const handleNavigation = e => {
        const link = e.currentTarget;
        if (!link.href.startsWith('#')) {
            e.preventDefault();
            document.body.classList.add('opacity-0');
            setTimeout(() => {
                window.location.href = link.href;
            }, 300);
        }
    };

    // Update the renderNavItems function to add transition handlers
    document.querySelectorAll('a:not([href^="#"])').forEach(link => {
        link.addEventListener('click', handleNavigation);
    });
</script>
</body>
</html>