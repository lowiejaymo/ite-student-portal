<!-- officer-dashboard.php and ---- in officer form.
Authors:
  - Lowie Jay Orillo (lowie.jaymier@gmail.com)
  - Caryl Mae Subaldo (subaldomae29@gmail.com)
  - Brian Angelo Bognot (c09651052069@gmail.com)
Last Modified: June 18, 2024
Brief overview of the file's contents. -->

<?php
session_start();
include "indexes/db_conn.php";
if (isset($_SESSION['role']) && $_SESSION['role'] === 'Student') {
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Attendance | ITE Student Portal</title>
    <link rel="icon" type="image/png" href="favicon.ico" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
      <?php include 'layout/topnav.php'; ?>

      <?php include 'layout/sidebar.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">My Attendance</h1>
              </div><!-- /.col -->

            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">

            <!-- Search Form -->
            <form method="GET" action="">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group row">
                    <label for="school_year" class="col-sm-4 col-form-label">School Year</label>
                    <div class="col-sm-8">
                      <?php
                      $schoolYearQuery = "SELECT * FROM school_year";
                      $result = mysqli_query($conn, $schoolYearQuery);
                      $schoolYears = [];
                      $defaultYear = '';

                      if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                          $schoolYears[] = $row;
                          if ($row['dfault'] == 1) {
                            $defaultYear = $row['school_year'];
                          }
                        }
                      }
                      ?>
                      <select class="form-control" id="school_year" name="school_year">
                        <option value="All" <?php if (isset($_GET['school_year']) && $_GET['school_year'] == 'All')
                          echo 'selected'; ?>>All</option>
                        <?php foreach ($schoolYears as $year) { ?>
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
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group row">
                    <label for="semester" class="col-sm-4 col-form-label">Semester</label>
                    <div class="col-sm-8">
                      <?php
                      $query = "SELECT * FROM semester";
                      $result = mysqli_query($conn, $query);
                      $semesters = [];
                      $defaultSemester = '';

                      if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                          $semesters[] = $row;
                          if ($row['dfault'] == 1) {
                            $defaultSemester = $row['semester'];
                          }
                        }
                      }
                      ?>
                      <select class="form-control" id="semester" name="semester">
                        <option value="" <?php if (!isset($_GET['semester']))
                          echo 'selected'; ?>>All</option>
                        <?php foreach ($semesters as $semester) { ?>
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
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-outline-secondary">Search</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>

            <!-- Events table -->
            <table class="table">
              <thead>
                <tr>
                  <th class="col-4">Event Name</th>
                  <th class="col-2 text-center">Date</th>
                  <th class="col-2 text-center">School Year</th>
                  <th class="col-2 text-center">Semester</th>
                  <th class="col-2 text-center">Points</th>
                  <th class="col-2 text-center">Remarks</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $semester_condition = "";
                if (isset($_GET['semester']) && $_GET['semester'] != "") {
                  $semester_condition = "AND e.semester = '" . $_GET['semester'] . "'";
                }

                $school_year_condition = "";
                if (isset($_GET['school_year']) && $_GET['school_year'] != "All") {
                  $school_year_condition = "AND e.school_year = '" . $_GET['school_year'] . "'";
                }

                $account_number = $_SESSION['account_number'];

                $query = "SELECT 
                      e.event_name, 
                      e.date, 
                      e.school_year, 
                      e.semester, 
                      e.points, 
                      a.remarks
                  FROM 
                      events e
                  JOIN 
                      attendance a ON e.event_id = a.event_id
                  WHERE 
                      a.account_number = '$account_number' 
                      $semester_condition 
                      $school_year_condition";

                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                      <td class="align-middle">
                        <?php echo $row['event_name']; ?>
                      </td>
                      <td class="align-middle text-center">
                        <?php echo $row['date']; ?>
                      </td>
                      <td class="align-middle text-center">
                        <?php echo $row['school_year']; ?>
                      </td>
                      <td class="align-middle text-center">
                        <?php echo $row['semester']; ?>
                      </td>
                      <td class="align-middle text-center">
                        <?php echo $row['points']; ?>
                      </td>
                      <td class="align-middle text-center">
                        <?php
                        $remarks = $row['remarks'];
                        if ($remarks == 'Present') {
                          echo '<button type="button" class="btn btn-success btn-sm" disabled>Present</button>';
                        } elseif ($remarks == 'Absent') {
                          echo '<button type="button" class="btn btn-danger btn-sm" disabled>Absent</button>';
                        } elseif ($remarks == 'Pending') {
                          echo '<button type="button" class="btn btn-secondary btn-sm" disabled>Pending</button>';
                        } elseif (in_array($remarks, ['Excused', 'Exempted', 'Working'])) {
                          echo '<button type="button" class="btn btn-warning btn-sm" disabled>' . $remarks . '</button>';
                        }
                        ?>
                      </td>
                    </tr>
                    <?php
                  }
                } else {
                  echo "<tr><td colspan='6'>No data found.</td></tr>"; // Updated colspan to 6
                }
                ?>
              </tbody>
            </table>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>


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