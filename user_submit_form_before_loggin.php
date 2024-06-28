<?php
require "Database/connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the input values
    $st_address = $_POST['st_address'];
    $education_qualification = $_POST['education_qualification'];
    $user_id = 1; // Replace this with the actual user ID

    // Create the SQL update query
    $sql = "UPDATE userregister SET st_address = ?, education_qualification = ? WHERE id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters
        $stmt->bind_param('ssi', $st_address, $education_qualification, $user_id);

        // Execute the query
        if ($stmt->execute()) {
            echo "User details updated successfully.";
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">

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
    <div class=" text-center mt-5 ">

        <h1>Update the User Data Here</h1>


    </div>


    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">

                    <div class="container">
                    <form id="contact-form" role="form" method="POST" action="update_user.php">
    <div class="controls">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_name">St_address *</label>
                    <input id="form_name" type="text" name="st_address" class="form-control" placeholder="St_address *" required="required" data-error="Street address is required.">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_lastname">education_qualification *</label>
                    <input id="form_lastname" type="text" name="education_qualification" class="form-control" placeholder="Education Qualification *" required="required" data-error="Education qualification is required.">
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <input type="submit" class="btn btn-success btn-send pt-2 btn-block" value="Update Details">
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