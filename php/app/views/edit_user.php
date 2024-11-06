<h1>Edit User</h1>
<form method="POST" action="/isFor-website/public/index.php?page=update_user">
    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>">
    <label>Username:</label>
    <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>"><br>
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"><br>
    <label>Role:</label>
    <select name="role_id">
        <option value="1" <?php echo $user['role_id'] == 1 ? 'selected' : ''; ?>>Admin</option>
        <option value="2" <?php echo $user['role_id'] == 2 ? 'selected' : ''; ?>>User</option>
    </select><br>
    <input type="submit" value="Update">
</form>
