<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h2>Register</h2>
<form method="post" action="register_handler.php">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" value="Register">
</form>
<a href="login.php">Already have an account? Login here</a>
</div>
</body>
</html>