<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ASSETS; ?>/css/animations.css">
    <link rel="stylesheet" href="http://localhost/IsFor-website/php/app/views/assets/css/inandout.css">
    <script src="http://localhost/IsFor-website/php/app/views/assets/js/animations.js" defer></script>
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
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
    </style>
</head>
<body class="bg-gray-50">
<div class="flex">
    <?php include_once '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>
    <div class="flex-1 min-h-screen ml-64">
        <main class="py-10 px-8">
            <!-- Header -->
            <header class="max-w-7xl mx-auto mb-12">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="h-px w-12 bg-blue-600"></span>
                            <span class="text-blue-600 font-medium">Manajemen</span>
                        </div>
                        <h1 class="text-4xl font-bold text-blue-900">Pengguna</h1>
                    </div>
                    <button onclick="showAddUserModal()"
                            class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Tambah Pengguna</span>
                    </button>
                </div>
            </header>

            <!-- User List -->
            <section class="bg-white rounded-2xl border-2 border-blue-100 overflow-hidden fade-in">
                <div class="p-6 border-b border-blue-100">
                    <h2 class="text-xl font-semibold text-blue-900">Daftar Pengguna</h2>
                </div>

                <?php if (empty($data)): ?>
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <img src="<?= ASSETS; ?>/images/empty-user.png" alt="No Users" class="mx-auto h-40 animate-bounce rounded-full">
                        <p class="mt-4 text-lg text-blue-900">Belum ada pengguna</p>
                        <p class="text-sm text-gray-500">Mulai dengan menambahkan pengguna baru</p>
                    </div>

                <?php else: ?>
                    <!-- User Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-blue-100">
                            <thead class="bg-blue-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-900 uppercase tracking-wider">
                                    Nama
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-900 uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-900 uppercase tracking-wider">
                                    Peran
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-900 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-blue-100">
                            <?php foreach ($data['allUser'] as $allUser) :?>                
                                    <tr class="table-row">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 flex-shrink-0">
                                                    <img class="h-10 w-10 rounded-full object-cover" src="<?= PHOTOPROFILE . $allUser['profile_picture']?>" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900"><?= $allUser['username'] ?></div>
                                                    
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900"><?= $allUser['email'] ?></div>
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="<?= BASEURL; ?>/User/editView/<?= $allUser['user_id'] ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <?php if ($allUser['user_id'] != $_SESSION['user_id']) { ?>
                                                | <a href="<?= BASEURL; ?>/User/Delete/<?= $allUser['user_id'] ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Delete</a>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </section>
        </main>
    </div>
</div>

<!-- Add User Modal -->
<a href="<?= BASEURL ?>/dashboardAdmin">dashboardAdmin</a>
<div id="addUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4">
        <h3 class="text-2xl font-bold text-blue-900 mb-6">Tambah Pengguna Baru</h3>
        <form action="<?= BASEURL; ?>/User/create" method="POST" class="space-y-4" enctype="multipart/form-data">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="username" id="username"
                       class="w-full px-4 py-2 border-2 border-blue-100 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                       required placeholder="Username">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email"
                       class="w-full px-4 py-2 border-2 border-blue-100 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                       required placeholder="Email">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password"
                       class="w-full px-4 py-2 border-2 border-blue-100 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                       required placeholder="Password">
            </div>
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Peran</label>
                <select name="role" id="role"
                        class="w-full px-4 py-2 border-2 border-blue-100 rounded-xl focus:border-blue-500 focus:ring-blue-500">
                    <option value="1">Pengelola</option>
                    <option value="2">Peneliti</option>
                </select>
            </div>
            <div>
                <label for="profile_picture"  class="block text-sm font-medium text-gray-700 mb-1">Unggah Foto
                    Profil</label>
                <input type="file" name="profile_picture" id="profile_picture"
                       class="w-full px-4 py-2 border-2 border-blue-100 rounded-xl focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="hideAddUserModal()" class="px-4 py-2 text-gray-700 hover:text-gray-900">
                    Batal
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700">Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function showAddUserModal() {
        document.getElementById('addUserModal').classList.remove('hidden');
        document.getElementById('addUserModal').classList.add('flex');
    }

    function hideAddUserModal() {
        document.getElementById('addUserModal').classList.add('hidden');
        document.getElementById('addUserModal').classList.remove('flex');
    }
</script>
</body>
</html>
