<?php
/*
admin-add-officer-be.php and officer addition process in admin
Authors:
  - Lowie Jay Orillo (lowie.jaymier@gmail.com)
  - Caryl Mae Subaldo (subaldomae29@gmail.com)
  - Brian Angelo Bognot (c09651052069@gmail.com)
Last Modified: May 15, 2024
Overview: This file handles the addition of new officers, validating admin input and inserting the officer into the database.
*/

session_start();
require ('db_conn.php');

if (isset($_POST['addOfficer'])) {

    // Function to validate and sanitize user input
    function validate($data)
    {
        $data = trim($data); // Remove whitespace from the beginning and end of string
        $data = stripslashes($data); // Remove backslashes
        $data = htmlspecialchars($data); // Convert special characters to HTML entities
        return $data;
    }

    $accountnumber = validate($_POST['accountnumber']);
    $code = validate($_POST['code']);
    $position = validate($_POST['position']);
    $lastnameNotProper = validate($_POST['lastname']);
    $firstnameNotProper = validate($_POST['firstname']);
    $middlenameNotProper = validate($_POST['middlename']);
    $email = validate($_POST['email']);
    $phonenumber = validate($_POST['phonenumber']);
    $gender = validate($_POST['gender']);

    $lastname = ucwords(strtolower($lastnameNotProper));
    $firstname = ucwords(strtolower($firstnameNotProper));
    $middlename = ucwords(strtolower($middlenameNotProper));

    $defaultpassword = "officer123";
    $defaulthashed_pass = password_hash($defaultpassword, PASSWORD_BCRYPT);

    $first_letter = substr($firstname, 0, 1);

    $username = strtolower($first_letter) . strtolower($lastname);

    $role = "Officer";
    $code = mt_rand(10000, 99999);


    $enrolled_by = $_SESSION['username'];
    $user_data = 'accountnumber=' . $accountnumber .
        '&position=' . $position .
        '&lastname=' . $lastname .
        '&firstname=' . $firstname .
        '&middlename=' . $middlename .
        '&email=' . $email .
        '&phonenumber=' . $phonenumber .
        '&gender=' . $gender;


    // Validate account number length
    if (strlen($accountnumber) > 11) {
        $error_message = urlencode("Account Number must be 11 characters or less");
        header("Location: ../admin-officer-addnew.php?newOfficerError=$error_message");
        exit();
    } else if (empty($accountnumber)) {
        header("Location: ../admin-officer-addnew.php?newOfficerError=Account Number is required$user_data");
        exit();
    } elseif (empty($position)) {
        header("Location: ../admin-officer-addnew.php?newOfficerError=Position is required&$user_data");
        exit();
    } elseif (empty($lastname)) {
        header("Location: ../admin-officer-addnew.php?newOfficerError=Last Name is required&$user_data");
        exit();
    } elseif (empty($firstname)) {
        header("Location: ../admin-officer-addnew.php?newOfficerError=First Name is required&$user_data");
        exit();
    } elseif (empty($gender)) {
        header("Location: ../admin-officer-addnew.php?newOfficerError=Gender is required&$user_data");
        exit();
    } else {
        // Check if account number or username already exists
        $sql_check_existing = "SELECT * FROM user WHERE account_number=?";
        $stmt_check_existing = mysqli_prepare($conn, $sql_check_existing);
        mysqli_stmt_bind_param($stmt_check_existing, "s", $accountnumber, );
        mysqli_stmt_execute($stmt_check_existing);
        $result_check_existing = mysqli_stmt_get_result($stmt_check_existing);

        if (mysqli_num_rows($result_check_existing) > 0) {
            header("Location: ../admin-officer-addnew.php?newOfficerError=Account Number already exists&$user_data");
            exit();
        } else {
            // Insert new officer
            $sql_newofficer_query = "INSERT INTO user(account_number, code, password, username, role, position, last_name, first_name, middle_name, gender, email, phone_number, enrolled_by)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_newofficer_query = mysqli_prepare($conn, $sql_newofficer_query);
            mysqli_stmt_bind_param($stmt_newofficer_query, "sssssssssssss", $accountnumber, $code, $defaulthashed_pass, $username, $role, $position, $lastname, $firstname, $middlename, $gender, $email, $phonenumber, $enrolled_by);
            $result_newofficer_query = mysqli_stmt_execute($stmt_newofficer_query);

            if ($result_newofficer_query) {
                header("Location: ../admin-officer.php?newOfficerSuccess=New Officer account created successfully");
                exit();
            } else {
                // Log detailed error information
                $error_message = "Failed to add new officer account: " . mysqli_error($conn);
                error_log($error_message);
                header("Location: ../admin-officer-addnew.php?newOfficerError=" . urlencode($error_message) . "&$user_data");
                exit();
            }
        }
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>