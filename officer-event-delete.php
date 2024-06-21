<!-- officer-event-delete.php and to delete event in officer form.
Authors:
  - Lowie Jay Orillo (lowie.jaymier@gmail.com)
  - Caryl Mae Subaldo (subaldomae29@gmail.com)
  - Brian Angelo Bognot (c09651052069@gmail.com)
Last Modified: June, 2024
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
        <title>Officer Delete Event | ITE Student Portal</title>
        <link rel="icon" type="image/png" href="favicon.ico" />

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet"
            href="AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
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

            <?php include 'layout/officer-fixed-topnav.php'; ?>
            <?php include 'layout/officer-sidebar.php'; ?>

            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Delete Event</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="card card-danger card-outline bg-white" for="new-subject">
                                    <div class="card-header">
                                        <h3 class="card-title text-center" style="font-size: 1.25rem; font-weight: bold;">
                                            Are you sure you want to delete this event?</h3><br>
                                        <p class="text-muted">Note: All cannot able to retrieve this event after
                                            deleting it including the attendance of the students. </p>

                                        <hr>

                                        <?php if (isset($_GET['deleteEventError'])) { ?>
                                            <div class="alert alert-danger">
                                                <?php echo $_GET['deleteEventError']; ?>
                                            </div>
                                        <?php } ?>


                                        <form style="width: 100%" action="indexes/officer-event-delete-be.php"
                                            method="post">
                                            <?php
                                            $event_id = $_GET['event_id'];
                                            $sql = "SELECT * FROM events WHERE event_id = $event_id";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $event_id = $row['event_id'];
                                                    $event_name = $row['event_name'];
                                                    $date = $row['date'];
                                                    $school_year = $row['school_year'];
                                                    $semester = $row['semester'];
                                                    $formatted_date = date("F j, Y", strtotime($date));
                                                    ?>


                                                    <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">

                                                    <label for="event Heading" class="col-sm-4 col-form-label">Event
                                                        Name</label>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="heading" name="eventname"
                                                                placeholder="(Required)" value="<?php echo $event_name; ?>">
                                                        </div>
                                                    </div>

                                                    <label for="event Posted By" class="col-sm-4 col-form-label">Date of
                                                        Event</label>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="posted_by"
                                                                name="datedisplay" placeholder="(Required)"
                                                                value="<?php echo $formatted_date; ?>">
                                                        </div>
                                                    </div>

                                                    <label for="event Posted On" class="col-sm-4 col-form-label">School
                                                        Year</label>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="created_on_original"
                                                                name="schoolyear" placeholder="(Required)"
                                                                value="<?php echo $school_year; ?>">
                                                        </div>
                                                    </div>

                                                    <label for="event Posted On" class="col-sm-4 col-form-label">Semester</label>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="created_on_original"
                                                                name="semester" placeholder="(Required)"
                                                                value="<?php echo $semester; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit" value="Submit" name="deleteEvent"
                                                            class="btn btn-danger">Delete</button>
                                                        <a type="button" name="cancel" class="btn btn-secondary"
                                                            href="officer-events.php">Cancel</a>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                echo "<div class='col-12 text-center row justify-content-center align-items-center' style='height: 50vh;'><h2><strong>No posted event</strong></h2></div>";
                                            }
                                            ?>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php include 'layout/fixed-footer.php'; ?>
        </div>

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