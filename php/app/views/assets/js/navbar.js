// Navigation items data
const navItems = [
  {name: 'Beranda', href: '/'},
  {
    name: 'Tentang Kami',
    dropdownItems: [
      {name: 'Sejarah', href: '#Sejarah'},
      {name: 'Visi Misi', href: '#Visimisi'},
      {name: 'Roadmap', href: '#Roadmap'},
      {name: 'Organisasi', href: '#Organisasi'},
      {name: 'Pengelola', href: '#Pengelola'},
      {name: 'List Peneliti', href: '#Peneliti'},
    ],
  },
  {
    name: 'Riset & Publikasi',
    dropdownItems: [
      {name: 'Penelitian', href: '#'},
      {name: 'Hasil Peneliti', href: '#'},
    ],
  },
  {name: 'Agenda', href: '/isFor-website/php/app/views/main/agenda.php'},
  {name: 'Arsip', dropdownItems: [{name: 'Dokumen', href: '#'}]},
  {name: 'Galeri', href: '/isFor-website/php/app/views/main/galeriweb.php'},
];

// Render navigation items
const renderNavItems = () => {
  const navContainer = document.getElementById ('nav-items');
  const mobileNavContainer = document.getElementById ('mobile-nav-items');

  // Clear existing content
  navContainer.innerHTML = '';
  mobileNavContainer.innerHTML = '';

  // Render items
  navItems.forEach (item => {
    // Desktop menu item
    const navItem = document.createElement ('div');
    navItem.className = 'nav-item relative group';
    navItem.innerHTML = `
                    <a href="${item.href || '#'}" 
                       class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors inline-flex items-center">
                        ${item.name}
                        ${item.dropdownItems ? `
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        ` : ''}
                    </a>
                    ${item.dropdownItems ? `
                        <div class="dropdown-content absolute left-0 mt-1 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="py-1">
                                ${item.dropdownItems
                                  .map (dropItem => `
                                    <a href="${dropItem.href}" 
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                        ${dropItem.name}
                                    </a>
                                `)
                                  .join ('')}
                            </div>
                        </div>
                    ` : ''}
                `;
    navContainer.appendChild (navItem);

    // Mobile menu item
    const mobileNavItem = document.createElement ('div');
    mobileNavItem.innerHTML = `
                    <a href="${item.href || '#'}" 
                       class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors">
                        ${item.name}
                    </a>
                    ${item.dropdownItems ? `
                        <div class="pl-4 space-y-1">
                            ${item.dropdownItems
                              .map (dropItem => `
                                <a href="${dropItem.href}" 
                                   class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors">
                                    ${dropItem.name}
                                </a>
                            `)
                              .join ('')}
                        </div>
                    ` : ''}
                `;
    mobileNavContainer.appendChild (mobileNavItem);
  });
};

document.addEventListener ('DOMContentLoaded', renderNavItems);
document.addEventListener ('DOMContentLoaded', () => {
  renderNavItems ();

  // Add smooth scroll behavior
  document.querySelectorAll ('a[href^="#"]').forEach (anchor => {
    anchor.addEventListener ('click', function (e) {
      e.preventDefault ();
      const targetId = this.getAttribute ('href');
      if (targetId === '#') return;

      const targetElement = document.querySelector (targetId);
      if (targetElement) {
        targetElement.scrollIntoView ({
          behavior: 'smooth',
          block: 'start',
        });

        // Update URL without page reload
        history.pushState (null, '', targetId);
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
  if (!link.href.startsWith ('#')) {
    e.preventDefault ();
    document.body.classList.add ('opacity-0');
    setTimeout (() => {
      window.location.href = link.href;
    }, 300);
  }
};

// Update the renderNavItems function to add transition handlers
document.querySelectorAll ('a:not([href^="#"])').forEach (link => {
  link.addEventListener ('click', handleNavigation);
});
