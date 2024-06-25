<?php
session_start();
require('db_conn.php');

if (isset($_POST['confirmMarkPaid'])) {
    function validate($data)
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    $payment_for_id = validate($_POST['payment_for_id']);
    $account_number = validate($_POST['account_number']);
    $date_paid = validate($_POST['date_paid']);
    $remarks = "Paid";
    $received_by = validate($_POST['received_by']);
    $cn_number = validate($_POST['cn_number']);

    // Check if date is in the correct format (YYYY-MM-DD)
    if (DateTime::createFromFormat('Y-m-d', $date_paid) === false) {
        header("Location: {$_SERVER['HTTP_REFERER']}?failed=Invalid date format");
        exit();
    }

    $sql = "UPDATE payment SET remarks = ?, date_paid = ?, received_by = ?, cn_number = ? WHERE payment_for_id = ? AND account_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $remarks, $date_paid, $received_by, $cn_number, $payment_for_id, $account_number);

    if ($stmt->execute()) {
        header("Location: {$_SERVER['HTTP_REFERER']}?success=Payment marked as paid successfully");
        exit();
    } else {
        header("Location: {$_SERVER['HTTP_REFERER']}?failed=Payment failed to mark as paid");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>
