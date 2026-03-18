<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome <?php echo $_SESSION['name']; ?></h2>

<br>

<a href="report_lost.php">Report Lost Item</a><br><br>
<a href="report_found.php">Report Found Item</a><br><br>

<a href="logout.php">Logout</a>

</body>
</html>