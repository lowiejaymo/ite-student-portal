<?php
session_start();

include "db_conn.php"; // include the database script to establish a connection with the database

// check if the fields in the form are set
if (isset($_POST['login'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $role = validate($_POST['role']);
    $accountnumber = validate($_POST['accountnumber']);
    $password = validate($_POST['password']);

    $user_data = 'role=' . $role . '&accountnumber=' . $accountnumber;

    if (empty($accountnumber)) {
        header("Location: ../login.php?login-error=Account is required&$user_data");
        exit();
    } elseif (empty($password)) {
        header("Location: ../login.php?login-error=Password is required&$user_data");
        exit();
    } else {
        $sql = "SELECT * FROM user WHERE account_number=? AND role=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $accountnumber, $role);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['account_indx'] = $row['account_indx'];
                $_SESSION['account_number'] = $row['account_number'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['position'] = $row['position'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['middle_name'] = $row['middle_name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['phone_number'] = $row['phone_number'];
                $_SESSION['profile_picture'] = $row['profile_picture'];
                $_SESSION['gender'] = $row['gender'];

                // Redirect based on user role
                if ($role == "Admin") {
                    header("Location: ../admin-dashboard.php");
                    exit;
                } elseif ($role == "Officer") {
                    header("Location: ../officer-dashboard.php");
                    exit;
                } elseif ($role == "Student") {
                    header("Location: ../dashboard.php");
                    exit;
                }
            } else {
                header("Location: ../login.php?login-error=Incorrect User name or Password&$user_data");
                exit;
            }
        } else {
            header("Location: ../login.php?login-error=User not found, please contact your officer.&$user_data");
            exit;
        }
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>