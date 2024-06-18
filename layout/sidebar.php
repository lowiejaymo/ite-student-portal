<!-- sidebar.php and sidebar of officer form.
Author:
  Lowie Jay Orillo lowie.jaymier@gmail.com, 
  Caryl Mae Subaldo subaldomae29@gmail.com, 
  Brian Angelo Bognot c09651052069@gmail.com.
Last Modified: May 15, 2024
Brief overview of the file's contents. -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-2"
  style="background-image: url('images/sidebar-background.png'); background-size: cover; background-position: center;">
  <!-- Brand Logo -->
  <a href="dashboard.php" class="brand-link">
    <img src="images/iteportal-sidebar-logo.png" alt="AdminLTE Logo" class="brand-image elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">ITE Student Portal</span>
  </a>


  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
      <div class="image">
        <a href="profile.php">

          <img src="profile-pictures/<?php echo $_SESSION['profile_picture']; ?>?<?php echo time(); ?>"
            alt="User profile picture" style="height: 2.3rem; width: 2.3rem; border-radius: 50%; object-fit: cover;">
        </a>
      </div>
      <?php
      $last_name_initial = substr($_SESSION['last_name'], 0, 1);
      ?>
      <div class="info ml-2">
        <a href="profile.php" class="d-block">
          Hello, <?php echo $_SESSION['first_name']; ?> <?php echo $last_name_initial; ?>.!
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item ">
          <a href="announcement.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-bullhorn"></i>
            <p>
              Announcements
            </p>
          </a>
        </li>

        <li class="nav-item ">
          <a href="myqrcode.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-qrcode"></i>
            <p>
              My QR Code
            </p>
          </a>
        </li>

        <li class="nav-item ">
          <a href="myattendance.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-clipboard-check"></i>
            <p>
              My Attendance
            </p>
          </a>
        </li>

        <li class="nav-item ">
          <a href="mypayment.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-money-bill-wave"></i>
            <p>
              My Payment
            </p>
          </a>
        </li>

      </ul>
    </nav>
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