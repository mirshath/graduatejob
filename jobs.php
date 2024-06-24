<?php

session_start();
require "Database/connection.php";


include ("includes/header.php");
include ("includes/navbar.php");
?>

<main class="main">

<!-- Hero Section -->
<section id="hero" class="hero section">

<img src="assets/img/bg1.jpg" alt="" data-aos="fade-in">

<div class="container">
  <div class="row">
    <div class="col-lg-12 d-flex flex-column align-items-center align-items-lg-start">
      <h2 data-aos="fade-up" data-aos-delay="100">Welcome to <span>GRADUATEJOB.LK</span></h2>
      <p data-aos="fade-up" data-aos-delay="200">Find your path and Do best</p>
      <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
      </div>
    </div>
    
  </div>
</div>

</section><!-- /Hero Section -->













  <!-- -------------------------------- FOoter Section ----------------------------------- -->
  <!-- -------------------------------- FOoter Section ----------------------------------- -->





</main>

<?php include ("includes/footer.php");
?>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
    class="bi bi-arrow-up-short"></i></a>

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