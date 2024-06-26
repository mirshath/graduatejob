<?php
include "../Database/connection.php";
// require "../headerFiles/header.php";
require "../includes/header.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user input
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $userType = htmlspecialchars($_POST["usertype"]);
    $companyName = htmlspecialchars($_POST["companyName"]);

    // Validate email
    if (!$email) {
        echo "Invalid email format.";
        exit();
    }

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

</head>



<body class="body_backgorund">

    <div class="login-container">
        <div class="row justify-content-center  ">
            <div class="col-md-12">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body  ">
                        <div class="col-md-12">

                            <div class="">

                                <div class="mb-4">
                                    <h2 class=" text-gray-900 text-center">
                                        <img src="../images/LOGO.png" alt="Logo" style="width: 300px; height: auto;">
                                    </h2>

                                    <div class="mb-4">
                                        <h4 class=" text-gray-900 mb-3"><b>Register for Recruiter</b></h4>
                                        <h6 class="text-muted mb-3">Already you have an account? <a href="recruiterLoginForm">
                                                sign In </a> </h6>
                                        <hr>
                                    </div>
                                    <form class="user" action="register.php" method="post">

                                        <div class="row">
                                            <div class="col-md-6">
                                            <div class="form-group input-icon">
                                                <i class="fas fa-building"></i>
                                                <input type="text" class="form-control form-control-user" name="companyName" placeholder="Company Name">
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group input-icon">
                                                    <i class="fas fa-envelope"></i>
                                                    <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address" required>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-icon">
                                                    <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                                                    <i class="fas fa-lock"></i>
                                                    <i class="fas fa-eye toggle-password text text-right" id="togglePassword"></i>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-icon">
                                                    <input type="password" class="form-control form-control-user" name="confirmPassword" placeholder="Repeat Password" required>
                                                    <i class="fas fa-lock"></i>
                                                    <i class="fas fa-eye toggle-password text text-right" id="toggleConfirmPassword"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control form-control-user" name="usertype" value="recruiter" placeholder="Repeat Password" required>

                                        </div>


                                        



                                        <button type="submit" class="btn btn-primary btn-user btn-block">Register Account</button>
                                    </form>


                                    <hr>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- icon for the view and hide for the password  -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.querySelector('input[name="password"]');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle the eye icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
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