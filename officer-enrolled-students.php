<?php
session_start();
include "indexes/db_conn.php";
if (isset($_SESSION['role']) && $_SESSION['role'] === 'Officer') { // Check if the role is set and it's 'Officer'
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ITE Student Portal | Officer Home Page</title>
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
      <?php include 'layout/officer-fixed-topnav.php'; ?>

      <!-- Sidebar -->
      <?php include 'layout/officer-sidebar.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2 align-items-center">
              <div class="col-sm-6">
                <h1>Enrolled Students</h1>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">

            <!-- Search Form -->
            <form method="GET">
              <div class="form-group row mb-3">
                <div class="col-sm-3">
                  <select class="form-control" id="school_year" name="school_year" required>
                    <option value="" disabled selected>School Year</option>
                    <?php
                    // Fetch school years from database
                    $schoolYearsQuery = "SELECT school_year, dfault FROM school_year";
                    $schoolYearsResult = $conn->query($schoolYearsQuery);
                    while ($year = $schoolYearsResult->fetch_assoc()) { ?>
                      <option value="<?php echo $year['school_year']; ?>" <?php
                        if (isset($_GET['school_year']) && $_GET['school_year'] == $year['school_year']) {
                          echo 'selected';
                        } elseif (!isset($_GET['school_year']) && $year['dfault'] == 1) {
                          echo 'selected';
                        }
                        ?>>
                        <?php echo $year['school_year']; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-sm-3">
                  <select class="form-control" id="semester" name="semester" required>
                    <option value="" disabled selected>Semester</option>
                    <?php
                    // Fetch semesters from database
                    $semestersQuery = "SELECT semester, dfault FROM semester";
                    $semestersResult = $conn->query($semestersQuery);
                    while ($semester = $semestersResult->fetch_assoc()) { ?>
                      <option value="<?php echo $semester['semester']; ?>" <?php
                        if (isset($_GET['semester']) && $_GET['semester'] == $semester['semester']) {
                          echo 'selected';
                        } elseif (!isset($_GET['semester']) && $semester['dfault'] == 1) {
                          echo 'selected';
                        }
                        ?>>
                        <?php echo $semester['semester']; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-sm-2">
                  <select class="form-control" id="program" name="program" required>
                    <option value="" disabled selected>Program</option>
                    <option value="BSIT" <?php if (isset($_GET['program']) && $_GET['program'] == 'BSIT') echo 'selected'; ?>>BSIT</option>
                    <option value="BSCS" <?php if (isset($_GET['program']) && $_GET['program'] == 'BSCS') echo 'selected'; ?>>BSCS</option>
                    <option value="BLIS" <?php if (isset($_GET['program']) && $_GET['program'] == 'BLIS') echo 'selected'; ?>>BLIS</option>
                    <option value="ACT" <?php if (isset($_GET['program']) && $_GET['program'] == 'ACT') echo 'selected'; ?>>ACT</option>
                  </select>
                </div>

                <div class="col-sm-2">
                  <select class="form-control" id="year_level" name="year_level" required>
                    <option value="" disabled selected>Year Level</option>
                    <option value="1" <?php if (isset($_GET['year_level']) && $_GET['year_level'] == '1') echo 'selected'; ?>>1</option>
                    <option value="2" <?php if (isset($_GET['year_level']) && $_GET['year_level'] == '2') echo 'selected'; ?>>2</option>
                    <option value="3" <?php if (isset($_GET['year_level']) && $_GET['year_level'] == '3') echo 'selected'; ?>>3</option>
                    <option value="4" <?php if (isset($_GET['year_level']) && $_GET['year_level'] == '4') echo 'selected'; ?>>4</option>
                  </select>
                </div>

                <div class="col-sm-2">
                  <button class="btn btn-outline-secondary" type="submit" name="search">Submit</button>
                </div>
              </div>
            </form>

            <!-- Display Messages -->
            <?php if (isset($_GET['newEventSuccess'])) { ?>
              <div class="alert alert-success">
                <?php echo $_GET['newEventSuccess']; ?>
              </div>
            <?php } ?>

            <?php if (isset($_GET['deleteEventSuccess'])) { ?>
              <div class="alert alert-success">
                <?php echo $_GET['deleteEventSuccess']; ?>
              </div>
            <?php } ?>

            <?php if (isset($_GET['deleteEventError'])) { ?>
              <div class="alert alert-danger">
                <?php echo $_GET['deleteEventError']; ?>
              </div>
            <?php } ?>

            <!-- Students table -->
            <?php
            if (isset($_GET['search'])) {

              function validate($data)
              {
                  $data = trim($data); // Remove whitespace from the beginning and end of string
                  $data = stripslashes($data); // Remove backslashes
                  $data = htmlspecialchars($data); // Convert special characters to HTML entities
                  return $data;
              }
              $school_year = validate($_GET['school_year']);
              $semester = validate($_GET['semester']);
              $program = validate($_GET['program']);
              $year_level = validate($_GET['year_level']);


            
              $studentsql = "SELECT u.account_number, u.last_name, u.first_name, u.middle_name, u.program, u.year_level, 
                                    e.account_number AS enrolled
                            FROM user u 
                            LEFT JOIN enrolled e ON u.account_number = e.account_number 
                            AND e.school_year = '$school_year' AND e.semester = '$semester'
                            WHERE u.role = 'Student' AND u.program = '$program' AND u.year_level = '$year_level'
                            ORDER BY enrolled ASC, u.account_number ASC";
              $result = $conn->query($studentsql);
            }            
            ?>
            <table class="table">
              <thead>
                <tr>
                  <th class="col-2">Student Number</th>
                  <th class="col-2">Last Name</th>
                  <th class="col-2">First Name</th>
                  <th class="col-2">Middle Name</th>
                  <th class="col-1 text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (isset($result) && $result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                      <td class="align-middle"><?php echo $row['account_number']; ?></td>
                      <td class="align-middle"><?php echo $row['last_name']; ?></td>
                      <td class="align-middle"><?php echo $row['first_name']; ?></td>
                      <td class="align-middle"><?php echo $row['middle_name']; ?></td>
                      <td class="align-middle text-center">
                        <?php if (isset($row['enrolled']) && $row['enrolled']) { ?>
                          <form method="POST" action="indexes/officer-unenroll.php">
                            <input type="hidden" name="account_number" value="<?php echo $row['account_number']; ?>">
                            <input type="hidden" name="school_year" value="<?php echo $school_year; ?>">
                            <input type="hidden" name="semester" value="<?php echo $semester; ?>">
                            <input type="hidden" name="program" value="<?php echo $program; ?>">
                            <input type="hidden" name="year_level" value="<?php echo $year_level; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Unenroll</button>
                          </form>
                        <?php } else { ?>
                          <form method="POST" action="indexes/officer-enroll.php">
                            <input type="hidden" name="account_number" value="<?php echo $row['account_number']; ?>">
                            <input type="hidden" name="school_year" value="<?php echo $school_year; ?>">
                            <input type="hidden" name="semester" value="<?php echo $semester; ?>">
                            <input type="hidden" name="program" value="<?php echo $program; ?>">
                            <input type="hidden" name="year_level" value="<?php echo $year_level; ?>">
                            <button type="submit" class="btn btn-success btn-sm">Enroll</button>
                          </form>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php }
                } else {
                  echo "<tr><td colspan='5'>No Student found.</td></tr>";
                }
                ?>
              </tbody>
            </table>
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
  </body>

  </html>
  <?php
} else {
  header("Location: login.php");
  exit();
}
?>
