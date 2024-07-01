<?php
include "headerFiles/header.php";
// include "Database/connection.php";
// $conn = new mysqli("localhost","root", "", "BMS_JOB");
include '../Database/connection.php';



// $sql = "SELECT * FROM category";
// $category_result = mysqli_query($conn, $sql);


// ----------------- cetegory fetching datas ---------------


$categories = []; // Array to store fetched categories

// Fetch categories from database
$sql_categories = "SELECT * FROM category";
$result_categories = $conn->query($sql_categories);

if ($result_categories->num_rows > 0) {
    while ($rows = $result_categories->fetch_assoc()) {
        $categories[] = $rows;
    }
}
// ----------------- cetegory fetching datas ---------------


?>



<!-- Page Wrapper -->
<div id="wrapper">

    <?php require "nav.php"; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?php include("topNav.php"); ?>
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="javascript:history.back()">
                            <div class="circle-icon">
                                <i class="fas fa-arrow-left"></i>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800 mt-4 mb-4">Edit Job</h1>


                <?php


                // Check if the ID parameter is set
                if (isset($_GET['id'])) {

                    $jobId = $_GET['id'];

                    $sql = "SELECT * FROM jobs WHERE id = $jobId";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                        $row = mysqli_fetch_array($result);


                ?>
                        <div class="container mt-3 mb-5">

                            <form action="update_job.php" method="post" enctype="multipart/form-data">
                                <!-- Hidden input field to store job ID -->
                                <input type="hidden" name="jobId" id="editJobId" value="<?= $jobId ?>">

                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- Job Title -->
                                        <div class="form-group">
                                            <label for="editJobTitle">Job Title</label>
                                            <input type="text" class="form-control" id="editJobTitle" name="editJobTitle" value="<?= $row["job_title"] ?>">
                                        </div>


                                    </div>
                                    <div class="col-md-4">
                                        <!-- Company Name -->
                                        <div class="form-group">
                                            <label for="editCompanyName">Company Name</label>
                                            <select class="form-control" id="editCompanyName" name="editCompanyName" required>
                                                <option value="" disabled>Select Company Name</option>
                                                <?php
                                                $sql = "SELECT DISTINCT company_name, id FROM userregister WHERE company_name IS NOT NULL AND company_name <> ''";
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    while ($rowS = $result->fetch_assoc()) {
                                                        // Check if this is the current company name
                                                        $selected = ($rowS["company_name"] === $row["company_name"]) ? "selected" : "";
                                                        echo "<option value='" . htmlspecialchars($rowS["company_name"]) . "' data-id='" . $rowS["id"] . "' $selected>" . htmlspecialchars($rowS["company_name"]) . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <!-- Company Logo -->
                                        <div class="form-group">
                                            <label for="editCompanyLogo">Company Logo</label>
                                            <?php if (!empty($row["company_logo"])) : ?>
                                                <div class="mb-3">
                                                    <img src="uploads/job_posters/<?= $row["company_logo"] ?>" alt="Company Logo" class="img-thumbnail" style="max-width: 150px;">
                                                </div>
                                            <?php endif; ?>
                                            <input type="file" class="form-control-file" id="editCompanyLogo" name="editCompanyLogo">
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Job Category -->
                                        <div class="form-group">
                                            <label for="jobCategory">Job Category</label>
                                            <select class="form-control" id="category" name="category">
                                                <option value="">Select Job Category</option>
                                                <?php foreach ($categories as $category) : ?>
                                                    <option value="<?= $category['category_name']; ?>" <?php if ($category['category_name'] == $row['job_category']) echo 'selected'; ?>>
                                                        <?= $category['category_name']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Contact Info -->
                                        <div class="form-group">
                                            <label for="editContactInfo">Contact Email/Phone</label>
                                            <input type="text" class="form-control" id="editContactInfo" name="editContactInfo" value="<?= $row["contact_info"] ?>">
                                        </div>

                                    </div>
                                </div>


                                <!-- Job Description -->
                                <!-- Job Description -->
                                <div class="form-group">
                                    <label for="editJobDescription">Job Description</label>
                                    <textarea class="form-control" id="editJobDescription" name="editJobDescription" rows="4"><?= $row["job_description"] ?></textarea>
                                </div>
                                <script>
                                    // Initialize CKEditor on the textarea with custom configuration
                                    CKEDITOR.replace('editJobDescription', {
                                        height: 300,
                                        // Add additional configuration options here

                                        // You can add more configuration options here
                                    });
                                </script>




                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- Employment Type -->
                                        <div class="form-group">
                                            <label for="editEmploymentType">Employment Type</label>
                                            <select class="form-control" id="editEmploymentType" name="editEmploymentType">
                                                <option value="">Select Employment Type</option>
                                                <option value="Full-time" <?= ($row["employment_type"] == "Full-time") ? "selected" : "" ?>>Full-time</option>
                                                <option value="Part-time" <?= ($row["employment_type"] == "Part-time") ? "selected" : "" ?>>Part-time</option>
                                                <option value="Contract" <?= ($row["employment_type"] == "Contract") ? "selected" : "" ?>>Contract</option>
                                                <option value="Internship" <?= ($row["employment_type"] == "Internship") ? "selected" : "" ?>>Internship</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Location -->
                                        <div class="form-group">
                                            <label for="editLocation">Location</label>
                                            <input type="text" class="form-control" id="editLocation" name="editLocation" value="<?= $row["location"] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Salary Range -->
                                        <div class="form-group">
                                            <label for="editSalaryRange">Salary Range</label>
                                            <input type="text" class="form-control" id="editSalaryRange" name="editSalaryRange" value="<?= $row["salary_range"] ?>">
                                        </div>
                                    </div>
                                </div>


                                <!-- Skills Required -->
                                <div class="form-group">
                                    <label for="editSkillsRequired">Skills Required</label>
                                    <textarea class="form-control" id="editSkillsRequired" name="editSkillsRequired" rows="3"><?= $row["skills_required"] ?></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- Education Level -->
                                        <div class="form-group">
                                            <label for="editEducationLevel">Education Level</label>
                                            <select class="form-control" id="editEducationLevel" name="editEducationLevel">
                                                <option value="">Select Education Level</option>
                                                <option value="HighSchool" <?= ($row["education_level"] == "HighSchool") ? "selected" : "" ?>>High School</option>
                                                <option value="PhD" <?= ($row["education_level"] == "PhD") ? "selected" : "" ?>>PhD</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Experience Level -->
                                        <div class="form-group">
                                            <label for="editExperienceLevel">Experience Level</label>
                                            <select class="form-control" id="editExperienceLevel" name="editExperienceLevel">
                                                <option value="">Select Experience Level</option>
                                                <option value="Entry_Level" <?= ($row["experience_level"] == "Entry_Level") ? "selected" : "" ?>>Entry Level</option>
                                                <option value="Mid_Level" <?= ($row["experience_level"] == "Mid_Level") ? "selected" : "" ?>>Mid Level</option>
                                                <option value="Senior_Level" <?= ($row["experience_level"] == "Senior_Level") ? "selected" : "" ?>>Senior Level</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Application Deadline -->
                                        <div class="form-group">
                                            <label for="editApplicationDeadline">Application Deadline</label>
                                            <input type="date" class="form-control" id="editApplicationDeadline" name="editApplicationDeadline" value="<?= $row["application_deadline"] ?>">
                                        </div>

                                    </div>
                                </div>



                                <!-- Additional Information -->
                                <div class="form-group">
                                    <label for="editAdditionalInfo">Additional Information</label>
                                    <textarea class="form-control" id="editAdditionalInfo" name="editAdditionalInfo" rows="3"><?= $row["additional_info"] ?></textarea>
                                </div>

                                <script>
                                    // Initialize CKEditor on the textarea with custom configuration
                                    CKEDITOR.replace('editAdditionalInfo', {
                                        height: 300,
                                        // Add additional configuration options here

                                        // You can add more configuration options here
                                    });
                                </script>


                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> &nbsp; Update</button>
                            </form>

                        </div>

                <?php

                    } else {
                        echo "No job found with ID: $jobId";
                    }
                } else {
                    echo "No ID parameter provided.";
                }

                ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->



    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<?php


?>