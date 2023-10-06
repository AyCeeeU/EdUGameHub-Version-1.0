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

     

    </div>

    <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="js/script.js"></script>
    
  </body>
</html>