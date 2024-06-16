<?php
session_start();
include "db_conn.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['enroll_student'])) {
            $event_id = intval($_POST['event_id']);
            $account_number = intval($_POST['account_number']);

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO attendance (event_id, account_number, remarks) VALUES (?, ?, ?)");
            $remarks = "Pending";
            $stmt->bind_param("iis", $event_id, $account_number, $remarks);

            // Execute the statement
            if ($stmt->execute()) {
                header("Location: ../admin-event-add-student.php?event_id=$event_id");

                exit();
            } else {
                header("Location: ../admin-event-add-student.php?event_id=$event_id&failedToAddStudent=Failed to add student");
                exit();
            }
        }
    } else {
    // Redirect back to the event view page or wherever appropriate
    header("Location: login.php");
    exit();
    }
?>
