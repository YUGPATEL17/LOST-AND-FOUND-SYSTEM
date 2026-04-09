<?php

// 🔹 Database server address (localhost / XAMPP uses 127.0.0.1)
$host = "127.0.0.1";

// 🔹 Default MySQL username in XAMPP
$user = "root";

// 🔹 Default password is empty in XAMPP
$password = "";

// 🔹 Name of the database we created in phpMyAdmin
$database = "lost_found_system";

// 🔹 Create connection object using MySQLi (Object-Oriented approach)
// This connects PHP with the MySQL database
$conn = new mysqli($host, $user, $password, $database);

// 🔹 Check if connection failed
// If connection is not successful, stop execution and show error
if (!$conn) {
    die("Database connection failed");
}

?>