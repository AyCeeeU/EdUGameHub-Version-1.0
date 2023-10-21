<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/multipleC.css">
    <title>EduGameHub</title>

    <audio id="correctSound">
    <source src="correct.wav" type="audio/mpeg">
</audio>

<audio id="wrongSound">
    <source src="wrong.wav" type="audio/mpeg">
</audio>
</head>
<body>
    <h4 class="type">Multiple Choice</h4>
    <header>
        <a href="index.php"> <img src="Gamelogo.png" alt="Your Image" width="400"></a>
    </header>
    <div class="back-button">
        <a href="student welcome.html"><img src="back.png" alt="Back" width="60"></a>
    </div>

    <div class="quiz-container1">
    <?php
    // Include the database connection file
    include 'db_conn.php';

    // Retrieve the activity name from the query parameters
    if (isset($_GET['activity_name'])) {
        $activityName = $_GET['activity_name'];
        $questionId = isset($_GET['question_id']) ? intval($_GET['question_id']) : 0;
    
        // Query to retrieve the next question for the provided activity name
        $sql = "SELECT question_id, question_text, option_1, option_2, option_3, option_4 FROM tbl_multiple_teacher WHERE activity_name = ? AND question_id > ? ORDER BY question_id LIMIT 1";
        $stmt = $conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("si", $activityName, $questionId);
    
            // Execute the statement
            $stmt->execute();
    
            // Get the result
            $result = $stmt->get_result();
    
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
    
                // Display the question and answer options
                echo '<p class="question">' . $row['question_text'] . '</p>';
                echo '</div>';
                // Dynamically generate answer buttons
                echo '<div class="button-container">';
                echo '<button class="answer-button" data-correct="true" data-answer="A">' . $row['option_1'] . '</button>';
                echo '<button class="answer-button" data-correct="false" data-answer="B">' . $row['option_2'] . '</button>';
                echo '<button class="answer-button" data-correct="false" data-answer="C">' . $row['option_3'] . '</button>';
                echo '<button class="answer-button" data-correct="false" data-answer="D">' . $row['option_4'] . '</button>';
                // Display the "Next" button with the updated question_id
                echo '<button class="submit-button" onclick="navigateToNextQuestion(\'' . $activityName . '\', ' . $row['question_id'] . ')">Next</button>';
                echo '</div>';
            } else {
                echo 'No more questions found for this activity.';
            }
    
            // Close the statement
            $stmt->close();
        } else {
            echo 'Error: ' . $conn->error;
        }
    } else {
        echo 'No activity_name specified.';
    }

    // Close the database connection
    $conn->close();
    ?>
    </div>

    <script>
    // Get all answer buttons
const answerButtons = document.querySelectorAll('.answer-button');

// Add click event listeners to answer buttons
answerButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Check if the clicked button is the correct answer
        const isCorrect = button.getAttribute('data-correct') === 'true';

        // Remove the 'correct-selected' and 'wrong-selected' classes from all buttons
        answerButtons.forEach(btn => {
            btn.classList.remove('correct-selected', 'wrong-selected');
        });

        // Add the appropriate class to the clicked button
        if (isCorrect) {
            button.classList.add('correct-selected');
            document.getElementById('correctSound').play(); // Play the correct answer sound
        } else {
            button.classList.add('wrong-selected');
            document.getElementById('wrongSound').play(); // Play the wrong answer sound
        }
    });
});


    function checkAnswer() {
        // Find the selected correct button
        const selectedCorrectButton = document.querySelector('.correct-selected');

        // Find the selected wrong button
        const selectedWrongButton = document.querySelector('.wrong-selected');

        // Change button colors based on correctness
        if (selectedCorrectButton) {
            selectedCorrectButton.style.backgroundColor = 'green';
        }
        if (selectedWrongButton) {
            selectedWrongButton.style.backgroundColor = 'red';
        }

        // You might want to add more logic here to handle checking the answer.
    }

    function navigateToNextQuestion(activityName, questionId) {
        // Change the location to the same page but with the next question for the same activity
        window.location.href = 'multipleC.php?activity_name=' + activityName + '&question_id=' + questionId;
    }
    </script>
    </body>
</html>
