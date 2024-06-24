<?php

session_start();
require "Database/connection.php";


include("includes/header.php");
include("includes/navbar.php");


$user_id = isset($_SESSION['user_id']);
$user_id = $user_id ? $_SESSION['user_id'] : null;



if (isset($_GET['id'])) {

    $com_id = $_GET['id'];
    // echo $com_id;

    $get_com_data_from_id = "SELECT * FROM userregister WHERE id = '$com_id'";
    $get_com_data_from_id_run = mysqli_query($conn, $get_com_data_from_id);
    $get_com_data = mysqli_fetch_array($get_com_data_from_id_run);

    $c_name = $get_com_data['company_name'];
    // echo $c_name;


    $get_company_follwers = "SELECT * FROM jobseeker_company_subscriptions WHERE company_id  = '$com_id'  ";
    $get_company_follwers_run = mysqli_query($conn, $get_company_follwers);
    $get_company_follwers_count = mysqli_num_rows($get_company_follwers_run);
    //   echo $get_company_follwers_count;

    // getting all jobs where the CompanyId 


    $get_particular_Company_job = "SELECT * FROM jobs WHERE company_name = '$c_name' AND admin_status = 'Approved' AND application_status = 'active' ";
    $get_particular_Company_job_run = mysqli_query($conn, $get_particular_Company_job);
    $get_particular_Company_job_count = mysqli_num_rows($get_particular_Company_job_run);
    //  echo $get_particular_Company_job_count;

    // -----------------------------------------




    $sql = "SELECT * FROM jobseeker_company_subscriptions WHERE jobseeker_id = ? AND company_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $com_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $is_subscribed = ($result->num_rows > 0) ? true : false;



?>


<main class="main">




    <style>
        .circle-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }


        /* another design for the SUBSCRIBE BUTTON   */

        .wrap-check-41 .tgl {
            display: none;
        }

        .wrap-check-41 .tgl,
        .wrap-check-41 .tgl:after,
        .wrap-check-41 .tgl:before,
        .wrap-check-41 .tgl *,
        .wrap-check-41 .tgl *:after,
        .wrap-check-41 .tgl *:before,
        .wrap-check-41 .tgl+.tgl-btn {
            box-sizing: border-box;
        }

        .wrap-check-41 .tgl::-moz-selection,
        .wrap-check-41 .tgl:after::-moz-selection,
        .wrap-check-41 .tgl:before::-moz-selection,
        .wrap-check-41 .tgl *::-moz-selection,
        .wrap-check-41 .tgl *:after::-moz-selection,
        .wrap-check-41 .tgl *:before::-moz-selection,
        .wrap-check-41 .tgl+.tgl-btn::-moz-selection,
        .wrap-check-41 .tgl::selection,
        .wrap-check-41 .tgl:after::selection,
        .wrap-check-41 .tgl:before::selection,
        .wrap-check-41 .tgl *::selection,
        .wrap-check-41 .tgl *:after::selection,
        .wrap-check-41 .tgl *:before::selection,
        .wrap-check-41 .tgl+.tgl-btn::selection {
            background: none;
        }

        .wrap-check-41 .tgl+.tgl-btn {
            outline: 0;
            display: block;
            width: 8em;
            height: 2em;
            position: relative;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .wrap-check-41 .tgl+.tgl-btn:after,
        .wrap-check-41 .tgl+.tgl-btn:before {
            position: relative;
            display: block;
            content: "";
            width: 50%;
            height: 100%;
        }

        .wrap-check-41 .tgl+.tgl-btn:after {
            left: 0;
        }

        .wrap-check-41 .tgl+.tgl-btn:before {
            display: none;
        }

        .wrap-check-41 .tgl:checked+.tgl-btn:after {
            left: 50%;
        }

        .wrap-check-41 .tgl-flip+.tgl-btn {
            padding: 2px;
            transition: all 0.2s ease;
            font-family: sans-serif;
            perspective: 100px;
        }

        .wrap-check-41 .tgl-flip+.tgl-btn:after,
        .wrap-check-41 .tgl-flip+.tgl-btn:before {
            display: inline-block;
            transition: all 0.4s ease;
            width: 100%;
            text-align: center;
            position: absolute;
            line-height: 2em;
            font-weight: bold;
            color:
                #fff;
            position: absolute;
            top: 0;
            left: 0;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            border-radius: 4px;
        }

        .wrap-check-41 .tgl-flip+.tgl-btn:after {
            content: attr(data-tg-on);
            background:
                #02C66F;
            transform: rotateY(-180deg);
        }

        .wrap-check-41 .tgl-flip+.tgl-btn:before {
            background:
                #FF3A19;
            content: attr(data-tg-off);
        }

        .wrap-check-41 .tgl-flip+.tgl-btn:active:before {
            transform: rotateY(-20deg);
        }

        .wrap-check-41 .tgl-flip:checked+.tgl-btn:before {
            transform: rotateY(180deg);
        }

        .wrap-check-41 .tgl-flip:checked+.tgl-btn:after {
            transform: rotateY(0);
            left: 0;
            background:
                #7FC6A6;
        }

        .wrap-check-41 .tgl-flip:checked+.tgl-btn:active:after {
            transform: rotateY(20deg);
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


    <?php

    if (isset($user_id)) {
        // Your SQL and subscription check logic here
        $sql = "SELECT * FROM jobseeker_company_subscriptions WHERE jobseeker_id = ? AND company_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $com_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $is_subscribed = ($result->num_rows > 0) ? true : false;
        $stmt->close();
    ?>

        <!-- if the auther is authenticated like logged in  -->

    <?php
    } else {
    ?>
        <!-- open modal section without user login  -->
        <!-- <div class="d-flex justify-content-center align-items-center mt-4">
            <h6 class="text-muted mb-4">Subscribe Company</h6>
            <div class="wrap-check-41 ml-3">
                <input class="tgl tgl-flip" id="cb5" type="checkbox" value="<?= $com_id ?>" onclick="openLoginModal()" />
                <label class="tgl-btn" data-tg-off="Login to Subscribe" data-tg-on="Login to Subscribe" for="cb5">
                    <i class="float-right fa fa-bell-slash" style="margin-top: 6px; margin-right: 10px;"></i>
                </label>
            </div>
        </div> -->

    <?php
    }



    ?>


  <!-- ---------------------------------------------------- -->
    <!-- header section for banner -->
    <!-- ---------------------------------------------------- -->


    <div class="container mt-4 mb-4" >

        <div class="row" style=" margin-top: 150px;">

            <div class="col-md-12 mb-3">
                <a href="javascript:history.back()">
                    <div class="circle-icon bg-primary text-white d-flex justify-content-center align-items-center">
                        <i class="fas fa-arrow-left"></i>
                    </div>
                </a>
            </div>



            <!-- code start -->
            <div class="twPc-div">
                <a class="twPc-bg twPc-block mt-3 ">
                </a>

                <div>
                    <a title="" href="#" class="twPc-avatarLink">
                        <img alt="Company Logo" src="Admin/uploads/company_profiles/<?= $get_com_data['profile'] ?>" class="twPc-avatarImg" style="width: 120px; height: 120px;">
                    </a>

                    <div class="twPc-divUser">
                        <div class="twPc-divName">
                            <h3 class="chakra-petch-bold"><?= $c_name ?></h3>
                        </div>
                        <span>
                            <a href="#"><span> <?= $get_com_data['websites'] ?></span></a>
                        </span>
                    </div>

                    <div class="twPc-divStats">
                        <ul class="twPc-Arrange">

                            <li class="twPc-ArrangeSizeFit">
                                <a href="#" title="1.810 Followers">
                                    <span class="twPc-StatLabel twPc-block fw-bold">Followers</span>
                                    <span class="twPc-StatValue "><?= $get_company_follwers_count ?></span>
                                </a>
                            </li>
                            <li class="twPc-ArrangeSizeFit">
                                <a href="#" title="1.810 Followers">
                                    <span class="twPc-StatLabel twPc-block fw-bold">JOBS</span>
                                    <span class="twPc-StatValue"><?= $get_particular_Company_job_count ?></span>
                                </a>
                            </li>
                            <li class="twPc-ArrangeSizeFit">
                                <div class="d-flex justify-content-end align-items-center ">
                                    <div class="wrap-check-41 ml-3">
                                        <input class="tgl tgl-flip" id="cb5" type="checkbox" value="<?= $com_id ?>" <?= $is_subscribed ? 'checked' : '' ?> onchange="toggleSubscription(this)" />
                                        <label class="tgl-btn" data-tg-off="follow" data-tg-on="following !" for="cb5">
                                            <i class="float-right fa fa-bell<?= $is_subscribed ? '' : '-slash' ?>" style="margin-top: 6px; margin-right: 10px;"></i>
                                        </label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- code end -->

            <div id="long_card_job_listing" class="mt-4">
                <div class="">

                    <?php


                    function random_color()
                    {
                        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                    }

                    $sql = "SELECT * FROM jobs WHERE company_name ='$c_name' AND admin_status = 'Approved' AND application_status = 'active'";
                    $sql_run = mysqli_query($conn, $sql);

                    if ($sql_run->num_rows > 0) {
                        while ($row = mysqli_fetch_array($sql_run)) {
                            $random_color = random_color();

                            $skills = $row['skills_required'];

                            // Split the skills into an array
                            $skillsArray = explode(',', $skills);

                    ?>
                            <div class="card mb-3">
                                <a href="job-details?id=<?= $row['id']; ?>" class="stretched-link"></a>
                                <div class="card-body">
                                    <div class="d-flex flex-column flex-lg-row">
                                        <span class="avatar avatar-text rounded-3 me-4 mb-2" style="background-color: <?= $random_color ?>;">
                                            <?= substr($row['job_title'], 0, 2) ?>
                                        </span>
                                        <div class="row flex-fill">
                                            <div class="col-sm-5 ">
                                                <h4 class="h5"><?= $row['job_title'] ?></h4>
                                                <span class="badge bg-info"><?= $row['location'] ?></span>
                                                <span class="badge bg-secondary"><?= $row['job_category'] ?></span>
                                                <span class="badge bg-info"><?= $row['company_name'] ?></span>
                                            </div>
                                            <div class="col-sm-4 py-2 mb-2">
                                                <?php
                                                foreach ($skillsArray as $skill) {
                                                    echo '<span class="badge bg-secondary">' . strtoupper(trim($skill)) . '</span> ';
                                                }

                                                ?>
                                            </div>
                                            <div class="col-sm-3 text-lg-end">
                                                <span class="badge bg-success"><?= $row['employment_type'] ?></span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>



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
            </style>





        </div>
    </div>
    <!-- ---------------------------------------------------- -->
    <!-- ---------------------------------------------------- -->



    <style>
        /* body section for the header section   */
        .glyphicon {
            margin-bottom: 10px;
            margin-right: 10px;
        }

        small {
            display: block;
            line-height: 1.428571429;
            color: #999;
        }


        /* END body section for the header section   */
        .twPc-div {
            background: #fff none repeat scroll 0 0;
            border: 1px solid #e1e8ed;
            border-radius: 6px;
            height: 330px;
            max-width: 340px;
            /* orginal twitter width: 290px; */
        }

        .twPc-bg {
            background-image: url("https://img.freepik.com/free-vector/dark-wavy-colors-background_23-2148403785.jpg?t=st=1717911486~exp=1717915086~hmac=4d5d076a50890b4b1fc0829a7138fbdb838fca9d5592fe0f4b2ac678d4726ded&w=1380");
            background-position: 0 50%;
            background-size: 100% auto;
            border-bottom: 1px solid #e1e8ed;
            border-radius: 4px 4px 4px 4px;
            height: 150px;
            width: 100%;
        }

        .twPc-block {
            display: block !important;
        }

        .twPc-button {
            margin: -35px -10px 0;
            text-align: right;
            width: 100%;
        }

        .twPc-avatarLink {
            background-color: #fff;
            border-radius: 6px;
            display: inline-block !important;
            float: left;
            margin: -57px 5px 0 8px;
            max-width: 100%;
            padding: 1px;
            vertical-align: bottom;
        }

        .twPc-avatarImg {
            border: 2px solid #fff;
            border-radius: 7px;
            box-sizing: border-box;
            color: #fff;
            height: 72px;
            width: 72px;
        }



        .twPc-divUser {
            margin: 5px 0 0;
        }

        .twPc-divName {
            font-size: 18px;
            font-weight: 700;
            line-height: 21px;
        }

        .twPc-divName a {
            color: inherit !important;
        }

        .twPc-divStats {
            margin-left: 11px;
            padding: 10px 0;
            margin-top: 15px;
        }

        .twPc-Arrange {
            box-sizing: border-box;
            display: table;
            margin: 0;
            min-width: 100%;
            padding: 0;
            table-layout: auto;
        }

        ul.twPc-Arrange {
            list-style: outside none none;
            margin: 0;
            padding: 0;
        }

        .twPc-ArrangeSizeFit {
            display: table-cell;
            padding: 0;
            vertical-align: top;
        }

        .twPc-ArrangeSizeFit a:hover {
            text-decoration: none;
        }

        .twPc-StatValue {
            display: block;
            font-size: 18px;
            font-weight: 500;
            transition: color 0.15s ease-in-out 0s;
        }

        .twPc-StatLabel {
            color: #8899a6;
            font-size: 16px;
            letter-spacing: 0.02em;
            overflow: hidden;
            text-transform: uppercase;
            transition: color 0.15s ease-in-out 0s;
        }
    </style>







<script>
        // login modal script 
        function openLoginModal() {
            $('#loginModal').modal('show');
        }


        // Following concept script 
        // ------------------------------------------------ 
        function toggleSubscription(checkbox) {
            var company_id = checkbox.value;
            var isChecked = checkbox.checked;

            if (isChecked) {
                // Subscribe the user
                subscribeCompany(company_id);
            } else {
                // Unsubscribe the user
                unsubscribeCompany(company_id);
            }
        }

        function subscribeCompany(company_id) {
            // Send AJAX request to update subscription status
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        // Subscription status updated successfully
                        console.log("Subscription status updated for company ID: " + company_id);
                        alertify.success(" Succesfully Followed" );

                        
                    } else {
                        // Error updating subscription status
                        console.error("Error updating subscription status for company ID: " + company_id);
                    }
                }
            };
            xhr.open("POST", "subscribe.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("company_id=" + company_id);
        }

        function unsubscribeCompany(company_id) {
            // Send AJAX request to unsubscribe from the company
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        // Unsubscription successful
                        console.log("Successfully unsubscribed from company ID: " + company_id);
                        alertify.error("Successfully unsubscribed ");
                        // Optionally, you can perform any additional actions after successful unsubscription
                    } else {
                        // Error unsubscribing
                        console.error("Error unsubscribing from company ID: " + company_id);
                    }
                }
            };
            xhr.open("POST", "unsubscribe.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("company_id=" + company_id);
        }
    </script>



<?php
}





?>




 











  





<!-- Bootstrap core JavaScript -->
<script src="https://demo.phpjabbers.com/free-web-templates/job-website-template-138/vendor/jquery/jquery.min.js"></script>


<!-- Additional Scripts -->
<script src="https://demo.phpjabbers.com/free-web-templates/job-website-template-138/assets/js/custom.js"></script>
</body>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>


<!-- <link rel="stylesheet" href="assets/css/formstyle.css"> -->




<!-- when profile drop down working link  -->
<!-- jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<!-- Bootstrap JS -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->

<!-- Mirrored from demo.phpjabbers.com/free-web-templates/job-website-template-138/job-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 May 2024 08:12:56 GMT -->







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



<?php





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
                echo '<script>window.location.href = "company_data?id=' . $com_id . '";</script>';
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