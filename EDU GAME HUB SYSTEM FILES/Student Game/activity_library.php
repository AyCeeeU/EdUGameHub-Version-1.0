<?php
// Retrieve the activity ID and name from the URL parameters
$activityId = isset($_GET['activity_id']) ? intval($_GET['activity_id']) : 0;
$activityName = isset($_GET['activity_name']) ? urldecode($_GET['activity_name']) : '';
// Include your database connection script (db_conn.php)
include('C:\Users\pc\Desktop\EDUGAME SYSTEM\EDU GAME HUB SYSTEM FILES\db_conn.php');

// Fetch the activity content based on the activity ID
$sql = "SELECT * FROM tbl_multiple_teacher WHERE question_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $activityId);
$stmt->execute();
$result = $stmt->get_result();
$activity = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/studentw.css">
    <link rel="stylesheet" href="assets/css/activity_library.css">
    <title>Activity Library</title>
</head>
<body>
<header>
    <a href="index.php"> <img src="Gamelogo.png" alt="Your Image" width="400"></a>
    <a href="index.php"><img src="back.png" alt="Back" width="60"></a>
</header>
<div class="container">
    <?php
    // Display the activity content
    if (!empty($activity)) {
        echo '<h2>' . htmlspecialchars($activity['activity_name'], ENT_QUOTES) . '</h2>';
        echo '<p>' . htmlspecialchars($activity['activity_description'], ENT_QUOTES) . '</p>';
        // Add code to display the activity content as needed
    } else {
        echo '<p>Activity not found.</p>';
    }
    ?>
</div>
</body>
</html>
