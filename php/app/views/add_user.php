<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="/isFor-website/public/index.php?page=process_add_user" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br><br>

    <label for="role_id">Role:</label>
    <select name="role_id" required>
        <option value="1">Admin</option>
        <option value="2">User</option>
    </select><br><br>

    <button type="submit">Add User</button>
</form>

</body>
</html>
