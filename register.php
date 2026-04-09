<?php

// 🔹 Enable error reporting (useful during development/debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 🔹 Include database connection
require "config.php";

// 🔹 Variable to store error message
$message = "";

// 🔹 Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 🔹 Get user input from form
    $username = $_POST["username"];
    $email = $_POST["email"];

    // 🔹 Hash the password for security before storing in database
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    /* 🔹 SQL query to insert new user into database
       Stores name, email, and hashed password
    */
    $sql = "INSERT INTO users (name, email, password) 
            VALUES ('$username', '$email', '$password')";

    // 🔹 Execute query
    if (mysqli_query($conn, $sql)) {

        // 🔹 Redirect to login page with success message
        header("Location: login.php?success=1");
        exit();

    } else {

        // 🔹 If error occurs, store error message
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- 🔹 Character encoding -->
    <meta charset="UTF-8">

    <!-- 🔹 Page title -->
    <title>Register - IFound MDX</title>

    <!-- 🔹 Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- 🔹 External CSS -->
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

<!-- 🔹 NAVIGATION BAR -->
<div class="navbar">
    <div class="logo">IFound <span>MDX</span></div>

    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>
</div>

<!-- 🔹 REGISTRATION FORM SECTION -->
<div class="hero">
    <div class="form-card">

        <h2>Register</h2>

        <!-- 🔹 Display error message if any -->
        <?php if ($message != "") { ?>
            <p class="error"><?php echo $message; ?></p>
        <?php } ?>

        <!-- 🔹 Registration form -->
        <form method="POST">

            <!-- 🔹 Username input -->
            <input type="text" name="username" placeholder="Username" required>

            <!-- 🔹 Email input -->
            <input type="email" name="email" placeholder="Email" required>

            <!-- 🔹 Password input -->
            <input type="password" name="password" placeholder="Password" required>

            <!-- 🔹 Submit button -->
            <button type="submit" class="btn primary">Register</button>
        </form>

        <!-- 🔹 Redirect to login page -->
        <p class="switch">
            Already have an account? <a href="login.php">Login</a>
        </p>

    </div>
</div>

</body>
</html>