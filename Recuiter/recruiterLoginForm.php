<?php
session_start();
include "../Database/connection.php";
include "include/header.php";


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login_btn'])) {
        $login_email = $_POST["login_email"];
        $login_password = $_POST["login_password"];

        if ($login_email == "" || $login_password == "") {
            $_SESSION['message'] = "All fields are required";
            echo '<script>window.location.href = "recruiterLoginForm";</script>';

            exit();
        } else {
            // SQL query to check if the user exists
            $sql = "SELECT * FROM userregister WHERE email = ? AND usertype='recruiter'";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $login_email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Fetch the user's data
                $user = $result->fetch_assoc();

                // Verify the password
                if (password_verify($login_password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['company_name'] = $user['company_name'];
                    $_SESSION['user_type'] = $user['usertype'];

                    $_SESSION['message'] = "Successfully logged in ";

                    if ($user['usertype'] == 'recruiter') {

                        echo '<script>window.location.href = "index";</script>';
                        exit();
                    }
                } else {
                    $_SESSION['message'] = "Please check your credentials.";
                }
            } else {
                $_SESSION['message'] = "No user found with that email address!";
            }

            $stmt->close();
        }
    } else if (isset($_POST['register_btn'])) {

        // Validate and sanitize user input
        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
        $userType = htmlspecialchars($_POST["usertype"]);
        $companyName = htmlspecialchars($_POST["companyName"]);

        if (
            $email == "" || $password == "" || $confirmPassword == "" || $companyName == ""
        ) {
            $_SESSION["message"] = "All fields are required ";
            ?>

                <script>
                    alertify.error("All fields are required  !!");
                </script>
                <?php
                echo '<script>window.location.href = "recruiterLoginForm";</script>';
        } else {
            // Validate email
            // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //     $_SESSION["message"] = "Invalid email format.";
            //     echo '<script>window.location.href = "recruiterLoginForm";</script>';
            //     exit();
            // }

            // Validate password strength
            if (strlen($password) < 6) {
                // $_SESSION["message"] = "Password must be at least 6 characters long.";
                // echo '<script>window.location.href = "recruiterLoginForm";</script>';
                // exit();
            }

            // Check if passwords match
            if ($password !== $confirmPassword) {
                // $_SESSION["message"] = "Passwords do not match!";
                ?>

                    <script>
                        alertify.error("Passwords do not match !!");
                    </script>
                    <?php
                    echo '<script>window.location.href = "recruiterLoginForm";</script>';

                    exit();
            }

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Prepare SQL statement using prepared statements
            $sql = "INSERT INTO userregister (company_name, email, password, usertype) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ssss", $companyName, $email, $hashedPassword, $userType);

                // Execute the statement
                if ($stmt->execute()) {
                    $_SESSION['message'] = "Successfully registered";
                    echo '<script>window.location.href = "recruiterLoginForm";</script>';
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Close statement
                $stmt->close();
            } else {
                echo "Error preparing statement: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/formstyle.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">





    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/themes/default.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>



    <style>
        /* @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900'); */

        /* Autofill styling for WebKit-based browsers (e.g., Chrome, Safari) */
        input:-webkit-autofill,
        textarea:-webkit-autofill,
        select:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 1000px white inset !important;
            -webkit-text-fill-color: inherit !important;
            appearance: none !important;
            background-color: inherit !important;
            color: inherit !important;
        }



        /* Additional styles for input fields */
        input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            font-size: 15px;
            line-height: 1.7;
            color: #c4c3ca;
            background-color: #1f2029;
            overflow-x: hidden;
        }

        a {
            cursor: pointer;
            transition: all 200ms linear;
        }

        a:hover {
            text-decoration: none;
        }

        .link {
            color: #c4c3ca;
        }

        .link:hover {
            color: #ffeba7;
        }

        p {
            font-weight: 500;
            font-size: 14px;
            line-height: 1.7;
        }

        h4 {
            font-weight: 600;
        }

        h6 span {
            padding: 0 20px;
            text-transform: uppercase;
            font-weight: 700;
        }

        .section {
            position: relative;
            width: 100%;
            display: block;
        }

        .full-height {
            min-height: 100vh;
        }

        [type="checkbox"]:checked,
        [type="checkbox"]:not(:checked) {
            position: absolute;
            left: -9999px;
        }

        .checkbox:checked+label,
        .checkbox:not(:checked)+label {
            position: relative;
            display: block;
            text-align: center;
            width: 60px;
            height: 16px;
            border-radius: 8px;
            padding: 0;
            margin: 10px auto;
            cursor: pointer;
            background-color: #ffeba7;
        }

        .checkbox:checked+label:before,
        .checkbox:not(:checked)+label:before {
            position: absolute;
            display: block;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            color: #ffeba7;
            background-color: #102770;
            font-family: 'unicons';
            content: '\eb4f';
            z-index: 20;
            top: -10px;
            left: -10px;
            line-height: 36px;
            text-align: center;
            font-size: 24px;
            transition: all 0.5s ease;
        }

        .checkbox:checked+label:before {
            transform: translateX(44px) rotate(-270deg);
        }


        .card-3d-wrap {
            position: relative;
            width: 440px;
            max-width: 100%;
            height: 400px;
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
            perspective: 800px;
            margin-top: 60px;
        }

        .card-3d-wrapper {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
            transition: all 600ms ease-out;
        }

        .card-front,
        .card-back {
            width: 100%;
            height: 100%;
            background-color: #2a2b38;
            background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/1462889/pat.svg');
            background-position: bottom center;
            background-repeat: no-repeat;
            background-size: 300%;
            position: absolute;
            border-radius: 6px;
            left: 0;
            top: 0;
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
            -webkit-backface-visibility: hidden;
            -moz-backface-visibility: hidden;
            -o-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .card-back {
            transform: rotateY(180deg);
        }

        .checkbox:checked~.card-3d-wrap .card-3d-wrapper {
            transform: rotateY(180deg);
        }

        .center-wrap {
            position: absolute;
            width: 100%;
            padding: 0 35px;
            top: 50%;
            left: 0;
            transform: translate3d(0, -50%, 35px) perspective(100px);
            z-index: 20;
            display: block;
        }


        .form-group {
            position: relative;
            display: block;
            margin: 0;
            padding: 0;
        }

        .form-style {
            padding: 13px 20px;
            padding-left: 55px;
            height: 48px;
            width: 100%;
            font-weight: 500;
            border-radius: 4px;
            font-size: 14px;
            line-height: 22px;
            letter-spacing: 0.5px;
            outline: none;
            color: #c4c3ca;
            background-color: #1f2029;
            border: none;
            -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
            box-shadow: 0 4px 8px 0 rgba(21, 21, 21, .2);
        }

        .form-style:focus,
        .form-style:active {
            border: none;
            outline: none;
            box-shadow: 0 4px 8px 0 rgba(21, 21, 21, .2);
        }

        .input-icon {
            position: absolute;
            top: 0;
            left: 18px;
            height: 48px;
            font-size: 24px;
            line-height: 48px;
            text-align: left;
            color: #ffeba7;
            -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }

        .form-group input:-ms-input-placeholder {
            color: #c4c3ca;
            opacity: 0.7;
            -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }

        .form-group input::-moz-placeholder {
            color: #c4c3ca;
            opacity: 0.7;
            -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }

        .form-group input:-moz-placeholder {
            color: #c4c3ca;
            opacity: 0.7;
            -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }

        .form-group input::-webkit-input-placeholder {
            color: #c4c3ca;
            opacity: 0.7;
            -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }

        .form-group input:focus:-ms-input-placeholder {
            opacity: 0;
            -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }

        .form-group input:focus::-moz-placeholder {
            opacity: 0;
            -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }

        .form-group input:focus:-moz-placeholder {
            opacity: 0;
            -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }

        .form-group input:focus::-webkit-input-placeholder {
            opacity: 0;
            -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }

        .btn {
            border-radius: 4px;
            height: 44px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
            padding: 0 30px;
            letter-spacing: 1px;
            display: -webkit-inline-flex;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-align-items: center;
            -moz-align-items: center;
            -ms-align-items: center;
            align-items: center;
            -webkit-justify-content: center;
            -moz-justify-content: center;
            -ms-justify-content: center;
            justify-content: center;
            -ms-flex-pack: center;
            text-align: center;
            border: none;
            background-color: #ffeba7;
            color: #102770;
            box-shadow: 0 8px 24px 0 rgba(255, 235, 167, .2);
        }

        .btn:active,
        .btn:focus {
            background-color: #102770;
            color: #ffeba7;
            box-shadow: 0 8px 24px 0 rgba(16, 39, 112, .2);
        }

        .btn:hover {
            background-color: #102770;
            color: #ffeba7;
            box-shadow: 0 8px 24px 0 rgba(16, 39, 112, .2);
        }




        .logo {
            position: absolute;
            top: 30px;
            right: 30px;
            display: block;
            z-index: 100;
            transition: all 250ms linear;
        }

        .logo img {
            height: 26px;
            width: auto;
            display: block;
        }
    </style>


<body class="body_backgorund">

    <a href="https://front.codes/" class="logo" target="_blank">
        <!-- <img src="../images/LOGO.png" alt="Logo" style="width: 300px; height: auto;"> -->
    </a>

    <form action="" autocomplete="off" method="post">
        <div class="section">
            <div class="container">
                <div class="row full-height justify-content-center">
                    <div class="col-12 text-center align-self-center py-5">
                        <div class="section pb-5 pt-5 pt-sm-2 text-center">
                            <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
                            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                            <label for="reg-log"></label>

                            <div class="card-3d-wrap mx-auto">
                                <div class="card-3d-wrapper">

                                    <div class="card-front">
                                        <div class="center-wrap">
                                            <div class="section text-center">
                                                <h4 class="mb-4 pb-4 ">Recruiter Log In</h4>

                                                <div class="form-group">
                                                    <input type="email" class="form-style" name="login_email"
                                                        placeholder="example@gmail.com">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" class="form-style" name="login_password"
                                                        id="login_password" placeholder="Enter password">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <!-- <a href="#" class="btn mt-4">submit</a> -->
                                                <button type="submit" name="login_btn" class="btn mt-4">Login</button>

                                                <p class="mb-0 mt-4 text-center"><a href="../reset_password_request"
                                                        class="link">Forgot your password?</a></p>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="card-back">
                                        <div class="center-wrap">
                                            <div class="section text-center">
                                                <h4 class="mb-4 mt-4 pb-3">Sign Up</h4>
                                                <div class="form-group">
                                                    <input type="text" name="companyName" class="form-style"
                                                        placeholder="Company Name" id="companyName" autocomplete="off">
                                                    <i class="input-icon uil uil-user"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="email" name="email" class="form-style"
                                                        placeholder="Your Email" id="email" autocomplete="off">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style"
                                                        placeholder="Your Password" id="password" autocomplete="off">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="confirmPassword" class="form-style"
                                                        placeholder="Your confirm Passwords" id="confirmPassword"
                                                        autocomplete="off">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <!-- <a href="#" name="register_btn" class="btn mt-4">submit</a> -->
                                                <input type="hidden" class="form-control form-control-user"
                                                    name="usertype" value="recruiter" placeholder="Repeat Password">

                                                <button type="submit" name="register_btn" class="btn mt-4 mb-4">Register
                                                    Account</button>

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
    </form>








    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>