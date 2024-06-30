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
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css"> -->
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css"> -->
	<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css"> -->
	<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css"> -->
	<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css"> -->
	<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css"> -->
	<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css"> -->
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>

<body style="background-color: #666666;">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="" method="post" id="registrationForm">
					<span class="login100-form-title p-b-43">
						Register to Login
					</span>


					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" id="firstname" name="firstname">
						<span class="focus-input100"></span>
						<span class="label-input100">First Name</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" id="lastname" name="lastname">
						<span class="focus-input100"></span>
						<span class="label-input100">Last Name</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" 
						id="email" name="email">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>


					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password"
						id="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password"
						id="confirm_password" name="confirm_password">
						<span class="focus-input100"></span>
						<span class="label-input100">Confirm Password</span>
					</div>

					


					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Register
						</button>
					</div>

					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							or sign up using
						</span>
					</div>

					<div class="login100-form-social flex-c-m">
						<a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
							<i class="fa fa-facebook-f" aria-hidden="true"></i>
						</a>

						<a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('images/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>





	<!--===============================================================================================-->
	<!-- <script src="vendor/jquery/jquery-3.2.1.min.js"></script> -->
	<!--===============================================================================================-->
	<!-- <script src="vendor/animsition/js/animsition.min.js"></script> -->
	<!--===============================================================================================-->
	<!-- <script src="vendor/bootstrap/js/popper.js"></script> -->
	<!-- <script src="vendor/bootstrap/js/bootstrap.min.js"></script> -->
	<!--===============================================================================================-->
	<!-- <script src="vendor/select2/select2.min.js"></script> -->
	<!--===============================================================================================-->
	<!-- <script src="vendor/daterangepicker/moment.min.js"></script> -->
	<!-- <script src="vendor/daterangepicker/daterangepicker.js"></script> -->
	<!--===============================================================================================-->
	<!-- <script src="vendor/countdowntime/countdowntime.js"></script> -->
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>




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
