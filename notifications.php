<?php

// 🔹 Enable error reporting (useful during development/debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 🔹 Start session to access logged-in user data
session_start();

// 🔹 Include database connection
require "config.php";

// 🔹 Check if user is logged in
// If not, redirect to login page for security
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// 🔹 Store current user's ID
$user_id = $_SESSION["user_id"];

/* 🔹 NOTIFICATION QUERY
   This query counts how many potential matches exist
   for the logged-in user
*/
$sql = "
SELECT COUNT(*) as total
FROM lost_items l
JOIN found_items f
ON l.category = f.category   -- basic matching condition

/* 🔹 Filter:
   Only matches related to current user
*/
WHERE l.user_id = '$user_id'
   OR f.user_id = '$user_id'
";

// 🔹 Execute query
$result = mysqli_query($conn, $sql);

// 🔹 Fetch result
$row = mysqli_fetch_assoc($result);

// 🔹 Store total number of matches (used as notification count)
$total = $row["total"];
?>

<!DOCTYPE html>
<html lang="en">
<head>

<!-- 🔹 Character encoding -->
<meta charset="UTF-8">

<!-- 🔹 Page title -->
<title>Notifications - IFound MDX</title>

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
        <a href="notifications.php">Notifications</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<!-- 🔹 MAIN NOTIFICATION SECTION -->
<div class="hero">
    <div class="form-card">

        <!-- 🔹 Section heading -->
        <h2>Notifications 🔔</h2>

        <!-- 🔹 Display number of possible matches -->
        <p>You have <strong><?php echo $total; ?></strong> possible matches.</p>

        <!-- 🔹 Button to view detailed matches -->
        <a href="matches.php" class="btn primary">View Matches</a>

    </div>
</div>

</body>
</html>