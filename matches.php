<?php
session_start();
require_once "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$current_user = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Smart Matches</title>
</head>
<body>

<h2>🔍 Your Matches</h2>

<hr>
<p>
<a href="dashboard.php">🏠 Dashboard</a> |
<a href="report_lost.php">📌 Report Lost</a> |
<a href="report_found.php">📌 Report Found</a>
</p>
<hr>

<?php

$sql = "SELECT 
    lost_items.lost_id,
    lost_items.item_name AS lost_name,
    lost_items.description AS lost_desc,
    lost_items.category AS lost_category,
    lost_items.location_lost,
    lost_items.date_lost,
    lost_items.user_id AS lost_user,

    found_items.found_id,
    found_items.item_name AS found_name,
    found_items.description AS found_desc,
    found_items.category AS found_category,
    found_items.location_found,
    found_items.date_found,
    found_items.user_id AS found_user

FROM lost_items
JOIN found_items 
ON lost_items.category = found_items.category";

$result = $conn->query($sql);

if($result && $result->num_rows > 0){

    while($row = $result->fetch_assoc()){

        $score = 0;

        similar_text(strtolower($row['lost_name']), strtolower($row['found_name']), $name_percent);
        if($name_percent > 50){ $score += 4; }

        similar_text(strtolower($row['lost_desc']), strtolower($row['found_desc']), $desc_percent);
        if($desc_percent > 40){ $score += 3; }

        if($row['lost_category'] == $row['found_category']){ $score += 2; }

        if($row['location_lost'] == $row['location_found']){ $score += 1; }

        $lost_date = strtotime($row['date_lost']);
        $found_date = strtotime($row['date_found']);
        if(abs($lost_date - $found_date) <= (10 * 24 * 60 * 60)){ $score += 1; }

        if($score >= 4){

            $lost_id = $row['lost_id'];
            $found_id = $row['found_id'];

            // SAVE MATCH
            $check_match = $conn->query("SELECT * FROM matches 
                                        WHERE lost_id='$lost_id' 
                                        AND found_id='$found_id'");

            if($check_match->num_rows == 0){
                $conn->query("INSERT INTO matches (lost_id, found_id, match_score, status) 
                              VALUES ('$lost_id','$found_id','$score','pending')");
            }

            // NOTIFY LOST USER
            $lost_message = "Your lost item matched: " . $row['lost_name'];
            $conn->query("INSERT INTO notifications (user_id, message) 
                          VALUES ('".$row['lost_user']."','$lost_message')");

            // NOTIFY FOUND USER
            $found_message = "Item you found matches: " . $row['found_name'];
            $conn->query("INSERT INTO notifications (user_id, message) 
                          VALUES ('".$row['found_user']."','$found_message')");

            // SHOW ONLY IF USER RELATED
            if($current_user == $row['lost_user'] || $current_user == $row['found_user']){

                echo "<hr>";
                echo "<b>🔥 Match Score:</b> $score <br><br>";

                echo "<b>Lost Item:</b> " . $row['lost_name'] . "<br>";
                echo "Location: " . $row['location_lost'] . "<br>";
                echo "Date: " . $row['date_lost'] . "<br><br>";

                echo "<b>Found Item:</b> " . $row['found_name'] . "<br>";
                echo "Location: " . $row['location_found'] . "<br>";
                echo "Date: " . $row['date_found'] . "<br>";
            }
        }
    }

} else {
    echo "❌ No matches found.";
}

?>

</body>
</html>