<?php
/*
admin-officer-delete-be.php and officer deletion process in admin
Authors:
  - Lowie Jay Orillo (lowie.jaymier@gmail.com)
  - Caryl Mae Subaldo (subaldomae29@gmail.com)
  - Brian Angelo Bognot (c09651052069@gmail.com)
Last Modified: May 15, 2024
Overview: This file handles the deletion of officers.
*/
session_start();
require ('db_conn.php');

if (isset($_POST['deleteOfficer'])) {

    // Function to validate and sanitize user input
    function validate($data)
    {
        $data = trim($data); // Remove whitespace from the beginning and end of string
        $data = stripslashes($data); // Remove backslashes
        $data = htmlspecialchars($data); // Convert special characters to HTML entities
        return $data;
    }

    // Sanitize and validate
    $account_number = validate($_POST['account_number']);
    $username = validate($_POST['username']);
    $position = validate($_POST['position']);
    $last_name = validate($_POST['last_name']);
    $first_name = validate($_POST['first_name']);
    $middle_name = validate($_POST['middle_name']);

    // Delete the officer
    $delete_officer_query = "DELETE FROM user WHERE account_number = ? AND username = ? AND position = ? AND last_name = ? AND first_name = ? AND middle_name = ?";
    $delete_officer_stmt = mysqli_prepare($conn, $delete_officer_query);
    mysqli_stmt_bind_param($delete_officer_stmt, "ssssss", $account_number, $username, $position, $last_name, $first_name, $middle_name);
    mysqli_stmt_execute($delete_officer_stmt);
    $affected_rows = mysqli_stmt_affected_rows($delete_officer_stmt);

    // Redirect based on the result of the SQL query
    if ($affected_rows > 0) {
        header("Location: ../admin-officer.php?deleteOfficerSuccess=Successfully deleted the announcement");
        exit();
    } else {
        header("Location: ../admin-officer.php?deleteOfficerSuccess=Failed to delete the announcement");
        exit();
    }

} else {
    header("Location: ../login.php");
    exit();
}
?>