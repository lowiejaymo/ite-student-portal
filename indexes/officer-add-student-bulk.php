<?php
/*
officer-add-student-bulk.php and student addition in bulk using Excel file in officer
Authors:
  - Lowie Jay Orillo (lowie.jaymier@gmail.com)
  - Caryl Mae Subaldo (subaldomae29@gmail.com)
  - Brian Angelo Bognot (c09651052069@gmail.com)
Last Modified: May 15, 2024
Overview: This file handles the import of student data from an Excel file, validates the data, and inserts it into the database.
*/

session_start();
require ('db_conn.php');
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['save_excel_data'])) {

    // Get uploaded file information
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    // Define allowed file extensions
    $allowed_ext = ['xls', 'csv', 'xlsx'];

    // Check if file extension is allowed
    if (in_array($file_ext, $allowed_ext)) {
        
        // Get temporary file path
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];

        try {
            // Load Excel file into a Spreadsheet object
            $spreadsheet = IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();

            // Iterate through each row of data
            foreach ($data as $row) {

                // Sanitize and extract data from each row
                $accountnumber = htmlspecialchars($row[0]);
                $lastname = htmlspecialchars($row[1]);
                $firstname = htmlspecialchars($row[2]);
                $middlename = htmlspecialchars($row[3]);
                $program = htmlspecialchars($row[4]);
                $yearlevel = htmlspecialchars($row[5]);
                $gender = htmlspecialchars($row[6]);
                $email = filter_var($row[7], FILTER_SANITIZE_EMAIL);
                $phonenumber = htmlspecialchars($row[8]);

                // Convert the names to proper case
                $lastname = ucwords(strtolower($lastnameNotProper));
                $firstname = ucwords(strtolower($firstnameNotProper));
                $middlename = ucwords(strtolower($middlenameNotProper));
                
                // Remove the spaces of the last name
                $lastnameremovespace = str_replace(' ', '', $lastname);

                // Set the password and hashed it
                $defaultpassword = $lastname . $accountnumber;
                $defaulthashed_pass = password_hash($defaultpassword, PASSWORD_BCRYPT);

                // Get the first letter of the first name
                $first_letter = substr($firstname, 0, 1);

                // Get the first letter of the middle name
                $first_letter_middlename = substr($middlename, 0, 1);
                
                // Generate the code
                $code = strtoupper($lastname . " , " . $firstname . " " . $first_letter_middlename . ". - " . $accountnumber . " - " . $program);

                // Generate username
                $username = strtolower($first_letter) . strtolower($lastname);
                
                // Set role to Student
                $role = "Student";
                
                // Get the username of the admin who enrolled the student
                $enrolled_by = $_SESSION['username'];

                // Insert new student
                $sql_newstudent_query = "INSERT INTO user (account_number, code, password, username, role, last_name, first_name, middle_name, gender, email, phone_number, enrolled_by, year_level, program)
                                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_newstudent_query = mysqli_prepare($conn, $sql_newstudent_query);

                
                if ($stmt_newstudent_query) {
                    mysqli_stmt_bind_param($stmt_newstudent_query, "ssssssssssssss", $accountnumber, $code, $defaulthashed_pass, $username, $role, $lastname, $firstname, $middlename, $gender, $email, $phonenumber, $enrolled_by, $yearlevel, $program);
                    $result_newstudent_query = mysqli_stmt_execute($stmt_newstudent_query);

                    // Redirect based on the result of the SQL query
                    if (!$result_newstudent_query) {
                        header("Location: ../officer-student-addnew.php?newStudentError=Failed to add new student account");
                        exit();
                    }
                } else {
                    header("Location: ../officer-student-addnew.php?newStudentError=SQL preparation failed");
                    exit();
                }
            }

            header("Location: ../officer-students.php?newStudentSuccess=New student accounts created successfully");
            exit();

        } catch (Exception $e) {
            header("Location: ../officer-student-addbulk.php?newStudentError=" . urlencode($e->getMessage()));
            exit();
        }

    } else {
        header("Location: ../officer-student-addbulk.php?newStudentError=Invalid file format! Please upload an Excel file");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>
