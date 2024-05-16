<?php
/*
officer-add-student-be.php and student addition process in officer
Authors:
  - Lowie Jay Orillo (lowie.jaymier@gmail.com)
  - Caryl Mae Subaldo (subaldomae29@gmail.com)
  - Brian Angelo Bognot (c09651052069@gmail.com)
Last Modified: May 15, 2024
Overview: This file handles the addition of new students, validating officer input and inserting the student into the database.
*/
session_start();
require ('db_conn.php');

if (isset($_POST['addStudent'])) {

    // Function to validate and sanitize user input
    function validate($data)
    {
        $data = trim($data); // Remove whitespace from the beginning and end of string
        $data = stripslashes($data); // Remove backslashes
        $data = htmlspecialchars($data); // Convert special characters to HTML entities
        return $data;
    }

    // Sanitize and validate 
    $accountnumber = validate($_POST['accountnumber']);
    $lastname = validate($_POST['lastname']);
    $firstname = validate($_POST['firstname']);
    $middlename = validate($_POST['middlename']);
    $email = validate($_POST['email']);
    $phonenumber = validate($_POST['phonenumber']);
    $gender = validate($_POST['gender']);
    $yearlevel = validate($_POST['yearlevel']);
    $program = validate($_POST['program']);

    // Convert the names to proper case
    $lastname = ucwords(strtolower($lastnameNotProper));
    $firstname = ucwords(strtolower($firstnameNotProper));
    $middlename = ucwords(strtolower($middlenameNotProper));

    // Remove the spaces of the last name
    $lastnameremovespace = str_replace(' ', '', $lastname);

    // Set the password and hashed it
    $defaultpassword = $lastnameremovespace . $accountnumber;
    $defaulthashed_pass = password_hash($defaultpassword, PASSWORD_BCRYPT);

    // Get the first letter of the first name
    $first_letter = substr($firstname, 0, 1);

    // Get the first letter of the middle name
    $first_letter_middlename = substr($middlename, 0, 1);

    // Generate the code
    $code = strtoupper($lastname . " , " . $firstname . " " . $first_letter_middlename . ". - " . $accountnumber . " - " . $program);

    // Generate the username
    $username = strtolower($first_letter) . strtolower($lastnameremovespace);

    // Set the role to "Student"
    $role = "Student";

    // Get the username of the admin who enrolled the student
    $enrolled_by = $_SESSION['username'];

    // Construct user data string
    $user_data = 'accountnumber=' . $accountnumber .
        '&lastname=' . $lastname .
        '&firstname=' . $firstname .
        '&middlename=' . $middlename .
        '&program=' . $program .
        '&yearlevel=' . $yearlevel .
        '&email=' . $email .
        '&gender=' . $gender .
        '&phonenumber=' . $phonenumber;

    // Validate account number length
    if (strlen($accountnumber) > 10) {
        $error_message = urlencode("Account Number must be 10 characters or less");
        header("Location: ../officer-student-addnew.php?newStudentError=$error_message");
        exit();
    } // Validate account number if empty
    else if (empty($accountnumber)) {
        header("Location: ../officer-student-addnew.php?newStudentError=Account Number is required&$user_data");
        exit();
    } // Validate last name if empty
    elseif (empty($lastname)) {
        header("Location: ../officer-student-addnew.php?newStudentError=Last Name is required&$user_data");
        exit();
    } // Validate first name if empty
    elseif (empty($firstname)) {
        header("Location: ../officer-student-addnew.php?newStudentError=First Name is required&$user_data");
        exit();
    } // Validate program if empty
    elseif (empty($program)) {
        header("Location: ../officer-student-addnew.php?newStudentError=Program is required&$user_data");
        exit();
    } // Validate year level if empty
    elseif (empty($yearlevel)) {
        header("Location: ../officer-student-addnew.php?newStudentError=Year level is required&$user_data");
        exit();
    } // Validate gender if empty
    elseif (empty($gender)) {
        header("Location: ../officer-student-addnew.php?newStudentError=Gender is required&$user_data");
        exit();
    } else {
        // Check if account number already exists
        $sql_check_existing = "SELECT * FROM user WHERE account_number=?";
        $stmt_check_existing = mysqli_prepare($conn, $sql_check_existing);
        mysqli_stmt_bind_param($stmt_check_existing, "s", $accountnumber,);
        mysqli_stmt_execute($stmt_check_existing);
        $result_check_existing = mysqli_stmt_get_result($stmt_check_existing);

        // Validate account number if already exists
        if (mysqli_num_rows($result_check_existing) > 0) {
            header("Location: ../officer-student-addnew.php?newStudentError=Account Number already exists&$user_data");
            exit();
        } else {
            // Insert new student
            $sql_newstudent_query = "INSERT INTO user(account_number, code, password, username, role, last_name, first_name, middle_name, gender, email, phone_number, enrolled_by, year_level, program)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_newstudent_query = mysqli_prepare($conn, $sql_newstudent_query);
            mysqli_stmt_bind_param($stmt_newstudent_query, "ssssssssssssss", $accountnumber, $code, $defaulthashed_pass, $username, $role, $lastname, $firstname, $middlename, $gender,  $email, $phonenumber, $enrolled_by, $yearlevel, $program);
            $result_newstudent_query = mysqli_stmt_execute($stmt_newstudent_query);

            // Redirect based on the result of the SQL query
            if ($result_newstudent_query) {
                header("Location: ../officer-students.php?newStudentSuccess=New Officer account created successfully");
                exit();
            } else {
                header("Location: ../officer-student-addnew.php?newStudentError=Failed to add new student account&$user_data");
                exit();
            }
        }
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>