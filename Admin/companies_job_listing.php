<?php
session_start();
include "include/header.php";

if (!isset($_SESSION['user_id'])) {
    header("location: ../index.php");
}

// Database connection
// $conn = new mysqli("localhost", "root", "", "BMS_JOB");
include("../Database/connection.php");


$rec_id = $_SESSION['user_id'];

$getUsers = "SELECT * FROM userregister WHERE id='$rec_id'";
$getUsers_run = mysqli_query($conn, $getUsers);

$row = mysqli_fetch_array($getUsers_run);
$profile = $row['profile'];

include "include/nav.php";

// Pagination logic
$jobsPerPage = 5; // Number of jobs to display per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $jobsPerPage;


// Get the total number of jobs
$totalJobsQuery = "SELECT COUNT(*) AS total FROM jobs WHERE recuiter_id='$rec_id'";
$totalJobsResult = mysqli_query($conn, $totalJobsQuery);
$totalJobsRow = mysqli_fetch_assoc($totalJobsResult);
$totalJobs = $totalJobsRow['total'];

// Calculate the total number of pages
$totalPages = ceil($totalJobs / $jobsPerPage);

// Fetch jobs for the current page
$getJobs = "SELECT * FROM jobs WHERE recuiter_id='$rec_id' LIMIT $offset, $jobsPerPage";
$getJobs_run = mysqli_query($conn, $getJobs);
?>


<!-- ------------------------------------  all jobs arelisting ------------------------------------  -->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center mt-5 mb-3">All Jobs are Listing</h3>
        </div>
        <table class="table table-striped">
            <tr>
                <th>Job Title</th>
                <th>Company name</th>
                <th>Job lOGO</th>
                <th>Category</th>
                <th>Application recieved</th>
                <th>App Deadline</th>
                <th>Action</th>
            </tr>
            <?php
            if (mysqli_num_rows($getJobs_run) > 0) {
                while ($row = mysqli_fetch_assoc($getJobs_run)) {

                    $badge_color = '';
                    $status_text = '';

                    // Check the value of admin_status and set badge color and status text accordingly
                    switch ($row['admin_status']) {
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
                        <td><?= $row["job_title"]; ?></td>
                        <td><?= $row["company_name"]; ?></td>
                        <td><img src="../Admin/uploads/<?= $row["company_logo"]; ?>" alt="Job Image" width="100px"></td>
                        <td><?= $row["job_category"]; ?></td>
                        <td>
                            <?php
                            // Get application count for each job
                            $jobId = $row['id'];
                            $getApplicationCount = "SELECT COUNT(*) AS application_count FROM applicants WHERE applied_job_id=$jobId";
                            $getApplicationCount_run = mysqli_query($conn, $getApplicationCount);
                            if ($getApplicationCount_run) {
                                $applicationCountData = mysqli_fetch_assoc($getApplicationCount_run);
                            ?>
                                <span class="badge bg-danger p-2"><?= $applicationCountData['application_count'] ?></span> <br> <br>
                                <span class="badge <?= $badge_color ?> p-2"> Job post <?= $status_text ?> by Admin</span>
                            <?php
                            } else {
                                echo "0";
                            }
                            ?>
                        </td>
                        <td><?= $row["application_deadline"]; ?></td>
                        <td>
                            <!-- Edit and View buttons -->
                            <a href='edit_job.php?id=<?= $row["id"]; ?>' class='btn btn-primary btn-sm'>
                                <i class="fas fa-edit"></i> 
                            </a>
                            <a href='view_job.php?id=<?= $row["id"]; ?>' class='btn btn-primary btn-sm'>
                                <i class="fas fa-eye"></i> 
                            </a>
                            <!-- Delete button -->
                            <a href='delete.php?id=<?= $row["id"]; ?>' class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this job?')">
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
                        <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor; ?>
                <?php if ($page < $totalPages) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>