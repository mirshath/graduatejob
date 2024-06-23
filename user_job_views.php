<?php
session_start();
require "includes/header.php";
require "userDashboards/includes/head.php";
require "Database/connection.php";

// Redirect to index.php if user is not logged in
if (!isset($_SESSION['user_id'])) {
    // header("location: index.php");
    echo '<script>window.location.href = "index";</script>';
    exit();
}

require "includes/navbar.php";


// $user_id = $_SESSION['user_id'];


if (isset($_GET['id'])) {

    $jb_id = $_GET['id'];


    // Fetch user data
    $sql = "SELECT * FROM jobs WHERE id = $jb_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_array($result);

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login Page</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
            <link rel="stylesheet" href="assets/css/formstyle.css">


        <body class="body_backgorund ">

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
                                <h2 class="chakra-petch-bold"><?= $row['job_title']; ?></h2>
                                <h4 class="chakra-petch-bold"><?= $row['company_name']; ?></h4>
                                <h4 class="chakra-petch-bold"><?= $row['location']; ?></h4>

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
                                <img src="Admin/uploads/<?= $row["company_logo"]; ?>" alt="" class="img-fluid shadow" style="max-width: 200px; border-radius: 20px;">
                            </div>

                            <div class="card-body">
                                <!-- Card body content -->
                                
                                <h4 class="text-muted mb-2 text-center chakra-petch-bold"><b><?= $row['job_title']; ?></b></h4>
                                <h6 class="text-muted mb-2 text-center">Presented by : <b><?= $row['company_name']; ?></b></h6>
                                <h6 class="text-center text-muted">
                                    <i class="fas fa-map-marker-alt" style="font-size: 15px;"> &nbsp; &nbsp; <?= $row['location'] ?></i>

                                </h6>
                                <h6 class="text-center text-muted">
                                    <i class="fas fa-calendar-alt" style="font-size: 15px;"></i>&nbsp;<?= $row['application_deadline'] ?>
                                </h6>
                                <h6 class="text-center text-muted">
                                    <i class="fas fa-briefcase" style="font-size: 15px;"></i>
                                    &nbsp; &nbsp; <?= $row['employment_type'] ?>
                                </h6>
                                <hr>


                                <div class="p-3">
                                <span class="badge badge-success text-center"> You have applied  </span>

                                    <h6><?= $row['additional_info'] ?></h6>
                                </div>

                                <div class="p-3 ">
                                    <table>
                                        <tr>
                                            <td>Education Level</td>
                                            <td> &nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;</td>
                                            <td><?= $row['education_level'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Skills</td>
                                            <td> &nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;</td>
                                            <td><?= $row['skills_required'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Experience Level</td>
                                            <td> &nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;</td>
                                            <td><?= $row['experience_level'] ?></td>
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

                    <div class="col-md-8 order-md-1 order-2 ">
                        <h3 class="text-muted mb-4"><b><?= $row['job_title']; ?></b></h3>
                        <h6 class="text-muted mb-4">Presented by : <b><?= $row['company_name']; ?></b></h6>
                        <p class="text-muted" style="font-size: 17px; line-height: 35px; text-align: justify;">
                            <?= $row['job_description']; ?>
                        </p>
                    </div>
                </div>

            </div>


    <?php
    } else {
        echo "No user found ";
        exit();
    }
}














    ?>






    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>