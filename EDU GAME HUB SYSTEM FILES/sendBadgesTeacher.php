<?php
session_start();
include("db_conn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentName = $_POST['studentName'];
    $badge = $_POST['badge'];
    $message = $_POST['message'];

    // Split the studentName into first_name and last_name
    list($first_name, $last_name) = explode(" ", $studentName);

    // Determine the quarter based on the badge
    switch ($badge) {
        case "Asset 1.png":
            $quarter = "quarter_1";
            break;
        case "Asset 2.png":
            $quarter = "quarter_2";
            break;
        case "Asset 3.png":
            $quarter = "quarter_3";
            break;
        case "Asset 4.png":
            $quarter = "quarter_4";
            break;
        default:
            $quarter = "";
            break;
    }

    // Fetch the student's username based on the selected name
    $fetch_username_sql = "SELECT username FROM tbl_accdb WHERE firstname = ? AND lastname = ? AND account_type = 'Student'";
    $stmt_fetch_username = $conn->prepare($fetch_username_sql);
    $stmt_fetch_username->bind_param("ss", $first_name, $last_name);
    $stmt_fetch_username->execute();
    $stmt_fetch_username->bind_result($studentUsername);
    $stmt_fetch_username->fetch();
    $stmt_fetch_username->close();

    // Check if a record for the student already exists
    $check_sql = "SELECT id FROM tbl_badge WHERE first_name = ? AND last_name = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("ss", $first_name, $last_name);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        // Student exists in the database, update the respective quarter and message
        $update_sql = "UPDATE tbl_badge SET $quarter = ?, message_badge = ?, username_badge = ? WHERE first_name = ? AND last_name = ?";
        $stmt_update = $conn->prepare($update_sql);
        $stmt_update->bind_param("sssss", $badge, $message, $studentUsername, $first_name, $last_name);

        if ($stmt_update->execute()) {
            echo "Badge updated successfully!";
        } else {
            echo "Error updating the badge: " . $stmt_update->error;
        }

        $stmt_update->close();
    } else {
        // Insert data into the database as the student doesn't exist
        $insert_sql = "INSERT INTO tbl_badge (first_name, last_name, $quarter, message_badge, username_badge) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($insert_sql);
        $stmt_insert->bind_param("sssss", $first_name, $last_name, $badge, $message, $studentUsername);

        if ($stmt_insert->execute()) {
            echo "Badge sent successfully!";
        } else {
            echo "Error inserting the badge: " . $stmt_insert->error;
        }

        $stmt_insert->close();
    }

    $stmt_check->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
