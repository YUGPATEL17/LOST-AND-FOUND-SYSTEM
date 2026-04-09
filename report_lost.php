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

// 🔹 Variables to store success/error messages
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
    $date_lost = $_POST["date_lost"];

    /* 🔹 SQL query to insert lost item into database
       - user_id → identifies who reported the item
       - location_lost → where item was lost
       - status → set to 'open' (not yet resolved)
    */
    $sql = "INSERT INTO lost_items 
    (user_id, item_name, category, description, location_lost, date_lost, status) 
    VALUES 
    ('$user_id', '$item_name', '$category', '$description', '$location', '$date_lost', 'open')";

    // 🔹 Execute query
    if (mysqli_query($conn, $sql)) {

        // 🔹 Success message if insertion is successful
        $success = "Lost item reported successfully!";

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
<title>Report Lost - IFound MDX</title>

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

        <h2>Report Lost Item</h2>

        <!-- 🔹 Display success message -->
        <?php if ($success != "") { ?>
            <p class="success"><?php echo $success; ?></p>
        <?php } ?>

        <!-- 🔹 Display error message -->
        <?php if ($error != "") { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>

        <!-- 🔹 Form for reporting lost item -->
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

            <!-- 🔹 Location where item was lost -->
            <input type="text" name="location" placeholder="Location (e.g., Library, MDX House)" required>

            <!-- 🔹 Date when item was lost -->
            <input type="date" name="date_lost" required>

            <!-- 🔹 Submit button -->
            <button type="submit" class="btn primary">Submit</button>

        </form>

    </div>
</div>

</body>
</html>