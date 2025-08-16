<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "project"); // Change username/password if needed

if (isset($_POST['login'])) {
    $username = $mysqli->real_escape_string($_POST['username']);
    $result = $mysqli->query("SELECT * FROM users WHERE username='$username'");
    if (!$result) {
        echo "<p>Query error: " . $mysqli->error . "</p>";
    } else if ($row = $result->fetch_assoc()) {
        // If passwords are stored as plain text, use direct comparison
        if ($_POST['password'] === $row['password']) {
            $_SESSION['user'] = $row;
            header("Location: profile.php");
            exit;
        } else {
            echo "<p>Invalid password.</p>";
        }
    } else {
        echo "<p>User not found.</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<form method="post">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button type="submit" name="login">Login</button>
</form>
<a href="register.php">Register</a>
</body>
</html>
