<?php
session_start();
require ('db_conn.php');

if (isset($_POST['deleteEvent'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $event_indx = validate($_POST['event_indx']);

    $delete_event_query = "DELETE FROM events WHERE event_indx = ?";
    $delete_event_stmt = mysqli_prepare($conn, $delete_event_query);
    mysqli_stmt_bind_param($delete_event_stmt, "s", $event_indx);
    mysqli_stmt_execute($delete_event_stmt);
    $affected_rows = mysqli_stmt_affected_rows($delete_event_stmt);

    if ($affected_rows > 0) {
        header("Location: ../admin-events.php?deleteEventSuccess=Successfully deleted the event");
        exit();
    } else {
        header("Location: ../admin-events.php?deleteEventError=Failed to delete the event");
        exit();
    }

} else {
    header("Location: ../login.php");
    exit();
}
?>