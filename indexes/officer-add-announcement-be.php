<?php
/*
officer-add-announcement-be.php and announcement addition process in officer
Authors:
  - Lowie Jay Orillo (lowie.jaymier@gmail.com)
  - Caryl Mae Subaldo (subaldomae29@gmail.com)
  - Brian Angelo Bognot (c09651052069@gmail.com)
Last Modified: May 15, 2024
Overview: This file handles the addition of new announcements, 
    validating officer input and inserting the announcement into the database.
*/
session_start();
require ('db_conn.php');

if (isset($_POST['addAnnouncement'])) {

    // Function to validate and sanitize user input
    function validate($data)
    {
        $data = trim($data); // Remove whitespace from the beginning and end of string
        $data = stripslashes($data); // Remove backslashes
        $data = htmlspecialchars($data); // Convert special characters to HTML entities
        return $data;
    }

    // Sanitize and validate 
    $heading = validate($_POST['heading']);
    $content = validate($_POST['content']);

    // Get the user role from the session
    $postedBy = $_SESSION['role'] ;

    // Set the default timezone and the current date and time
    date_default_timezone_set('Asia/Manila');
    $time = date("Y-m-d H:i:s");

    // Get the account index from the session
    $account_indx = $_SESSION['account_indx'] ;

    // Construct user data string
    $user_data = '&heading=' . $heading .
        '&content=' . $content;


    // Validate account number length
    if (strlen($heading) > 255) {
        header("Location: ../officer-announcement-addnew.php?newaAnnouncementError=Heading is too long, heading must not more than 255 characters$user_data");
        exit();
    } // Validate heading if empty
    else if (empty($heading)) {
        header("Location: ../officer-announcement-addnew.php?newaAnnouncementError=Heading is required$user_data");
        exit();
    } // Validate content if empty
    else if (empty($content)) {
        header("Location: ../officer-announcement-addnew.php?newaAnnouncementError=Content is required&$user_data");
        exit();
    } else {
        // Insert new announcement
        $sql_newAnnouncement_query = "INSERT INTO announcement(heading, content, posted_by, created_on, account_indx)
        VALUES(?, ?, ?, ?, ?)";
        $stmt_newoAnnouncement_query = mysqli_prepare($conn, $sql_newAnnouncement_query);
        mysqli_stmt_bind_param($stmt_newoAnnouncement_query, "ssssi", $heading, $content, $postedBy, $time, $account_indx);
        $result_newoAnnouncement_query = mysqli_stmt_execute($stmt_newoAnnouncement_query);

        // Redirect based on the result of the SQL query
        if ($result_newoAnnouncement_query) {
            header("Location: ../officer-announcement.php?newAnnouncementSuccess=New announcement has been posted");
            exit();
        } else {
            header("Location: ../officer-announcement.php?newAnnouncementError=Failed to post announcement");
            exit();
        }
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>