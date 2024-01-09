<?php
session_start();
include 'db_conn.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the JavaScript AJAX request
$studentID = $_POST['student_id'];
$activityName = $_POST['activityName'];
$activityScore = $_POST['score'];

$idExists = false;
$checkId = "SELECT student_id FROM tbl_leaderboard WHERE student_id = '$studentID' AND activity_name = '$activityName'";
$result = $conn->query($checkId);

if ($result->num_rows > 0) {
    $idExists = true;
    echo "ID already exists in the database";
}

if (!$idExists) {
    // Insert data into the database (replace "your_table" with your actual table name)
    $sql = "INSERT INTO tbl_leaderboard (student_id, activity_name,activity_score) VALUES ('$studentID', '$activityName', '$activityScore')";

    if ($conn->query($sql) === TRUE) {
        echo "Row added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}else {
    $sql = "UPDATE tbl_leaderboard SET activity_score='$activityScore' WHERE student_id='$studentID' AND activity_name = '$activityName'";

    if ($conn->query($sql) === TRUE) {
        echo "Row added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
