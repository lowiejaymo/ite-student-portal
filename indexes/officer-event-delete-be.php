<?php
/*
officer-event-delete-be.php and event deletion process in officer
Authors:
  - Lowie Jay Orillo (lowie.jaymier@gmail.com)
  - Caryl Mae Subaldo (subaldomae29@gmail.com)
  - Brian Angelo Bognot (c09651052069@gmail.com)
Last Modified: June 2, 2024
Overview: This file handles the deletion of events.
*/
session_start();
require ('db_conn.php');

if (isset($_POST['deleteEvent'])) {

    // Function to validate and sanitize user input
    function validate($data)
    {
        $data = trim($data); // Remove whitespace from the beginning and end of string
        $data = stripslashes($data); // Remove backslashes
        $data = htmlspecialchars($data); // Convert special characters to HTML entities
        return $data;
    }

    // Sanitize and validate 
    $event_id = validate($_POST['event_id']);

    // Delete the event
    $delete_event_query = "DELETE FROM events WHERE event_id = ?";
    $delete_event_stmt = mysqli_prepare($conn, $delete_event_query);
    mysqli_stmt_bind_param($delete_event_stmt, "s", $event_id);
    mysqli_stmt_execute($delete_event_stmt);
    $affected_rows = mysqli_stmt_affected_rows($delete_event_stmt);

    // Redirect based on the result of the SQL query
    if ($affected_rows > 0) {
        header("Location: ../officer-events.php?deleteEventSuccess=Successfully deleted the event");
        exit();
    } else {
        header("Location: ../officer-events.php?deleteEventError=Failed to delete the event");
        exit();
    }

} else {
    header("Location: ../login.php");
    exit();
}
?>