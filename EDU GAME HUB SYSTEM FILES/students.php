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
    <link rel="stylesheet" href="css/students.css">
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
            <a href="students.html">
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

       // retrieve students from database
        $sql = "SELECT * FROM tbl_accdb WHERE account_type ='Student'";
        $result = mysqli_query($conn, $sql);
        
        ?>
<div class="container-filters">
  <div class="filters">
    <!-- filter elements -->
    <div class="filters">
      <form method="get" action="">
        <label for="grade_level">Filter by Grade Level:</label>
        <select name="grade_level" id="grade_level">
          <option value="">All</option>
          <option value="1">Grade 1</option>
          <option value="2">Grade 2</option>
          <option value="3">Grade 3</option>
        </select>

        <label for="section">Filter by Section:</label>
        <select name="section" id="section">
          <option value="">All</option>
          <option value="A">Section A</option>
          <option value="B">Section B</option>
          <option value="C">Section C</option>
        </select>

        <button type="submit">Filter</button>
      </form>
    </div>
  </div>
  <table>
      <thead>
        <tr>
          
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Grade Level</Section></th>
          <th>Section</Section></th>
        </tr>
      </thead>
      <tbody>
        <?php
          // loop through results and display each student in a row
          while ($row = mysqli_fetch_assoc($result)) {
            // apply filters if any are set
            if (!empty($_GET["grade_level"]) && $row["grade_level"] != $_GET["grade_level"]) {
              continue;
            }
            if (!empty($_GET["section"]) && $row["section"] != $_GET["section"]) {
              continue;
            }

            // display student data
            echo "<tr>";
            echo "<td>" . $row["firstname"] . "</td>";
            echo "<td>" . $row["lastname"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["grade_level"] . "</td>";
            echo "<td>" . $row["section"] . "</td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
</div>
      
       </body> 
       </html>
