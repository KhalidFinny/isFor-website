<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .animate-fade-in {
            animation: smoothFadeIn 0.4s ease-out;
        }

        .animate-slide-in {
            animation: smoothSlideIn 0.4s ease-out;
        }

        /* Modal Animation */
        .modal-enter {
            animation: modalEnter 0.3s ease-out;
        }

        @keyframes modalEnter {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(-10px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes smoothFadeIn {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes smoothSlideIn {
            from { opacity: 0; transform: translateX(-8px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Text Colors */
        .text-primary { color: #ef4444; }  /* Red-500 */
        .text-secondary { color: #f87171; } /* Red-400 */
        .text-subtle { color: #fca5a5; }    /* Red-300 */

        /* Form Input Styles */
        .form-input {
            transition: all 0.2s ease;
            border: 1px solid #fecaca;
            background: rgba(255, 255, 255, 0.8);
            color: #ef4444;
        }

        .form-input::placeholder {
            color: #fca5a5;
        }

        /* Table Styles */
        .table-row:hover {
            background-color: #fff1f1;
        }

        /* Button Styles */
        .btn-primary {
            transition: all 0.2s ease;
            background-color: #ef4444;
        }

        .btn-primary:hover {
            background-color: #dc2626;
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="bg-white">
    <div class="flex">
        <?php include_once '../app/views/assets/components/AdminDashboard/sidebar.php';?>

        <div class="flex-1 min-h-screen ml-64">
            <main class="py-10 px-8">
                <!-- Header -->
                <header class="max-w-7xl mx-auto mb-12 animate-fade-in">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="flex items-center space-x-4 mb-4">
                                <span class="h-px w-12 bg-red-500"></span>
                                <span class="text-red-500 font-medium">Manajemen</span>
                            </div>
                            <h1 class="text-4xl font-bold text-red-600">Pengguna</h1>
                        </div>

                        <!-- New Date Time Display -->
                        <div class="flex items-center space-x-6 bg-white px-6 py-3 rounded-xl border border-red-100">
                            <div class="text-right">
                                <div class="text-sm font-medium text-gray-500" id="current-time"></div>
                                <div class="text-2xl font-light text-red-600" id="current-date"></div>
                            </div>
                            <div class="text-red-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>

                        <button onclick="showAddUserModal()"
                                class="px-6 py-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-all duration-300 flex items-center space-x-2 btn-primary">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span>Tambah Pengguna</span>
                        </button>
                    </div>
                </header>

                <!-- User List -->
                <section class="bg-white rounded-2xl border border-red-100 overflow-hidden animate-slide-in">
                    <div class="px-8 py-6 border-b border-red-100 flex justify-between items-center">
                        <h2 class="text-2xl font-light text-red-500 tracking-tight">Daftar Pengguna</h2>
                        <div class="relative">
                            <input type="text"
                                   placeholder="Cari pengguna..."
                                   class="pl-11 pr-4 py-2.5 bg-gray-50 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-red-500 transition-all duration-200 text-gray-600 placeholder-gray-400 w-64">
                            <svg class="w-5 h-5 absolute left-4 top-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>

                    <?php if (empty($data)): ?>
                        <div class="text-center py-12">
                            <img src="<?=ASSETS;?>/images/empty-user.png" alt="No Users" class="mx-auto h-40 opacity-50">
                            <p class="mt-4 text-lg text-gray-900">Belum ada pengguna</p>
                            <p class="text-sm text-gray-500">Mulai dengan menambahkan pengguna baru</p>
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-red-100">
                                <thead>
                                    <tr>
                                        <th class="px-8 py-5 text-left">
                                            <div class="flex items-center space-x-2">
                                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</span>
                                                <svg class="w-4 h-4 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </div>
                                        </th>
                                        <th class="px-8 py-5 text-left">
            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Email</span>
        </th>
        <th class="px-8 py-5 text-left">
            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Peran</span>
        </th>
        <th class="px-8 py-5 text-left">
            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</span>
        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-red-50">
                                    <?php foreach ($data['allUser'] as $allUser): ?>
                                        <tr class="table-row">
                                            <td class="px-8 py-5">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-shrink-0 h-10 w-10 rounded-lg overflow-hidden bg-red-50">
                                                        <?php if ($allUser['profile_picture'] == null): ?>
                                                            <img class="h-full w-full object-cover" src="<?=ASSETS?>/images/empty-user.png" alt="">
                                                        <?php else: ?>
                                                            <img class="h-full w-full object-cover" src="<?=PHOTOPROFILE . $allUser['profile_picture']?>" alt="">
                                                        <?php endif;?>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-medium text-red-600"><?=$allUser['name']?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-8 py-5">
                                                <div class="text-sm text-red-500"><?=$allUser['email']?></div>
                                            </td>
                                            <td class="px-8 py-5">
                                                <?php if ($allUser['role_id'] == 1) {?>
                                                    <span class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600">
                                                        <span class="w-1 h-1 mr-1.5 rounded-full bg-red-500"></span>
                                                        Admin
                                                    </span>
                                                <?php } elseif ($allUser['role_id'] == 2) {?>
                                                    <span class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-medium bg-blue-50 text-blue-600">
                                                        <span class="w-1 h-1 mr-1.5 rounded-full bg-blue-500"></span>
                                                        Peneliti
                                                    </span>
                                                <?php }?>
                                            </td>
                                            <td class="px-8 py-5 text-sm space-x-3">
                                                <a href="<?=BASEURL;?>/User/editView/<?=$allUser['user_id']?>"
                                                   class="inline-flex items-center text-gray-500 hover:text-red-600 transition-colors duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </a>
                                                <?php if ($allUser['user_id'] != $_SESSION['user_id']) {?>
                                                    <a href="<?=BASEURL;?>/User/Delete/<?=$allUser['user_id']?>"
                                                       class="inline-flex items-center text-gray-500 hover:text-red-600 transition-colors duration-200"
                                                       onclick="return confirm('Are you sure you want to delete this user?')">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </a>
                                                <?php }?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif;?>
                </section>
            </main>
        </div>
    </div>

    <!-- Add User Modal -->
    <div id="addUserModal" class="fixed inset-0 bg-red-50/90 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 max-w-5xl w-full mx-4 modal-enter border border-red-200">
            <!-- Form Header -->
            <div class="flex justify-between items-center mb-8">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="h-px w-8 bg-red-500"></span>
                        <span class="text-red-500 text-sm font-medium">Form</span>
                    </div>
                    <h3 class="text-2xl font-bold text-red-600">Tambah Pengguna Baru</h3>
                </div>
                <button onclick="hideAddUserModal()"
                        class="text-red-400 hover:text-red-600 p-2 hover:bg-red-50 rounded-xl transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form action="<?=BASEURL;?>/User/create" method="POST" enctype="multipart/form-data">
                <div class="grid grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-red-500">Nama Lengkap</label>
                            <input type="text" name="name" id="name" required
                                   class="form-input w-full px-4 py-2.5 rounded-xl text-gray-600 placeholder-gray-400
                                          border-2 border-red-100 focus:border-red-500 focus:ring-0 transition-all duration-200"
                                   placeholder="Masukkan nama lengkap">
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-red-500">Email</label>
                            <input type="email" name="email" id="email" required
                                   class="form-input w-full px-4 py-2.5 rounded-xl text-gray-600 placeholder-gray-400
                                          border-2 border-red-100 focus:border-red-500 focus:ring-0 transition-all duration-200"
                                   placeholder="Masukkan email">
                        </div>

                        <div class="space-y-2">
                            <label for="username" class="block text-sm font-medium text-red-500">Username</label>
                            <input type="text" name="username" id="username" required
                                   class="form-input w-full px-4 py-2.5 rounded-xl text-gray-600 placeholder-gray-400
                                          border-2 border-red-100 focus:border-red-500 focus:ring-0 transition-all duration-200"
                                   placeholder="Masukkan username">
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-red-500">Password</label>
                            <input type="password" name="password" id="password" required
                                   class="form-input w-full px-4 py-2.5 rounded-xl text-gray-600 placeholder-gray-400
                                          border-2 border-red-100 focus:border-red-500 focus:ring-0 transition-all duration-200"
                                   placeholder="Masukkan password">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-red-500">Peran</label>
                            <div class="px-4 py-2.5 rounded-xl bg-red-50 border-2 border-red-100 text-gray-600">
                                <input type="hidden" name="role" value="2">
                                Peneliti
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="profile_picture" class="block text-sm font-medium text-red-500">Foto Profil</label>
                            <div class="relative">
                                <input type="file" name="profile_picture" id="profile_picture"
                                       class="hidden"
                                       accept="image/*">
                                <label for="profile_picture"
                                       class="flex items-center justify-center w-full px-4 py-2.5 rounded-xl
                                              border-2 border-dashed border-red-200 cursor-pointer
                                              hover:border-red-400 hover:bg-red-50 transition-all duration-200
                                              text-gray-500 hover:text-red-500">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span id="file-name">Pilih foto profil</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Swiss-style button layout -->
                <div class="pt-8 mt-8 border-t border-red-100">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center text-sm text-red-400">
                            Pastikan semua data telah terisi dengan benar
                        </div>
                        <div class="flex justify-end gap-3">
                            <button type="button" onclick="hideAddUserModal()"
                                    class="group relative border border-red-200 text-red-500 rounded-xl py-3 px-6
                                           hover:bg-red-50 transition-all duration-300">
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    <span class="font-medium">Batal</span>
                                </span>
                            </button>

                            <button type="submit"
                                    class="group relative bg-red-500 text-white rounded-xl py-3 px-6
                                           hover:bg-red-600 transition-all duration-300 overflow-hidden">
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="font-medium">Simpan Pengguna</span>
                                </span>
                                <div class="absolute inset-0 bg-red-600 transform scale-x-0 group-hover:scale-x-100
                                          transition-transform origin-left duration-300"></div>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showAddUserModal() {
            const modal = document.getElementById('addUserModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function hideAddUserModal() {
            const modal = document.getElementById('addUserModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Add file name display functionality
        document.getElementById('profile_picture').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Pilih foto profil';
            document.getElementById('file-name').textContent = fileName;
        });
    </script>
</body>
</html>