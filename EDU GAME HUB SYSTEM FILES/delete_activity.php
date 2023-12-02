<?php
session_start();
include('db_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete'])) {
    $question_id = $_GET['delete'];

    // SQL query to delete the activity based on the question_id
    $sql = "DELETE FROM tbl_multiple_teacher WHERE question_id = $question_id";

    if (mysqli_query($conn, $sql)) {
        // Deletion successful
        $_SESSION['delete_success'] = true;
        header("Location: library.php");
        exit;
    } else {
        // Deletion failed
        echo "Error deleting activity: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>