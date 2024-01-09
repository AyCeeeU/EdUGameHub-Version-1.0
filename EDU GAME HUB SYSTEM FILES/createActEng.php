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
            <button class="btn btn-secondary" id="libraryBtn" onclick="openLibrary()">Library</button>
            <button class="btn btn-secondary" id="badgesBtn"onclick="openbadgesBtn()">Badges</button>
            <!--<button class="btn btn-secondary" id="leaderboardBtn" onclick="openLeaderboard()">Leaderboard</button>-->
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
                <a href="subjects.php">
                    <span class="material-icons-outlined">menu_book</span> Subjects
                </a>
            </li>
            <li class="sidebar-list-item">
                <a href="Messages.html">
                    <span class="material-icons-outlined">mail</span> Messages
                </a>
            </li>
            <li class="sidebar-list-item">
                <a href="logout.php">
                    <span class="material-icons-outlined">logout</span> Sign Out
                </a>
            </li>
        </ul>
    </aside>
    <!-- End Sidebar -->

    <?php
    include('db_conn.php');
    
    $activity_name = "";
    $questions = array();

    // Form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $activity_name = $_POST["activity-name"];
        $ActScores = array();

        // Loop through posted questions 
        for ($i = 1; $i <= $_POST["question-count"]; $i++) {
            $question_text = $_POST["question-text-$i"];
            $ActScore = $_POST["score-$i"];

            //  options and correct_option arrays
            $options = array();
            $correct_option = "";
            $ActScores[] = $ActScore;

        }
    }
?>
    </head>
    <body>
    
        

       
 
        <?php
        session_start();

include('db_conn.php');

$activity_name = "";
$questions = array();
$activityDetails = array();
$questionsSaved = false; // Flag to track if questions are saved successfully

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['edit'])) {
    // Fetch existing data based on question_id for editing
    $question_id = $_GET['edit'];
    $sql = "SELECT * FROM tbl_multiple_teacher WHERE question_id = $question_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch activity details
        $activityDetails = mysqli_fetch_assoc($result);
        $activity_name = $activityDetails['activity_name'];

        // Fetch all questions associated with the same activity name
        $questionSql = "SELECT * FROM tbl_multiple_teacher WHERE activity_name = '$activity_name'";
        $resultQuestions = mysqli_query($conn, $questionSql);

        if ($resultQuestions && mysqli_num_rows($resultQuestions) > 0) {
            while ($row = mysqli_fetch_assoc($resultQuestions)) {
                $questions[] = $row;
            }
        }
    } else {
        echo "Question not found.";
        exit;
    }
}


        // Form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $activity_name = $_POST["activity-name"];
        
            // Reset the questions array
            $questions = [];
        
            // Loop through posted questions 
            for ($i = 1; $i <= $_POST["question-count"]; $i++) {
                $question_text = $_POST["question-text-$i"];
        
                // Options and correct_option arrays
                $options = [];
                $correct_option = "";
                $ActScore = $_POST["score-$i"];
        
                // Retrieve options and correct option for the question
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
        
                // Check for empty options
                if (empty($options)) {
                    echo '<script>alert("Question ' . $i . ' must have at least one option.");</script>';
                    continue; 
                }
        
                // Store each question's details in the questions array
                $questions[] = array(
                    "question_text" => $question_text,
                    "options" => $options,
                    "correct_option" => $correct_option,
                    "score" => $ActScore // Store score for each question in the array
                );
            }
            //  the value of the Randomize Questions checkbox
            $randomize_questions = isset($_POST['randomize-questions']) ? 1 : 0;

            //  questions into the database
            foreach ($questions as $question) {
                $question_text = mysqli_real_escape_string($conn, $question["question_text"]);
                $options = array_map(function ($option) use ($conn) {
                    return mysqli_real_escape_string($conn, $option);
                }, $question["options"]);
                $correct_option = mysqli_real_escape_string($conn, $question["correct_option"]);

                //  query to insert data into the table
                $sql = "INSERT INTO tbl_multiple_teacher (activity_name, question_text, option_1, option_2, option_3, option_4, correct_option, randomize_questions, ActScore)
            VALUES ('$activity_name', '$question_text', ";
                //  options to the SQL query
                for ($i = 0; $i < 4; $i++) {
                    if (isset($options[$i])) {
                        $sql .= "'" . $options[$i] . "'";
                    } else {
                        $sql .= "''"; 
                    }

                    if ($i < 3) {
                        $sql .= ", ";
                    }
                }

                $sql .= ", '$correct_option', '$randomize_questions', '$question[score]')"; // Use the score for each question

        
                if (mysqli_query($conn, $sql)) {
                    $questionsSaved = true; // Set flag to true if data is saved successfully
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
            if (isset($_SESSION['update_success']) && $_SESSION['update_success']) {
                // Display the modal via JavaScript
                echo '<script>
                    window.onload = function() {
                        openModal();
                    }
                </script>';
            
                // Unset the session variable to prevent the modal from displaying again on refresh
                unset($_SESSION['update_success']);
            }
            
            // Show the modal after questions are saved
            if ($questionsSaved) {
                echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        openModal();
                    });
                </script>';
            }
        }
 
        
        ?>

        <!-- Modal -->
        <div id="myModalQuestionsSaved" class="modal">

    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p>Questions Saved!</p>
    </div>
</div>

<div id="myModalActivityUpdated" class="modal">

    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p>Activity Updated!</p>
    </div>
</div>
        <div class="question-builder">
        <form id="question-form" method="POST" action="">
                            <div class="container"><br>
                    <input type="hidden" name="question_id" value="<?php echo isset($activityDetails['question_id']) ? $activityDetails['question_id'] : ''; ?>">
                    <label for="activity-name">Activity Name:</label>
                    <input type="text" id="activity-name" name="activity-name" class="custom-ActName" value="<?php echo isset($activityDetails['activity_name']) ? $activityDetails['activity_name'] : ''; ?>">
                </div>
                <div class="container">
    <label for="subject">Subject:</label>
    <select id="subject" name="subject">
        <option value="English">English</option>
        <option value="Mathematics">Mathematics</option>
        <option value="Science">Science</option>
    </select>
</div>
                <!-- Toggle button for question randomization -->
                <div class="container">
                    <label for="randomize-questions">Randomize Questions:</label>
                    <input type="checkbox" id="randomize-questions" name="randomize-questions" <?php echo isset($activityDetails['randomize_questions']) && $activityDetails['randomize_questions'] == 1 ? 'checked' : ''; ?>>
                </div>
                
                <div id="questions-container">
                

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
                        <div class="container">
    <label for="score-1">Score:</label>
    <input type="number" id="score-1" name="score-1" class="custom-ActScore" onchange="fetchScoreFromTextbox(1)">
</div>
                    </div>
                </div>
                <button type="button" onclick="addNewQuestion()" class="btn btn-add-new">Add New Question Set</button>
            <input type="hidden" name="question-count" id="question-count" value="1">
            <button type="submit" name="submit">Save questions</button>
            <button type="submit" name="update" formaction="update_activity.php">Update</button>
    
            </form>
            
        </div>

        <script>
            //  the modal element
            var modal = document.getElementById("myModal");

            //  the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // Function to open the Questions Saved modal
    function openModalQuestionsSaved() {
        var modal = document.getElementById("myModalQuestionsSaved");
        modal.style.display = "block";
    }

    // Function to open the Activity Updated modal
    function openModalActivityUpdated() {
        var modal = document.getElementById("myModalActivityUpdated");
        modal.style.display = "block";
    }

    // Function to close modals
    function closeModal() {
        var modalQuestionsSaved = document.getElementById("myModalQuestionsSaved");
        var modalActivityUpdated = document.getElementById("myModalActivityUpdated");
        
        modalQuestionsSaved.style.display = "none";
        modalActivityUpdated.style.display = "none";
    }

    // Check condition and trigger modals accordingly
    document.addEventListener("DOMContentLoaded", function() {
        <?php
        if (isset($_SESSION['update_success']) && $_SESSION['update_success']) {
            echo 'openModalActivityUpdated();';
            unset($_SESSION['update_success']); // Reset the session variable
        }
        ?>

        <?php
        if ($questionsSaved) {
            echo 'openModalQuestionsSaved();';
        }
        ?>
    });

            //  the modal if the user clicks outside of it
            window.onclick = function(event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            }

                // function to add a new set of question elements
        function addNewQuestion() {
        var questionCount = document.getElementById("question-count");
        var newQuestionCount = parseInt(questionCount.value) + 1;

        // Retrieve the question container template
        var questionSetTemplate = document.querySelector("#questions-container > .container");
        var newQuestionSet = questionSetTemplate.cloneNode(true);

        // Update the question set number and clear input values and radio button selections in the new set
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

        // Update unique IDs and names for new set elements
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

        // Remove existing Score field from the cloned question set
        var existingScoreInput = newQuestionSet.querySelector(".container > .custom-ActScore");
        if (existingScoreInput) {
            existingScoreInput.parentNode.removeChild(existingScoreInput.previousElementSibling); // Remove the label
            existingScoreInput.parentNode.removeChild(existingScoreInput); // Remove the input
        }

        // Append a single Score textbox to the new question set
        var newScoreInput = document.createElement("div");
        newScoreInput.className = "container";
        newScoreInput.innerHTML = '<label for="score-' + newQuestionCount + '">Score:</label>' +
            '<input type="number" id="score-' + newQuestionCount + '" name="score-' + newQuestionCount + '" class="custom-ActScore" value="">';
        newQuestionSet.appendChild(newScoreInput);

        // Append the new question set to the container
        document.getElementById("questions-container").appendChild(newQuestionSet);

        // Update the question count
        questionCount.value = newQuestionCount;
        
        
    }




            const createActivityBtn = document.getElementById("createActivityBtn");
        const libraryBtn = document.getElementById("libraryBtn");
        const leaderboardBtn = document.getElementById("leaderboardBtn");
        const badgesBtn = document.getElementById("badgesBtn");

        // function to open Create Activity page and toggle button styles
        function openCreateActivity() {
        
            window.location.href = "createActEng.php";


            createActivityBtn.classList.remove("active");
            libraryBtn.classList.remove("active");
            leaderboardBtn.classList.remove("active");
            badgesBtn.classList.remove("active");

    
            createActivityBtn.classList.add("active");
        }



            function openLibrary() {
            
                window.location.href = "library.php";
            }

            function openbadgesBtn() {
            
                window.location.href = "sendBadges.php";
            }


                function populateFields() {
            <?php if (!empty($activityDetails)): ?>
                document.getElementById("activity-name").value = "<?php echo $activityDetails['activity_name']; ?>";
                document.getElementById("randomize-questions").checked = <?php echo $activityDetails['randomize_questions'] == 1 ? 'true' : 'false'; ?>;
                
                // Populate the first question set (assuming it's already handled)
                document.getElementById("question-text-1").value = "<?php echo $activityDetails['question_text']; ?>";
                document.getElementById("option-1-1").value = "<?php echo $activityDetails['option_1']; ?>";
                document.getElementById("option-1-2").value = "<?php echo $activityDetails['option_2']; ?>";
                document.getElementById("option-1-3").value = "<?php echo $activityDetails['option_3']; ?>";
                document.getElementById("option-1-4").value = "<?php echo $activityDetails['option_4']; ?>";
                document.getElementById("correct-answer-1-<?php echo $activityDetails['correct_option']; ?>").checked = true;
               
                

                // Append the new question set to the container
                document.getElementById("questions-container").appendChild(newQuestionSet);
        
          <?php endif; ?>
    }
    // Call the function to populate fields when the page loads
    window.onload = function() {
        populateFields();
    };
  

    
    </script>

<script>

    // Modify the JavaScript function to pass the question ID
    function fetchScoreFromTextbox(questionId) {
        var scoreValue = document.getElementById("score-" + questionId).value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log("Score updated for question " + questionId);
                } else {
                    console.error("Error updating score: " + xhr.responseText);
                }
            }
        };
        xhr.open("GET", "record_score.php?scoreValue=" + scoreValue + "&questionId=" + questionId, true);
        xhr.send();
    }

    // Attach the onchange event to the form and listen for changes in any score input
    document.getElementById("question-form").addEventListener("change", function(event) {
        if (event.target.classList.contains("custom-ActScore")) {
            // If the changed element is a score input, extract the question ID from its ID
            let questionId = event.target.id.split("-")[1];
            let scoreValue = event.target.value;

            // Call the function to fetch the score with the respective question ID
            fetchScoreFromTextbox(questionId);
        }
    });


</script>

    </body>
    </html>
