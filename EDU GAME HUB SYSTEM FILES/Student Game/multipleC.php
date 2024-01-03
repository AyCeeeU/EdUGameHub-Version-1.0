<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/multipleC.css">
    <title>EduGameHub</title>
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
    session_start();
    include 'db_conn.php';

    if (!isset($_SESSION['displayed_questions'])) {
        $_SESSION['displayed_questions'] = [];
    }

    if (isset($_GET['activity_name'])) {
        $activityName = $_GET['activity_name'];
        $questionId = isset($_GET['question_id']) ? intval($_GET['question_id']) : 0;

        if (!isset($_SESSION['shuffled_questions']) || empty($_SESSION['shuffled_questions'])) {
            // Fetch questions including 'randomize_questions' value
            $sql = "SELECT question_id, question_text, option_1, option_2, option_3, option_4, correct_option, ActScore, randomize_questions
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

            // Check if the questions need to be shuffled based on 'randomize_questions' value
            $randomize = isset($questions[0]['randomize_questions']) ? $questions[0]['randomize_questions'] : null;

            if ($randomize === 1) {
                shuffle($questions);
            }

            // Store the shuffled questions in the session to maintain order
            $_SESSION['shuffled_questions'] = $questions;
        } else {
            // Retrieve the shuffled questions from the session
            $questions = $_SESSION['shuffled_questions'];
        }

        // Filter out the already displayed questions
        $remainingQuestions = array_diff_key($questions, array_flip($_SESSION['displayed_questions']));

        // Check if there are remaining questions
        if (!empty($remainingQuestions)) {
            $question = reset($remainingQuestions); // Get the first question
            $displayedQuestionId = array_keys($questions, $question)[0]; // Get the ID of the displayed question
            $_SESSION['displayed_questions'][] = $displayedQuestionId; // Add displayed question ID to the list
        
            // Check if 'correct_option' key exists in the $question array
            if (isset($question['correct_option'])) {
                // Display the question and answer options
                echo '<p class="question">' . $question['question_text'] . '</p>';
    echo '</div>';
    // Dynamically generate answer buttons based on correct_option
    echo '<div class="button-container">';
    echo '<button class="answer-button" data-correct="' . ($question['correct_option'] == 1 ? '1' : '0') . '" data-answer="A">' . $question['option_1'] . '</button>';
    echo '<button class="answer-button" data-correct="' . ($question['correct_option'] == 2 ? '1' : '0') . '" data-answer="B">' . $question['option_2'] . '</button>';
    echo '<button class="answer-button" data-correct="' . ($question['correct_option'] == 3 ? '1' : '0') . '" data-answer="C">' . $question['option_3'] . '</button>';
    echo '<button class="answer-button" data-correct="' . ($question['correct_option'] == 4 ? '1' : '0') . '" data-answer="D">' . $question['option_4'] . '</button>';
    // Display the "Next" button with the updated question_id
    echo '<button class="submit-button" onclick="navigateToNextQuestion(\'' . $activityName . '\', ' . ($questionId + 1) . ')">Next</button>';
    echo '</div>';
            } else {
                $_SESSION['activity_completed'] = true;

                echo 'Correct option information is missing for this question.';
            }
        } else {

            echo 'No more questions found for this activity.';
            // Display the Finish button to show the score result
            echo '</div>';
            echo '<div class="button-container">';
            echo '<button class="submit-button" onclick="finishActivity()">Finish</button>';
            echo '</div>';
        }
    }
    
    // Close the database connection
    $conn->close();
    ?>
    </div>

    <script>
    // Get all answer buttons
    const answerButtons = document.querySelectorAll('.answer-button');

    answerButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Play sound on button click
            const audio = new Audio('ButtonAnsSFX.mp3');
            audio.play();

            const isCorrect = button.getAttribute('data-correct') === 'true';
            const selectedOption = button.getAttribute('data-answer'); // Get the selected option

            // Store the selected option in the session for processing later
            sessionStorage.setItem('selectedOption', selectedOption);

            answerButtons.forEach(btn => {
                btn.classList.remove('correct-selected', 'wrong-selected');
            });

            if (isCorrect) {
                button.classList.add('correct-selected');
                // Store 'isCorrect' in session for processing later
                sessionStorage.setItem('isCorrect', 'true');
            } else {
                button.classList.add('wrong-selected');
                // Store 'isCorrect' in session for processing later
                sessionStorage.setItem('isCorrect', 'false');
            }
        });
    });

    function navigateToNextQuestion(activityName, questionId) {
        const selectedOption = sessionStorage.getItem('selectedOption');
        const correctOption = document.querySelector(`.answer-button[data-correct="1"]`).getAttribute('data-answer');

        const isCorrect = selectedOption === correctOption ? 1 : 0;

        // Increment the correct_answers_count in the session
        if (isCorrect) {
            if (!sessionStorage.getItem('correct_answers_count')) {
                sessionStorage.setItem('correct_answers_count', '1');
            } else {
                const count = parseInt(sessionStorage.getItem('correct_answers_count'));
                sessionStorage.setItem('correct_answers_count', (count + 1).toString());
            }
        }

        // Redirect to the next question
        window.location.href = 'multipleC.php?activity_name=' + activityName + '&question_id=' + questionId;
    }

    function finishActivity() {
        // Calculate and display the total score
        const correctAnswersCount = <?php echo isset($_SESSION['correct_answers_count']) ? $_SESSION['correct_answers_count'] : 0; ?>;
        const score = correctAnswersCount;

        

        // Redirect to score_result.php after finishing the activity
        window.location.href = 'activity_library.php';
    }
    </script>
</body>
</html>