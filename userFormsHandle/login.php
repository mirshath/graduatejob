<?php
session_start();
include "../Database/connection.php";
include "../includes/header.php"; // Assuming header.php contains necessary HTML header content

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
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
                echo '<script>alertify.error("Verify your Email Please");</script>';
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
                        echo '<script>window.location.href = "../index";</script>';
                        exit();
                    } else {
                        // Handle other user types if needed
                    }
                } else {
                    // Password is incorrect
                    echo '<script>alertify.error("Please check your credentials.");</script>';
                }
            }
        } else {
            // No user found with that email address
            echo '<script>alertify.error("No user found with that email address!");</script>';
        }

        $stmt->close();
    } else {
        // Handle SQL preparation error
        echo '<script>alertify.error("An error occurred. Please try again later.");</script>';
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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
   


	<!--===============================================================================================-->
</head>


<style>
	a {
		text-decoration: none !important;
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
				<form class="login100-form validate-form" action="" method="post" autocomplete="">

					<div class="d-flex justify-content-center">
						<span class="imgbox">
							<img src="../images/Graduatejob.lk Logo.png" alt="" width="350px">
						</span>
					</div>

					<span class="login100-form-title p-b-43 LogReg-title">
						Job Seeker Login
					</span>


					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" placeholder="Email *" type="email" name="email">
						<span class="focus-input100"></span>
						<!-- <span class="label-input100">Email</span> -->
					</div>


					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" placeholder="Password *" type="password" name="password" id="password">
						<span class="focus-input100"></span>
						<!-- <span class="label-input100">Password</span> -->
					</div>



					<div class="text-right p-t-20 p-b-20">
						<a href="reset_password_request.php" class="">
							Forgot Password?
						</a>
					</div>




					<div class="container-login100-form-btn mt-3">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>

					<!-- <div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							or sigs
					</div> -->

					<div class="login100-form-social flex-c-m p-t-46 p-b-20">
						<span class="txt2">Dont't you have an Account ? </span><a href="register.php">
							<!-- <i class="fa fa-user" aria-hidden="true"></i> -->
							&nbsp; Sign Up

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