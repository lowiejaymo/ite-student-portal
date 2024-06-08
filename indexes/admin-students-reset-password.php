<?php
/*
changepassword-be.php and password change process in officer
Authors:
  - Lowie Jay Orillo (lowie.jaymier@gmail.com)
  - Caryl Mae Subaldo (subaldomae29@gmail.com)
  - Brian Angelo Bognot (c09651052069@gmail.com)
Last Modified: May 15, 2024
Overview: This file handles the change of password for officer accounts, validating input and updating the password in the database.
*/
session_start();

include "db_conn.php";

if (isset($_POST['account_number'])) {
    $account_number = $_POST['account_number'];

    // Fetch user details
    $studentsql = "SELECT * FROM user WHERE account_number = ?";
    $stmt = $conn->prepare($studentsql);
    $stmt->bind_param("s", $account_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastnameremovespace = str_replace(' ', '', $row['last_name']);
        $defaultpassword = $lastnameremovespace . $account_number;
        $defaulthashed_pass = password_hash($defaultpassword, PASSWORD_BCRYPT);

        // Update password in the database
        $update_sql = "UPDATE user SET password = ? WHERE account_number = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ss", $defaulthashed_pass, $account_number);
        if ($update_stmt->execute()) {
            header("Location: ../admin-student-view.php?account_number=$account_number&resetSuccess=Password reset successfully");
        } else {
            header("Location: ../admin-student-view.php?account_number=$account_number&resetError=Failed to reset password");
        }
    } else {
        header("Location: ../admin-student-view.php?account_number=$account_number&resetError=Student not found");
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>