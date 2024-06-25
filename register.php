<?php
include "Database/connection.php";
require "includes/header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user input
    $firstName = htmlspecialchars($_POST["firstname"]);
    $lastName = htmlspecialchars($_POST["lastname"]);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];
    $userType = $_POST["userType"];

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
    $sql = "INSERT INTO userregister (firstname, lastname, email, password, usertype) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $firstName, $lastName, $email, $hashedPassword, $userType);

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
    <title>Registration Form with Validation</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

    .invalid-feedback {
        color: red;
        font-size: 12px;
        margin-left: 15px;
    }
</style>


<div class="container-fluid form-bg d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="col-lg-6 col-md-8">
        <div class="form-container">
            <div class="form-icon">
                <i class="fa fa-user-circle"></i>
                <span class="signup"><a href="userLoginForm">Already have an account? Sign in</a></span>
            </div>
            <form class="form-horizontal" action="" method="post" id="registrationForm">
                <h3 class="chakra-petch-bold text-center mb-4 pb-4">Register</h3>
                <div class="form-group p-1">
                    <span class="input-icon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control " id="firstname" name="firstname" placeholder="First Name">
                    <div class="invalid-feedback" id="firstnameError"></div>
                </div>
                <div class="form-group p-1">
                    <span class="input-icon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
                    <div class="invalid-feedback" id="lastnameError"></div>
                </div>
                <div class="form-group p-1">
                    <span class="input-icon"><i class="fa fa-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                    <div class="invalid-feedback" id="emailError"></div>
                </div>
                <div class="form-group p-1">
                    <span class="input-icon"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <div class="invalid-feedback" id="passwordError"></div>
                </div>
                <div class="form-group p-1">
                    <span class="input-icon"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                    <div class="invalid-feedback" id="confirmPasswordError"></div>
                </div>
                <input type="hidden" name="userType" value="jobSeeker">
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>.


<script>
    // JavaScript for form validation
    $(document).ready(function() {
        $('#registrationForm').submit(function(event) {
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var email = $('#email').val();
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
                $('#firstname').next('.input-group-append').find('.validation-icon').html('<i class="fas fa-times-circle"></i>');
                isValid = false;
            } else {
                $('#firstname').addClass('is-valid');
                $('#firstname').next('.input-group-append').find('.validation-icon').html('<i class="fas fa-check-circle"></i>');
            }

            // Last Name validation
            if (lastname.trim() === '') {
                $('#lastnameError').text('Last Name is required.');
                $('#lastname').addClass('is-invalid');
                $('#lastname').next('.input-group-append').find('.validation-icon').html('<i class="fas fa-times-circle"></i>');
                isValid = false;
            } else {
                $('#lastname').addClass('is-valid');
                $('#lastname').next('.input-group-append').find('.validation-icon').html('<i class="fas fa-check-circle"></i>');
            }

            // Email validation
            if (email.trim() === '') {
                $('#emailError').text('Email is required.');
                $('#email').addClass('is-invalid');
                $('#email').next('.input-group-append').find('.validation-icon').html('<i class="fas fa-times-circle"></i>');
                isValid = false;
            } else {
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    $('#emailError').text('Invalid email format.');
                    $('#email').addClass('is-invalid');
                    $('#email').next('.input-group-append').find('.validation-icon').html('<i class="fas fa-times-circle"></i>');
                    isValid = false;
                } else {
                    $('#email').addClass('is-valid');
                    $('#email').next('.input-group-append').find('.validation-icon').html('<i class="fas fa-check-circle"></i>');
                }
            }

            // Password validation
            if (password.trim() === '') {
                $('#passwordError').text('Password is required.');
                $('#password').addClass('is-invalid');
                $('#password').next('.input-group-append').find('.validation-icon').html('<i class="fas fa-times-circle"></i>');
                isValid = false;
            } else {
                $('#password').addClass('is-valid');
                $('#password').next('.input-group-append').find('.validation-icon').html('<i class="fas fa-check-circle"></i>');
            }

            // Confirm Password validation
            if (confirmPassword.trim() === '') {
                $('#confirmPasswordError').text('Please confirm your password.');
                $('#confirm_password').addClass('is-invalid');
                $('#confirm_password').next('.input-group-append').find('.validation-icon').html('<i class="fas fa-times-circle"></i>');
                isValid = false;
            } else if (password !== confirmPassword) {
                $('#confirmPasswordError').text('Passwords do not match.');
                $('#confirm_password').addClass('is-invalid');
                $('#confirm_password').next('.input-group-append').find('.validation-icon').html('<i class="fas fa-times-circle"></i>');
                isValid = false;
            } else {
                $('#confirm_password').addClass('is-valid');
                $('#confirm_password').next('.input-group-append').find('.validation-icon').html('<i class="fas fa-check-circle"></i>');
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
