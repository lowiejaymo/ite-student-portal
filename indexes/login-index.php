<?php
/*
login_process.php and User Login Process
Authors:
  - Lowie Jay Orillo (lowie.jaymier@gmail.com)
  - Caryl Mae Subaldo (subaldomae29@gmail.com)
  - Brian Angelo Bognot (c09651052069@gmail.com)
Last Modified: May 15, 2024
Overview: This file contains the PHP script for processing user login credentials and redirecting based on user role.
*/
session_start();

include "db_conn.php"; // include the database script to establish a connection with the database

// check if the fields in the form are set
if (isset($_POST['login'])) {

    // Function to validate and sanitize user input
    function validate($data)
    {
        $data = trim($data); // Remove whitespace from the beginning and end of string
        $data = stripslashes($data); // Remove backslashes
        $data = htmlspecialchars($data); // Convert special characters to HTML entities
        return $data;
    }

    // Sanitize and validate 
    $role = validate($_POST['role']);
    $accountnumber = validate($_POST['accountnumber']);
    $password = validate($_POST['password']);

    // Construct user data string
    $user_data = 'role=' . $role . '&accountnumber=' . $accountnumber;

    // Validate account number if empty
    if (empty($accountnumber)) {
        header("Location: ../login.php?login-error=Account is required&$user_data");
        exit();
    } // Validate password if empty
    elseif (empty($password)) {
        header("Location: ../login.php?login-error=Password is required&$user_data");
        exit();
    } else {

        // Select account based on account number and role
        $sql = "SELECT * FROM user WHERE account_number=? AND role=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $accountnumber, $role);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Validate account if exists
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // Validate if input password and stored password is equal
            if (password_verify($password, $row['password'])) {

                if ($row['is_verified'] == 0) {
                    // Account is not verified
                    $_SESSION['verify'] = true;
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['account_number'] = $row['account_number'];
                    header("Location: ../verify-email.php");
                    exit;
                }

                $_SESSION['account_number'] = $row['account_number'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['position'] = $row['position'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['middle_name'] = $row['middle_name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['new_email'] = $row['new_email'];
                $_SESSION['program'] = $row['program'];
                $_SESSION['phone_number'] = $row['phone_number'];
                $_SESSION['profile_picture'] = $row['profile_picture'];
                $_SESSION['gender'] = $row['gender'];
                $_SESSION['code'] = $row['code'];

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