<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous" referrerpolicy="no-referrer">
          
    <title>EduGameHub</title>
</head>
<body>
    <header>
        <div class="header">
        <img id="notification-icon" src="notif.png" alt="Notification Icon" onclick="showNotifications()">

            <div class="gameLogo">
                <img src="Gamelogo.png" alt="edugamehub Logo" width="400"/>
            </div>
            <div class="logoutLogo">
            <a href="../logout.php"><img src="logout.png" class="logoutImage"></a>
            </div>
        </div>
    </header>
    
    <!-- Messages Popup -->
    <div id="popup-container">
        <span id="close-popup" onclick="closePopup()">&times;</span>
        <h2>Messages</h2>
        <ul id="messages-list">
            <!-- Messages will be added here dynamically -->
        </ul>
    </div>
    <div class="container">
        <div class="card1">
            <h2>Badge</h2>
            
          View the badges you've earned through completed tasks!
         
          <p><a href="Badges.php">Proceed</a></p>

        </div>
        <div class="card2">
  <h2>Play EduGame!</h2>
  <a href="student welcome.html" class="button-3d">
    <img src="PlayButton.png" alt="Play Button">
  </a>
</div>
        <div class="card3">
            <h2>Certificates</h2>
           
                Check the certificates you earned by completing this semester!
          
           <p> <a href="Certificates.php">Proceed</a></p>
        </div>
    </div>

    <audio id="background-music" loop autoplay>
    <source src="MainMenu.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

    <?php
// Assuming you have a database connection established
// Include your database connection script (db_conn.php) with the new path
include('db_conn.php');

session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    // Check if the database connection is successful
    if ($conn) {
        // Fetch the user's profile picture path from the database
        $sql = "SELECT profile_pic FROM tbl_accdb WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($profile_pic);
        $stmt->fetch();
        $stmt->close();

        // Profile picture is retrieved, or use a default if not found
        if (!empty($profile_pic)) {
            $profilePicSrc = $profile_pic;
        } else {
            $profilePicSrc = 'image.jpg'; // Use a default image
        }
    } else {
        echo "Database connection failed.";
    }
}
?>
<!-- PROFILE PIC -->
<form action="upload_profile_pic.php" method="post" enctype="multipart/form-data">
    <div class="profile-pic-div">
        <img src="<?php echo $profilePicSrc; ?>" id="photo" >
        <input type="file" name="file" id="file">
        <label for="file" id="uploadBtn">Choose Photo</label>
    </div>
    <input type="submit" name="upload" value="Upload" id="uploadSubmit" class="centered-button">
</form>



 <!-- Welcome User! Section -->
 <div class="welcome-section">
        <?php
   

        // Check if the user is logged in
        if (isset($_SESSION['user_id'])) {
            // Include your database connection script (db_conn.php) with the new path
            include('db_conn.php');

            // Get the user's ID from the session
            $userId = $_SESSION['user_id'];

            // Check if the database connection is successful
            if ($conn) {
                // Fetch user information from tbl_accdb
                $sql = "SELECT firstname, lastname, email, section, grade_level, account_type, profile_pic FROM tbl_accdb WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $stmt->bind_result($firstname, $lastname, $email, $section, $grade_level, $account_type, $profile_pic);
                $stmt->fetch();
                $stmt->close();

                echo '<div class="user-info-container">';
                echo "<h1>Welcome, $firstname $lastname!</h1>";
                echo '<div class="user-details">';
                echo "<p>Section: $section</p>";
                echo "<p>$grade_level</p>";
                echo '</div>';
                echo '</div>';
                
              
                
            } else {
                echo "Database connection failed.";
            }
        } else {
            echo "You are not logged in. Please log in to see your information.";
        }
    ?>
</div>
<div class="background">
    <!-- Add more shapes -->
    <div class="shape triangle" style="top: 20vh; left: 15vw;"></div>
    <div class="shape square" style="top: 40vh; left: 50vw;"></div>
    <div class="shape circle" style="top: 70vh; left: 10vw;"></div>
    <div class="shape triangle" style="top: 10vh; left: 70vw;"></div>
    <div class="shape square" style="top: 60vh; left: 80vw;"></div>
    <div class="shape circle" style="top: 30vh; left: 25vw;"></div>
    <div class="shape triangle" style="top: 20vh; left: 15vw;"></div>
    <div class="shape square" style="top: 40vh; left: 50vw;"></div>
    <div class="shape circle" style="top: 70vh; left: 10vw;"></div>
    <div class="shape triangle" style="top: 10vh; left: 70vw;"></div>
    <div class="shape square" style="top: 60vh; left: 80vw;"></div>
    <div class="shape circle" style="top: 30vh; left: 25vw;"></div>
    <div class="shape triangle" style="top: 20vh; left: 15vw;"></div>
    <div class="shape square" style="top: 40vh; left: 50vw;"></div>
    <div class="shape circle" style="top: 70vh; left: 10vw;"></div>
    <div class="shape triangle" style="top: 10vh; left: 70vw;"></div>
    <div class="shape square" style="top: 60vh; left: 80vw;"></div>
    <div class="shape circle" style="top: 30vh; left: 25vw;"></div>
    <!-- Add more shapes as needed -->
  </div>

<script>
    // Declaring HTML elements
    const imgDiv = document.querySelector('.profile-pic-div');
    const img = document.querySelector('#photo');
    const file = document.querySelector('#file');
    const uploadBtn = document.querySelector('#uploadBtn');
    const uploadSubmit = document.querySelector('#uploadSubmit');

    // If the user hovers on img div
    imgDiv.addEventListener('mouseenter', function () {
        uploadBtn.style.display = "block";
    });

    // If we hover out from img div
    imgDiv.addEventListener('mouseleave', function () {
        uploadBtn.style.display = "none";
    });

    // Let's work on the image showing functionality when we choose an image to upload
    // When we choose a photo to upload
    file.addEventListener('change', function () {
        // This refers to the file
        const choosedFile = this.files[0];

        if (choosedFile) {
            const reader = new FileReader(); // FileReader is a predefined function in JavaScript
            
            reader.addEventListener('load', function () {
                img.setAttribute('src', reader.result);
                uploadSubmit.style.display = "block"; // Show the submit button

                // Send the selected image path to the server
                fetch('upload_profile_pic.php', {
                    method: 'POST',
                    body: new FormData(document.querySelector('form')),
                })
                .then(response => response.text())
                .then(data => {
                    if (data) {
                        img.setAttribute('src', data); // Update the displayed image source
                    }
                });
            }); // This was missing
            reader.readAsDataURL(choosedFile);
        }
    });

    // Function to display messages in a pop-up
    function showNotifications() {
            // Fetch and display messages (You can fetch from your server/database)
            // For demonstration, we'll add dummy messages
            var messages = ['Message 1'];

            // Show the popup container
            document.getElementById('popup-container').style.display = 'block';

            // Display the messages in the pop-up
            var messagesList = document.getElementById('messages-list');
            messagesList.innerHTML = ''; // Clear existing messages

            messages.forEach(function (message) {
                var listItem = document.createElement('li');
                listItem.textContent = message;
                messagesList.appendChild(listItem);
            });
        }

        // Function to close the popup
        function closePopup() {
            // Hide the popup container
            document.getElementById('popup-container').style.display = 'none';
        }



        const backgroundMusic = document.getElementById('background-music');

// Function to play background music
function playBackgroundMusic() {
    backgroundMusic.play(); // Start playing the audio
    backgroundMusic.muted = false; // Unmute the audio
    localStorage.setItem('backgroundMusic', 'playing'); // Store the state in localStorage
    
}

// Check if the audio was playing before the page refresh
const bgMusicState = localStorage.getItem('backgroundMusic');
if (bgMusicState === 'playing') {
    playBackgroundMusic(); // Call the function to start playing the audio if the state is 'playing'
}

// Add an event listener to listen for the user interaction and play audio
document.addEventListener('click', function () {
    // This event listener will trigger audio playback on any user interaction
    // e.g., clicking anywhere on the page
    if (backgroundMusic.paused) {
        playBackgroundMusic(); // Call the function to start playing the audio
    }
});

// Add an event listener to listen for the page unload and store the playback state
window.addEventListener('beforeunload', function () {
    if (!backgroundMusic.paused) {
        localStorage.setItem('backgroundMusic', 'playing');
    } else {
        localStorage.setItem('backgroundMusic', 'paused');
    }
});
</script>



</body>
</html>     