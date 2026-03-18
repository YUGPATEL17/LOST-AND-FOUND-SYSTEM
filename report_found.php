<?php
session_start();
require_once "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['submit'])){

$user_id = $_SESSION['user_id'];
$item_name = $_POST['item_name'];
$category = $_POST['category'];
$description = $_POST['description'];
$location = $_POST['location'];
$date = $_POST['date'];

$sql = "INSERT INTO found_items (user_id, item_name, category, description, location_found, date_found)
VALUES ('$user_id','$item_name','$category','$description','$location','$date')";

if($conn->query($sql)){
    echo "Found item reported successfully!";
}else{
    echo "Error: ".$conn->error;
}

}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Report Found Item</h2>

<form method="POST">

Item Name: <input type="text" name="item_name" required><br><br>

Category:
<select name="category">
    <option>Electronics</option>
    <option>Wallet</option>
    <option>Keys</option>
    <option>Documents</option>
    <option>Other</option>
</select><br><br>

Description:<br>
<textarea name="description"></textarea><br><br>

Location Found: <input type="text" name="location"><br><br>

Date Found: <input type="date" name="date"><br><br>

<button name="submit">Submit</button>

</form>

</body>
</html>