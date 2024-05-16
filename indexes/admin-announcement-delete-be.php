<?php
/*
admin-announcement-delete-be.php and announcement deletion process in admin
Authors:
  - Lowie Jay Orillo (lowie.jaymier@gmail.com)
  - Caryl Mae Subaldo (subaldomae29@gmail.com)
  - Brian Angelo Bognot (c09651052069@gmail.com)
Last Modified: May 15, 2024
Overview: This file handles the deletion of announcements.
*/

session_start();
require ('db_conn.php');

if (isset($_POST['deleteAnnouncement'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $heading = validate($_POST['heading']);
    $content = validate($_POST['content']);
    $posted_by = validate($_POST['posted_by']);
    $created_on = validate($_POST['created_on']);

    // echo "$heading";
    // echo "$content";
    // echo "$posted_by";
    // echo "$created_on";

     $delete_announcement_query = "DELETE FROM announcement WHERE heading = ? AND content = ? AND posted_by = ? AND created_on = ?";
    $delete_announcement_stmt = mysqli_prepare($conn, $delete_announcement_query);
    mysqli_stmt_bind_param($delete_announcement_stmt, "ssss", $heading, $content, $posted_by, $created_on);
    mysqli_stmt_execute($delete_announcement_stmt);
    $affected_rows = mysqli_stmt_affected_rows($delete_announcement_stmt);

    if ($affected_rows > 0) {
        header("Location: ../admin-announcement.php?deleteAnnouncementSuccess=Successfully deleted the announcement");
        exit();
    } else {
        header("Location: ../admin-announcement.php?deleteAnnouncementError=Failed to delete the announcement");
        exit();
    }

} else {
    header("Location: ../login.php");
    exit();
}
?>