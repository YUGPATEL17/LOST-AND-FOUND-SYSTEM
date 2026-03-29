<?php
session_start();
require_once "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome <?php echo $username; ?></h2>

<hr>

<h3>🔔 Notifications</h3>

<?php
$result = $conn->query("SELECT DISTINCT message FROM notifications 
                        WHERE user_id='$user_id' 
                        ORDER BY notification_id DESC");

if($result && $result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<p>• " . $row['message'] . "</p>";
    }
} else {
    echo "<p>No new notifications</p>";
}
?>

<hr>

<h3>📌 Actions</h3>

<p><a href="report_lost.php">👉 Report Lost Item</a></p>
<p><a href="report_found.php">👉 Report Found Item</a></p>
<p><a href="matches.php">👉 View Matches</a></p>

<hr>

<p><a href="logout.php">Logout</a></p>

</body>
</html>