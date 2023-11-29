<?php
include_once 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $newPassword = isset($_POST['newPassword']) ? $_POST['newPassword'] : '';
    $motherMaidenName = isset($_POST['motherMaidenName']) ? $_POST['motherMaidenName'] : '';
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
    
    if (!empty($username) && !empty($email) && !empty($newPassword) && !empty($motherMaidenName) && !empty($birthdate)) {
        // Check if the email exists in the database
        $sql = "SELECT id FROM tbl_accdb WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            // Email exists, proceed to update the password
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE tbl_accdb SET password = ?, mother_maiden_name = ?, birthdate = ? WHERE email = ? OR username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $newPassword, $motherMaidenName, $birthdate, $email, $username);
            $stmt->execute();
            
            if ($stmt->affected_rows > 0) {
                // Password reset successful
                echo "Password reset successful. You can now log in with your new password.";
            } else {
                echo "Failed to reset the password. Please try again.";
            }
        } else {
            echo "Email does not exist. Please enter a valid email.";
        }

        $stmt->close();
    } else {
        // Handle validation errors
        echo "Please fill in all required fields.";
    }
} else {
    // Handle invalid request
    echo "Invalid request.";
}
?>
