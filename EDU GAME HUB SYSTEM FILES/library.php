
<?php
session_start();
include("db_conn.php");

// Check if the user is logged in and is a teacher
if (!isset($_SESSION['username']) || $_SESSION['account_type'] !== 'Teacher') {  
    header("HTTP/1.0 403 Forbidden");
    header("Location: Login1.php");
    exit;
}
?>


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
            <button class="btn btn-secondary" id="badgesBtn">Badges</button>
            <button class="btn btn-secondary" id="certificateBtn">Certificate</button>
            
           
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

    $sql = "SELECT DISTINCT activity_name FROM tbl_multiple_teacher"; // Fetch distinct activity names
    $result = mysqli_query($conn, $sql);

    // Checking if there are activities to display
    if (mysqli_num_rows($result) > 0) {
        $activities = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $activities = array(); // No activities found
    }
    ?>
<?php
    // function to update the Visible to Students status
    function updateVisibleStatus($conn, $activityId, $status) {
        $sql = "UPDATE tbl_multiple_teacher SET visible_students = '$status' WHERE question_id = $activityId";
        return mysqli_query($conn, $sql);
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
                        <th>Visible to Students</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($activities as $activity): ?>
                            <?php
                             $activityName = $activity['activity_name'];
                             $sqlQuestions = "SELECT * FROM tbl_multiple_teacher WHERE activity_name = '$activityName'";
                             $resultQuestions = mysqli_query($conn, $sqlQuestions);
                            ?>

<?php if (mysqli_num_rows($resultQuestions) > 0): ?>
                                        <?php while ($activityDetails = mysqli_fetch_assoc($resultQuestions)): ?>
                                    <tr>
                                        <td><?php echo $activityDetails['activity_name']; ?></td>
                                        <td>
                                            <!-- Modify as per your requirements for displaying visibility checkbox -->
                                            <form class="visibility-form">
                                            <input type="checkbox" class="visible-checkbox" data-activity-id="<?php echo $activityDetails['question_id']; ?>" <?php echo $activityDetails['visible_students'] === '1' ? 'checked' : ''; ?>>
                                                <input type="hidden" name="activityId" value="<?php echo $activityDetails['question_id']; ?>">
                                            </form>
                                        </td>
                                        <td>
                                        <button class="deleteBtn" data-activity-id="<?php echo htmlspecialchars($activityDetails['question_id'], ENT_QUOTES); ?>">Delete Activity</button>
                                            <a href="createActEng.php?edit=<?php echo $activityDetails['question_id']; ?>">
                                                <button>Edit Activity</button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">No questions available for this activity</td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No activities found.</p>
            <?php endif; ?>
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

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>

    
    $(document).ready(function () {
            $('.visibility-form').on('change', '.visible-checkbox', function () {
                var activityId = $(this).data('activity-id');
                var visibleStatus = this.checked ? '1' : '0';

                $.ajax({
                    type: 'POST',
                    url: 'update_visibility.php',
                    data: { activityId: activityId, visibleStatus: visibleStatus },
                    success: function (response) {
                        console.log('Visibility updated successfully.');
                    },
                    error: function (error) {
                        console.error('Error updating visibility: ' + error);
                    }
                });
            });
        });


    document.addEventListener("DOMContentLoaded", function () {
    const createActivityBtn = document.getElementById("createActivityBtn");
    const libraryBtn = document.getElementById("libraryBtn");
    const leaderboardBtn = document.getElementById("leaderboardBtn");
    const badgesBtn = document.getElementById("badgesBtn");

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

        createActivityBtn.classList.remove("active");
        libraryBtn.classList.remove("active");
        leaderboardBtn.classList.remove("active");
        badgesBtn.classList.remove("active");

        libraryBtn.classList.add("active");
    }

    function openLeaderboard() {
        window.location.href = "engLeaderboard.php";

        createActivityBtn.classList.remove("active");
        libraryBtn.classList.remove("active");
        leaderboardBtn.classList.remove("active");
        badgesBtn.classList.remove("active");

        leaderboardBtn.classList.add("active");
    }

    function openBadges() {
     
        window.location.href = "sendBadges.php"; 

        // Remove active class from all buttons
        createActivityBtn.classList.remove("active");
        libraryBtn.classList.remove("active");
        badgesBtn.classList.remove("active");
        // Add active class to the clicked button
        badgesBtn.classList.add("active");
    }

    // Attach click event listeners to the buttons
    createActivityBtn.addEventListener("click", openCreateActivity);
    libraryBtn.addEventListener("click", openLibrary);
    badgesBtn.addEventListener("click", openBadges);
});
// Get all delete buttons with the class "deleteBtn"
const deleteButtons = document.querySelectorAll('.deleteBtn');

// Loop through each delete button to attach a click event listener
deleteButtons.forEach(button => {
    button.addEventListener('click', function() {
        // Get the data-activity-id attribute value (question_id)
        const questionId = this.getAttribute('data-activity-id');

        // Redirect to delete_activity.php with the question_id as a query parameter
        window.location.href = `delete_activity.php?delete=${questionId}`;
    });
});
</script>
</body>
</html>
