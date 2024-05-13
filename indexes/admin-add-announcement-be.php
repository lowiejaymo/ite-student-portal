<?php
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

    $heading = validate($_POST['heading']);
    $content = validate($_POST['content']);

    $postedBy = $_SESSION['role'] ;

    date_default_timezone_set('Asia/Manila');
    $time = date("Y-m-d H:i:s");

    $account_indx = $_SESSION['account_indx'] ;

    $user_data = '&heading=' . $heading .
        '&content=' . $content;


    // Validate account number length
    if (strlen($heading) > 255) {
        header("Location: ../admin-announcement-addnew.php?newaAnnouncementError=Heading is too long, heading must not more than 255 characters$user_data");
        exit();
    } else if (empty($heading)) {
        header("Location: ../admin-announcement-addnew.php?newaAnnouncementError=Heading is required$user_data");
        exit();
    } elseif (empty($content)) {
        header("Location: ../admin-announcement-addnew.php?newaAnnouncementError=Content is required&$user_data");
        exit();
    } else {
        // Insert new announcement
        $sql_newAnnouncement_query = "INSERT INTO announcement(heading, content, posted_by, created_on, account_indx)
        VALUES(?, ?, ?, ?, ?)";
        $stmt_newoAnnouncement_query = mysqli_prepare($conn, $sql_newAnnouncement_query);
        mysqli_stmt_bind_param($stmt_newoAnnouncement_query, "ssssi", $heading, $content, $postedBy, $time, $account_indx);
        $result_newoAnnouncement_query = mysqli_stmt_execute($stmt_newoAnnouncement_query);

        if ($result_newoAnnouncement_query) {
            header("Location: ../admin-announcement.php?newAnnouncementSuccess=New announcement has been posted");
            exit();
        } else {
            header("Location: ../admin-announcement.php?newAnnouncementError=Failed to post announcement");
            exit();
        }
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>