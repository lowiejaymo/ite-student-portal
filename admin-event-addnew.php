<!-- admin-event-addnew.php and to add new event in admin form.
Authors:
  - Lowie Jay Orillo (lowie.jaymier@gmail.com)
  - Caryl Mae Subaldo (subaldomae29@gmail.com)
  - Brian Angelo Bognot (c09651052069@gmail.com)
Last Modified: May 15, 2024
Brief overview of the file's contents. -->

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
    <title>ITE Student Portal | Admin Home Page</title>
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
      <?php include 'layout/admin-fixed-topnav.php'; ?>

      <?php include 'layout/admin-sidebar.php'; ?>

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

                    <form action="indexes/admin-add-event-be.php" method="post">

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
                              <input type="date" class="form-control" name="date" id="date" value="<?php echo $_GET['date']; ?>">
                          <?php } else { ?>
                            <input type="date" class="form-control" name="date" id="date">
                          <?php } ?>
                        </div>
                      </div>
                    

                      <label for="schoolyear" class="col-sm-4 col-form-label">School Year</label>
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <?php if (isset($_GET['schoolyear'])) { ?>
                            <select class="form-control" id="yearlevel" name="schoolyear">
                              <option value="" disabled <?php if ($_GET['schoolyear'] == '')
                                echo 'selected'; ?>>(Required)
                              </option>
                              <option value="2023-2024" <?php if ($_GET['schoolyear'] == '2023-2024')
                                echo 'selected'; ?>>2023-2024</option>
                              <option value="2024-2025" <?php if ($_GET['schoolyear'] == '2024-2025')
                                echo 'selected'; ?>>2024-2025</option>
                              <option value="2025-2026" <?php if ($_GET['schoolyear'] == '2025-2026')
                                echo 'selected'; ?>>2025-2026</option>
                              <option value="2026-2027" <?php if ($_GET['schoolyear'] == '2026-2027')
                                echo 'selected'; ?>>2026-2027</option>
                            </select>
                          <?php } else { ?>
                            <select class="form-control" id="schoolyear" name="schoolyear">
                              <option value="" selected disabled>(Required)</option>
                              <option value="2023-2024">2023-2024</option>
                              <option value="2024-2025">2024-2025</option>
                              <option value="2025-2026">2025-2026</option>
                              <option value="2026-2027">2026-2027</option>
                            </select>
                          <?php } ?>
                        </div>
                      </div>


                      <label for="semester" class="col-sm-4 col-form-label">Semester</label>
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <?php if (isset($_GET['semester'])) { ?>
                            <select class="form-control" id="semester" name="semester">
                              <option value="" disabled <?php if ($_GET['semester'] == '')
                                echo 'selected'; ?>>(Required)
                              </option>
                              <option value="First" <?php if ($_GET['semester'] == 'First')
                                echo 'selected'; ?>>First Semester </option>
                              <option value="Second" <?php if ($_GET['semester'] == 'Second')
                                echo 'selected'; ?>>Second Semester</option>
                              <option value="Third" <?php if ($_GET['semester'] == 'Third')
                                echo 'selected'; ?>>Third Semester</option>
                            </select>
                          <?php } else { ?>
                            <select class="form-control" id="semester" name="semester">
                              <option value="" selected disabled>(Required)</option>
                              <option value="First">First Semester</option>
                              <option value="Second">Second Semester</option>
                              <option value="Third">Third Semester</option>
                            </select>
                          <?php } ?>
                        </div>
                      </div>


                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" value="Submit" name="addEvent" class="btn btn-success">Add</button>
                        <a type="button" name="cancel" class="btn btn-secondary" href="admin-events.php">Cancel</a>
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
      <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 3.2.0
        </div>
      </footer>

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