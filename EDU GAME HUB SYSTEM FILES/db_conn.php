<?php
$db_host = "localhost";
$db_user = "u362789267_edugame1234";
$db_pass = "Edugame1234567";
$db_name = "u362789267_egh_accountsdb";

// Create a connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (!$conn){
    echo "Connection Failed!";
} else {
    // Set the character set and collation
    if (!mysqli_set_charset($conn, "utf8mb4")) {
        printf("Error loading character set utf8mb4: %s\n", mysqli_error($conn));
        exit();
    }
}

// Create a connection using object-oriented style
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($mysqli->connect_error) {
    die("Database connection error: " . $mysqli->connect_error);
} else {
    // Set the character set and collation
    if (!$mysqli->set_charset("utf8mb4")) {
        printf("Error loading character set utf8mb4: %s\n", $mysqli->error);
        exit();
    }
}
?>
