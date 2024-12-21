<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
          rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fff;
        }

        /* Modern Animations */
        .animate-fade-in {
            animation: smoothFadeIn 0.4s ease-out;
        }

        .animate-slide-in {
            animation: smoothSlideIn 0.4s ease-out;
        }

        /* Refined Card Styles */
        .stats-card {
            transition: all 0.2s ease;
            border: 1px solid #e5e7eb;
            background: #ffffff;
        }

        .stats-card:hover {
            border-color: #dc2626;
            background: #fff5f5;
        }

        /* Modern Sidebar Styling */
        .sidebar-link {
            transition: all 0.2s ease;
            border-left: 2px solid transparent;
        }

        .sidebar-link:hover {
            background-color: #fee2e2;
            border-left-color: #dc2626;
        }

        .sidebar-link.active {
            background-color: #fee2e2;
            color: #dc2626;
            border-left-color: #dc2626;
        }

        /* Clean Table Styling */
        .table-row {
            transition: background-color 0.2s ease;
            border-bottom: 1px solid #f3f4f6;
        }

        .table-row:hover {
            background-color: #fff5f5;
        }

        /* Modern Button Style */
        .btn-primary {
            background-color: #dc2626;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #b91c1c;
        }

        .btn-outline {
            border: 1px solid #dc2626;
            color: #dc2626;
        }

        .btn-outline:hover {
            background-color: #fee2e2;
        }

        @keyframes smoothFadeIn {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes smoothSlideIn {
            from {
                opacity: 0;
                transform: translateX(-8px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Modern Status Badge */
        .status-badge {
            transition: all 0.2s ease;
            border: 1px solid currentColor;
        }

        .tabular-nums {
            font-variant-numeric: tabular-nums;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .animate-pulse {
            animation: pulse 0.5s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-50">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <?php include_once '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <!-- Modern Header with Profile Section -->
            <div class="flex justify-between items-center mb-8">
                <div class="space-y-6">
                    <h1 class="text-3xl font-bold text-red-600">Dashboard Overview</h1>
                    <!-- Logout Button -->
                    <div class="absolute top-0 right-10">
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
                    <div class="inline-flex items-center space-x-8 bg-white border-2 border-red-100 rounded-2xl p-4 shadow-sm">
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
                        <div class="h-12 w-px bg-red-100"></div>

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

                    <p class="text-sm text-gray-600">Welcome
                        back, <?php echo htmlspecialchars($data['user']['name']); ?></p>
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
                            <img class="h-full w-full object-cover"
                                 src="<?= ASSETS ?>/images/empty-user.png" alt="Profile">
                        <?php else: ?>
                            <img class="h-full w-full object-cover"
                                 src="<?= PHOTOPROFILE . $data['user']['profile_picture'] ?>" alt="Profile">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Redesigned Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 animate-fade-in">
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

            <!-- Modern Add User Button -->
            <button class="mb-6 px-5 py-2.5 text-sm font-medium text-white rounded-lg btn-primary">
                <a href="<?= BASEURL; ?>/User">Add User</a>
            </button>

            <!-- Modern Swiss-style Users Table -->
            <div class="animate-slide-in">
                <div class="bg-white rounded-lg overflow-hidden">
                    <div class="px-8 py-6 flex justify-between items-center border-b border-gray-100">
                        <h2 class="text-2xl font-light text-red-500 tracking-tight">Recent Users</h2>
                        <div class="relative">
                            <input type="text"
                                   placeholder="Search users..." id="searchUser"
                                   class="pl-11 pr-4 py-2.5 bg-gray-50 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-red-500 transition-all duration-200 text-gray-600 placeholder-gray-400 w-64"
                            >
                            <svg class="w-5 h-5 absolute left-4 top-3 text-gray-400" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
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
                                <th scope="col" class="px-8 py-5 text-left">
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                            <?php foreach ($data['allUsersWithPagination'] as $allUsersWithPagination): ?>
                                <tr class="group hover:bg-gray-50/50 transition-all duration-200">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden bg-gray-100">
                                                <?php if ($allUsersWithPagination['profile_picture'] == null): ?>
                                                    <img class="h-full w-full object-cover"
                                                         src="<?= ASSETS ?>/images/empty-user.png" alt="">
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
                                    <td class="px-8 py-5">
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
                                    <td class="px-8 py-5 text-sm space-x-3">
                                        <a href="<?= BASEURL; ?>/User/editView/<?= $allUsersWithPagination['user_id'] ?>"
                                           class="inline-flex items-center text-gray-500 hover:text-red-600 transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <?php if ($allUsersWithPagination['user_id'] != $_SESSION['user_id']) { ?>
                                            <a href="<?= BASEURL; ?>/User/Delete/<?= $allUsersWithPagination['user_id'] ?>"
                                               class="inline-flex items-center text-gray-500 hover:text-red-600 transition-colors duration-200"
                                               onclick="return confirm('Apakah yakin untuk dihapus?')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="1.5"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="px-8 py-4 border-t border-gray-100">
                        <div class="flex items-center justify-between">
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
                            <div class="flex items-center space-x-2">
                                <!-- button -->
                                <?php if ($data['currentPage'] > 1): ?>
                                    <a href="?page=<?= $data['currentPage'] - 1;?>"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-100 transition-colors duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </a>
                                <?php endif; ?>
                                <?php if ($data['currentPage'] < $data['totalPages']): ?>
                                    <a href="?page=<?= $data['currentPage'] + 1;?>"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-100 transition-colors duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    const userData = <?php echo json_encode($userData); ?>;

    document.getElementById('username').textContent = userData.username;
    document.getElementById('userRole').textContent = userData.role;
    document.getElementById('userAvatar').src = userData.avatar;
</script>

<script>
    $(document).ready(function () {
        // Function to update date and time
        function updateDateTime() {
            const now = new Date();

            // Format date
            const dateOptions = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const formattedDate = new Intl.DateTimeFormat('en-US', dateOptions).format(now);
            $('#currentDate').text(formattedDate);

            // Format time
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

        // Function to handle user search
        function searchUsers(keyword) {
            const userTableBody = $('table tbody'); // Target the table's <tbody>
            $.ajax({
                url: '<?= BASEURL; ?>/user/search',
                type: 'POST',
                data: {keyword: keyword},
                dataType: 'json',
                success: function (data) {
                    userTableBody.empty(); // Clear previous table rows

                    if (data.length > 0) {
                        $.each(data, function (index, user) {
                            const roleBadge = user.role_id === 1
                                ? `<span class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600">
                                    <span class="w-1 h-1 mr-1.5 rounded-full bg-red-500"></span> Admin
                                   </span>`
                                : `<span class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-medium bg-blue-50 text-blue-600">
                                    <span class="w-1 h-1 mr-1.5 rounded-full bg-blue-500"></span> Researcher
                                   </span>`;

                            const profilePicture = user.profile_picture
                                ? `<?= PHOTOPROFILE; ?>${user.profile_picture}`
                                : `<?= ASSETS; ?>/images/empty-user.png`;

                            const deleteAction = user.user_id !== <?= $_SESSION['user_id']; ?>
                                ? `<a href="<?= BASEURL; ?>/User/Delete/${user.user_id}" class="inline-flex items-center text-gray-500 hover:text-red-600 transition-colors duration-200" onclick="return confirm('Apakah yakin untuk dihapus?')">
                                       <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                 d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                       </svg>
                                   </a>`
                                : '';

                            userTableBody.append(`
                                <tr class="group hover:bg-gray-50/50 transition-all duration-200">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden bg-gray-100">
                                                <img class="h-full w-full object-cover" src="${profilePicture}" alt="">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900">${user.name}</p>
                                                <p class="text-sm text-gray-500">${user.email}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">${roleBadge}</td>
                                    <td class="px-8 py-5 text-sm space-x-3">
                                        <a href="<?= BASEURL; ?>/User/editView/${user.user_id}" class="inline-flex items-center text-gray-500 hover:text-red-600 transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        ${deleteAction}
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        userTableBody.append(`
                            <tr>
                                <td colspan="3" class="px-8 py-5 text-center text-gray-500">
                                    Pengguna tidak ditemukan.
                                </td>
                            </tr>
                        `);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        // Initialize date and time updates
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Event listener for user search input
        $('#searchUser').on('keyup', function () {
            const keyword = $(this).val(); // Get input value
            searchUsers(keyword); // Call search function
        });
    });
</script>
</body>
</html>