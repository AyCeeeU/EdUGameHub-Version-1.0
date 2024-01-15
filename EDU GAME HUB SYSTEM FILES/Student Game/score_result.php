
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Score Result</title>
    <link rel="stylesheet" href="../css/scoreResult.css">
</head>
<body>
<svg class="background" viewBox="0 0 1920 953" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient id="grad1" x1="0%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%" style="stop-color:#ff6b81;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#feca57;stop-opacity:1" />
            </linearGradient>
            <linearGradient id="grad2" x1="100%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%" style="stop-color:#0984e3;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#6c5ce7;stop-opacity:1" />
            </linearGradient>
        </defs>
        <rect width="100%" height="100%" fill="url(#grad1)" />
        <circle cx="20%" cy="20%" r="25%" fill="url(#grad2)" />
        <circle cx="50%" cy="70%" r="15%" fill="#ff7979" />
        <circle cx="90%" cy="50%" r="20%" fill="#badc58" />
        <circle cx="70%" cy="90%" r="10%" fill="#dff9fb" />
        <!-- Add more elements as needed -->
    </svg>
    <div class="score-container">
    <?php
    // Start the PHP session at the very beginning of the code
    session_start();

    include 'db_conn.php'; // Include the database connection file

    // Initialize total score
    $totalScore = 0;
    // Check if the activity_name parameter exists in the URL
    if (isset($_GET['activity_name'])) {
        $activityName = $_GET['activity_name'];
        $student_id=$_SESSION['user_id'];
        $subject= $_GET['subject'];
        // Fetch total scores for the specified activity name
        $sql = "SELECT * FROM tbl_leaderboard WHERE student_id = '$student_id' AND activity_name = '$activityName'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Convert the result to an associative array and send it as JSON to the client
            $row = $result->fetch_assoc();
            $studentScore = $row["activity_score"];
        } else {
            echo "<h1>Take the activity first!</h1>" ;
            $studentScore = '0';
        }
        $sql = "SELECT SUM(ActScore) AS total_score, COUNT(*) AS total_entries FROM tbl_multiple_teacher WHERE activity_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $activityName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Output data of the activity
            while ($row = $result->fetch_assoc()) {
                $totalScore = $row["total_score"];

                echo "<h1>Activity Name: " . $activityName . "</h1>";
                echo "<div class='score'>Your Score: " . $studentScore .  "</div>";
                echo "<div class='score'>Total Score: " . $totalScore . "</div>";

                // Display the user's updated score
                
                
                echo '<br><br><button class="game-button" onclick="goBack(\''.$subject.'\')">Go Back</button>';
            }
        } else {
            echo "No activity found for the provided activity name.";
        }

        $stmt->close();
    } else {
        echo "Activity name not provided in the URL.";
    }

    $conn->close();
    ?>


   <!-- Display the user's score -->
<div class="user-score">
<?php


    // Initialize the total score and user's score
    $totalScore = 0;
    $userScore = 0;

    // Check if the activity name is provided in the URL and the user's selected answer is set in the session
    if (isset($_GET['activity_name']) && isset($_SESSION['selected_answer'])) {
        // Get the activity name from the URL
        $activityName = $_GET['activity_name'];

        // Fetch the correct answer and its score from the database for the specific activity
        $sql = "SELECT correct_option, ActScore FROM tbl_multiple_teacher WHERE activity_name = ? AND question_id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Retrieve the question ID stored in the session
            $questionId = $_SESSION['question_id'];

            // Bind parameters and execute query
            $stmt->bind_param("si", $activityName, $questionId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $correctOption = $row['correct_option'];
                $actScore = $row['ActScore'];

                // Compare the user's selected answer with the correct answer from the database
                if ($_SESSION['selected_answer'] == $correctOption) {
                    // If the user's answer is correct, add the score to the user's score
                    $userScore += $actScore;
                }
                // Always add the score to the total score (whether the answer is correct or not)
                $totalScore += $actScore;
            }
        }
        
        $stmt->close();
    }
    

    ?>
  
    </div>

    <!-- Go Back button -->
    
    
</div>

<script>
    function goBack(subject) {
        window.location.href = 'activity_library.php?subject=' + subject + '';
    }

    // Add animations using JavaScript if needed
    // Example: Animate the score element color change
    const scoreElement = document.querySelector('.score');
    scoreElement.addEventListener('mouseover', function () {
        scoreElement.style.color = '#fdcb6e'; // Change color on mouseover
    });

    scoreElement.addEventListener('mouseout', function () {
        scoreElement.style.color = '#74b9ff'; // Change back to default color on mouseout
    });
</script>
</body>
</html>

