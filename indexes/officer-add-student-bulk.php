<?php
session_start();
require ('db_conn.php');
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['save_excel_data'])) {
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];

        try {
            /** Load $inputFileName to a Spreadsheet object **/
            $spreadsheet = IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();

            foreach ($data as $row) {
                $accountnumber = htmlspecialchars($row[0]);
                $lastname = htmlspecialchars($row[1]);
                $firstname = htmlspecialchars($row[2]);
                $middlename = htmlspecialchars($row[3]);
                $program = htmlspecialchars($row[4]);
                $yearlevel = htmlspecialchars($row[5]);
                $gender = htmlspecialchars($row[6]);
                $email = filter_var($row[7], FILTER_SANITIZE_EMAIL);
                $phonenumber = htmlspecialchars($row[8]);


                $defaultpassword = $lastname . $accountnumber;
                $defaulthashed_pass = password_hash($defaultpassword, PASSWORD_BCRYPT);

                $first_letter = substr($firstname, 0, 1);

                $first_letter_middlename = substr($middlename, 0, 1);
                $code = strtoupper($lastname . " , " . $firstname . " " . $first_letter_middlename . ". - " . $accountnumber . " - " . $program);

                $username = strtolower($first_letter) . strtolower($lastname);
                
                $role = "Student";
                
                $enrolled_by = $_SESSION['username'];

                // Insert new student
                $sql_newstudent_query = "INSERT INTO user (account_number, code, password, username, role, last_name, first_name, middle_name, gender, email, phone_number, enrolled_by, year_level, program)
                                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_newstudent_query = mysqli_prepare($conn, $sql_newstudent_query);

                if ($stmt_newstudent_query) {
                    mysqli_stmt_bind_param($stmt_newstudent_query, "ssssssssssssss", $accountnumber, $code, $defaulthashed_pass, $username, $role, $lastname, $firstname, $middlename, $gender, $email, $phonenumber, $enrolled_by, $yearlevel, $program);
                    $result_newstudent_query = mysqli_stmt_execute($stmt_newstudent_query);

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
