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
$row = mysqli_fetch_assoc($result);
$JobCounts = $row['total'];



?>

<main class="main">




<div class="products"  style="margin-top: 203px;">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="contact-form">

          <form id="filter-form">
            <h5 style="margin-bottom: 15px">Type</h5>

            <div class="dflx">
              <div>
                <label>
                  <input type="checkbox" class="filter-checkbox" name="type" value="Part-time">
                  <small>Part time (5)</small>
                </label>
              </div>

              <div>
                <label>
                  <input type="checkbox" class="filter-checkbox" name="type" value="Full-time">
                  <small>Full time (5)</small>
                </label>
              </div>

              <div>
                <label>
                  <input type="checkbox" class="filter-checkbox" name="type" value="Internship">
                  <small>Internship (5)</small>
                </label>
              </div>
            </div>

            <br>

            <h5 style="margin-bottom: 15px">Category</h5>

            <div class="dflx">
              <?php

              if (mysqli_num_rows($resulting) > 0) {
                // Loop through each category and create a checkbox for each
                while ($row = mysqli_fetch_assoc($resulting)) {
                  echo '<label>';
                  echo '<input type="checkbox" class="filter-checkbox" name="category" value="' . $row['category_name'] . '">';
                  echo '  ';
                  echo '<small>' . $row['category_name'] . ' Jobs</small>';
                  echo '</label>';
                  echo '<br>';
                }
              }
              ?>
            </div>

            <!-- Add more categories as needed -->

            <br>

            <h5 style="margin-bottom: 15px">Career levels</h5>

            <div class="dflx">

              <div>
                <label>
                  <input type="checkbox" class="filter-checkbox" name="career" value="Entry_Level">
                  <small>Entry Level</small>
                </label>
              </div>
  
              <div>
                <label>
                  <input type="checkbox" class="filter-checkbox" name="career" value="Mid_Level">
                  <small>Mid Level</small>
                </label>
              </div>
            </div>

            <br>

            <h5 style="margin-bottom: 15px">Education levels</h5>

            <div class="dflx">

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
            </div>
          </form>

        </div>
      </div>



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


      <div id="long_card_job_listing" class="col-md-9">
        <div class="container">
          <div class="card mb-3">
            <div class="card-body">
              <div class="d-flex flex-column flex-lg-row">
                <div class="row flex-fill">
                  <div class="col-sm-5">
                    <h4 class="h5"><?= $JobCounts ?> Total Jobs are Found</h4>
                  </div>


                  <!-- class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" -->
                  <form id="search-form">
                    <div class="input-group">
                      <input type="text" id="search-query" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-primary" id="search-button" type="button">
                          <i class="fas fa-search fa-sm"></i>
                        </button>
                      </div>
                    </div>
                  </form>



                  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                  <script>
                    $(document).ready(function() {
                      $('#search-button').on('click', function() {
                        performSearch();
                      });

                      $('#search-query').on('keypress', function(e) {
                        if (e.which === 13) {
                          performSearch();
                        }
                      });

                      function performSearch() {
                        let query = $('#search-query').val();

                        $.ajax({
                          url: 'search.php',
                          method: 'GET',
                          data: {
                            query: query
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
                                                <span class="badge bg-secondary">${job.location}</span>
                                                <span class="badge bg-secondary">${job.job_category}</span>
                                              </div>
                                              <div class="col-sm-4 py-2">
                                                ${job.skills_required.split(',').map(skill => `<span class="badge bg-secondary">${skill.trim().toUpperCase()}</span>`).join(' ')}
                                              </div>
                                              <div class="col-sm-3 text-lg-end">
                                                <span class="badge bg-success">${job.employment_type}</span>
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

                      // Function to generate a random color
                      function getRandomColor() {
                        return '#' + Math.floor(Math.random() * 16777215).toString(16);
                      }
                    });
                  </script> -->



                </div>
              </div>
            </div>
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
              $page = (int)$_GET['page'];
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
                  $badge_color = 'bg-info';
                  $badge_text = $days_remaining . ' days left';
                }

                $skills = $row['skills_required'];

                // Split the skills into an array
                $skillsArray = explode(',', $skills);




            ?>
                <div class="card mb-3">
                  <a href="job-details?id=<?= $row['id']; ?>" class="stretched-link"></a>
                  <div class="card-body">
                    <div class="d-flex flex-column flex-lg-row">
                      <span class="avatar avatar-text rounded-2 me-4 mb-2" style="background-color: <?= $random_color ?>;">
                        <?= substr($row['job_title'], 0, 2) ?>
                      </span>
                      <div class="row flex-fill">
                        <div class="col-sm-5">
                          <h4 class="h5"><?= $row['job_title'] ?></h4>
                          <span class="badge bg-info"><?= $row['location'] ?></span>
                          <span class="badge bg-secondary"><?= $row['job_category'] ?></span>
                          <span class="badge bg-info"><?= $row['company_name'] ?></span>
                        </div>
                        <div class="col-sm-4 py-2">
                          <?php
                          foreach ($skillsArray as $skill) {
                            echo '<span class="badge bg-secondary">' . strtoupper(trim($skill)) . '</span> ';
                          }
                          ?>
                        </div>
                        <div class="col-sm-3 text-lg-end">
                          <span class="badge bg-success"><?= $row['employment_type'] ?></span>
                          <span class="badge <?= $badge_color ?>"><?= $badge_text ?></span>
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



    </div>
  </div>
</div>















    <!-- -------------------------------- FOoter Section ----------------------------------- -->
    <!-- -------------------------------- FOoter Section ----------------------------------- -->


<!-- Bootstrap core JavaScript -->
<script src="https://demo.phpjabbers.com/free-web-templates/job-website-template-138/vendor/jquery/jquery.min.js"></script>
<script src="https://demo.phpjabbers.com/free-web-templates/job-website-template-138/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Additional Scripts -->
<script src="https://demo.phpjabbers.com/free-web-templates/job-website-template-138/assets/js/custom.js"></script>
<script src="https://demo.phpjabbers.com/free-web-templates/job-website-template-138/assets/js/owl.js"></script>








</main>

<footer id="footer" class="footer">

    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="index.html" class="logo d-flex align-items-center">
                    <span class="sitename">Restaurantly</span>
                </a>
                <div class="footer-contact pt-3">
                    <p>A108 Adam Street</p>
                    <p>New York, NY 535022</p>
                    <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                    <p><strong>Email:</strong> <span>info@example.com</span></p>
                </div>
                <div class="social-links d-flex mt-4">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Terms of service</a></li>
                    <li><a href="#">Privacy policy</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Our Services</h4>
                <ul>
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Web Development</a></li>
                    <li><a href="#">Product Management</a></li>
                    <li><a href="#">Marketing</a></li>
                    <li><a href="#">Graphic Design</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-12 footer-newsletter">
                <h4>Our Newsletter</h4>
                <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
                <form action="forms/newsletter.php" method="post" class="php-email-form">
                    <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                </form>
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">Restaurantly</strong> <span>All Rights Reserved</span></p>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you've purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>

</footer>

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
                                                    <span class="badge bg-info">${job.location}</span>
                                                    <span class="badge bg-secondary">${job.job_category}</span>
                                                    <span class="badge bg-info">${job.company_name}</span>
                                                </div>
                                                <div class="col-sm-4 py-2">
                                                    ${job.skills_required.split(',').map(skill => `<span class="badge bg-secondary">${skill.trim().toUpperCase()}</span>`).join(' ')}
                                                </div>
                                                <div class="col-sm-3 text-lg-end">
                                                    <span class="badge bg-success">${job.employment_type}</span>
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