<!-- admin-officer.php and to show the list of officers in admin form.
Authors:
  - Lowie Jay Orillo (lowie.jaymier@gmail.com)
  - Caryl Mae Subaldo (subaldomae29@gmail.com)
  - Brian Angelo Bognot (c09651052069@gmail.com)
Last Modified: May 15, 2024
Brief overview of the file's contents. -->

<?php
session_start();
include "indexes/db_conn.php";
if (isset($_SESSION['role']) && $_SESSION['role'] === 'Student') { // Check if the role is set and it's 'Admin'
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ITE Student Portal | Admin Home Page</title>
    <link rel="icon" type="image/png" href="favicon.ico" />
    <link rel="stylesheet" type="text/css" href="qr-code.css">

   

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
      <!-- Header and Sidebar included here -->
      <?php include 'layout/topnav.php'; ?>
      <?php include 'layout/sidebar.php'; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">My QR Code / e-Attendance Card</h1>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div><!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-6">
                <div class="card-wrapper">
                  <div class="card card-danger card-outline bg-white background-card custom-height" for="schoolyear">
                    <div class="card-body">
                      <img src="qrCodeImages/2211600102.png" alt="QR Code" class="qr-code">
                      <div class="info-table">
                        <table>
                          <tr>
                            <td>NAME</td>
                          </tr>
                          <tr>
                            <th>
                              <?php
                              $last_name = strtoupper($_SESSION['last_name']); // Convert last name to uppercase
                              $first_name = strtoupper($_SESSION['first_name']); // Convert first name to uppercase
                              $middle_name = strtoupper($_SESSION['middle_name']); // Convert middle name to uppercase
                              $middle_initial = strtoupper(substr($middle_name, 0, 1)); // Get the first letter of the middle name and convert it to uppercase
                              echo $last_name . ', ' . $first_name . ' ' . $middle_initial . '.';
                              ?>
                            </th>
                          </tr>
                          <tr>
                            <td>PROGRAM</td>
                          </tr>
                          <tr>
                            <th><?php echo $_SESSION['program']; ?></th>
                          </tr>
                          <tr>
                            <td>STUDENT NO.</td>
                          </tr>
                          <tr>
                            <th><?php echo $_SESSION['account_number']; ?></th>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <!-- /.content-wrapper -->
      <?php include 'layout/fixed-footer.php'; ?>
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
        <!-- Header and Sidebar included here -->
        <?php include 'layout/topnav.php'; ?>
        <?php include 'layout/sidebar.php'; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0">My QR Code / e-Attendance Card</h1>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div><!-- /.content-header -->
          <!-- Main content -->
          <section class="content">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-md-6">
                  <div class="card-wrapper">
                    <div class="card card-danger card-outline bg-white background-card custom-height" for="schoolyear">
                      <div class="card-body">
                        <img src="qrCodeImages/2211600102.png" alt="QR Code" class="qr-code">
                        <div class="info-table">
                          <table>
                            <tr>
                              <td>NAME</td>
                            </tr>
                            <tr>
                              <th>
                                <?php
                                $last_name = strtoupper($_SESSION['last_name']); // Convert last name to uppercase
                                $first_name = strtoupper($_SESSION['first_name']); // Convert first name to uppercase
                                $middle_name = strtoupper($_SESSION['middle_name']); // Convert middle name to uppercase
                                $middle_initial = strtoupper(substr($middle_name, 0, 1)); // Get the first letter of the middle name and convert it to uppercase
                                echo $last_name . ', ' . $first_name . ' ' . $middle_initial . '.';
                                ?>
                              </th>
                            </tr>
                            <tr>
                              <td>PROGRAM</td>
                            </tr>
                            <tr>
                              <th><?php echo $_SESSION['program']; ?></th>
                            </tr>
                            <tr>
                              <td>STUDENT NO.</td>
                            </tr>
                            <tr>
                              <th><?php echo $_SESSION['account_number']; ?></th>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <!-- /.content-wrapper -->
        <?php include 'layout/fixed-footer.php'; ?>
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