<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-2"
  style="background-image: url('images/sidebar-background.png'); background-size: cover; background-position: center;">
  <!-- Brand Logo -->
  <a href="admin-dashboard.php" class="brand-link">
    <img src="images/iteportal-sidebar-logo.png" alt="AdminLTE Logo" class="brand-image elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">ITE Student Portal</span>
  </a>


  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
      <div class="image">
        <a href="officer-profile.php">

          <img src="profile-pictures/<?php echo $_SESSION['profile_picture']; ?>?<?php echo time(); ?>"
            alt="User profile picture" style="height: 2.3rem; width: 2.3rem; border-radius: 50%; object-fit: cover;">
        </a>
      </div>
      <div class="info ml-2">
        <a href="officer-profile.php" class="d-block">
          Hello, <?php echo $_SESSION['username']; ?>!
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="officer-dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item ">
          <a href="officer-announcement.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-bullhorn"></i>
            <p>
              Announcements
            </p>
          </a>
        </li>

        <li class="nav-item ">
          <a href="officer-students.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-users"></i>
            <p>
              Students
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