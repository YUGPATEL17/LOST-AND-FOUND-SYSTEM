<?php

// 🔹 Enable error reporting (for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 🔹 Start session (to get logged-in user)
session_start();

// 🔹 Include database connection
require "config.php";

// 🔹 Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// 🔹 Message variables
$success = "";
$error = "";

// 🔹 When form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 🔹 Get user ID
    $user_id = $_SESSION["user_id"];

    // 🔹 Get form data
    $item_name = $_POST["item_name"];
    $category = $_POST["category"];
    $description = $_POST["description"];
    $location = $_POST["location"];
    $date_found = $_POST["date_found"];

    // =========================
    // 🔥 FIXED IMAGE UPLOAD LOGIC
    // =========================

    // 🔹 Default empty image
    $folder = "";

    // 🔹 Only run if image uploaded
    if (!empty($_FILES["image"]["name"])) {

        $image_name = $_FILES["image"]["name"];
        $tmp_name = $_FILES["image"]["tmp_name"];

        // 🔹 Allowed file types
        $allowed_types = ["jpg", "jpeg", "png"];

        // 🔹 Get file extension
        $file_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        // 🔹 Validate file type
        if (!in_array($file_ext, $allowed_types)) {

            $error = "Only JPG, JPEG, PNG files are allowed!";

        } else {

            // 🔹 Create unique file name
            $folder = "uploads/" . time() . "_" . $image_name;

            // 🔹 Move file safely
            if (!move_uploaded_file($tmp_name, $folder)) {
                $error = "Image upload failed!";
            }
        }
    }

    // 🔹 Insert into DB ONLY if no error
    if ($error == "") {

        $sql = "INSERT INTO found_items 
        (user_id, item_name, category, description, location_found, date_found, status, image) 
        VALUES 
        ('$user_id', '$item_name', '$category', '$description', '$location', '$date_found', 'open', '$folder')";

        // 🔹 Execute query
        if (mysqli_query($conn, $sql)) {
            $success = "Found item reported successfully!";
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Report Found - IFound MDX</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
</head>

<body>

<!-- 🔹 NAVBAR -->
<div class="navbar">
    <div class="logo">IFound <span>MDX</span></div>
    <div class="nav-links">
        <a href="dashboard.php">Dashboard</a>
        <a href="report_lost.php">Report Lost</a>
        <a href="report_found.php">Report Found</a>
        <a href="matches.php">Matches</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<!-- 🔹 FORM -->
<div class="hero">
    <div class="form-card">

        <h2>Report Found Item</h2>

        <!-- 🔹 Success Message -->
        <?php if ($success != "") { ?>
            <p class="success"><?php echo $success; ?></p>
        <?php } ?>

        <!-- 🔹 Error Message -->
        <?php if ($error != "") { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>

        <!-- 🔥 enctype IMPORTANT for file upload -->
        <form method="POST" enctype="multipart/form-data" class="form-spacing">

            <input type="text" name="item_name" placeholder="Item Name" required>

            <select name="category" required>
                <option value="">Select Category</option>
                <option>Electronics</option>
                <option>Documents</option>
                <option>Accessories</option>
                <option>Other</option>
            </select>

            <textarea name="description" placeholder="Description" required></textarea>

            <input type="text" name="location" placeholder="Location Found" required>

            <input type="date" name="date_found" required>

            <!-- 🔥 IMAGE INPUT (NOW OPTIONAL) -->
            <input type="file" name="image">

            <button type="submit" class="btn primary">Submit</button>

        </form>

    </div>
</div>

</body>
</html>