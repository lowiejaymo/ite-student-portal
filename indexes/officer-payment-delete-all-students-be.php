<?php
session_start();
require ('db_conn.php');

if (isset($_POST['add_all'])) {

    // Function to validate and sanitize user input
    function validate($data)
    {
        $data = trim($data); // Remove whitespace from the beginning and end of string
        $data = stripslashes($data); // Remove backslashes
        $data = htmlspecialchars($data); // Convert special characters to HTML entities
        return $data;
    }

    // Sanitize and validate inputs
    $payment_for_id = validate($_POST['payment_for_id']);
    $program = validate($_POST['program']);
    $year_level = validate($_POST['year_level']);

    // Validate payment ID if empty
    if (empty($payment_for_id)) {
        header("Location: ../officer-Payment-view.php?addAllError=Payment ID is required");
        exit();
    }

    // Get the payment details to extract the school year and semester
    $sql = "SELECT school_year, semester FROM payment_for WHERE payment_for_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $payment_for_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $school_year = $row['school_year'];
        $semester = $row['semester'];

        $conditions = [];
        if ($program !== 'all') {
            $conditions[] = "u.program = '$program'";
        }
        if ($year_level !== 'all') {
            $conditions[] = "u.year_level = '$year_level'";
        }
        $whereClause = count($conditions) > 0 ? 'AND ' . implode(' AND ', $conditions) : '';

        $studentsql = "SELECT a.account_number
                       FROM payment a
                       INNER JOIN payment_for e ON a.payment_for_id = e.payment_for_id
                       LEFT JOIN user u ON a.account_number = u.account_number AND a.payment_for_id = ?
                       WHERE e.school_year = ?
                         AND e.semester = ?
                         AND u.role = 'Student'
                         $whereClause";
        $stmt = mysqli_prepare($conn, $studentsql);
        mysqli_stmt_bind_param($stmt, "iss", $payment_for_id, $school_year, $semester);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result->num_rows > 0) {
            $insertSuccess = true;
            while ($row = $result->fetch_assoc()) {
                $account_number = $row['account_number'];
                $insertSql = "DELETE FROM payment WHERE payment_for_id = ? AND account_number = ?";
                $stmtInsert = mysqli_prepare($conn, $insertSql);
                mysqli_stmt_bind_param($stmtInsert, "is", $payment_for_id, $account_number);
                if (!mysqli_stmt_execute($stmtInsert)) {
                    $insertSuccess = false;
                    break;
                }
            }
            if ($insertSuccess) {
                header("Location: ../officer-payment-view.php?payment_for_id=$payment_for_id&addAllSuccess=All eligible students have been delete to the payment.");
            } else {
                header("Location: ../officer-payment-view.php?payment_for_id=$payment_for_id&addAllError=Failed to delete all eligible students.");
            }
        } else {
            header("Location: ../officer-payment-view.php?payment_for_id=$payment_for_id&addAllError=No students found to delete to the payment.");
        }
    } else {
        header("Location: ../officer-payment-view.php?addAllError=Payment not found.");
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>