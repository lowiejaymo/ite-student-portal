<?php
session_start();
include "db_conn.php";

if (isset($_SESSION['role']) && $_SESSION['role'] === 'Officer') {
    if (isset($_GET['school_year']) && isset($_GET['semester'])) {
        $school_year = $_GET['school_year'];
        $semester = $_GET['semester'];

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=enrolled_students_" . $school_year . "_" . $semester . ".xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        $output = fopen("php://output", "w");

        // Output the column headings
        fputcsv($output, array('Student Number', 'Last Name', 'First Name', 'Middle Name', 'Gender', 'Program', 'Year Level'), "\t");

        $sql = "SELECT u.account_number, u.last_name, u.first_name, u.middle_name, u.gender, u.program, u.year_level 
                FROM user u
                INNER JOIN enrolled e ON u.account_number = e.account_number
                WHERE e.school_year = '$school_year' AND e.semester = '$semester' 
                ORDER BY u.program ASC, u.year_level ASC, u.last_name ASC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                fputcsv($output, $row, "\t");
            }
        } else {
            fputcsv($output, array('No data found'), "\t");
        }
        fclose($output);
        exit();
    } else {
        echo "School year and semester not specified.";
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>
