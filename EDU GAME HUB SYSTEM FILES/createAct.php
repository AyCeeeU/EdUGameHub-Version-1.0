


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Teaher Dashboard</title>

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
          <span class="material-icons-outlined">search</span>
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

          
          
      </aside>

                  
      <!-- End Sidebar -->
      <?php

include('db_conn.php');

if(ISSET($_POST['submit'])) {
  $activity_name = $_POST["activity-name"];
  $question_text = $_POST["question-text"];
  $option_1 = $_POST["option-1"];
  $option_2 = $_POST["option-2"];
  $option_3 = $_POST["option-3"];
  $option_4 = $_POST["option-4"];
  $correct_answer = $_POST["correct-answer"];

  $sql = "INSERT INTO tbl_createact (activity_name, question_text, option_1, option_2, option_3, option_4, correct_answer)
          VALUES ('$activity_name', '$question_text', '$option_1', '$option_2', '$option_3', '$option_4', '$correct_answer')";
  $result = mysqli_query($conn, $sql);

  if($result){
      echo '<script> alert("Data saved."); </script>';
      header('Location: createAct.php');
  }else{
      echo '<script> alert("Data Not saved."); </script>';
  }
 
}

?>

          <div class="question-builder">
          <div class="container">
  <h2>Select Quarter:</h2>

  <div class="select-box">
    <div class="options-container">
      <div class="option">
        <input type="radio" class="radio" id="q1" name="category" />
        <label for="q1">First Quarter</label>
      </div>

      <div class="option">
        <input type="radio" class="radio" id="q2" name="category" />
        <label for="q2">Second Quarter</label>
      </div>

      <div class="option">
        <input type="radio" class="radio" id="q3" name="category" />
        <label for="q3">Third Quarter</label>
      </div>

      <div class="option">
        <input type="radio" class="radio" id="q4" name="category" />
        <label for="q4">Fourth Quarter</label>
      </div>

    </div>

    <div class="selected">
      Select Quarter
    </div>

  </div>
</div>


<div class="container">
<h2>Select Subject:</h2>

<div class="select-box">
  <div class="options-container">
    <div class="option">
      <input type="radio" class="radio" id="q1" name="category" />
      <label for="q1">English</label>
    </div>

    <div class="option">
      <input type="radio" class="radio" id="q2" name="category" />
      <label for="q2">Mathematics</label>
    </div>

    <div class="option">
      <input type="radio" class="radio" id="q3" name="category" />
      <label for="q3">Science</label>
    </div>
  </div>

  <div class="selected">
    Select Quarter
  </div>

</div>
</div>  

            
  <form method="POST" action="createAct.php">
    <label for="activity-name">Activity Name:</label>
    <input type="text" id="activity-name" name="activity-name">
    <label for="question-text">Question:</label>
    <input type="text" id="question-text" name="question-text">
    <div class="option-container">
      <label for="option-1">Option 1:</label>
      <input type="text" id="option-1" name="option-1">
      <div class="checkbox-container">
        <input type="checkbox" id="correct-answer-1" name="correct-answer" value="1">
        <label for="correct-answer-1">Correct answer</label>
      </div>
    </div>
    <div class="option-container">
      <label for="option-2">Option 2:</label>
      <input type="text" id="option-2" name="option-2">
      <div class="checkbox-container">
        <input type="checkbox" id="correct-answer-2" name="correct-answer" value="2">
        <label for="correct-answer-2">Correct answer</label>
      </div>
    </div>
    <!-- add more option fields as needed -->
    <div class="option-container">
      <label for="option-3">Option 3:</label>
      <input type="text" id="option-3" name="option-3">
      <div class="checkbox-container">
        <input type="checkbox" id="correct-answer-3" name="correct-answer" value="3">
        <label for="correct-answer-3">Correct answer</label>
      </div>
    </div>
    <div class="option-container">
      <label for="option-4">Option 4:</label>
      <input type="text" id="option-4" name="option-4">
      <div class="checkbox-container">
        <input type="checkbox" id="correct-answer-4" name="correct-answer" value="4">
        <label for="correct-answer-4">Correct answer</label>
      </div>
    </div>
    <button type="submit" name="submit">Save question</button>
  </form>
</div>    
<script src="create act.js"></script>
   </body> 
   </html>
    
      
