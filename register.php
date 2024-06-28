<?php

session_start(); // Ensure session is started

include "Database/connection.php";
require "includes/header.php";

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate and sanitize user input
    $firstName = htmlspecialchars($_POST["firstname"]);
    $lastName = htmlspecialchars($_POST["lastname"]);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];
    $userType = $_POST["userType"];

    // Check if email already exists in the database
    $sql_check_email = "SELECT * FROM userregister WHERE email = ?";
    $stmt_check_email = $conn->prepare($sql_check_email);
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $result_check_email = $stmt_check_email->get_result();

    if ($result_check_email->num_rows > 0) {
        // Email already registered
        echo '
        <script>
            alertify.error("Email already registered. Try a new email.");
            setTimeout(function() {
                window.location.href = "register";
            }, 2000); // Redirect after 2 seconds
        </script>';
        exit();
    }

    // If email is not already registered, proceed with registration

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL statement using prepared statements
    $sql_insert_user = "INSERT INTO userregister (firstname, lastname, email, password, usertype) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert_user = $conn->prepare($sql_insert_user);
    $stmt_insert_user->bind_param("sssss", $firstName, $lastName, $email, $hashedPassword, $userType);

    // Execute the statement
    if ($stmt_insert_user->execute()) {
        // Registration successful

        
        
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

    
        //Recipients
        $company_name = "GRADUATEJOB.LK";
        $mail->setFrom('noreply@graduatejob.lk', $company_name);
        $mail->addAddress($email, $firstName);
        // $mail->addCC('mirmirsha123@gmail.com'); // Add CC recipient


        // Content
        $mail->isHTML(true);
        $mail->Subject = 'GRADUATE Job Application Confirmation';
        $mail->Body = "Hello $firstName,<br><br> Thank you for sending your CV for the position of XYZ . <br><br> 
            Your application is under review. We will get back to you soon. <br><br> 
            The company will contact you for further details if needed or if you are shortlisted <br><br> 
            Please continue to check the available jobs we have using the following link ....... <br><br> 
            You can view / edit your account details any time by logging in to your account <br><br> 
            If you need help, you can find it here: .............  <br><br> 
            Best regards,<br>$company_name";

        $mail->AltBody = "Hello $firstName,\n\n You have successfully applied for the job. Your application is under review. We will get back to you soon.\n\n Best regards,\n $company_name";

        $mail->send();
        $_SESSION['message'] = "You have applied for a job. A confirmation email has been sent.";
      } catch (Exception $e) {
        $_SESSION['message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }

      // Redirect to the same page to show the message and refresh the page
    //   echo '<script>window.location.href = "job-details.php?id=' . $applied_job_id . '";</script>';
      echo '<script>window.location.href = "userLoginForm";</script>';
      exit();
    } else {
        // Registration failed
        echo "Error: " . $stmt_insert_user->error;
    }

    // Close statements
    $stmt_check_email->close();
    $stmt_insert_user->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form with Validation</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




    <!-- Include the AlertifyJS CSS and JS files in your HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

</head>


<style>
    .form-container {
        background: radial-gradient(circle, rgba(9, 9, 121, 1) 10%, rgba(2, 2, 61, 1) 100%);
        font-family: 'Roboto', sans-serif;
        font-size: 0;
        padding: 0 15px;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    .form-container .form-icon {
        color: #fff;
        font-size: 13px;
        text-align: center;
        text-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        width: 50%;
        padding: 177px 0;
        vertical-align: top;
        display: inline-block;
    }

    .form-container .form-icon i {
        font-size: 124px;
        margin: 0 0 15px;
        display: block;
    }

    .form-container .form-icon .signup a {
        color: #fff;
        text-transform: capitalize;
        transition: all 0.3s ease;
    }

    .form-container .form-icon .signup a:hover {
        text-decoration: underline;
    }

    .form-container .form-horizontal {
        background: rgba(255, 255, 255, 0.99);
        width: 50%;
        padding: 60px 30px;
        margin: -20px 0;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        display: inline-block;
    }

    .form-container .title {
        color: #454545;
        font-size: 23px;
        font-weight: 900;
        text-align: center;
        text-transform: capitalize;
        letter-spacing: 0.5px;
        margin: 0 0 30px 0;
    }

    .form-horizontal .form-group {
        background-color: rgba(255, 255, 255, 0.15);
        margin: 0 0 15px;
        border: 1px solid #b5b5b5;
        border-radius: 20px;
        position: relative;
        /* Added for relative positioning */
    }

    .form-horizontal .input-icon {
        color: #b5b5b5;
        font-size: 15px;
        text-align: center;
        line-height: 38px;
        height: 35px;
        width: 40px;
        vertical-align: top;
        display: inline-block;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        left: 10px;
    }

    .form-horizontal .form-control {
        color: #b5b5b5;
        background-color: transparent;
        font-size: 14px;
        letter-spacing: 1px;
        width: calc(100% - 5px);
        height: 33px;
        padding: 2px 10px 0 50px;
        /* Adjusted padding */
        box-shadow: none;
        border: none;
        border-radius: 0;
        display: inline-block;
        transition: all 0.3s;
        position: relative;
        /* Added for relative positioning */
    }

    .form-horizontal .form-control:focus {
        box-shadow: none;
        border: none;
    }

    .form-horizontal .form-control::placeholder {
        color: #b5b5b5;
        font-size: 13px;
        text-transform: capitalize;
    }

    .form-horizontal .btn {
        color: rgba(255, 255, 255, 0.8);
        background: #E9374C;
        font-size: 15px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
        width: 100%;
        margin: 0 0 10px 0;
        border: none;
        border-radius: 20px;
        transition: all 0.3s ease;
    }

    .form-horizontal .btn:hover,
    .form-horizontal .btn:focus {
        color: #fff;
        background-color: #D31128;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
    }

    .form-horizontal .forgot-pass {
        font-size: 12px;
        text-align: center;
        display: block;
    }

    .form-horizontal .forgot-pass a {
        color: #999;
        transition: all 0.3s ease;
    }

    .form-horizontal .forgot-pass a:hover {
        color: #777;
        text-decoration: underline;
    }

    .invalid-feedback {
        color: red;
        font-size: 15px;
        margin-left: 15px;
        position: absolute;
        bottom: -26px;
    }

    .valid-feedback {
        color: green;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 10px;
    }

    @media only screen and (max-width:576px) {
        .form-container {
            padding-bottom: 15px;
        }

        .form-container .form-icon {
            width: 100%;
            padding: 20px 0;
        }

        .form-container .form-horizontal {
            width: 100%;
            margin: 0;
        }
    }
</style>


<div class="container-fluid form-bg d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="col-lg-6 col-md-8">
        <div class="form-container">
            <div class="form-icon">
                <i class="fa fa-user-circle"></i>
                <span class="signup"><a href="userLoginForm">Already have an account? Sign in</a></span>
            </div>
            <form class="form-horizontal needs-validation" action="" method="post" id="registrationForm" novalidate>
                <h3 class="chakra-petch-bold text-center mb-4 pb-4">Register</h3>
                <div class="form-group p-1" style="margin-bottom: 30px;">
                    <span class="input-icon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required>
                    <div class="invalid-feedback" id="firstnameError"></div>
                    <div class="valid-feedback">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="form-group p-1" style="margin-bottom: 30px;">
                    <span class="input-icon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" required>
                    <div class="invalid-feedback" id="lastnameError"></div>
                    <div class="valid-feedback">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="form-group p-1" style="margin-bottom: 30px;">
                    <span class="input-icon"><i class="fa fa-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                    <div class="invalid-feedback" id="emailError"></div>
                    <div class="valid-feedback">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="form-group p-1" style="margin-bottom: 30px;">
                    <span class="input-icon"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <div class="invalid-feedback" id="passwordError"></div>
                    <div class="valid-feedback">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="form-group p-1" style="margin-bottom: 30px;">
                    <span class="input-icon"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                    <div class="invalid-feedback" id="confirmPasswordError"></div>
                    <div class="valid-feedback">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>

                <!-- <div class="form-group p-1" style="margin-bottom: 30px;">
                    <span class="input-icon"><i class="fa fa-graduation-cap"></i></span>
                    <select class="form-control" id="education_qualification" name="education_qualification" required>
                        <option value="">Select Education Qualification</option>
                        <option value="high_school">High School</option>
                        <option value="college">College</option>
                        <option value="undergraduate">Undergraduate</option>
                        <option value="postgraduate">Postgraduate</option>
                    </select>
                    <div class="invalid-feedback" id="educationQualificationError"></div>
                    <div class="valid-feedback">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div> -->

                <!-- <div class="form-group p-1" style="margin-bottom: 30px;">
                    <span class="input-icon"><i class="fa fa-bullseye"></i></span>
                    <select class="form-control" id="interested_field" name="interested_field" required>
                        <option value="">Select Interested Field</option>
                        <option value="information_technology">Information Technology</option>
                        <option value="engineering">Engineering</option>
                        <option value="finance">Finance</option>
                        <option value="marketing">Marketing</option>
                        <option value="human_resources">Human Resources</option>
                    </select>
                    <div class="invalid-feedback" id="interestedFieldError"></div>
                    <div class="valid-feedback">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div> -->

                <!-- <div class="form-group p-1" style="margin-bottom: 30px;">
                    <span class="input-icon"><i class="fa fa-certificate"></i></span>
                    <select class="form-control" id="professional_qualification" name="professional_qualification" required>
                        <option value="">Select Professional Qualification</option>
                        <option value="certified_public_accountant">Certified Public Accountant (CPA)</option>
                        <option value="project_management_professional">Project Management Professional (PMP)</option>
                        <option value="chartered_financial_analyst">Chartered Financial Analyst (CFA)</option>
                        <option value="certified_information_systems_security_professional">Certified Information Systems Security Professional (CISSP)</option>
                    </select>
                    <div class="invalid-feedback" id="professionalQualificationError"></div>
                    <div class="valid-feedback">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div> -->



                <input type="hidden" name="userType" value="jobSeeker">
                <button type="submit" class="btn signin p-2 fw-bold" id="registerBtn">Register</button>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        function validateEmail() {
            var email = $('#email').val();
            var isValid = true;

            // Reset email error messages and remove invalid classes
            $('#emailError').text('');
            $('#email').removeClass('is-invalid');
            $('#email').removeClass('is-valid');

            // Email validation
            if (email.trim() === '') {
                $('#emailError').text('Email is required.');
                $('#email').addClass('is-invalid');
                isValid = false;
            } else {
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    $('#emailError').text('Invalid email format.');
                    $('#email').addClass('is-invalid');
                    isValid = false;
                } else {
                    // Check email availability asynchronously
                    $.ajax({
                        url: 'check-email.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            email: email
                        },
                        success: function(response) {
                            if (response.status === 'taken') {
                                $('#emailError').text('Email is already taken.');
                                $('#email').addClass('is-invalid');
                                $('#registerBtn').prop('disabled', true);
                            } else {
                                $('#email').addClass('is-valid');
                                $('#registerBtn').prop('disabled', false);
                            }
                        },
                        error: function() {
                            $('#emailError').text('Error checking email availability.');
                            $('#email').addClass('is-invalid');
                            $('#registerBtn').prop('disabled', true);
                        }
                    });
                }
            }

            return isValid;
        }

        $('#email').on('input', function() {
            validateEmail();
        });

        $('#registrationForm').submit(function(event) {
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var password = $('#password').val();
            var confirmPassword = $('#confirm_password').val();
            var isValid = true;

            // Reset all error messages and remove invalid classes
            $('.invalid-feedback').text('');
            $('.valid-feedback').html('<i class="fas fa-check-circle"></i>');
            $('.form-control').removeClass('is-invalid');
            $('.form-control').removeClass('is-valid');

            // First Name validation
            if (firstname.trim() === '') {
                $('#firstnameError').text('First Name is required.');
                $('#firstname').addClass('is-invalid');
                isValid = false;
            } else {
                $('#firstname').addClass('is-valid');
            }

            // Last Name validation
            if (lastname.trim() === '') {
                $('#lastnameError').text('Last Name is required.');
                $('#lastname').addClass('is-invalid');
                isValid = false;
            } else {
                $('#lastname').addClass('is-valid');
            }

            // Email validation
            if (!validateEmail()) {
                isValid = false;
            }

            // Password validation
            if (password.trim() === '') {
                $('#passwordError').text('Password is required.');
                $('#password').addClass('is-invalid');
                isValid = false;
            } else if (password.length < 6) {
                $('#passwordError').text('Password must be at least 6 characters long.');
                $('#password').addClass('is-invalid');
                isValid = false;
            } else if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
                $('#passwordError').text('Password must contain at least 1 special character.');
                $('#password').addClass('is-invalid');
                isValid = false;
            } else {
                $('#password').addClass('is-valid');
            }

            // Confirm Password validation
            if (confirmPassword.trim() === '') {
                $('#confirmPasswordError').text('Please confirm your password.');
                $('#confirm_password').addClass('is-invalid');
                isValid = false;
            } else if (password !== confirmPassword) {
                $('#confirmPasswordError').text('Passwords do not match.');
                $('#confirm_password').addClass('is-invalid');
                isValid = false;
            } else {
                $('#confirm_password').addClass('is-valid');
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
                event.stopPropagation();
            }

            $('#registrationForm').addClass('was-validated');
        });
    });
</script>