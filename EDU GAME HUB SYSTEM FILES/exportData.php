<<<<<<< Updated upstream
<?php
=======
<?php 
 

include_once 'db_conn.php'; 
 
//  records from database 
$query = $conn->query("SELECT * FROM tbl_accdb ORDER BY id ASC"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "members-data_" . date('Y-m-d') . ".csv"; 
     

    $f = fopen('php://memory', 'w'); 
     
    $fields = array('ID', 'FIRST NAME', 'LAST NAME', 'EMAIL', 'USERNAME', 'SECTION', 'GRADE LEVEL', 'ACCOUNT TYPE', 'PASSWORD', 'CREATED DATE'); 
    fputcsv($f, $fields, $delimiter); 
     
   
    while($row = $query->fetch_assoc()){ 
        
        $lineData = array($row['id'], $row['firstname'], $row['lastname'], $row['email'], $row['username'], $row['section'], $row['grade_level'], $row['account_type'], $row['password'], $row['created_date']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    fseek($f, 0); 
     
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    fpassthru($f); 
} 
exit; 
 
>>>>>>> Stashed changes

include_once 'db_conn.php';

// Records from the database
$query = $conn->query("SELECT id, firstname, lastname, email, username, section, grade_level, account_type, created_date FROM tbl_accdb ORDER BY id ASC");

if ($query->num_rows > 0) {
    $delimiter = ",";
    $filename = "members-data_" . date('Y-m-d') . ".csv";

    $f = fopen('php://memory', 'w');

    $fields = array('ID', 'FIRST NAME', 'LAST NAME', 'EMAIL', 'USERNAME', 'SECTION', 'GRADE LEVEL', 'ACCOUNT TYPE', 'CREATED DATE');
    fputcsv($f, $fields, $delimiter);

    while ($row = $query->fetch_assoc()) {
        $lineData = array($row['id'], $row['firstname'], $row['lastname'], $row['email'], $row['username'], $row['section'], $row['grade_level'], $row['account_type'], $row['created_date']);
        fputcsv($f, $lineData, $delimiter);
    }

    fseek($f, 0);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    fpassthru($f);
}
exit;
?>
