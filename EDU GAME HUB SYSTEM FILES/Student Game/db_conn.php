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
}


// Create a connection
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($mysqli->connect_error) {
    die("Database connection error: " . $mysqli->connect_error);
}

?>