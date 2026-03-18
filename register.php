<?php
session_start();
require_once "config.php";

if(isset($_POST['register'])){

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (name,email,password)
VALUES ('$name','$email','$password')";

if($conn->query($sql)){
    echo "Registered Successfully. <a href='login.php'>Login here</a>";
}else{
    echo "Error: ".$conn->error;
}

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>

    <button name="register">Register</button>
</form>

</body>
</html>