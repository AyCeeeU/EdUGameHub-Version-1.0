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
session_start(); // Start the session at the beginning of the file

include 'db_conn.php';

if (isset($_GET['activity_name'])) {
    $activityName = $_GET['activity_name'];

    $questionId = isset($_GET['question_id']) ? intval($_GET['question_id']) : 0;

    // Check if the shuffled question order is stored in the session
    if (!isset($_SESSION['shuffled_questions'])) {
        // Fetch all questions for the given activity
        $sql = "SELECT question_id, question_text, option_1, option_2, option_3, option_4 
                FROM tbl_multiple_teacher 
                WHERE activity_name = ?";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $activityName);
            $stmt->execute();
            $result = $stmt->get_result();
            $questions = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
        } else {
            echo 'Error: ' . $conn->error;
        }

        // Shuffle the questions randomly
        shuffle($questions);

        // Store the shuffled questions in the session to maintain order
        $_SESSION['shuffled_questions'] = $questions;
        $_SESSION['user_score'] = 0; // Initialize user score
    } else {
        // Retrieve the shuffled questions and user score from the session
        $questions = $_SESSION['shuffled_questions'];
        $userScore = $_SESSION['user_score'];
    }

    // Check if the question exists with the given index
    if (isset($questions[$questionId])) {
        $question = $questions[$questionId];

        if (isset($_POST['user_answer'])) {
            $userAnswer = $_POST['user_answer'];
            $correctAnswer = $question['option_1']; // Assuming option_1 is always the correct answer

            if ($userAnswer === $correctAnswer) {
                $_SESSION['user_score']++; // Increment user score for correct answer
            }
        }

        // Display the question and answer options
        echo '<p class="question">' . $question['question_text'] . '</p>';
        echo '</div>';
        // Dynamically generate answer buttons
        echo '<div class="button-container">';
        echo '<form method="post" action="multipleC.php?activity_name=' . $activityName . '&question_id=' . ($questionId + 1) . '">';
        echo '<button class="answer-button" name="user_answer" value="' . $question['option_1'] . '">' . $question['option_1'] . '</button>';
        echo '<button class="answer-button" name="user_answer" value="' . $question['option_2'] . '">' . $question['option_2'] . '</button>';
        echo '<button class="answer-button" name="user_answer" value="' . $question['option_3'] . '">' . $question['option_3'] . '</button>';
        echo '<button class="answer-button" name="user_answer" value="' . $question['option_4'] . '">' . $question['option_4'] . '</button>';
        // Display the "Next" button with the updated question_id
        if ($questionId < count($questions) - 1) {
            echo '<button class="submit-button" type="submit">Next</button>';
        } else {
            // If it's the last question, redirect to "result.html" with the total score
            echo '<input type="hidden" name="total_score" value="' . $userScore . '">';
echo '<button class="submit-button" type="submit">Finish</button>';
        }
        echo '</form>';
        echo '</div>';
    } else {
        // Redirect to "result.html" with the total score when there are no more questions
        header("Location: result.php?total_score=" . $userScore);
        exit();
    }
} else {
    echo 'No activity_name specified.';
}

// Close the database connection
$conn->close();
?>
    </div>

    <script>
    // Add a variable to track whether an answer has been selected
let answerSelected = false;

// Get all answer buttons
const answerButtons = document.querySelectorAll('.answer-button');

// Add click event listeners to answer buttons
answerButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Check if an answer has already been selected
        if (answerSelected) {
            return;
        }

        // Set the variable to indicate that an answer has been selected
        answerSelected = true;

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

        // Disable all buttons after an answer is selected
        answerButtons.forEach(btn => {
            btn.disabled = true;
        });
    });
});

function navigateToNextQuestion(activityName, questionId) {
    // Change the location to the same page but with the next question for the same activity
    window.location.href = 'multipleC.php?activity_name=' + activityName + '&question_id=' + questionId;
}
    </script>
    </body>
</html>