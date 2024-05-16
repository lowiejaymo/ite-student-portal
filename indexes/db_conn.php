<?php
/*
db_conn.php and MySQL database connection
Authors:
  - Lowie Jay Orillo (lowie.jaymier@gmail.com)
  - Caryl Mae Subaldo (subaldomae29@gmail.com)
  - Brian Angelo Bognot (c09651052069@gmail.com)
Last Modified: May 15, 2024
Overview: This file contains the PHP script for establishing a connection to a MySQL database.
*/

$sname= "localhost:3307"; 
$uname= "root"; 
$password= ""; 
$db_name= "ite-student-portal"; 

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn){ 
    echo 'Connection Failed';
}

