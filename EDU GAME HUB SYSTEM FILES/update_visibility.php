<?php
// Include your database connection script (db_conn.php)
include('db_conn.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["activityId"]) && isset($_POST["visibleStatus"])) {
    $activityId = $_POST["activityId"];
    $visibleStatus = $_POST["visibleStatus"];

    // Update the database
    $sql = "UPDATE tbl_multiple_teacher SET visible_students = '$visibleStatus' WHERE question_id = $activityId";
    if (mysqli_query($conn, $sql)) {
        // Database update was successful
        echo "Visibility updated successfully.";
    } else {
        // Database update failed
        echo "Error updating visibility: " . mysqli_error($conn);
    }
} else {
    // Invalid request
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
