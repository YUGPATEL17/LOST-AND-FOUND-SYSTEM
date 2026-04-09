<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$sql = "
SELECT COUNT(*) as total
FROM lost_items l
JOIN found_items f
ON l.category = f.category
WHERE l.user_id = '$user_id'
   OR f.user_id = '$user_id'
";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total = $row["total"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Notifications - IFound MDX</title>

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
    <div class="form-card">

        <h2>Notifications 🔔</h2>

        <p>You have <strong><?php echo $total; ?></strong> possible matches.</p>

        <a href="matches.php" class="btn primary">View Matches</a>

    </div>
</div>

</body>
</html>