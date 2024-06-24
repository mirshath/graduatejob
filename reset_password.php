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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/formstyle.css">

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
                                            <h4 class=" text-gray-900 mb-3"><b>New Password </b></h4>
                                            <!-- <h6 class="text-muted mb-3">Remember your password ? <a href="userLoginForm">
                                                Login </a> </h6> -->
                                            <hr>
                                        </div>
                                        <form class="user" action="" method="POST" autocomplete="">

                                            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                                            <div class="form-group input-icon">
                                                <h6>Enter New Password</h6>
                                            </div>

                                            <div class="form-group input-icon">
                                                <i class="fas fa-lock"></i>
                                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Enter New Password... " required>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">Update Password </button>
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