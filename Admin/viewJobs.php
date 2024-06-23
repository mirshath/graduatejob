<?php
include "headerFiles/header.php";
// include "Database/connection.php";
// $conn = new mysqli("localhost", "root", "", "BMS_JOB");
include '../Database/connection.php';




// --------------------- update jobs status from admin_side ----------------------------------

// Check if the form is submitted and required data is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id']) && isset($_POST['status'])) {
    $postId = $_POST['post_id'];
    $status = $_POST['status'];

    // Prepare and execute the SQL query to update the status
    $updateStatusSql = "UPDATE jobs SET admin_status ='$status' WHERE id=$postId";
    if ($conn->query($updateStatusSql) === TRUE) {
        // Set a success message
        $_SESSION['message'] = "Successfully updated the status.";

        // Redirect back to the previous page
        header("Location: viewJobs.php");
        exit();
    } else {
        // If there's an error, display it
        echo "Error updating status: " . $conn->error;
    }
}


// --------------------- END update jobs status from admin_side ----------------------------------


// --------------------- select and fetching the category  ---------------------

$sql = "SELECT * FROM category";
$results = mysqli_query($conn, $sql);

// --------------------- END select and fetching the category  ---------------------


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

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Jobs Listing</h1>
                <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->



                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addJobModal">Add
                    New Job</button>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Job Listing</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Job Title</th>
                                        <th class="text-center">Company Name</th>
                                        <!-- <th class="text-center">Images</th> -->
                                        <th class="text-center">Job Category</th>
                                        <th class="text-center">Job Post Date</th>
                                        <th class="text-center">Job Deadline</th>
                                        <th class="text-center">Action</th>

                                    </tr>
                                </thead>
                                <!-- <tfoot>
                                        <tr>
                                            <th>Job Title</th>
                                            <th>Company Name</th>
                                            <th>Company Logo</th>
                                            <th>Job Category</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot> -->
                                <tbody>

                                    <?php
                                    // user fetch code 
                                    // Fetch data from the database
                                    $sql = "SELECT * FROM jobs WHERE admin_status = 'Approved' AND application_status='active' ";
                                    $sql_run = mysqli_query($conn, $sql);


                                    // Check if there are any results
                                    if ($sql_run->num_rows > 0) {
                                        // Output data rows
                                        while ($row = mysqli_fetch_array($sql_run)) {
                                    ?>
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <?= $row["job_title"]; ?>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <?= $row["company_name"]; ?>
                                                </td>
                                                <!-- <td style="text-align: center; vertical-align: middle;">
                                                    <img src="uploads/<?= $row["company_logo"]; ?>" alt="Company Logo" style="max-width: 50px; max-height: 50px; border-radius: 25px;">
                                                </td> -->


                                                <td style="text-align: center; vertical-align: middle;">
                                                    <?= $row["job_category"]; ?>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <?= $row["created_at"]; ?>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <?= $row["application_deadline"]; ?> <br>
                                                    <?php
                                                    if ($row["application_deadline"] < date("Y-m-d")) {
                                                        echo "<span class='badge badge-danger'>Date Expired</span>";
                                                    } else {
                                                        echo "<span class='badge badge-success'>Active</span>";
                                                    }

                                                    ?>
                                                </td>



                                                <td style="text-align: center; vertical-align: middle;">
                                                    <!-- Edit and View buttons -->
                                                    <a href='edit_job.php?id=<?php echo $row["id"]; ?>' class='btn btn-primary btn-sm'><i class="fas fa-edit"></i> </a>

                                                    <!-- <a href='view_job.php?id=<?php echo $row["id"]; ?>' class='btn btn-primary btn-sm'>View</a> -->

                                                    <!-- Delete button -->
                                                    <!-- <a href='delete.php?id=<?php echo $row["id"]; ?>' class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this job?')"><i class="fas fa-trash-alt"></i></a> -->

                                                    <a href="delete.php?type=job&id=<?= $row["id"] ?>" class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this user?')">
                                                        <i class="fas fa-trash-alt"></i></a>


                                                    <form method="POST" action="" style="display: inline-block; margin-top: 10px; margin-bottom: 10px;">
                                                        <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton_<?php echo $row['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Choose Status
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $row['id']; ?>">
                                                                <!-- <button class="dropdown-item" type="submit" name="status" value="Approved">Approve</button> -->
                                                                <button class="dropdown-item" type="submit" name="status" value="Pending">Pending</button>
                                                                <button class="dropdown-item" type="submit" name="status" value="Rejected">Reject</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php

                                        }
                                    }

                                    ?>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <!------------------------------------ Add model -------------------------- -->
                <div class="modal fade " id="addJobModal" tabindex="-1" role="dialog" aria-labelledby="addJobModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addJobModalLabel">Add New Job</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Add your form for adding a new job here -->
                                <form action="submit_job.php" method="post" enctype="multipart/form-data">

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jobTitle">Job Title</label>
                                                <input type="text" class="form-control" id="jobTitle" placeholder="Job title" name="jobTitle" required>
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="companyName">Company Name</label>
                                                <select class="form-control" id="companyName" name="companyName" required>
                                                    <option value="">Select Company Name</option>
                                                    <?php
                                                    // Fetch non-empty company names from the database
                                                    $sql = "SELECT DISTINCT company_name, id FROM userregister WHERE company_name IS NOT NULL AND company_name <> ''";
                                                    $result = $conn->query($sql);

                                                    // Check if there are any results
                                                    if ($result->num_rows > 0) {
                                                        // Output data rows
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<option value='" . $row["company_name"] . "' data-id='" . $row["id"] . "'>" . $row["company_name"] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" id="recruiter_id" name="recruiter_id" value="">
                                            </div>
                                        </div>



                                        <script>
                                            // JavaScript to update the value of the input field when the select element changes
                                            document.getElementById("companyName").addEventListener("change", function() {
                                                var selectedOption = this.options[this.selectedIndex];
                                                var recruiterIdInput = document.getElementById("recruiter_id");
                                                recruiterIdInput.value = selectedOption.getAttribute('data-id'); // Set the value of the input field to the data-id attribute of the selected option
                                            });
                                        </script>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="companyLogo">Company Logo</label>
                                                <input type="file" class="form-control-file" id="companyLogo" name="companyLogo">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jobCategory">Job Category/Industry</label>
                                                <select class="form-control" id="jobCategory" name="jobCategory" required>
                                                    <option value="">Select Category</option>
                                                    <?php


                                                    if (mysqli_num_rows($results) > 0) {
                                                        while ($rows = mysqli_fetch_array($results)) {
                                                            echo "<option value='" . $rows['category_name'] . "'>" . $rows['category_name'] . "</option>";
                                                        }
                                                    }


                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="companyId" name="companyId" value="">
                                            </div>
                                        </div>
                                        
                                    </div>


                                    <div class="form-group">
                                        <label for="jobDescription">Job Description</label>
                                        <textarea class="form-control" placeholder="Description Here" id="jobDescription" name="jobDescription" rows="4" required></textarea>
                                    </div>


                                    <div class="form-group">
                                        <label for="employmentType">Employment Type</label>
                                        <select class="form-control" id="employmentType" name="employmentType" required>
                                            <option value="">Select Employment Type</option>
                                            <option value="Full-time">Full-time</option>
                                            <option value="Part-time">Part-time</option>
                                            <option value="Contract">Contract</option>
                                            <option value="Internship">Internship</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="location">Location</label>
                                                <input type="text" placeholder="Location Here" class="form-control" id="location" name="location" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="salaryRange">Salary Range</label>
                                                <input type="text" placeholder="Salary " class="form-control" id="salaryRange" name="salaryRange" required>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="skillsRequired">Skills Required</label>
                                        <textarea class="form-control" placeholder="please use (,) to separate skills like ABC, BCE" id="skillsRequired" name="skillsRequired" rows="3" required></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="educationLevel">Education Level</label>
                                                <select class="form-control" id="educationLevel" name="educationLevel" required>
                                                    <option value="">Select Education Level</option>
                                                    <option value="HighSchool">High School</option>
                                                    <option value="PhD">PhD</option>
                                                    <!-- Add more options as needed -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="experienceLevel">Experience Level</label>
                                                <select class="form-control" id="experienceLevel" name="experienceLevel" required>
                                                    <option value="" disa>Select Experience Level</option>
                                                    <option value="Entry_Level">Entry Level</option>
                                                    <option value="Mid_Level">Mid Level</option>
                                                    <option value="Senior_Level">Senior Level</option>
                                                    <!-- Add more options as needed -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="applicationDeadline">Application Deadline</label>
                                                <input type="date" class="form-control" id="applicationDeadline" name="applicationDeadline" required>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="contactInfo">Phone</label>
                                                <input type="text" class="form-control" placeholder="Contact no" id="contactInfo" name="contactInfo" required>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="additionalInfo">Additional Information</label>
                                        <textarea class="form-control" placeholder="Additional Information " id="additionalInfo" name="additionalInfo" rows="3"></textarea>
                                    </div>


                                    <div class="form-group">
                                        <!-- <label for="contactInfo">Posted By</label> -->
                                        <input type="hidden" class="form-control" id="postedby" name="postedby" value="Admin" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- -------------------------------edit model  ---------------------------->

                <div class="modal fade" id="editJobModal" tabindex="-1" role="dialog" aria-labelledby="editJobModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editJobModalLabel">Edit Job Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="update_job.php" method="post" enctype="multipart/form-data">
                                    <!-- Hidden input field to store job ID -->
                                    <input type="hidden" name="jobId" id="editJobId">
                                    <!-- Job Title -->
                                    <div class="form-group">
                                        <label for="editJobTitle">Job Title</label>
                                        <input type="text" class="form-control" id="editJobTitle" name="editJobTitle">
                                    </div>
                                    <!-- Company Name -->
                                    <div class="form-group">
                                        <label for="editCompanyName">Company Name</label>
                                        <input type="text" class="form-control" id="editCompanyName" name="editCompanyName">
                                    </div>
                                    <!-- Company Logo -->
                                    <div class="form-group">
                                        <label for="editCompanyLogo">Company Logo</label>
                                        <input type="file" class="form-control-file" id="editCompanyLogo" name="editCompanyLogo">
                                    </div>
                                    <!-- Job Category -->
                                    <div class="form-group">
                                        <label for="editJobCategory">Job Category/Industry</label>
                                        <select class="form-control" id="editJobCategory" name="editJobCategory">
                                            <option value="">Select Category</option>
                                            <option value="IT">IT</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="Finance">Finance</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>
                                    <!-- Job Description -->
                                    <div class="form-group">
                                        <label for="editJobDescription">Job Description</label>
                                        <textarea class="form-control" id="editJobDescription" name="editJobDescription" rows="4"></textarea>
                                    </div>
                                    <!-- Employment Type -->
                                    <div class="form-group">
                                        <label for="editEmploymentType">Employment Type</label>
                                        <select class="form-control" id="editEmploymentType" name="editEmploymentType">
                                            <option value="">Select Employment Type</option>
                                            <option value="Full-time">Full-time</option>
                                            <option value="Part-time">Part-time</option>
                                            <option value="Contract">Contract</option>
                                            <option value="Internship">Internship</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>
                                    <!-- Location -->
                                    <div class="form-group">
                                        <label for="editLocation">Location</label>
                                        <input type="text" class="form-control" id="editLocation" name="editLocation">
                                    </div>
                                    <!-- Salary Range -->
                                    <div class="form-group">
                                        <label for="editSalaryRange">Salary Range</label>
                                        <input type="text" class="form-control" id="editSalaryRange" name="editSalaryRange">
                                    </div>
                                    <!-- Skills Required -->
                                    <div class="form-group">
                                        <label for="editSkillsRequired">Skills Required</label>
                                        <textarea class="form-control" id="editSkillsRequired" name="editSkillsRequired" rows="3"></textarea>
                                    </div>
                                    <!-- Education Level -->
                                    <div class="form-group">
                                        <label for="editEducationLevel">Education Level</label>
                                        <select class="form-control" id="editEducationLevel" name="editEducationLevel">
                                            <option value="">Select Education Level</option>
                                            <option value="High School">High School</option>
                                            <option value="Bachelor's Degree">Bachelor's Degree</option>
                                            <option value="Master's Degree">Master's Degree</option>
                                            <option value="PhD">PhD</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>
                                    <!-- Experience Level -->
                                    <div class="form-group">
                                        <label for="editExperienceLevel">Experience Level</label>
                                        <select class="form-control" id="editExperienceLevel" name="editExperienceLevel">
                                            <option value="">Select Experience Level</option>
                                            <option value="Entry Level">Entry Level</option>
                                            <option value="Mid Level">Mid Level</option>
                                            <option value="Senior Level">Senior Level</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>
                                    <!-- Application Deadline -->
                                    <div class="form-group">
                                        <label for="editApplicationDeadline">Application Deadline</label>
                                        <input type="date" class="form-control" id="editApplicationDeadline" name="editApplicationDeadline">
                                    </div>
                                    <!-- Contact Info -->
                                    <div class="form-group">
                                        <label for="editContactInfo">Contact Email/Phone</label>
                                        <input type="text" class="form-control" id="editContactInfo" name="editContactInfo">
                                    </div>
                                    <!-- Additional Information -->
                                    <div class="form-group">
                                        <label for="editAdditionalInfo">Additional Information</label>
                                        <textarea class="form-control" id="editAdditionalInfo" name="editAdditionalInfo" rows="3"></textarea>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>




<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>






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