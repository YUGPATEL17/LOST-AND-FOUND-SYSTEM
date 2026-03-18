<?php

$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "lost_found_system";

$conn = new mysqli($host, $user, $password, $database);

if (!$conn) {
    die("Database connection failed");
}

?>