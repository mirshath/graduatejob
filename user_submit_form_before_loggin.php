<?php
session_start(); // Ensure session is started

include "Database/connection.php";

$first_name = '';
$last_name = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['token'])) {
    $token = $_GET['token'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $education_qualification = $_POST['educationQualification'];
    $interested_field = $_POST['interestedField'];
    $professional_qualification = $_POST['professionalQualification'];
    $studied_at = $_POST['studiedAt'];
    $other_studied_at = isset($_POST['otherStudiedAtInput']) ? $_POST['otherStudiedAtInput'] : '';

    // Check if token is valid
    $sql = "SELECT * FROM userregister WHERE token = ? AND user_active = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Update user data and activate account
        $update_sql = "UPDATE userregister SET phone_no = ?, St_address = ?, education_qualification = ?, interested_field = ?, professional_qualification = ?, studied_at = ?, token='', user_active=1 WHERE token = ?";
        
        // Determine the studied_at value based on dropdown selection
        if ($studied_at === 'other' && !empty($other_studied_at)) {
            $studied_at_value = $other_studied_at;
        } else {
            $studied_at_value = $studied_at;
        }

        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sssssss", $phone, $address, $education_qualification, $interested_field, $professional_qualification, $studied_at_value, $token);

        if ($update_stmt->execute()) {
            echo "Details updated successfully!";
        } else {
            echo "Error updating record: " . $update_stmt->error;
        }

        // Close the update statement
        $update_stmt->close();
    } else {
        echo "Invalid or expired token.";
    }

    $stmt->close();
    $conn->close();
} else if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if token is valid and fetch user data
    $sql = "SELECT * FROM userregister WHERE token = ? AND user_active = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $first_name = $row['firstname'];
        $last_name = $row['lastname'];
        $email = $row['email'];
    } else {
        echo "Invalid or expired token.";
        exit;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card mt-2 mx-auto p-4 bg-light">
            <div class="card-body bg-light">

                <h2 class="text-center mb-4">Update Form</h2>
                <form id="contact-form" role="form" method="POST" action="">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="firstName">First Name</label>
                            <input id="first_name" type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($first_name); ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="lastName">Last Name</label>
                            <input id="last_name" type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars($last_name); ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">Email</label>
                            <input id="email" type="text" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="phone">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                        </div>

                        <div class="form-group  col-md-4">
                            <label for="profileImage ">Profile Image</label>
                            <input type="file" class="form-control-file" id="profileImage">
                        </div>
                        <div class="form-group  col-md-4">
                            <label for="studentCV ">Student CV</label>
                            <input type="file" class="form-control-file" id="studentCV">
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="educationQualification">Education Qualification</label>
                            <select class="form-control" id="educationQualification" name="educationQualification">
                                <option value="">Select Education Qualification</option>
                                <option value="High_School">High School</option>
                                <option value="Bachelor's_Degree">Bachelor's Degree</option>
                                <option value="Master's_Degree">Master's Degree</option>
                                <option value="PhD">PhD</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="interestedField">Interested Field</label>
                            <select class="form-control" id="interestedField" name="interestedField">
                                <option value="">Select Interested Field</option>
                                <option value="IT">IT</option>
                                <option value="Engineering">Engineering</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Finance">Finance</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="professionalQualification">Professional Qualification</label>
                            <select class="form-control" id="professionalQualification" name="professionalQualification">
                                <option value="">Select Professional Qualification</option>
                                <option value="Certification">Certification</option>
                                <option value="Diploma">Diploma</option>
                                <option value="Associate Degree">Associate Degree</option>
                                <option value="Bachelor's Degree">Bachelor's Degree</option>
                                <option value="Master's Degree">Master's Degree</option>
                                <option value="PhD">PhD</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>

                        <!-- Dropdown for Studied At with other option -->
                        <div class="form-group col-md-4">
                            <label for="studiedAt">Studied At</label>
                            <select class="form-control" id="studiedAt" name="studiedAt" onchange="toggleOtherInput()">
                                <option value="">Select University/Institute</option>
                                <option value="esoft">ESoft</option>
                                <option value="BMS">BMS College</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <!-- Input field for Other option -->
                        <div class="form-group col-md-4" id="otherStudiedAt" style="display: none;">
                            <label for="otherStudiedAtInput">Other University/Institute</label>
                            <input type="text" class="form-control" id="otherStudiedAtInput" name="otherStudiedAtInput" placeholder="Enter University/Institute">
                        </div>


                        <script>
                            // Function to show/hide input field based on dropdown selection
                            function toggleOtherInput() {
                                var studiedAt = document.getElementById('studiedAt');
                                var otherInput = document.getElementById('otherStudiedAt');

                                if (studiedAt.value === 'other') {
                                    otherInput.style.display = 'block';
                                } else {
                                    otherInput.style.display = 'none';
                                }
                            }
                        </script>

                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success btn-send pt-2 btn-block">Update Details</button>
                    </div>

                </form>

            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
