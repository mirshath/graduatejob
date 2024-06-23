<?php
session_start();
include "headerFiles/header.php";
include '../Database/connection.php';

// ------------- update company profiles 
if (isset($_GET['id'])) {
    $recruiter_id = $_GET['id'];
}

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
                    $userId = $_GET['id'];
                    $sql = "SELECT * FROM userregister WHERE id = $userId";
                    $result = $conn->query($sql);

                    // Pagination logic
                    $jobsPerPage = 4; // Number of jobs to display per page
                    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                    $offset = ($page - 1) * $jobsPerPage;

                    // Count total jobs for pagination
                    $totalJobsQuery = "SELECT COUNT(*) AS total FROM jobs WHERE recuiter_id = $userId";
                    $totalJobsResult = $conn->query($totalJobsQuery);
                    $totalJobsRow = $totalJobsResult->fetch_assoc();
                    $totalJobs = $totalJobsRow['total'];
                    $totalPages = ceil($totalJobs / $jobsPerPage);

                    // Fetch jobs with pagination
                    $get_all_job_recruiter = "SELECT * FROM jobs WHERE recuiter_id = $userId LIMIT $offset, $jobsPerPage";
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


                                <!-- right side logo and details   -->

                                <div class="col-md-10 order-md-2 order-2 mt-4 ">
                                    <div class="">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- <h3 class="text-center mt-5 mb-3">All Jobs are Listing of
                                                    <?= $user['company_name'] ?>
                                                </h3> -->
                                            </div>
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>Job Title</th>
                                                    <th>Category</th>
                                                    <th>Application recieved</th>
                                                    <th>App Deadline</th>
                                                    <th>Action</th>
                                                </tr>

                                                <?php
                                                if (mysqli_num_rows($get_all_job_recruiter_run) > 0) {
                                                    while ($job_list = mysqli_fetch_assoc($get_all_job_recruiter_run)) {
                                                        $badge_color = '';
                                                        $status_text = '';

                                                        // Check the value of admin_status and set badge color and status text accordingly
                                                        switch ($job_list['admin_status']) {
                                                            case 'Pending':
                                                                $badge_color = 'bg-info';
                                                                $status_text = 'Pending';
                                                                break;
                                                            case 'Approved':
                                                                $badge_color = 'bg-success';
                                                                $status_text = 'Approved';
                                                                break;
                                                            case 'Rejected':
                                                                $badge_color = 'bg-danger';
                                                                $status_text = 'Rejected';
                                                                break;
                                                            default:
                                                                $badge_color = 'bg-secondary'; // Default to a gray badge if status is not recognized
                                                                $status_text = 'Unknown';
                                                        }
                                                ?>
                                                        <tr>
                                                            <td><?= $job_list["job_title"]; ?></td>
                                                            <td><?= $job_list["job_category"]; ?></td>
                                                            <td>
                                                                <?php
                                                                // Get application count for each job
                                                                $jobId = $job_list['id'];
                                                                $getApplicationCount = "SELECT COUNT(*) AS application_count FROM applicants WHERE applied_job_id=$jobId";
                                                                $getApplicationCount_run = mysqli_query($conn, $getApplicationCount);
                                                                if ($getApplicationCount_run) {
                                                                    $applicationCountData = mysqli_fetch_assoc($getApplicationCount_run);
                                                                ?>
                                                                    <span class="badge bg-danger p-2 mb-2 text-white"><?= $applicationCountData['application_count'] ?></span>
                                                                    <br>

                                                                <?php
                                                                    // Display the badge with appropriate text
                                                                    if ($status_text === 'Approved') {
                                                                        echo "<span class='badge {$badge_color} p-2 text-white'>Job post {$status_text} by Admin</span>";
                                                                    } elseif ($status_text === 'Pending') {
                                                                        echo "<span class='badge {$badge_color} p-2 text-white'>Wait for admin's approval</span>";
                                                                    } elseif ($status_text === 'Rejected') {
                                                                        echo "<span class='badge {$badge_color} p-2'>Job post {$status_text} by Admin</span>";
                                                                    } else {
                                                                        echo "<span class='badge {$badge_color} p-2'>Unknown status</span>";
                                                                    }
                                                                } else {
                                                                    echo "0";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?= $job_list["application_deadline"]; ?> <br>
                                                                <?php
                                                                if ($job_list["application_deadline"] < date("Y-m-d")) {
                                                                    echo "<span class='badge badge-danger'>Date Expired</span>";
                                                                } else {
                                                                    echo "<span class='badge badge-success'>Active</span>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <!-- Edit button -->
                                                                <a href='edit_job.php?id=<?= $job_list["id"]; ?>' class='btn btn-primary btn-sm'>
                                                                    <i class="fas fa-edit"></i>
                                                                </a>

                                                                <!-- View button -->
                                                                <!-- <a href='' class='btn btn-primary btn-sm'>
                                                                    <i class="fas fa-eye"> </i>
                                                                </a> -->
                                                                <!-- Delete button -->
                                                                <a href="company_view_job_details.php?id=<?= $job_list['id'] ?>" class='btn btn-warning btn-sm'>
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                                <a href="delete.php?type=job&id=<?= $job_list['id'] ?>" class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this job?')">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>

                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </table>

                                            <!-- Pagination controls -->
                                            <nav aria-label="Page navigation">
                                                <ul class="pagination justify-content-center">
                                                    <?php if ($page > 1) : ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="?id=<?= $userId ?>&page=<?= $page - 1 ?>" aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>"><a class="page-link" href="?id=<?= $userId ?>&page=<?= $i ?>"><?= $i ?></a></li>
                                                    <?php endfor; ?>
                                                    <?php if ($page < $totalPages) : ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="?id=<?= $userId ?>&page=<?= $page + 1 ?>" aria-label="Next">
                                                                <span aria-hidden="true">&raquo;</span>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </nav>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

            </div>

    <?php
                    } else {
                        echo "No user found with ID: $userId";
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