<?php
// Include your database connection script
include('db_conn.php');

// Check if the form was submitted
if (isset($_POST['deleteFromArchive'])) { // Updated to check for deleteFromArchive
    // Get the record ID from the form
    $recordId = $_POST['deleteId'];

    // Create a query to delete the record from tbl_archive
    $deleteSql = "DELETE FROM tbl_archive WHERE id = $recordId";    

    // Execute the query
    if (mysqli_query($conn, $deleteSql)) {
        // Record deleted successfully from archive
        echo '<script>alert("Record deleted from archive.");</script>';
        header('Location: archive.php'); // Redirect back to the archive page
        exit();
    } else {
        // Error deleting the record from tbl_archive
        echo '<script>alert("Error deleting record from archive: ' . mysqli_error($conn) . '");</script>';
        header('Location: archive.php'); // Redirect back to the archive page with an error message
        exit();
    }
} else {
    // Invalid request
    echo '<script>alert("Invalid request.");</script>';
    header('Location: archive.php'); // Redirect back to the archive page with an error message
    exit();
}

?>
