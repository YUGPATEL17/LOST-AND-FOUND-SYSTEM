<?php
session_start();
require_once "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

// SHOW ERRORS (VERY IMPORTANT FOR DEBUG)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Report Found Item</title>
</head>
<body>

<h2>Report Found Item</h2>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $user_id = $_SESSION['user_id'];
    $item_name = $_POST['item_name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $location_found = $_POST['location_found'];
    $date_found = $_POST['date_found'];

    $sql = "INSERT INTO found_items 
            (user_id, item_name, category, description, location_found, date_found, status)
            VALUES 
            ('$user_id', '$item_name', '$category', '$description', '$location_found', '$date_found', 'open')";

    if($conn->query($sql) === TRUE){
        echo "<p style='color:green;'>✅ Found item reported successfully!</p>";
    } else {
        echo "<p style='color:red;'>❌ Error: ".$conn->error."</p>";
    }
}
?>

<!-- ✅ FORM MUST BE HERE -->
<form method="POST">

    Item Name:
    <input type="text" name="item_name" required><br><br>

    Category:
    <select name="category">
        <option>Electronics</option>
        <option>Clothing</option>
        <option>Documents</option>
        <option>Others</option>
    </select><br><br>

    Description:<br>
    <textarea name="description"></textarea><br><br>

    Location Found:
    <input type="text" name="location_found"><br><br>

    Date Found:
    <input type="date" name="date_found"><br><br>

    <button type="submit">Submit</button>

</form>

<br>
<a href="dashboard.php">⬅ Back to Dashboard</a>

</body>
</html>Thank you. 