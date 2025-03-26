<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS; ?>/admin/dashboard-admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
          rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Ensure the body doesn't have horizontal overflow */
        body {
            overflow-x: hidden;
        }

        /* Responsive adjustments for mobile view */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0 !important; /* Remove sidebar margin on mobile when sidebar is closed */
                transition: margin-left 0.3s ease-in-out;
            }

            .main-content.sidebar-open {
                margin-left: 16rem; /* Match sidebar width (w-64 = 16rem) when sidebar is open */
            }

            /* Adjust padding and layout for mobile */
            .main-content {
                padding: 0.5rem; /* Slightly increased padding for better spacing */
            }

            /* Make the header stack vertically on mobile */
            .header-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 1.5rem; /* Increased gap for better separation */
            }

            /* Adjust the logout button position on mobile */
            .logout-button {
                position: static; /* Remove absolute positioning on mobile */
                width: auto;
                margin-top: 1rem;
            }

            /* Adjust the date-time display for mobile */
            .date-time-display {
                flex-direction: row; /* Keep horizontal layout but adjust spacing */
                align-items: center;
                gap: 1rem;
                width: 100%;
                padding: 1rem;
                justify-content: space-between; /* Space out date and time */
            }

            .date-time-display .divider {
                display: block; /* Show divider on mobile */
                height: 2rem; /* Shorter divider for mobile */
            }

            /* Make stats grid stack vertically on mobile */
            .stats-grid {
                grid-template-columns: 1fr; /* Single column on mobile */
                gap: 1.5rem; /* Increased gap for better separation */
            }

            /* Style stats cards for better visual separation */
            .stats-grid > div {
                padding: 1.5rem; /* Increased padding inside cards */
                border-radius: 1rem; /* Slightly larger border radius */
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); /* Subtle shadow for depth */
            }

            /* Adjust table for mobile */
            .users-table {
                display: block;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .users-table thead {
                display: none; /* Hide table headers on mobile for a card-like layout */
            }

            .users-table tbody tr {
                display: flex;
                flex-direction: column;
                margin-bottom: 1.5rem; /* Increased spacing between cards */
                border: 1px solid #e5e7eb;
                border-radius: 0.75rem; /* Slightly larger border radius */
                padding: 1.25rem; /* Increased padding inside cards */
                background-color: #fff;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); /* Subtle shadow for depth */
            }

            .users-table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.5rem 0;
                border: none;
            }

            .users-table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #4b5563;
                margin-right: 1rem;
            }

            /* Adjust the name and email section in the table */
            .users-table .name-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.25rem;
            }

            /* Adjust pagination for mobile */
            .pagination-section {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .pagination-section .pagination-buttons {
                flex-wrap: wrap;
                justify-content: flex-start;
                gap: 0.5rem; /* Added gap between pagination buttons */
            }

            /* Ensure hamburger menu doesn't overlap content */
            .hamburger {
                z-index: 50;
            }
        }

        /* Ensure desktop view remains unchanged */
        @media (min-width: 769px) {
            .main-content {
                margin-left: 16rem; /* Match sidebar width (w-64 = 16rem) */
            }
        }
    </style>
</head>
<body class="bg-gray-50">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <?php include_once '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>

    <!-- Main Content -->
    <main class="flex-1 main-content p-8 pt-20 bg-white" id="mainContent">
        <div class="max-w-7xl mx-auto">
            <!-- Modern Header with Profile Section -->
            <div class="header-section flex justify-between items-center mb-8">
                <div class="space-y-6">
                    <h1 class="text-3xl font-bold text-red-600">Dashboard Overview</h1>
                    <!-- Logout Button -->
                    <div class="logout-button absolute top-0 right-10">
                        <form action="<?= BASEURL ?>/login/logout" method="POST">
                            <input type="hidden" name="action" value="logout">
                            <button type="submit"
                                    class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>

                    <!-- Swiss-style Date Time Display -->
                    <div class="date-time-display inline-flex items-center space-x-8 bg-white border-2 border-red-100 rounded-2xl p-4 shadow-sm">
                        <!-- Date Display -->
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-red-50 rounded-xl">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs uppercase tracking-wider text-gray-500 font-medium">Date</span>
                                <span id="currentDate" class="text-lg font-bold text-gray-800"></span>
                            </div>
                        </div>

                        <!-- Vertical Divider -->
                        <div class="divider h-12 w-px bg-red-100"></div>

                        <!-- Time Display -->
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-red-50 rounded-xl">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs uppercase tracking-wider text-gray-500 font-medium">Time</span>
                                <span id="currentTime" class="text-lg font-bold text-gray-800 tabular-nums"></span>
                            </div>
                        </div>
                    </div>

                    <h2 class="font-bold text-xl text-gray-600">Welcome back!</h2>
                    <span class="font-medium text-2xl text-red-600"><?php echo htmlspecialchars($data['user']['name']); ?></span>
                </div>

                <!-- Profile Section -->
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($data['user']['name']); ?></p>
                        <p class="text-xs text-gray-500">
                            <?php echo ($data['user']['role_id'] == 1) ? 'Administrator' : 'Researcher'; ?>
                        </p>
                    </div>
                    <div class="h-10 w-10 rounded-full overflow-hidden bg-gray-100">
                        <?php if ($data['user']['profile_picture'] == null): ?>
                            <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden bg-red-50">
                                <svg class="h-full w-full object-cover rounded-full"
                                     viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 6C13.66 6 15 7.34 15 9C15 10.66 13.66 12 12 12C10.34 12 9 10.66 9 9C9 7.34 10.34 6 12 6ZM12 20.2C9.5 20.2 7.29 18.92 6 16.98C6.03 14.99 10 13.9 12 13.9C13.99 13.9 17.97 14.99 18 16.98C16.71 18.92 14.5 20.2 12 20.2Z"
                                        fill="#ef4444"/>
                                </svg>
                            </div>
                        <?php else: ?>
                            <img class="h-full w-full object-cover"
                                 src="<?= PHOTOPROFILE . $data['user']['profile_picture'] ?>" alt="Profile">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Redesigned Stats Grid -->
            <div class="stats-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 animate-fade-in">
                <!-- Pending Letters Card -->
                <div class="group border border-gray-200 rounded-xl p-6 hover:border-red-500 transition-all duration-300 hover:scale-105 hover:shadow-lg bg-white relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-red-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="flex items-center relative z-10">
                        <div class="p-3 rounded-xl bg-red-50 text-red-600 group-hover:bg-red-100 transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 group-hover:text-gray-800">Pending Letters</p>
                            <p class="text-xl font-semibold text-red-600"><?= $data['pending']['total'] ?></p>
                        </div>
                    </div>
                </div>

                <!-- Verified Letters Card -->
                <div class="group border border-gray-200 rounded-xl p-6 hover:border-green-500 transition-all duration-300 hover:scale-105 hover:shadow-lg bg-white relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-green-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="flex items-center relative z-10">
                        <div class="p-3 rounded-xl bg-green-50 text-green-600 group-hover:bg-green-100 transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 group-hover:text-gray-800">Verified Letters</p>
                            <p class="text-xl font-semibold text-green-600"><?= $data['verify']['total'] ?></p>
                        </div>
                    </div>
                </div>

                <!-- Pending Files Card -->
                <div class="group border border-gray-200 rounded-xl p-6 hover:border-yellow-500 transition-all duration-300 hover:scale-105 hover:shadow-lg bg-white relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-yellow-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="flex items-center relative z-10">
                        <div class="p-3 rounded-xl bg-yellow-50 text-yellow-600 group-hover:bg-yellow-100 transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 group-hover:text-gray-800">Pending Files</p>
                            <p class="text-xl font-semibold text-yellow-600"><?= $data['pendingFiles'] ?></p>
                        </div>
                    </div>
                </div>

                <!-- Rejected Items Card -->
                <div class="group border border-gray-200 rounded-xl p-6 hover:border-red-500 transition-all duration-300 hover:scale-105 hover:shadow-lg bg-white relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-red-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="flex items-center relative z-10">
                        <div class="p-3 rounded-xl bg-red-50 text-red-600 group-hover:bg-red-100 transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 group-hover:text-gray-800">Rejected Items</p>
                            <p class="text-xl font-semibold text-red-600"><?= $data['totalRejected']; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modern Swiss-style Users Table -->
            <div class="animate-slide-in">
                <div class="bg-white rounded-lg overflow-hidden">
                    <div class="px-8 py-6 flex justify-between items-center border-b border-gray-100">
                        <h2 class="text-2xl font-light text-red-500 tracking-tight">Recent Users</h2>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="users-table min-w-full">
                        <thead>
                        <tr>
                            <th scope="col" class="px-8 py-5 text-left">
                                <div class="flex items-center space-x-2">
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Name</span>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" class="px-8 py-5 text-left">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Role</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                        <?php foreach ($data['allUsersWithPagination'] as $allUsersWithPagination): ?>
                            <tr class="group hover:bg-gray-50/50 transition-all duration-200">
                                <td class="px-8 py-5" data-label="Name">
                                    <div class="name-section flex items-center space-x-4">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden bg-gray-100">
                                            <?php if ($allUsersWithPagination['profile_picture'] == null): ?>
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden bg-red-50">
                                                    <svg class="h-full w-full object-cover rounded-full"
                                                         viewBox="0 0 24 24" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 6C13.66 6 15 7.34 15 9C15 10.66 13.66 12 12 12C10.34 12 9 10.66 9 9C9 7.34 10.34 6 12 6ZM12 20.2C9.5 20.2 7.29 18.92 6 16.98C6.03 14.99 10 13.9 12 13.9C13.99 13.9 17.97 14.99 18 16.98C16.71 18.92 14.5 20.2 12 20.2Z"
                                                            fill="#ef4444"/>
                                                    </svg>
                                                </div>
                                            <?php else: ?>
                                                <img class="h-full w-full object-cover"
                                                     src="<?= PHOTOPROFILE . $allUsersWithPagination['profile_picture'] ?>"
                                                     alt="">
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900">
                                                <?= $allUsersWithPagination['name'] ?>
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                <?= $allUsersWithPagination['email'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5" data-label="Role">
                                    <?php if ($allUsersWithPagination['role_id'] == 1) { ?>
                                        <span class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600">
                                            <span class="w-1 h-1 mr-1.5 rounded-full bg-red-500"></span>
                                            Admin
                                        </span>
                                    <?php } elseif ($allUsersWithPagination['role_id'] == 2) { ?>
                                        <span class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-medium bg-blue-50 text-blue-600">
                                            <span class="w-1 h-1 mr-1.5 rounded-full bg-blue-500"></span>
                                            Researcher
                                        </span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="px-8 py-4 border-t border-gray-100">
                    <div class="pagination-section flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            Showing
                            <span class="font-medium"><?= ($data['currentPage'] - 1) * $data['limit'] + 1; ?></span>
                            to
                            <span class="font-medium">
                                <?= min($data['currentPage'] * $data['limit'], $data['totalUsers']) ?>
                            </span>
                            of
                            <span class="font-medium"><?= $data['totalUsers'] ?></span>
                            results
                        </div>
                        <div class="pagination-buttons flex items-center space-x-2" id="pagination">
                            <!-- Page indicator -->
                            <div class="text-sm text-gray-500">
                                Page <span class="font-medium"><?= $data['currentPage']; ?></span> of <span
                                    class="font-medium"><?= $data['totalPages']; ?></span>
                            </div>
                            <!-- Pagination numbers -->
                            <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                                <a href="?page=<?= $i; ?>"
                                   class="px-4 py-2 text-sm font-medium rounded-lg <?= $i == $data['currentPage'] ? 'border border-red-400 text-red-500' : 'bg-white text-red-500 duration-300 hover:bg-red-100'; ?>">
                                    <?= $i; ?>
                                </a>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script>
    $(document).ready(function () {
        function updateDateTime() {
            const now = new Date();
            const dateOptions = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const formattedDate = new Intl.DateTimeFormat('en-US', dateOptions).format(now);
            $('#currentDate').text(formattedDate);
            const timeOptions = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };
            const formattedTime = new Intl.DateTimeFormat('en-US', timeOptions).format(now);
            const timeElement = $('#currentTime');

            if (timeElement.text() !== formattedTime) {
                timeElement.addClass('animate-pulse');
                setTimeout(() => {
                    timeElement.removeClass('animate-pulse');
                }, 500);
            }

            timeElement.text(formattedTime);
        }

        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Synchronize main content margin with sidebar state
        const menuToggle = $('#menuToggle');
        const sidebar = $('#sidebar');
        const mainContent = $('#mainContent');

        menuToggle.on('click', function () {
            sidebar.toggleClass('open');
            if (window.innerWidth <= 768) {
                mainContent.toggleClass('sidebar-open');
            }
        });

        // Close sidebar and adjust main content when clicking outside on mobile
        $(document).on('click', function (e) {
            if (window.innerWidth <= 768 && !sidebar[0].contains(e.target) && !menuToggle[0].contains(e.target)) {
                sidebar.removeClass('open');
                mainContent.removeClass('sidebar-open');
            }
        });

        // Adjust on window resize
        $(window).on('resize', function () {
            if (window.innerWidth > 768) {
                mainContent.removeClass('sidebar-open');
            }
        });
    });
</script>
</body>
</html>