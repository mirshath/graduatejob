<?php
session_start();
require "includes/header.php";
include("Database/connection.php");




// Check if the user is logged in
// $is_logged_in = isset($_SESSION['user_id']);
$user_id = isset($_SESSION['user_id']);
$user_id = $user_id ? $_SESSION['user_id'] : null;

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


//  echo $user_id;







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
      // echo $company_id;


    } else {
      // Handle the case where the company name is not found
    }

?>


    <style>
      .circle-img {
        border-radius: 50%;
        width: 300px;
        background-color: red;
        /* Add this line to set the background color */
      }

      .bbb {
        margin-top: 100px;
      }
    </style>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
      <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->


    <?php require "includes/navbar.php"; ?>


    <!-- Page Content -->
    <div class="page-heading about-heading header-text" style="background-image: url('images/des.jpg'); ">
      <div class="container">
        <div class="row">

          <div class="col-md-12">
            <a href="javascript:history.back()">
              <div class="circle-icon">
                <i class="fas fa-arrow-left"></i>
              </div>
            </a>
            <div class="text-content">
              <h2 class="chakra-petch-bold"><?= $rows['job_title']; ?></h2>
              <a href="company_data?id=<?= $company_id ?>">
                <h4 class="chakra-petch-bold"><?= $rows['company_name']; ?></h4>
              </a>

            </div>
          </div>
        </div>
      </div>
    </div>



    <!-- details  -->
    <div class="container mt-4 mb-4">

      <div class="row">
        <div class="col-md-4 order-md-2 mb-4 order-1">
          <div class="card shadow">
            <div class="card-center">
              <!-- <img src="Admin/uploads/<?= $rows["company_logo"]; ?>" alt="" class="img-fluid shadow"
                style="max-width: 200px; border-radius: 20px;"> -->
              <a href="company_data.php?id=<?= $company_id ?>"> <img src="Admin/uploads/company_profiles/<?= $company_IMAGE ?>" alt="" class="img-fluid shadow" style="max-width: 200px; border-radius: 20px;"></a>

            </div>

            <div class="card-body">
              <!-- Card body content -->
              <div class="container">
                <h4 class="mb-2 chakra-petch-bold"><b><?= $rows['job_title']; ?></b></h4>
                <a href="company_data.php?id=<?= $company_id ?>">
                  <h6 class="chakra-petch-bold"><?= $rows['company_name']; ?></h6>
                </a>

                </h6>
                <h6 class=" text-muted">
                  <i class="fas fa-map-marker-alt" style="font-size: 15px;"> &nbsp; &nbsp; <?= $rows['location'] ?></i>

                </h6>
                <h6 class=" text-muted">
                  <i class="fas fa-calendar-alt" style="font-size: 15px;"> &nbsp;&nbsp;
                    <?= $rows['application_deadline'] ?></i>
                </h6>
                <h6 class=" text-muted">
                  <i class="fas fa-briefcase" style="font-size: 15px;"></i>
                  &nbsp; <?= $rows['employment_type'] ?>
                </h6>
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
                        echo '<div class="col-md-12">
                              <button type="button" class="btn btn-success btn-block p-3 custom-btn">
                                Already applied
                              </button>
                            </div>';
                      } else {
                        echo '<div class="col-md-12">
                              <button type="button" class="btn btn-primary btn-block p-3 custom-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Apply for a job
                              </button>
                            </div>';
                      }
                    } else {
                      echo '<div class="col-md-12">
                              <button type="button" class="btn btn-danger btn-block p-3 custom-btn" >
                               Application closed
                              </button>
                            </div>';
                    }
                  } else {
                    // User is not authorized, show the login button that triggers a modal
                    echo '<div class="col-md-12">
                    <button type="button" class="btn btn-primary btn-block p-3 custom-btn" data-bs-toggle="modal" data-bs-target="#loginModal">
                      Login to apply for a job
                    </button>
                  </div>';
                  }
                  ?>

                </div>
              </div>




            </div>
          </div>
        </div>

        <div class="col-md-8 order-md-1 order-2 ">
          <!-- <h3 class="text-muted mb-4"><b><?= $rows['job_title']; ?></b></h3>
          <h6 class="text-muted mb-4">Presented by : <b><?= $rows['company_name']; ?></b></h6>
          <p class="text-muted" style="font-size: 17px; line-height: 35px; text-align: justify;">
            <?= $rows['job_description']; ?>
          </p> -->





        </div>
      </div>

    </div>








    <!-- ------------------------------------ ADD MODAL FOR APPLY JOB  -------------------------------------- -->

    <!-- applyModal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body mt-3 mb-3">
            <h2 class="text-muted mt-3 mb-5">Applicant Information</h2>
            <hr>

            <form action="" method="POST" enctype="multipart/form-data">

              <div class="mb-3">
                <?php
                // Check if user is logged in before setting the jobseeker_id
                $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
                ?>
                <input type="hidden" class="form-control" id="jobseeker_id" name="jobseeker_id" value="<?= $user_id ?>" required>
              </div>

              <div class="mb-3">
                <label for="full_name" class="form-label"> Name:</label>
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
                <!-- <label for="applied_job_id" class="form-label">Applied Job ID:</label> -->
                <input type="hidden" class="form-control" id="applied_job_id" name="applied_job_id" value="<?= $jobId ?>" required>
              </div>
              <div class="mb-3">
                <!-- <label for="applied_job_id" class="form-label">Applied Job ID:</label> -->
                <input type="hidden" class="form-control" id="AppliedStatus" name="AppliedStatus" value="Pending" required>
              </div>

              <button type="submit" name="apply_Job_Btn" class="btn btn-primary">Submit</button>

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
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














// ---------------------------------------------- Process form data  PHP CODE  ------------------------------------------------------------------
if (isset($_POST['apply_Job_Btn'])) {
  $jobseeker_id = $_POST['jobseeker_id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $applied_job_id = $_POST['applied_job_id'];
  $AppliedStatus = $_POST['AppliedStatus'];

  // Handle file upload
  $resume_file = $_FILES['resume']['name'];
  $resume_tmp = $_FILES['resume']['tmp_name'];
  $resume_path = "resumes/" . $resume_file;

  move_uploaded_file($resume_tmp, $resume_path);

  // Insert data into database
  $sql = "INSERT INTO applicants (jobseeker_id, name, email, phone, resume_file, applied_job_id, applied_at, status)
          VALUES ('$jobseeker_id', '$name', '$email', '$phone', '$resume_file', '$applied_job_id', NOW(), '$AppliedStatus')";

  if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = "You have applied for a job";

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
      //Server settings
      $mail->isSMTP();
      // $mail->Host = 'smtp.office365.com';
      $mail->Host = 'mail.graduatejob.lk';
      $mail->SMTPAuth = true;

      // $mail->Username = 'noreply@bms.ac.lk';
      // $mail->Password = 'Lox51527';


      // test.student@bms.ac.lk 
      // nrcpygwshcdhxfcg

      $owner_mail = 'noreply@graduatejob.lk';

      $mail->Username = $owner_mail;
      $mail->Password = 'Hasni@2024'; //app password here

      // $mail->Username = 'noreply@graduatejob.lk';
      // $mail->Password = 'Hasni@2024';

      // $mail->Username = 'yournumplz@gmail.com';
      // $mail->Password = 'uzsihqeugnntzwke';

      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = 587;

      //Recipients
      $company_name = "GRADUATE JOB. LK";
      $mail->setFrom($owner_mail, $company_name);
      $mail->addAddress($email, $name);

      // Content
      $mail->isHTML(true);
      $mail->Subject = 'GRADUATE Job Application Confirmation';
      $mail->Body = "Hello $name,<br><br> Thank you for sending your CV for the position of XYZ . <br><br> 
      Your application is under review. We will get back to you soon. <br><br> 
      the company will contact you for further details if needed or if you are shortlisted <br><br> 
      please continue to check the available jobs we have using the following link ....... <br><br> 
      you can view / edit your account details any time by Login to your account <br><br> 
      if you need a help, you can find it here: .............  <br><br> 
      Best regards,<br>
      $company_name";

      $mail->AltBody = "Hello $name,\n\n You have successfully applied for the job. Your application is under review. We will get back to you soon.\n\n Best regards,\n $company_name";

      $mail->send();
      // echo 'A confirmation email has been sent.';
      $_SESSION['message'] = "You have applied for a job.  A confirmation email has been sent.  ";
    } catch (Exception $e) {
      // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      $_SESSION['message'] = " Message could not be sent. Mailer Error: {$mail->ErrorInfo} ";
    }

    // Redirect or further actions
    // header("Location: success_page.php");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}







// ---------------------------------------------- WHEN LOGIN THROUGHT THE FINDING JOBS PHP CODE  ----------------------------------------------

// Check if the form is submitted
if (isset($_POST['login_modal_btn'])) {
  // Get email and password from the form submission
  $email = $_POST["email"];
  $password = $_POST["password"];

  // SQL query to check if the user exists
  $sql = "SELECT * FROM userregister WHERE email = ?";
  $stmt = $conn->prepare($sql);
  if ($stmt === false) {
    die("Failed to prepare SQL statement: " . $conn->error);
  }

  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // Fetch the user's data
    $user = $result->fetch_assoc();

    // Verify the password
    if (password_verify($password, $user['password'])) {
      // Set session variables
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_email'] = $user['email'];
      $_SESSION['first_name'] = $user['firstname'];
      $_SESSION['user_type'] = $user['usertype'];
      $_SESSION['message'] = "Successfully logged in";

      // Redirect based on user type
      if ($user['usertype'] == 'jobSeeker') {
        // header("Location: job-details?id=" . $_GET['jobId']);
        echo '<script>window.location.href = "job-details?id=' . $jobId . '";</script>';
        exit();
      } else if ($user['usertype'] == 'recruiter') {
        header("Location: Recuiter/recruiterIndex");
        exit();
      }
    } else {
      // Password did not match
      $_SESSION['message'] = "Please check your credentials.";
    }
  } else {
    // No user found with that email address
    $_SESSION['message'] = "No user found with that email address!";
  }

  $stmt->close();
}











?>



<?php include("includes/footer.php") ?>


<!-- Bootstrap core JavaScript -->
<script data-cfasync="false" src="https://demo.phpjabbers.com/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="https://demo.phpjabbers.com/free-web-templates/job-website-template-138/vendor/jquery/jquery.min.js"></script>
<script src="https://demo.phpjabbers.com/free-web-templates/job-website-template-138/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Additional Scripts -->
<script src="https://demo.phpjabbers.com/free-web-templates/job-website-template-138/assets/js/custom.js"></script>
<script src="https://demo.phpjabbers.com/free-web-templates/job-website-template-138/assets/js/owl.js"></script>
</body>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>


<!-- <link rel="stylesheet" href="assets/css/formstyle.css"> -->




<!-- when profile drop down working link  -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Mirrored from demo.phpjabbers.com/free-web-templates/job-website-template-138/job-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 May 2024 08:12:56 GMT -->



<script>
  <?php
  // Check if $_SESSION['message'] is set and display it using Alertify.js
  if (isset($_SESSION['message'])) {
  ?>
    alertify.set('notifier', 'position', 'bottom-right');
    alertify.success('<?= $_SESSION['message'] ?>');
  <?php
    // Unset $_SESSION['message'] to prevent it from being displayed again on subsequent page loads
    unset($_SESSION['message']);
  }
  ?>
</script>




<!-- ---------------------------------------------------- CSS styles ---------------------------------------------------- -->
<style>
  .card {
    width: 100%;
    max-width: 700px;
    border-radius: 15px;
  }

  .card-body {
    padding: 2rem;
  }

  .form-group p {
    margin-bottom: 0.5rem;
    font-weight: bold;
  }

  .form-control-user {
    padding: 1.5rem 1rem;
    border-radius: 10px;
  }

  .btn-user {
    padding: 0.75rem 1rem;
    border-radius: 10px;
    background-color: #033367;
    /* color: rgb(255, 255, 255); */
    color: white;
    font-weight: 700;
  }

  .btn {
    font-weight: 700;
  }

  .btn-primary {
    /* color: #dc3545; */
    background-color: #082544;
    /* border-color: #082544; */
    padding: 10px;
    border-radius: 12px;
    margin-left: 5px;
  }

  .btn-success {
    /* color: #dc3545; */
    background-color: #075c0b;
    /* border-color: #075c0b; */
    padding: 10px;
    border-radius: 12px;
    margin-left: 5px;
  }



  .input-icon {
    position: relative;
  }

  .input-icon i {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
  }

  .form-control {
    padding-left: 2.5rem;
  }

  .login-image {
    max-width: 100%;
    height: auto;
    border-radius: 15px;
  }


  @media (max-width: 768px) {
    .row.justify-content-center {
      flex-direction: column;
    }

    .col-lg-12 {
      margin-top: 2rem;
    }

    .card-body {
      padding: revert;
      padding: 15px;
    }
  }











  form-group.input-icon {
    position: relative;
    display: flex;
    align-items: center;
  }

  .form-group.input-icon .fa-lock {
    position: absolute;
    left: 15px;
    cursor: pointer;
  }

  .form-group.input-icon .fa-eye,
  .form-group.input-icon .fa-eye-slash {
    position: absolute;
    right: 15px;
    cursor: pointer;
  }

  .form-control-user {
    padding-left: 40px;
    /* Ensure there's enough space for the lock icon */
    padding-right: 40px;
    /* Ensure there's enough space for the eye icon */
    width: 100%;
    /* Make sure the input takes full width */
  }
</style>


</html>