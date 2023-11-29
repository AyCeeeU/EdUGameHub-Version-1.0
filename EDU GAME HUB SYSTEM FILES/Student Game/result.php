<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/result.css">
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
                <a href="Login.html"> <img src="logout.png" class="logoutImage"></a>
            </div>
        </div>

        <div class="result-container">
            <h1>Your Quiz Result</h1>
    
            <?php
            // Retrieve the total score from the query parameters
            $totalScore = isset($_GET['total_score']) ? intval($_GET['total_score']) : 0;
    
            // Display the total score
            echo '<p class="score">Total Score: ' . $totalScore . '</p>';
            ?>
            
            <!-- Add any additional content or styling here -->
        </div>
    </body>
    </html>

