<?php
session_start();
include "indexes/db_conn.php";
if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') { // Check if the role is set and it's 'Admin'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ITE Student Portal | Admin Event Page</title>
    <link rel="icon" type="image/png" href="favicon.ico" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="AdminLTE-3.2.0/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <?php include 'layout/admin-fixed-topnav.php'; ?>

    <?php include 'layout/admin-sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 align-items-center">
                    <div class="col-sm-6">
                        <h1>Event</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a id="addNewSubjectBtn" class="btn btn-secondary" href="admin-events.php"><i class="nav-icon fas fa-solid fa-chevron-left"></i> Back to Events</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?php if (isset($_GET['updateEventSuccess'])) { ?>
                    <div class="alert alert-success">
                        <?php echo $_GET['updateEventSuccess']; ?>
                    </div>
                <?php } ?>

                <div class="card card-primary card-outline bg-white" for="update-profilepicture">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <!-- Image column -->
                            <div class="col-md-auto">
                                <img src="images/calendar_avatar.webp" alt="View event avatar" style="width: 150px; height: auto;">
                            </div>

                            <!-- Subject information column -->
                            <div class="col-md">
                                <div class="table-responsive">
                                    <table class="subject-info">
                                        <?php
                                        if (isset($_GET['event_id'])) {
                                            $event_id = $_GET['event_id'];
                                            $eventsql = "SELECT * FROM events WHERE event_id = '$event_id'";
                                            $result = $conn->query($eventsql);

                                            if ($result && $result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                ?>
                                                <table class="subject-info">
                                                    <tr>
                                                        <td class="col-md-3"><strong>Event Name:</strong></td>
                                                        <td class="col-md-9"><?php echo $row['event_name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-md-3"><strong>Date:</strong></td>
                                                        <td class="col-md-9"><?php echo $row['date']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-md-3"><strong>School Year:</strong></td>
                                                        <td class="col-md-9"><?php echo $row['school_year']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-md-3"><strong>Semester:</strong></td>
                                                        <td class="col-md-9"><?php echo $row['semester']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-md-3"><strong>Points:</strong></td>
                                                        <td class="col-md-9"><?php echo $row['points']; ?></td>
                                                    </tr>
                                                </table>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- Add Student button -->
                                    <div class="col-md-auto ml-auto">
                                        <a href="admin-event-add-student.php?event_id=<?php echo $row['event_id']; ?>" class="btn btn-success btn-sm d-block mb-2"><i class="nav-icon fas fa-solid fa-plus"></i> Add Student</a>
                                        <a href="admin-event-edit.php?event_id=<?php echo $row['event_id']; ?>" class="btn btn-secondary btn-sm d-block mb-2"><i class="nav-icon fas fa-regular fa-pen-to-square"></i> Edit event</a>
                                    </div>
                                    <?php
                                            } else {
                                                echo "Event may not be existing.";
                                            }
                                        }
                                        ?>
                        </div>
                    </div>
                </div>

                <!-- New Section for Students List -->
                <div class="card card-primary card-outline bg-white mt-4">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#all" data-toggle="tab">All</a></li>
                            <li class="nav-item"><a class="nav-link" href="#pending" data-toggle="tab">Pending</a></li>
                            <li class="nav-item"><a class="nav-link" href="#present" data-toggle="tab">Present</a></li>
                            <li class="nav-item"><a class="nav-link" href="#absent" data-toggle="tab">Absent</a></li>
                            <li class="nav-item"><a class="nav-link" href="#excuse" data-toggle="tab">Excuse</a></li>
                            <li class="nav-item"><a class="nav-link" href="#exempted" data-toggle="tab">Exempted</a></li>
                            <li class="nav-item"><a class="nav-link" href="#working" data-toggle="tab">Working</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                      <div class="tab-content">
                          <div class="tab-pane active" id="all">
                              <?php
                              // Query to fetch all students for the event
                              $studentsql = "SELECT user.account_number, user.username, user.first_name, user.last_name, user.middle_name, user.program, user.year_level, attendance.remarks 
                                            FROM attendance 
                                            JOIN user ON attendance.account_number = user.account_number 
                                            WHERE attendance.event_id = '$event_id'
                                            ORDER BY attendance.account_number ASC";
                              $studentresult = $conn->query($studentsql);

                              if ($studentresult && $studentresult->num_rows > 0) { ?>
                                  <table class="table">
                                      <thead>
                                          <tr>
                                              <th class="col-2">Student Number</th>
                                              <th class="col-1">User Name</th>
                                              <th class="col-2 text-center">Last Name</th>
                                              <th class="col-2 text-center">First Name</th>
                                              <th class="col-2 text-center">Middle Name</th>
                                              <th class="col-1 text-center">Program</th>
                                              <th class="col-1 text-center">Year Level</th>
                                              <th class="col-1 text-center">Remarks</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php while ($studentrow = $studentresult->fetch_assoc()) { ?>
                                              <tr>
                                                  <td class="align-middle"><?php echo $studentrow['account_number']; ?></td>
                                                  <td class="align-middle"><?php echo $studentrow['username']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['last_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['first_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['middle_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['program']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['year_level']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['remarks']; ?></td>
                                              </tr>
                                          <?php } ?>
                                      </tbody>
                                  </table>
                              <?php } else { ?>
                                  <p>No students found for this event.</p>
                              <?php } ?>
                          </div>

                          <!-- Pending Students Tab -->
                          <div class="tab-pane" id="pending">
                              <?php
                              // Query to fetch pending students for the event
                              $studentsql = "SELECT user.account_number, user.username, user.first_name, user.last_name, user.middle_name, user.program, user.year_level, attendance.remarks 
                                            FROM attendance 
                                            JOIN user ON attendance.account_number = user.account_number 
                                            WHERE attendance.event_id = '$event_id' AND remarks = 'Pending'
                                            ORDER BY attendance.account_number ASC";
                              $studentresult = $conn->query($studentsql);

                              if ($studentresult && $studentresult->num_rows > 0) { ?>
                                  <table class="table">
                                      <thead>
                                          <tr>
                                              <th class="col-2">Student Number</th>
                                              <th class="col-1">User Name</th>
                                              <th class="col-2 text-center">Last Name</th>
                                              <th class="col-2 text-center">First Name</th>
                                              <th class="col-2 text-center">Middle Name</th>
                                              <th class="col-1 text-center">Program</th>
                                              <th class="col-1 text-center">Year Level</th>
                                              <th class="col-1 text-center">Remarks</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php while ($studentrow = $studentresult->fetch_assoc()) { ?>
                                              <tr>
                                                  <td class="align-middle"><?php echo $studentrow['account_number']; ?></td>
                                                  <td class="align-middle"><?php echo $studentrow['username']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['last_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['first_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['middle_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['program']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['year_level']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['remarks']; ?></td>
                                              </tr>
                                          <?php } ?>
                                      </tbody>
                                  </table>
                              <?php } else { ?>
                                  <p>No <strong>PENDING</strong> students found for this event.</p>
                              <?php } ?>
                          </div>

                          <!-- Present Students Tab -->
                          <div class="tab-pane" id="present">
                              <?php
                              // Query to fetch present students for the event
                              $studentsql = "SELECT user.account_number, user.username, user.first_name, user.last_name, user.middle_name, user.program, user.year_level, attendance.remarks 
                                            FROM attendance 
                                            JOIN user ON attendance.account_number = user.account_number 
                                            WHERE attendance.event_id = '$event_id' AND remarks = 'Present'
                                            ORDER BY attendance.account_number ASC";
                              $studentresult = $conn->query($studentsql);

                              if ($studentresult && $studentresult->num_rows > 0) { ?>
                                  <table class="table">
                                      <thead>
                                          <tr>
                                              <th class="col-2">Student Number</th>
                                              <th class="col-1">User Name</th>
                                              <th class="col-2 text-center">Last Name</th>
                                              <th class="col-2 text-center">First Name</th>
                                              <th class="col-2 text-center">Middle Name</th>
                                              <th class="col-1 text-center">Program</th>
                                              <th class="col-1 text-center">Year Level</th>
                                              <th class="col-1 text-center">Remarks</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php while ($studentrow = $studentresult->fetch_assoc()) { ?>
                                              <tr>
                                                  <td class="align-middle"><?php echo $studentrow['account_number']; ?></td>
                                                  <td class="align-middle"><?php echo $studentrow['username']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['last_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['first_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['middle_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['program']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['year_level']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['remarks']; ?></td>
                                              </tr>
                                          <?php } ?>
                                      </tbody>
                                  </table>
                              <?php } else { ?>
                                  <p>No <strong>PRESENT</strong> students found for this event.</p>
                              <?php } ?>
                          </div>

                          <!-- Absent Students Tab -->
                          <div class="tab-pane" id="absent">
                              <?php
                              // Query to fetch absent students for the event
                              $studentsql = "SELECT user.account_number, user.username, user.first_name, user.last_name, user.middle_name, user.program, user.year_level, attendance.remarks 
                                            FROM attendance 
                                            JOIN user ON attendance.account_number = user.account_number 
                                            WHERE attendance.event_id = '$event_id' AND remarks = 'Absent'
                                            ORDER BY attendance.account_number ASC";
                              $studentresult = $conn->query($studentsql);

                              if ($studentresult && $studentresult->num_rows > 0) { ?>
                                  <table class="table">
                                      <thead>
                                          <tr>
                                              <th class="col-2">Student Number</th>
                                              <th class="col-1">User Name</th>
                                              <th class="col-2 text-center">Last Name</th>
                                              <th class="col-2 text-center">First Name</th>
                                              <th class="col-2 text-center">Middle Name</th>
                                              <th class="col-1 text-center">Program</th>
                                              <th class="col-1 text-center">Year Level</th>
                                              <th class="col-1 text-center">Remarks</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php while ($studentrow = $studentresult->fetch_assoc()) { ?>
                                              <tr>
                                                  <td class="align-middle"><?php echo $studentrow['account_number']; ?></td>
                                                  <td class="align-middle"><?php echo $studentrow['username']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['last_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['first_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['middle_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['program']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['year_level']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['remarks']; ?></td>
                                              </tr>
                                          <?php } ?>
                                      </tbody>
                                  </table>
                              <?php } else { ?>
                                  <p>No <strong>ABSENT</strong> students found for this event.</p>
                              <?php } ?>
                          </div>

                          <!-- Excused Students Tab -->
                          <div class="tab-pane" id="excuse">
                              <?php
                              // Query to fetch excuse students for the event
                              $studentsql = "SELECT user.account_number, user.username, user.first_name, user.last_name, user.middle_name, user.program, user.year_level, attendance.remarks 
                                            FROM attendance 
                                            JOIN user ON attendance.account_number = user.account_number 
                                            WHERE attendance.event_id = '$event_id' AND remarks = 'Excuse'
                                            ORDER BY attendance.account_number ASC";
                              $studentresult = $conn->query($studentsql);

                              if ($studentresult && $studentresult->num_rows > 0) { ?>
                                  <table class="table">
                                      <thead>
                                          <tr>
                                              <th class="col-2">Student Number</th>
                                              <th class="col-1">User Name</th>
                                              <th class="col-2 text-center">Last Name</th>
                                              <th class="col-2 text-center">First Name</th>
                                              <th class="col-2 text-center">Middle Name</th>
                                              <th class="col-1 text-center">Program</th>
                                              <th class="col-1 text-center">Year Level</th>
                                              <th class="col-1 text-center">Remarks</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php while ($studentrow = $studentresult->fetch_assoc()) { ?>
                                              <tr>
                                                  <td class="align-middle"><?php echo $studentrow['account_number']; ?></td>
                                                  <td class="align-middle"><?php echo $studentrow['username']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['last_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['first_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['middle_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['program']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['year_level']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['remarks']; ?></td>
                                              </tr>
                                          <?php } ?>
                                      </tbody>
                                  </table>
                              <?php } else { ?>
                                  <p>No <strong>EXCUSE</strong> students found for this event.</p>
                              <?php } ?>
                          </div>

                          <!-- Exempted Students Tab -->
                          <div class="tab-pane" id="exempted">
                              <?php
                              // Query to fetch exempted students for the event
                              $studentsql = "SELECT user.account_number, user.username, user.first_name, user.last_name, user.middle_name, user.program, user.year_level, attendance.remarks 
                                            FROM attendance 
                                            JOIN user ON attendance.account_number = user.account_number 
                                            WHERE attendance.event_id = '$event_id' AND remarks = 'Exempted'
                                            ORDER BY attendance.account_number ASC";
                              $studentresult = $conn->query($studentsql);

                              if ($studentresult && $studentresult->num_rows > 0) { ?>
                                  <table class="table">
                                      <thead>
                                          <tr>
                                              <th class="col-2">Student Number</th>
                                              <th class="col-1">User Name</th>
                                              <th class="col-2 text-center">Last Name</th>
                                              <th class="col-2 text-center">First Name</th>
                                              <th class="col-2 text-center">Middle Name</th>
                                              <th class="col-1 text-center">Program</th>
                                              <th class="col-1 text-center">Year Level</th>
                                              <th class="col-1 text-center">Remarks</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php while ($studentrow = $studentresult->fetch_assoc()) { ?>
                                              <tr>
                                                  <td class="align-middle"><?php echo $studentrow['account_number']; ?></td>
                                                  <td class="align-middle"><?php echo $studentrow['username']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['last_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['first_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['middle_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['program']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['year_level']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['remarks']; ?></td>
                                              </tr>
                                          <?php } ?>
                                      </tbody>
                                  </table>
                              <?php } else { ?>
                                  <p>No <strong>EXEMPTED</strong> students found for this event.</p>
                              <?php } ?>
                          </div>

                          <!-- Working Students Tab -->
                          <div class="tab-pane" id="working">
                              <?php
                              // Query to fetch working students for the event
                              $studentsql = "SELECT user.account_number, user.username, user.first_name, user.last_name, user.middle_name, user.program, user.year_level, attendance.remarks 
                                            FROM attendance 
                                            JOIN user ON attendance.account_number = user.account_number 
                                            WHERE attendance.event_id = '$event_id' AND remarks = 'Working'
                                            ORDER BY attendance.account_number ASC";
                              $studentresult = $conn->query($studentsql);

                              if ($studentresult && $studentresult->num_rows > 0) { ?>
                                  <table class="table">
                                      <thead>
                                          <tr>
                                              <th class="col-2">Student Number</th>
                                              <th class="col-1">User Name</th>
                                              <th class="col-2 text-center">Last Name</th>
                                              <th class="col-2 text-center">First Name</th>
                                              <th class="col-2 text-center">Middle Name</th>
                                              <th class="col-1 text-center">Program</th>
                                              <th class="col-1 text-center">Year Level</th>
                                              <th class="col-1 text-center">Remarks</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php while ($studentrow = $studentresult->fetch_assoc()) { ?>
                                              <tr>
                                                  <td class="align-middle"><?php echo $studentrow['account_number']; ?></td>
                                                  <td class="align-middle"><?php echo $studentrow['username']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['last_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['first_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['middle_name']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['program']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['year_level']; ?></td>
                                                  <td class="align-middle text-center"><?php echo $studentrow['remarks']; ?></td>
                                              </tr>
                                          <?php } ?>
                                      </tbody>
                                  </table>
                              <?php } else { ?>
                                  <p>No <strong>WORKING</strong> students found for this event.</p>
                              <?php } ?>
                          </div>
                      </div>
                  </div>


                </div>
                <!-- /.card -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include 'layout/fixed-footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="AdminLTE-3.2.0/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="AdminLTE-3.2.0/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="AdminLTE-3.2.0/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="AdminLTE-3.2.0/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="AdminLTE-3.2.0/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="AdminLTE-3.2.0/plugins/moment/moment.min.js"></script>
<script src="AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="AdminLTE-3.2.0/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="AdminLTE-3.2.0/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="AdminLTE-3.2.0/dist/js/pages/dashboard.js"></script>
</body>
</html>
<?php
} else {
header("Location: login.php");
exit();
}
?>
