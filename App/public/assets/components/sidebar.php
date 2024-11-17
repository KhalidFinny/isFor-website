<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Admin Sidebar</title>
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
<body>
    <nav class="w-64 h-screen bg-white border-r border-gray-200 fixed left-0 top-0">
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200">
                <img src="@images/Logo1.png" alt="Logo" class="h-8">
            </div>

            <!-- Navigation Menu -->
            <div class="flex-1 overflow-y-auto py-6">
                <div class="px-4 space-y-4">
                    <!-- Dashboard -->
                    <a href="/admin_dashboard" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-900 group">
                        <svg class="icon-animate w-5 h-5 mr-3 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <!-- Verification Section -->
                    <div class="space-y-1">
                        <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Verification</p>
                        <a href="/letter-verification" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-900">
                            <svg class="w-5 h-5 mr-3 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Letter Verification
                        </a>
                        <a href="/image-verification" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-900">
                            <svg class="w-5 h-5 mr-3 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Image Verification
                        </a>
                    </div>

                    <!-- User Management -->
                    <div class="space-y-1">
                        <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">User Management</p>
                        <a href="/users" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-900">
                            <svg class="w-5 h-5 mr-3 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Manage Users
                        </a>
                    </div>

                    <!-- Content Management -->
                    <div class="space-y-1">
                        <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Content Management</p>
                        <a href="/roadmap" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-900">
                            <svg class="w-5 h-5 mr-3 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                            Roadmap
                        </a>
                        <a href="/agenda" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-900">
                            <svg class="w-5 h-5 mr-3 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Agenda
                        </a>
                    </div>
                </div>
            </div>

            <!-- User Profile -->
            <div class="profile-section border-t border-gray-200 p-4">
                <div class="flex items-center space-x-3">
                    <img id="userAvatar" src="" alt="User avatar" class="w-10 h-10 rounded-full border-2 border-blue-700">
                    <div>
                        <p class="text-sm font-medium text-gray-900" id="username"></p>
                        <p class="text-xs text-gray-500" id="userRole"></p>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>