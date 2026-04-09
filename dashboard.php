<?php

// 🔹 Show all PHP errors (useful during development/debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 🔹 Start session to access logged-in user data
session_start();

// 🔹 Include database connection file
require "config.php";

// 🔹 Check if user is logged in
// If not, redirect to login page for security
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// 🔹 Store logged-in user's ID
$user_id = $_SESSION["user_id"];

/* 🔹 GET MATCH COUNT
   This query counts how many potential matches exist
   for the current user (either lost or found items)
*/
$sql = "
SELECT COUNT(*) as total
FROM lost_items l
JOIN found_items f
ON l.category = f.category
WHERE l.user_id = '$user_id'
   OR f.user_id = '$user_id'
";

// 🔹 Execute query
$result = mysqli_query($conn, $sql);

// 🔹 Fetch result as associative array
$row = mysqli_fetch_assoc($result);

// 🔹 Store total matches count
$total_matches = $row["total"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<!-- 🔹 Page title -->
<title>Dashboard - IFound MDX</title>

<!-- 🔹 Google font for better UI -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<!-- 🔹 External CSS file -->
<link rel="stylesheet" href="assets/style.css">
</head>

<body>

<!-- 🔹 NAVIGATION BAR -->
<div class="navbar">

    <!-- 🔹 Logo / branding -->
    <div class="logo">IFound <span>MDX</span></div>

    <!-- 🔹 Navigation links for user actions -->
    <div class="nav-links">
        <a href="dashboard.php">Dashboard</a>
        <a href="report_lost.php">Report Lost</a>
        <a href="report_found.php">Report Found</a>
        <a href="matches.php">Matches</a>
        <a href="notifications.php">Notifications</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<!-- 🔹 MAIN DASHBOARD CONTENT -->
<div class="hero">
    <div class="form-card">

        <!-- 🔹 Welcome message -->
        <h2>Welcome to Dashboard 👋</h2>
        <p>Manage your lost and found items easily.</p>

        <!-- 🔔 NOTIFICATION SECTION -->
        <?php if ($total_matches > 0) { ?>

            <!-- 🔹 Show notification only if matches exist -->
            <div class="notification-box">

                <!-- 🔹 Display dynamic match count -->
                🔔 You have <strong><?php echo $total_matches; ?></strong> possible matches!

                <br><br>

                <!-- 🔹 Button to view matches -->
                <a href="matches.php" class="btn primary">View Matches</a>
            </div>

        <?php } ?>

        <br>

        <!-- 🔹 Action buttons for user -->
        <a href="report_lost.php" class="btn primary">Report Lost Item</a>

        <a href="report_found.php" class="btn secondary">Report Found Item</a>

        <a href="matches.php" class="btn primary">View Matches</a>

    </div>
</div>

</body>
</html>