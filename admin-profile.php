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
        <title>AdminLTE 3 | User Profile</title>
        <link rel="icon" type="image/ico" href="favicon.ico">

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="AdminLTE-3.2.0/dist/css/adminlte.min.css">
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <?php include 'layout/admin-fixed-topnav.php'; ?>

            <?php include 'layout/admin-sidebar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1>Profile</h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                        <li class="breadcrumb-item active">User Profile</li>
                                    </ol>
                                </div>
                            </div>


                            <?php if (isset($_GET['error'])) { ?>
                                <div class="alert alert-danger">
                                    <?php echo $_GET['error']; ?>
                                </div>
                            <?php } ?>

                            <?php if (isset($_GET['success'])) { ?>
                                <div class="alert alert-success">
                                    <?php echo $_GET['success']; ?>
                                </div>
                            <?php } ?>
                        </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="row justify-content-center">
                                            <div class="text-center"> <!-- Center the column content -->
                                                <!-- displaying the profile picture -->
                                                <img class="profile-picture img-fluid rounded-circle" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;"
                                                    src="profile-pictures/<?php echo $_SESSION['profile_picture']; ?>?<?php echo time(); ?>"
                                                    alt="User profile picture">
                                            </div>
                                        </div>

                                        <!-- Concatinating Full name -->
                                        <h3 class="text-center">
                                            <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['middle_name'] . ' ' . $_SESSION['last_name']; ?>
                                        </h3>
                                        <!--  diplaying username starts with @ -->
                                        <p class="text-muted text-center">@<?php echo $_SESSION['username']; ?>
                                        </p>
                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <!-- Displaying Lastname -->
                                                <b>Last Name</b> <a class="float-right">
                                                    <?php echo $_SESSION['last_name']; ?>
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <!-- Displaying First name -->
                                                <b>First Name</b> <a class="float-right">
                                                    <?php echo $_SESSION['first_name']; ?>
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <!-- Displaying Middle name -->
                                                <b>Middle Name</b> <a class="float-right">
                                                    <?php echo $_SESSION['middle_name']; ?>
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <!-- Displaying Middle name -->
                                                <b>Account Number</b> <a class="float-right">
                                                    <?php echo $_SESSION['account_number']; ?>
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <!-- Displaying Middle name -->
                                                <b>Role</b> <a class="float-right">
                                                    <?php echo $_SESSION['role']; ?>
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <!-- Displaying gender -->
                                                <b>Gender</b> <a class="float-right">
                                                    <?php echo $_SESSION['gender']; ?>
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <!-- Displaying Phone Number -->
                                                <b>Phone Number</b>
                                                <a class="float-right">
                                                    <?php echo $_SESSION['phone_number']; ?>
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <!-- Displaying email -->
                                                <b>Email Address</b> <a class="float-right">
                                                    <?php echo $_SESSION['email']; ?>
                                                </a>
                                            </li>
                                            <br>
                                            <a href="admin-profile-setting.php" class="btn btn-primary btn-block">Edit my
                                                profile</a>

                                        </ul>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->

            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 3.2.0
                </div>
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
                reserved.
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
        <!-- Bootstrap 4 -->
        <script src="AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- <script src="AdminLTE-3.2.0/dist/js/demo.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </body>

    </html>
    <?php
} else {
    header("Location: login-v2.php");
    exit();
}
?>