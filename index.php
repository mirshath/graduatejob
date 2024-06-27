<?php

session_start();
require "Database/connection.php";


include("includes/header.php");
include("includes/navbar.php");


?>



<style>
  .swiper-wrapper {
    background-color: transparent;
    border-radius: 15px;

  }

  .card-body {
    flex: 1 1 auto;
    padding: var(--bs-card-spacer-y) var(--bs-card-spacer-x);
    color: var(--bs-card-color);
    background-color: #0000660a;
    border-radius: 15px;
  }

  .rounded-pill {
    border-radius: var(--bs-border-radius-pill) !important;
    padding: 10px;
    padding-left: 20px;
    padding-right: 20px;
  }

  .bg-primary {
    --bs-bg-opacity: 1;
    background-color: rgb(10 50 108) !important;
  }
</style>



<main class="main">





  <!-- ------------------------- carosel section here ------------------------  -->

  <link rel="stylesheet" href="carousels/css/owl.carousel.min.css">
  <link rel="stylesheet" href="carousels/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
  <link rel="stylesheet" href="carousels/css/style.css">

  <section class="mt-4" style="margin-top: 50px;">
    <div class="home-slider owl-carousel js-fullheight">


      <div class="slider-item js-fullheight" style="background-image:url(https://t3.ftcdn.net/jpg/06/06/50/94/360_F_606509451_fSeyxuE8NUX41WNzuKP7FwRVsrKNC7fl.jpg);">
        <div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
            <div class="col-md-12 ftco-animate">
              <div class="text w-100 text-center">
                <h2>Empowering Graduates:</h2>
                <h1 class="mb-3">GRADUATEJOB.LK</h1>
                <p style="font-size: 22px;">Your Path to Success Begins Here</p>
                <a href="aboutus" class="btn btn-primary btn-lg">About Us</a>
                <a href="jobs" class="btn btn-success btn-lg">Start Your Career Journey</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="slider-item js-fullheight" style="background-image:url(https://media.13newsnow.com/assets/WVEC/images/34af2191-3ac8-4b97-8631-bbeb6425d04e/34af2191-3ac8-4b97-8631-bbeb6425d04e_1140x641.jpeg)">
        <div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
            <div class="col-md-12 ftco-animate">
              <div class="text w-100 text-center">
                <h2>Your Gateway to Success:</h2>
                <h1 class="mb-3">GRADUATEJOB.LK</h1>
                <p style="font-size: 22px;">Find Your Ideal Job with Ease and Confidence</p>
                <a href="aboutus" class="btn btn-primary btn-lg">About Us</a>
                <a href="jobs" class="btn btn-success btn-lg">Discover Opportunities</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="slider-item js-fullheight" style="background-image:url(https://t4.ftcdn.net/jpg/03/15/80/09/360_F_315800964_77dsFWNJflY7wvlnE1C5SNpt0DC2h43e.jpg);">
        <div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
            <div class="col-md-12 ftco-animate">
              <div class="text w-100 text-center">
                <h2>Discover Opportunities:</h2>
                <h1 class="mb-3">GRADUATEJOB.LK</h1>
                <p style="font-size: 22px;">Where Your Future Awaits</p>
                <a href="aboutus" class="btn btn-primary btn-lg">About Us</a>
                <a href="jobs" class="btn btn-success btn-lg">Find Your Dream Job</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="carousels/js/jquery.min.js"></script>
    <script src="carousels/js/popper.js"></script>
    <script src="carousels/js/bootstrap.min.js"></script>
    <script src="carousels/js/owl.carousel.min.js"></script>
    <script src="carousels/js/main.js"></script>
  </section>

  <!-- -----------------------------------------------------  -->







  <!-- Testimonials Section for jobs recents -->
  <section id="testimonials" class="testimonials section" style="padding: 60px 0; ">

    <!-- Section Title -->
    <div class="container section-title mb-4" data-aos="fade-up">
      <h2>recent jobs</h2>
      <p>Features Jobs</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="swiper init-swiper" data-speed="600" data-delay="5000" data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
        <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 1,
                "spaceBetween": 40
              },
              "1200": {
                "slidesPerView": 3,
                "spaceBetween": 20
              }
            }
          }
        </script>
        <div class="swiper-wrapper mt-3">





          <?php

          // $sql = "SELECT * FROM jobs WHERE admin_status='Approved' AND application_status='active' ORDER BY id DESC LIMIT 6";
          // $sql_run = mysqli_query($conn, $sql);


          $sql = "
          SELECT jobs.*, jobs.id AS job_id, userregister.*
          FROM jobs
          JOIN userregister ON jobs.company_name = userregister.company_name
          WHERE jobs.admin_status = 'Approved' AND jobs.application_status = 'active'
          ORDER BY jobs.id DESC
          LIMIT 6";
      
      $sql_run = mysqli_query($conn, $sql);
      

          if ($sql_run->num_rows > 0) {
            while ($row = mysqli_fetch_array($sql_run)) {
          ?>
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <div class="card border-0 bg-light rounded">
                    <div class="card-body p-4 shadow">

                      <!-- Desktop View: Image and data side by side -->
                      <a href="job-details?id=<?= $row['job_id']; ?>">

                        <div class="d-none d-md-flex align-items-center mb-3">
                          <img src="Admin/uploads/<?= $row['profile'] ?>" class="img-fluid shadow me-3" alt="Profile Image" style="width: 70px; height: 70px; object-fit: cover; border-radius: 20px;">
                          <div>
                            <h5 class="mb-1"><b><?= $row['job_title'] ?></b></h5>
                            <div class="d-flex align-items-center mb-1">
                              <span class="badge rounded-pill bg-primary">
                                <i class="fas fa-briefcase" style="font-size: 15px;"></i> &nbsp;&nbsp; <?= $row['employment_type'] ?>
                              </span>
                            </div>
                            <div class="text-muted">
                              <span><i class="fas fa-briefcase" style="font-size: 12px;"></i>&nbsp; <?= $row['job_category'] ?></span><br>
                              <span><i class="fas fa-map-marker-alt" style="font-size: 12px;"></i>&nbsp; <?= $row['location'] ?></span>
                            </div>
                          </div>
                        </div>
                      </a>


                      <!-- Mobile View: Image on left, data on right -->
                      <a href="job-details?id=<?= $row['job_id']; ?>">

                         <div class="d-md-none">
                           <div class="row">
                             <div class="col-4 d-flex justify-content-center align-items-center">
                               <img src="Admin/uploads/<?= $row['profile'] ?>" class="img-fluid mb-3 shadow" alt="Profile Image" style="object-fit: cover; border-radius: 20px;">
                             </div>
                             <div class="col-8">
                               <h5 class="mb-1"><b><?= $row['job_title'] ?></b></h5>
                               <span class="badge rounded-pill bg-primary mb-2">
                                 <i class="fas fa-briefcase" style="font-size: 15px;"></i> &nbsp;&nbsp; <?= $row['employment_type'] ?>
                               </span>
                               <div>
                                 <span class="text-muted"><i class="fas fa-briefcase" style="font-size: 12px;"></i>&nbsp; <?= $row['job_category'] ?></span><br>
                                 <span class="text-muted"><i class="fas fa-map-marker-alt" style="font-size: 12px;"></i>&nbsp; <?= $row['location'] ?></span>
                               </div>
                               
                             </div>
                           </div>
                         </div>
                       </a>

                    </div>
                  </div>
                </div>
              </div>
              <!-- End swiper-slide -->


          <?php
            }
          }
          ?>




        </div>
        <div class="swiper-pagination"></div>
      </div>

    </div>

  </section>
  <!-- /Testimonials Section -->




  <!-- How its working -->
  <section id="why-us HowWrk" class="why-us section howWorkingBackgrounf" style="padding: 60px 0; ">

    <!-- Section Title -->
    <div class="container section-title mb-4" data-aos="fade-up">
      <h2>working process</h2>
      <p>How it works</p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="row gy-4 mt-2">

        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
          <div class="card-item text-center"> <!-- Added text-center class for centering the icon -->
            <i class="fas fa-search fa-2x mb-2"></i> <!-- Added icon -->
            <span>1. Search a job</span>
            <p>Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p>
          </div>
        </div><!-- Card Item -->

        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
          <div class="card-item text-center"> <!-- Added text-center class for centering the icon -->
            <i class="fas fa-file-alt fa-2x mb-2"></i> <!-- Added icon -->
            <span>2. Apply for job</span>
            <p>Dolorem est fugiat occaecati voluptate velit esse. Dicta veritatis dolor quod et vel dire leno para dest
            </p>
          </div>
        </div><!-- Card Item -->

        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
          <div class="card-item text-center"> <!-- Added text-center class for centering the icon -->
            <i class="fas fa-briefcase fa-2x mb-2"></i> <!-- Added icon -->
            <span>3. Get your job</span>
            <p>Molestiae officiis omnis illo asperiores. Aut doloribus vitae sunt debitis quo vel nam quis</p>
          </div>
        </div><!-- Card Item -->

      </div>


    </div>

  </section>
  <!-- /Why Us Section -->







  <!-- Testimonials Section for the companies -->
  <section id="testimonials" class="testimonials section" style="padding: 60px 0; ">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2 class="mb-4">Companies</h2>
      <p></p>
    </div><!-- End Section Title -->

    <div class="container " data-aos="fade-up" data-aos-delay="100" id="design_Card">

      <div class="swiper init-swiper" data-speed="600" data-delay="5000" data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
        <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 3,
                "spaceBetween": 0
              },
              "1200": {
                "slidesPerView": 5,
                "spaceBetween": 15
              }
            }
          }
        </script>
        <div class="swiper-wrapper mt-3">





          <?php

          $sql = "SELECT * FROM userregister WHERE usertype ='recruiter' LIMIT 6";

          $sql_run = mysqli_query($conn, $sql);

          if ($sql_run->num_rows > 0) {
            while ($row = mysqli_fetch_array($sql_run)) {
          ?>
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <div class="">
                    <div class="container">
                      <a href="company_data.php?id=<?= $row['id'] ?>">
                        <div class="shadow">
                          <div class="box p-3">
                            <div class="content d-flex align-items-center justify-content-center">
                              <!-- Added justify-content-center class here -->
                              <div class="me-3 d-flex justify-content-center align-items-center">
                                <!-- Updated this div for image centering -->
                                <?php
                                $imagePath = "Admin/uploads/company_profiles/" . $row["profile"]; // Path to the image
                                if (file_exists($imagePath)) {
                                  // If the image file exists, display it
                                  echo '<img src="' . $imagePath . '" alt="Image" class="img-fluid" style="width:60px; border-radius: 20px;">';
                                } else {
                                  // If the image file doesn't exist, display a placeholder or alternative image
                                  echo '<img src="https://cdn-icons-png.freepik.com/512/3135/3135715.png" alt="Placeholder" class="img-fluid" style="width:60px; border-radius: 20px;">';
                                }
                                ?>
                              </div>
                              <div class="text-start d-none d-md-block">
                                <!-- d-none d-md-block hides on mobile and shows on desktop -->
                                <h3 class="chakra-petch-bold"><b><?= $row['company_name'] ?></b></h3>
                                <!-- <a href="company_data.php?id=<?= $row['id'] ?>">View</a> -->
                              </div>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>





          <?php
            }
          }


          ?>




        </div>
        <div class="swiper-pagination"></div>
      </div>

    </div>

  </section>
  <!-- /Testimonials Section for the companies -->








  <!-- Testimonials Section for the categories -->
  <section id="testimonials" class="testimonials section" style="padding: 60px 0; ">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2 class="mb-4">Categories</h2>
      <p></p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100" id="design_Card">

      <div class="swiper init-swiper" data-speed="600" data-delay="5000" data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
        <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "spaceBetween": 5
              },
              "1200": {
                "slidesPerView": 5,
                "spaceBetween": 10
              }
            }
          }
        </script>
        <div class="swiper-wrapper mt-3">





          <?php

          $sql = "SELECT * FROM category";
          $sql_run = mysqli_query($conn, $sql);

          if ($sql_run->num_rows > 0) {
            while ($row = mysqli_fetch_array($sql_run)) {
          ?>
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <div class="">
                    <div class="container">
                      <a href="?id=<?= $row['id'] ?>">
                        <div class="card">
                          <div class="box p-3">
                            <div class="content text-center"> <!-- Added text-center class here -->
                              <div class="mb-3 d-flex justify-content-center align-items-center">
                                <img src="Admin/uploads/category_images/<?= $row['category_image'] ?>" alt="" class="img-fluid ">
                              </div>
                              <h6 class="m-5px-tb"><b><?= $row['category_name'] ?></b></h6>
                              <!-- <a href="company_data.php?id=<?= $row['id'] ?>">View</a> -->
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>



          <?php
            }
          }


          ?>




        </div>
        <div class="swiper-pagination"></div>
      </div>

    </div>

  </section>
  <!-- /Testimonials Section for the companies -->



















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