<?php
session_start();
require_once("db_conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $username = $_POST['username'];

    $query = "SELECT birthdate, mother_maiden_name FROM tbl_accdb WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($birthdate, $motherMaidenName);
        $stmt->fetch();

        if (empty($birthdate) || empty($motherMaidenName)) {
            echo 'missing';
            exit();
        }
    }
}

echo 'not_missing';
?>