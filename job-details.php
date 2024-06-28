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

                <div class="p-3">
                  <div class="row">
                    <div class="col-md-12 d-flex justify-content-center align-items-center">
                      <?php
                      if (isset($_SESSION['user_id'])) {

                        $uid = $_SESSION['user_id'];
                        // User is authorized, show the apply button

                        $today = date("Y-m-d");

                        // $application_deadline;
                        $deadline_date = new DateTime($application_deadline);
                        $current_date = new DateTime($today);

                        $interval = $current_date->diff($deadline_date);
                        $days_remaining = $interval->days;

                        if ($current_date < $deadline_date) {
                          $Check_applied = "SELECT * FROM applicants WHERE jobseeker_id = $uid AND applied_job_id = $jobId";
                          $Check_applied_run = mysqli_query($conn, $Check_applied);

                          if (mysqli_num_rows($Check_applied_run) == 1) {
                            echo '<button type="button" class="btn btn-success p-3 custom-btn">
                        Already applied
                      </button>';
                          } else {
                            echo '<button type="button" class="btn btn-primary p-3 custom-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Apply for a job
                      </button>';
                          }
                        } else {
                          echo '<button type="button" class="btn btn-danger p-3 custom-btn">
                      Application closed
                    </button>';
                        }
                      } else {
                        // User is not authorized, show the login button that triggers a modal
                        echo '<button type="button" class="btn btn-primary p-3 custom-btn" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Login to apply for a job
                  </button>';
                      }
                      ?>
                    </div>
                  </div>
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




      <!-- ------------------------------------ ADD MODAL FOR APPLY JOB  -------------------------------------- -->

      <!-- applyModal -->
      <!-- Apply Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Applicant Information</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <?php
                  $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
                  ?>
                  <input type="hidden" class="form-control" id="jobseeker_id" name="jobseeker_id" value="<?= $user_id ?>" required>
                  <input type="hidden" class="form-control" id="company_email" name="company_email" value="<?= $company_email ?>" required>
                </div>
                <div class="mb-3">
                  <label for="full_name" class="form-label">Name:</label>
                  <input type="text" class="form-control" id="name" name="name" value="<?= $_SESSION['first_name'] ?>" required readonly>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email:</label>
                  <input type="email" class="form-control" id="email" value="<?= $_SESSION['user_email'] ?>" name="email" required readonly>
                </div>
                <div class="mb-3">
                  <label for="phone" class="form-label">Phone:</label>
                  <input type="text" class="form-control" id="phone" name="phone">
                </div>
                <div class="mb-3">
                  <label for="resume_file" class="form-label">Resume:</label>
                  <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx">
                </div>
                <div class="mb-3">
                  <input type="hidden" class="form-control" id="applied_job_id" name="applied_job_id" value="<?= $jobId ?>" required>
                </div>
                <div class="mb-3">
                  <input type="hidden" class="form-control" id="AppliedStatus" name="AppliedStatus" value="Pending" required>
                </div>
                <button type="submit" name="apply_Job_Btn" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- ------------------------------------ Login  MODAL FOR APPLY JOB  -------------------------------------- -->

      <!-- Login Modal -->
      <!-- Login Modal -->
      <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row justify-content-center">
                <div class="col-md-12">
                  <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body">
                      <div class="col-md-12">
                        <div>
                          <div class="mb-4 text-center">
                            <img src="images/LOGO.png" alt="Logo" style="width: 300px; height: auto;">
                          </div>
                          <div class="mb-4">
                            <h4 class="text-gray-900 mb-3"><b>Login</b></h4>
                            <h6 class="text-muted mb-3">Don't have an account yet? <a href="register">Sign Up</a></h6>
                            <hr>
                          </div>
                          <form class="user" action="" method="post" autocomplete="">
                            <div class="form-group input-icon">
                              <h6>Email Address</h6>
                            </div>

                            <div class="form-group input-icon">
                              <i class="fas fa-envelope"></i>
                              <input type="email" class="form-control form-control-user" name="email" placeholder="example@gmail.com" required>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                              <div class="form-group input-icon mb-2">
                                <h6>Password</h6>
                              </div>
                              <div class="form-group input-icon mb-2">
                                <a href="reset_password_request">
                                  <h6>Forgot Password</h6>
                                </a>
                              </div>
                            </div>



                            <div class="form-group input-icon">
                              <i class="fas fa-lock"></i>
                              <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Enter 6 Character or more" required>
                              <i class="fas fa-eye toggle-password text-right" id="togglePassword"></i>
                            </div>

                            <script>
                              document.getElementById('togglePassword').addEventListener('click', function(e) {
                                const passwordInput = document.getElementById('password');
                                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                                passwordInput.setAttribute('type', type);
                                this.classList.toggle('fa-eye');
                                this.classList.toggle('fa-eye-slash');
                              });
                            </script>
                            <div class="form-group form-check mt-2 ml-2">
                              <input type="checkbox" class="form-check-input" id="rememberMe">
                              <label class="form-check-label" for="rememberMe">Remember Me</label>
                            </div>
                            <button type="submit" name="login_modal_btn" class="btn btn-primary btn-user btn-block">Login</button>
                            <hr>
                          </form>
                          <hr>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>



  <?php
  }
}





// ---------------------------------------------- Process form data  PHP CODE  submit applications  ------------------------------------------------------------------

if (isset($_POST['apply_Job_Btn'])) {
  $jobseeker_id = $_POST['jobseeker_id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $company_email = $_POST['company_email'];
  $phone = $_POST['phone'];
  $applied_job_id = $_POST['applied_job_id'];
  $AppliedStatus = $_POST['AppliedStatus'];

  // Handle file upload
  $resume_file = $_FILES['resume']['name'];
  $resume_tmp = $_FILES['resume']['tmp_name'];
  $resume_path = "resumes/" . $resume_file;

  if (move_uploaded_file($resume_tmp, $resume_path)) {
    // Insert data into database
    $sql = "INSERT INTO applicants (jobseeker_id, name, email, company_email, phone, resume_file, applied_job_id, applied_at, status)
              VALUES ('$jobseeker_id', '$name', '$email', '$company_email', '$phone', '$resume_file', '$applied_job_id', NOW(), '$AppliedStatus')";

    if ($conn->query($sql) === TRUE) {
      $_SESSION['message'] = "You have applied for a job";

      // Create a new PHPMailer instance
      $mail = new PHPMailer(true);
      try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'mail.graduatejob.lk';
        $mail->SMTPAuth = true;
        $mail->Username = 'noreply@graduatejob.lk';
        $mail->Password = 'Hasni@2024'; // app password here
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Enable verbose debug output
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';

        //Recipients
        $company_name = "GRADUATEJOB.LK";
        $mail->setFrom('noreply@graduatejob.lk', $company_name);
        $mail->addAddress($email, $name);
        // $mail->addCC('mirmirsha123@gmail.com'); // Add CC recipient
        $mail->addBCC($company_email); // Add BCC recipient


        // Content
        $mail->isHTML(true);
        $mail->Subject = 'GRADUATE Job Application Confirmation';
        $mail->Body = "Hello $name,<br><br> Thank you for sending your CV for the position of XYZ . <br><br> 
            Your application is under review. We will get back to you soon. <br><br> 
            The company will contact you for further details if needed or if you are shortlisted <br><br> 
            Please continue to check the available jobs we have using the following link ....... <br><br> 
            You can view / edit your account details any time by logging in to your account <br><br> 
            If you need help, you can find it here: .............  <br><br> 
            Best regards,<br>$company_name";

        $mail->AltBody = "Hello $name,\n\n You have successfully applied for the job. Your application is under review. We will get back to you soon.\n\n Best regards,\n $company_name";

        $mail->send();
        $_SESSION['message'] = "You have applied for a job. A confirmation email has been sent.";
      } catch (Exception $e) {
        $_SESSION['message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }

      // Redirect to the same page to show the message and refresh the page
      echo '<script>window.location.href = "job-details.php?id=' . $applied_job_id . '";</script>';
      exit();
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  } else {
    echo "Failed to upload resume.";
  }
}

// Display the session message if available
if (isset($_SESSION['message'])) {
  echo '<div class="alert alert-success" role="alert">' . $_SESSION['message'] . '</div>';
  unset($_SESSION['message']);
}



// ---------------------------------------------- WHEN LOGIN THROUGHT THE FINDING JOBS PHP CODE  ----------------------------------------------

// Check if the form is submitted
if (isset($_POST['login_modal_btn'])) { $email = $_POST["email"];
  $password = $_POST["password"];

  // SQL query to check if the user exists
  $sql = "SELECT * FROM userregister WHERE email = ?";
  $stmt = $conn->prepare($sql);
  if ($stmt) {
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
          // Fetch the user's data
          $user = $result->fetch_assoc();

          if ($user['user_active'] == '0') {
              // User is inactive
              ?>
              <script>
                  alertify.error("Please submit your document and login.");
              </script>
              <?php
          } else {
              // Verify the password
              if (password_verify($password, $user['password'])) {
                  // Set session variables
                  $_SESSION['user_id'] = $user['id'];
                  $_SESSION['user_email'] = $user['email'];
                  $_SESSION['first_name'] = $user['firstname'];
                  $_SESSION['user_type'] = $user['usertype'];

                  // Redirect based on user type
                  if ($user['usertype'] == 'jobSeeker') {
                      $_SESSION['message'] = "Successfully logged in";
                      echo '<script>window.location.href = "index";</script>';
                      exit();
                  }
              } else {
                  // Password is incorrect
                  ?>
                  <script>
                      alertify.error("Please check your credentials.");
                  </script>
                  <?php
              }
          }
      } else {
          // No user found with that email address
          ?>
          <script>
              alertify.error("No user found with that email address!");
          </script>
          <?php
      }

      $stmt->close();
  } else {
      // Handle SQL preparation error
      ?>
      <script>
          alertify.error("An error occurred. Please try again later.");
      </script>
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




    <script>
      <?php

      // messages from corect or not 

      if (isset($_SESSION['message'])) {
      ?>
        alertify.set('notifier', 'position', 'bottom-right');
        // alertify.success('Current position : ' + aler  tify.get('notifier', 'position'));

        alertify.success('<?= $_SESSION['message'] ?>');
      <?php
        unset($_SESSION['message']);
      }
      ?>
    </script>