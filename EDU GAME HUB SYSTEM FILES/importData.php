<?php
// Load the database configuration file
include_once 'db_conn.php';

if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether the selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open the uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line (header)
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $firstname = $line[1];
                $lastname = $line[2];
                $email  = $line[3];
                $username  = $line[4];
                $section  = $line[5];
                $grade_level = $line[6];
                $account_type = $line[7];
                $password = $line[8];
                $created_date = $line[9];

                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Check whether a member already exists in the database with the same email
                $prevQuery = "SELECT id FROM tbl_accdb WHERE email = '$email'";
                $prevResult = $conn->query($prevQuery);

                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    // You can add update logic here if needed
                }else{
                    // Insert member data into the database
                    $sql = "INSERT INTO tbl_accdb (firstname, lastname, email, username, section, grade_level, account_type, password, created_date) 
                    VALUES ('$firstname', '$lastname', '$email', '$username', '$section', '$grade_level', '$account_type', '$hashedPassword', NOW())";
                    
                    $run = mysqli_query($conn,$sql);

                    if(!$run){
                        // Handle the insertion error, such as logging or displaying an error message
                        echo "Error inserting data: " . mysqli_error($conn);
                    }
                }
            }
            
            // Close the opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page with the appropriate query string
header("Location: index.php".$qstring);
?>
