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

  $query = "INSERT INTO enrolled (account_number, school_year, semester) 
            VALUES ('$account_number', '$school_year', '$semester')";
  if ($conn->query($query) === TRUE) {
    // Redirect the user to the same page with search parameters
    header("Location: ../officer-enrolled-students.php?school_year=$school_year&semester=$semester&program=$program&year_level=$year_level&search=");
  } else {
    // Redirect the user to the same page with error message
    header("Location: ../officer-enrolled-students.php?school_year=$school_year&semester=$semester&program=$program&year_level=$year_level&search=");
  }
} else {
  // Redirect the user to login page with error message
  header("Location: login.php");
}
?>
