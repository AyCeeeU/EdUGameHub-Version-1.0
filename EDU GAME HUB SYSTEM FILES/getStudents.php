<?php
header('Content-Type: application/json');
require_once "sqlFetchingQuery.php";
$tableController = new tableController();

if (isset($_GET['param'])) {
        if ($_GET['param'] == "studentsInfo") {
                $studentList = $tableController->fetchAllStudents();
                $jsonStudentList = json_encode($studentList);
                echo $jsonStudentList;
        }
        if ($_GET['param'] == 'studentsCertificate') {
                $data = $_GET['data'];
                $insertStudentCert = $tableController->sendStudentCert($data['studentId'], $data['certSubject'], $data['studentFullName']);
                $jsonSuccesfulInsert = json_encode($insertStudentCert);
                echo $jsonSuccesfulInsert;
        }
}

