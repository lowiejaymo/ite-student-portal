<?php
session_start();

include "db_conn.php";

if (
    isset($_POST['currentPassword']) && isset($_POST['newPassword'])
    && isset($_POST['retypeNewPassword'])
) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $currentPassword = validate($_POST['currentPassword']);
    $newPassword = validate($_POST['newPassword']);
    $retypeNewPassword = validate($_POST['retypeNewPassword']);

    $account_indx = $_SESSION['account_indx'];

    if ($newPassword !== $retypeNewPassword) {
        header("Location: ../admin-profile-setting.php?passerror=Your new password and Retype password do not match.");
        exit();
    }

    $sql = "SELECT password FROM user WHERE account_indx=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $account_indx);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password'];
        if (!password_verify($currentPassword, $storedPassword)) {
            header("Location: ../admin-profile-setting.php?passerror=Incorrect current password.");
            exit();
        }
    } else {
        header("Location: ../admin-profile-setting.php?passerror=User not found.");
        exit();
    }

    $hashed_new_password = password_hash($newPassword, PASSWORD_DEFAULT);

    $update_sql = "UPDATE user SET password=? WHERE account_indx=?";
    $update_stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($update_stmt, "ss", $hashed_new_password, $account_indx);
    $update_result = mysqli_stmt_execute($update_stmt);

    if ($update_result) {
        $_SESSION['password'] = $hashed_new_password; 
        header("Location: ../admin-profile-setting.php?passsuccess=Password updated successfully.");
        exit();
    } else {
        header("Location: ../admin-profile-setting.php?error=Failed to update password.");
        exit();
    }
} else {
    header("Location: ../admin-profile-setting.php");
    exit();
}
