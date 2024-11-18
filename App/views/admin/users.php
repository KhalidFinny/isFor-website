<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - IsFor PRI</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/isfor-web/App/public/assets/css/animations.css">
    <style>
        .fade-in { animation: fadeIn 0.5s ease-out forwards; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex">
        <?php include '../../public/assets/components/AdminDashboard/sidebar.php'; ?>
        <div class="flex-1 min-h-screen ml-64">
            <main class="py-10 px-8">
                <!-- Header -->
                <div class="max-w-7xl mx-auto mb-12">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="flex items-center space-x-4 mb-4">
                                <span class="h-px w-12 bg-blue-600"></span>
                                <span class="text-blue-600 font-medium">Manajemen</span>
                            </div>
                            <h1 class="text-4xl font-bold text-blue-900">Pengguna</h1>
                        </div>
                        <button onclick="showAddUserModal()" class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Tambah Pengguna</span>
                        </button>
                    </div>
                </div>

                <!-- User List -->
                <div class="bg-white rounded-2xl border-2 border-blue-100 overflow-hidden fade-in">
                    <div class="p-6 border-b border-blue-100">
                        <h2 class="text-xl font-semibold text-blue-900">Daftar Pengguna</h2>
                    </div>
                    
                    <?php if (empty($users)): ?>
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <img src="/isfor-web/App/public/assets/images/empty-users.png" alt="No Users" class="mx-auto h-40 animate-bounce">
                        <p class="mt-4 text-lg text-blue-900">Belum ada pengguna</p>
                        <p class="text-sm text-gray-500">Mulai dengan menambahkan pengguna baru</p>
                    </div>
                    <?php else: ?>
                    <!-- User Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-blue-100">
                            <thead class="bg-blue-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-blue-900 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-blue-900 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-blue-900 uppercase tracking-wider">Peran</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-blue-900 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-blue-100">
                                <!-- User rows would be populated here -->
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Add User Modal -->
    <div id="addUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4">
            <h3 class="text-2xl font-bold text-blue-900 mb-6">Tambah Pengguna Baru</h3>
            <form action="/users/add" method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" class="w-full px-4 py-2 border-2 border-blue-100 rounded-xl focus:border-blue-500 focus:ring-blue-500">
                </div>
                <!-- Add more form fields -->
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="hideAddUserModal()" class="px-4 py-2 text-gray-700 hover:text-gray-900">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700">Simpan</button>
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