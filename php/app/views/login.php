<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet">
<link rel="stylesheet" href="/Css/logincss.css">
<body>
<div class="login-container">
    <div class="header">
        <img src="Images/polinema_logo 2.png" alt="logo" class="logo">
        <div class="organization-name">Pusat Riset<br>Informatika</div>
    </div>
    <h2>User Login</h2>
    <form action="../../public/index.php?page=login" method="POST" class="login-form">
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

