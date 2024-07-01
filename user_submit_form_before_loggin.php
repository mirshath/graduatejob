<?php
session_start(); // Ensure session is started

include "Database/connection.php";

$first_name = '';
$last_name = '';
$email = '';

$categories = []; // Array to store fetched categories

// Fetch categories from database
$sql_categories = "SELECT * FROM category";
$result_categories = $conn->query($sql_categories);

if ($result_categories->num_rows > 0) {
    while ($row = $result_categories->fetch_assoc()) {
        $categories[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['token'])) {
    $token = $_GET['token'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $education_qualification = $_POST['educationQualification'];
    $interested_field = $_POST['interestedField'];
    $professional_qualification = $_POST['professionalQualification'];
    $studied_at = $_POST['studiedAt'];
    $other_studied_at = isset($_POST['otherStudiedAtInput']) ? $_POST['otherStudiedAtInput'] : '';
    $profile_image = $_FILES['profileImage']; // File upload data
    $student_cv = $_FILES['studentCV']; // File upload data for student CV

    // Check if token is valid
    $sql = "SELECT * FROM userregister WHERE token = ? AND user_active = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Update user data and activate account
        $update_sql = "UPDATE userregister SET phone_no = ?, St_address = ?, education_qualification = ?, interested_field = ?, professional_qualification = ?, studied_at = ?, profile = ?, studentCV = ?, token = '', user_active = 1 WHERE token = ?";

        // Determine the studied_at value based on dropdown selection
        if ($studied_at === 'other' && !empty($other_studied_at)) {
            $studied_at_value = $other_studied_at;
        } else {
            $studied_at_value = $studied_at;
        }

        // Add profile image update if file is uploaded
        if (!empty($profile_image['name'])) {
            // $upload_dir = 'uploads/'; // Directory where files will be uploaded
            $upload_dir = 'userDashboards/uploads/profiles/'; // Directory where files will be uploaded
            $file_name = basename($profile_image['name']);
            $target_path = $upload_dir . $file_name;

            // Move uploaded file to desired location
            if (move_uploaded_file($profile_image['tmp_name'], $target_path)) {
                // Update SQL statement to include profile image
                $profile_image_name = $file_name;
            } else {
                echo "Error uploading profile image.";
                exit;
            }
        } else {
            $profile_image_name = '';
        }

        // Add student CV update if file is uploaded
        if (!empty($student_cv['name'])) {
            $upload_dir = 'resumes/'; // Directory where files will be uploaded
            $file_name_cv = basename($student_cv['name']);
            $target_path_cv = $upload_dir . $file_name_cv;

            // Move uploaded file to desired location
            if (move_uploaded_file($student_cv['tmp_name'], $target_path_cv)) {
                // Update SQL statement to include student CV
                $student_cv_name = $file_name_cv;
            } else {
                echo "Error uploading student CV.";
                exit;
            }
        } else {
            $student_cv_name = '';
        }

        // Execute the update statement with all parameters
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sssssssss", $phone, $address, $education_qualification, $interested_field, $professional_qualification, $studied_at_value, $profile_image_name, $student_cv_name, $token);

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
                <form id="contact-form" role="form" method="POST" action="" enctype="multipart/form-data">
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
                        <div class="form-group col-md-4">
                            <label for="profileImage">Profile Image</label>
                            <input type="file" class="form-control-file" id="profileImage" name="profileImage">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="studentCV">Student CV</label>
                            <input type="file" class="form-control-file" id="studentCV" name="studentCV">
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
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['category_name']; ?>"><?= $category['category_name']; ?></option>
                                <?php endforeach; ?>
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
                                <option value="Associate_Degree">Associate Degree</option>
                                <option value="Bachelor's_Degree">Bachelor's Degree</option>
                                <option value="Master's_Degree">Master's Degree</option>
                                <option value="PhD">PhD</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="studiedAt">Studied At</label>
                            <select class="form-control" id="studiedAt" name="studiedAt">
                                <option value="">Select Studied At</option>
                                <option value="BMS">BMS</option>
                                <option value="other">Other</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div class="form-group col-md-4" id="otherStudiedAtInput" style="display: none;">
                            <label for="otherStudiedAtInput">Other Studied At</label>
                            <input type="text" class="form-control" id="otherStudiedAtInput" name="otherStudiedAtInput" placeholder="Other Institution">
                        </div>
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
    <script>
        // Script to show/hide 'Other Studied At' input field based on dropdown selection
        document.getElementById('studiedAt').addEventListener('change', function() {
            var otherInput = document.getElementById('otherStudiedAtInput');
            if (this.value === 'other') {
                otherInput.style.display = 'block';
            } else {
                otherInput.style.display = 'none';
            }
        });
    </script>
</body>

</html>