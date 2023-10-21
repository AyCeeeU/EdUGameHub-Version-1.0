<?php
// Include your database connection script
include('db_conn.php');

// checking if the form was submitted
if (isset($_POST['deleteFromArchive'])) { 

    $recordId = $_POST['deleteId'];

    // query to delete the record from tbl_archive
    $deleteSql = "DELETE FROM tbl_archive WHERE id = $recordId";    


    if (mysqli_query($conn, $deleteSql)) {
        //  deleted successfully from archive
        echo '<script>alert("Record deleted from archive.");</script>';
        header('Location: archive.php'); 
        exit();
    } else {
        // error deleting the record from tbl_archive
        echo '<script>alert("Error deleting record from archive: ' . mysqli_error($conn) . '");</script>';
        header('Location: archive.php'); 
        exit();
    }
} else {
   
    echo '<script>alert("Invalid request.");</script>';
    header('Location: archive.php'); 
    exit();
}

?>
