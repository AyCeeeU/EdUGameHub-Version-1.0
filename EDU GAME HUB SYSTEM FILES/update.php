<?php

    // Insert the content of connection.php file
    include('db_conn.php');

    // Update data into the database
    if(ISSET($_POST['updateData']))
    {   
        $id = $_POST['updateId'];
        $firstname = $_POST['updateFirstname'];
        $lastname = $_POST['updateLastname'];
        $email = $_POST['updateEmail'];
        $section = $_POST['updateSection'];
        $grade_level = $_POST['updateGradeLevel'];
        $account_type = $_POST['updateAccountType'];
        $password = $_POST['updatePassword'];
        $created_date = $_POST['updateCreatedDate'];


      

        $sql = "UPDATE `tbl_accdb` SET `firstname` = '$firstname',
                                `lastname` = '$lastname',
                                `email` = '$email',
                                `section` = '$section',
                                `grade_level` = '$grade_level',
                                `account_type` = '$account_type',
                                `password` = '$password',
                                `created_date` = '$created_date'
                            WHERE id='$id'";
        

        $result = mysqli_query($conn, $sql);

        if($result)
        {
            echo '<script> alert("Data Updated Successfully."); </script>';
            header("Location:index.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>