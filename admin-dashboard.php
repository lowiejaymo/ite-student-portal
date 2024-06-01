<!-- admin-dashboard.php and to see the total numbers of student and officer, 
  population of every department and each year level in admin form.
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
      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="images/ite.png" alt="AdminLTELogo" height="60" width="60">
      </div>

      <!-- Navbar -->
      <?php include 'layout/admin-fixed-topnav.php'; ?>

      <?php include 'layout/admin-sidebar.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <?php
              $officerquery = "SELECT COUNT(*) AS count FROM user WHERE role = 'Officer'";
              $officerresult = mysqli_query($conn, $officerquery);

              $rofficerow = mysqli_fetch_assoc($officerresult);
              $officercount = $rofficerow['count'];
              ?>

              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h1 style="font-size: 50px;"><strong><?php echo $officercount; ?></strong></h1>
                    <p>Officer/s</p>
                  </div>
                  <div class="icon">
                    <i class="nav-icon fas fa-solid fa-user-tie"></i>
                  </div>
                  <a href="admin-officer.php" class="small-box-footer">More info <i
                      class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <?php
              $studentquery = "SELECT COUNT(*) AS count FROM user WHERE role = 'Student'";
              $studentresult = mysqli_query($conn, $studentquery);

              $studentrow = mysqli_fetch_assoc($studentresult);
              $studentcount = $studentrow['count'];
              ?>

              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h1 style="font-size: 50px;"><strong><?php echo $studentcount; ?></strong></h1>
                    <p>Student/s</p>
                  </div>
                  <div class="icon">
                    <i class="nav-icon fas fa-solid fa-users"></i>
                  </div>
                  <a href="admin-students.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <?php
                  $studentquery = "SELECT COUNT(*) AS count FROM user WHERE role = 'Student'";
                  $studentresult = mysqli_query($conn, $studentquery);

                  $studentrow = mysqli_fetch_assoc($studentresult);
                  $studentcount = $studentrow['count'];
                  ?>

                  <div class="card-header">
                    <h5 class="card-title">Department Demographics </h5>
                  </div>

                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-8">

                        <!-- /.chart-responsive -->
                      </div>
                      <!-- /.col -->
                      <div class="col-md-12">
                        <div class="progress-group">
                          <span class="progress-text">BSIT | Bachelor of Science in Information Technology</span>
                          <?php
                          $BSITProgramquery = "SELECT COUNT(*) AS count FROM user WHERE program = 'BSIT'";
                          $BSITProgramresult = mysqli_query($conn, $BSITProgramquery);

                          $BSITProgramrow = mysqli_fetch_assoc($BSITProgramresult);
                          $BSITProgramcount = $BSITProgramrow['count'];

                          $BSITpercentage = ($studentcount != 0) ? ($BSITProgramcount / $studentcount) * 100 : 0;
                          ?>
                          <span
                            class="float-right"><b><?php echo $BSITProgramcount; ?></b> student/s</span>
                          <div class="progress progress-md">
                            <div class="progress-bar bg-primary" style="width: <?php echo $BSITpercentage; ?>%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->

                        <div class="progress-group">
                          <span class="progress-text">BSCS | Bachelor of Science in Computer Science</span>
                          <?php
                          $BSCSProgramquery = "SELECT COUNT(*) AS count FROM user WHERE program = 'BSCS'";
                          $BSCSProgramresult = mysqli_query($conn, $BSCSProgramquery);

                          $BSCSProgramrow = mysqli_fetch_assoc($BSCSProgramresult);
                          $BSCSProgramcount = $BSCSProgramrow['count'];

                          $BSCSpercentage = ($studentcount != 0) ? ($BSCSProgramcount / $studentcount) * 100 : 0;
                          ?>
                          <span
                            class="float-right"><b><?php echo $BSCSProgramcount; ?></b> student/s</span>
                          <div class="progress progress-md">
                            <div class="progress-bar bg-success" style="width: <?php echo $BSCSpercentage; ?>%"></div>
                          </div>
                        </div>

                        <!-- /.progress-group -->
                        <div class="progress-group">
                          <span class="progress-text">BLIS | Bachelor of Library and Information Science</span>
                          <?php
                          $BLISProgramquery = "SELECT COUNT(*) AS count FROM user WHERE program = 'BLIS'";
                          $BLISProgramresult = mysqli_query($conn, $BLISProgramquery);

                          $BLISProgramrow = mysqli_fetch_assoc($BLISProgramresult);
                          $BLISProgramcount = $BLISProgramrow['count'];

                          $BLISpercentage = ($studentcount != 0) ? ($BLISProgramcount / $studentcount) * 100 : 0;
                          ?>
                          <span
                            class="float-right"><b><?php echo $BLISProgramcount; ?></b> student/s</span>
                          <div class="progress progress-md">
                            <div class="progress-bar bg-warning" style="width: <?php echo $BLISpercentage; ?>%"></div>
                          </div>
                        </div>

                        <!-- /.progress-group -->
                        <div class="progress-group">
                          <span class="progress-text">ACT | Associate in Computer Technology</span>
                          <?php
                          $ACTProgramquery = "SELECT COUNT(*) AS count FROM user WHERE program = 'ACT'";
                          $ACTProgramresult = mysqli_query($conn, $ACTProgramquery);

                          $ACTProgramrow = mysqli_fetch_assoc($ACTProgramresult);
                          $ACTProgramcount = $ACTProgramrow['count'];

                          $ACTpercentage = ($studentcount != 0) ? ($ACTProgramcount / $studentcount) * 100 : 0;
                          ?>
                          <span
                            class="float-right"><b><?php echo $ACTProgramcount; ?></b> student/s</span>
                          <div class="progress progress-md">
                            <div class="progress-bar bg-danger" style="width: <?php echo $ACTpercentage; ?>%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- ./card-body -->
                  <div class="card-footer">
                    <div class="row">
                      <?php
                      $studentquery = "SELECT COUNT(*) AS count FROM user WHERE role = 'Student'";
                      $studentresult = mysqli_query($conn, $studentquery);

                      $studentrow = mysqli_fetch_assoc($studentresult);
                      $studentcount = $studentrow['count'];
                      ?>
                      <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                          <?php
                          $firstYearquery = "SELECT COUNT(*) AS count FROM user WHERE year_level = '1'";
                          $firstYearresult = mysqli_query($conn, $firstYearquery);

                          $firstYearrow = mysqli_fetch_assoc($firstYearresult);
                          $firstYearcount = $firstYearrow['count'];

                          $firstYearpercentage = ($studentcount != 0) ? ($firstYearcount / $studentcount) * 100 : 0;

                          $formattedfirstYearpercentage = number_format($firstYearpercentage, 2);
                          ?>
                          <span class="description-percentage"><?php echo $formattedfirstYearpercentage; ?>%</span>
                          <h5 class="description-header"><?php echo $firstYearcount; ?> Students</h5>
                          <span class="description-text">1st Year</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                          <?php
                          $secondYearquery = "SELECT COUNT(*) AS count FROM user WHERE year_level = '2'";
                          $secondYearresult = mysqli_query($conn, $secondYearquery);

                          $secondYearrow = mysqli_fetch_assoc($secondYearresult);
                          $secondYearcount = $secondYearrow['count'];

                          $secondYearpercentage = ($studentcount != 0) ? ($secondYearcount / $studentcount) * 100 : 0;
                          $formattedsecondYearpercentage = number_format($secondYearpercentage, 2);
                          ?>
                          <span class="description-percentage"><?php echo $formattedsecondYearpercentage; ?>%</span>
                          <h5 class="description-header"><?php echo $secondYearcount; ?> Students</h5>
                          <span class="description-text">2nd Year</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                          <?php
                          $thirdYearquery = "SELECT COUNT(*) AS count FROM user WHERE year_level = '3'";
                          $thirdYearresult = mysqli_query($conn, $thirdYearquery);

                          $thirdYearrow = mysqli_fetch_assoc($thirdYearresult);
                          $thirdYearcount = $thirdYearrow['count'];

                          $thirdYearpercentage = ($studentcount != 0) ? ($thirdYearcount / $studentcount) * 100 : 0;

                          $formattedthirdYearpercentage = number_format($thirdYearpercentage, 2);
                          ?>
                          <span class="description-percentage"><?php echo $formattedthirdYearpercentage; ?>%</span>
                          <h5 class="description-header"><?php echo $thirdYearcount; ?> Students</h5>
                          <span class="description-text">3rd Year</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-3 col-6">
                        <div class="description-block ">
                          <?php
                          $fourthYearquery = "SELECT COUNT(*) AS count FROM user WHERE year_level = '4'";
                          $fourthYearresult = mysqli_query($conn, $fourthYearquery);

                          $fourthYearrow = mysqli_fetch_assoc($fourthYearresult);
                          $fourthYearcount = $fourthYearrow['count'];

                          $fourthYearpercentage = ($studentcount != 0) ? ($fourthYearcount / $studentcount) * 100 : 0;
                          $formattedfourthYearpercentage = number_format($fourthYearpercentage, 2);
                          ?>
                          <span class="description-percentage"><?php echo $formattedfourthYearpercentage; ?>%</span>
                          <h5 class="description-header"><?php echo $fourthYearcount; ?>  Students</h5>
                          <span class="description-text">4th Year</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
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