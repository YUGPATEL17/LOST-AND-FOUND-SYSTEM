<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "config.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) 
            VALUES ('$username', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        header("Location: login.php?success=1");
        exit();
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - IFound MDX</title>

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

        <h2>Register</h2>

        <?php if ($message != "") { ?>
            <p class="error"><?php echo $message; ?></p>
        <?php } ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" class="btn primary">Register</button>
        </form>

        <p class="switch">
            Already have an account? <a href="login.php">Login</a>
        </p>

    </div>
</div>

</body>
</html>