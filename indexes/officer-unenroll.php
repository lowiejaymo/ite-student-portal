<?php
session_start();
include 'db_conn.php';

if (isset($_POST['account_number'], $_POST['school_year'], $_POST['semester'], $_POST['program'], $_POST['year_level'])) {

  function validate($data)
    {
        $data = trim($data); // Remove whitespace from the beginning and end of string
        $data = stripslashes($data); // Remove backslashes
        $data = htmlspecialchars($data); // Convert special characters to HTML entities
        return $data;
    }

  $account_number = validate($_POST['account_number']);
  $school_year = validate($_POST['school_year']);
  $semester = validate($_POST['semester']);
  $program = validate($_POST['program']);
  $year_level = validate($_POST['year_level']);

  $sql = "DELETE FROM enrolled WHERE account_number = '$account_number' AND school_year = '$school_year' AND semester = '$semester'";
  if (mysqli_query($conn, $sql)) {
    header("Location: ../officer-enrolled-students.php?school_year=$school_year&semester=$semester&program=$program&year_level=$year_level&search=");
  } else {
    header("Location: ../officer-enrolled-students.php?school_year=$school_year&semester=$semester&program=$program&year_level=$year_level&search=");
  }
} else {
  header("Location: login.php");
}
?>
