<?php
include "Database/connection.php";
include "headerFiles/header.php";



// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "Passwords do not match!";
        exit();
    }

    

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // SQL query to insert data into the database
    $sql = "INSERT INTO userregister (firstname	, lastname, email , password) VALUES ('$firstName', '$lastName', '$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        // Redirect to the login page
        // header("Location: userLoginForm.php");
        echo '<script>window.location.href = "userLoginForm.php";</script>';
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}



?>


    <div class="container">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                        </div>
                                        <form class="user" action="register.php" method="post">
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="text" class="form-control form-control-user" name="firstName" placeholder="First Name" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-user" name="lastName" placeholder="Last Name" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address" required>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="password" class="form-control form-control-user" name="confirmPassword" placeholder="Repeat Password" required>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">Register Account</button>
                                            <hr>
                                            <a href="#" class="btn btn-google btn-user btn-block">
                                                <i class="fab fa-google fa-fw"></i> Register with Google
                                            </a>
                                            <a href="#" class="btn btn-facebook btn-user btn-block">
                                                <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                            </a>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="login.php">Already have an account? Login!</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="forgot-password.php">Forgot Password?</a>
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

   