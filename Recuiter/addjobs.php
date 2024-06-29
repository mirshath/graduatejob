<?php
session_start();
include "include/header.php";
include("../Database/connection.php");

if (!isset($_SESSION['user_id'])) {
    header("location: ../index.php");
    exit();
}



require '../vendor/autoload.php';

// Side bar 
include("include/sidenav.php");

$rec_id = $_SESSION['user_id'];
// $re_email = $_SESSION['user_email'];
$com_name = $_SESSION['company_name'];






// Fetch categories from the database
$sql = "SELECT * FROM category";
$result = mysqli_query($conn, $sql);

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $jobTitle = $_POST["jobTitle"];
    $companyName = $_POST["companyName"];
    $jobCategory = $_POST["jobCategory"];
    $jobDescription = $_POST["jobDescription"];
    $employmentType = $_POST["employmentType"];
    $location = $_POST["location"];
    $salaryRange = $_POST["salaryRange"];
    $skillsRequired = $_POST["skillsRequired"];
    $educationLevel = $_POST["educationLevel"];
    $experienceLevel = $_POST["experienceLevel"];
    $applicationDeadline = $_POST["applicationDeadline"];
    $contactInfo = $_POST["contactInfo"];
    $additionalInfo = $_POST["additionalInfo"];
    $recuiter_id = $_SESSION['user_id'];

    // Handle file upload for company logo
    $filename = $_FILES["companyLogo"]["name"];
    $tempname = $_FILES["companyLogo"]["tmp_name"];
    $folder = "../Admin/uploads/" . $filename;

    // SQL query to insert data into the database
    $sql = "INSERT INTO jobs (job_title, company_name, company_logo, job_category, job_description, employment_type, location, salary_range, skills_required, education_level, experience_level, application_deadline, contact_info, additional_info, recuiter_id, postedBy, admin_status, application_status) 
    VALUES ('$jobTitle', '$companyName', '$filename', '$jobCategory', '$jobDescription', '$employmentType', '$location', '$salaryRange', '$skillsRequired', '$educationLevel', '$experienceLevel', '$applicationDeadline', '$contactInfo', '$additionalInfo', '$recuiter_id', '$companyName', 'Pending' , 'active')";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        if (move_uploaded_file($tempname, $folder)) {
            echo "<h3> Image uploaded successfully!</h3>";
        } else {
            echo "<h3> Failed to upload image!</h3>";
        }

       

        echo '<script>window.location.href = "addjobs.php";</script>';
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}


?>


<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <?php include("include/nav.php"); ?>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Add Jobs</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Add Jobs</a>
                    </li>
                    <li><i class="bx bx-chevron-right"></i></li>
                    <li>
                        <a class="active" href="addjobs">Add</a>
                    </li>
                </ul>
            </div>
            <a href="#" class="btn-download">
                <i class="bx bxs-cloud-download"></i>
                <span class="text">Download PDF</span>
            </a>
        </div>

        <!-- --------------------------------  -->

        <div class="table-data container">
            <div class="shadow p-5" style="border-radius: 15px;">

                <form action="" method="post" enctype="multipart/form-data">

                    <!-- 1st row  -->
                    <div class="row mb-4">
                        <input type="hidden" class="form-control" id="recuiter_id" name="recuiter_id" value="<?= $rec_id ?>" required>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="jobTitle">Job Title</label>
                                <input type="text" class="form-control" id="jobTitle" name="jobTitle" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="companyName">Company Name</label>
                                <input type="text" class="form-control" id="companyName" name="companyName" value="<?= $com_name ?>" required readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="companyLogo"> Poster Image</label> 
                                <input type="file" class="form-control-file" id="companyLogo" name="companyLogo"> <span style="color: red; font-weight: bolder;">* use the size 1080 x 1350</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="employmentType">Employment Type</label>
                                <select class="form-control" id="employmentType" name="employmentType" required>
                                    <option value="">Select Employment Type</option>
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Internship">Internship</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- 2nd row  -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="jobCategory">Job Category/Industry</label>
                                <select class="form-control" id="jobCategory" name="jobCategory" required>
                                    <option value="">Select Category</option>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option value='" . $row['category_name'] . "'>" . $row['category_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="educationLevel">Education Level</label>
                                <select class="form-control" id="educationLevel" name="educationLevel" required>
                                    <option value="">Select Education Level</option>
                                    <option value="HighSchool">High School</option>
                                    <option value="PhD">PhD</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="experienceLevel">Experience Level</label>
                                <select class="form-control" id="experienceLevel" name="experienceLevel" required>
                                    <option value="" disa>Select Experience Level</option>
                                    <option value="Entry_Level">Entry Level</option>
                                    <option value="Mid_Level">Mid Level</option>
                                    <option value="Senior_Level">Senior Level</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" name="location" required>
                            </div>
                        </div>
                    </div>

                    <!-- 3rd row  -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="salaryRange">Salary Range</label>
                                <input type="text" class="form-control" id="salaryRange" name="salaryRange" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="applicationDeadline">Application Deadline</label>
                                <input type="date" class="form-control" id="applicationDeadline" name="applicationDeadline" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="contactInfo">Contact Email/Phone</label>
                                <input type="text" class="form-control" id="contactInfo" name="contactInfo" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="skillsRequired">Skills Required</label>
                        <textarea class="form-control" id="skillsRequired" name="skillsRequired"  required></textarea>
                        
                    </div>

                    <div class="form-group mb-4">
                        <label for="jobDescription">Job Description</label>
                        <textarea class="form-control" id="jobDescription" name="jobDescription"  required></textarea>
                        <script>
                            // Initialize CKEditor on the textarea with custom configuration
                            CKEDITOR.replace('jobDescription', {
                                height: 300,
                                
                               
                            });
                        </script>
                    </div>



                    

                    <div class="form-group mb-4">
                        <label for="additionalInfo">Additional Information</label>
                        <textarea class="form-control" id="additionalInfo" name="additionalInfo" rows="3"></textarea>
                        <script>
                            // Initialize CKEditor on the textarea with custom configuration
                            CKEDITOR.replace('additionalInfo', {
                                height: 150,
                                
                            });
                        </script>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </main>
</section>

<script src="script.js"></script>