<?php

session_start();
require "Database/connection.php";


include("includes/header.php");
include("includes/navbar.php");





$sql = "SELECT * FROM category";
$resulting = mysqli_query($conn, $sql);

// ---------------   dedline scene here   ---------------------------

$sql_deadline = "SELECT * FROM jobs WHERE admin_status = 'Approved' ";
$sql_deadline_run = mysqli_query($conn, $sql_deadline);
$deadline = mysqli_fetch_array($sql_deadline_run);


// ---------------  END  dedline scene here   ---------------------------

// counting , how much jobs are posted 
$sql = "SELECT COUNT(*) AS total FROM jobs WHERE admin_status = 'Approved'   AND application_status = 'active' ";
$result = mysqli_query($conn, $sql);
$result_ = mysqli_query($conn, $sql);


$row = mysqli_fetch_assoc($result);
$JobCounts = $row['total'];






?>

<main class="main">



  <!-- page header section  -->


  <style>
    #pageHeader h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      color: #25292a;
      margin: 0px 0px 10px 0px;
      font-family: 'Overpass', sans-serif;
      font-weight: 700;
      letter-spacing: -1px;
      line-height: 1;
    }

    #pageHeader h1 {
      font-size: 34px;
    }

    #pageHeader h2 {
      font-size: 28px;
      line-height: 38px;
    }

    #pageHeader h3 {
      font-size: 22px;
      line-height: 32px;
    }

    #pageHeader h4 {
      font-size: 20px;
    }

    #pageHeader h5 {
      font-size: 17px;
    }

    #pageHeader h6 {
      font-size: 12px;
    }

    #pageHeader p {
      margin: 0 0 20px;
      line-height: 1.7;
    }

    #pageHeader p:last-child {
      margin: 0px;
    }

    #pageHeader ul,
    ol {}

    #pageHeader a {
      text-decoration: none;
      color: #8d8f90;
      -webkit-transition: all 0.3s;
      -moz-transition: all 0.3s;
      transition: all 0.3s;
    }

    #pageHeader a:focus,
    a:hover {
      text-decoration: none;
      color: #f85759;
    }



    #pageHeader .page-header {
      background: url(https://easetemplate.com/free-website-templates/hike/images/pageheader.jpg)no-repeat;
      position: relative;
      background-size: cover;
    }

    #pageHeader .page-caption {
      padding-top: 170px;
      padding-bottom: 174px;
    }

    #pageHeader .page-title {
      font-size: 46px;
      line-height: 1;
      color: #fff;
      font-weight: 600;
      text-align: center;
    }

    #pageHeader .card-section {
      position: relative;
      bottom: 60px;
    }

    #pageHeader .card-block {
      padding: 20px;
      border-radius: 20px;
    }

    #pageHeader .section-title {
      margin-bottom: 60px;
    }












    /* ------------------------------ for butn design --------------  */


    .wrap-check-62 {
      --slider-height: 8px;
      --slider-width: calc(var(--slider-height) * 4);
      --switch-height: calc(var(--slider-height) * 3);
      --switch-width: var(--switch-height);
      --switch-shift: var(--slider-height);
      --transition: all 0.2s ease;

      --switch-on-color:
        #ef0460;
      --slider-on-color:
        #fc5d9b;

      --switch-off-color:
        #eeeeee;
      --slider-off-color:
        #c5c5c5;
    }

    .wrap-check-62 .switch {
      display: block;
    }

    .wrap-check-62 .switch .slider {
      position: relative;
      display: inline-block;
      height: var(--slider-height);
      width: var(--slider-width);
      border-radius: var(--slider-height);
      cursor: pointer;
      background: var(--slider-off-color);
      transition: var(--transition);
    }

    .wrap-check-62 .switch .slider:after {
      background: var(--switch-off-color);
      position: absolute;
      left: calc(-1 * var(--switch-shift));
      top: calc((var(--slider-height) - var(--switch-height)) / 2);
      display: block;
      width: var(--switch-height);
      height: var(--switch-width);
      border-radius: 50%;
      box-shadow: 0px 2px 2px rgba(0, 0, 0, .2);
      content: '';
      transition: var(--transition);
    }

    .wrap-check-62 .switch label {
      margin-right: 7px;
    }

    .wrap-check-62 .switch .input {
      display: none;
    }

    .wrap-check-62 .switch .input~.label {
      margin-left: var(--slider-height);
    }

    .wrap-check-62 .switch .input:checked~.slider:after {
      left: calc(var(--slider-width) - var(--switch-width) + var(--switch-shift));
    }

    .wrap-check-62 .switch .input:checked~.slider {
      background: var(--slider-on-color);
    }

    .wrap-check-62 .switch .input:checked~.slider:after {
      background: var(--switch-on-color);
    }
  </style>




  <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
  <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->
  <section id="pageHeader" style="margin-top: -25px;">

    <!-- page-header -->
    <div class="page-header">
      <div class="container">
        <div class="row mt-4">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
            <div class="page-caption">
              <h1 class="text-center text-white " data-aos="fade-in">Find a best job</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.page-header-->



    <!-- news -->
    <div class="card-section">
      <div class="container">
        <div class="card-block bg-white mb30">
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <!-- section-title -->
              <div class="section-title mb-0">


                <style>
                  .domain-form .form-group {
                    border: 1px solid #0b0f82;
                    padding: 9px;
                    border-radius: 10px;
                  }


                  .domain-form .form-group input {
                    height: 70px !important;
                    border: transparent;
                  }

                  .form-control {
                    height: 52px !important;
                    background: #fff !important;
                    color: #3a4348 !important;
                    font-size: 18px;
                    border-radius: 0px;
                    -webkit-box-shadow: none !important;
                    box-shadow: none !important;
                  }

                  .px-4 {
                    padding-left: 1.5rem !important;
                  }

                  .domain-form .form-group .search-domain {
                    background: #001569;
                    border: 2px solid #7c042a;
                    color: #fff;
                    -webkit-border-radius: 0;
                    -moz-border-radius: 0;
                    -ms-border-radius: 0;
                    border-radius: 0;
                  }

                  .domain-price span {
                    color: #3a4348;
                    margin: 0 10px;
                  }

                  .domain-price span small {
                    color: #24bdc9;
                  }
                </style>


                <div class="row justify-content-center padding " data-aos="fade-up">
                  <div class="col-md-8 ftco-animate fadeInUp ftco-animated ">
                    <form action="#" class="domain-form">
                      <div class="form-group d-md-flex">
                        <input type="text" id="search-query" aria-label="Search" aria-describedby="basic-addon2" class="form-control px-4" placeholder="Enter the Job title Here">
                        <input type="submit" class="search-domain  px-5" value="Search Job">
                        <span class="focus-input100"></span>

                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /.section-title -->
            </div>
          </div>
        </div>

      </div>
    </div>


  </section>

  <style>
    .switch {
      position: relative;
      display: inline-block;
      width: 40px;
      height: 20px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: .4s;
      border-radius: 20px;
    }

    .slider:before {
      /* position: absolute; */
      content: "";
      height: 12px;
      width: 12px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      transition: .4s;
      border-radius: 50%;
    }

    input:checked+.slider {
      background-color: #2196F3;
    }

    input:checked+.slider:before {
      transform: translateX(20px);
    }
  </style>

  <!-- fiter section  -->



  <style>
    .search-bar input,
    .search-btn,
    .search-btn:before,
    .search-btn:after {
      transition: all 0.25s ease-out;
    }

    .search-bar input,
    .search-btn {
      width: 3em;
      height: 3em;
    }

    .search-bar input:invalid:not(:focus),
    .search-btn {
      cursor: pointer;
    }

    .search-bar,
    .search-bar input:focus,
    .search-bar input:valid {
      width: 100%;
    }

    .search-bar input:focus,
    .search-bar input:not(:focus)+.search-btn:focus {
      outline: transparent;
    }

    .search-bar {
      margin: auto;
      padding: 1.5em;
      justify-content: center;
      max-width: 30em;
    }

    .search-bar input {
      background: transparent;
      border-radius: 1.5em;
      box-shadow: 0 0 0 0.4em #171717 inset;
      padding: 0.75em;
      transform: translate(0.5em, 0.5em) scale(0.5);
      transform-origin: 100% 0;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
    }

    .search-bar input::-webkit-search-decoration {
      -webkit-appearance: none;
    }

    .search-bar input:focus,
    .search-bar input:valid {
      background: #fff;
      border-radius: 0.375em 0 0 0.375em;
      box-shadow: 0 0 0 0.1em #d9d9d9 inset;
      transform: scale(1);
    }

    .search-btn {
      background: #171717;
      border-radius: 0 0.75em 0.75em 0 / 0 1.5em 1.5em 0;
      padding: 0.75em;
      position: relative;
      transform: translate(0.25em, 0.25em) rotate(45deg) scale(0.25, 0.125);
      transform-origin: 0 50%;
    }

    .search-btn:before,
    .search-btn:after {
      content: "";
      display: block;
      opacity: 0;
      position: absolute;
    }

    .search-btn:before {
      border-radius: 50%;
      box-shadow: 0 0 0 0.2em #f1f1f1 inset;
      top: 0.75em;
      left: 0.75em;
      width: 1.2em;
      height: 1.2em;
    }

    .search-btn:after {
      background: #f1f1f1;
      border-radius: 0 0.25em 0.25em 0;
      top: 51%;
      left: 51%;
      width: 0.75em;
      height: 0.25em;
      transform: translate(0.2em, 0) rotate(45deg);
      transform-origin: 0 50%;
    }

    .search-btn span {
      display: inline-block;
      overflow: hidden;
      width: 1px;
      height: 1px;
    }

    /* Active state */
    .search-bar input:focus+.search-btn,
    .search-bar input:valid+.search-btn {
      background: #2762f3;
      border-radius: 0 0.375em 0.375em 0;
      transform: scale(1);
    }

    .search-bar input:focus+.search-btn:before,
    .search-bar input:focus+.search-btn:after,
    .search-bar input:valid+.search-btn:before,
    .search-bar input:valid+.search-btn:after {
      opacity: 1;
    }

    .search-bar input:focus+.search-btn:hover,
    .search-bar input:valid+.search-btn:hover,
    .search-bar input:valid:not(:focus)+.search-btn:focus {
      background: #0c48db;
    }

    .search-bar input:focus+.search-btn:active,
    .search-bar input:valid+.search-btn:active {
      transform: translateY(1px);
    }

    @media screen and (prefers-color-scheme: dark) {

      body,
      input {
        color: #f1f1f1;
      }

      body {
        background: #171717;
      }

      .search-bar input {
        box-shadow: 0 0 0 0.4em #f1f1f1 inset;
      }

      .search-bar input:focus,
      .search-bar input:valid {
        background: #3d3d3d;
        box-shadow: 0 0 0 0.1em #3d3d3d inset;
      }

      .search-btn {
        background: #f1f1f1;
      }
    }
  </style>

  <section id="contents">



    <!-- ---------------------------------------------------------------- for mobile nav  Filter optpons -->




    <!-- mobile responsive filter options -->

    <!-- Offcanvas Sidebar for Mobile View -->




    <!-- ---------------------------------------------------------------- END for mobile nav Filter optpons  -->




    <div class="products">
      <div class="container">
        <div class="row" style="color: #000;">
          <div class="col-md-3 d-none d-md-block" data-aos="fade-up" data-aos-delay="200" id="All_Filter_options">
            <div class="contact-form">

              <form id="filter-form">
                <h5 style="margin-bottom: 15px">Type</h5>

                <div class="dflx">
                  <!-- <div>
                    <label>
                      <input type="checkbox" class="filter-checkbox" name="type" value="Part-time">
                      <small>Part time (5)</small>
                    </label>
                  </div> -->



                  <div class="wrap-check-62 d-flex align-items-center mb-2">
                    <div class="switch">
                      <input id="one-62" class="input filter-checkbox" type="checkbox" name="type" value="Part-time" />
                      <label for="one-62" class="slider"></label>
                    </div>
                    <span class="ms-2">Part-time</span>
                  </div>

                  <div class="wrap-check-62 d-flex align-items-center mb-2">
                    <div class="switch">
                      <input id="two-62" class="input filter-checkbox" type="checkbox" name="type" value="Full-time" />
                      <label for="two-62" class="slider"></label>
                    </div>
                    <span class="ms-2">Full-time</span>
                  </div>

                  <div class="wrap-check-62 d-flex align-items-center mb-2">
                    <div class="switch">
                      <input id="three-62" class="input filter-checkbox" type="checkbox" name="type" value="Contract" />
                      <label for="three-62" class="slider"></label>
                    </div>
                    <span class="ms-2">Contract</span>
                  </div>


                  <!-- <div>
                    <label>
                      <input type="checkbox" class="filter-checkbox" name="type" value="Full-time">
                      <small>Full time (5)</small>
                    </label>
                  </div> -->

                  <div class="wrap-check-62 d-flex align-items-center mb-2">
                    <div class="switch">
                      <input id="four-62" class="input filter-checkbox" type="checkbox" name="type" value="Internship" />
                      <label for="four-62" class="slider"></label>
                    </div>
                    <span class="ms-2">Internship</span>
                  </div>

                  <!-- <div>
                    <label>
                      <input type="checkbox" class="filter-checkbox" name="type" value="Internship">
                      <small>Internship (5)</small>
                    </label>
                  </div> -->
                </div>

                <br>


                <div class="dflx">
                  <h5 style="margin-bottom: 15px">Category</h5>
                  <?php

                  if (mysqli_num_rows($resulting) > 0) {


                    // echo '<label>';
                    // echo '<input type="checkbox" class="filter-checkbox" name="category" value="' . $row['category_name'] . '">';
                    // echo '  ';
                    // echo '<small>' . $row['category_name'] . ' Jobs</small>';
                    // echo '</label>';
                    // echo '<br>';


                    // Initialize a counter for generating unique IDs
                    $counter = 1;

                    // Loop through each category and create a checkbox for each
                    while ($row = mysqli_fetch_assoc($resulting)) {
                  ?>
                      <div class="wrap-check-62 d-flex align-items-center mb-2">
                        <div class="switch">
                          <input id="check-<?= $counter ?>-62" class="input filter-checkbox" type="checkbox" name="category" value="<?= $row['category_name'] ?>" />
                          <label for="check-<?= $counter ?>-62" class="slider"></label>
                        </div>
                        <span class="ms-2"><?= $row['category_name'] ?></span>
                      </div>
                  <?php
                      // Increment the counter for the next checkbox
                      $counter++;
                    }
                  }
                  ?>
                </div>

                <!-- Add more categories as needed -->

                <br>
                <!-- -----------------------------------------------------------------------------------------------  -->


                <div class="dflx">

                  <h5 style="margin-bottom: 15px">Career levels</h5>
                  <!-- <div>
                    <label>
                      <input type="checkbox" class="filter-checkbox" name="career" value="Entry_Level">
                      <small>Entry Level</small>
                    </label>
                  </div> -->

                  <div class="wrap-check-62 d-flex align-items-center mb-2">
                    <div class="switch">
                      <input id="five-62" class="input filter-checkbox" type="checkbox" name="career" value="Entry_Level" />
                      <label for="five-62" class="slider"></label>
                    </div>
                    <span class="ms-2">Entry Level</span>
                  </div>
                  <div class="wrap-check-62 d-flex align-items-center mb-2">
                    <div class="switch">
                      <input id="six-62" class="input filter-checkbox" type="checkbox" name="career" value="Mid_Level" />
                      <label for="six-62" class="slider"></label>
                    </div>
                    <span class="ms-2">Mid Level</span>
                  </div>

                  <!-- <div>
                    <label>
                      <input type="checkbox" class="filter-checkbox" name="career" value="Mid_Level">
                      <small>Mid Level</small>
                    </label>
                  </div> -->
                </div>

                <br>

                <!-- <h5 style="margin-bottom: 15px">Education levels</h5> -->

                <!-- <div class="dflx">

                  <div>
                    <label>
                      <input type="checkbox" class="filter-checkbox" name="education" value="Degree">
                      <small>Degree (5)</small>
                    </label>
                  </div>

                  <div>
                    <label>
                      <input type="checkbox" class="filter-checkbox" name="education" value="High School">
                      <small>High School (5)</small>
                    </label>
                  </div>
                </div> -->
              </form>

            </div>
          </div>


          <style>
            .filter_bg {
              background-color: #0000660a;
              padding-top: 10px;
              padding-bottom: 5px;
              font-weight: bolder;
              margin-bottom: 15px;
            }

            .card_backround {
              background: rgb(236, 236, 236);
              background: radial-gradient(circle, rgba(236, 236, 236, 1) 3%, rgba(234, 234, 249, 1) 100%);
            }


            /* -------------------side filter nav-------------------  */
            .offcanvas.offcanvas-end {
              top: 0;
              right: -113px;
              width: var(--bs-offcanvas-width);
              border-left: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
              transform: translateX(100%);
            }
          </style>

          <div id="long_card_job_listing" class="col-md-9" data-aos="fade-up" data-aos-delay="200">
            <div class="container">

              <div class="d-md-none text-end filter_bg  ">
                <p class="px-3 bordered" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFilter" aria-controls="offcanvasFilter">
                  <i class="fas fa-filter"></i> Filters
                </p>
              </div>
              <!-- Job Listings -->
              <div id="search-results">
                <!-- Job results will be displayed here -->
                <?php
                // Define the number of results per page
                $results_per_page = 4;

                // Get the current page number
                if (!isset($_GET['page'])) {
                  $page = 1;
                } else {
                  $page = (int) $_GET['page'];
                }

                // Calculate the SQL LIMIT clause starting number for the results on the current page
                $offset = ($page - 1) * $results_per_page;

                function random_color()
                {
                  return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                }

                $sql = "SELECT * FROM jobs WHERE admin_status = 'Approved' AND application_status = 'active' LIMIT $offset, $results_per_page";
                $sql_run = mysqli_query($conn, $sql);
                if ($sql_run && mysqli_num_rows($sql_run) > 0) {
                  while ($row = mysqli_fetch_array($sql_run)) {

                    $random_color = random_color();
                    $application_deadline = $row['application_deadline'];
                    $current_date = new DateTime();
                    $deadline_date = new DateTime($application_deadline);
                    $interval = $current_date->diff($deadline_date);
                    $days_remaining = $interval->days;

                    if ($current_date > $deadline_date) {
                      $badge_color = 'bg-danger';
                      $badge_text = 'Application closed';

                      // Define the query to select jobs where the application deadline is in the future
                      $query_app_status = "SELECT * FROM jobs WHERE admin_status = 'Approved' AND application_deadline < ?";
                      $stmt = $conn->prepare($query_app_status);
                      $current_date_str = $current_date->format('Y-m-d H:i:s');
                      $stmt->bind_param("s", $current_date_str);
                      $stmt->execute();
                      $result__app_status = $stmt->get_result();

                      if ($result__app_status) {
                        while ($row_app_status = mysqli_fetch_assoc($result__app_status)) {
                          $job_id_app_status = $row_app_status['id'];

                          // Update the application status to 'closed'
                          $update_query = "UPDATE jobs SET application_status = 'closed' WHERE id = ?";
                          if ($stmt_update = $conn->prepare($update_query)) {
                            // Bind the job ID to the statement
                            $stmt_update->bind_param("i", $job_id_app_status);

                            // Execute the statement
                            if ($stmt_update->execute()) {
                              // echo "application status updated to 'closed'.<br>";
                            } else {
                              // echo "Error updating" . $stmt_update->error . "<br>";
                            }

                            // Close the statement
                            $stmt_update->close();
                          } else {
                            echo "Error preparing the update statement: " . $conn->error . "<br>";
                          }
                        }
                      } else {
                        echo "Error retrieving jobs: " . $conn->error;
                      }

                      // Close the statement
                      $stmt->close();
                    } else {
                      $badge_color = 'dark-red-shade3';
                      $badge_text = $days_remaining . ' days left';
                    }

                    $skills = $row['skills_required'];

                    // Split the skills into an array
                    $skillsArray = explode(',', $skills);




                ?>
                    <div class="card mb-3" style="border-radius: 10px;">
                      <!-- Desktop View -->
                      <div class="d-none d-md-block " style="border-radius: 10px;">
                        <a href="job-details?id=<?= $row['id']; ?>" class="stretched-link"></a>
                        <div class="card-body  ">
                          <div class="d-flex flex-column flex-lg-row">
                            <span class="avatar avatar-text rounded-2 me-4 mb-2">
                              <img src="https://cdn-icons-png.freepik.com/512/6073/6073873.png" alt="" class="img-fluid">
                            </span>
                            <div class="row flex-fill">
                              <div class="col-sm-5">
                                <h4 class="h5"><?= $row['job_title'] ?></h4>
                                <span class="badge dark-red-shade3"><?= $row['location'] ?></span>
                                <span class="badge dark-blue-shade1"><?= $row['job_category'] ?></span>
                                <span class="badge dark-red-shade3"><?= $row['company_name'] ?></span>
                              </div>
                              <div class="col-sm-4 py-2">
                                <?php
                                foreach ($skillsArray as $skill) {
                                  echo '<span class="badge dark-blue-shade1">' . strtoupper(trim($skill)) . '</span> ';
                                }
                                ?>
                              </div>
                              <div class="col-sm-3 text-lg-end">
                                <span class="badge dark-blue-shade1"><?= $row['employment_type'] ?></span>
                                <span class="badge <?= $badge_color ?>"><?= $badge_text ?></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Mobile View -->
                      <div class="d-md-none card_backround" style="border-radius: 10px;">
                         <a href="job-details?id=<?= $row['id']; ?>" class="stretched-link"></a>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-4 d-flex justify-content-center align-items-center">
                              <img src="https://cdn-icons-png.freepik.com/512/6073/6073873.png" alt="" class="img-fluid">
                            </div>

                            <div class="col-8" style="font-size: 12px;">
                              <h4 class="mb-3"><?= $row['job_title'] ?></h4>
                              <span class="badge dark-red-shade3"><?= $row['location'] ?></span>
                              <span class="badge dark-blue-shade1"><?= $row['job_category'] ?></span>
                              <span class="badge dark-red-shade3"><?= $row['company_name'] ?></span>
                              <div class="py-2">
                                <?php
                                foreach ($skillsArray as $skill) {
                                  echo '<span class="badge dark-blue-shade1">' . strtoupper(trim($skill)) . '</span> ';
                                }
                                ?>
                              </div>
                              <div class="" style="font-size: 12px;">
                                <span class="badge dark-blue-shade1"><?= $row['employment_type'] ?></span>
                                <span class="badge <?= $badge_color ?>"><?= $badge_text ?></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                <?php
                  }
                }

                // Pagination links
                $sql = "SELECT COUNT(*) AS total FROM jobs WHERE admin_status = 'Approved' AND application_status = 'active'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $total_pages = ceil($row['total'] / $results_per_page);

                echo '<nav aria-label="Page navigation">';
                echo '<ul class="pagination justify-content-center">';
                for ($i = 1; $i <= $total_pages; $i++) {
                  echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                }
                echo '</ul>';
                echo '</nav>';
                ?>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>


  </section>


  <style>
    #long_card_job_listing .card {
      box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
    }

    #long_card_job_listing .card {
      position: relative;
      display: flex;
      flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      background-color: #fff;
      background-clip: border-box;
      border: 0 solid rgba(0, 0, 0, .125);
      border-radius: 1rem;
    }

    #long_card_job_listing .card-body {
      -webkit-box-flex: 1;
      -ms-flex: 1 1 auto;
      flex: 1 1 auto;
      padding: 1.5rem 1.5rem;
    }

    #long_card_job_listing .avatar-text {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      background: #000;
      color: #fff;
      font-weight: 700;
    }

    #long_card_job_listing .avatar {

      width: 3rem;
      height: 3rem;
    }

    #long_card_job_listing .rounded-3 {
      border-radius: 0.5rem !important;
    }

    #long_card_job_listing .mb-2 {
      margin-bottom: 0.5rem !important;
    }

    #long_card_job_listing .me-4 {
      margin-right: 1.5rem !important;
    }

    .stretched-link::after {
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      z-index: 1;
      content: "";
    }
  </style>

  <!-- ---------------------------------------  -->





















  <!-- -------------------------------- FOoter Section ----------------------------------- -->
  <!-- -------------------------------- FOoter Section ----------------------------------- -->





</main>

<?php include("includes/footer.php");
?>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>


<!-- -------------------------------- FOoter Section ----------------------------------- -->
<!-- -------------------------------- FOoter Section ----------------------------------- -->
<!-- -------------------------------- FOoter Section ----------------------------------- -->





<script>
  $(document).ready(function() {
    $('#search-button').on('click', function() {
      performSearch();
    });

    $('#search-query').on('input', function() {
      performSearch();
    });

    $('.filter-checkbox').on('change', function() {
      performSearch();
    });

    function performSearch() {
      let query = $('#search-query').val();
      let types = [];
      let categories = [];
      let careers = [];
      let educations = [];

      $('input[name="type"]:checked').each(function() {
        types.push($(this).val());
      });

      $('input[name="category"]:checked').each(function() {
        categories.push($(this).val());
      });

      $('input[name="career"]:checked').each(function() {
        careers.push($(this).val());
      });

      $('input[name="education"]:checked').each(function() {
        educations.push($(this).val());
      });

      $.ajax({
        url: 'search.php',
        method: 'GET',
        data: {
          query: query,
          type: types,
          category: categories,
          career: careers,
          education: educations
        },
        success: function(response) {
          $('#search-results').empty();
          let jobs = JSON.parse(response);

          if (jobs.length === 0) {
            $('#search-results').append('<p>No jobs found</p>');
            return;
          }

          jobs.forEach(function(job) {
            let randomColor = getRandomColor();
            let jobHtml = `
                        <div class="col-md-12 mb-4 hoverEffect">
                            <a href="job-details?id=${job.id}" style="text-decoration: none; color: inherit;">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="d-flex flex-column flex-lg-row">
                                            <span class="avatar avatar-text rounded-3 me-4 mb-2" style="background-color: ${randomColor};">
                                                ${job.job_title.substr(0, 2)}
                                            </span>
                                            <div class="row flex-fill">
                                                <div class="col-sm-5">
                                                    <h4 class="h5">${job.job_title}</h4>
                                                    <span class="badge dark-red-shade1">${job.location}</span>
                                                    <span class="badge dark-blue-shade1">${job.job_category}</span>
                                                    <span class="badge dark-red-shade1">${job.company_name}</span>
                                                </div>
                                                <div class="col-sm-4 py-2">
                                                    ${job.skills_required.split(',').map(skill => `<span class="badge dark-blue-shade1">${skill.trim().toUpperCase()}</span>`).join(' ')}
                                                </div>
                                                <div class="col-sm-3 text-lg-end">
                                                    <span class="badge dark-blue-shade1">${job.employment_type}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>`;
            $('#search-results').append(jobHtml);
          });
        }
      });
    }

    function getRandomColor() {
      return '#' + Math.floor(Math.random() * 16777215).toString(16);
    }
  });
</script>