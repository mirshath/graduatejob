<?php
include "../Database/connection.php";
include "headerFiles/header.php";

session_start();
if (!isset($_SESSION['username'])) {
  header("location: login.php");
  exit();
}

$getUsers = "SELECT * FROM userregister WHERE usertype='recruiter'";
$getUsers_run = mysqli_query($conn, $getUsers);

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
        <h1 class="h3 mb-2 mt-4 text-gray-800">Registered Companies</h1>
        <!-- <p class="mb-4"> <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>
 -->


        <!-- DataTales Example -->
        <div class="card shadow mb-4 mt-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User views</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th class="text-center">Company Profile</th>
                    <th class="text-center">Company Name</th>
                    <th class="text-center">Company Email</th>
                    <th class="text-center">Action</th>

                  </tr>
                </thead>
                <!-- <tfoot>
                                        <tr>
                                          <th>First Name</th>
                                              <th>Last Name</th>
                                              <th>Email</th>
                                              <th>profile</th>
                                              <th>Action</th>
                                        </tr>
                                    </tfoot> -->
                <tbody>


                  <?php

                  if (mysqli_num_rows($getUsers_run) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_assoc($getUsers_run)) {


                  ?>
                      <tr>
                        <td style="text-align: center; vertical-align: middle;">
                          <img src="uploads/company_profiles/<?= $row["profile"]; ?>" alt="Company Logo" style="max-width: 50px; max-height: 50px; border-radius: 25px;">

                        </td>
                        <td style="text-align: center; vertical-align: middle;"> <?= $row["company_name"] ?> </td>
                        <td style="text-align: center; vertical-align: middle;"><?= $row["email"] ?></td>

                        <td style="text-align: center; vertical-align: middle;">
                          <a href='company_edit.php?id=<?php echo $row["id"]; ?>' class='btn btn-primary btn-sm'><i class="fas fa-edit"></i></a>
                          <a href='company_view_details.php?id=<?php echo $row["id"]; ?>' class='btn btn-primary btn-sm'><i class="fas fa-eye"></i></a>

                          <!-- <a href='delete.php?id=<?php echo $row["id"]; ?>' class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this job?')">Delete</a> -->
                          <a href="delete.php?type=user&id=<?= $row["id"] ?>" class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this user?')"> <i class="fas fa-trash-alt"></i></a>

                        </td>
                      </tr>


                  <?php
                    }
                  } else {
                    echo "0 results";
                  }


                  ?>





                </tbody>
              </table>
            </div>
          </div>
        </div>


        <!-- Add model  -->
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
                        <input type="text" class="form-control" id="jobTitle" name="jobTitle" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="companyName">Company Name</label>
                        <input type="text" class="form-control" id="companyName" name="companyName" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <!-- Co mpany Logo -->
                      <div class="form-group">
                        <label for="editCompanyLogo">Company Logo</label>
                        <?php if (!empty($row["company_logo"])) : ?>
                          <div class="mb-3">
                            <img src="uploads/<?= $row["company_logo"] ?>" alt="Company Logo" class="img-thumbnail" style="max-width: 150px;">
                          </div>
                        <?php endif; ?>
                        <input type="file" class="form-control-file" id="editCompanyLogo" name="editCompanyLogo">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="jobCategory">Job Category/Industry</label>
                        <select class="form-control" id="jobCategory" name="jobCategory" required>
                          <option value="">Select Category</option>
                          <option value="IT">IT</option>
                          <option value="Marketing">Marketing</option>
                          <option value="Finance">Finance</option>
                          <!-- Add more options as needed -->
                        </select>
                      </div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="jobDescription">Job Description</label>
                    <textarea class="form-control" id="jobDescription" name="jobDescription" rows="4" required></textarea>
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
                        <input type="text" class="form-control" id="location" name="location" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="salaryRange">Salary Range</label>
                        <input type="text" class="form-control" id="salaryRange" name="salaryRange" required>
                      </div>

                    </div>
                  </div>

                  <div class="form-group">
                    <label for="skillsRequired">Skills Required</label>
                    <textarea class="form-control" id="skillsRequired" name="skillsRequired" rows="3" required></textarea>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="educationLevel">Education Level</label>
                        <select class="form-control" id="educationLevel" name="educationLevel" required>
                          <option value="">Select Education Level</option>
                          <option value="High School">High School</option>
                          <option value="Bachelor's Degree">Bachelor's Degree</option>
                          <option value="Master's Degree">Master's Degree</option>
                          <option value="PhD">PhD</option>
                          <!-- Add more options as needed -->
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="experienceLevel">Experience Level</label>
                        <select class="form-control" id="experienceLevel" name="experienceLevel" required>
                          <option value="">Select Experience Level</option>
                          <option value="Entry Level">Entry Level</option>
                          <option value="Mid Level">Mid Level</option>
                          <option value="Senior Level">Senior Level</option>
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
                        <label for="contactInfo">Contact Email/Phone</label>
                        <input type="text" class="form-control" id="contactInfo" name="contactInfo" required>
                      </div>

                    </div>
                  </div>

                  <div class="form-group">
                    <label for="additionalInfo">Additional Information</label>
                    <textarea class="form-control" id="additionalInfo" name="additionalInfo" rows="3"></textarea>
                  </div>


                  <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="featuredJob" name="featuredJob">
                    <label class="form-check-label" for="featuredJob">Featured Job</label>
                  </div>

                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>


        <!-- deleting model  -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Are you sure you want to delete this job listing?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger">Delete</button>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

</div>
<?php include("footer.php");  ?>





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