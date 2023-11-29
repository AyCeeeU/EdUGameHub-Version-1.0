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
    include('db_conn.php');

    // activities created by the teacher
    $sql = "SELECT * FROM tbl_multiple_teacher";
    $result = mysqli_query($conn, $sql);

    // Checking if there are activities to display
    if (mysqli_num_rows($result) > 0) {
        $activities = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $activities = array(); // No activities found
    }

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
                            <tr>
                                <td><?php echo $activity['activity_name']; ?></td>
                                <td>
                                    <form class="visibility-form">
                                        <input type="checkbox" class="visible-checkbox" data-activity-id="<?php echo $activity['question_id']; ?>" <?php echo $activity['visible_students'] === '1' ? 'checked' : ''; ?>>
                                        <input type="hidden" name="activityId" value="<?php echo $activity['question_id']; ?>">
                                    </form>
                                </td>
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
        window.location.href = "engLeaderboard.html";

        createActivityBtn.classList.remove("active");
        libraryBtn.classList.remove("active");
        leaderboardBtn.classList.remove("active");
        badgesBtn.classList.remove("active");

        leaderboardBtn.classList.add("active");
    }

    function openBadges() {
     
        window.location.href = "sendBadges.html"; 

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

</script>
</body>
</html>
