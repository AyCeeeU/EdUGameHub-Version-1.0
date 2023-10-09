<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Library</title>
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/library.css">
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
            <button class="btn btn-secondary" id="libraryBtn">Library</button>
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

// Fetch activities created by the teacher
$sql = "SELECT * FROM tbl_multiple_teacher";
$result = mysqli_query($conn, $sql);

// Check if there are activities to display
if (mysqli_num_rows($result) > 0) {
    $activities = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $activities = array(); // No activities found
}
?>

    <div class="library-container">
        <center><h1>My Library</h1></center>
        <div class="activity-list">
            <?php if (!empty($activities)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Activity Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($activities as $activity): ?>
                            <tr>
                                <td><?php echo $activity['activity_name']; ?></td>
                                <td>
                                <button class="viewBtn" data-toggle="modal" data-target="#viewActivityModal"
                                    data-activity-name="<?php echo htmlspecialchars($activity['activity_name'], ENT_QUOTES); ?>"
                                    data-question-text="<?php echo htmlspecialchars($activity['question_text'], ENT_QUOTES); ?>"
                                    data-option-1="<?php echo htmlspecialchars($activity['option_1'], ENT_QUOTES); ?>"
                                    data-option-2="<?php echo htmlspecialchars($activity['option_2'], ENT_QUOTES); ?>"
                                    data-option-3="<?php echo htmlspecialchars($activity['option_3'], ENT_QUOTES); ?>"
                                    data-option-4="<?php echo htmlspecialchars($activity['option_4'], ENT_QUOTES); ?>"
                                    data-correct-option="<?php echo htmlspecialchars($activity['correct_option'], ENT_QUOTES); ?>"
                                    data-randomizer="<?php echo isset($activity['randomizer']) ? htmlspecialchars($activity['randomizer'], ENT_QUOTES) : ''; ?>">
                                    View Activity
                                </button>
                                    <a href="editActivity.php?id=<?php echo $activity['question_id']; ?>"><button>Edit Activity</button></a>
                                    <button onclick="publishActivity(<?php echo $activity['question_id']; ?>)">Publish</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No activities found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal for Viewing Activity -->
<div class="modal fade" id="viewActivityModal" tabindex="-1" role="dialog" aria-labelledby="viewActivityModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewActivityModalLabel">Activity Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>Activity Name:</td>
                        <td id="viewActivityName"></td>
                    </tr>
                    <tr>
                        <td>Question:</td>
                        <td id="viewQuestion"></td>
                    </tr>
                    <tr>
                        <td>Option 1:</td>
                        <td id="viewOption1"></td>
                    </tr>
                    <tr>
                        <td>Option 2:</td>
                        <td id="viewOption2"></td>
                    </tr>
                    <tr>
                        <td>Option 3:</td>
                        <td id="viewOption3"></td>
                    </tr>
                    <tr>
                        <td>Option 4:</td>
                        <td id="viewOption4"></td>
                    </tr>
                    <tr>
                        <td>Correct Option:</td>
                        <td id="viewCorrectOption"></td>
                    </tr>
                    <tr>
                        <td>Randomizer:</td>
                        <td id="viewRandomizer"></td>
                    </tr>
                </table>
            </div>
            
        </div>
    </div>
</div>

<!-- Include jQuery before Bootstrap JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
<!-- Bootstrap JavaScript should come after jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

<!-- Your JavaScript code goes here -->
<script>
    $(document).ready(function () {
        $('.viewBtn').on('click', function () {
            $('#viewActivityModal').modal('show');

            // Retrieve data from the clicked button's data attributes
            var activityName = $(this).data('activity-name');
            var questionText = $(this).data('question-text');
            var option1 = $(this).data('option-1');
            var option2 = $(this).data('option-2');
            var option3 = $(this).data('option-3');
            var option4 = $(this).data('option-4');
            var correctOption = $(this).data('correct-option');
            var randomizer = $(this).data('randomizer');
            
            // Fetch randomize_questions value from the database
            var randomizeQuestions = <?php echo isset($activity['randomize_questions']) ? $activity['randomize_questions'] : '0'; ?>;
            var randomizerText = randomizeQuestions === 1 ? 'ON' : 'OFF'; // Set ON if randomize_questions is 1, otherwise set OFF

            // Populate modal content with the retrieved data
            $('#viewActivityName').text(activityName);
            $('#viewQuestion').text(questionText);
            $('#viewOption1').text(option1);
            $('#viewOption2').text(option2);
            $('#viewOption3').text(option3);
            $('#viewOption4').text(option4);
            $('#viewCorrectOption').text(correctOption);
            $('#viewRandomizer').text(randomizerText); // Display ON/OFF
        });
    });
</script>

</body>
</html>
