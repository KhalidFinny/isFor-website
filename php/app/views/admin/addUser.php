<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="/Css/register.css">
</head>
<body>
<div class="login-container">
    <div class="header">
        <img src="Images/polinema_logo 2.png" alt="logo" class="logo">
        <div class="organization-name">Pusat Riset<br>Informatika</div>
    </div>
    <h2>User Register</h2><br>
    <a href="<?= BASEURL ?>/dashboardAdmin">dashboardAdmin</a><br><br>
    <form action="<?= BASEURL; ?>/addUser/register" method="POST">
        <div class="form-row">
            <div class="form-group form-group-half">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-input" required placeholder="Username">
            </div>
            <div class="form-group form-group-half">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-input" required placeholder="Email">
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-input" required placeholder="Password">
        </div>

        <div class="form-group">
            <label for="confirm_password" class="form-label">Confirm password</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-input" required
                placeholder="Confirm password">
        </div>

        <div class="form-group">
            <label for="role">Pilih role user: </label>

            <select name="role" id="role">
                <option value="1">admin</option>
                <option value="2">user</option>
            </select>
        </div>


        <button type="submit" class="submit-btn">Register</button>
    </form>

</div>
</body>
</html>
