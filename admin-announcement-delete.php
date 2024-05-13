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
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Delete Announcement</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card card-danger card-outline bg-white" for="new-subject">
                                <div class="card-header">
                                    <h3 class="card-title text-center" style="font-size: 1.25rem; font-weight: bold;">
                                        Are you sure you want to delete this announcement?</h3><br>
                                    <p class="text-muted">Note: You cannot able to retrieve this announcement after
                                        deleting it.</p>

                                    <hr>

                                    <?php if (isset($_GET['newaAnnouncementError'])) { ?>
                                        <div class="alert alert-danger">
                                            <?php echo $_GET['newaAnnouncementError']; ?>
                                        </div>
                                    <?php } ?>


                                    <form style="width: 100%" action="indexes/admin-announcement-delete-be.php"
                                        method="post">
                                        <?php
                                        $announcement_id = $_GET['announcement_id'];
                                        $sql = "SELECT * FROM announcement WHERE announcement_id = $announcement_id";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $heading = $row['heading'];
                                                $content = $row['content'];
                                                $posted_by = $row['posted_by'];
                                                $created_on = $row['created_on'];
                                                $formatted_date = date("F j, Y \a\\t g:i A", strtotime($created_on));
                                                ?>
                                                <!-- Heading input -->
                                                <label for="Announcement Heading"
                                                    class="col-sm-4 col-form-label">Heading</label>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="heading"
                                                            name="heading" placeholder="(Required)"
                                                            value="<?php echo $heading; ?>">
                                                    </div>
                                                </div>

                                                <!-- Content input -->
                                                <label for="announcement content"
                                                    class="col-sm-4 col-form-label">Content</label>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" id="content" name="content"
                                                            placeholder="(Required)"
                                                            rows="15"><?php echo $content; ?></textarea>
                                                    </div>
                                                </div>

                                                <!-- Posted by input -->
                                                <label for="Announcement Posted By"
                                                    class="col-sm-4 col-form-label">Posted By</label>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="posted_by"
                                                            name="posted_by" placeholder="(Required)"
                                                            value="<?php echo $posted_by; ?>">
                                                    </div>
                                                </div>

                                                <!-- Posted on input -->
                                                <label for="Announcement Posted On"
                                                    class="col-sm-4 col-form-label">Posted On</label>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control"
                                                            id="created_on_original" name="created_on"
                                                            placeholder="(Required)"
                                                            value="<?php echo $formatted_date; ?>">
                                                        <input type="hidden" name="created_on"
                                                            value="<?php echo $created_on; ?>">

                                                    </div>
                                                </div>

                                                <!-- Submit button -->
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" value="Submit" name="deleteAnnouncement"
                                                        class="btn btn-danger">Delete</button>
                                                    <a type="button" name="cancel" class="btn btn-secondary"
                                                        href="admin-announcement.php">Cancel</a>
                                                </div>
                                            <?php
                                            }
                                        } else {
                                            // Handle the case when no announcements are found
                                            echo "<div class='col-12 text-center row justify-content-center align-items-center' style='height: 50vh;'><h2><strong>No posted announcement</strong></h2></div>";
                                        }
                                        ?>
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