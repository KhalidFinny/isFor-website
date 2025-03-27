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
    <link rel="stylesheet" href="<?= CSS; ?>/admin/edit-user.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Mobile responsive adjustments */
        @media (max-width: 768px) {
            .page-container {
                margin-left: 0 !important;
            }
            
            .main-content {
                padding: 1rem;
            }
            
            .form-header h1 {
                font-size: 2rem;
            }
            
            .modern-card {
                padding: 1rem;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .form-element input, 
            .form-element select, 
            .form-element textarea {
                padding: 0.75rem;
            }
            
            .form-actions {
                flex-direction: column-reverse;
                gap: 0.5rem;
            }
            
            .form-actions button {
                width: 100%;
                padding: 0.75rem;
            }
            
            .profile-picture-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }
        
        /* Desktop styles */
        @media (min-width: 769px) {
            .page-container {
                margin-left: 16rem;
            }
        }
    </style>
</head>
<body class="bg-white">
<?php include_once '../app/views/assets/components/AdminDashboard/sidebar.php'; ?>

<div class="flex-1 min-h-screen page-container">
    <main class="main-content py-6 md:py-10 px-4 md:px-8">
        <!-- Header with Red Accent -->
        <div class="max-w-7xl mx-auto mb-8 md:mb-12 form-element">
            <div class="flex items-center space-x-4 mb-4">
                <span class="h-px w-12 bg-red-600"></span>
                <span class="text-red-600 font-medium">Manajemen</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-bold text-red-900 mb-2">Edit Pengguna</h1>
            <p class="text-gray-600 mt-2 max-w-lg">Perbarui informasi pengguna dengan mengisi formulir di bawah ini</p>

            <!-- Back Button with Animation -->
            <a href="<?= BASEURL; ?>/dashboardAdmin"
               class="back-button mt-4 md:mt-6 inline-flex items-center space-x-2 text-red-600 hover:text-red-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali ke Dashboard</span>
            </a>
        </div>

        <!-- Modern Card with Red Accents -->
        <div class="modern-card bg-white rounded-xl md:rounded-2xl shadow-sm max-w-4xl mx-auto border border-red-100">
            <div class="p-4 md:p-8 border-b border-red-100">
                <h2 class="text-xl md:text-2xl font-light text-red-500">Formulir Edit Pengguna</h2>
            </div>

            <form id="editUserForm" action="<?= BASEURL; ?>/User/edit" method="POST" class="p-4 md:p-8"
                  enctype="multipart/form-data">
                <!-- Hidden inputs -->
                <input type="hidden" name="user_id" value="<?= $data['user']['user_id'] ?>">
                <input type="hidden" name="role_id" value="<?= $data['user']['role_id'] ?>">
                <input type="hidden" name="oldImage" value="<?= $data['user']['profile_picture'] ?>">
                <input type="hidden" name="oldPass" value="<?= $data['user']['password'] ?>">

                <div class="form-grid grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
                    <!-- Left Column -->
                    <div class="space-y-4 md:space-y-6">
                        <div class="form-element">
                            <label class="block text-sm font-medium text-red-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="<?= $data['user']['name'] ?>" required
                                   class="input-modern w-full px-3 py-2 md:px-4 md:py-3 border-2 border-red-100 rounded-lg md:rounded-xl">
                        </div>

                        <div class="form-element">
                            <label class="block text-sm font-medium text-red-700 mb-2">Username</label>
                            <input type="text" name="username" value="<?= $data['user']['username'] ?>" required
                                   class="input-modern w-full px-3 py-2 md:px-4 md:py-3 border-2 border-red-100 rounded-lg md:rounded-xl">
                        </div>

                        <div class="form-element">
                            <label class="block text-sm font-medium text-red-700 mb-2">Email</label>
                            <input type="email" name="email" value="<?= $data['user']['email'] ?>" required
                                   class="input-modern w-full px-3 py-2 md:px-4 md:py-3 border-2 border-red-100 rounded-lg md:rounded-xl">
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4 md:space-y-6">
                        <div class="form-element">
                            <label class="block text-sm font-medium text-red-700 mb-2">Password Baru</label>
                            <input type="password" name="password"
                                   class="input-modern w-full px-3 py-2 md:px-4 md:py-3 border-2 border-red-100 rounded-lg md:rounded-xl"
                                   placeholder="Kosongkan jika tidak ingin mengubah">
                        </div>

                        <div class="form-element">
                            <label class="block text-sm font-medium text-red-700 mb-2">Role Saat Ini</label>
                            <div class="px-3 py-2 md:px-4 md:py-3 bg-red-50 rounded-lg md:rounded-xl border-2 border-red-100">
                                    <span class="inline-flex items-center px-2 py-0.5 md:px-3 md:py-1 rounded-full text-xs md:text-sm font-medium 
                                               <?= $data['user']['role_id'] == 1 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' ?>">
                                        <?= $data['user']['role_id'] == 1 ? "Admin" : "User" ?>
                                    </span>
                            </div>
                        </div>

                        <div class="form-element">
                            <label class="block text-sm font-medium text-red-700 mb-2">Foto Profil</label>
                            <div class="profile-picture-container flex items-center space-x-2 md:space-x-4">
                                <?php if (isset($data['user']['profile_picture']) && $data['user']['profile_picture'] != null): ?>
                                    <img src="<?= PHOTOPROFILE . $data['user']['profile_picture'] ?>"
                                         alt="Profile Picture"
                                         class="w-12 h-12 md:w-16 md:h-16 rounded-full object-cover border-2 border-red-100">
                                <?php else: ?>
                                    <div class="flex-shrink-0 h-12 w-12 md:h-16 md:w-16 rounded-full overflow-hidden bg-red-50">
                                        <svg class="h-full w-full object-cover rounded-full"
                                             viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                    d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 6C13.66 6 15 7.34 15 9C15 10.66 13.66 12 12 12C10.34 12 9 10.66 9 9C9 7.34 10.34 6 12 6ZM12 20.2C9.5 20.2 7.29 18.92 6 16.98C6.03 14.99 10 13.9 12 13.9C13.99 13.9 17.97 14.99 18 16.98C16.71 18.92 14.5 20.2 12 20.2Z"
                                                    fill="#ef4444"/>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <input type="file" name="profile_picture"
                                       class="input-modern flex-1 px-3 py-2 md:px-4 md:py-3 border-2 border-red-100 rounded-lg md:rounded-xl"
                                       accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions flex flex-col-reverse md:flex-row justify-end gap-2 md:space-x-4 mt-6 md:mt-8 pt-4 md:pt-6 border-t border-red-100">
                    <button type="button" onclick="window.history.back()"
                            class="px-4 py-2 md:px-6 md:py-2 text-red-600 hover:text-red-700 transition-all duration-200">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 md:px-6 md:py-2 bg-red-500 text-white rounded-lg md:rounded-xl hover:bg-red-600
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