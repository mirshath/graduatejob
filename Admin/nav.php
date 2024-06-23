<?php

// session_start();
include "headerFiles/header.php";
include "../Database/connection.php";


// Get the total number of jobs as pending
$totalJobsQuery = "SELECT COUNT(*) AS total FROM jobs WHERE admin_status='Pending' ";
$totalJobsResult = mysqli_query($conn, $totalJobsQuery);
$totalJobsRow = mysqli_fetch_assoc($totalJobsResult);
$totalJobs = $totalJobsRow['total'];

$nnn = $totalJobs ? '<span class="badge bg-danger px-2 py-1">' . $totalJobs . '</span>' : '';


// Get the total number of job seekers
$totalJobseekersQuery = "SELECT COUNT(*) AS total FROM userregister WHERE usertype='jobSeeker' ";
$totalJobseekersResult = mysqli_query($conn, $totalJobseekersQuery);
$totalJobseekersRow = mysqli_fetch_assoc($totalJobseekersResult);
$totalJobseekers = $totalJobseekersRow['total'];


// Get the total number of job seekers
$totalCompanyMemberQuery = "SELECT COUNT(*) AS total FROM userregister WHERE usertype='recruiter' ";
$totalCompanyMemberResult = mysqli_query($conn, $totalCompanyMemberQuery);
$totalCompanyMemberRow = mysqli_fetch_assoc($totalCompanyMemberResult);
$totalCompanyMember = $totalCompanyMemberRow['total'];



?>


<?php










?>




<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">GRADUATE JOBS.LK </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>




    <!-- Nav Item - Pages Collapse Menu <<<<<<<<<<<<<< job listing managemnt -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-briefcase"></i>

            <span>Jobs &nbsp; <?= $nnn ?> </span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <!-- <a class="collapse-item" href="addJob.html">Add New Job </a> -->
                <a class="collapse-item" href="viewJobs"> Job </a>
                <a class="collapse-item" href="pendingjobs">Pending Jobs &nbsp; &nbsp; <?= $nnn ?> </a>
                <a class="collapse-item" href="Expiredjobs">Expired Jobs Jobs &nbsp; &nbsp;  </a>
                <!-- <a class="collapse-item" href="add_category">Add Categories</a> -->
            </div>
        </div>
    </li>




    <!-- Nav Item - Pages Collapse Menu <<<<<<<<<<<<<< job listing managemnt -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCate" aria-expanded="true"
            aria-controls="collapseCate">
            <i class="fas fa-fw fa-briefcase"></i>

            <span>Category  </span>
        </a>
        <div id="collapseCate" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <!-- <a class="collapse-item" href="addJob.html">Add New Job </a> -->
                <a class="collapse-item" href="add_category"> Categories</a>
            </div>
        </div>
    </li>



    <!-- Nav Item - Pages Collapse Menu <<<<<<<<<<<<<< user management -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
            aria-controls="collapseThree">
            <i class="fas fa-fw fa-user"></i>
            <span>User </span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="ViewUser">View Users &nbsp; &nbsp; <span
                        class="badge bg-danger p-1 px-2"><?= $totalJobseekers ?></span> </a>
                <!-- <a class="collapse-item" href="#">Edit User Profiles</a> -->
                <!-- <a class="collapse-item" href="#">Ban Users</a> -->
            </div>
        </div>
    </li>



    <!-- Nav Item - Pages Collapse Menu <<<<<<<<<<<<<<resume  management -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true"
            aria-controls="collapseFour">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Resume DB</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="all_resums_list">View resumes </a>

            </div>
        </div>
    </li>




    <!-- Nav Item - Pages Collapse Menu <<<<<<<<<<<<<<      employment   management -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true"
            aria-controls="collapseFive">
            <i class="fas fa-fw fa-user-tie"></i>
            <span>Registered Company</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="employment">View Companies &nbsp; &nbsp; <span
                        class="badge bg-danger p-1 px-2"><?= $totalCompanyMember ?></span> </a>

            </div>
        </div>
    </li>




    <!-- Nav Item - Pages Collapse Menu <<<<<<<<<<<<<<      Application    management -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true"
            aria-controls="collapseSix">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Application </span>
        </a>
        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="#">View Job Applications </a>

            </div>
        </div>
    </li>



</ul>
<!-- End of Sidebar -->