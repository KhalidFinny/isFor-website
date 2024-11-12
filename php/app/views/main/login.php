<?php 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="login-container">
    <div class="header">
        <img src="Images/polinema_logo 2.png" alt="logo" class="logo">
        <div class="organization-name">Pusat Riset<br>Informatika</div>
    </div>
    <h2>User Login</h2>
    <a href="<?= BASEURL ?>">klik disini untuk kembali ke halaman home</a><br><br>
    <form action="<?= BASEURL; ?>/login/authentication" method="POST" class="login-form">
        <div class="form-group">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-input" required
                   placeholder="Enter your username">
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-input" required
                   placeholder="Enter your password">
            <div class="forgot-password">
                <a href="#">Forgot Password?</a>
            </div>
        </div>
        <button type="submit" class="submit-btn">Login</button>
    </form>
</div>
</body>
</html>
