<!-- admin-sidebar.php and sidebar of admin form.
Author:
  Lowie Jay Orillo lowie.jaymier@gmail.com, 
  Caryl Mae Subaldo subaldomae29@gmail.com, 
  Brian Angelo Bognot c09651052069@gmail.com.
Last Modified: May 15, 2024
Brief overview of the file's contents. -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-danger elevation-4"
  style="background-image: url('images/sidebar-background.png'); background-size: cover; background-position: center;">
  <!-- Brand Logo -->
  <a href="admin-dashboard.php" class="brand-link">
    <img src="images/iteportal-sidebar-logo.png" alt="AdminLTE Logo" class="brand-image elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">ITE Student Portal</span>
  </a>


  <?php
  include "indexes/db_conn.php";
  $query = "SELECT * FROM semester";
  $result = mysqli_query($conn, $query);
  $semesters = [];
  $defaultSemester = '';

  if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $semesters[] = $row;
      if ($row['dfault'] == 1) {
        $defaultSemester = $row['semester'];
      }
    }
  }

  $schoolYearQuery = "SELECT * FROM school_year";
  $result = mysqli_query($conn, $schoolYearQuery);
  $schoolYears = [];
  $defaultYear = '';

  if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $schoolYears[] = $row;
      if ($row['dfault'] == 1) {
        $defaultYear = $row['school_year'];
      }
    }
  }
  ?>


  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
      <div class="image">
        <a href="admin-profile.php">

          <img src="profile-pictures/<?php echo $_SESSION['profile_picture']; ?>?<?php echo time(); ?>"
            alt="User profile picture" style="height: 2.3rem; width: 2.3rem; border-radius: 50%; object-fit: cover;">
        </a>
      </div>
      <?php
      $last_name_initial = substr($_SESSION['last_name'], 0, 1);
      ?>
      <div class="info ml-2">
        <a href="admin-profile.php" class="d-block">
          Hello, <?php echo $_SESSION['first_name']; ?> <?php echo $last_name_initial; ?>.!
        </a>
      </div>
    </div>


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item ">
          <a href="admin-dashboard.php?school_year=<?php echo $defaultYear; ?>&semester=<?php echo $defaultSemester; ?>" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>



        <li class="nav-item ">
          <a href="admin-announcement.php?school_year=<?php echo $defaultYear; ?>&semester=<?php echo $defaultSemester; ?>" class="nav-link">
            <i class="nav-icon fas fa-solid fa-bullhorn"></i>
            <p>
              Announcements
            </p>
          </a>
        </li>

        <li class="nav-item ">
          <a href="admin-officer.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-user-tie"></i>
            <p>
              Officers
            </p>
          </a>
        </li>

        <li class="nav-item ">
          <a href="admin-students.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-users"></i>
            <p>
              Students
            </p>
          </a>
        </li>


        <li class="nav-item ">
          <a href="admin-enrolled-students.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-user-plus"></i>
            <p>
              Enrolled Student
            </p>
          </a>
        </li>

        <li class="nav-item ">
          <a href="admin-events.php?search_input=&date=&school_year=<?php echo $defaultYear; ?>&semester=<?php echo str_replace(' ', '+', 'Third Semester'); ?>&search=" class="nav-link">
            <i class="nav-icon fas fa-solid fa-calendar-week"></i>
            <p>
              Events
            </p>
          </a>
        </li>

        <li class="nav-item ">
          <a href="admin-payment.php?search_input=&date=&school_year=<?php echo $defaultYear; ?>&semester=<?php echo str_replace(' ', '+', 'Third Semester'); ?>&search=" class="nav-link">
            <i class="nav-icon fas fa-money-bill-wave"></i>
            <p>
              Payments
            </p>
          </a>
        </li>



        <li class="nav-item ">
          <a href="admin-academic-settings.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-wrench"></i>
            <p>
              Academic Settings
            </p>
          </a>
        </li>



        <!-- <li class="nav-item ">
          <a href="admin-level-up.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-plus"></i>
            <p>
              Plus One
            </p>
          </a>
        </li>
      </ul>
    </nav> -->


    <!-- /.sidebar-menu -->

    <!-- Logout Button -->
    <div class="sidebar-footer">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="indexes/logout.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
      </ul>
    </div>

  </div>
  <!-- /.sidebar -->
</aside>