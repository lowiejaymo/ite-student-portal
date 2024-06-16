<?php
session_start();
include "db_conn.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['add_student'])) {
            $payment_for_id = intval($_POST['payment_for_id']);
            $account_number = intval($_POST['account_number']);

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO payment (payment_for_id, account_number) VALUES (?, ?)");
            $stmt->bind_param("is", $payment_for_id, $account_number);

            // Execute the statement
            if ($stmt->execute()) {
                header("Location: ../admin-payment-add-student.php?payment_for_id=$payment_for_id");
                exit();
            } else {
                header("Location: ../admin-payment-add-student.php?payment_for_id=$payment_for_id&failedToAddStudent=Failed to add student" );
                exit();
            }
        }
    } else {
    // Redirect back to the event view page or wherever appropriate
    header("Location: login.php");
    exit();
    }
?>
