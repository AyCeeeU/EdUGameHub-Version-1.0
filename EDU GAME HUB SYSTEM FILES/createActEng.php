<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/createAct.css">
</head>
<body>
<div class="grid-container">
    <!-- Header -->
    <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
            <span class="material-icons-outlined">menu</span>
        </div>
        <div class="header-left">
            <button class="btn btn-primary" id="createActivityBtn">Create Activity</button>
            <button class="btn btn-secondary" id="leaderboardBtn">Leaderboard</button>
        </div>
        <div class="header-right">
            <span class="material-icons-outlined">notifications</span>
            <span class="material-icons-outlined">email</span>
            <span class="material-icons-outlined">account_circle</span>
        </div>
    </header>
    <!-- End Header -->

    <!-- Sidebar -->
    <aside id="sidebar">
        <img class="logo" src="images/edugamelogo.png" alt="logo">
        <div class="sidebar-title">
            <div class="sidebar-brand">
            </div>
            <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
            <li class="sidebar-list-item">
                <a href="teacher management system.php">
                    <span class="material-icons-outlined">dashboard</span> Dashboard
                </a>
            </li>
            <li class="sidebar-list-item">
                <a href="students.php">
                    <span class="material-icons-outlined">groups</span> Students
                </a>
            </li>
            <li class="sidebar-list-item">
                <a href="subjects.html">
                    <span class="material-icons-outlined">menu_book</span> Subjects
                </a>
            </li>
            <li class="sidebar-list-item">
                <a href="Messages.html">
                    <span class="material-icons-outlined">mail</span> Messages
                </a>
            </li>
            <li class="sidebar-list-item">
                <a href="Login.html">
                    <span class="material-icons-outlined">logout</span> Sign Out
                </a>
            </li>
        </ul>
    </aside>
    <!-- End Sidebar -->

    <?php
    // Include your database connection script (db_conn.php)
    include('db_conn.php');

    // Initialize variables to store form data
    $activity_name = "";
    $questions = array();

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $activity_name = $_POST["activity-name"];

        // Loop through posted questions and store them in an array
        for ($i = 1; $i <= $_POST["question-count"]; $i++) {
            $question_text = $_POST["question-text-$i"];

            // Initialize options and correct_option arrays
            $options = array();
            $correct_option = "";

            // Check if options and correct_option fields exist before accessing them
            if (isset($_POST["option-$i-1"])) {
                $options[] = $_POST["option-$i-1"];
            }
            if (isset($_POST["option-$i-2"])) {
                $options[] = $_POST["option-$i-2"];
            }
            if (isset($_POST["option-$i-3"])) {
                $options[] = $_POST["option-$i-3"];
            }
            if (isset($_POST["option-$i-4"])) {
                $options[] = $_POST["option-$i-4"];
            }
            if (isset($_POST["correct-option-$i"])) {
                $correct_option = $_POST["correct-option-$i"];
            }

            // Check if the question has at least one option
            if (empty($options)) {
                echo '<script>alert("Question ' . $i . ' must have at least one option.");</script>';
                continue; // Skip this question and move to the next
            }

            $questions[] = array(
                "question_text" => $question_text,
                "options" => $options,
                "correct_option" => $correct_option
            );
        }

        // Get the value of the Randomize Questions checkbox
        $randomize_questions = isset($_POST['randomize-questions']) ? 1 : 0;

        // Insert questions into the database
        foreach ($questions as $question) {
            $question_text = mysqli_real_escape_string($conn, $question["question_text"]);
            $options = array_map(function ($option) use ($conn) {
                return mysqli_real_escape_string($conn, $option);
            }, $question["options"]);
            $correct_option = mysqli_real_escape_string($conn, $question["correct_option"]);

            // SQL query to insert data into the table
            $sql = "INSERT INTO tbl_multiple_teacher (activity_name, question_text, option_1, option_2, option_3, option_4, correct_option, randomize_questions)
                VALUES ('$activity_name', '$question_text', ";

            // Add options to the SQL query
            for ($i = 0; $i < 4; $i++) {
                if (isset($options[$i])) {
                    $sql .= "'" . $options[$i] . "'";
                } else {
                    $sql .= "''"; // Empty string for NULL value
                }

                if ($i < 3) {
                    $sql .= ", ";
                }
            }

            $sql .= ", '$correct_option', '$randomize_questions')";

            // Execute the SQL query
            if (mysqli_query($conn, $sql)) {
                // Show the modal when data is saved
                echo '<script>
                    window.onload = function() {
                        openModal();
                    }
                </script>';
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
    ?>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Questions Saved!</p>
        </div>
    </div>

    <div class="question-builder">
        <form id="question-form" method="POST" action="">
            <div class="container"><br>
                <label for="activity-name">Activity Name:</label>
                <input type="text" id="activity-name" name="activity-name" class="custom-ActName" value="<?php echo $activity_name; ?>">
            </div>
            
            <!-- Toggle button for question randomization -->
            <div class="container">
                <label for="randomize-questions">Randomize Questions:</label>
                <input type="checkbox" id="randomize-questions" name="randomize-questions">
            </div>
            
            <div id="questions-container">
                <!-- Initially, you can have one set of question elements -->
                <div class="container" id="question-1">
                    <h2>Question 1</h2>
                    <!-- Wider question text box -->
                    <label for="question-text-1">Question:</label>
                    <textarea id="question-text-1" name="question-text-1" class="custom-Question" rows="5"></textarea>
                    <!-- Four options text boxes -->
                    <div class="container">
                        <label for="option-1-1">Option 1:</label>
                        <input type="text" id="option-1-1" name="option-1-1" class="custom-OptA">
                        <div class="checkbox-container">
                            <input type="radio" id="correct-answer-1-1" name="correct-option-1" value="1">
                            <label for="correct-answer-1-1">Correct answer</label>
                        </div>
                    </div>
                    <div class="container">
                        <label for="option-1-2">Option 2:</label>
                        <input type="text" id="option-1-2" name="option-1-2" class="custom-OptB">
                        <div class="checkbox-container">
                            <input type="radio" id="correct-answer-1-2" name="correct-option-1" value="2">
                            <label for="correct-answer-1-2">Correct answer</label>
                        </div>
                    </div>
                    <div class="container">
                        <label for="option-1-3">Option 3:</label>
                        <input type="text" id="option-1-3" name="option-1-3" class="custom-OptC">
                        <div class="checkbox-container">
                            <input type="radio" id="correct-answer-1-3" name="correct-option-1" value="3">
                            <label for="correct-answer-1-3">Correct answer</label>
                        </div>
                    </div>
                    <div class="container">
                        <label for="option-1-4">Option 4:</label>
                        <input type="text" id="option-1-4" name="option-1-4" class="custom-OptD">
                        <div class="checkbox-container">
                            <input type="radio" id="correct-answer-1-4" name="correct-option-1" value="4">
                            <label for="correct-answer-1-4">Correct answer</label>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" onclick="addNewQuestion()" class="btn btn-add-new">Add New Question Set</button>
            <input type="hidden" name="question-count" id="question-count" value="1">
            <button type="submit" name="submit">Save questions</button>
        </form>
    </div>

    <script>
        // Get the modal element
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // Function to open the modal
        function openModal() {
            modal.style.display = "block";
        }

        // Function to close the modal
        function closeModal() {
            modal.style.display = "none";
        }

        // Close the modal if the user clicks outside of it
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }

        // Function to add a new set of question elements
        function addNewQuestion() {
            var questionCount = document.getElementById("question-count");
            var newQuestionCount = parseInt(questionCount.value) + 1;

            // Clone the entire set of question elements
            var questionSetTemplate = document.querySelector("#questions-container > .container");
            var newQuestionSet = questionSetTemplate.cloneNode(true);

            // Update the question set number and clear input values and radio button selection in the new set
            newQuestionSet.querySelector("h2").textContent = "Question " + newQuestionCount;
            newQuestionSet.querySelector("textarea").value = "";
            var inputFields = newQuestionSet.querySelectorAll("input[type='text']");
            for (var i = 0; i < inputFields.length; i++) {
                inputFields[i].value = "";
            }
            var radioButtons = newQuestionSet.querySelectorAll("input[type='radio']");
            for (var i = 0; i < radioButtons.length; i++) {
                radioButtons[i].checked = false;
            }

            // Set unique IDs and names for new set elements
            newQuestionSet.querySelector("h2").textContent = "Question " + newQuestionCount;
            newQuestionSet.querySelector("textarea").setAttribute("name", "question-text-" + newQuestionCount);
            var inputFields = newQuestionSet.querySelectorAll("input[type='text']");
            for (var i = 0; i < inputFields.length; i++) {
                inputFields[i].setAttribute("name", "option-" + newQuestionCount + "-" + (i + 1));
            }
            var radioButtons = newQuestionSet.querySelectorAll("input[type='radio']");
            for (var i = 0; i < radioButtons.length; i++) {
                radioButtons[i].setAttribute("name", "correct-option-" + newQuestionCount);
            }

            // Append the new set to the container
            document.getElementById("questions-container").appendChild(newQuestionSet);

            // Update the question count
            questionCount.value = newQuestionCount;
        }
    </script>
</body>
</html>
