<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ITE Student Portal | Officer Event Page</title>
    <link rel="icon" type="image/png" href="favicon.ico"/>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
<?php
    session_start();
    include "indexes/db_conn.php";

    function validate($data) {
        global $conn;
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return mysqli_real_escape_string($conn, $data);
    }

    if (isset($_SESSION['role']) && $_SESSION['role'] === 'Officer') {
        if (isset($_GET['event_id'])) {
            $event_id = intval($_GET['event_id']);

            // Get the event details to extract the school year and semester
            $sql = "SELECT school_year, semester FROM events WHERE event_id = $event_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $school_year = $row['school_year'];
                $semester = $row['semester'];

?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <?php include 'layout/officer-fixed-topnav.php'; ?>

    <!-- Sidebar -->
    <?php include 'layout/officer-sidebar.php'; ?>
 
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 align-items-center">
                    <div class="col-sm-6">
                        <h1>Marking Present to Event</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a id="addNewSubjectBtn" class="btn btn-secondary"
                           href="officer-event-view.php?event_id=<?php echo $event_id; ?>"><i
                                class="nav-icon fas fa-solid fa-chevron-left"></i> Back to Event</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="card card-primary card-outline bg-white" for="new-subject">
                  <div class="card-header">
                    <!-- add New Subject -->
                    <h3 class="card-title text-center" style="font-size: 1.25rem; font-weight: bold;">
                      Marking Present using Excel</h3><br><br>
                    <p class="text-muted">Yey Wow Magic</p>
                    <hr>

                    <?php if (isset($_GET['newStudentError'])) { ?>
                      <div class="alert alert-danger">
                        <?php echo $_GET['newStudentError']; ?>
                      </div>
                    <?php } ?>


                    <form action="indexes/officer-event-present-student-bulk-be.php" method="post" enctype="multipart/form-data">

                      <div class="mb-3">
                        <!-- uploading file -->
                        <input class="form-control" type="file" id="import_file" name='import_file'>
                      </div>

                      <input type="text" class="form-control" name="event_id"
                            value="<?php echo $event_id ?>" hidden>

                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" value="Submit" name="save_excel_data" class="btn btn-success">Do it</button>
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
    </div>
    <!-- /.content-wrapper -->
    <?php include 'layout/fixed-footer.php'; ?>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="AdminLTE-3.2.0/dist/js/adminlte.js"></script>
</body>

</html>

<?php
        } else {
            echo "Event not found.";
        }
    } else {
        echo "Event ID is not specified.";
    }
} else {
    header("Location: login.php");
    exit();
}
?>
