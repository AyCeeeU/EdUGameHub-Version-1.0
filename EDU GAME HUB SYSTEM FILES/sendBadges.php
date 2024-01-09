
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
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Send Badges</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/badges.css">
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
                <span class="material-icons-outlined" >dashboard</span> Dashboard
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
            <a href="Login1.php">
            <span class="material-icons-outlined">logout</span> Sign Out
            </a>
        </li>   
    </aside>
    <!-- End Sidebar -->

    <div class="container">
        <h1>Send Badge</h1>
        <div class="badge-selection">
            <img id="badge-preview" src="images/Asset 1.png" alt="Badge Preview">
            <select id="badge-select">  
                <option value="Asset 1.png">Badge 1</option>
                <option value="Asset 2.png">Badge 2</option>
                <option value="Asset 3.png">Badge 3</option>
                <option value="Asset 4.png">Badge 4</option>
            </select>
        </div>
    
        <div class="student-selection">
            <p>Enter Student Name:</p>
            <div id="search-result">
                <input type="text" id="student-name" placeholder="Student Name..." class="text-input" autofocus required>
                <!-- Suggestions will appear here -->
                <div id="suggestions"></div>
            </div>
        </div>

        <div class="message">
            <p>Message:</p>
            <textarea id="message"></textarea>
        </div>
        <button id="send-button">Send Badge</button>
<div id="success-animation">
    <p>Badge Sent Successfully!</p>
</div>
    <!-- Your existing HTML content -->

<!-- Include your JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const badgeSelect = document.getElementById("badge-select");
        const badgePreview = document.getElementById("badge-preview");
        const sendButton = document.getElementById("send-button");
        const successAnimation = document.getElementById("success-animation");

        badgeSelect.addEventListener("change", function () {
            //  badge preview image based on the selected badge
            const selectedBadge = badgeSelect.value;
            badgePreview.src = selectedBadge;
        });

        sendButton.addEventListener("click", function () {
            //  the student name, badge, and message
            const studentName = document.getElementById("student-name").value;
            const badge = badgeSelect.value;
            const message = document.getElementById("message").value;

            const formData = new FormData();
            formData.append("studentName", studentName);
            formData.append("badge", badge);
            formData.append("message", message);

            const xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    successAnimation.style.display = "flex";
                    setTimeout(function () {
                        successAnimation.style.display = "none";
                    }, 3000);
                }
            };

            xhr.open("POST", "sendBadgesTeacher.php", true);
            xhr.send(formData);
        });

        const studentNameInput = document.getElementById("student-name");
        const suggestionsDiv = document.getElementById("suggestions");

        async function fetchSuggestions() {
            const inputValue = studentNameInput.value;

            const response = await fetch('searchBarBadges.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'search=' + inputValue,
            });

            if (response.ok) {
                const studentNames = await response.json();

                suggestionsDiv.innerHTML = "";

                studentNames.forEach(student => {
                    const suggestionItem = document.createElement("div");
                    suggestionItem.textContent = student;
                    suggestionItem.addEventListener("click", () => {
                        studentNameInput.value = student;
                        suggestionsDiv.innerHTML = "";
                    });
                    suggestionsDiv.appendChild(suggestionItem);
                });
            }
        }

        studentNameInput.addEventListener("input", fetchSuggestions);
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

        createActivityBtn.classList.remove("active");
        libraryBtn.classList.remove("active");
        badgesBtn.classList.remove("active");
        badgesBtn.classList.add("active");
    }

    createActivityBtn.addEventListener("click", openCreateActivity);
    libraryBtn.addEventListener("click", openLibrary);
    badgesBtn.addEventListener("click", openBadges);
});
</script>






</body>
</html>
