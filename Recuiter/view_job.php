<?php
session_start();
include "include/header.php";
include("../Database/connection.php");


// $re_name = $_SESSION['first_name'];
$re_email = $_SESSION['user_email'];


if (!isset($_SESSION['user_id'])) {
    header("location: ../index.php");
}


if (isset($_GET['id'])) {
    $jobId = $_GET['id'];
    $sql = "SELECT * FROM jobs WHERE id = $jobId";
    $result = $conn->query($sql);



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
                        <h1>Job Listing Details </h1>
                        <ul class="breadcrumb">
                            <li>
                                <a href="#">Recuiter </a>
                            </li>
                            <li><i class="bx bx-chevron-right"></i></li>
                            <li>
                                <a class="active" href="job_listing">Job Listing </a>
                            </li>
                            <li><i class="bx bx-chevron-right"></i></li>

                            <li>
                                <a class="active" href="view_job">view </a>
                            </li>
                        </ul>
                    </div>
                    <a href="#" class="btn-download">
                        <i class="bx bxs-cloud-download"></i>
                        <span class="text">Download PDF</span>
                    </a>
                </div>

                <!-- --------------------------------  -->


                <div class=" mt-4 mb-4">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="javascript:history.back()">
                                <div class="circle-icon">
                                    <i class="fas fa-arrow-left"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <?php
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                ?>


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
                                            <div class="col-md-8">
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
                        </div>

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
                        echo '<script>window.location.href = "view_job.php?id=' . $jobId . '";</script>';
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

            <!-- appluication when the particular ID  -->

            <div class="table-data">
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
                                                <!-- <th><b>Action </b></th> -->
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
                                                    <!-- <td>
                                                        <a href='?id=<?= $list_jobs["id"]; ?>' class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this job?')"><i class="fas fa-trash-alt"></i></a>
                                                    </td> -->
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
                                                        <!-- <a href='?id=<?php echo $row["id"]; ?>' class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this job?')"><i class="fas fa-trash-alt"></i></a> -->
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
                                                    <!-- <td>
                                                        <a href='?id=<?php echo $row["id"]; ?>' class='btn btn-primary btn-sm' >Edit</a>



                                                        <a href='?id=<?php echo $row["id"]; ?>' class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this job?')"><i class="fas fa-trash-alt"></i></a>
                                                    </td> -->

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
