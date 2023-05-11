<?php

    // Insert the content of connection.php file
    include('db_conn.php');
    
    // Insert data into the database
    if(ISSET($_POST['insertData']))
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $section = $_POST['section'];
        $grade_level = $_POST['grade_level'];
        $account_type = $_POST['account_type'];
        $password = $_POST['password'];
        $created_date = $_POST['created_date'];



        $password = hash("sha256", $password);

        $sql = "INSERT INTO tbl_accdb (firstname, lastname, email, section, grade_level, account_type, password, created_date) 
        VALUES ('$firstname', '$lastname', '$email', '$section', '$grade_level', '$account_type', '$password', NOW())";
       
        $result = mysqli_query($conn, $sql);

        if($result){
            echo '<script> alert("Data saved."); </script>';
            header('Location: index.php');
        }else{
            echo '<script> alert("Data Not saved."); </script>';
        }
    }
?>