<?php

include_once 'db_conn.php';

if(isset($_POST['importSubmit'])){
    

    $csvMimes = array(
        'text/csv', // CSV
        'application/csv', // CSV
        'application/excel', // CSV
        'application/vnd.ms-excel', // .xls
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // .xlsx
        'application/vnd.ms-excel.sheet.macroEnabled.12', // .xlsm
        'application/vnd.ms-excel.sheet.binary.macroEnabled.12', // .xlsb
        'application/vnd.openxmlformats-officedocument.spreadsheetml.template', // .xltx
        'application/vnd.ms-excel.template.macroEnabled.12', // .xltm
        'application/vnd.ms-excel', // .xls
        'application/vnd.ms-excel.template', // .xlt
        'text/xml' // .xml
    );
    
    // validate whether the selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            fgetcsv($csvFile);
            
            while(($line = fgetcsv($csvFile)) !== FALSE){

                $firstname = isset($line[1]) ? $line[1] : '';
                $lastname = isset($line[2]) ? $line[2] : '';
                $email = isset($line[3]) ? $line[3] : '';
                $username = isset($line[4]) ? $line[4] : '';
                $section = isset($line[5]) ? $line[5] : '';
                $grade_level = isset($line[6]) ? $line[6] : '';
                $account_type = isset($line[7]) ? $line[7] : '';
                $password = isset($line[8]) ? $line[8] : '';
                $created_date = isset($line[9]) ? $line[9] : '';

               
                // Check if any of the required fields is empty
                if (empty($firstname) || empty($email) || empty($username) || empty($account_type) || empty($password)) {
                    continue; // Skip this record and proceed to the next one
                }

                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Check whether a member already exists in the database with the same email
                $prevQuery = "SELECT id FROM tbl_accdb WHERE email = '$email'";
                $prevResult = $conn->query($prevQuery);

                if ($prevResult->num_rows > 0) {

                } else {
                    $sql = "INSERT INTO tbl_accdb (firstname, lastname, email, username, section, grade_level, account_type, password, created_date) 
                            VALUES ('$firstname', '$lastname', '$email', '$username', '$section', '$grade_level', '$account_type', '$hashedPassword', NOW())";

                    $run = mysqli_query($conn, $sql);

                    if (!$run) {
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

header("Location: index.php" . $qstring);
?>
