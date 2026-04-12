<?php

// 🔹 Enable error reporting (useful during development/debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 🔹 Start session to access logged-in user data
session_start();

// 🔹 Include database connection
require "config.php";

// 🔹 Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// 🔹 Store current user's ID
$user_id = $_SESSION["user_id"];

/* 🔹 MATCH QUERY
   Joins lost_items and found_items based on category
*/
$sql = "
SELECT 
    l.user_id AS lost_user,
    f.user_id AS found_user,

    l.item_name AS lost_item,
    l.description AS lost_desc,
    l.location_lost,
    l.date_lost,

    f.item_name AS found_item,
    f.description AS found_desc,
    f.location_found,
    f.date_found

FROM lost_items l
JOIN found_items f
ON l.category = f.category

WHERE l.user_id = '$user_id'
   OR f.user_id = '$user_id'

ORDER BY l.date_lost DESC
";

// 🔹 Execute query
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Matches - IFound MDX</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
</head>

<body>

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

<div class="hero">
    <div class="dashboard-card">

        <h2>Possible Matches 🔍</h2>

        <?php if ($result && mysqli_num_rows($result) > 0) { ?>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <div class="match-card">

                    <!-- 🔔 SMART NOTIFICATION LOGIC -->
                    <?php
                    /* 🔹 PERSONALIZED MESSAGE
                       - If current user lost item → collect from help desk
                       - If current user found item → submit to help desk
                    */
                    if ($row["lost_user"] == $user_id) {
                        $message = "🎉 Your lost item may be found! Please collect it from the University Help Desk.";
                    } else {
                        $message = "📢 A match is found! Please submit the item to the University Help Desk.";
                    }
                    ?>

                    <!-- 🔹 Display message -->
                    <div class="notification-box">
                        <?php echo $message; ?>
                    </div>

                    <!-- 🔴 LOST ITEM -->
                    <h3>🔴 Lost Item</h3>
                    <p><strong>Name:</strong> <?php echo $row["lost_item"]; ?></p>
                    <p><strong>Description:</strong> <?php echo $row["lost_desc"]; ?></p>
                    <p><strong>Location:</strong> <?php echo $row["location_lost"]; ?></p>
                    <p><strong>Date:</strong> <?php echo $row["date_lost"]; ?></p>

                    <hr>

                    <!-- 🟢 FOUND ITEM -->
                    <h3>🟢 Found Item</h3>
                    <p><strong>Name:</strong> <?php echo $row["found_item"]; ?></p>
                    <p><strong>Description:</strong> <?php echo $row["found_desc"]; ?></p>
                    <p><strong>Location:</strong> <?php echo $row["location_found"]; ?></p>
                    <p><strong>Date:</strong> <?php echo $row["date_found"]; ?></p>

                </div>

            <?php } ?>

        <?php } else { ?>

            <p>No matches found yet.</p>

        <?php } ?>

    </div>
</div>

</body>
</html>