<?php
require 'Database/connection.php';
include "includes/header.php";



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $new_password = $_POST['password'];

    // Get email associated with the token
    $stmt = $conn->prepare('SELECT email FROM password_resets WHERE token = ?');
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        // Hash the new password
        $password_hash = password_hash($new_password, PASSWORD_BCRYPT);

        // Update the user's password in the database
        $stmt = $conn->prepare('UPDATE userregister SET password = ? WHERE email = ?');
        $stmt->bind_param('ss', $password_hash, $email);
        $stmt->execute();

        // Delete the reset token
        $stmt = $conn->prepare('DELETE FROM password_resets WHERE token = ?');
        $stmt->bind_param('s', $token);
        $stmt->execute();

        // echo 'Your password has been updated!';
        // header("location: userLoginForm.php ");
        $_SESSION['message'] = "Your password has been updated!";
        echo '<script>window.location.href = "userLoginForm";</script>';
    } else {
        // echo 'Invalid or expired token.';
        $_SESSION['message'] = "Invalid or expired token.";
    }
} else {
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
    } else {
        die('Token not provided.');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




    <!-- Include the AlertifyJS CSS and JS files in your HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


</head>

<body>
    <!-- <h2>Update Password</h2>
    <form method="POST" action="">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <label for="password">Enter new password:</label>
        <input type="password" id="password" name="password" placeholder="Enter new password" required>
        <button type="submit">Update Password</button>
    </form>
 -->




    <body class="body_backgorund">



        <!-- ----------------------- new tying --------------  -->


        <div class="container text-center mt-4">

        </div>

        <div class="container">
            <!-- <div class="img">
                <img src="images/Graduatejob.lk Logo.jpg" alt="" class="img-fluid">
            </div> -->
            <div class="row">
                <div class="col-lg-7 mx-auto">
                    <div class="img text-center">
                        <img src="images/Graduatejob.lk Logo.jpg" alt="" class="img-fluid" style="max-width: 400px; margin: 0 auto;">
                    </div>
                    <div class="text-center mt-5">
                        <h1>Reset Password Form</h1>
                    </div>
                    <div class="card mt-2 mx-auto p-4 bg-light">
                        <div class="card-body bg-light">
                            <div class="container">
                                <form class="user" action="reset_password.php" method="POST" autocomplete="off" id="resetForm">
                                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

                                    <div class="controls">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="form_name">Enter New Password *</label>
                                                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Enter New Password...">
                                                    <div id="passwordError" class="text-danger"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="form_email">Confirm Password *</label>
                                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                                                    <div id="confirmPasswordError" class="text-danger"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success btn-user btn-block">Update Password</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.8 -->
                </div>
                <!-- /.row-->
            </div>
        </div>





        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('resetForm');
                const passwordInput = document.getElementById('password');
                const confirmPasswordInput = document.getElementById('confirm_password');
                const passwordError = document.getElementById('passwordError');
                const confirmPasswordError = document.getElementById('confirmPasswordError');

                form.addEventListener('submit', function(event) {
                    let valid = true;
                    const password = passwordInput.value;
                    const confirmPassword = confirmPasswordInput.value;

                    // Regular expression for validating password: at least one special character and minimum length of 6 characters
                    const passwordRegex = /^(?=.*[!@#$%^&*(),.?":{}|<>]).{6,}$/;

                    passwordError.textContent = '';
                    confirmPasswordError.textContent = '';

                    if (!passwordRegex.test(password)) {
                        passwordError.textContent = 'Password must be at least 6 characters and at least 1 special char';
                        valid = false;
                    }

                    if (password !== confirmPassword) {
                        confirmPasswordError.textContent = 'Passwords do not match. Enter the same password in both fields.';
                        valid = false;
                    }

                    if (!valid) {
                        event.preventDefault(); // Prevent form submission if validation fails
                    }
                });
            });
        </script>



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