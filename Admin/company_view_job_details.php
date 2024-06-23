<?php
session_start();
include "headerFiles/header.php";
include '../Database/connection.php';

// ------------- update company profiles 


// -------------------- END update Company Profiles ---------------------- 




?>

<style>
    .circle-img {
        border-radius: 50%;
        width: 300px;
    }

    .bbb {
        margin-top: 100px;
    }
</style>

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
                <?php
                if (isset($_GET['id'])) {
                    $jobId = $_GET['id'];
                    $sql = "SELECT * FROM jobs WHERE id = $jobId";
                    $result = $conn->query($sql);

                    // Pagination logic
                    $jobsPerPage = 4; // Number of jobs to display per page
                    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                    $offset = ($page - 1) * $jobsPerPage;

                    // Count total jobs for pagination
                    $totalJobsQuery = "SELECT COUNT(*) AS total FROM jobs WHERE recuiter_id = $jobId";
                    $totalJobsResult = $conn->query($totalJobsQuery);
                    $totalJobsRow = $totalJobsResult->fetch_assoc();
                    $totalJobs = $totalJobsRow['total'];
                    $totalPages = ceil($totalJobs / $jobsPerPage);

                    // Fetch jobs with pagination
                    $get_all_job_recruiter = "SELECT * FROM jobs WHERE recuiter_id = $jobId LIMIT $offset, $jobsPerPage";
                    $get_all_job_recruiter_run = $conn->query($get_all_job_recruiter);

                    if ($result->num_rows > 0) {
                        $user = mysqli_fetch_array($result);
                ?>

                        <div class="">
                            <div class="row">
                                <div class="col-md-12 mt-3 mb-5">
                                    <a href="javascript:history.back()">
                                        <div class="circle-icon">
                                            <i class="fas fa-arrow-left"></i>
                                        </div>
                                    </a>
                                </div>

                                <!-- new trying  -->
                                <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

                                <style>
                                    .cover-image {
                                        width: 100%;
                                        height: 100%;
                                        object-fit: cover;
                                    }
                                </style>
                                <div class="container">
                                    <div class="card overflow-hidden">
                                        <div class="card-body p-0">
                                            <img src="https://png.pngtree.com/thumb_back/fh260/background/20230611/pngtree-blue-and-dark-colored-wave-graphics-on-black-background-image_2925150.jpg" style="width: 100%; height: 150px; ;" alt="" class="img-fluid cover-image">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4 order-lg-1 order-2">
                                                    <div class="d-flex align-items-center justify-content-around m-4">
                                                        <div class="text-center">
                                                            <h4 class="mb-0 fw-semibold lh-1">938</h4>
                                                            <p class="mb-0 fs-4">Posts</p>
                                                        </div>
                                                        <div class="text-center">
                                                            <h4 class="mb-0 fw-semibold lh-1">3,586</h4>
                                                            <p class="mb-0 fs-4">Followers</p>
                                                        </div>
                                                        <div class="text-center">
                                                            <h4 class="mb-0 fw-semibold lh-1">2,659</h4>
                                                            <p class="mb-0 fs-4">Following</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 mt-n3 order-lg-2 order-1">
                                                    <div class="mt-n5">
                                                        <div class="d-flex align-items-center justify-content-center mb-2">
                                                            <div class="linear-gradient d-flex align-items-center justify-content-center rounded-circle" style="width: 110px; height: 110px;">
                                                                <div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden" style="width: 110px; height: 110px;">
                                                                    <?php if (!empty($user["profile"])) : ?>
                                                                        <div class="mb-3 mr-3">
                                                                            <img src="uploads/company_profiles/<?= $user['profile'] ?>" alt="Profile Image" class="img-fluid shadow" style="border-radius: 50%; margin-left: 8px; margin-top: 15px;">
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                            <h5 class="fs-5 mb-0 fw-semibold">
                                                                <b><?= $user['company_name'] ?></b>
                                                            </h5>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-lg-4 order-last">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- new trying  -->
                                <!-- new trying  -->





                                <!-- ------------------------------------------------ new trying  -->




                                <style>
                                    .row {
                                        justify-content: center;
                                    }
                                </style>







                                <!-- ------------------------------------------------ new trying  -->




                                <!-- --------------------------------  -->



                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                ?>

                                        <!-- 
                        <div class="table-data">
                            <div class="mt-4 mb-4">
                                <h3 class="text-center mt-3 mb-3 text-muted">

                                </h3>
                                <div class="">
                                    <div class="">
                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <div class=" p-3">
                                                    <div class="">
                                                        <h3> <?= $row['company_name'] . " ( " . $row['job_title'] . " )" ?></h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <?php if (!empty($row["company_logo"])) : ?>
                                                                <div class="mb-3">
                                                                    <img src="../Admin/uploads/<?= $row["company_logo"] ?>" alt="Company Logo" class="img-thumbnail" style="max-width: 150px;">
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="">
                                                    <div class="">
                                                        <div class="p-5">
                                                            <div class="row">
                                                                <div class="col-md-3 mb-3">
                                                                    <h6 class="text-muted">
                                                                        <span class="text-black"> Category :</span> <?= $row['job_category'] ?>
                                                                    </h6>
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                    <h6 class="text-muted">
                                                                        <span class="text-black">Em_type :</span> <?= $row['employment_type'] ?>
                                                                    </h6>
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                    <h6 class="text-muted">
                                                                        <span class="text-black">Location : </span> <?= $row['location'] ?>
                                                                    </h6>
                                                                </div>

                                                                <div class="col-md-3   mb-3 ">
                                                                    <h6 class="text-muted">
                                                                        <span class="text-black">salary_range : </span> <?= $row['salary_range'] ?>
                                                                    </h6>
                                                                </div>
                                                                <div class="col-md-3  mb-3 ">
                                                                    <h6 class="text-muted">
                                                                        <span class="text-black">skills_required : </span> <?= $row['skills_required'] ?>
                                                                    </h6>
                                                                </div>
                                                                <div class="col-md-3   mb-3">
                                                                    <h6 class="text-muted">
                                                                        <span class="text-black">education_level :</span> <?= $row['education_level'] ?>
                                                                    </h6>
                                                                </div>
                                                                <div class="col-md-3   mb-3">
                                                                    <h6 class="text-muted">
                                                                        <span class="text-black">experience_level : </span> <?= $row['experience_level'] ?>
                                                                    </h6>
                                                                </div>
                                                                <div class="col-md-3  mb-3 ">
                                                                    <h6 class="text-muted">
                                                                        <span class="text-black">application_deadline :</span> <?= $row['application_deadline'] ?>
                                                                    </h6>
                                                                </div>
                                                                <div class="col-md-3   mb-3">
                                                                    <h6 class="text-muted">
                                                                        <span class="text-black">contact_info : </span> <?= $row['contact_info'] ?>
                                                                    </h6>
                                                                </div>
                                                                <div class="col-md-3  mb-3 ">
                                                                    <h6 class="text-muted">
                                                                        <span class="text-black">additional_info :</span> <?= $row['additional_info'] ?>
                                                                    </h6>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                            <?php
                                    }
                                }


                                // Handle status update REAL TIME
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['applicant_id']) && isset($_POST['status'])) {
                                    $applicantId = $_POST['applicant_id'];
                                    $newStatus = $_POST['status'];
                                    $updateStatusSql = "UPDATE applicants SET status='$newStatus' WHERE id=$applicantId";
                                    if ($conn->query($updateStatusSql) === TRUE) {
                                        $_SESSION['message'] = "Status Updated Successfully";
                                        // header("location: view_job.php?id=$jobId");
                                        echo '<script>window.location.href = "company_view_job_details.php?id=' . $jobId . '";</script>';
                                    } else {
                                        echo "Error updating status: " . $conn->error;
                                    }
                                }
                            }



                            // Count applicants with status "Pending"
                            $countPendingSql = "SELECT COUNT(*) AS pending_count FROM applicants WHERE status='Pending' AND applied_job_id =$jobId";
                            $countPendingResult = $conn->query($countPendingSql);
                            $pendingCount = 0; // Default value if query fails
                            if ($countPendingResult && $countPendingResult->num_rows > 0) {
                                $pendingCountData = $countPendingResult->fetch_assoc();
                                $pendingCount = $pendingCountData['pending_count'];
                            }

                            $count_pending = $pendingCount ? '<span class="badge bg-danger px-2 py-1">' . $pendingCount . '</span>' : '';

                            // Count applicants with status "shortlisted"
                            $countshortlistedSql = "SELECT COUNT(*) AS shortlisted_count FROM applicants WHERE status='Shortlisted'  AND applied_job_id =$jobId ";
                            $countshortlistedResult = $conn->query($countshortlistedSql);
                            $shortlistedCount = 0; // Default value if query fails
                            if ($countshortlistedResult && $countshortlistedResult->num_rows > 0) {
                                $shortlistedCountData = $countshortlistedResult->fetch_assoc();
                                $shortlistedCount = $shortlistedCountData['shortlisted_count'];
                            }
                            $count_shortlisted = $shortlistedCount ? '<span class="badge bg-danger px-2 py-1">' . $shortlistedCount . '</span>' : '';





                            ?>


                            <!DOCTYPE html>
                            <html lang="en">

                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>Job Details</title>
                                <!-- Bootstrap CSS -->
                                <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"> -->
                                <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

                            </head>

                            <!-- tabs  -->
                            <!-- appluication when the particular ID  -->

                            <div class="table-data mt-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mt-2 mb-5">




                                            <!-- using tabs  -->
                                            <nav>
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Application <span class="badge bg-warning ">pending</span> <span> <?= $count_pending ?></span> </button>
                                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Application <span class="badge bg-success">shortlisted</span> <span> <?= $count_shortlisted ?></span>
                                                    </button>
                                                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Application <span class="badge bg-danger">rejected </span></button>
                                                </div>
                                            </nav>

                                            <?php


                                            // pagibationn for pending 

                                            $itemsPerPage = 4;
                                            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                                            $offset = ($page - 1) * $itemsPerPage;


                                            // Count the total number of pending applicants
                                            $countPendingSql = "SELECT COUNT(*) AS pending_count FROM applicants WHERE status='Pending' AND applied_job_id = $jobId";
                                            $countPendingResult = $conn->query($countPendingSql);
                                            $pendingCountData = $countPendingResult->fetch_assoc();
                                            $totalPendingApplicants = $pendingCountData['pending_count'];

                                            // Fetch the current page of pending applicants
                                            $sql = "SELECT * FROM applicants WHERE applied_job_id = $jobId AND status='Pending' ORDER BY id DESC LIMIT $offset, $itemsPerPage";

                                            $result = $conn->query($sql);



                                            ?>

                                            <div class="tab-content" id="nav-tabContent">
                                                <!-- Home section tables lisiting pending section  -->
                                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                    <div class="">
                                                        <table class="table table-striped mt-5 mb-4">
                                                            <tr>
                                                                <th><b></b></th>
                                                                <th><b>Applicant Name</b></th>
                                                                <th><b>Applicant Email </b></th>
                                                                <th><b>Applicant CV </b></th>
                                                                <th><b>Applied_at </b></th>
                                                                <th><b> Status </b></th>
                                                                <th><b>Action </b></th>
                                                            </tr>

                                                            <?php while ($list_jobs = mysqli_fetch_array($result)) : ?>
                                                                <tr>
                                                                    <td></td>
                                                                    <td><?= $list_jobs['name'] ?></td>
                                                                    <td><?= $list_jobs['email'] ?></td>
                                                                    <td><a href="../resumes/<?= $list_jobs['resume_file'] ?>" target="_blank"><?= $list_jobs['resume_file'] ?></a></td>
                                                                    <td><?= $list_jobs['applied_at'] ?></td>

                                                                    <td>
                                                                        <form method="post" action="">
                                                                            <input type="hidden" name="applicant_id" value="<?= $list_jobs['id'] ?>">
                                                                            <select name="status" class="form-select form-select-sm form-control" onchange="this.form.submit()">
                                                                                <option value="Pending" <?= $list_jobs['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                                                                <option value="Shortlisted" <?= $list_jobs['status'] == 'Shortlisted' ? 'selected' : '' ?>>Shortlisted</option>
                                                                                <option value="Rejected" <?= $list_jobs['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                                                                                <option value="Viewed" <?= $list_jobs['status'] == 'Viewed' ? 'selected' : '' ?>>Viewed</option>
                                                                            </select>
                                                                            <input type="hidden" name="update_status" value="1">
                                                                        </form>
                                                                    </td>
                                                                    <td>
                                                                        <a href='?id=<?= $list_jobs["id"]; ?>' class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this job?')"><i class="fas fa-trash-alt"></i></a>
                                                                    </td>
                                                                </tr>
                                                            <?php endwhile; ?>
                                                        </table>

                                                        <!-- Pagination controls -->
                                                        <nav aria-label="Page navigation">
                                                            <ul class="pagination justify-content-center">
                                                                <?php
                                                                $totalPages = ceil($totalPendingApplicants / $itemsPerPage);
                                                                for ($i = 1; $i <= $totalPages; $i++) : ?>
                                                                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                                                        <a class="page-link" href="?id=<?= $jobId ?>&page=<?= $i ?>"><?= $i ?></a>
                                                                    </li>
                                                                <?php endfor; ?>
                                                            </ul>
                                                        </nav>

                                                    </div>
                                                </div>


                                                <!-- Modal -->
                                                <div class="modal fade" id="viewJobSeekerModal" tabindex="-1" aria-labelledby="viewJobSeekerModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="viewJobSeekerModalLabel">Job Applied Person</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="container">
                                                                    <?php echo $name;
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Shortlisted resumes -->
                                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                    <div class="">
                                                        <table class="table table-striped mt-5 mb-4">
                                                            <tr>
                                                                <th><b></b></th>
                                                                <th><b>Applicant Name</b></th>
                                                                <th><b>Applicant Email</b></th>
                                                                <th><b>Applicant CV</b></th>
                                                                <th><b>Applied_at </b></th>
                                                                <th><b>Status</b></th>
                                                                <th><b>Action</b></th>
                                                            </tr>

                                                            <?php

                                                            $sql = "SELECT * FROM applicants WHERE applied_job_id = $jobId AND status = 'Shortlisted' ";
                                                            $result = $conn->query($sql);

                                                            while ($list_jobs = mysqli_fetch_array($result)) {
                                                            ?>
                                                                <tr>
                                                                    <td></td>
                                                                    <td><?= $list_jobs['name'] ?></td>
                                                                    <td><?= $list_jobs['email'] ?></td>
                                                                    <td><a href="../resumes/<?= $list_jobs['resume_file'] ?>" target="_blank"><?= $list_jobs['resume_file'] ?></a></td>
                                                                    <td><?= $list_jobs['applied_at'] ?></td>

                                                                    <td>
                                                                        <!-- Form for status update -->
                                                                        <form method="post" action="">
                                                                            <input type="hidden" name="applicant_id" value="<?= $list_jobs['id'] ?>">
                                                                            <select name="status" class="form-select form-select-sm form-control" onchange="this.form.submit()">
                                                                                <option value="Pending" <?= $list_jobs['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                                                                <option value="Shortlisted" <?= $list_jobs['status'] == 'Shortlisted' ? 'selected' : '' ?>>Shortlisted</option>
                                                                                <option value="Rejected" <?= $list_jobs['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                                                                                <option value="Viewed" <?= $list_jobs['status'] == 'Viewed' ? 'selected' : '' ?>>Viewed</option>
                                                                            </select>
                                                                            <input type="hidden" name="update_status" value="1">
                                                                        </form>
                                                                    </td>
                                                                    <td>
                                                                        <!-- Edit and View buttons -->
                                                                        <!-- <a href='?id=<?php echo $row["id"]; ?>' class='btn btn-primary btn-sm' >Edit</a> -->
                                                                        <!-- <a href='?id=<?php echo $row["id"]; ?>' class='btn btn-primary btn-sm'>View Job seeker</a> -->
                                                                        <!-- Delete button -->
                                                                        <a href='?id=<?php echo $row["id"]; ?>' class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this job?')"><i class="fas fa-trash-alt"></i></a>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>

                                                        </table>


                                                    </div>
                                                </div>



                                                <!-- rejected lists resumes  -->
                                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                                    <div class="">
                                                        <table class="table table-striped mt-5 mb-4">
                                                            <tr>
                                                                <th><b></b></th>
                                                                <th><b>Applicant Name</b></th>
                                                                <th><b>Applicant Email </b></th>
                                                                <th><b>Applicant CV </b></th>
                                                                <th><b>Applied_at </b></th>
                                                                <th><b> Status </b></th>
                                                                <th><b>Action </b></th>

                                                            </tr>


                                                            <?php
                                                            $sql = "SELECT * FROM applicants WHERE applied_job_id  = $jobId AND status='Rejected' ";
                                                            $result = $conn->query($sql);

                                                            while ($list_jobs = mysqli_fetch_array($result)) {
                                                            ?>
                                                                <tr>
                                                                    <td></td>
                                                                    <td><?= $list_jobs['name'] ?></td>
                                                                    <td><?= $list_jobs['email'] ?></td>
                                                                    <td></td>
                                                                    <!-- <td><a href="../resumes/<?= $list_jobs['resume_file'] ?>" target="_blank"><?= $list_jobs['resume_file'] ?></a></td> -->
                                                                    <td><?= $list_jobs['applied_at'] ?></td>


                                                                    <td>
                                                                        <!-- Form for status update -->
                                                                        <form method="post" action="">
                                                                            <input type="hidden" name="applicant_id" value="<?= $list_jobs['id'] ?>">
                                                                            <select name="status" class="form-select form-select-sm form-control" onchange="this.form.submit()">
                                                                                <option value="Pending" <?= $list_jobs['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                                                                <option value="Shortlisted" <?= $list_jobs['status'] == 'Shortlisted' ? 'selected' : '' ?>>Shortlisted</option>
                                                                                <option value="Rejected" <?= $list_jobs['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                                                                                <option value="Viewed" <?= $list_jobs['status'] == 'Viewed' ? 'selected' : '' ?>>Viewed</option>
                                                                            </select>
                                                                            <input type="hidden" name="update_status" value="1">
                                                                        </form>
                                                                    </td>
                                                                    <td>
                                                                        <!-- Edit and View buttons -->
                                                                        <!-- <a href='?id=<?php echo $row["id"]; ?>' class='btn btn-primary btn-sm' >Edit</a> -->



                                                                        <!-- Delete button -->
                                                                        <a href='?id=<?php echo $row["id"]; ?>' class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this job?')"><i class="fas fa-trash-alt"></i></a>
                                                                    </td>

                                                                </tr>
                                                            <?php

                                                            }
                                                            ?>

                                                        </table>
                                                    </div>


                                                </div>



                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>



                            <script src="script.js"></script>

                            <?php

                            ?>



                            </div>
                        </div>

            </div>

        <?php
                } else {
                    echo "No user found with ID: $jobId";
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

<script>
    <?php
    // messages from correct or not 
    if (isset($_SESSION['message'])) {
    ?>
        alertify.set('notifier', 'position', 'top-right');
        alertify.success('<?= $_SESSION['message'] ?>');
    <?php
        unset($_SESSION['message']);
    }
    ?>
</script>

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