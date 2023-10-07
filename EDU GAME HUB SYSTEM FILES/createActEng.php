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

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $activity_name = $_POST["activity-name"];
        $question_text = $_POST["question-text"];
        $option_1 = $_POST["option-1"];
        $option_2 = $_POST["option-2"];
        $option_3 = $_POST["option-3"];
        $option_4 = $_POST["option-4"];
        $correct_option = $_POST["correct-option"];

        // SQL query to insert data into the table
        $sql = "INSERT INTO tbl_multiple_teacher (activity_name, question_text, option_1, option_2, option_3, option_4, correct_option)
                VALUES ('$activity_name', '$question_text', '$option_1', '$option_2', '$option_3', '$option_4', '$correct_option')";

        // Execute the SQL query
        if (mysqli_query($conn, $sql)) {
            echo '<script> 
                // Show the modal when data is saved
                document.getElementById("myModal").style.display = "block";
            </script>';
        } else {
            echo '<script> alert("Data Not saved."); </script>';
        }
    }
    ?>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Question Saved!</p>
        </div>
    </div>

    <div class="question-builder">
        <form id="question-form" method="POST" action="">
            <div class="container"><br>
                <label for="activity-name">Activity Name:</label>
                <input type="text" id="activity-name" name="activity-name" class="custom-ActName">
            </div>
            <div class="container">
                <!-- Wider question text box -->
                <label for="question-text">Question:</label>
                <textarea id="question-text" name="question-text" class="custom-Question" rows="5"></textarea>
            </div>
            <div class="options-container">
                <!-- Two options text boxes on the left -->
                <div class="container">
                    <label for="option-1">Option 1:</label>
                    <input type="text" id="option-1" name="option-1" class="custom-OptA">
                    <div class="checkbox-container">
                        <input type="radio" id="correct-answer-1" name="correct-option" value="1">
                        <label for="correct-answer-1">Correct answer</label>
                    </div>
                </div>
                <div class="container">
                    <label for="option-2">Option 2:</label>
                    <input type="text" id="option-2" name="option-2" class="custom-OptB">
                    <div class="checkbox-container">
                        <input type="radio" id="correct-answer-2" name="correct-option" value="2">
                        <label for="correct-answer-2">Correct answer</label>
                    </div>
                </div>
            </div>
            <div class="options-container">
                <!-- Options 3 and 4 on the right -->
                <div class="container">
                    <label for="option-3">Option 3:</label>
                    <input type="text" id="option-3" name="option-3" class="custom-OptC">
                    <div class="checkbox-container">
                        <input type="radio" id="correct-answer-3" name="correct-option" value="3">
                        <label for="correct-answer-3">Correct answer</label>
                    </div>
                </div>
                <div class="container">
                    <label for="option-4">Option 4:</label>
                    <input type="text" id="option-4" name="option-4" class="custom-OptD">
                    <div class="checkbox-container">
                        <input type="radio" id="correct-answer-4" name="correct-option" value="4">
                        <label for="correct-answer-4">Correct answer</label>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit">Save question</button>
        </form>
    </div>
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
</script>
</body>
</html>
