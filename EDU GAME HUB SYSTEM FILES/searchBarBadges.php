<?php
// Include the database connection file
include('db_conn.php');

// Fetching student names based on account_type
$accountType = "Student";

$sql = "SELECT firstname, lastname FROM tbl_accdb WHERE account_type = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $accountType);
$stmt->execute();

$result = $stmt->get_result();
$studentNames = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $studentNames[] = $row['firstname'] . ' ' . $row['lastname'];
    }
}

$stmt->close();
$conn->close();

// Sending the student names as JSON
echo json_encode($studentNames);
?>