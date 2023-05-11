<?php
include("db_conn.php");
?>


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
    <link rel="stylesheet" href="css/dashboard.css">
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
      <?php
      // retrieve count of students
      $sql = "SELECT COUNT(*) AS count FROM tbl_accdb WHERE account_type='Student'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $student_count = $row['count'];

      // retrieve count of subjects
      $sql = "SELECT COUNT(*) AS count FROM tbl_subjects";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $subject_count = $row['count'];

      // retrieve count of completed activities
      $sql = "SELECT completedAct FROM tbl_activity WHERE ID = 1"; // assuming ID 1 is the relevant row
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $completedAct = $row['completedAct'];


      ?>


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

      <!-- Main -->
<main class="main-container">
  <div class="main-title">
    <p class="font-weight-bold">DASHBOARD</p>
  </div>

  <div class="main-cards">

    <div class="card">
      <div class="card-inner">
        <p class="text-primary">STUDENTS</p>
        <span class="material-icons-outlined text-blue">groups</span>
      </div>
      <span class="text-primary font-weight-bold"><?php echo $student_count; ?></span>
    </div>

    <div class="card">
      <div class="card-inner">
        <p class="text-primary">SUBJECTS</p>
        <span class="material-icons-outlined text-orange">menu_book</menu></span>
      </div>
      <span class="text-primary font-weight-bold"><?php echo $subject_count; ?></span>
    </div>

    <div class="card">
      <div class="card-inner">
        <p class="text-primary">COMPLETED ACTIVITIES</p>
        <span class="material-icons-outlined text-green">task</span>
      </div>
      <span class="text-primary font-weight-bold"><?php echo $completedAct; ?></span>
    </div>

  </div>
<?php

// Retrieve data from tbl_recentact
$sql = "SELECT itemname, date, status, subject FROM tbl_recentact";
$result = mysqli_query($conn, $sql);

?>
  <div class="charts">
  <div class="charts-card">
    <p class="chart-title">RECENT ACTIVITIES</p>
    <div id="bar-chart"></div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Item Name</th>
          <th>Date</th>
          <th>Status</th>
          <th>Subject</th>
        </tr>
      </thead>
      <tbody>
        
        <?php
        // Loop through the result set and output each row as a table row
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row["itemname"] . "</td>";
          echo "<td>" . $row["date"] . "</td>";
          echo "<td>" . $row["status"] . "</td>";
          echo "<td>" . $row["subject"] . "</td>";
          echo "</tr>";
        }

        // Close database connection
        mysqli_close($conn);
        ?>
      </tbody>
    </table>
  </div>
</div>
</main>
<!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="js/script.js"></script>
  </body>
</html>