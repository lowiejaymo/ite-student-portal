<?php
session_start();

include "db_conn.php";

if (isset($_POST['upload'])) {

    $account_indx = $_SESSION['account_indx']; 
    $account_number = $_SESSION['account_number']; 

    $file = $account_number; 
    $file_name = $_FILES['file']['name'];   
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION); 
    $file_loc = $_FILES['file']['tmp_name']; 
    $file_size = $_FILES['file']['size'];
    $folder = "../profile-pictures/"; 

    $allowed_extensions = array('png', 'jpg', 'jpeg');

    if (!in_array(strtolower($file_ext), $allowed_extensions)) { 
        header("Location: ../officer-profile-setting.php?proferror=Upload failed, file type is not supported. Please upload PNG, JPG, or JPEG file type only.");
        exit();
    }

    $final_file = strtolower($file) . '.' . $file_ext;

    if (move_uploaded_file($file_loc, $folder . $final_file)) {
        $sql = "UPDATE user SET profile_picture=? WHERE account_indx=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $final_file, $account_indx);
        mysqli_stmt_execute($stmt);

        $_SESSION['profile_picture'] = $final_file;

        header("Location: ../officer-profile-setting.php?profsuccess=Your new profile Picture has been updated successfully.");
        exit();
    } else {
        header("Location: ../officer-profile-setting.php?proferror=Upload failed.");
        exit();
    }
} else {
    header("Location: ../officer-profile-setting.php");
    exit();
}
?>