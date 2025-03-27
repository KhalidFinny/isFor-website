<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - IsFor Internet of Things For Human Life's</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS; ?>/admin/users.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-white">
    <div class="flex flex-col lg:flex-row">
        <?php include_once '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>

        <div class="flex-1 min-h-screen lg:ml-64">
            <main class="py-10 px-4 sm:px-8">
                <!-- Back Button -->
                <div class="max-w-7xl mx-auto mb-12">
                    <a href="<?= BASEURL ?>/dashboardAdmin"
                        class="inline-flex items-center space-x-2 text-red-500 hover:text-red-600 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Kembali</span>
                    </a>
                </div>
                <!-- Header -->
                <header class="max-w-7xl mx-auto mb-12 animate-fade-in">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between">
                        <div>
                            <div class="flex items-center space-x-4 mb-4">
                                <span class="h-px w-12 bg-red-500"></span>
                                <span class="text-red-500 font-medium">Manajemen</span>
                            </div>
                            <h1 class="text-3xl sm:text-4xl font-bold text-red-600">Pengguna</h1>
                        </div>

                        <button onclick="showAddUserModal()"
                            class="mt-4 sm:mt-0 px-6 py-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-all duration-300 flex items-center space-x-2 btn-primary">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Tambah Pengguna</span>
                        </button>
                    </div>
                </header>

                <!-- User List -->
                <section class="bg-white rounded-2xl border border-red-100 overflow-hidden animate-slide-in">
                    <div class="px-4 sm:px-8 py-6 border-b border-red-100 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                        <h2 class="text-xl sm:text-2xl font-light text-red-500 tracking-tight">Daftar Pengguna</h2>
                        <div class="relative mt-4 sm:mt-0">
                            <input type="text" id="searchUser" placeholder="Cari pengguna..."
                                class="pl-11 pr-4 py-2.5 bg-gray-50 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-red-500 transition-all duration-200 text-gray-600 placeholder-gray-400 w-full sm:w-64">
                            <svg class="w-5 h-5 absolute left-4 top-3 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    <?php if (empty($data)): ?>
                        <div class="text-center py-12">
                            <img src="<?= ASSETS; ?>/images/empty-user.png" alt="No Users" class="mx-auto h-40 opacity-50">
                            <p class="mt-4 text-lg text-gray-900">Belum ada pengguna</p>
                            <p class="text-sm text-gray-500">Mulai dengan menambahkan pengguna baru</p>
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-red-100">
                                <thead>
                                    <tr>
                                        <th class="px-4 sm:px-8 py-5 text-left">
                                            <div class="flex items-center space-x-2">
                                                <span
                                                    class="text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</span>
                                                <svg class="w-4 h-4 text-red-300" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </div>
                                        </th>
                                        <th class="px-4 sm:px-8 py-5 text-left">
                                            <span
                                                class="text-xs font-medium text-gray-500 uppercase tracking-wider">Email</span>
                                        </th>
                                        <th class="px-4 sm:px-8 py-5 text-left">
                                            <span
                                                class="text-xs font-medium text-gray-500 uppercase tracking-wider">Peran</span>
                                        </th>
                                        <th class="px-4 sm:px-8 py-5 text-left">
                                            <span
                                                class="text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-red-50">
                                    <?php foreach ($data['allUsersWithPagination'] as $allUsersWithPagination): ?>
                                        <tr class="table-row">
                                            <td class="px-4 sm:px-8 py-5">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden bg-red-50">
                                                        <?php if ($allUsersWithPagination['profile_picture'] == null): ?>
                                                            <div
                                                                class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden bg-red-50">
                                                                <svg class="h-full w-full object-cover rounded-full"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 6C13.66 6 15 7.34 15 9C15 10.66 13.66 12 12 12C10.34 12 9 10.66 9 9C9 7.34 10.34 6 12 6ZM12 20.2C9.5 20.2 7.29 18.92 6 16.98C6.03 14.99 10 13.9 12 13.9C13.99 13.9 17.97 14.99 18 16.98C16.71 18.92 14.5 20.2 12 20.2Z"
                                                                        fill="#ef4444" />
                                                                </svg>
                                                            </div>
                                                        <?php else: ?>
                                                            <div
                                                                class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden bg-red-50">
                                                                <img class="h-full w-full object-cover rounded-full"
                                                                    src="<?= PHOTOPROFILE . $allUsersWithPagination['profile_picture'] ?>"
                                                                    alt="">
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-medium text-red-600">
                                                            <?= $allUsersWithPagination['name'] ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 sm:px-8 py-5">
                                                <div class="text-sm text-red-500"><?= $allUsersWithPagination['email'] ?></div>
                                            </td>
                                            <td class="px-4 sm:px-8 py-5">
                                                <?php if ($allUsersWithPagination['role_id'] == 1) { ?>
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600">
                                                        <span class="w-1 h-1 mr-1.5 rounded-full bg-red-500"></span>
                                                        Admin
                                                    </span>
                                                <?php } elseif ($allUsersWithPagination['role_id'] == 2) { ?>
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-medium bg-blue-50 text-blue-600">
                                                        <span class="w-1 h-1 mr-1.5 rounded-full bg-blue-500"></span>
                                                        Peneliti
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td class="px-4 sm:px-8 py-5 text-sm space-x-3">
                                                <a href="<?= BASEURL; ?>/User/editView/<?= $allUsersWithPagination['user_id'] ?>"
                                                    class="inline-flex items-center text-gray-500 hover:text-red-600 transition-colors duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <?php if ($allUsersWithPagination['user_id'] != $_SESSION['user_id']) { ?>
                                                    <a href="<?= BASEURL; ?>/User/Delete/<?= $allUsersWithPagination['user_id'] ?>"
                                                        class="inline-flex items-center text-gray-500 hover:text-red-600 transition-colors duration-200"
                                                        onclick="return confirm('Are you sure you want to delete this user?')">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                    <div class="flex items-center justify-between px-4 py-3 border-t border-gray-200">
                        <div id="infoContainer" class="text-sm text-gray-500"></div>
                        <div id="pagination" class="flex items-center space-x-2"></div>
                    </div>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="addUserForm" action="<?= BASEURL; ?>/User/create" method="POST" enctype="multipart/form-data">
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
                            <label for="profile_picture" class="block text-sm font-medium text-red-500">Foto
                                Profil</label>
                            <div class="relative">
                                <input type="file" name="profile_picture" id="profile_picture" class="hidden"
                                    accept="image/*">
                                <label for="profile_picture" class="flex items-center justify-center w-full px-4 py-2.5 rounded-xl
                                              border-2 border-dashed border-red-200 cursor-pointer
                                              hover:border-red-400 hover:bg-red-50 transition-all duration-200
                                              text-gray-500 hover:text-red-500">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
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
                            <button type="button" onclick="hideAddUserModal()" class="group relative border border-red-200 text-red-500 rounded-xl py-3 px-6
                                           hover:bg-red-50 transition-all duration-300">
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <span class="font-medium">Batal</span>
                                </span>
                            </button>

                            <button type="submit" class="group relative bg-red-500 text-white rounded-xl py-3 px-6
                                           hover:bg-red-600 transition-all duration-300 overflow-hidden">
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
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
            $('#addUserModal').removeClass('hidden').addClass('flex');
        }

        function hideAddUserModal() {
            $('#addUserModal').addClass('hidden').removeClass('flex');
        }

        $(document).ready(function() {
            // AJAX untuk submit form tambah pengguna
            $('#addUserForm').on('submit', function(e) {
                e.preventDefault(); // Mencegah submit form secara default

                var formData = new FormData(this);

                $.ajax({
                    url: '<?= BASEURL; ?>/User/create', // URL endpoint
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        try {
                            var data = JSON.parse(response);
                            alert(data.message);
                            // Refresh halaman jika proses berhasil
                            if (data.status === 'success') {
                                location.reload();
                            }
                        } catch (error) {
                            console.error('Error parsing response:', error);
                            alert('Terjadi kesalahan saat memproses respons.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengirim data.');
                    }
                });
            });
        });

        $(document).ready(function() {
            let tableBody = $('tbody');
            let pagination = $('#pagination');
            let infoContainer = $('#infoContainer');
            let pageSize = 5; // Jumlah data per halaman
            let currentPage = 1; // Halaman aktif

            // Fungsi untuk membuat tombol pagination dengan ellipsis
            function createPaginationButtons(totalPages, currentPage) {
                let buttons = [];
                if (totalPages <= 5) {
                    // Jika halaman kurang atau sama dengan 5, tampilkan semua tombol
                    for (let i = 1; i <= totalPages; i++) {
                        buttons.push({
                            page: i
                        });
                    }
                } else {
                    // Tampilkan tombol halaman pertama
                    buttons.push({
                        page: 1
                    });
                    // Jika currentPage > 3, tampilkan ellipsis
                    if (currentPage > 3) {
                        buttons.push({
                            ellipsis: true
                        });
                    }
                    // Tampilkan halaman di sekitar currentPage (1 sebelum dan 1 sesudah)
                    let start = Math.max(2, currentPage - 1);
                    let end = Math.min(totalPages - 1, currentPage + 1);
                    for (let i = start; i <= end; i++) {
                        buttons.push({
                            page: i
                        });
                    }
                    // Jika currentPage < totalPages - 2, tampilkan ellipsis
                    if (currentPage < totalPages - 2) {
                        buttons.push({
                            ellipsis: true
                        });
                    }
                    // Tampilkan tombol halaman terakhir
                    buttons.push({
                        page: totalPages
                    });
                }
                return buttons;
            }

            // Fungsi utama untuk mengambil data pengguna dengan AJAX
            function fetchUsers(keyword, pageNumber) {
                $.ajax({
                    url: '<?= BASEURL; ?>/user/search', // Endpoint, sesuaikan jika perlu
                    type: 'POST',
                    data: {
                        keyword: keyword,
                        pageNumber: pageNumber,
                        pageSize: pageSize
                    },
                    dataType: 'json',
                    success: function(data) {
                        // Kosongkan tabel, pagination, dan infoContainer
                        tableBody.empty();
                        pagination.empty();
                        infoContainer.empty();

                        // Jika ada data
                        if (data.data.length > 0) {
                            $.each(data.data, function(index, user) {
                                let roleClass = user.role_id == "1" ? 'bg-red-50 text-red-600' : 'bg-blue-50 text-blue-600';
                                let roleLabel = user.role_id == "1" ? 'Admin' : 'Peneliti';
                                let profilePic = user.profile_picture ?
                                    `<img class="h-full w-full object-cover rounded-full" src="<?= PHOTOPROFILE ?>${user.profile_picture}" alt="">` :
                                    `<svg class="h-full w-full object-cover rounded-full" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 6C13.66 6 15 7.34 15 9C15 10.66 13.66 12 12 12C10.34 12 9 10.66 9 9C9 7.34 10.34 6 12 6ZM12 20.2C9.5 20.2 7.29 18.92 6 16.98C6.03 14.99 10 13.9 12 13.9C13.99 13.9 17.97 14.99 18 16.98C16.71 18.92 14.5 20.2 12 20.2Z" fill="#ef4444"/>
                                </svg>`;

                                tableBody.append(`
                            <tr class="table-row">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden bg-red-50">
                                            ${profilePic}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-red-600">${user.name}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-red-500">
                                    ${user.email}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-medium ${roleClass}">
                                        <span class="w-1 h-1 mr-1.5 rounded-full bg-${roleLabel === 'Admin' ? 'red-500' : 'blue-500'}"></span>
                                        ${roleLabel}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm space-x-3">
                                    <a href="<?= BASEURL; ?>/User/editView/${user.user_id}" class="inline-flex items-center text-gray-500 hover:text-red-600 transition-colors duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414
                                                     a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <a href="<?= BASEURL; ?>/User/Delete/${user.user_id}" class="inline-flex items-center text-gray-500 hover:text-red-600 transition-colors duration-200" onclick="return confirm('Are you sure you want to delete this user?')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0
                                                     01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0
                                                     00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        `);
                            });

                            // Buat pagination dengan ellipsis
                            let totalPages = Math.ceil(data.totalCount / pageSize);
                            if (totalPages > 1) {
                                // Tampilkan info "Page X of Y"
                                pagination.append(`
                            <div class="text-sm text-gray-500">
                                Page <span class="font-medium">${pageNumber}</span> of <span class="font-medium">${totalPages}</span>
                            </div>
                        `);

                                let buttons = createPaginationButtons(totalPages, pageNumber);
                                buttons.forEach(btn => {
                                    if (btn.ellipsis) {
                                        pagination.append(`<span class="px-3 py-1 text-sm">...</span>`);
                                    } else {
                                        let activeClass = (btn.page === pageNumber) ?
                                            'bg-red-100 text-red-600 border-red-200' :
                                            'bg-white text-gray-600 border-gray-200 hover:bg-red-50 hover:text-red-600';
                                        pagination.append(`
                                    <button class="px-3 py-1 text-sm border rounded-md ${activeClass}" data-page="${btn.page}">
                                        ${btn.page}
                                    </button>
                                `);
                                    }
                                });

                                // Event klik tombol pagination
                                pagination.off('click').on('click', 'button', function() {
                                    currentPage = parseInt($(this).data('page'));
                                    fetchUsers(keyword, currentPage);
                                });
                            }
                        } else {
                            tableBody.html(`
                        <tr>
                            <td colspan="4" class="text-center py-5 text-gray-500">
                                Pengguna tidak ditemukan.
                            </td>
                        </tr>
                    `);
                        }

                        // Tampilkan info "Showing X to Y of Z results" jika tersedia
                        if (data.totalCount) {
                            let start = (pageNumber - 1) * pageSize + 1;
                            let end = Math.min(pageNumber * pageSize, data.totalCount);
                            let infoText = `Showing ${start} to ${end} of ${data.totalCount} results`;
                            infoContainer.text(infoText);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }

            // Event pencarian
            $('#searchUser').on('keyup', function() {
                let keyword = $(this).val();
                currentPage = 1;
                fetchUsers(keyword, currentPage);
            });

            // Panggil fetchUsers() pertama kali
            fetchUsers('', currentPage);
        });

        $('#profile_picture').on('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Pilih foto profil';
            $('#file-name').text(fileName);
        });
    </script>
</body>

</html>