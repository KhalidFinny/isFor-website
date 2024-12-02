<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - IsFor PRI</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ASSETS; ?>/css/animations.css">
    <style>
        /* Modern animations and effects */
        .fade-in {
            opacity: 0;
            animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .slide-up {
            opacity: 0;
            transform: translateY(20px);
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .hover-scale {
            transition: transform 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .hover-scale:hover {
            transform: scale(1.02);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Modern styling */
        .modern-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(229, 231, 235, 0.5);
        }

        .input-modern {
            transition: all 0.3s ease;
            background: rgba(249, 250, 251, 0.8);
        }

        .input-modern:focus {
            background: white;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        /* Decorative elements */
        .decoration-dot {
            position: absolute;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.1);
            z-index: -1;
        }
    </style>
</head>
<body class="bg-gray-50 relative overflow-x-hidden"></body>

<div class="flex">
    <!-- Sidebar -->
    <?php include_once '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 min-h-screen ml-64">
        <main class="py-10 px-8 relative">
            <!-- Header -->
            <header class="max-w-7xl mx-auto mb-12 fade-in">
                <div class="flex items-center space-x-4 mb-4">
                    <span class="h-px w-12 bg-blue-600"></span>
                    <span class="text-blue-600 font-medium">MANAJEMEN</span>
                </div>
                <h1 class="text-4xl font-bold text-blue-900">
                    Edit Pengguna
                </h1>
                <p class="text-gray-500 mt-2 max-w-lg">Perbarui informasi pengguna dengan mengisi formulir di bawah ini</p>
                <div class="mt-6">
                    <a href="<?= BASEURL; ?>/dashboardAdmin"
                       class="px-6 py-3 bg-white hover-scale shadow-sm border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 transition-all flex items-center space-x-2 w-fit">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span>Kembali ke Dashboard</span>
                    </a>
                </div>
            </header>

            <!-- Edit User Form -->
            <section class="modern-card rounded-2xl overflow-hidden slide-up shadow-sm max-w-4xl mx-auto">
                <div class="p-8 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-900">Formulir Edit Pengguna</h2>
                </div>
                <form action="<?= BASEURL; ?>/User/edit" method="POST" class="p-8" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?= $data['user']['user_id'] ?>">
                    <input type="hidden" name="role_id" value="<?= $data['user']['role_id'] ?>">
                    <input type="hidden" name="oldImage" value="<?= $data['user']['profile_picture'] ?>">
                    <input type="hidden" name="oldPass" value="<?= $data['user']['password'] ?>">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <!-- Field Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="name" id="name"
                                       class="input-modern w-full px-4 py-3 border border-gray-200 rounded-xl"
                                       value="<?= $data['user']['name'] ?>" required>
                            </div>

                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                                <input type="text" name="username" id="username"
                                       class="input-modern w-full px-4 py-3 border border-gray-200 rounded-xl"
                                       value="<?= $data['user']['username'] ?>" required>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" id="email"
                                       class="input-modern w-full px-4 py-3 border border-gray-200 rounded-xl"
                                       value="<?= $data['user']['email'] ?>" required>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                                <input type="password" name="password" id="password"
                                       class="input-modern w-full px-4 py-3 border border-gray-200 rounded-xl"
                                       placeholder="Kosongkan jika tidak ingin mengubah">
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Role Saat Ini</label>
                                <div class="px-4 py-3 bg-gray-50 rounded-xl border border-gray-200">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?= $data['user']['role_id'] == 1 ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' ?>">
                                        <?= $data['user']['role_id'] == 1 ? "Admin" : "User" ?>
                                    </span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
                                <div class="flex items-center space-x-4">
                                    <img src="<?= PHOTOPROFILE . $data['user']['profile_picture'] ?>"
                                         alt="Profile Picture"
                                         class="w-16 h-16 rounded-full object-cover border-2 border-gray-200">
                                    <input type="file" name="profile_picture" id="profile_picture"
                                           class="input-modern flex-1 px-4 py-3 border border-gray-200 rounded-xl">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-100">
                        <button type="button"
                                onclick="window.history.back()"
                                class="px-6 py-2 text-gray-700 hover:text-gray-900 font-medium">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl hover-scale transition-all">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </section>
        </main>
    </div>
</div>

<script>
    // Add smooth reveal animations for form elements
    document.addEventListener('DOMContentLoaded', () => {
        const formElements = document.querySelectorAll('input, select, button');
        formElements.forEach((element, index) => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(10px)';
            setTimeout(() => {
                element.style.transition = 'all 0.5s cubic-bezier(0.16, 1, 0.3, 1)';
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }, 100 * index);
        });
    });
</script>
</body>
</html>