<?php
include('db_conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['activityId'])) {
    $activityId = $_POST['activityId'];

    // Perform the deletion query
    $sql = "DELETE FROM tbl_multiple_teacher WHERE question_id = $activityId";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'invalid request';
}

mysqli_close($conn);
?>
