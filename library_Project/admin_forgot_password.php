 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Reset Password</title>
</head>
<body>
    <h3>Reset Admin Password</h3>
    <form action="reset_password_server.php" method="post">
        <input type="hidden" name="role" value="admin" />
        <label for="email">Admin Email</label><br />
        <input type="email" id="email" name="email" required /><br />
        <label for="newpass">New Password</label><br />
        <input type="password" id="newpass" name="newpass" required minlength="6" /><br />
        <button type="submit">Reset Password</button>
    </form>
    <p><a href="admin-login.php">Back to Admin Login</a></p>
</body>
</html> 
 
