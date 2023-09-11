<?php
session_start();
include("db_conn.php");
$login = false;
$showError = false;

if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username)) {
        header("Location: Login.html?error=Username is required");
        exit();
    } else if (empty($password)) {
        header("Location: Login.html?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM tbl_accdb WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            while($row=mysqli_fetch_assoc($result)){
                if (password_verify($password, $row['password'])){
                    $login = true;
                    $_SESSION['username'] = $row['username'];

                    // Check account type and redirect accordingly
                    switch ($row['account_type']) {
                        case 'Student':
                            header("Location: EDU GAME HUB SYSTEM FILES\Student Game\student\educator profile.html");
                            break;
                        case 'Teacher':
                            header("Location: teacher management system.php");
                            break;
                        case 'Admin':
                            header("Location: index.php");
                            break;
                        default:
                            header("Location: Login.html?error=Unknown account type");
                            break;
                    }
                    exit();
                } else {
                    $showError = true;
                }
            }
        } else {
            $showError = true;
        }

        if ($showError) {
            header("Location: Login.html?error=Incorrect username or password");
            exit();
        }
    }
} else {
    header("Location: Login.html?error=Incorrect username or password");
    exit();
}
?>
