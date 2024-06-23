<?php

session_start();
require "Database/connection.php";


include("includes/header.php");
include("includes/navbar.php");
?>

<main class="main">



  <!-- Hero Section -->
  <section id="hero" class="hero section">

    <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

    <div class="container">
      <div class="row">
        <div class="col-lg-8 d-flex flex-column align-items-center align-items-lg-start">
          <h2 data-aos="fade-up" data-aos-delay="100">Welcome to <span>GRADUATEJOB.LK</span></h2>
          <p data-aos="fade-up" data-aos-delay="200">Find your path and Do best</p>
          <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
            <a href="#menu" class="cta-btn">About US</a>
            <a href="#book-a-table" class="cta-btn">Find a Job</a>
          </div>
        </div>
        <div class="col-lg-4 d-flex align-items-center justify-content-center mt-5 mt-lg-0">
          <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
        </div>
      </div>
    </div>

  </section><!-- /Hero Section -->

  <!-- About Section -->
  <section id="about" class="about section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row gy-4">
        <div class="col-lg-6 order-1 order-lg-2">
          <img src="assets/img/about.jpg" class="img-fluid about-img" alt="">
        </div>
        <div class="col-lg-6 order-2 order-lg-1 content">
          <h3>Voluptatem dignissimos provident</h3>
          <p class="fst-italic">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua.
          </p>
          <ul>
            <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
            <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
            <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
          </ul>
          <p>
            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
          </p>
        </div>
      </div>

    </div>

  </section>
  <!-- /About Section -->






  <!-- Testimonials Section for jobs recents -->
  <section id="testimonials" class="testimonials section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
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
        <div class="swiper-wrapper">





          <?php

          $sql = "SELECT * FROM jobs WHERE admin_status='Approved' AND application_status='active' ORDER BY id DESC LIMIT 6";
          $sql_run = mysqli_query($conn, $sql);



          if ($sql_run->num_rows > 0) {
            while ($row = mysqli_fetch_array($sql_run)) {
          ?>
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <div class="card  border-0 bg-light rounded shadow">
                    <div class="card-body p-4">
                      <span class="badge rounded-pill bg-primary float-md-end mb-3 mb-sm-0">
                        <i class="fas fa-briefcase" style="font-size: 15px;"></i>
                        <?= $row['employment_type'] ?>
                      </span>
                      <h5><b><?= $row['job_title'] ?></b></h5>
                      <div class="mt-3">
                        <span class="text-muted d-block"><i class="fas fa-briefcase" style="font-size: 15px;">&nbsp; <?= $row['job_category'] ?></i></span>
                        <span class="text-muted d-block"><i class="fas fa-map-marker-alt" style="font-size: 15px;">&nbsp; <?= $row['location'] ?></i></span>
                      </div>
                      <div class="mt-3">
                        <a href="job-details?id=<?= $row['id']; ?>" class="btn btn-primary">View Details</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End testimonial item -->

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
  <section id="why-us" class="why-us section howWorkingBackgrounf">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>working process</h2>
      <p>How it works</p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="row gy-4">

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
            <p>Dolorem est fugiat occaecati voluptate velit esse. Dicta veritatis dolor quod et vel dire leno para dest</p>
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
  <section id="testimonials" class="testimonials section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Companies</h2>
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
                "spaceBetween": 15
              }
            }
          }
        </script>
        <div class="swiper-wrapper">





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
                        <div class="card">
                          <div class="box p-3">
                            <div class="content d-flex align-items-center justify-content-center"> <!-- Added justify-content-center class here -->
                              <div class="me-3 d-flex justify-content-center align-items-center"> <!-- Updated this div for image centering -->
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
                              <div class="text-start d-none d-md-block"> <!-- d-none d-md-block hides on mobile and shows on desktop -->
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
  <section id="testimonials" class="testimonials section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Categories</h2>
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
        <div class="swiper-wrapper">





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
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlSjpT0YPXyFzHpBKIPoedcq1J-G-9c25Jxw&s" alt="" class="img-fluid">
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





<script>
  <?php

  // messages from corect or not 

  if (isset($_SESSION['message'])) {
  ?>
    alertify.set('notifier', 'position', 'bottom-right');
    alertify.success('Current position : ' + alertify.get('notifier', 'position'));

    alertify.success('<?= $_SESSION['message'] ?>');
  <?php
    unset($_SESSION['message']);
  }
  ?>
</script>