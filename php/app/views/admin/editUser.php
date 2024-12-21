<?php
//var_dump($data);
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Modern Form Animations */
        .form-element {
            opacity: 0;
            transform: translateY(20px);
            animation: formElementFade 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        @keyframes formElementFade {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Staggered animation delays */
        .form-element:nth-child(1) {
            animation-delay: 0.1s;
        }

        .form-element:nth-child(2) {
            animation-delay: 0.2s;
        }

        .form-element:nth-child(3) {
            animation-delay: 0.3s;
        }

        .form-element:nth-child(4) {
            animation-delay: 0.4s;
        }

        /* Input Animations */
        .input-modern {
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .input-modern:focus {
            transform: translateY(-2px);
            border-color: #ef4444;
            box-shadow: 0 2px 15px -3px rgba(239, 68, 68, 0.15);
        }

        /* Back Button Animation */
        .back-button {
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .back-button:hover {
            transform: translateX(-5px);
        }

        /* Card Animation */
        .modern-card {
            animation: cardEntrance 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes cardEntrance {
            0% {
                opacity: 0;
                transform: translateY(40px) scale(0.98);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
    </style>
</head>
<body class="bg-white">
<?php include_once '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>

<div class="flex-1 min-h-screen ml-64">
    <main class="py-10 px-8">
        <!-- Header with Red Accent -->
        <div class="max-w-7xl mx-auto mb-12 form-element">
            <div class="flex items-center space-x-4 mb-4">
                <span class="h-px w-12 bg-red-600"></span>
                <span class="text-red-600 font-medium">Manajemen</span>
            </div>
            <h1 class="text-5xl font-bold text-red-900 mb-2">Edit Pengguna</h1>
            <p class="text-gray-600 mt-2 max-w-lg">Perbarui informasi pengguna dengan mengisi formulir di bawah ini</p>

            <!-- Back Button with Animation -->
            <a href="<?= BASEURL; ?>/dashboardAdmin"
               class="back-button mt-6 inline-flex items-center space-x-2 text-red-600 hover:text-red-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali ke Dashboard</span>
            </a>
        </div>

        <!-- Modern Card with Red Accents -->
        <div class="modern-card bg-white rounded-2xl shadow-sm max-w-4xl mx-auto border border-red-100">
            <div class="p-8 border-b border-red-100">
                <h2 class="text-2xl font-light text-red-500">Formulir Edit Pengguna</h2>
            </div>

            <form id="editUserForm" action="<?= BASEURL; ?>/User/edit" method="POST" class="p-8"
                  enctype="multipart/form-data">
                <!-- Hidden inputs -->
                <input type="hidden" name="user_id" value="<?= $data['user']['user_id'] ?>">
                <input type="hidden" name="role_id" value="<?= $data['user']['role_id'] ?>">
                <input type="hidden" name="oldImage" value="<?= $data['user']['profile_picture'] ?>">
                <input type="hidden" name="oldPass" value="<?= $data['user']['password'] ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <div class="form-element">
                            <label class="block text-sm font-medium text-red-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="<?= $data['user']['name'] ?>" required
                                   class="input-modern w-full px-4 py-3 border-2 border-red-100 rounded-xl">
                        </div>

                        <div class="form-element">
                            <label class="block text-sm font-medium text-red-700 mb-2">Username</label>
                            <input type="text" name="username" value="<?= $data['user']['username'] ?>" required
                                   class="input-modern w-full px-4 py-3 border-2 border-red-100 rounded-xl">
                        </div>

                        <div class="form-element">
                            <label class="block text-sm font-medium text-red-700 mb-2">Email</label>
                            <input type="email" name="email" value="<?= $data['user']['email'] ?>" required
                                   class="input-modern w-full px-4 py-3 border-2 border-red-100 rounded-xl">
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <div class="form-element">
                            <label class="block text-sm font-medium text-red-700 mb-2">Password Baru</label>
                            <input type="password" name="password"
                                   class="input-modern w-full px-4 py-3 border-2 border-red-100 rounded-xl"
                                   placeholder="Kosongkan jika tidak ingin mengubah">
                        </div>

                        <div class="form-element">
                            <label class="block text-sm font-medium text-red-700 mb-2">Role Saat Ini</label>
                            <div class="px-4 py-3 bg-red-50 rounded-xl border-2 border-red-100">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                               <?= $data['user']['role_id'] == 1 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' ?>">
                                        <?= $data['user']['role_id'] == 1 ? "Admin" : "User" ?>
                                    </span>
                            </div>
                        </div>

                        <div class="form-element">
                            <label class="block text-sm font-medium text-red-700 mb-2">Foto Profil</label>
                            <div class="flex items-center space-x-4">
                                <img src="<?= PHOTOPROFILE . $data['user']['profile_picture'] ?>"
                                     alt="Profile Picture"
                                     class="w-16 h-16 rounded-full object-cover border-2 border-red-100">
                                <input type="file" name="profile_picture"
                                       class="input-modern flex-1 px-4 py-3 border-2 border-red-100 rounded-xl"
                                       accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-red-100">
                    <button type="button" onclick="window.history.back()"
                            class="px-6 py-2 text-red-600 hover:text-red-700 transition-all duration-200">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-6 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600
                                       transform hover:-translate-y-1 transition-all duration-300
                                       active:scale-95">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
<script>
    function edit(formSelector, successCallback, errorCallback) {
        const formElement = $(formSelector)[0];
        const formData = new FormData(formElement);

        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        $.ajax({
            url: '<?= BASEURL; ?>/User/edit',  // URL endpoint
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log('Raw Response:', data);
                try {
                    const parsedData = JSON.parse(data);
                    console.log('Parsed Response:', parsedData);
                    if (parsedData.status === 'success') {
                        if (typeof successCallback === 'function') {
                            successCallback(parsedData);
                        }
                    } else {
                        if (typeof errorCallback === 'function') {
                            errorCallback(parsedData);
                        } else {
                            alert(parsedData.message);
                        }
                    }
                } catch (error) {
                    console.error('Error parsing response:', error);
                    alert('Terjadi kesalahan saat memproses respons.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim data.');
            }
        });
    }

    $(document).ready(function () {
        $('#editUserForm').on('submit', function (event) {
            event.preventDefault();

            edit('#editUserForm',
                function onSuccess(parsedData) {
                    alert(parsedData.message);
                    console.log('New Profile Picture:', parsedData.profile_picture);
                    // Update gambar baru di UI
                    $('#profilePic').attr('src', '../app/img/profile/' + parsedData.profile_picture);
                    window.location.href = '<?= BASEURL; ?>/User';
                },
                function onError(parsedData) {
                    alert(parsedData.message);
                }
            );
        });
    });
</script>
</body>
</html>