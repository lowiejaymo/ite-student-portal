<?php
/*
admin-add-event-be.php and event addition process in admin
Authors:
  - Lowie Jay Orillo (lowie.jaymier@gmail.com)
  - Caryl Mae Subaldo (subaldomae29@gmail.com)
  - Brian Angelo Bognot (c09651052069@gmail.com)
Last Modified: May 15, 2024
Overview: This file handles the addition of new events, validating admin input and inserting the event into the database.
*/

session_start();
require ('db_conn.php');

if (isset($_POST['addEvent'])) {

    // Function to validate and sanitize user input
    function validate($data)
    {
        $data = trim($data); // Remove whitespace from the beginning and end of string
        $data = stripslashes($data); // Remove backslashes
        $data = htmlspecialchars($data); // Convert special characters to HTML entities
        return $data;
    }

    $eventname = validate($_POST['eventname']);
    $date = validate($_POST['date']);
    $schoolyear = validate($_POST['schoolyear']);
    $semester = validate($_POST['semester']);

    $user_data = 'eventname=' . $eventname .
    '&date=' . $date .
    '&schoolyear=' . $schoolyear .
    '&semester=' . $semester;


    if (empty($eventname)) {
        header("Location: ../admin-event-addnew.php?newEventError=Event name is required&$user_data");
        exit();
    } elseif (empty($date)) {
        header("Location: ../admin-event-addnew.php?newEventError=Date is required&$user_data");
        exit();
    } elseif (empty($schoolyear)) {
        header("Location: ../admin-event-addnew.php?newEventError=School year is required&$user_data");
        exit();
    } elseif (empty($semester)) {
        header("Location: ../admin-event-addnew.php?newEventError=Semester is required&$user_data");
        exit();
    } else {
        // Check if account number or username already exists
        $sql_check_existing = "SELECT * FROM events WHERE event_name=?";
        $stmt_check_existing = mysqli_prepare($conn, $sql_check_existing);
        mysqli_stmt_bind_param($stmt_check_existing, "s", $eventname,);
        mysqli_stmt_execute($stmt_check_existing);
        $result_check_existing = mysqli_stmt_get_result($stmt_check_existing);

        if (mysqli_num_rows($result_check_existing) > 0) {
            header("Location: ../admin-event-addnew.php?newEventError=Event name already exists&$user_data");
            exit();
        } else {
            // Insert new event
            $sql_newevent_query = "INSERT INTO events(event_name, date, school_year, semester)
                VALUES(?, ?, ?, ?)";
            $stmt_newevent_query = mysqli_prepare($conn, $sql_newevent_query);
            mysqli_stmt_bind_param($stmt_newevent_query, "ssss", $eventname, $date, $schoolyear, $semester);
            $result_newevent_query = mysqli_stmt_execute($stmt_newevent_query);

            if ($result_newevent_query) {
                header("Location: ../admin-events.php?newEventSuccess=New event addedd successfully");
                exit();
            } else {
                header("Location: ../admin-event-addnew.php?newEventError=Failed to add new event&$user_data");
                exit();
            }
        }
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>