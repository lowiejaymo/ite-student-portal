<!-- Officer-event-addnew.php and to add new event in Officer form.
Authors:
  - Lowie Jay Orillo (lowie.jaymier@gmail.com)
  - Caryl Mae Subaldo (subaldomae29@gmail.com)
  - Brian Angelo Bognot (c09651052069@gmail.com)
Last Modified: May 15, 2024
Brief overview of the file's contents. -->

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
      <?php include 'layout/officer-fixed-topnav.php'; ?>

      <?php include 'layout/officer-sidebar.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2 align-items-center">
              <div class="col-sm-6">
                <h1>Add New Event</h1>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </div><!-- /.container-fluid -->

        <!-- /.content-header -->

        <!-- Main content -->
        <!-- Main content -->
        <section class="content">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="card card-primary card-outline bg-white" for="new-subject">
                  <div class="card-header">
                    <!-- add New Subject -->
                    <h3 class="card-title text-center" style="font-size: 1.25rem; font-weight: bold;">
                      New Event</h3><br>


                    <hr>

                    <form action="indexes/officer-add-event-be.php" method="post">

                      <?php if (isset($_GET['newEventError'])) { ?>
                        <div class="alert alert-danger">
                          <?php echo $_GET['newEventError']; ?>
                        </div>
                      <?php } ?>

                      <label for="eventname" class="col-sm-4 col-form-label">Event Name</label>
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <?php if (isset($_GET['eventname'])) { ?>
                            <input type="text" class="form-control" id="eventname" name="eventname" placeholder="(Required)"
                              value="<?php echo $_GET['eventname']; ?>">
                          <?php } else { ?>
                            <input type="text" class="form-control" id="eventname" name="eventname"
                              placeholder="(Required)">
                          <?php } ?>
                        </div>
                      </div>


                      <label for="date" class="col-sm-4 col-form-label">Date</label>
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <?php if (isset($_GET['date'])) { ?>
                            <input type="date" class="form-control" name="date" id="date"
                              value="<?php echo $_GET['date']; ?>">
                          <?php } else { ?>
                            <input type="date" class="form-control" name="date" id="date">
                          <?php } ?>
                        </div>
                      </div>


                      <label for="school_year" class="col-sm-4 col-form-label">School Year</label>
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <?php
                          // Assuming you have a database connection already established
                          $schoolYearQuery = "SELECT * FROM school_year";
                          $result = mysqli_query($conn, $schoolYearQuery);

                          // Fetch all school years
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
                            <option value="" disabled <?php if (!isset($_GET['school_year']))
                              echo 'selected'; ?>>
                              (Required)</option>
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


                      <label for="semester" class="col-sm-4 col-form-label">Semester</label>
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <?php
                          // Assuming you have a database connection already established
                          $query = "SELECT * FROM semester";
                          $result = mysqli_query($conn, $query);

                          // Fetch all semesters
                          $semesters = []; // Renamed to $semesters
                          $defaultsemester = '';

                          if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                              $semesters[] = $row;
                              if ($row['dfault'] == 1) {
                                $defaultsemester = $row['semester'];
                              }
                            }
                          }
                          ?>

                          <select class="form-control" id="semester" name="semester">
                            <option value="" disabled <?php if (!isset($_GET['semester']))
                              echo 'selected'; ?>>(Required)
                            </option>
                            <?php foreach ($semesters as $semester) { ?> <!-- Changed $semester to $semesters -->
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

                      <label for="points" class="col-sm-4 col-form-label">Points</label>
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <?php if (isset($_GET['points'])) { ?>
                            <input type="text" class="form-control" id="points" name="points" placeholder="(Required)"
                              value="<?php echo $_GET['points']; ?>">
                          <?php } else { ?>
                            <input type="text" class="form-control" id="points" name="points" placeholder="(Required)">
                          <?php } ?>
                        </div>
                      </div>


                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" value="Submit" name="addEvent" class="btn btn-success">Add</button>
                        <a type="button" name="cancel" class="btn btn-secondary" href="officer-events.php">Cancel</a>
                      </div>

                    </form>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
          </div>
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