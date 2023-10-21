<?php

    include('db_conn.php');
    
    if(ISSET($_POST['insertData']))
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $section = $_POST['section'];
        $grade_level = $_POST['grade_level'];
        $account_type = $_POST['account_type'];
        $password = $_POST['password'];
        $created_date = $_POST['created_date'];



        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO tbl_accdb (firstname, lastname, email, username, section, grade_level, account_type, password, created_date) 
        VALUES ('$firstname', '$lastname', '$email','$username', '$section', '$grade_level', '$account_type', '$hash', NOW())";
       
        $result = mysqli_query($conn, $sql);

        if($result){
            echo '<script> alert("Data saved."); </script>';
            header('Location: index.php');
        }else{
            echo '<script> alert("Data Not saved."); </script>';
        }
    }
    
?>