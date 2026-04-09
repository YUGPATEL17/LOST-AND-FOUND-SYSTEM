<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require "config.php";

$error = "";
$success = "";

if (isset($_GET["success"])) {
    $success = "Registration successful! Please login.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["username"]; // using email
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {

            $_SESSION["user_id"] = $row["user_id"];

            header("Location: dashboard.php");
            exit();

        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - IFound MDX</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

<div class="navbar">
    <div class="logo">IFound <span>MDX</span></div>

    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>
</div>

<div class="hero">
    <div class="form-card">

        <h2>Login</h2>

        <?php if ($success != "") { ?>
            <p class="success"><?php echo $success; ?></p>
        <?php } ?>

        <?php if ($error != "") { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" class="btn primary">Login</button>
        </form>

        <p class="switch">
            Don’t have an account? <a href="register.php">Register</a>
        </p>

    </div>
</div>

</body>
</html>