<?php

// 🔹 Start session to access current user session data
session_start();

// 🔹 Destroy all session data
// This logs the user out by removing stored session variables (like user_id)
session_destroy();

// 🔹 Redirect user to login page after logout
header("Location: login.php");

// 🔹 Stop further script execution
exit();

?>