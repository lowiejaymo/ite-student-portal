<!-- officer-student-view.php and to show the information of the student in officer form.
Author:
  Lowie Jay Orillo lowie.jaymier@gmail.com, 
  Caryl Mae Subaldo subaldomae29@gmail.com, 
  Brian Angelo Bognot c09651052069@gmail.com.
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
                <h1>Events</h1>
              </div>
              <div class="col-sm-6 text-right">
                <a id="addNewSubjectBtn" class="btn btn-secondary" href="officer-students.php"><i
                    class="nav-icon fas fa-solid fa-chevron-left"></i> Back to Student</a>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">

          <div class="card card-primary card-outline bg-white" for="update-profilepicture">
              <div class="card-header">
                <div class="row align-items-center">
                  <?php
                  if (isset($_GET['accountindx'])) {
                    $accountindx = $_GET['accountindx'];
                    $studentsql = "SELECT * FROM user WHERE account_indx = '$accountindx'";
                    $result = $conn->query($studentsql);

                    if ($result && $result->num_rows > 0) {
                      $row = $result->fetch_assoc(); // Fetching row as associative array
                      ?>
                      <!-- Image column -->
                      <div class="col-md-auto">
                        <img src="profile-pictures/<?php echo $row['profile_picture']; ?>" alt="Student Profile Picture" style="height: 10rem; width: 10rem; border-radius: 50%; object-fit: cover;">
                      </div>

                      <!-- Subject information column -->
                      <div class="col-md">
                        <div class="table-responsive">
                          <table class="subject-info">
                            <tr>
                              <td class="col-md-2"><strong>Student Number:</strong></td>
                              <td class="col-md-3"><?php echo $row['account_number']; ?></td>
                              <td class="col-md-2"><strong>Program:</strong></td>
                              <td class="col-md-3"><?php echo $row['program']; ?></td>
                            </tr>
                            <tr>
                              <td class="col-md-2"><strong>Username:</strong></td>
                              <td class="col-md-3"><?php echo $row['username']; ?></td>
                              <td class="col-md-2"><strong>Year Level:</strong></td>
                              <td class="col-md-3"><?php echo $row['year_level']; ?></td>
                            </tr>
                            <tr>
                              <td class="col-md-2"><strong>Last Name:</strong></td>
                              <td class="col-md-3"><?php echo $row['last_name']; ?></td>
                              <td class="col-md-2"><strong>QR Code:</strong></td>
                              <td class="col-md-3"><?php echo $row['code']; ?></td>
                            </tr>
                            <tr>
                              <td class="col-md-2"><strong>First Name:</strong></td>
                              <td class="col-md-3"><?php echo $row['first_name']; ?></td>
                              <td class="col-md-2"><strong>Email:</strong></td>
                              <td class="col-md-3"><?php echo $row['email']; ?></td>
                            </tr>
                            <tr>
                              <td class="col-md-2"><strong>Middle Name:</strong></td>
                              <td class="col-md-3"><?php echo $row['middle_name']; ?></td>
                              <td class="col-md-2"><strong>Phone Number:</strong></td>
                              <td class="col-md-3"><?php echo $row['phone_number']; ?></td>
                            </tr>
                            <tr>
                              <td class="col-md-2"><strong>Gender:</strong></td>
                              <td class="col-md-3"><?php echo $row['gender']; ?></td>
                              <td class="col-md-2"><strong>Enrolled By:</strong></td>
                              <td class="col-md-3"><?php echo $row['enrolled_by']; ?></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <?php
                    } else {
                      echo "<div class='col-md-12'>Event may not be existing.</div>";
                    }
                  }
                  ?>
                </div>
              </div>
            </div>

          </div><!-- /.container-fluid -->
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