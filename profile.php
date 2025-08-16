<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "project"); // Change username/password if needed

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['update'])) {
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $_SESSION['user']['password'];
    $id = $_SESSION['user']['id'];
    $mysqli->query("UPDATE users SET email='$email', password='$password' WHERE id=$id");
    $_SESSION['user']['email'] = $email;
    $_SESSION['user']['password'] = $password;
    echo "<p>Profile updated.</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>
<h2>Profile</h2>
<h3>Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?>!</h3>
<form method="post">
    <label>Email: <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user']['email']); ?>" required></label><br>
    <label>New Password: <input type="password" name="password"></label><br>
    <button type="submit" name="update">Update Profile</button>
</form>
<br>
<a href="logout.php">Logout</a>
</body>
</html>
