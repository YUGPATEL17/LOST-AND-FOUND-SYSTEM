<?php

// 🔹 Enable error reporting (useful during development/debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 🔹 Start session to store user login data
session_start();

// 🔹 Include database connection
require "config.php";

// 🔹 Variables to store messages
$error = "";
$success = "";

// 🔹 Check if redirected from registration page
// Used to show success message after registration
if (isset($_GET["success"])) {
    $success = "Registration successful! Please login.";
}

// 🔹 Check if form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 🔹 Get user input from form
    $email = $_POST["username"]; // using email as username
    $password = $_POST["password"];

    // 🔹 Query database to find user by email
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    // 🔹 Check if user exists
    if ($result && mysqli_num_rows($result) > 0) {

        // 🔹 Fetch user data
        $row = mysqli_fetch_assoc($result);

        // 🔹 Verify entered password with hashed password in database
        if (password_verify($password, $row["password"])) {

            // 🔹 Store user ID in session (used for authentication across pages)
            $_SESSION["user_id"] = $row["user_id"];

            // 🔹 Redirect to dashboard after successful login
            header("Location: dashboard.php");
            exit();

        } else {
            // 🔹 If password is incorrect
            $error = "Invalid password!";
        }

    } else {
        // 🔹 If user email not found in database
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- 🔹 Character encoding -->
    <meta charset="UTF-8">

    <!-- 🔹 Page title -->
    <title>Login - IFound MDX</title>

    <!-- 🔹 Google Font for styling -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- 🔹 External CSS -->
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

<!-- 🔹 NAVBAR -->
<div class="navbar">
    <div class="logo">IFound <span>MDX</span></div>

    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>
</div>

<!-- 🔹 LOGIN FORM SECTION -->
<div class="hero">
    <div class="form-card">

        <h2>Login</h2>

        <!-- 🔹 Show success message (after registration) -->
        <?php if ($success != "") { ?>
            <p class="success"><?php echo $success; ?></p>
        <?php } ?>

        <!-- 🔹 Show error message -->
        <?php if ($error != "") { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>

        <!-- 🔹 Login form -->
        <form method="POST">

            <!-- 🔹 Email input -->
            <input type="text" name="username" placeholder="Email" required>

            <!-- 🔹 Password input -->
            <input type="password" name="password" placeholder="Password" required>

            <!-- 🔹 Submit button -->
            <button type="submit" class="btn primary">Login</button>
        </form>

        <!-- 🔹 Redirect to register page -->
        <p class="switch">
            Don’t have an account? <a href="register.php">Register</a>
        </p>

    </div>
</div>

</body>
</html>