<?php
// Include your database connection file
include('db_conn.php');

// Check if the user is logged in and get their username
session_start();
if (!isset($_SESSION['username'])) {
    echo "User is not logged in.";
    exit();
}
$loggedInUser = $_SESSION['username'];

// Prepare a query to fetch badge images and messages for the logged-in user
$sql = "SELECT quarter_1, quarter_2, quarter_3, quarter_4, message_badge FROM tbl_badge WHERE username_badge = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loggedInUser);
$stmt->execute();
$result = $stmt->get_result();

// Check if the query was successful
if ($result) {
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/badge.css">
        <title>EduGameHub</title>
    </head>
    <body>
        <header>
            <div class="header">
                <div class="gameLogo">
                    <a href="index.php"> <img src="Gamelogo.png" alt="Your Image" width="400"></a>
                </div>
                <div class "logoutLogo">
                    <img src="logout.png" class="logoutImage" alt="edugamehub Logo" />
                </div>
            </div>
        </header>

        <div class="back-button">
            <a href="index.php"><img src="back.png" alt="Back" width="60"></a>
        </div>

        <div class="container">
            <?php
            while ($row = $result->fetch_assoc()) {
                $quarterImages = [];

                foreach (range(1, 4) as $quarterNumber) {
                    $quarterField = 'quarter_' . $quarterNumber;
                    $quarterValue = $row[$quarterField];

                    // Check if the value matches the expected filename pattern
                    if ($quarterValue !== null && preg_match('/^Asset ' . $quarterNumber . '\.png$/', $quarterValue)) {
                        $quarterImages[] = $quarterValue;
                    }
                }

                // Check if the user has at least one record and display their badge
                if (!empty($quarterImages)) {
                    foreach ($quarterImages as $quarterImage) {
                        $imageUrl = $quarterImage; // Use the actual filename
                        echo '<div class="card">';
                        echo '<div class="imgBx">';
                        echo '<img src="' . $imageUrl . '" alt="' . $quarterImage . '">';
                        echo '</div>';
                        echo '<div class="content">';
                        echo '<p>' . $row['message_badge'] . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            }
            ?>
        </div>
    </body>
    </html>

    <?php
    // Close the database connection
    $stmt->close();
} else {
    echo "Error fetching data from the database: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
