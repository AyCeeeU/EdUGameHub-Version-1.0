<?php
include_once 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $motherMaidenName = isset($_POST['motherMaidenName']) ? $_POST['motherMaidenName'] : '';
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';

    if (!empty($username)) {
        // Check if the entered Mother's Maiden Name and Birthdate match the records in the database
        $sql = "SELECT id, mother_maiden_name, birthdate FROM tbl_accdb WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $dbMotherMaidenName, $dbBirthdate);
            $stmt->fetch();

            if (empty($dbMotherMaidenName) && empty($dbBirthdate)) {
                // For accounts with both maiden name and birthdate empty, proceed with 'match'
                echo "match";
            } else if ($motherMaidenName === $dbMotherMaidenName && $birthdate === $dbBirthdate) {
                // For accounts with provided maiden name and birthdate, respond with 'match'
                echo "match";
            } else {
                // Mismatch found, respond with 'not match'
                echo "not match";
            }
        } else {
            // No records found for the username
            echo "not match";
        }

        $stmt->close();
    } else {
        // Handle validation errors
        echo "Please provide a username.";
    }
} else {
    // Handle invalid request
    echo "Invalid request.";
}
?>
