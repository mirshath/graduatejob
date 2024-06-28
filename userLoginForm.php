<?php
session_start();
include "Database/connection.php";
include "includes/header.php";

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
                // User is inactive
                ?>
                <script>
                    alertify.error("Please submit your document and login.");
                </script>
                <?php
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
                        echo '<script>window.location.href = "index";</script>';
                        exit();
                    }
                } else {
                    // Password is incorrect
                    ?>
                    <script>
                        alertify.error("Please check your credentials.");
                    </script>
                    <?php
                }
            }
        } else {
            // No user found with that email address
            ?>
            <script>
                alertify.error("No user found with that email address!");
            </script>
            <?php
        }

        $stmt->close();
    } else {
        // Handle SQL preparation error
        ?>
        <script>
            alertify.error("An error occurred. Please try again later.");
        </script>
        <?php
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
    <link rel="stylesheet" href="assets/css/formstyle.css">

</head>

<style>
    body {
        background: linear-gradient(312deg, #040343, #760000, #150250);
        background-size: 600% 600%;

        -webkit-animation: backgroundAnimation 7s ease infinite;
        -moz-animation: backgroundAnimation 7s ease infinite;
        -o-animation: backgroundAnimation 7s ease infinite;
        animation: backgroundAnimation 7s ease infinite;
    }

    @-webkit-keyframes backgroundAnimation {
        0% {
            background-position: 0% 26%
        }

        50% {
            background-position: 100% 75%
        }

        100% {
            background-position: 0% 26%
        }
    }

    @-moz-keyframes backgroundAnimation {
        0% {
            background-position: 0% 26%
        }

        50% {
            background-position: 100% 75%
        }

        100% {
            background-position: 0% 26%
        }
    }

    @-o-keyframes backgroundAnimation {
        0% {
            background-position: 0% 26%
        }

        50% {
            background-position: 100% 75%
        }

        100% {
            background-position: 0% 26%
        }
    }

    @keyframes backgroundAnimation {
        0% {
            background-position: 0% 26%
        }

        50% {
            background-position: 100% 75%
        }

        100% {
            background-position: 0% 26%
        }
    }


    /* ---------------------------  */
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
        padding: 70px 0;
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


<body class="">
    <div class="container-fluid form-bg d-flex align-items-center justify-content-center" style="height: 90vh;">
        <div class="col-lg-6 col-md-8">
            <div class="form-container">
                <div class="form-icon">
                    <i class="fa fa-user-circle"></i>
                    <span class="signup"><a href="register">Don't have an account? Signup</a></span>
                </div>
                <form class="form-horizontal" action="" method="post" autocomplete="">
                    <h3 class="chakra-petch-bold text-center mb-4 pb-4">Login</h3>
                    <div class="form-group p-1">
                        <span class="input-icon"><i class="fa fa-envelope"></i></span>
                        <input class="form-control" type="email" name="email" placeholder="Email Address">
                    </div>
                    <div class="form-group p-1">
                        <span class="input-icon"><i class="fa fa-lock"></i></span>
                        <input class="form-control" type="password" name="password" id="password"
                            placeholder="Password">
                    </div>
                    <!-- <button class="btn signin">Login</button> -->
                    <button type="submit" class="btn signin p-2 p-2 fw-bold">Login</button>
                    <span class="forgot-pass"><a href="reset_password_request">Forgot Password?</a></span>
                </form>
            </div>
        </div>
    </div>




    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <!-- Bootstrap JS -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->