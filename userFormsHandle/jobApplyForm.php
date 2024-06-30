<?php
session_start(); // Ensure session is started

include "../Database/connection.php";
// require "../includes/header.php";

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Job Seeker Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

</head>
<style>
   
    .invalid-feedback {
        display: none;
        width: 100%;
        margin-top: -1.75rem;
        font-size: 80%;
        color: #dc3545;
        margin-left: 25px;
    }

    .imgbox {
        display: flex;
        justify-content: center;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .LogReg-title {
        color: #999966 !important;
        font-weight: bold;
        font-size: 20px;

    }
</style>

<body style="background-color: #666666;">

    <div class="">
        <div class="">
            <div class="wrap-login100">
                <form class="login100-form validate-form" action="" method="post" id="registrationForm">
                    <div class="d-flex justify-content-center">
                        <span class="imgbox">
                            <img src="../images/Graduatejob.lk Logo.png" alt="" width="350px">
                        </span>
                    </div>

                    <span class="login100-form-title p-b-43 LogReg-title">
                        Job Apply Form
                    </span>
                    <div class="">
                        <input type="hidden" name="userType" value="jobSeeker">


                        <div class="wrap-input100 validate-input  mb-3 " data-validate="Valid Name is Required">
                            <input class="input100" placeholder="Name *" type="text" id="firstname"
                                name="firstname" required>
                            <span class="focus-input100"></span>
                            <!-- <span class="label-input100">First Name</span> -->
                            <div class="invalid-feedback" id="firstnameError"></div>
                        </div>

                        <div class="wrap-input100 validate-input  mb-3 "
                            data-validate="Valid email is required: ex@abc.xyz">
                            <input class="input100" type="email" placeholder="Email *" id="email" name="email" required>
                            <span class="focus-input100"></span>
                            <!-- <span class="label-input100">Email</span> -->
                            <div class="invalid-feedback" id="emailError"></div>
                        </div>
                        <div class="wrap-input100 validate-input  mb-3 "
                            data-validate="Valid email is required: ex@abc.xyz">
                            <input class="input100" type="email" placeholder="Phone *" id="email" name="email" required>
                            <span class="focus-input100"></span>
                            <!-- <span class="label-input100">Email</span> -->
                            <div class="invalid-feedback" id="emailError"></div>
                        </div>
                        <div class="wrap-input100 validate-input  mb-3 "
                            data-validate="Valid email is required: ex@abc.xyz">
                            <input class="input100" type="email" placeholder="Resumes *" id="email" name="email" required>
                            <span class="focus-input100"></span>
                            <!-- <span class="label-input100">Email</span> -->
                            <div class="invalid-feedback" id="emailError"></div>
                        </div>


                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn" type="submit">Apply</button>
                        </div>

                      
                       
                    </div>
                </form>

                <div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div>
            </div>
        </div>
    </div>

    <script src="js/main.js"></script>
</body>

</html>



