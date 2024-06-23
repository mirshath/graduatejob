<?php
include "headerFiles/header.php";
// include "Database/connection.php";
// $conn = new mysqli("localhost", "root", "", "BMS_JOB");
include '../Database/connection.php';




// add category PHP code 

if (isset($_POST['category_adding_btn'])) {
    $category_name = $_POST['category_name'];

    $sql = "INSERT INTO category (category_name) VALUES ('$category_name')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Category added successfully";
    } else {
        $_SESSION['message'] = "Error adding category: " . $conn->error;
    }

    $conn->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}



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
                <h1 class="h3 mb-2 text-gray-800">Categories</h1>
                <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->



                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addJobModal">Add New Job</button>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">category Listing</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>category_name</th>

                                        <th>Created_at</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    // Fetch data from the database
                                    $sql = "SELECT * FROM category ORDER BY id DESC";
                                    $sql_run = mysqli_query($conn, $sql);


                                    // Check if there are any results
                                    if ($sql_run->num_rows > 0) {
                                        // Output data rows
                                        while ($row = mysqli_fetch_array($sql_run)) {
                                    ?>
                                            <tr>
                                                <td> <?= $row["category_name"]; ?></td>

                                                <td> <?= $row["created_at"]; ?></td>
                                                <td>
                                                    <!-- Edit and View buttons -->
                                                    <!-- <a href='edit_job.php?id=<?php echo $row["id"]; ?>' class='btn btn-primary btn-sm'><i class="fas fa-edit"></i></a> -->

                                                    <!-- <a href='view_job.php?id=<?php echo $row["id"]; ?>' class='btn btn-primary btn-sm'>View</a> -->

                                                    <!-- Delete button -->
                                                    <!-- <a href='delete.php?type=category&id=<?php echo $row["category_name"]; ?>' class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this category?')"> <i class="fas fa-trash-alt"></i></a> -->
                                                    <a href="delete.php?type=category&id=<?php echo htmlspecialchars($row['category_name'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>

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
                                <h5 class="modal-title" id="addJobModalLabel">Add New Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Add your form for adding a new job here -->
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="catNm">Category Name</label>
                                                <input type="text" class="form-control" id="category_name" name="category_name" required onblur="capitalizeInput(this)">
                                            </div>

                                            <script>
                                                function capitalizeInput(input) {
                                                    // Get the input value
                                                    var value = input.value;
                                                    // Capitalize the first letter of each word
                                                    value = value.toLowerCase().replace(/\b\w/g, function(char) {
                                                        return char.toUpperCase();
                                                    });
                                                    // Update the input value
                                                    input.value = value;
                                                }
                                            </script>

                                        </div>
                                    </div>
                                    <button type="submit" name="category_adding_btn" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- -------------------------------edit model  ---------------------------->
                <!-- Edit Job Modal -->
                <!-- Edit Job Modal -->


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