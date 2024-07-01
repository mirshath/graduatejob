<?php

session_start();
require "Database/connection.php";


include("includes/header.php");
include("includes/navbar.php");





// Check if the user is logged in
// $is_logged_in = isset($_SESSION['user_id']);
$user_id = isset($_SESSION['user_id']);
$user_id = $user_id ? $_SESSION['user_id'] : null;

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';



if (isset($_GET['id'])) {

    $jobId = $_GET['id'];

    // print_r($jobId);

    $sql = "SELECT * FROM jobs WHERE id = $jobId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $rows = mysqli_fetch_array($result);

        $skills = $rows['skills_required'];

        // Split the skills into an array
        $skillsArray = explode(',', $skills);



        $education_level = $rows['education_level'];
        $application_deadline = $rows['application_deadline'];
        $company_name = $rows['company_name'];

        // Now, let's retrieve the ID of the company based on its name
        $companySql = "SELECT * FROM userregister WHERE company_name = '$company_name'";
        $companyResult = $conn->query($companySql);

        if ($companyResult->num_rows > 0) {
            $companyRow = mysqli_fetch_array($companyResult);
            $company_id = $companyRow['id'];
            $company_IMAGE = $companyRow['profile'];
            $company_email = $companyRow['email'];
            // echo $company_id;


        } else {
            // Handle the case where the company name is not found
        }







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
                }

                #pageHeader .section-title {
                    margin-bottom: 60px;
                }
            </style>

            <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
            <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <!------ Include the above in your HEAD tag ---------->

            <!-- Move the image div outside and before the pageHeader section -->


            <section id="pageHeader" style="margin-top: -25px;">
                <!-- page-header -->
                <div class="page-header">
                    <div class="container">
                        <div class="row mt-4">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                <div class="page-caption">
                                    <h1 class="text-center text-white" data-aos="fade-in"><?= $rows['job_title']; ?></h1>
                                    <p class="text-center text-white" data-aos="fade-in"><?= $rows['company_name']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.page-header-->
            </section>


            <div class="relative-container">
                <div class="card-center d-flex justify-content-center align-items-center mb-3" data-aos="fade-up" data-aos-delay="100">
                    <a href="company_data.php?id=<?= $company_id ?>">
                        <img src="Admin/uploads/company_profiles/<?= $company_IMAGE ?>" alt="" class="img-fluid shadow d-md-none d-block mobile-positioned-image" style="max-width: 200px; border-radius: 20px;">
                    </a>
                </div>

            </div>

            <!-- CSS for relative container and image positioning -->
            <style>
                .relative-container {
                    position: relative;
                }

                .mobile-positioned-image {
                    margin-top: -100px;
                    z-index: 1;
                }

                @media (min-width: 768px) {
                    .mobile-positioned-image {
                        margin-top: 0;
                        position: static;
                    }
                }
            </style>


            <!-- details  -->
            <div class="container mt-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-md-4 order-md-1 mb-4 order-2">
                        <div class="card shadow">
                            <div class="card-center d-flex justify-content-center align-items-center mb-3" data-aos="fade-up" data-aos-delay="100">
                                <a href="company_data.php?id=<?= $company_id ?>">
                                    <img src="Admin/uploads/company_profiles/<?= $company_IMAGE ?>" alt="" class="img-fluid shadow d-none d-md-flex" style="max-width: 200px; border-radius: 20px; margin-top: -100px;">
                                </a>
                            </div>

                            <div class="card-body" data-aos="fade-up" data-aos-delay="300">
                                <!-- Card body content -->
                                <div class="container">
                                    <h4 class="mb-2 chakra-petch-bold"><b><?= $rows['job_title']; ?></b></h4>
                                    <a href="company_data.php?id=<?= $company_id ?>">
                                        <h6 class="chakra-petch-bold mb-4"><?= $rows['company_name']; ?></h6>
                                    </a>

                                    </h6>


                                    <div class="d-flex">
                                        <h6 class="text-muted">
                                            <i class="fas fa-map-marker-alt" style="font-size: 15px;"> &nbsp; &nbsp; <?= $rows['location'] ?></i>
                                        </h6>

                                        &nbsp; &nbsp; &nbsp;
                                        <h6 class="text-muted">
                                            <i class="fas fa-calendar-alt" style="font-size: 15px;"> &nbsp;&nbsp;
                                                <?= $rows['application_deadline'] ?></i>
                                        </h6>

                                        &nbsp; &nbsp; &nbsp;
                                        <h6 class="text-muted">
                                            <i class="fas fa-briefcase" style="font-size: 15px;"></i>
                                            &nbsp; <?= $rows['employment_type'] ?>
                                        </h6>
                                    </div>
                                </div>
                                <hr>

                                <div class="p-3">

                                    <h6><?= $rows['additional_info'] ?></h6>
                                </div>

                                <div class="p-3 ">
                                    <table>
                                        <tr class="mb-4">
                                            <td>Education Level</td>
                                            <td> &nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;</td>
                                            <td><?= $rows['education_level'] ?></td>
                                        </tr>
                                        <tr class="mb-4">
                                            <td>Skills</td>
                                            <td> &nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;</td>
                                            <td><?php foreach ($skillsArray as $skill) {
                                                    echo '<span class="badge bg-secondary">' . strtoupper(trim($skill)) . '</span> ';
                                                } ?></td>
                                        </tr>
                                        <tr class="mb-4">
                                            <td>Experience Level</td>
                                            <td> &nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;</td>
                                            <td class=""><?= $rows['experience_level'] ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <hr>
                                <div class="p-3 text-center">
                                    <a href="https://www.facebook.com/yourpage" target="_blank"><i class="fab fa-facebook-square fa-3x"></i></a>

                                    <!-- Twitter -->
                                    <a href="https://twitter.com/yourpage" target="_blank"><i class="fab fa-twitter-square fa-3x"></i></a>

                                    <!-- Instagram -->
                                    <a href="https://www.instagram.com/yourpage" target="_blank"><i class="fab fa-instagram-square fa-3x"></i></a>

                                    <!-- LinkedIn -->
                                    <a href="https://www.linkedin.com/in/yourprofile" target="_blank"><i class="fab fa-linkedin fa-3x"></i></a>

                                    <!-- YouTube -->
                                    <a href="https://www.youtube.com/channel/yourchannel" target="_blank"><i class="fab fa-youtube-square fa-3x"></i></a>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 order-md-2 order-1 ">
                        <!-- Other content remains here -->
                        <p class="text-muted" style="font-size: 17px; line-height: 35px; text-align: justify;">
                            <?= $rows['job_description']; ?>
                        </p>
                        <div class="img d-flex justify-content-center">
                            <img src="Admin/uploads/<?= $rows['company_logo']; ?>" alt="job dec Img" class="img-fluid" width="800px">
                        </div>
                    </div>
                </div>
            </div>






    <?php
    }
}










    ?>

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




        <s cript>
            <?php

            // messages from corect or not 

            if (isset($_SESSION['message'])) {
            ?>
                alertify.set('notifier', 'position', 'bottom-right');
                // alertify.success('Current position : ' + aler tify.get('notifier', 'position'));

                alertify.success('<?= $_SESSION['message'] ?>');
            <?php
                unset($_SESSION['message']);
            }
            ?>
            </script>