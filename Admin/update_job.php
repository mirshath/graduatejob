<?php

// include "Database/connection.php";
// $conn = new mysqli("localhost", "root", "", "BMS_JOB");
include '../Database/connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $jobId = $_POST["jobId"];
    $editJobTitle = $_POST["editJobTitle"];
    $editCompanyName = $_POST["editCompanyName"];
    $editJobCategory = $_POST["category"];
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
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["editCompanyLogo"]["name"]);
        if (move_uploaded_file($_FILES["editCompanyLogo"]["tmp_name"], $target_file)) {
            $companyLogo = $_FILES["editCompanyLogo"]["name"];
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // SQL query to update data in the database
    $sql = "UPDATE jobs SET 
            job_title = '$editJobTitle', 
            company_name = '$editCompanyName', 
            job_category = '$editJobCategory', 
            job_description = '$editJobDescription', 
            employment_type = '$editEmploymentType', 
            location = '$editLocation', 
            salary_range = '$editSalaryRange', 
            skills_required = '$editSkillsRequired', 
            education_level = '$editEducationLevel', 
            experience_level = '$editExperienceLevel', 
            application_deadline = '$editApplicationDeadline', 
            contact_info = '$editContactInfo', 
            additional_info = '$editAdditionalInfo'";

    // Append company_logo update if a new logo was uploaded
    if ($companyLogo !== null) {
        $sql .= ", company_logo = '$companyLogo'";
    }

    $sql .= " WHERE id = $jobId";

    // Execute SQL query
    $sql_run = $conn->query($sql);

    // Check if query executed successfully
    if ($sql_run === TRUE) {
        echo "Record updated successfully";
        header("location: viewJobs.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
