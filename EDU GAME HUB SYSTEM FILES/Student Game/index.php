<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
          integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
          crossorigin="anonymous" referrerpolicy="no-referrer">
  
    <title>EduGameHub</title>
</head>
<body>
<header>
    <div class="header">
        <div class="gameLogo">
            <img src="Gamelogo.png" alt="edugamehub Logo" width="400"/>
        </div>
        <div class="logoutLogo">
            <img src="logout.png" class="logoutImage" alt="edugamehub Logo"/>
        </div>
    </div>
</header>
<?php
// Include your database connection script (db_conn.php) with the new path
include('C:/Users/pc/Desktop/EDUGAME SYSTEM/EDU GAME HUB SYSTEM FILES/db_conn.php');

// Check if the database connection is successful
if ($conn) {
    // Assuming you have a way to identify the user's account type
    $accountType = 'student'; // Replace with the actual account type of the user

    if ($accountType === 'student') {
        // Fetch and display student's information
        $sql = "SELECT firstname, lastname, email FROM tbl_accdb WHERE account_type = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $accountType);
        $stmt->execute();
        $stmt->bind_result($firstname, $lastname, $email);
        $stmt->fetch();
        $stmt->close();

        // Get the student's ID from tbl_accdb where account_type is 'student'
        $accountType = 'Student'; // Change to 'student' or the actual account type
        $sqlGetStudentId = "SELECT id FROM tbl_accdb WHERE account_type = ?";
        $stmtGetStudentId = $conn->prepare($sqlGetStudentId);
        $stmtGetStudentId->bind_param("s", $accountType);
        $stmtGetStudentId->execute();
        $stmtGetStudentId->bind_result($studentId);
        $stmtGetStudentId->fetch();
        $stmtGetStudentId->close();

        // Fetch the profile picture from the database
        $sqlGetProfilePicture = "SELECT image_data, image_type FROM tbl_studentpic WHERE student_id = ?";
        $stmtGetProfilePicture = $conn->prepare($sqlGetProfilePicture);
        $stmtGetProfilePicture->bind_param("i", $studentId);
        $stmtGetProfilePicture->execute();
        $stmtGetProfilePicture->bind_result($imageData, $imageType);
        $stmtGetProfilePicture->fetch();
        $stmtGetProfilePicture->close();

        // Display the user's information and the uploaded profile picture
        echo "<div class='profile'>";
        echo "<form method='post' enctype='multipart/form-data'>";
        echo "<label for='profilePicture' class='profilePictureLabel'>";

        // Display the uploaded profile picture from the database
        if ($imageData !== null) {
            $base64Image = base64_encode($imageData);
            $imageSrc = "data:$imageType;base64,$base64Image";
            echo "<img src='$imageSrc' alt='Profile Picture' width='150'>";
        } else {
            // If there's no uploaded picture, you can display a default image here.
            // echo "<img src='default_profile.jpg' alt='Profile Picture' width='150'>";
        }

        echo "</label>";
        echo "<br><input type='file' name='profilePicture' id='profilePicture' class='profilePictureInput' accept='image/*'>";
        echo "<input type='text' id='fileLabel' readonly>";
        echo "<br><span class='info'>$firstname $lastname</span>";
        echo "<br><span class='info'>$email</span>";
        echo "<input type='submit' name='upload' value='Upload' />";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "Database connection failed.";
}

// Handle the image upload and store it in the database
if (isset($_POST['upload'])) {
    // Check if a file was selected
    if ($_FILES['profilePicture']['name']) {
        // Specify the destination folder
        $destination = 'C:/Users/pc/Desktop/EDUGAME SYSTEM/EDU GAME HUB SYSTEM FILES/Student Game/';

        $originalFileName = $_FILES['profilePicture']['name'];

        // Sanitize the file name to remove special characters and spaces
        $sanitizedFileName = preg_replace("/[^a-zA-Z0-9._-]/", "_", $originalFileName);

        $targetFile = $destination . $sanitizedFileName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES['profilePicture']['tmp_name']);
        if ($check !== false) {
            // Allow only certain image file formats (you can customize this)
            if ($imageFileType === 'jpg' || $imageFileType === 'png' || $imageFileType === 'jpeg') {
                // Move the uploaded file to the desired location
                if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $targetFile)) {
                    // File uploaded successfully, save it to the database
                    $imageData = file_get_contents($targetFile);
                    $imageType = mime_content_type($targetFile);

                    // Update the profile picture in the database
                    $updateSql = "UPDATE tbl_studentpic SET image_data = ?, image_type = ?, upload_date = NOW() WHERE student_id = ?";
                    $stmt = $conn->prepare($updateSql);
                    $stmt->bind_param("ssi", $imageData, $imageType, $studentId);
                    if ($stmt->execute()) {
                        echo "File uploaded and profile picture updated successfully.";
                    } else {
                        echo "Error updating profile picture.";
                    }
                    $stmt->close();
                } else {
                    echo "Error uploading the file.";
                }
            } else {
                echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
            }
        } else {
            echo "File is not an image.";
        }
    }
}
?>

<div class="container">
    <div class="card1">
        <div class="card-image"></div>
        <h2>Badge</h2>
        <p>
            Review the activities you have created and make any necessary edits.
        </p>
        <a href="Badges.html">Proceed</a>
    </div>
    <div class="card2">
        <div class="card-image"></div>
        <h2>Play EduGame!</h2>
        <a href="student welcome.html"><i class="fa-solid fa-play" style="color: #ffffff"></i></a>
    </div>
    <div class="card3">
        <div class="card-image"></div>
        <h2>Certificates</h2>
        <p>
            Track the students' performance, view an overview of their academic progress, and related information.
        </p>
        <a href="Certificates.html">Proceed</a>
    </div>
</div>

</body>
</html>
