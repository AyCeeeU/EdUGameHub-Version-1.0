<?php
require_once "controller.php";
class tableController extends Controller
{
    function fetchAllStudents()
    {
        $this->setStatement("SELECT id,firstname,lastname FROM `tbl_accdb` WHERE account_type = 'Student'");
        $this->statement->execute();
        return $this->statement->fetchAll();
    }
    function fetchCurrentStudentsCert($userId)
    {
        $this->setStatement("SELECT * FROM `tbl_cert` WHERE student_id = :userId");
        $this->statement->execute([':userId' => $userId]);
        return $this->statement->fetchAll();
    }
    function sendStudentCert($studentId, $certSubject, $studentFullName)
    {
        $this->setStatement("INSERT into `tbl_cert`(student_id,cert_subject,full_name) VALUES (:studentId,:certSubject,:studentFullName)");
        return $this->statement->execute([':studentId' => $studentId, ':certSubject' => $certSubject, ':studentFullName' => $studentFullName]);
    }
}
