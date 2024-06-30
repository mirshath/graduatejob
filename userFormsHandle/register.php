<?php
session_start(); // Ensure session is started

include "../Database/connection.php";
// require "../includes/header.php";

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

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
                window.location.href = "register.php";
            }, 2000); // Redirect after 2 seconds
        </script>';
        exit();
    }

    // If email is not already registered, proceed with registration

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Generate token
    $token = bin2hex(random_bytes(16));

    // Prepare SQL statement using prepared statements
    $sql_insert_user = "INSERT INTO userregister (firstname, lastname, email, password, usertype, token) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_insert_user = $conn->prepare($sql_insert_user);
    $stmt_insert_user->bind_param("ssssss", $firstName, $lastName, $email, $hashedPassword, $userType, $token);

    // Execute the statement
    if ($stmt_insert_user->execute()) {
        // Registration successful

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'mail.graduatejob.lk';
            $mail->SMTPAuth = true;
            $mail->Username = 'noreply@graduatejob.lk';
            $mail->Password = 'Hasni@2024'; // app password here
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $company_name = "GRADUATEJOB.LK";
            $mail->setFrom('noreply@graduatejob.lk', $company_name);
            $mail->addAddress($email, $firstName);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Please Verify the Details';
            $mail->Body = "Hello $firstName,<br><br>
                          Please click the link below to verify your email:<br>
                          <a href='http://localhost/graduatejob/user_submit_form_before_loggin.php?token=$token'>Verify the Datas</a><br><br>
                          Best regards,<br>Your Company Name";

            $mail->AltBody = "Hello $firstName,\n\n Please click the link below to verify your email:\n http://localhost/graduatejob/user_submit_form_before_loggin.php?token=$token \n\n Best regards,\n Your Company Name";

            $mail->send();
            $_SESSION['message'] = "Verify Your Email Please.";
        } catch (Exception $e) {
            $_SESSION['message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        // Redirect to the login form after registration
        echo '<script>window.location.href = "login.php";</script>';
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
    /* .invalid-feedback {
        display: none;
        width: 100%;
        margin-top: .25rem;
        font-size: 80%;
        color: #dc3545;
        margin-left: 25px;
    } */

    .invalid-feedback {
    display: none;
    width: 100%;
    margin-top: -1.75rem;
    font-size: 80%;
    color: #dc3545;
    margin-left: 25px;
}
.imgbox{
		display: flex;
		justify-content: center;
		margin-top: 10px;
		margin-bottom: 20px;
	}
.LogReg-title{
		color: #999966 !important;
		font-weight: bold;
		font-size:20px;
		
	}
</style>

<body style="background-color: #666666;">

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" action="" method="post" id="registrationForm">
                <div class="d-flex justify-content-center">
						<span class="imgbox">
							<img src="../images/Graduatejob.lk Logo.png" alt="" width="350px">
						</span>
					</div>

					<span class="login100-form-title p-b-43 LogReg-title">
						Job Seeker Register
					</span>
                    <div class="">
                    <input type="hidden" name="userType" value="jobSeeker">


                        <div class="wrap-input100 validate-input  mb-3 " data-validate="Valid Name is Required">
                            <input class="input100" placeholder="First Name *" type="text" id="firstname" name="firstname"
                                required>
                            <span class="focus-input100"></span>
                            <!-- <span class="label-input100">First Name</span> -->
                            <div class="invalid-feedback" id="firstnameError"></div>
                        </div>
    
                        <div class="wrap-input100 validate-input  mb-3" data-validate="Valid Name is Required">
                            <input class="input100" type="text" placeholder="Last Name *" id="lastname" name="lastname"
                                required>
                            <span class="focus-input100"></span>
                            <!-- <span class="label-input100">Last Name</span> -->
                            <div class="invalid-feedback" id="lastnameError"></div>
                        </div>
    
                        <div class="wrap-input100 validate-input  mb-3 "
                            data-validate="Valid email is required: ex@abc.xyz">
                            <input class="input100" type="email" placeholder="Email *" id="email" name="email" required>
                            <span class="focus-input100"></span>
                            <!-- <span class="label-input100">Email</span> -->
                            <div class="invalid-feedback" id="emailError"></div>
                        </div>
    
                        <div class="wrap-input100 validate-input  mb-3" data-validate="Password is required">
                            <input class="input100" type="password" placeholder="Password *" id="password" name="password"
                                required>
                            <span class="focus-input100"></span>
                            <!-- <span class="label-input100">Password</span> -->
                            <div class="invalid-feedback" id="passwordError"></div>
                        </div>
    
                        <div class="wrap-input100 validate-input  mb-3" data-validate="Password is required">
                            <input class="input100" type="password" placeholder="Confirm Password *" id="confirm_password"
                                name="confirm_password" required>
                            <span class="focus-input100"></span>
                            <!-- <span class="label-input100">Confirm Password</span> -->
                            <div class="invalid-feedback" id="confirmPasswordError"></div>
                        </div>
    
                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn" type="submit">Register</button>
                        </div>
    
                        <!-- <div class="text-center p-t-46 p-b-20">
                            <span class="txt2">or sign up using</span>
                        </div> -->
    
                        <div class="login100-form-social flex-c-m">
                            <div class="login100-form-social flex-c-m p-t-46 p-b-20">
                                <span class="txt2">Have you an Account ? </span><a href="login.php">
                                    <!-- <i class="fa fa-user" aria-hidden="true"></i> -->
                                    &nbsp; Sign In
    
                                </a>
    
                            </div>
                            <!-- <a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a> -->
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




<script>


    $(document).ready(function () {
        $('#confirm_password').on('input', function () {
            var password = $('#password').val();
            var confirmPassword = $(this).val();

            // Reset previous error messages and classes
            $('#confirmPasswordError').text('');
            $('#confirm_password').removeClass('is-invalid');
            $('#confirm_password').removeClass('is-valid');

            // Check if passwords match
            if (password !== confirmPassword) {
                $('#confirmPasswordError').text('Passwords do not match.');
                $('#confirm_password').addClass('is-invalid');
            } else {
                $('#confirm_password').addClass('is-valid');
            }
        });
    });


    $(document).ready(function () {
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
                        url: '../check-email.php',
                        type: 'POST',
                        dataType: 'json',
                        data: { email: email },
                        success: function (response) {
                            if (response.status === 'taken') {
                                $('#emailError').text('Email is already taken.');
                                $('#email').addClass('is-invalid');
                                $('#registrationForm button[type="submit"]').prop('disabled', true);
                            } else {
                                $('#email').addClass('is-valid');
                                $('#registrationForm button[type="submit"]').prop('disabled', false);
                            }
                        },
                        error: function () {
                            $('#emailError').text('Error checking email availability.');
                            $('#email').addClass('is-invalid');
                            $('#registrationForm button[type="submit"]').prop('disabled', true);
                        }
                    });
                }
            }

            return isValid;
        }

        $('#email').on('input', function () {
            validateEmail();
        });
        $('#registrationForm').submit(function (event) {
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var password = $('#password').val();
            var confirmPassword = $('#confirm_password').val();
            var isValid = true;

            // Reset all error messages and remove invalid classes
            $('.invalid-feedback').text('');
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