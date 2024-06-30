<?php
session_start();
include "../Database/connection.php";
include "../includes/header.php"; // Assuming header.php contains necessary HTML header content


// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $stmt = $conn->prepare('SELECT * FROM userregister WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $token = bin2hex(random_bytes(50));

        $userData = mysqli_fetch_assoc($result);
        $userId = $userData['id'];

        // Store token in the password_resets table
        $stmt = $conn->prepare('INSERT INTO password_resets (user_id, email, token) VALUES (?, ?, ?)');
        $stmt->bind_param('iss', $userId, $email, $token);
        $stmt->execute();




        // Send reset email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            // $mail->Host = 'mail.graduatejob.lk';
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            $owner_mail = 'yournumplz@gmail.com';
            $mail->Username = $owner_mail;
            $mail->Password = 'uzsihqeugnntzwke';

            // $mail->Username = 'noreply@graduatejob.lk';
            // $mail->Password = 'Hasni@2024';

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $reset_password_here = "Reset_password";
            $mail->setFrom($owner_mail, $reset_password_here);
            $mail->addAddress($email);


            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body = 'Please click the link to reset your password: <a href="http://localhost/graduatejob/reset_password.php?token=' . $token . '">Reset Password</a>';

            $mail->send();
            // echo 'Password reset link has been sent to your email.';
            $_SESSION['message'] = "Password reset link has been sent to your email.";
			echo '<script>
            window.location.href = "reset_password_request.php";
          </script>';
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        // echo 'Email not found.';
        $_SESSION['message'] = "Email not found.";
    }
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
	<link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
	<link rel="stylesheet" type="text/css"
		href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>



	<!--===============================================================================================-->
</head>


<style>
	a {
		text-decoration: none !important;
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

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="" method="post" autocomplete="">

					<div class="d-flex justify-content-center">
						<span class="imgbox">
							<img src="../images/Graduatejob.lk Logo.png" alt="" width="350px">
						</span>
					</div>

					<span class="login100-form-title p-b-43 LogReg-title">
						Reset Password
					</span>


					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="email" id="email" placeholder="Enter your email here please *">
						<span class="focus-input100"></span>
						<!-- <span class="label-input100">Email</span> -->
					</div>


					



					<div class="container-login100-form-btn  p-t-20 p-b-20">
						<button class="login100-form-btn" type="submit">
							Send me the link
						</button>
					</div>

					<!-- <div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							or sigs
					</div> -->

					<div class="login100-form-social flex-c-m p-t-46 p-b-20">
						<span class="txt2">Remember the password ? </span><a href="login.php">
							<!-- <i class="fa fa-user" aria-hidden="true"></i> -->
							&nbsp; Sign In

						</a>

					</div>
					<!-- <div class="login100-form-social flex-c-m">
						Dont't you have an Account ? <a href="register.php" class="login100-form-social-item flex-c-m bg1 m-r-5">
							<i class="fa fa-user" aria-hidden="true"></i>
						</a>Register
						
					</div> -->
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
	<!-- <script src="js/main.js"></script> -->

</body>

</html>