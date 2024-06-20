<?php

session_start();
require('db_conn.php');

if (isset($_POST['deletePayment'])) {

    // Function to validate and sanitize user input
    function validate($data)
    {
        $data = trim($data); // Remove whitespace from the beginning and end of string
        $data = stripslashes($data); // Remove backslashes
        $data = htmlspecialchars($data); // Convert special characters to HTML entities
        return $data;
    }

    // Sanitize and validate 
    $payment_for_id = validate($_POST['payment_for_id']);

    // Delete the payment
    $delete_event_query = "DELETE FROM payment WHERE payment_for_id = ?";
    $delete_event_stmt = mysqli_prepare($conn, $delete_event_query);
    mysqli_stmt_bind_param($delete_event_stmt, "s", $payment_for_id);
    mysqli_stmt_execute($delete_event_stmt);

    // Delete the payment_for
    $delete_event_query = "DELETE FROM payment_for WHERE payment_for_id = ?";
    $delete_event_stmt = mysqli_prepare($conn, $delete_event_query);
    mysqli_stmt_bind_param($delete_event_stmt, "s", $payment_for_id);
    mysqli_stmt_execute($delete_event_stmt);
    $affected_rows = mysqli_stmt_affected_rows($delete_event_stmt);

    // // Redirect based on the result of the SQL query
    if ($affected_rows > 0) {
        header("Location: ../admin-payment.php?deletePaymentSuccess=Successfully deleted the event");
        exit();
    } else {
        header("Location: ../admin-payment.php?deletePaymentError=Failed to delete the event");
        exit();
    }

} else {
    header("Location: ../login.php");
    exit();
}
?>
