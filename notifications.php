<?php

// 🔹 Enable error reporting (development only)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 🔹 Start session
session_start();

// 🔹 Database connection
require "config.php";

// 🔹 Check login
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// 🔹 Current user
$user_id = $_SESSION["user_id"];

/* =========================
   🔥 SESSION CONTROL (HIDE / CLEAR)
========================= */

// 🔹 Initialize hidden notifications
if (!isset($_SESSION["hidden_notifications"])) {
    $_SESSION["hidden_notifications"] = [];
}

// 🔹 Clear all notifications
if (isset($_POST["clear_all"])) {
    $_SESSION["hidden_notifications"] = [];
}

// 🔹 Hide one notification
if (isset($_POST["hide_one"])) {
    $_SESSION["hidden_notifications"][] = $_POST["id"];
}

/* =========================
   🔥 FETCH MATCHES (PER ITEM)
========================= */

$sql = "
SELECT 
    l.user_id AS lost_user,
    f.user_id AS found_user,

    l.item_name AS lost_item,
    f.item_name AS found_item,

    l.date_lost,
    f.date_found

FROM lost_items l
JOIN found_items f
ON l.category = f.category

WHERE l.user_id = '$user_id'
   OR f.user_id = '$user_id'

ORDER BY l.date_lost DESC
";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<title>Notifications - IFound MDX</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">

<style>

/* ================= NOTIFICATION UI ================= */

.notification-card {
    background: #ffffff;
    border-left: 4px solid #2E7D32;
    padding: 18px 20px;
    margin-bottom: 15px;
    border-radius: 10px;
    position: relative;
    box-shadow: 0 6px 15px rgba(0,0,0,0.05);
    transition: 0.2s;
}

.notification-card:hover {
    transform: translateY(-2px);
}

/* 🔹 Title */
.notification-card h4 {
    margin-bottom: 6px;
    font-size: 15px;
    color: #2E7D32;
}

/* 🔹 Message */
.notification-card p {
    font-size: 14px;
    color: #555;
    line-height: 1.5;
}

/* 🔹 Remove button */
.remove-form {
    position: absolute;
    top: 8px;
    right: 10px;
}

.remove-btn {
    background: transparent;
    border: none;
    font-size: 18px;
    color: #aaa;
    cursor: pointer;
}

.remove-btn:hover {
    color: #d32f2f;
}

/* 🔹 Clear button spacing */
.clear-btn {
    text-align: right;
    margin-bottom: 15px;
}

</style>

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
        <a href="notifications.php">Notifications</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<!-- 🔹 MAIN -->
<div class="hero">
    <div class="dashboard-card">

        <h2>Notifications</h2>

        <!-- 🔹 Clear all -->
        <form method="POST" class="clear-btn">
            <button name="clear_all" class="btn secondary">Clear All</button>
        </form>

        <!-- 🔹 Check matches -->
        <?php if ($result && mysqli_num_rows($result) > 0) { ?>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <?php
                // 🔹 Unique ID per notification
                $notification_id = md5($row["lost_item"] . $row["found_item"]);

                // 🔹 Skip hidden
                if (in_array($notification_id, $_SESSION["hidden_notifications"])) {
                    continue;
                }

                // 🔹 Message logic
                if ($row["lost_user"] == $user_id) {
                    $title = "Item Match Found";
                    $message = "Your item <strong>{$row['lost_item']}</strong> has a potential match. Please collect it from the University Help Desk.";
                } else {
                    $title = "Action Required";
                    $message = "You reported <strong>{$row['found_item']}</strong>. A match has been found. Please submit it to the University Help Desk.";
                }
                ?>

                <!-- 🔹 Notification -->
                <div class="notification-card">

                    <!-- ❌ Remove one -->
                    <form method="POST" class="remove-form">
                        <input type="hidden" name="id" value="<?php echo $notification_id; ?>">
                        <button name="hide_one" class="remove-btn">&times;</button>
                    </form>

                    <!-- 🔹 Content -->
                    <h4><?php echo $title; ?></h4>
                    <p><?php echo $message; ?></p>

                </div>

            <?php } ?>

        <?php } else { ?>

            <p>No notifications available.</p>

        <?php } ?>

    </div>
</div>

</body>
</html>