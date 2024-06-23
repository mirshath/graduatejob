<?php
include "Database/connection.php";
include "headerFiles/header.php";




// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // SQL query to check if the user exists
    $sql = "SELECT * FROM userregister WHERE email = '$email'";
  
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user's data
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            header("Location: sampleHomePage.php");
            exit();
        } else {
            // Password is incorrect
            echo "Invalid password!";
        }
    } else {
        // User not found
        echo "No user found with that email address!";
    }
}

?>

<div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <form class="user" action="" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                        <hr>
                                        <a href="register.php" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Register an Account
                                        </a>
                                    </form>
                                    <hr>
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