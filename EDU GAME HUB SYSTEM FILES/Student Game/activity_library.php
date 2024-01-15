<?php
// Include your database connection script (db_conn.php)
include('db_conn.php');

// Initialize variables for potential errors
$error = "";
$activity = null;
$subject = $_GET['subject'];
// Check if an activity ID is provided in the URL
if (isset($_GET['activity_id'])) {
    // Activity ID is provided; fetch and display the specific activity
    $activityId = intval($_GET['activity_id']);
    $sql = "SELECT * FROM tbl_multiple_teacher WHERE subjects = '$subject' AND question_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $activityId);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        $error = "Database query error: " . $stmt->error;
    } else {
        $activity = $result->fetch_assoc();
    }
    $stmt->close();
} else {
    // List all activities, selecting the one with the lowest question_id for each unique activity_name
    $sql = "SELECT MIN(question_id) as question_id, activity_name FROM tbl_multiple_teacher WHERE subjects = '$subject' AND visible_students = 1 GROUP BY activity_name";
    $result = mysqli_query($conn, $sql);
}

// Close the database connection
mysqli_close($conn);
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
    <div class="logoutLogo">
    <a href="../logout.php"><img src="logout.png" class="logoutImage"></a>
    </div>
</header>
<div class="back-button">
    <a href="student welcome.html"><img src="back.png" alt="Back" width="60"></a>
</div>

<div class="container">
    <?php
    // ... (your PHP code remains unchanged)
    ?>

    <?php
    if (!empty($error)) {
        echo '<p>Error: ' . $error . '</p>';
    } else {
        if (isset($_GET['activity_id'])) {
            // Display the activity details
            echo "Activity Data: " . print_r($activity, true) . "<br>";
            if (!empty($activity)) {
                echo '<h2 class="activity-name">' . htmlspecialchars($activity['activity_name'], ENT_QUOTES) . '</h2>';

                echo '<form method="get" action="multipleC.php">';
                echo '<input type="hidden" name="activity_name" value="' . htmlspecialchars($activity['activity_name'], ENT_QUOTES) . '">';
                echo '<input type="hidden" name="activity_id" value="' . htmlspecialchars($activityId) . '">';
                echo '<input type="hidden" name="subject" value="' . htmlspecialchars($subject) . '">';
                echo '<input type="hidden" name="state" value="new">';
                echo '<button type="submit" class="start-activity-btn">Start Activity</button>';
                echo '</form>';

                echo '<form method="get" action="score_result.php">';
                echo '<input type="hidden" name="activity_name" value="' . htmlspecialchars($activity['activity_name'], ENT_QUOTES) . '">';
                echo '<input type="hidden" name="activity_id" value="' . htmlspecialchars($activityId) . '">';
                echo '<input type="hidden" name="subject" value="' . htmlspecialchars($subject) . '">';
                
                echo '<button type="submit" class="score-result-btn">Score Result</button>';
                echo '</form>';
            } else {
                echo '<p>Activity not found.</p>';
            }
        } else {
            // List all activities
            echo '<div class="activity-list">';
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="activity-item">'; 
                    echo '<h2 class="activity-name">Activity Name: ' . htmlspecialchars($row['activity_name'], ENT_QUOTES) . '</h2>';
                    
                    echo '<form method="get" action="multipleC.php">';
                    echo '<input type="hidden" name="activity_name" value="' . htmlspecialchars($row['activity_name'], ENT_QUOTES) . '">';
                    echo '<input type="hidden" name="activity_id" value="' . htmlspecialchars($row['question_id']) . '">';
                    echo '<input type="hidden" name="subject" value="' . htmlspecialchars($subject) . '">';
                    echo '<input type="hidden" name="state" value="new">';
                    echo '<button type="submit" class="start-activity-btn">Start Activity</button>';
                    echo '</form>';

                    echo '<form method="get" action="score_result.php">';
                    echo '<input type="hidden" name="activity_name" value="' . htmlspecialchars($row['activity_name'], ENT_QUOTES) . '">';
                    echo '<input type="hidden" name="activity_id" value="' . htmlspecialchars($row['question_id']) . '">';
                    echo '<input type="hidden" name="subject" value="' . htmlspecialchars($subject) . '">';
                    echo '<button type="submit" class="score-result-btn">Score Result</button>';
                    echo '</form>';

                    echo '</div>';
                }
            } else {
                echo '<p>No activities available.</p>';
            }
            echo '</div>';
        }
    }
    ?>
</div>
</body>
</html>