<?php
session_start();
include "indexes/db_conn.php";
if (isset($_SESSION['role']) && $_SESSION['role'] === 'Officer') { // Check if the role is set and it's 'Admin'
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
      <?php include 'layout/officer-fixed-topnav.php'; ?>

      <?php include 'layout/officer-sidebar.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2 align-items-center">
              <div class="col-sm-6">
                <h1>Add New Student</h1>
              </div>
              <div class="col-sm-6 text-right">
                <a id="addNewOfficerBtn" class="btn btn-success" href="officer-student-addbulk.php"><i
                    class="nav-icon fas fa-solid fa-plus"></i> Add Bulk Students</a>
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
                      New Student</h3><br>
                    <p class="text-muted">Note: The default password is <strong>"surname + studentnumber"</strong>.</p>
                    <hr>

                    <?php if (isset($_GET['newStudentError'])) { ?>
                      <div class="alert alert-danger">
                        <?php echo $_GET['newStudentError']; ?>
                      </div>
                    <?php } ?>


                    <form action="indexes/add-student-be.php" method="post">

                      <!-- Account Number input -->
                      <label for="accountnumber" class="col-sm-4 col-form-label">Account Number</label>
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <?php if (isset($_GET['accountnumber'])) { ?>
                            <input type="text" class="form-control" id="accountnumber" name="accountnumber"
                              placeholder="(Required)" value="<?php echo $_GET['accountnumber']; ?>">
                          <?php } else { ?>
                            <input type="text" class="form-control" id="accountnumber" name="accountnumber"
                              placeholder="(Required)">
                          <?php } ?>
                        </div>
                      </div>


                      <!-- Last Name input -->
                      <label for="accountnumber" class="col-sm-4 col-form-label">Last Name</label>
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <?php if (isset($_GET['lastname'])) { ?>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="(Required)"
                              value="<?php echo $_GET['lastname']; ?>">
                          <?php } else { ?>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="(Required)">
                          <?php } ?>
                        </div>
                      </div>

                      <!-- First Name input -->
                      <label for="accountnumber" class="col-sm-4 col-form-label">First Name</label>
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <?php if (isset($_GET['firstname'])) { ?>
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="(Required)"
                              value="<?php echo $_GET['firstname']; ?>">
                          <?php } else { ?>
                            <input type="text" class="form-control" id="firstname" name="firstname"
                              placeholder="(Required)">
                          <?php } ?>
                        </div>
                      </div>

                      <!-- Middle Name input -->
                      <label for="accountnumber" class="col-sm-4 col-form-label">Middle Name</label>
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <?php if (isset($_GET['middlename'])) { ?>
                            <input type="text" class="form-control" id="middlename" name="middlename" placeholder=""
                              value="<?php echo $_GET['middlename']; ?>">
                          <?php } else { ?>
                            <input type="text" class="form-control" id="middlename" name="middlename" placeholder="">
                          <?php } ?>
                        </div>
                      </div>


                      <label for="position" class="col-sm-4 col-form-label">Program</label>
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <?php if (isset($_GET['program'])) { ?>
                            <select class="form-control" id="program" name="program">
                              <option value="" disabled <?php if ($_GET['program'] == '')
                                echo 'selected'; ?>>(Required)
                              </option>
                              <option value="BSIT" <?php if ($_GET['program'] == 'BSIT')
                                echo 'selected'; ?>>BSIT</option>
                              <option value="BSCS" <?php if ($_GET['program'] == 'BSCS')
                                echo 'selected'; ?>>BSCS</option>
                              <option value="BLIS" <?php if ($_GET['program'] == 'BLIS')
                                echo 'selected'; ?>>BLIS</option>
                              <option value="ACT" <?php if ($_GET['program'] == 'ACT')
                                echo 'selected'; ?>>ACT</option>
                            </select>
                          <?php } else { ?>
                            <select class="form-control" id="program" name="program">
                              <option value="" selected disabled>(Required)</option>
                              <option value="BSIT">BSIT</option>
                              <option value="BSCS">BSCS</option>
                              <option value="BLIS">BLIS</option>
                              <option value="ACT">ACT</option>
                            </select>
                          <?php } ?>
                        </div>
                      </div>

                      <label for="position" class="col-sm-4 col-form-label">Year Level</label>
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <?php if (isset($_GET['yearlevel'])) { ?>
                            <select class="form-control" id="yearlevel" name="yearlevel">
                              <option value="" disabled <?php if ($_GET['yearlevel'] == '')
                                echo 'selected'; ?>>(Required)
                              </option>
                              <option value="1" <?php if ($_GET['yearlevel'] == '1')
                                echo 'selected'; ?>>First Year</option>
                              <option value="2" <?php if ($_GET['yearlevel'] == '2')
                                echo 'selected'; ?>>Second Year</option>
                              <option value="3" <?php if ($_GET['yearlevel'] == '3')
                                echo 'selected'; ?>>Third Year</option>
                              <option value="4" <?php if ($_GET['yearlevel'] == '4')
                                echo 'selected'; ?>>Fourth Year</option>
                            </select>
                          <?php } else { ?>
                            <select class="form-control" id="program" name="program">
                              <option value="" selected disabled>(Required)</option>
                              <option value="1">First Year</option>
                              <option value="2">Second Year</option>
                              <option value="3">Third Year</option>
                              <option value="4">Fourth Year</option>
                            </select>
                          <?php } ?>
                        </div>
                      </div>

                      
                      <label for="position" class="col-sm-4 col-form-label">Gender</label>
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <?php if (isset($_GET['gender'])) { ?>
                            <select class="form-control" id="gender" name="gender">
                              <option value="" disabled <?php if ($_GET['gender'] == '')
                                echo 'selected'; ?>>(Required)
                              </option>
                              <option value="Male" <?php if ($_GET['gender'] == 'Male')
                                echo 'selected'; ?>>Male</option>
                              <option value="Female" <?php if ($_GET['gender'] == 'Female')
                                echo 'selected'; ?>>Female</option>
                            </select>
                          <?php } else { ?>
                            <select class="form-control" id="gender" name="gender">
                              <option value="" selected disabled>(Required)</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                          <?php } ?>
                        </div>
                      </div>


                      <!-- Email Address input -->
                      <label for="accountnumber" class="col-sm-4 col-form-label">Email Address</label>
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <?php if (isset($_GET['email'])) { ?>
                            <input type="email" class="form-control" id="email" name="email" placeholder=""
                              value="<?php echo $_GET['email']; ?>">
                          <?php } else { ?>
                            <input type="email" class="form-control" id="email" name="email" placeholder="">
                          <?php } ?>
                        </div>
                      </div>

                      <!-- Phone Number input -->
                      <label for="accountnumber" class="col-sm-4 col-form-label">Phone Number</label>
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <?php if (isset($_GET['phonenumber'])) { ?>
                            <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder=""
                              value="<?php echo $_GET['phonenumber']; ?>">
                          <?php } else { ?>
                            <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="">
                          <?php } ?>
                        </div>
                      </div>


                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" value="Submit" name="addStudent" class="btn btn-success">Add</button>
                        <a type="button" name="cancel" class="btn btn-secondary" href="officer-students.php">Cancel</a>
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