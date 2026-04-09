<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION["user_id"];
    $item_name = $_POST["item_name"];
    $category = $_POST["category"];
    $description = $_POST["description"];
    $location = $_POST["location"];
    $date_lost = $_POST["date_lost"];

    $sql = "INSERT INTO lost_items 
    (user_id, item_name, category, description, location_lost, date_lost, status) 
    VALUES 
    ('$user_id', '$item_name', '$category', '$description', '$location', '$date_lost', 'open')";

    if (mysqli_query($conn, $sql)) {
        $success = "Lost item reported successfully!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Report Lost - IFound MDX</title>

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
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="hero">
    <div class="form-card">

        <h2>Report Lost Item</h2>

        <?php if ($success != "") { ?>
            <p class="success"><?php echo $success; ?></p>
        <?php } ?>

        <?php if ($error != "") { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>

        <form method="POST" class="form-spacing">

            <input type="text" name="item_name" placeholder="Item Name" required>

            <select name="category" required>
                <option value="">Select Category</option>
                <option>Electronics</option>
                <option>Documents</option>
                <option>Accessories</option>
                <option>Other</option>
            </select>

            <textarea name="description" placeholder="Description" required></textarea>

            <input type="text" name="location" placeholder="Location (e.g., Library, MDX House)" required>

            <input type="date" name="date_lost" required>

            <button type="submit" class="btn primary">Submit</button>

        </form>

    </div>
</div>

</body>
</html>