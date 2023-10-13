<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // Include your database connection script
    include('db_conn.php');

    $userId = $_SESSION['user_id'];

    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];

        if ($file['error'] === UPLOAD_ERR_OK) {
            $fileName = $file['name'];
            $tmpName = $file['tmp_name'];

            // Define the directory where profile pictures will be stored
            $uploadDir = 'ProfilePics';

            // Create the directory if it doesn't exist
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Generate a unique filename to avoid overwriting
            $destination = $uploadDir . uniqid() . '_' . $fileName;

            if (move_uploaded_file($tmpName, $destination)) {
                if ($conn) {
                    $sql = "UPDATE tbl_accdb SET profile_pic = ? WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("si", $destination, $userId);
            
                    if ($stmt->execute()) {
                        // File uploaded and database updated successfully
                        // Return the image path
                        echo $destination;
                        exit;
                    } else {
                        echo "Database update failed.";
                    }
            
                    $stmt->close();
                } else {
                    echo "Database connection failed.";
                }
            } else {
                echo "File upload failed.";
            }
        } else {
            echo "Error during file upload.";
        }
    } else {
        echo "No file uploaded.";
    }
} else {
    echo "You are not logged in. Please log in to upload your profile picture.";
}
?>
