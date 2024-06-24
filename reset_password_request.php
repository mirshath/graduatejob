<?php
require 'Database/connection.php';
include "includes/header.php";

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';



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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/formstyle.css">

</head>

<!-- <h2 class="text-white">Reset Password</h2>
    <form method="POST" action="" class="text-white">
        <label for="email">Enter your email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
        <button type="submit">Reset Password</button>
    </form> -->


<style>
    .form-container {
        /* background: linear-gradient(#080d76, #7f012b); */
        background: rgb(9,9,121);
        background: radial-gradient(circle, rgba(9,9,121,1) 10%, rgba(2,2,61,1) 100%);
        
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


<body class="body_backgorund">
    <div class="container-fluid form-bg d-flex align-items-center justify-content-center" style="height: 90vh;">
        <div class="col-lg-6 col-md-8">
            <div class="form-container">
                <div class="form-icon">
                    <i class="fa fa-user-circle"></i>
                    <span class="signup"><a href="userLoginForm">Remember your password ? Sign in</a></span>
                </div>
                <form class="form-horizontal" action="" method="post" autocomplete="">
                    <h3 class="chakra-petch-bold text-center mb-4 pb-4">Lost your password?</h3> <hr>
                    <div class="form-group p-1">
                        <span class="input-icon"><i class="fa fa-envelope"></i></span>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Enter your email">
                    </div>

                    <!-- <button class="btn signin">Login</button> -->
                    <!-- <button type="submit" class="btn signin p-2 p-2 fw-bold">Login</button> -->
                    <button type="submit" class="btn signin  p-2 fw-bold">SEND ME THE LINK </button>
                    <hr>
                </form>
            </div>
        </div>
    </div>







    <script>
        <?php
        // Check if $_SESSION['message'] is set and display it using Alertify.js
        if (isset($_SESSION['message'])) {
        ?>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['message'] ?>');
        <?php
            // Unset $_SESSION['message'] to prevent it from being displayed again on subsequent page loads
            unset($_SESSION['message']);
        }
        ?>
    </script>