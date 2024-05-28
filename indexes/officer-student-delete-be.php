<?php
/*
officer-student-delete-be.php and student deletion process in officer
Authors:
  - Lowie Jay Orillo (lowie.jaymier@gmail.com)
  - Caryl Mae Subaldo (subaldomae29@gmail.com)
  - Brian Angelo Bognot (c09651052069@gmail.com)
Last Modified: May 28, 2024
Overview: This file handles the deletion of student.
*/
session_start();
require ('db_conn.php');

if (isset($_POST['deleteStudent'])) {

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
    $program = validate($_POST['program']);
    $year_level = validate($_POST['year_level']);
    $last_name = validate($_POST['last_name']);
    $first_name = validate($_POST['first_name']);
    $middle_name = validate($_POST['middle_name']);

    // Delete the student
    $delete_student_query = "DELETE FROM user WHERE account_number = ? AND username = ? AND program = ? AND year_level = ? AND last_name = ? AND first_name = ? AND middle_name = ?";
    $delete_student_stmt = mysqli_prepare($conn, $delete_student_query);
    mysqli_stmt_bind_param($delete_student_stmt, "sssssss", $account_number, $username, $program, $year_level, $last_name, $first_name, $middle_name);
    mysqli_stmt_execute($delete_student_stmt);
    $affected_rows = mysqli_stmt_affected_rows($delete_student_stmt);

    // Redirect based on the result of the SQL query
    if ($affected_rows > 0) {
        header("Location: ../officer-students.php?deleteStudentSuccess=Successfully deleted that student");
        exit();
    } else {
        header("Location: ../officer-students.php?deleteStudentError=Failed to delete that student");
        exit();
    }

} else {
    header("Location: ../login.php");
    exit();
}
?>