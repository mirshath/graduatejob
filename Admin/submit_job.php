<?php
// Database connection
// $conn = new mysqli("localhost", "root", "", "BMS_JOB");
include '../Database/connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    // $application_status = $_POST["application_status"];
    $jobTitle = $_POST["jobTitle"];
    $companyName = $_POST["companyName"];

    // Handle file upload for company logo
    //$companyLogo = ""; // Change this to the actual path or handle file upload separately
    
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
    $recruiter_id = $_POST["recruiter_id"];
    $postedby = $_POST["postedby"];
    // $featuredJob = isset($_POST["featuredJob"]) ? 1 : 0;

    $filename = $_FILES["companyLogo"]["name"];
    $tempname = $_FILES["companyLogo"]["tmp_name"];
    $folder = "./uploads/" . $filename;


    // SQL query to insert data into the database
    $sql = "INSERT INTO jobs (job_title, company_name, company_logo, job_category, job_description, employment_type, location, salary_range, skills_required, education_level, experience_level, application_deadline, contact_info, additional_info,recuiter_id, postedBy, admin_status, application_status) 
    VALUES ('$jobTitle', '$companyName', '$filename', '$jobCategory', '$jobDescription', '$employmentType', '$location', '$salaryRange', '$skillsRequired', '$educationLevel', '$experienceLevel', '$applicationDeadline', '$contactInfo', '$additionalInfo','$recruiter_id',' $postedby', 'Approved', 'active')";

    // Execute SQL query
    $sql_run = $conn->query($sql);

    // Check if query executed successfully
    if ($sql_run === TRUE) {
        // echo "New record created successfully";
        if (move_uploaded_file($tempname, $folder)) {
            echo "<h3>  Image uploaded successfully!</h3>";
        } else {
            echo "<h3>  Failed to upload image!</h3>";
        }

        header("location:viewJobs.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>



<script>
    <?php

    // messages from corect or not 
    
    if (isset($_SESSION['message'])) {
        ?>
                                    alertify.set('notifier', 'position', 'top-right');
                                    alertify.success('<?= $_SESSION['message'] ?>');
                                    <?php
                                    unset($_SESSION['message']);
    }
    ?>
</script>
