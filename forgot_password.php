<?php
session_start();
include "Database/connection.php";
include "includes/header.php";


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    // $password = $_POST["password"];

    // SQL query to check if the user exists
    $sql = "SELECT * FROM userregister WHERE email = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user's data
        $user = $result->fetch_assoc();
        $userEmail =  $user['email'];
        $hashedPassword = $user['password'];
    } else {
        $_SESSION['message'] = "No user found with that email address!";
    }



    // ------------------------------------------












    $stmt->close();
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/formstyle.css">


<body class="body_backgorund">
    <div class="login-container">
        <div class="row justify-content-center  ">
            <div class="col-md-12">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="">
                                <div class="mb-4">
                                    <h2 class=" text-gray-900 text-center">
                                        <img src="images/LOGO.png" alt="Logo" style="width: 300px; height: auto;">
                                    </h2>

                                    <div class="mb-4 mt-4">
                                        <h4 class=" text-gray-900 mb-3"><b>Lost your password?</b></h4>
                                        <h6 class="text-muted mb-3">Remember your password ? <a href="userLoginForm">
                                                Login </a> </h6>
                                        <hr>
                                    </div>
                                    <form class="user" action="" method="post" autocomplete="">
                                        <div class="form-group input-icon">
                                            <h6>Please enter your email please</h6>
                                        </div>

                                        <div class="form-group input-icon">
                                            <i class="fas fa-envelope"></i>
                                            <input type="email" class="form-control form-control-user" name="email" placeholder="Enter your email please " required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">SEND ME THE LINK </button>
                                        <hr>
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

    <script>
        // <?php


            if (isset($_SESSION['message'])) {

            ?> 
        alertify.set('notifier', 'position', 'bottom-right');
        alertify.success('Current position : ' + alertify.get('notifier', 'position'));

        alertify.success('<?= $_SESSION['message'] ?>');
        <?php
                unset($_SESSION['message']);
            }

        ?>
    </script>



    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>