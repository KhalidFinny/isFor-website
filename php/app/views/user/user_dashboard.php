<!-- Konten Dashboard Anda -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome to the Dashboard,<?= $_SESSION['username'] ?>!</h1>
    <button><a href="<?= BASEURL; ?>/login/logout">keluar</a></button>
</body>
</html>