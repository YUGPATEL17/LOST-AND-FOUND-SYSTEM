<?php

// 🔹 Enable error reporting (useful during development/debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 🔹 Start session to access logged-in user data
session_start();

// 🔹 Include database connection
require "config.php";

// 🔹 Check if user is logged in
// If not, redirect to login page (security)
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// 🔹 Variables to store messages
$success = "";
$error = "";

// 🔹 Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 🔹 Get current user ID from session
    $user_id = $_SESSION["user_id"];

    // 🔹 Get form input values
    $item_name = $_POST["item_name"];
    $category = $_POST["category"];
    $description = $_POST["description"];
    $location = $_POST["location"];
    $date_found = $_POST["date_found"];

    /* 🔹 SQL query to insert found item into database
       - user_id → who reported the item
       - status → set as 'open' (item not yet claimed)
    */
    $sql = "INSERT INTO found_items 
    (user_id, item_name, category, description, location_found, date_found, status) 
    VALUES 
    ('$user_id', '$item_name', '$category', '$description', '$location', '$date_found', 'open')";

    // 🔹 Execute query
    if (mysqli_query($conn, $sql)) {

        // 🔹 Success message if data inserted correctly
        $success = "Found item reported successfully!";

    } else {

        // 🔹 Error message if query fails
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<!-- 🔹 Character encoding -->
<meta charset="UTF-8">

<!-- 🔹 Page title -->
<title>Report Found - IFound MDX</title>

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
        <a href="dashboard.php">Dashboard</a>
        <a href="report_lost.php">Report Lost</a>
        <a href="report_found.php">Report Found</a>
        <a href="matches.php">Matches</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<!-- 🔹 MAIN FORM SECTION -->
<div class="hero">
    <div class="form-card">

        <h2>Report Found Item</h2>

        <!-- 🔹 Show success message -->
        <?php if ($success != "") { ?>
            <p class="success"><?php echo $success; ?></p>
        <?php } ?>

        <!-- 🔹 Show error message -->
        <?php if ($error != "") { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>

        <!-- 🔹 Form for submitting found item -->
        <form method="POST" class="form-spacing">

            <!-- 🔹 Item name -->
            <input type="text" name="item_name" placeholder="Item Name" required>

            <!-- 🔹 Category selection -->
            <select name="category" required>
                <option value="">Select Category</option>
                <option>Electronics</option>
                <option>Documents</option>
                <option>Accessories</option>
                <option>Other</option>
            </select>

            <!-- 🔹 Description -->
            <textarea name="description" placeholder="Description" required></textarea>

            <!-- 🔹 Location where item was found -->
            <input type="text" name="location" placeholder="Location Found (e.g., Library, MDX House)" required>

            <!-- 🔹 Date when item was found -->
            <input type="date" name="date_found" required>

            <!-- 🔹 Submit button -->
            <button type="submit" class="btn primary">Submit</button>

        </form>

    </div>
</div>

</body>
</html>