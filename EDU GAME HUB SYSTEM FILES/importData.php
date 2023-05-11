<?php
// Load the database configuration file
include_once 'db_conn.php';

if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $firstname = $line[1];
                $lastname = $line[2];
                $email  = $line[3];
                $section  = $line[4];
                $grade_level = $line[5];
                $account_type = $line[6];
                $password = $line[7];
                $created_date = $line[8];

            

                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT id FROM tbl_accdb WHERE email = '$email'";
                $prevResult = $conn->query($prevQuery);
                // echo $prevResult->num_rows;
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                }else{
                    // Insert member data in the database
                    $sql = "INSERT INTO tbl_accdb (firstname, lastname, email, section, grade_level, account_type, password, created_date) 
                    VALUES ('$firstname', '$lastname', '$email', '$section', '$grade_level', '$account_type', '$password', NOW())";
                    // echo $sql;
                    $run = mysqli_query($conn,$sql);
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location: index.php".$qstring);