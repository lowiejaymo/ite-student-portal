<?php
session_start();
include 'db_conn.php';

// Check if the required data is received
if (
    isset($_POST['school_year'], $_POST['semester'], $_POST['program'], $_POST['year_level'], $_POST['previous_url'], $_POST['student_ids'])
) {
    // Function to validate input
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validate and sanitize input data
    $school_year = validate($_POST['school_year']);
    $semester = validate($_POST['semester']);
    $program = validate($_POST['program']);
    $year_level = validate($_POST['year_level']);
    $previous_url = validate($_POST['previous_url']);
    $student_ids = explode(",", $_POST['student_ids']);

    // Prepare and execute SQL query for each student
    foreach ($student_ids as $account_number) {
        $account_number = validate($account_number);

        // Insert or update enrollment record
        $query = "INSERT INTO enrolled (account_number, school_year, semester) 
                VALUES ('$account_number', '$school_year', '$semester')
                ON DUPLICATE KEY UPDATE school_year='$school_year', semester='$semester'";

        if ($conn->query($query) !== TRUE) {
            // Handle errors (e.g., log error, display message)
            // For simplicity, let's just echo the error message
            echo "Error: " . $conn->error;
            exit(); // Exit the script if an error occurs
        }
    }

    // Redirect back to the previous page
    header("Location: " . $previous_url);
    exit();
} else {
    // Redirect to login page with an error message
    header("Location: ../login.php?error=missing_data");
    exit();
}
?>
