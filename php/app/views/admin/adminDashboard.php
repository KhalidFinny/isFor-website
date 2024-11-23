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
        }
        
        /* Base Animations */
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        .animate-slide-in {
            animation: slideIn 0.5s ease-out;
        }

        /* Hover Animations */
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        /* Stats Card Hover */
        .stats-card {
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(29, 78, 216, 0.05);
        }

        /* Sidebar Link Hover */
        .sidebar-link {
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background-color: #f3f4f6;
            transform: translateX(4px);
        }

        .sidebar-link.active {
            background-color: #1d4ed8;
            color: white;
        }

        /* Table Row Hover */
        .table-row {
            transition: all 0.2s ease;
        }

        .table-row:hover {
            background-color: #f8fafc;
        }

        /* Button Animations */
        .btn {
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .btn:after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: rgba(255, 255, 255, 0.1);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.2s ease;
        }

        .btn:hover:after {
            transform: scaleX(1);
            transform-origin: left;
        }

        /* Keyframes */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(10px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Status Badge Animation */
        .status-badge {
            transition: all 0.2s ease;
        }

        .status-badge:hover {
            transform: scale(1.05);
        }

        /* Profile Section Animation */
        .profile-section {
            transition: all 0.3s ease;
        }

        .profile-section:hover {
            background-color: #f8fafc;
        }

        /* Icon Animation */
        .icon-animate {
            transition: all 0.2s ease;
        }

        .sidebar-link:hover .icon-animate {
            transform: scale(1.1);
            color: #1d4ed8;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <?php include_once '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <header class="mb-8">
                    <h1 class="text-2xl font-bold text-blue-700">Dashboard Overview</h1>
                    <p class="mt-1 text-sm text-gray-500">Welcome back, <?php echo htmlspecialchars($data['user']['username']); ?></p>
                </header>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 animate-fade-in">
                    <!-- Letter Stats -->
                    <div class="stats-card bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-blue-50 text-blue-700">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Surat Masih Pending</p>
                                <p class="text-xl font-semibold text-blue-700">0</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Surat Terverifikasi</p>
                                <p class="text-lg font-semibold text-gray-900">0</p>
                            </div>
                        </div>
                    </div>

                    <!-- Image Stats -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Gambar Masih Pending</p>
                                <p class="text-lg font-semibold text-gray-900">0</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Dokumen Ditolak</p>
                                <p class="text-lg font-semibold text-gray-900">0</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button class="mb-2 px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"><a href="<?= BASEURL; ?>/User">add user</a></button>
                
                <!-- Recent Users -->
                <div class="animate-slide-in">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900">Recent Users</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php foreach ($data['allUser'] as $allUser) :?>
                                    <tr class="table-row">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 flex-shrink-0">
                                                    <img class="h-10 w-10 rounded-full object-cover" src="<?= PHOTOPROFILE . $allUser['profile_picture']?>" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900"><?= $allUser['username'] ?></div>
                                                    <div class="text-sm text-gray-500"><?= $allUser['email'] ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <?php if ($allUser['role_id'] == 1) { ?>
                                                    <p>Pengelola</p>
                                                <?php } elseif ($allUser['role_id'] == 2) { ?>
                                                    <p>Peneliti</p>
                                                <?php } else { ?>
                                                    <p>Role tidak ada</p>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="<?= BASEURL; ?>/User/editView/<?= $allUser['user_id'] ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <?php if ($allUser['user_id'] != $_SESSION['user_id']) { ?>
                                                | <a href="<?= BASEURL; ?>/User/Delete/<?= $allUser['user_id'] ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Delete</a>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <!-- Add more user rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add logout button -->
            <form action="<?= BASEURL; ?>/login/logout" method="POST" class="absolute top-4 right-4">
                <input type="hidden" name="action" value="logout">
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
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