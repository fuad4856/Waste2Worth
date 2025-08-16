<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "project"); // Change username/password if needed

if (isset($_POST['register'])) {
    $username = $mysqli->real_escape_string($_POST['username']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $mysqli->query("INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')");
    echo "<p>Registration successful. You can now <a href='login.php'>log in</a>.</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
<h2>Register</h2>
<form method="post">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button type="submit" name="register">Register</button>
</form>
<a href="login.php">Login</a>
</body>
</html>
