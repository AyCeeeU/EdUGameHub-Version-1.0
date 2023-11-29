<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EduGame Hub</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="home.css">
</head>
  
<body>                                                                                
  <header>
    <img class="logo" src="images/edugamelogoblack.png" alt="logo">
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

  <div class="container">
    <img class="note" src="homeBG.png" alt="book" height="300px">
  </div>
</body>
</html>
