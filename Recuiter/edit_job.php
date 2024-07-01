<?php
session_start();
include "include/header.php";
include("../Database/connection.php");


// $re_name = $_SESSION['first_name'];
$re_email = $_SESSION['user_email'];


if (!isset($_SESSION['user_id'])) {
    header("location: ../index.php");
}


// $sql = "SELECT * FROM category";
// $categrory_result = mysqli_query($conn, $sql);

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


<link rel="stylesheet" href="style.css">

<body>




    <!-- SIDEBAR -->
    <?php include("include/sidenav.php"); ?>
    <!-- SIDEBAR -->






    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <?php include("include/nav.php"); ?>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Job Edit </h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="index">View </a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a href="index">Job Listing </a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a class="active" href="job_listing"> Edit jobs </a>
                        </li>
                    </ul>
                </div>
                <a href="#" class="btn-download">
                    <i class="bx bxs-cloud-download"></i>
                    <span class="text">Download PDF</span>
                </a>
            </div>


            <!-- ------------------------- -->

            <?php

            // Check if the ID parameter is set
            if (isset($_GET['id'])) {

                $jobId = $_GET['id'];

                $sql = "SELECT * FROM jobs WHERE id = $jobId";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    $row = mysqli_fetch_array($result);

            ?>
                    <div class="container mt-3 mb-4">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="javascript:history.back()">
                                    <div class="circle-icon">
                                        <i class="fas fa-arrow-left"></i>
                                    </div>
                                </a>
                            </div>
                        </div>


                        <h3 class="text-center mt-5 mb-5 text-muted ">Update Jobs </h3>
                        <hr>
                        <div class="">
                            <form action="update_job.php" method="post" enctype="multipart/form-data">
                                <!-- Hidden input field to store job ID -->
                                <input type="hidden" name="jobId" id="editJobId" value="<?= $jobId ?>">
                                <input type="hidden" name="AdminStatus" id="AdminStatus" value="Pending">

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
                                            <input type="text" class="form-control" id="editCompanyName" readonly name="editCompanyName" value="<?= $row["company_name"] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Company Logo -->
                                        <div class="form-group">
                                            <label for="editCompanyLogo">Poster</label>
                                            <?php if (!empty($row["company_logo"])) : ?>
                                                <div class="mb-3">
                                                    <img src="../Admin/uploads/job_posters/<?= $row["company_logo"] ?>" alt="Company Logo" class="img-thumbnail" style="max-width: 150px;">
                                                </div>
                                            <?php endif; ?>
                                            <input type="file" class="form-control-file" id="editCompanyLogo" name="editCompanyLogo">
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- Job Category -->
                                        <div class="form-group">
                                            <label for="jobCategory">Job Category/Industry</label>
                                            <select class="form-control" id="editJobCategory" name="editJobCategory">
                                                <option value="">Select Job Category</option>
                                                <?php foreach ($categories as $category) : ?>
                                                    <option value="<?= $category['category_name']; ?>" <?php if ($category['category_name'] == $row['job_category']) echo 'selected'; ?>>
                                                        <?= $category['category_name']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-4 mb-4">
                                        <!-- Contact Info -->
                                        <div class="form-group">
                                            <label for="editContactInfo">Contact Email/Phone</label>
                                            <input type="text" class="form-control" id="editContactInfo" name="editContactInfo" value="<?= $row["contact_info"] ?>">
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4 mb-4">
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


                                    <div class="col-md-4 mb-4">
                                        <!-- Location -->
                                        <div class="form-group">
                                            <label for="editLocation">Location</label>
                                            <input type="text" class="form-control" id="editLocation" name="editLocation" value="<?= $row["location"] ?>">
                                        </div>
                                    </div>


                                    <div class="col-md-4 mb-4">
                                        <!-- Salary Range -->
                                        <div class="form-group">
                                            <label for="editSalaryRange">Salary Range</label>
                                            <input type="text" class="form-control" id="editSalaryRange" name="editSalaryRange" value="<?= $row["salary_range"] ?>">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4 mb-4">
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

                                <!-- Skills Required -->
                                <div class="form-group mb-4">
                                    <label for="editSkillsRequired">Skills Required</label>
                                    <textarea class="form-control" id="editSkillsRequired" name="editSkillsRequired" rows="3"><?= $row["skills_required"] ?></textarea>
                                </div>


                                <!-- Job Description -->
                                <!-- Job Description -->
                                <div class="form-group mb-4">
                                    <label for="editJobDescription">Job Description</label>
                                    <textarea class="form-control " id="editJobDescription" name="editJobDescription" rows="4"><?= $row["job_description"] ?></textarea>
                                    <script>
                                        // Initialize CKEditor on the textarea with custom configuration
                                        CKEDITOR.replace('editJobDescription', {
                                            height: 300,
                                            toolbar: [{
                                                    name: 'document',
                                                    items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates']
                                                },
                                                {
                                                    name: 'clipboard',
                                                    items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                                                },
                                                {
                                                    name: 'editing',
                                                    items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                                                },
                                                {
                                                    name: 'insert',
                                                    items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar']
                                                },
                                                '/',
                                                {
                                                    name: 'basicstyles',
                                                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']
                                                },
                                                {
                                                    name: 'paragraph',
                                                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']
                                                },
                                                {
                                                    name: 'styles',
                                                    items: ['Styles', 'Format', 'Font', 'FontSize']
                                                },
                                                {
                                                    name: 'colors',
                                                    items: ['TextColor', 'BGColor']
                                                },
                                                {
                                                    name: 'tools',
                                                    items: ['Maximize', 'ShowBlocks']
                                                }
                                            ],
                                            // Add additional configuration options here

                                            // You can add more configuration options here
                                        });
                                    </script>
                                </div>








                                <!-- Additional Information -->
                                <div class="form-group mb-4">
                                    <label for="editAdditionalInfo">Additional Information</label>
                                    <textarea class="form-control" id="editAdditionalInfo" name="editAdditionalInfo" rows="3"><?= $row["additional_info"] ?></textarea>
                                    <script>
                                        // Initialize CKEditor on the textarea with custom configuration
                                        CKEDITOR.replace('editAdditionalInfo', {
                                            height: 200,
                                            toolbar: [{
                                                    name: 'document',
                                                    items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates']
                                                },
                                                {
                                                    name: 'clipboard',
                                                    items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                                                },
                                                {
                                                    name: 'editing',
                                                    items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                                                },
                                                {
                                                    name: 'insert',
                                                    items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar']
                                                },
                                                '/',
                                                {
                                                    name: 'basicstyles',
                                                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']
                                                },
                                                {
                                                    name: 'paragraph',
                                                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']
                                                },
                                                {
                                                    name: 'styles',
                                                    items: ['Styles', 'Format', 'Font', 'FontSize']
                                                },
                                                {
                                                    name: 'colors',
                                                    items: ['TextColor', 'BGColor']
                                                },
                                                {
                                                    name: 'tools',
                                                    items: ['Maximize', 'ShowBlocks']
                                                }
                                            ],
                                            // Add additional configuration options here

                                            // You can add more configuration options here
                                        });
                                    </script>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>


                    </div>

            <?php

                } else {
                    echo "No job found with ID: $jobId";
                }
            } else {
                echo "No ID parameter provided.";
            }



            ?>


            <!-- ------------------------- -->






        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="script.js"></script>


    <?php
    ?>