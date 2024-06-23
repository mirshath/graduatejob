<?php
include "Database/connection.php";
// require "../headerFiles/header.php";
require "includes/header.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user input
    $firstName = htmlspecialchars($_POST["firstName"]);
    $lastName = htmlspecialchars($_POST["lastName"]);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $userType = $_POST["userType"];
    $companyName = htmlspecialchars($_POST["companyName"]);

    // Validate password strength
    if (strlen($password) < 6) {
        echo "Password must be at least 6 characters long.";
        exit();
    }

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "Passwords do not match!";
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL statement using prepared statements
    $sql = "INSERT INTO userregister (firstname, lastname, email, password, usertype, company_name) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $hashedPassword, $userType, $companyName);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['message'] = "Successfully registered";
        echo '<script>window.location.href = "userLoginForm";</script>';
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
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
    <link rel="stylesheet" href="assets/css/formstyle.css">

</head>



<style>
    .form-container {
        /* background: linear-gradient(#080d76, #7f012b); */
        background: rgb(9, 9, 121);
        background: radial-gradient(circle, rgba(9, 9, 121, 1) 10%, rgba(2, 2, 61, 1) 100%);

        font-family: 'Roboto', sans-serif;
        font-size: 0;
        padding: 0 15px;
        /* border: 1px solid #DC2036; */
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
    }

    .form-horizontal .form-control {
        color: #b5b5b5;
        background-color: transparent;
        font-size: 14px;
        letter-spacing: 1px;
        width: calc(100% - 55px);
        height: 33px;
        padding: 2px 10px 0 0;
        box-shadow: none;
        border: none;
        border-radius: 0;
        display: inline-block;
        transition: all 0.3s;
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


<body class="body_backgorund">
    <div class="container-fluid form-bg d-flex align-items-center justify-content-center" style="height: 100vh;;">
        <div class="col-lg-6 col-md-8">
            <div class="form-container">
                <div class="form-icon">
                    <i class="fa fa-user-circle"></i>
                    <span class="signup"><a href="userLoginForm">Already have an account? Sign in</a></span>
                </div>
                <form class="form-horizontal" action="" method="post" autocomplete="">
                    <h3 class="chakra-petch-bold text-center mb-4 pb-4">Register </h3>
                    <div class="form-group p-1">
                        <span class="input-icon"><i class="fa fa-user"></i></span>
                        <input class="form-control" type="text" name="firstName" placeholder="First Name">
                    </div>
                    <div class="form-group p-1">
                        <span class="input-icon"><i class="fa fa-user"></i></span>
                        <input class="form-control" type="text" name="lastName" placeholder="Last Name">
                    </div>
                    <div class="form-group p-1">
                        <span class="input-icon"><i class="fa fa-envelope"></i></span>
                        <input class="form-control" type="email" name="email" placeholder="Email Address">
                    </div>
                    <div class="form-group p-1">
                        <span class="input-icon"><i class="fa fa-lock"></i></span>
                        <input class="form-control" type="password" name="password" placeholder="Password"
                            id="password">
                    </div>
                    <div class="form-group p-1">
                        <span class="input-icon"><i class="fa fa-lock"></i></span>
                        <input class="form-control" type="password" name="confirmPassword" placeholder="Repeat Password"
                            id="confirmPassword">
                    </div>
                    <input type="hidden" name="userType" value="jobSeeker">

                    <!-- <button type="submit" class="btn signin p-2 fw-bold">Register</button> -->
                    <button type="submit" class="btn signin p-2 fw-bold">Register Account</button>
                </form>
            </div>
        </div>
    </div>



    <!-- icon for the view and hide for the password  -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.querySelector('input[name="password"]');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle the eye icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
            const confirmPasswordInput = document.querySelector('input[name="confirmPassword"]');
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);

            // Toggle the eye icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->




    <script>
        // <?php

        // // messages from corect or not 
        
        // if (isset($_SESSION['message'])) {
        // 
        ?>
        //     alertify.set('notifier', 'position', 'bottom-right');
        //     alertify.success('Current position : ' + alertify.get('notifier', 'position'));

        //     alertify.success('<?= $_SESSION['message'] ?>');
        // <?php
        //     unset($_SESSION['message']);
        // }
        // 
        ?>
    </script>



    <!-- jQu  ery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script ipt src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>