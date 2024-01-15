<?php
session_start();
include("db_conn.php");

// Check if the user is logged in and is a teacher
if (!isset($_SESSION['username']) || $_SESSION['account_type'] !== 'Teacher') {  
    header("HTTP/1.0 403 Forbidden");
    header("Location: Login1.php");
    exit;
}

// Default sort order
$sortOrder = "asc";

if (isset($_GET["sort_order"])) {
    // Check for the selected sort order (asc or desc)
    $sortOrder = $_GET["sort_order"];
}

// Initialize grade_level filter
$gradeLevelFilter = "";

if (isset($_GET["grade_level"])) {
    $gradeLevelFilter = $_GET["grade_level"];
}

// Initialize section filter
$sectionFilter = "";

if (isset($_GET["section"])) {
    $sectionFilter = $_GET["section"];
}

// Retrieve students from the database and order by last name
$sql = "SELECT * FROM tbl_accdb WHERE account_type = 'Student'";

if ($gradeLevelFilter !== "") {
    $sql .= " AND grade_level = '$gradeLevelFilter'";
}

if ($sectionFilter !== "") {
    $sql .= " AND section = '$sectionFilter'";
}

if ($sortOrder === "asc") {
    $sql .= " ORDER BY lastname ASC";
} elseif ($sortOrder === "desc") {
    $sql .= " ORDER BY lastname DESC";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/students.css">

    <script>
        function openSidebar() {
            document.getElementById("sidebar").style.width = "250px";
        }

        function closeSidebar() {
            document.getElementById("sidebar").style.width = "0";
        }
    </script>
</head>
<body>
    <div class="grid-container">

        <!-- Header -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
           
            <div class="header-right">
                <span class="material-icons-outlined">notifications</span>
                <span class="material-icons-outlined">email</span>
                <span class="material-icons-outlined">account_circle</span>
            </div>
        </header>
        <!-- End Header>

        <!-- Sidebar -->
        <aside id="sidebar">
            <img class="logo" src="images/edugamelogo.png" alt="logo">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <!-- Sidebar content here -->
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
                    <a href="subjects.php">
                        <span class="material-icons-outlined">menu_book</span> Activities
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
            </ul>
        </aside>
        <!-- End Sidebar -->

        <!-- Main Content -->
        <div class="main-content">
            <div class="container-filters">
                <div class="filters">
                    <form method="get" action="">
                        <label for="sort_order">Sort by Last Name:</label>
                        <select name="sort_order" id="sort_order">
                            <option value="asc" <?php if ($sortOrder === "asc") echo "selected"; ?>>Ascending</option>
                            <option value="desc" <?php if ($sortOrder === "desc") echo "selected"; ?>>Descending</option>
                        </select>

                        <label for="gradelevel">Filter by Grade Level:</label>
                        <select name="grade_level" id="gradelevel">
                            <option value="">All</option>
                            <option value="Grade 3" <?php if (isset($_GET["grade_level"]) && $_GET["grade_level"] === "Grade 3") echo "selected"; ?>>Grade 3</option>
                            <option value="Grade 4" <?php if (isset($_GET["grade_level"]) && $_GET["grade_level"] === "Grade 4") echo "selected"; ?>>Grade 4</option>
                            <option value="Grade 5" <?php if (isset($_GET["grade_level"]) && $_GET["grade_level"] === "Grade 5") echo "selected"; ?>>Grade 5</option>
                            <option value="Grade 6" <?php if (isset($_GET["grade_level"]) && $_GET["grade_level"] === "Grade 6") echo "selected"; ?>>Grade 6</option>
                        </select>

                        <label for="section">Filter by Section:</label>
                        <select name="section" id="section">
                            <option value="">All</option>
                            <option value="Saphire" <?php if (isset($_GET["section"]) && $_GET["section"] === "Saphire") echo "selected"; ?>>Saphire</option>
                            <option value="Mercury" <?php if (isset($_GET["section"]) && $_GET["section"] === "Mercury") echo "selected"; ?>>Mercury</option>
                            <option value="Venus" <?php if (isset($_GET["section"]) && $_GET["section"] === "Venus") echo "selected"; ?>>Venus</option>
                            <option value="Saturn" <?php if (isset($_GET["section"]) && $_GET["section"] === "Saturn") echo "selected"; ?>>Saturn</option>
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
                        <th>Grade Level</th>
                        <th>Section</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Display students in the selected sort order
                    while ($row = mysqli_fetch_assoc($result)) {
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
        <!-- End Main Content -->
    </div>
</body>
</html>
