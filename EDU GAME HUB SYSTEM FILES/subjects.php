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
    <title>Teacher Dashboard</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/subjects.css">
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
            <a href="subjects.php">
              <span class="material-icons-outlined">menu_book</span> Subjects
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="Certificate gen.php">
              <span class="material-icons-outlined"></span> Generate Certificate
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

          
          
      </aside>
      <!-- End Sidebar -->

      
      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">SUBJECTS</p>
        </div>
        <a href="english.html">
        <div class="main-cards">
          <div class="card">
            <div class="card-inner">
              <p class="text-primary">ENGLISH</p>
              <span class="material-icons-outlined text-blue">import_contacts
              </span>
            </div>
          </div>
        </a>
        <a href="math.html">
          <div class="card">
            <div class="card-inner">
              <p class="text-primary">MATHEMATICS</p>
              <span class="material-icons-outlined text-orange">exposure_plus_2
              </menu></span>
            </div>
          </div>
</a>
<a href="science.html">
          <div class="card">
            <div class="card-inner">
              <p class="text-primary">SCIENCE</p>
              <span class="material-icons-outlined text-green">flash_on
              </span>
            </div>
          </div>
            </a>
        </div>
      </main>
</body>
</html>
