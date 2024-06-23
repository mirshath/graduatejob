<?php

session_start();
include("../Database/connection.php");

if (!isset($_SESSION['user_id'])) {
    header("location: ../index.php");
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $jobId = $_POST["jobId"];
    $AdminStatus = $_POST["AdminStatus"];
    $editJobTitle = $_POST["editJobTitle"];
    $editCompanyName = $_POST["editCompanyName"];
    $editJobCategory = isset($_POST["editJobCategory"]) ? $_POST["editJobCategory"] : null; // Fix the undefined array key issue
    $editJobDescription = $_POST["editJobDescription"];
    $editEmploymentType = $_POST["editEmploymentType"];
    $editLocation = $_POST["editLocation"];
    $editSalaryRange = $_POST["editSalaryRange"];
    $editSkillsRequired = $_POST["editSkillsRequired"];
    $editEducationLevel = $_POST["editEducationLevel"];
    $editExperienceLevel = $_POST["editExperienceLevel"];
    $editApplicationDeadline = $_POST["editApplicationDeadline"];
    $editContactInfo = $_POST["editContactInfo"];
    $editAdditionalInfo = $_POST["editAdditionalInfo"];

    // Handle file upload for company logo
    $companyLogo = null;
    if (isset($_FILES["editCompanyLogo"]) && $_FILES["editCompanyLogo"]["error"] == 0) {
        $target_dir = "../Admin/uploads/";
        $target_file = $target_dir . basename($_FILES["editCompanyLogo"]["name"]);
        if (move_uploaded_file($_FILES["editCompanyLogo"]["tmp_name"], $target_file)) {
            $companyLogo = $_FILES["editCompanyLogo"]["name"];
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Base SQL query to update data in the database using prepared statements
    $sql = "UPDATE jobs SET 
            job_title = ?, 
            company_name = ?, 
            job_category = ?, 
            job_description = ?, 
            employment_type = ?, 
            location = ?, 
            salary_range = ?, 
            skills_required = ?, 
            education_level = ?, 
            experience_level = ?, 
            application_deadline = ?, 
            contact_info = ?, 
            additional_info = ?,
            admin_status = ?";

    // Append company_logo update if a new logo was uploaded
    if ($companyLogo !== null) {
        $sql .= ", company_logo = ?";
    }

    $sql .= " WHERE id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters accordingly
    if ($companyLogo !== null) {
        $stmt->bind_param(
            "sssssssssssssssi",
            $editJobTitle,
            $editCompanyName,
            $editJobCategory,
            $editJobDescription,
            $editEmploymentType,
            $editLocation,
            $editSalaryRange,
            $editSkillsRequired,
            $editEducationLevel,
            $editExperienceLevel,
            $editApplicationDeadline,
            $editContactInfo,
            $editAdditionalInfo,
            $AdminStatus,
            $companyLogo,
            $jobId
        );
    } else {
        $stmt->bind_param(
            "ssssssssssssssi",
            $editJobTitle,
            $editCompanyName,
            $editJobCategory,
            $editJobDescription,
            $editEmploymentType,
            $editLocation,
            $editSalaryRange,
            $editSkillsRequired,
            $editEducationLevel,
            $editExperienceLevel,
            $editApplicationDeadline,
            $editContactInfo,
            $editAdditionalInfo,
            $AdminStatus,
            $jobId
        );
    }

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['message'] = "Updated Successfully. Wait for Admin Aprove";
        header("location: job_listing"); // Redirect to job_listing.php
        exit; // Ensure script stops here
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

?>
