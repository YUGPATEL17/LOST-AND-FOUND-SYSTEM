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

                    <h3>🔴 Lost Item</h3>
                    <p><strong>Name:</strong> <?php echo $row["lost_item"]; ?></p>
                    <p><strong>Description:</strong> <?php echo $row["lost_desc"]; ?></p>
                    <p><strong>Location:</strong> <?php echo $row["location_lost"]; ?></p>
                    <p><strong>Date:</strong> <?php echo $row["date_lost"]; ?></p>

                    <hr>

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