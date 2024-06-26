<?php
// Start the session at the beginning of the file
// session_start();
// Include your database connection here
// include "db_connection.php"; // Make sure this file includes your database connection logic

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];

  $sql = "SELECT * FROM userregister WHERE id = $user_id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = mysqli_fetch_array($result);
  } else {
    echo "No user found ";
    exit();
  }
}
?>

<header id="header" class="header fixed-top">
  <div class="topbar d-flex align-items-center bg-dark">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <!-- <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:mmm@example.com" class="text-white">graduatejob.com</a></i> -->
        <!-- <i class="bi bi-phone d-flex align-items-center ms-4 text-white"><span>+1 123 456 789</span></i> -->
      </div>
      <div class="languages d-none d-md-flex align-items-center">
        <ul>
          <!-- <li class="text-white">En</li> -->
          <!-- <li><a href="#" class=" bi bi-phone text-white"> &nbsp; +1 123 456 789</a></li> -->
        </ul>
      </div>
    </div>
  </div><!-- End Top Bar -->

  <div class="branding d-flex align-items-center">
    <div class="container position-relative d-flex align-items-center justify-content-between">
      <a href="index" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="images/Graduatejob.lk Logo Light.png" alt="">
        <!-- <h1 class="sitename ">GRADUATEJOB</h1> -->
      </a>

      <nav id="navmenu" class="navmenu" style="font-weight: bolder;">
        <ul>
          <li><a href="index" class="nav-link active text-white">Home</a></li>
          <li><a href="jobs" class="nav-link text-white">Jobs</a></li>
          <li><a href="jobs" class="nav-link text-white">About Us</a></li>
          <li><a href="jobs" class="nav-link text-white">Contat Us</a></li>
          <!-- <li class="dropdown">
            <a href="#" class="text-white"><span>Services</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#resume-writing" class="text-white">Resume Writing</a></li>
              <li><a href="#career-advice" class="text-white">Career Advice</a></li>
              <li><a href="#job-alerts" class="text-white">Job Alerts</a></li>
            </ul>
          </li> -->
          <!-- <li><a href="#about-us" class="nav-link text-white">About Us</a></li> -->
          <!-- <li><a href="#contact" class="nav-link text-white">Contact</a></li> -->
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list text-white"></i>
      </nav><!-- .navmenu -->

      <div class="flex items-center md:order-2 space-x-3 rtl:space-x-reverse">
        <?php if (isset($_SESSION['user_id'])) : ?>
          <div class="dropdown">
            <a href="#" class="d-flex align-items-center" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">


              <!-- <img src="userDashboards/uploads/profiles/<?php echo $row['profile']; ?>" alt="Profile" class="rounded-circle" style="width: 40px; height: 40px;"> -->

              <?php if (!empty($row["profile"])) : ?>
                <img src="userDashboards/uploads/profiles/<?= $row["profile"] ?>" alt="Profile Image" class="img-thumbnail profile-img"  style="max-width: 50px; max-height: 50px; border-radius: 25px;">
              <?php else : ?>
                <img src="https://freesvg.org/img/abstract-user-flat-4.png" alt="default profile pic" style="max-width: 50px; max-height: 50px; border-radius: 25px;">
              <?php endif; ?>


              <span class="ms-2 text-white d-none d-md-flex"><?php echo $row['firstname']; ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown" style=" font-size: 15px;">
              <div class="p-3 text-muted">
                <?= $_SESSION['first_name']; ?> <?php echo $row['lastname']; ?>
                <?= $_SESSION['user_email']; ?>
              </div>
              <div class="" style="margin-left: 25px; font-size: 15px;">
                <li><a class="dropdown-item mb-2" href="userProfile"> <i class="fas fa-tachometer-alt"></i>&nbsp;
                    Dashboard</a></li>
                <li><a class="dropdown-item mb-2" href="logout.php"><i class="fas fa-sign-out-alt"></i>
                    &nbsp; Logout</a></li>
              </div>
            </ul>
          </div>
        <?php else : ?>
          <!-- Login Button -->
          <!-- <a href="userLoginForm" class="btn btn-outline-danger btn-user btn-block"><i class="fa fa-user"></i></a> -->
          <a href="userFormsHandle/login.php" class="btn btn-outline-danger btn-user btn-block"><i class="fa fa-user"></i></a>
          <!-- <a href="Recuiter/recruiterLoginForm" class="btn btn-primary btn-user btn-block">Rec Login</a> -->
        <?php endif; ?>
      </div>
    </div>
  </div><!-- End Branding -->

</header>