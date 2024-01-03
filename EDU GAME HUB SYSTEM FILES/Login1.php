  <!DOCTYPE html>
  <html>
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>
    <link rel="stylesheet" href="Login.css">
    
  </head>
  <body>
  <img class="logo" src="images/edugamelogoblack.png" alt="logo">

    <header>
    <audio id="hoverSoundNav">
  <source src="HoverButtonSFX.mp3" type="audio/mpeg">
</audio>

<audio id="hoverSoundLogin">
  <source src="OnHoverSFX.mp3" type="audio/mpeg">
  <source src="OffHoverSFX.mp3" type="audio/mpeg">
</audio>

<audio id="hoverSoundResetOn" src="OnHoverSFXReset.mp3" type="audio/mpeg"></audio>
<audio id="hoverSoundResetOff" src="OffHoverSFXReset.mp3" type="audio/mpeg"></audio>


      <nav>
        <ul class="nav_links">
          <li><a href="home.php">Home</a></li>
          <li><a href="">About Us</a></li>
          <?php
  session_start();

  // Include the file containing the database connection
  require_once("db_conn.php");

  if (isset($_SESSION['username'])) {
      if (isset($mysqli) && !$mysqli->connect_error) {
          $username = $_SESSION['username'];

          // Fetch account_type from tbl_accdb based on the username
          $query = "SELECT account_type FROM tbl_accdb WHERE username = '$username'";
          $result = $mysqli->query($query);

          if ($result && $result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $accountType = $row['account_type'];

            

              echo '<li>';
              switch ($accountType) {
                  case 'Teacher':
                      echo '<a href="teacher management system.php">Welcome, ' . $_SESSION['username'] . '</a>';
                      break;
                  case 'Student':
                      echo '<a href="Student Game/index.php">Welcome, ' . $_SESSION['username'] . '</a>';
                      break;
                  case 'Admin':
                      echo '<a href="index.php">Welcome, ' . $_SESSION['username'] . '</a>';
                      break;
                  default:
                      echo '<a href="default_page.php">Welcome, ' . $_SESSION['username'] . '</a>';
                      break;
              }
              echo '</li>';
              echo '<li><a href="logout.php">Logout</a></li>';
          } 
      } 
  } else {
      // DEBUG: Output an error message if the username is not set in the session
    
      echo '<li><a href="Login1.php" class="active">Log In</a></li>';
  }
  ?>


 

  
        </ul>
      </nav>
    </header>

    <?php
      if (isset($_SESSION['username'])) {
        echo '<div class="flex-container">';
        echo '<div class="container">';
        echo '<img class="homepageBG" src="images/homepage.jpg" alt="homepageBG">';
        echo '</div>';
        echo '<div class="welcome-message">';
        echo '<form><h2>Hello!, ' . $_SESSION['username'] . '</h2>';
        echo '<p><br>Welcome back! 🌟 Let\'s continue your educational journey together.</p>';
        echo '</div>';
        echo '</div>';
      } else {
    ?>
      <form method="POST" action="login.php" onsubmit="return validateLoginForm()">
      <h2 class="login-heading"><center>Log In</center></h2>
      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" id="username" required>
      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" id="password" required>
      <button id="loginButton">Log In</button>
      <div class="forgot-password">
        <a href="javascript:void(0);" onclick="openModal()">Reset / Forgot Password</a>
      </div>
    </form>
    <div class="container">
      <img class="homepageBG" src="images/homepage.jpg" alt="homepageBG">
    </div>
    <?php
  }
  ?>


  <!-- Password Reset Modal -->
  <div id="passwordResetModal" class="modal" style="display: none;">
    <div class="modal-content">
      
      <form id="passwordResetForm">
      <span class="close" onclick="closeModal()">&times;</span>
      <center><h2>Reset Your Password</h2></center>
        <label for="reset-username"><b>Username</b></label>
        <input type="text" id="reset-username" placeholder="Enter Username" name="username" required>
        <label for="reset-email"><b>Email</b></label>
        <input type="text" id="reset-email" placeholder="Enter Email" name="email" required>
        <label for="reset-newPassword"><b>New Password</b></label>
        <input type="password" id="reset-newPassword" placeholder="Enter New Password" name="newPassword" required>
        <label for="db-mother-maiden-name"><b>Registered Mother's Maiden Name</b></label>
        <input type="text" id="db-mother-maiden-name" placeholder="Enter Registered Mother's Maiden Name" name="dbMotherMaidenName" required>
        <label for="db-birthdate"><b>Registered Birthdate</b></label>
        <input type="date" id="db-birthdate" name="dbBirthdate" required>
        <p id="missingFieldsMessage" style="color: red; display: none;"><br>Please update your Birthdate and Mother's Maiden Name in your profile to proceed with the password reset.</p>

        <button type="button" data-action="reset-password" onclick="resetPassword()">Reset Password</button>
      </form>
    </div>
  </div>


  <script>
    function validateLoginForm() {
      const username = document.getElementById('username').value.trim();
      const password = document.getElementById('password').value.trim();

      if (username === '' || password === '') {
        alert('Username and password are required');
        return false; // Prevent form submission
      }

      return true; // Allow form submission
    }

    function openModal() {
      document.getElementById('passwordResetModal').style.display = 'block';
    }

    function closeModal() {
      document.getElementById('passwordResetModal').style.display = 'none';
    }

    function resetPassword() {
  const username = document.getElementById('reset-username').value;
  const email = document.getElementById('reset-email').value;
  const newPassword = document.getElementById('reset-newPassword').value;
  const dbMotherMaidenName = document.getElementById('db-mother-maiden-name').value;
  const dbBirthdate = document.getElementById('db-birthdate').value;


  
  if (username && email && newPassword) {
    if (!dbMotherMaidenName && !dbBirthdate) {
      // If both mother's maiden name and birthdate are null or empty, proceed with password reset
      const xhr2 = new XMLHttpRequest();
      xhr2.open('POST', 'reset_password.php', true);
      xhr2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr2.onreadystatechange = function () {
        if (xhr2.readyState === 4 && xhr2.status === 200) {
          const response2 = xhr2.responseText;
          alert(response2);
          if (response2.includes('Password reset successful')) {
            window.location.href = 'Login1.php';
          }
        }
      };
      xhr2.send(`username=${username}&email=${email}&newPassword=${newPassword}&motherMaidenName=${dbMotherMaidenName}&birthdate=${dbBirthdate}`);
    } else {
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'check_user_data.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          const response = xhr.responseText;
          if (response.trim() === 'match') {
            // Proceed with password reset if birthdate and mother's maiden name are provided in the database
            const xhr2 = new XMLHttpRequest();
            xhr2.open('POST', 'reset_password.php', true);
            xhr2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr2.onreadystatechange = function () {
              if (xhr2.readyState === 4 && xhr2.status === 200) {
                const response2 = xhr2.responseText;
                alert(response2);
                if (response2.includes('Password reset successful')) {
                  window.location.href = 'Login1.php';
                }
              }
            };
            xhr2.send(`username=${username}&email=${email}&newPassword=${newPassword}&motherMaidenName=${dbMotherMaidenName}&birthdate=${dbBirthdate}`);
          } else {
            alert('Entered credentials do not match our records.');
          }
        }
      };
      xhr.send(`username=${username}&motherMaidenName=${dbMotherMaidenName}&birthdate=${dbBirthdate}`);
    }
   
  } else {
    alert('Please fill in all required fields.');
  }
}

    function displayMissingFieldsMessage() {
      document.getElementById('missingFieldsMessage').style.display = 'block';
    }

    // Code to check missing fields and trigger modal with message
    window.onload = function () {
    const urlParams = new URLSearchParams(window.location.search);
    const resetPasswordFlag = urlParams.get('resetPassword');
    const resetUsername = "<?php echo isset($_SESSION['reset_username']) ? $_SESSION['reset_username'] : ''; ?>";

    if (resetPasswordFlag === 'true' && resetUsername !== '') {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'check_missing_fields.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = xhr.responseText;
                if (response === 'missing') {
                    openModal();
                    displayMissingFieldsMessage();
                } else {
                    const dbMotherMaidenName = document.getElementById('db-mother-maiden-name').value.trim();
                    const dbBirthdate = document.getElementById('db-birthdate').value.trim();

                    if (dbMotherMaidenName === '' && dbBirthdate === '') {
                        // For accounts with empty maiden name and birthdate, allow login without verification
                        window.location.href = 'Login.php'; // Redirect to login page
                    } else {
                        // For accounts with provided maiden name and birthdate, proceed with verification
                        const xhr2 = new XMLHttpRequest();
                        xhr2.open('POST', 'check_user_data.php', true);
                        xhr2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr2.onreadystatechange = function () {
                            if (xhr2.readyState === 4 && xhr2.status === 200) {
                                // Handle the database response accordingly
                            }
                        };
                        xhr2.send(`username=${resetUsername}&motherMaidenName=${dbMotherMaidenName}&birthdate=${dbBirthdate}`);
                    }
                }
            }
        };
        xhr.send(`username=${resetUsername}`);
    }
};

document.addEventListener("DOMContentLoaded", function() {
  const resetButton = document.querySelector('[data-action="reset-password"]');
  const hoverSoundResetOn = document.getElementById('hoverSoundResetOn');
  const hoverSoundResetOff = document.getElementById('hoverSoundResetOff');

  resetButton.addEventListener('mouseenter', function() {
    hoverSoundResetOn.currentTime = 0;
    hoverSoundResetOn.volume = 0.3;
    hoverSoundResetOn.play();
    // Additional actions/styles when hovering over the reset button
    resetButton.style.backgroundColor = '#3e8e41';
    // ...
  });

  resetButton.addEventListener('mouseleave', function() {
    hoverSoundResetOff.currentTime = 0;
    hoverSoundResetOff.volume = 0.3;
    hoverSoundResetOff.play();
    // Additional actions/styles when leaving the reset button
    resetButton.style.backgroundColor = '#1B2072';
    // ...
  });
});
document.addEventListener("DOMContentLoaded", function() {
  const hoverSoundNav = document.getElementById('hoverSoundNav');
  const hoverSoundLogin = document.getElementById('hoverSoundLogin');
  const loginButton = document.getElementById('loginButton');

 
  loginButton.addEventListener('mouseenter', function() {
    hoverSoundLogin.src = "OnHoverSFX.mp3";
    hoverSoundLogin.currentTime = 0; // Reset the audio to the beginning
    hoverSoundLogin.volume = 0.3; // Set the volume to 50%
    hoverSoundLogin.play();
    loginButton.style.backgroundColor = '#3e8e41';
    loginButton.style.boxShadow = 'inset 0 -4px 0 0 rgba(0, 0, 0, 0.2)';
  });

  loginButton.addEventListener('mouseleave', function() {
    hoverSoundLogin.src = "OffHoverSFX.mp3";
    hoverSoundLogin.currentTime = 0; // Reset the audio to the beginning
    hoverSoundLogin.volume = 0.3; // Set the volume to 50%
    hoverSoundLogin.play();
    loginButton.style.backgroundColor = '#1B2072';
    loginButton.style.boxShadow = '#5860DE 0px 7px 0px';
  });

  loginButton.addEventListener('click', function() {
    window.location.href = 'Login1.php'; // Redirect to Login1.php on click
  });

  // Add event listener to play hover sound for nav buttons
  const navLinks = document.querySelectorAll('nav ul li a');

  navLinks.forEach(link => {
    link.addEventListener('mouseenter', function() {
      hoverSoundNav.currentTime = 0; // Reset the audio to the beginning
      hoverSoundNav.play();
    });
  });
});

  </script>
</body>
</html>