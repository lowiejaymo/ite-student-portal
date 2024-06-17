<?php
session_start();
include "db_conn.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['add_student'])) {
            $payment_for_id = intval($_POST['payment_for_id']);
            $account_number = intval($_POST['account_number']);
            $previous_url = $_POST['previous_url'];

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO payment (payment_for_id, account_number, remarks) VALUES (?, ?, ?)");
            $remarks = 'Pending';
            $stmt->bind_param("iss", $payment_for_id, $account_number, $remarks);

            // Execute the statement
            if ($stmt->execute()) {
                header("Location: " . $previous_url);
                exit();
            } else {
                header("Location: " . $previous_url);
                exit();
            }

            // Close the statement
            $stmt->close();
        }
    } else {
    // Redirect back to the event view page or wherever appropriate
    header("Location: login.php");
    exit();
    }
?>
