<?php

include_once 'db_conn.php';

if(isset($_POST['importSubmit'])){
    

    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // validate whether the selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            fgetcsv($csvFile);
            
            while(($line = fgetcsv($csvFile)) !== FALSE){

                $firstname = $line[1];
                $lastname = $line[2];
                $email  = $line[3];
                $username  = $line[4];
                $section  = $line[5];
                $grade_level = $line[6];
                $account_type = $line[7];
                $password = $line[8];
                $created_date = $line[9];

                // Hash  password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Checking whether a member already exists in the database with the same email
                $prevQuery = "SELECT id FROM tbl_accdb WHERE email = '$email'";
                $prevResult = $conn->query($prevQuery);

                if($prevResult->num_rows > 0){
             
                }else{
                    $sql = "INSERT INTO tbl_accdb (firstname, lastname, email, username, section, grade_level, account_type, password, created_date) 
                    VALUES ('$firstname', '$lastname', '$email', '$username', '$section', '$grade_level', '$account_type', '$hashedPassword', NOW())";
                    
                    $run = mysqli_query($conn,$sql);

                    if(!$run){
                        echo "Error inserting data: " . mysqli_error($conn);
                    }
                }
            }
            
            fclose($csvFile);

            $qstring = '?status=succ';
        } else {
            $qstring = '?status=err';
        }
    } else {
        $qstring = '?status=invalid_file';
    }
}

header("Location: index.php".$qstring);
?>
