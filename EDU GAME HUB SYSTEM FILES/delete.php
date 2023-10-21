<?php


    include('db_conn.php');

    if(ISSET($_POST['deleteData']))
    {
        $id = $_POST['deleteId']; 

        $sql = "DELETE FROM tbl_accdb WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo '<script> alert("Data Deleted."); </script>';
            header('Location: index.php');
        }else{
            echo '<script> alert("Data Not Deleted."); </script>';
        }
    }
    
?>