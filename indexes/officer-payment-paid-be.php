<?php
session_start();
require('db_conn.php');

if (isset($_POST['confirmMarkPaid'])) {
    function validate($data)
    {
        $data = trim($data); // Remove whitespace from the beginning and end of string
        $data = stripslashes($data); // Remove backslashes
        $data = htmlspecialchars($data); // Convert special characters to HTML entities
        return $data;
    }

    $payment_for_id = validate($_POST['payment_for_id']);
    $account_number = validate($_POST['account_number']);
    $remarks = "Paid";
    $date_paid = date('Y-m-d');
    $received_by = validate($_POST['received_by']);

    // Prepare the SQL statement
    $sql = "UPDATE payment SET remarks = ?, date_paid = ?, received_by = ? WHERE payment_for_id = ? AND account_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $remarks, $date_paid, $received_by, $payment_for_id, $account_number);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the same URL
        header("Location: {$_SERVER['HTTP_REFERER']}?success=Payment marked as paid successfully");
        exit();
    } else {
        // Redirect to the same URL
        header("Location: {$_SERVER['HTTP_REFERER']}?failed=Payment failed to marked as paid");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>
