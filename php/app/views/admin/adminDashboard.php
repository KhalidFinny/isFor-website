<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes smoothSlideIn {
            from { opacity: 0; transform: translateX(-8px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Modern Status Badge */
        .status-badge {
            transition: all 0.2s ease;
            border: 1px solid currentColor;
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
                <!-- Modern Header -->
                <header class="mb-8">
                    <h1 class="text-3xl font-bold text-red-600">Dashboard Overview</h1>
                    <p class="mt-2 text-sm text-gray-600">Welcome back, <?php echo htmlspecialchars($data['user']['name']); ?></p>
                </header>

                <!-- Redesigned Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 animate-fade-in">
                    <!-- Pending Letters Card -->
                    <div class="group border border-gray-200 rounded-xl p-6 hover:border-red-500 transition-all duration-300 hover:scale-105 hover:shadow-lg bg-white relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-red-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="flex items-center relative z-10">
                            <div class="p-3 rounded-xl bg-red-50 text-red-600 group-hover:bg-red-100 transition-colors duration-300">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 group-hover:text-gray-800">Verified Letters</p>
                                <p class="text-xl font-semibold text-green-600"><?= $data['verify']['total'] ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Images Card -->
                    <div class="group border border-gray-200 rounded-xl p-6 hover:border-yellow-500 transition-all duration-300 hover:scale-105 hover:shadow-lg bg-white relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-yellow-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="flex items-center relative z-10">
                            <div class="p-3 rounded-xl bg-yellow-50 text-yellow-600 group-hover:bg-yellow-100 transition-colors duration-300">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 group-hover:text-gray-800">Pending Images</p>
                                <p class="text-xl font-semibold text-yellow-600">8</p>
                            </div>
                        </div>
                    </div>

                    <!-- Rejected Items Card -->
                    <div class="group border border-gray-200 rounded-xl p-6 hover:border-red-500 transition-all duration-300 hover:scale-105 hover:shadow-lg bg-white relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-red-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="flex items-center relative z-10">
                            <div class="p-3 rounded-xl bg-red-50 text-red-600 group-hover:bg-red-100 transition-colors duration-300">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 group-hover:text-gray-800">Rejected Items</p>
                                <p class="text-xl font-semibold text-red-600">3</p>
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
                                       placeholder="Search users..." 
                                       class="pl-11 pr-4 py-2.5 bg-gray-50 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-red-500 transition-all duration-200 text-gray-600 placeholder-gray-400 w-64"
                                >
                                <svg class="w-5 h-5 absolute left-4 top-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
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
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-8 py-5 text-left">
                                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Role</span>
                                        </th>
                                        <th scope="col" class="px-8 py-5 text-left">
                                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Status</span>
                                        </th>
                                        <th scope="col" class="px-8 py-5 text-left">
                                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    <?php foreach ($data['allUser'] as $allUser) :?>                
                                    <tr class="group hover:bg-gray-50/50 transition-all duration-200">
                                        <td class="px-8 py-5">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-lg overflow-hidden bg-gray-100">
                                                    <?php if($allUser['profile_picture'] == NULL) :?>
                                                        <img class="h-full w-full object-cover" 
                                                             src="<?= ASSETS ?>/images/empty-user.png" alt="">
                                                    <?php else :?>
                                                        <img class="h-full w-full object-cover" 
                                                             src="<?= PHOTOPROFILE . $allUser['profile_picture']?>" alt="">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900">
                                                        <?= $allUser['name'] ?>
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        <?= $allUser['email'] ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-5">
                                            <?php if ($allUser['role_id'] == 1) { ?>
                                                <span class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600">
                                                    <span class="w-1 h-1 mr-1.5 rounded-full bg-red-500"></span>
                                                    Admin
                                                </span>
                                            <?php } elseif ($allUser['role_id'] == 2) { ?>
                                                <span class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-medium bg-blue-50 text-blue-600">
                                                    <span class="w-1 h-1 mr-1.5 rounded-full bg-blue-500"></span>
                                                    Researcher
                                                </span>
                                            <?php } ?>
                                        </td>
                                        <td class="px-8 py-5">
                                            <span class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-medium bg-green-50 text-green-600">
                                                <span class="w-1 h-1 mr-1.5 rounded-full bg-green-500"></span>
                                                Active
                                            </span>
                                        </td>
                                        <td class="px-8 py-5 text-sm space-x-3">
                                            <a href="<?= BASEURL; ?>/User/editView/<?= $allUser['user_id'] ?>" 
                                               class="inline-flex items-center text-gray-500 hover:text-red-600 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <?php if ($allUser['user_id'] != $_SESSION['user_id']) { ?>
                                                <a href="<?= BASEURL; ?>/User/Delete/<?= $allUser['user_id'] ?>" 
                                                   class="inline-flex items-center text-gray-500 hover:text-red-600 transition-colors duration-200"
                                                   onclick="return confirm('Are you sure you want to delete this user?')">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </a>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="px-8 py-4 border-t border-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-500">
                                    Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">20</span> results
                                </div>
                                <div class="flex space-x-2">
                                    <button class="px-4 py-2 text-sm text-gray-500 hover:text-red-600 transition-colors duration-200">
                                        Previous
                                    </button>
                                    <button class="px-4 py-2 text-sm text-gray-500 hover:text-red-600 transition-colors duration-200">
                                        Next
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modern Logout Button -->
            <form action="<?= BASEURL; ?>/login/logout" method="POST" class="absolute top-6 right-6">
                <input type="hidden" name="action" value="logout">
                <button type="submit" class="px-5 py-2.5 text-sm font-medium rounded-lg btn-outline">
                    Logout
                </button>
            </form>
        </main>
    </div>

    <script>
        // Update user profile section with session data
        const userData = <?php echo json_encode($userData); ?>;
        
        document.getElementById('username').textContent = userData.username;
        document.getElementById('userRole').textContent = userData.role;
        document.getElementById('userAvatar').src = userData.avatar;
    </script>
</body>
</html>