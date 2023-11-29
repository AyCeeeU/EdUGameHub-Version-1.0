<?php
session_start();
include("db_conn.php");
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
        header("Location: Login1.php?error=Username is required");
        exit();
    } elseif (empty($password)) {
        header("Location: Login1.php?error=Password is required");
        exit(); 
    } else {
        $sql = "SELECT * FROM tbl_accdb WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            if (empty($row['birthdate']) || empty($row['mother_maiden_name'])) {
                $_SESSION['reset_username'] = $username;
                header("Location: Login1.php?resetPassword=true");
                exit();
            }

            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_id'] = $row['id'];

                // Check if the user is an admin and set the session variable
                if ($row['account_type'] === 'Admin') {
                    $_SESSION['admin_logged_in'] = true;
                }

                // The last login date in tbl_activity_log
                $userId = $_SESSION['user_id'];
                $action = "Login";
                $logSql = "INSERT INTO tbl_activity_log (user_id, action, timestamp) VALUES (?, ?, NOW()) 
                            ON DUPLICATE KEY UPDATE timestamp = NOW()";
                $stmt = $conn->prepare($logSql);
                $stmt->bind_param("ss", $userId, $action);
                $stmt->execute();

                switch ($row['account_type']) {
                    case 'Student':
                        header("Location: Student Game/index.php");
                        break;
                    case 'Teacher':
                        header("Location: teacher management system.php");
                        break;
                    case 'Admin':
                        header("Location: index.php");
                        break;
                    default:
                        header("Location: Login1.php?error=Unknown account type");
                        break;
                }
                exit();
            } else {
                $showError = true;
            }
        } else {
            $showError = true;
        }

        if ($showError) {
            header("Location: Login1.php?error=Incorrect username or password");
            exit();
        }
    }
} else {
    header("Location: Login1.php?error=Incorrect username or password");
    exit();
}
?>