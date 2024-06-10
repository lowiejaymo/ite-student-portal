<?php
session_start();
include 'db_conn.php';

if (isset($_POST['account_number'], $_POST['school_year'], $_POST['semester'], $_POST['program'], $_POST['year_level'], $_POST['previous_url'])) {

  function validate($data) {
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
  $previous_url = $_POST['previous_url']; // No need to re-validate as it was already escaped before sending

  $query = "INSERT INTO enrolled (account_number, school_year, semester) 
            VALUES ('$account_number', '$school_year', '$semester')";
  if ($conn->query($query) === TRUE) {
    // Redirect the user back to the previous page
    header("Location: " . $previous_url);
    exit();
  } else {
    // Redirect the user back to the previous page with error message
    header("Location: " . $previous_url);
    exit();
  }
} else {
  // Redirect the user to login page with error message
  header("Location: login.php");
  exit();
}
?>
