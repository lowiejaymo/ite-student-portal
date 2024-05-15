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
            <?php include 'layout/officer-fixed-topnav.php'; ?>

            <?php include 'layout/officer-sidebar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1>Profile Settings</h1>
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
                        <div class="row">
                            <div class="col-md-3">

                                <!-- Profile Information Card -->
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="row justify-content-center">
                                            <div class="row justify-content-center">
                                                <div class="text-center"> <!-- Center the column content -->
                                                    <!-- displaying the profile picture -->
                                                    <img class="img-fluid rounded-circle"
                                                        style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;"
                                                        src="profile-pictures/<?php echo $_SESSION['profile_picture']; ?>?<?php echo time(); ?>"
                                                        alt="User profile picture">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Concatinating Full name -->
                                        <h3 class="profile-username text-center">
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
                                                <!-- Displaying Middle name -->
                                                <b>Position</b> <a class="float-right">
                                                    <?php echo $_SESSION['position']; ?>
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
                                        </ul>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->


                            </div>
                            <!-- /.col -->
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <!-- <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                      <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li> -->
                                            <li class="nav-item"><a class="nav-link active" href="#settings"
                                                    data-toggle="tab">Settings</a></li>
                                        </ul>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="tab-content">

                                            <div class="active tab-pane" id="settings">
                                                <p class="text-muted">Note: Fields marked with an asterisk (*) are required.
                                                </p>

                                                
























                                                <div class="card card-primary card-outline bg-white"
                                                    for="update-profilepicture">
                                                    <div class="card-header">
                                                        <!--  changing profile picture -->
                                                        <h3 class="card-title text-center"
                                                            style="font-size: 1.25rem; font-weight: bold;">
                                                            Change Profile Picture</h3><br>
                                                        <hr>
                                                        <form style="width: 100%"
                                                            action="indexes/officer-update-profilepicture.php" method="post"
                                                            enctype="multipart/form-data">
                                                            <?php if (isset($_GET['proferror'])) { ?>
                                                                <div class="alert alert-danger">
                                                                    <?php echo $_GET['proferror']; ?>
                                                                </div>
                                                            <?php } ?>
                                                            <?php if (isset($_GET['profsuccess'])) { ?>
                                                                <div class="alert alert-success">
                                                                    <?php echo $_GET['profsuccess']; ?>
                                                                </div>
                                                            <?php } ?>

                                                            <div class="row justify-content-center">
                                                                <div class="image">
                                                                    <!-- Displaying current profile picture -->
                                                                    <img class="change-profile-picture img-fluid rounded-circle"
                                                                        style="width: 500px; height: 500px; border-radius: 50%; object-fit: cover;"
                                                                        src="profile-pictures/<?php echo $_SESSION['profile_picture']; ?>?<?php echo time(); ?>"
                                                                        alt="User profile picture">
                                                                </div>
                                                            </div>

                                                            <hr>
                                                            <div class="mb-3">
                                                                <!-- uploading file -->
                                                                <input class="form-control" type="file" id="formFile"
                                                                    name='file'>
                                                            </div>



                                                            <div class="form-group row">
                                                                <div class="offset-sm-2 col-sm-10">
                                                                    <button type="submit" value="Submit"
                                                                        class="btn btn-success"
                                                                        name='upload'>Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>

                                                <div class="card card-primary card-outline bg-white" for="change-password">
                                                    <div class="card-header">
                                                        <!-- changing password -->
                                                        <h3 class="card-title text-center"
                                                            style="font-size: 1.25rem; font-weight: bold;">
                                                            Change Password</h3><br>
                                                        <hr>
                                                        <?php if (isset($_GET['passerror'])) { ?>
                                                            <div class="alert alert-danger">
                                                                <?php echo $_GET['passerror']; ?>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if (isset($_GET['passsuccess'])) { ?>
                                                            <div class="alert alert-success">
                                                                <?php echo $_GET['passsuccess']; ?>
                                                            </div>
                                                        <?php } ?>
                                                        <form style="width: 100%"
                                                            action="indexes/officer-changepassword-be.php" method="post">
                                                            <div class="mb-3">
                                                                <!-- Current password input -->
                                                                <label for="currentPassword" class="fw-bold">Current
                                                                    Password</label>
                                                                <input type="password" class="form-control"
                                                                    name="currentPassword" placeholder="Current Password"
                                                                    required='required'>
                                                            </div>
                                                            <div class="mb-3">
                                                                <!-- new password input -->
                                                                <label for="newPassword" class="fw-bold">New
                                                                    Password</label>
                                                                <input type="password" class="form-control"
                                                                    name="newPassword" placeholder="New Password"
                                                                    required='required'>
                                                            </div>
                                                            <div class="mb-3">
                                                                <!-- retyping new password input -->
                                                                <label for="retypeNewPassword" class="fw-bold">Retype New
                                                                    Password</label>
                                                                <input type="password" class="form-control"
                                                                    name="retypeNewPassword"
                                                                    placeholder="Retype New Password" required='required'>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="offset-sm-2 col-sm-10">
                                                                    <button type="submit" value="Submit"
                                                                        class="btn btn-success">Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>

                                            </div>
                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div><!-- /.card-body -->
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

        <!-- Modal for modifying profile information -->
        <div class="modal fade" id="profiletermsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Terms and Conditions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ol>
                            <li><strong>Introduction</strong><br>
                                By accessing or using the form provided by us, you agree to comply with and be bound by
                                these terms and conditions. If you do not agree to these terms and conditions, please do not
                                use the form.
                            </li>
                            <li><strong>Modifications to Form</strong><br>
                                We reserves the right to modify, suspend, or discontinue the form, or any part thereof, at
                                any time
                                without prior notice.
                            </li>
                            <li><strong>User Information</strong><br>
                                Users are responsible for providing accurate and up-to-date information when modifying their
                                details. We
                                not liable for any inaccuracies or outdated information provided by the user.
                            </li>
                            <li><strong>Privacy and Security</strong><br>
                                We takes the privacy and security of user information seriously. User data collected through
                                the form will
                                be handled in accordance with our Privacy Policy. By using the form, you consent to the
                                collection, use,
                                and sharing of your information as described in the Privacy Policy.
                            </li>
                            <li><strong>Password Protection</strong><br>
                                Users are required to enter their password to verify their identity before making any
                                modifications to
                                their information. Users are responsible for maintaining the confidentiality of their
                                password and for any
                                activities that occur under their account.
                            </li>
                            <li><strong>Use of Information</strong><br>
                                The information provided by users will be used for the purposes of updating their details
                                within the
                                system and for communication purposes related to their account.
                            </li>
                            <li><strong>Governing Law</strong><br>
                                These terms and conditions shall be governed by and construed in accordance with the laws of
                                Republic Act
                                No. 10173, also known as the Data Privacy Act of 2012. Any disputes arising under these
                                terms and
                                conditions shall be subject to the exclusive jurisdiction of the courts of authority.</li>
                        </ol>
                        <p>By using the form, you acknowledge that you have read, understood, and agree to be bound by these
                            terms and
                            conditions.</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for modifying email address -->
        <div class="modal fade" id="changeemailtermsModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Terms and Conditions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ol>
                            <li>
                                <strong>Introduction</strong><br>
                                By initiating the process of changing your email address through the platform provided by
                                us,
                                you agree to comply with and be bound by these terms and conditions. If you do not agree to
                                these
                                terms and conditions, please do not proceed with the email address change process.
                            </li>

                            <li>
                                <strong>Request for Email Address Change:</strong><br>
                                <ol>
                                    <li>To initiate the process of changing your email address, you must send a request
                                        through the
                                        platform's designated procedure.</li>
                                    <li>Upon initiating the request, you will be prompted to input the new email address to
                                        which the
                                        request code will be sent.</li>
                                    <li>The request code will be sent to the provided new email address for verification
                                        purposes.</li>
                                </ol>
                            </li>

                            <li>
                                <strong>Verification Process:</strong><br>
                                <ol>
                                    <li>Upon receiving the request code at your new email address, you must retrieve the
                                        code and return to
                                        the platform to continue the process.</li>
                                    <li>You are required to enter the received request code accurately as part of the
                                        verification process.
                                    </li>
                                    <li>Additionally, you will be prompted to provide your account password to further
                                        verify your identity.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Confirmation and Completion:</strong><br>
                                <ol>
                                    <li>Once the request code and password have been successfully verified, your email
                                        address change
                                        request will be processed.</li>
                                    <li>You will receive confirmation of the email address change via the new email address
                                        provided.</li>
                                    <li>Your account information, including your login credentials, will be updated to
                                        reflect the new email
                                        address.</li>
                                </ol>
                            </li>

                            <li>
                                <strong>Responsibilities:</strong><br>
                                <ol>
                                    <li>You are solely responsible for ensuring the accuracy and security of the new email
                                        address provided
                                        during the email address change process.</li>
                                    <li>It is your responsibility to keep your account password confidential and to prevent
                                        unauthorized
                                        access to your account.</li>
                                    <li>Any unauthorized access or misuse of your account resulting from negligence in
                                        safeguarding your
                                        credentials shall be your sole responsibility.</li>
                                </ol>
                            </li>

                            <li>
                                <strong>Limitation of Liability:</strong><br>
                                <ol>
                                    <li>We shall not be liable for any loss or damage arising from unauthorized access to
                                        your account due
                                        to negligence on your part.</li>
                                    <li>We reserve the right to deny or delay processing any email address change request
                                        deemed suspicious
                                        or potentially fraudulent.</li>
                                </ol>
                            </li>

                            <li>
                                <strong>Governing Law:</strong><br>
                                <ol>
                                    <li>These terms and conditions shall be governed by and construed in accordance with the
                                        laws of
                                        [Jurisdiction], without regard to its conflict of law provisions.</li>
                                </ol>
                            </li>

                            <li>
                                <strong>Modification of Terms:</strong><br>
                                <ol>
                                    <li>We reserve the right to modify or update these terms and conditions at any time
                                        without prior
                                        notice.</li>
                                    <li>It is your responsibility to review these terms periodically for any changes.</li>
                                </ol>
                            </li>
                        </ol>
                        <p>By using the form, you acknowledge that you have read, understood, and agree to be bound by these
                            terms and
                            conditions.</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

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