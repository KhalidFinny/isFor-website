<?php 

var_dump($data['user']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit User</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Css/register.css">
</head>
<body>
<div class="login-container">
    <div class="header">
        <img src="Images/polinema_logo 2.png" alt="logo" class="logo">
        <div class="organization-name">Pusat Riset<br>Informatika</div>
    </div>
    <h2>Edit User</h2><br>
    <a href="<?= BASEURL ?>/dashboardAdmin">dashboardAdmin</a><br><br>
    <form action="<?= BASEURL; ?>/User/edit" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="<?= $data['user']['user_id'] ?>">
        <input type="hidden" name="role_id" value="<?= $data['user']['role_id'] ?>">
        <input type="hidden" name="oldImage" value="<?= $data['user']['profile_picture'] ?>">
        <input type="hidden" name="oldPass" value="<?= $data['user']['password'] ?>">
        <div class="form-row">
            <div class="form-group form-group-half">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-input" placeholder="Username" value="<?= $data['user']['username'] ?>">
            </div>
            <div class="form-group form-group-half">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-input" placeholder="Email" value="<?= $data['user']['email'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-input"  placeholder="Add New Password" >
        </div>

        <p>role user saat ini : 
            <?php 
                if ($data['user']['role_id'] == 1){
                    echo "admin";
                }else{
                    echo "user";
                }
            ?>
        </p>

        <div class="form-group">
            <label for="profile_picture">Upload profile picture:</label>
            <img src="<?= PHOTOPROFILE .  $data['user']['profile_picture'] ?>" alt="" width="100px">
            <input type="file" name="profile_picture" id="profile_picture" >
        </div>

        <button type="submit" class="submit-btn">Register</button>
    </form>



</div>
</body>
</html>
