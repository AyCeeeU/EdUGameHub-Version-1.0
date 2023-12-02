<?php
// Connect to the database (assuming db_conn.php is included)
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Assuming you've established the database connection in db_conn.php
    include('db_conn.php');

    // Retrieve and sanitize data from the form
    $question_id = $_POST["question_id"];
    $activity_name = $_POST["activity-name"];
    $randomize_questions = isset($_POST['randomize-questions']) ? 1 : 0;

    // Update the activity details
    $updateActivityQuery = "UPDATE tbl_multiple_teacher 
                            SET 
                                activity_name = '$activity_name',
                                randomize_questions = '$randomize_questions'
                            WHERE question_id = '$question_id'";

    if (mysqli_query($conn, $updateActivityQuery)) {
        // Update successful

        // Retrieve the total number of questions from the form
        $questionCount = isset($_POST["question-count"]) ? (int)$_POST["question-count"] : 0;

        // Loop through and update each question
        for ($i = 1; $i <= $questionCount; $i++) {
            // Retrieve and sanitize question-related fields
            $question_text = isset($_POST["question-text-$i"]) ? $_POST["question-text-$i"] : "";
            $option_1 = isset($_POST["option-$i-1"]) ? $_POST["option-$i-1"] : "";
            $option_2 = isset($_POST["option-$i-2"]) ? $_POST["option-$i-2"] : "";
            $option_3 = isset($_POST["option-$i-3"]) ? $_POST["option-$i-3"] : "";
            $option_4 = isset($_POST["option-$i-4"]) ? $_POST["option-$i-4"] : "";
            $correct_option = isset($_POST["correct-option-$i"]) ? $_POST["correct-option-$i"] : "";

            // Update the questions
            $updateQuestionQuery = "UPDATE tbl_multiple_teacher 
                                    SET 
                                        question_text = '$question_text',
                                        option_1 = '$option_1',
                                        option_2 = '$option_2',
                                        option_3 = '$option_3',
                                        option_4 = '$option_4',
                                        correct_option = '$correct_option'
                                    WHERE question_id = '$question_id'";

            if (!mysqli_query($conn, $updateQuestionQuery)) {
                echo "Error updating question $i: " . mysqli_error($conn);
                // Handle any error scenarios or roll back changes if required
            }
        }
        
        $_SESSION['update_success'] = true;

        // Redirect back to createActEng.php or any other relevant page
        header("Location: createActEng.php");
        exit;

        echo "Activity and questions updated successfully";
    } else {
        echo "Error updating activity: " . mysqli_error($conn);
    }   

    // Close the database connection
    mysqli_close($conn);
}
?>
