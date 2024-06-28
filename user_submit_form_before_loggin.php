<?php
session_start(); // Ensure session is started

include "Database/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['token'])) {
    $token = $_GET['token'];
    $st_address = $_POST['st_address'];
    $education_qualification = $_POST['education_qualification'];

    // Check if token is valid
    $sql = "SELECT * FROM userregister WHERE token = ? AND user_active = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Update user data and activate account
        $sql = "UPDATE userregister SET st_address = ?, education_qualification = ?, user_active = 1, token = '' WHERE token = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $st_address, $education_qualification, $token);
        if ($stmt->execute()) {
            echo "Email verified! You can now <a href='http://localhost/graduatejob/userLoginForm'>login</a>.";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
    } else {
        echo "Invalid or expired token.";
    }

    $stmt->close();
    $conn->close();
}
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<style>
    body {
        font-family: 'Lato', sans-serif;
    }

    h1 {
        margin-bottom: 40px;
    }

    label {
        color: #333;
    }

    .btn-send {
        font-weight: 300;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        width: 80%;
        margin-left: 3px;
    }

    .help-block.with-errors {
        color: #ff5050;
        margin-top: 5px;
    }

    .card {
        margin-left: 10px;
        margin-right: 10px;
    }
</style>

<div class="container">
    <div class="text-center mt-5">
        <h1>Update the User Data Here</h1>
    </div>
    <div class="row">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" role="form" method="POST" action="">
                            <div class="controls">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="st_address">Street Address *</label>
                                            <input id="st_address" type="text" name="st_address" class="form-control"
                                                placeholder="Street Address *" required="required"
                                                data-error="Street address is required.">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="education_qualification">Education Qualification *</label>
                                            <input id="education_qualification" type="text"
                                                name="education_qualification" class="form-control"
                                                placeholder="Education Qualification *" required="required"
                                                data-error="Education qualification is required.">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-success btn-send pt-2 btn-block"
                                            value="Update Details">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>