<?php

session_start();
require "Database/connection.php";


include("includes/header.php");
include("includes/navbar.php");


// Redirect to index.php if user is not logged in
if (!isset($_SESSION['user_id'])) {
    // header("location: index.php");
    echo '<script>window.location.href = "index";</script>';
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$sql = "SELECT * FROM userregister WHERE id = $user_id";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    $userData_row = mysqli_fetch_array($result);
    $cv_file = $userData_row['studentCV'];
} else {
    echo "No user found ";
    exit();
}




?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Bootstrap CSS and JS -->
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->


<style>
    /* mobile view  */
    @media (max-width: 1199px) {}




    /* ----------------- user profile nav ------------------  */

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        color: white;
        background-color: #040954;
        border-color: var(--bs-nav-tabs-link-active-border-color);
        font-weight: 600;
    }

    .btn-primarys {
        --bs-btn-color: #fff;
        --bs-btn-bg: #031d43;
        --bs-btn-border-color: #610413;
        --bs-btn-hover-color: red;
        --bs-btn-hover-bg: #031d43;
        --bs-btn-hover-border-color: #0a58ca;
        --bs-btn-focus-shadow-rgb: 49, 132, 253;
        --bs-btn-active-color: #fff;
        --bs-btn-active-bg: #0a58ca;
        --bs-btn-active-border-color: #0a53be;
        --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        --bs-btn-disabled-color: #fff;
        --bs-btn-disabled-bg: #0d6efd;
        --bs-btn-disabled-border-color: #0d6efd;
    }
</style>



<main class="main" style="margin-top: 180px;">


    <div class="container text-white">
        <div class="profile-env">
            <header class="row" style="background: rgb(2,0,36);
                background: linear-gradient(90deg, rgba(2,0,36,1) 10%, rgba(9,9,121,1) 100%, rgba(0,212,255,1) 100%);">
                <div class="col-sm-2">
                    <a href="#" class="profile-picture">
                        <img src="userDashboards/uploads/profiles/<?= $row["profile"] ?>" class="img-responsive img-circle">
                    </a>
                </div>
                <div class="col-sm-7">
                    <ul class="profile-info-sections">
                        <li>
                            <div class="profile-name">
                                <strong class="mb-2">
                                    <a href="#" style="color: #e1e1e1; font-weight: bolder;"><?= $userData_row['firstname']; ?>
                                        <?= $userData_row['lastname']; ?></a>
                                    <a href="#" class="user-status is-online tooltip-primary" data-toggle="tooltip" data-placement="top" data-original-title="Online"></a>
                                </strong>
                                <span class="mb-2">
                                    <a href="#"><?= $userData_row['email']; ?></a>
                                </span>
                                <span class="mb-2">
                                    <a href="#"><?= $userData_row['phone_no']; ?></a>
                                </span>
                                <span class="mb-2">
                                    <a href="#"><?= $userData_row['St_address']; ?></a>
                                </span>
                            </div>
                        </li>
                        <li>
                            <div class="profile-stat">
                                <h3>643</h3>
                                <span>
                                    <a href="#">followers</a>
                                </span>
                            </div>
                            <div class="profile-stat">
                                <h3>643</h3>
                                <span>
                                    <a href="#">followers</a>
                                </span>
                            </div>
                        </li>
                        <li>
                            <div class="profile-stat">
                                <h3>108</h3>
                                <span>
                                    <a href="#">following</a>
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>


            </header>

            <section class="profile-info-tabs mt-4 d-none d-md-flex">
                <div class="row">
                    <div class="col-sm-offset-2 col-sm-10">
                        <ul class="user-details">
                            <li>
                                <a href="#">
                                    <i class="entypo-location"></i>
                                    Prishtina
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="entypo-suitcase"></i>
                                    Works as
                                    <span>Laborator</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="entypo-calendar"></i>
                                    16 October
                                </a>
                            </li>
                        </ul>




                    </div>
                </div>
            </section>


            <div class=" mt-4 mb-4">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Using tabs -->
                        <nav>
                            <div class="nav nav-tabs " id="nav-tab" role="tablist">
                                <button class="nav-link active " id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Status of
                                    Applications</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">My
                                    Information</button>
                                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Subscriptions
                                </button>
                                <button class="nav-link" id="nav-update-password-tab" data-bs-toggle="tab" data-bs-target="#nav-update-password" type="button" role="tab" aria-controls="nav-update-password" aria-selected="false">Update Password</button>
                                <button class="nav-link" id="nav-mmm-tab" data-bs-toggle="tab" data-bs-target="#nav-mmm" type="button" role="tab" aria-controls="nav-mmm" aria-selected="false">MMM</button>
                            </div>
                        </nav>

                        <div class="tab-content" id="nav-tabContent">



                            <!-- Home section -->
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class=" p-3 text-white">
                                    <div class="row">
                                        <?php
                                        // Number of records to show per page
                                        $records_per_page = 6;

                                        // Get the current page number from the URL, if none set, default to page 1
                                        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                                            $current_page = $_GET['page'];
                                        } else {
                                            $current_page = 1;
                                        }

                                        // Calculate the offset for the query
                                        $offset = ($current_page - 1) * $records_per_page;

                                        // Count the total number of records
                                        $count_query = "
                                SELECT COUNT(*) AS total 
                                FROM applicants 
                                INNER JOIN jobs ON applicants.applied_job_id = jobs.id 
                                WHERE applicants.jobseeker_id = $user_id";

                                        $count_result = mysqli_query($conn, $count_query);
                                        $count_row = mysqli_fetch_assoc($count_result);
                                        $total_records = $count_row['total'];

                                        // Calculate the total number of pages
                                        $total_pages = ceil($total_records / $records_per_page);

                                        // Fetch the records for the current page
                                        $select_jobs_from_tables = "
                                SELECT 
                                    applicants.*,  -- Select all columns from the applicants table
                                    jobs.id AS job_id,
                                    jobs.job_title,
                                    jobs.company_name,
                                    jobs.job_description
                                FROM 
                                    applicants
                                INNER JOIN 
                                    jobs ON applicants.applied_job_id = jobs.id
                                WHERE 
                                    applicants.jobseeker_id = $user_id
                                LIMIT $offset, $records_per_page";

                                        $select_jobs_from_tables_run = mysqli_query($conn, $select_jobs_from_tables);

                                        if (mysqli_num_rows($select_jobs_from_tables_run) > 0) {
                                            while ($rows = mysqli_fetch_array($select_jobs_from_tables_run)) {
                                        ?>
                                                <div class="col-md-6 mb-4 hoverEffect">
                                                    <a href="user_job_views.php?id=<?= $rows['job_id']; ?>">
                                                        <div class="card shadow">
                                                            <div class="card-body">
                                                                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                                                                    <!-- Image -->
                                                                    <div class="d-flex align-items-center justify-content-center mb-3 mb-md-0">
                                                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-QCKIyHiPkoouLv349z1C4-vuEvaY8pX95A&s" alt="Image" class="img-fluid" style="max-width: 100px; border-radius: 20px;">
                                                                    </div>

                                                                    <!-- Name and company -->
                                                                    <div class="text-center text-md-left mb-3 mb-md-0">
                                                                        <h4 class="chakra-petch-bold mb-2" style="font-size: 20px;"><?= $rows['job_title'] ?></h4>
                                                                        <p><span><?= $rows['company_name'] ?></span></p>
                                                                        <?php
                                                                        $status = $rows['status'];
                                                                        $badge_class = '';

                                                                        switch ($status) {
                                                                            case 'Pending':
                                                                                $badge_class = 'badge badge-info';
                                                                                break;
                                                                            case 'Shortlisted':
                                                                                $badge_class = 'badge badge-success';
                                                                                break;
                                                                            case 'Rejected':
                                                                                $badge_class = 'badge badge-danger';
                                                                                break;
                                                                            default:
                                                                                $badge_class = 'badge badge-info'; // Default class if status is unknown
                                                                                break;
                                                                        }
                                                                        ?>
                                                                        <span style="color: #931616;" class="badge <?= $badge_class ?> px-3 py-1"><?= $status ?></span>
                                                                    </div>

                                                                    <!-- Application Date -->
                                                                    <div class="text-center text-md-right">
                                                                        <p>
                                                                            <i class="fas fa-calendar-alt" style="font-size: 15px;"></i>
                                                                            &nbsp; &nbsp;
                                                                            <?php
                                                                            // Extract and format the date from applied_at
                                                                            $applied_at_date = date('F j, Y', strtotime($rows['applied_at']));
                                                                            echo $applied_at_date;
                                                                            ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </a>
                                                </div>
                                        <?php
                                            }
                                        } else {
                                            echo "No jobs found for the given jobseeker_id.";
                                        }
                                        ?>
                                    </div>

                                    <!-- Pagination -->
                                    <div class="row">
                                        <div class="col-12">
                                            <nav aria-label="Page navigation">
                                                <ul class="pagination justify-content-center">
                                                    <?php if ($current_page > 1) : ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="?page=<?= $current_page - 1 ?>" aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
                                                        <li class="page-item custom-pagination-item <?= ($page == $current_page) ? 'active' : '' ?>">
                                                            <a class="page-link" href="?page=<?= $page ?>"><?= $page ?></a>
                                                        </li>
                                                    <?php endfor; ?>

                                                    <?php if ($current_page < $total_pages) : ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="?page=<?= $current_page + 1 ?>" aria-label="Next">
                                                                <span aria-hidden="true">&raquo;</span>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>

                                </div>










                                <!-- --------------- new modal trying --------------- -->


                                <!-- --------------- new modal  trying --------------- -->

                            </div>





                            <!--  -------------------------------------- Profile information section --------------------------------------  -->


                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <div class="container p-3">
                                            <div class="container mt-2">
                                                <div class="row flex-lg-nowrap">
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="e-profile">
                                                                            <form class="form" action="update_jobseeker.php" method="post" enctype="multipart/form-data">
                                                                                <div class="row">
                                                                                    <div class="col-12 col-sm-auto mb-3">
                                                                                        <div class="mx-auto" style="width: 140px;">
                                                                                            <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239); overflow: hidden;">
                                                                                                <?php if (!empty($row["profile"])) : ?>
                                                                                                    <div class="mb-3">
                                                                                                        <img src="userDashboards/uploads/profiles/<?= $row["profile"] ?>" alt="Profile Image" class="img-thumbnail profile-img">
                                                                                                    </div>
                                                                                                <?php endif; ?>
                                                                                            </div>
                                                                                        </div>

                                                                                        <style>
                                                                                            .profile-img {
                                                                                                width: 100%;
                                                                                                height: 100%;
                                                                                                object-fit: cover;
                                                                                            }
                                                                                        </style>

                                                                                    </div>
                                                                                    <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                                                                        <div class="text-sm-left mb-2 mb-sm-0">
                                                                                            <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">
                                                                                                <?= $row['firstname'] ?>
                                                                                                <?= $row['lastname'] ?>
                                                                                            </h4>
                                                                                            <p class="mb-0 text-muted mb-4"><?= $row['email'] ?></p>
                                                                                            <div class="mt-2">
                                                                                                <label class="btn btn-primary">
                                                                                                    <input type="file" class="form-control-file fa fa-fw fa-camera" id="editProfilePhoto" name="editProfilePhoto" style="display: none;">
                                                                                                    <i class="fa fa-fw fa-camera"></i>
                                                                                                    Change Photo
                                                                                                </label>
                                                                                            </div>
                                                                                            <!-- Image preview area -->

                                                                                        </div>
                                                                                        <div class="text-center text-sm-right">
                                                                                            <span class="badge badge-info"><?= $row['usertype'] ?></span>
                                                                                            <div class="text-muted">
                                                                                                <small>Joined <?= $row['created_at'] ?></small>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <ul class="nav nav-tabs">
                                                                                    <li class="nav-item"><a href="" class="active nav-link"><b>Update profiles</b></a></li>
                                                                                </ul>
                                                                                <div class="tab-content pt-3">
                                                                                    <div class="tab-pane active">
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <div class="row">
                                                                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                                                                    <div class="col">
                                                                                                        <div class="form-group">
                                                                                                            <label class="mb-2">First Name</label>
                                                                                                            <input class="form-control text-muted mb-3" type="text" id="Fname" name="Fname" value="<?= $row['firstname'] ?>">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col">
                                                                                                        <div class="form-group">
                                                                                                            <label class="mb-2">Last Name</label>
                                                                                                            <input class="form-control text-muted mb-3" type="text" id="Lastname" name="Lastname" value="<?= $row['lastname'] ?>">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col">
                                                                                                        <div class="form-group">
                                                                                                            <label class="mb-2">Mobile</label>
                                                                                                            <input class="form-control text-muted mb-3" type="text" id="Contact" name="Contact" value="<?= $row['phone_no'] ?>">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col">
                                                                                                        <div class="form-group">
                                                                                                            <label class="mb-2">Address</label>
                                                                                                            <input class="form-control text-muted mb-3" type="text" id="St_address" name="St_address" value="<?= $row['St_address'] ?>">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col">
                                                                                                        <div class="form-group">
                                                                                                            <label class="mb-2">Email</label>
                                                                                                            <input class="form-control text-muted mb-3" type="email" id="email" name="email" value="<?= $row['email'] ?>">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col mb-3">
                                                                                                        <div class="form-group">
                                                                                                            <label class="mb-2">About</label>
                                                                                                            <textarea class="form-control text-muted mb-3" rows="5" placeholder="My Bio"><?= $row['usertype'] ?></textarea>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col d-flex justify-content-end">
                                                                                                <button class="btn btn-primary" type="submit">Save Changes</button>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-3 mb-3">
                                                                <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <div class="px-xl-3">
                                                                            <div class="form-group input-icon"></div>
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
                            </div>
                            <script>
                                $(document).ready(function() {
                                    // Check if there's a message in the session
                                    var message = '<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?>';
                                    if (message) {
                                        alert(message);
                                        <?php unset($_SESSION['message']); ?> // Clear the message after displaying
                                    }

                                    $('#editProfilePhoto').change(function() {
                                        var formData = new FormData();
                                        var userId = $('input[name="id"]').val();
                                        formData.append('editProfilePhoto', this.files[0]);
                                        formData.append('id', userId);

                                        $.ajax({
                                            url: 'update_profile_photo.php',
                                            type: 'POST',
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            success: function(response) {
                                                if (response.trim() == "success") {
                                                    location.reload(); // Reload the page to show the updated photo
                                                } else {
                                                    alert("Failed to update profile photo.");
                                                }
                                            }
                                        });
                                    });
                                });
                            </script>






                            <!-- --------------------------------------Application section -------------------------------------- -->
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="container p-3">
                                    Subscriptions services for
                                </div>
                            </div>





                            <!-- -------------------------------------- Update password section -------------------------------------- -->
                            <!-- Update Password Section -->
                            <div class="tab-pane fade" id="nav-update-password" role="tabpanel" aria-labelledby="nav-update-password-tab">
                                <div class="container p-3">
                                    <div class="container mt-3 mb-3">
                                        <div class="shadow">
                                            <div class="card-header">
                                                <h4 class="text-muted p-2">Update Your Password Here</h4>
                                            </div>
                                            <div class="card-body update_pas_field">
                                                <form action="update_password.php" method="post" enctype="multipart/form-data" id="passwordForm">
                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                    <div class="card mb-4">
                                                        <div class="card-body">
                                                            <div class="input-icon">
                                                                <i class="fas fa-lock"></i>
                                                                <label for="current_password">Current password</label>
                                                                <input type="password" class="form-control form-control-user" id="current_password" placeholder="Enter Your Current Password Here.." name="current_password" required>
                                                                <span class="error-message" id="error-current-password" style="display:none;">Please fill the current password.</span>
                                                            </div>
                                                            <button type="button" class="btn btn-primary btn-user mt-3 float-right" id="check_password">Check Password</button>
                                                        </div>
                                                    </div>

                                                    <!-- New Password Fields (hidden by default) -->
                                                    <div id="new_password_fields" style="display: none;" class="mt-4 mb-2">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row mb-4">
                                                                    <div class="col-md-12 mb-3">
                                                                        <div class="input-icon">
                                                                            <i class="fas fa-lock"></i>
                                                                            <label for="password">New Password</label>
                                                                            <input type="password" class="form-control form-control-user" id="password" placeholder="Enter Your New Password Here.." name="password" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 mb-3">
                                                                        <div class="input-icon">
                                                                            <i class="fas fa-lock"></i>
                                                                            <label for="cpassword">Confirm Password</label>
                                                                            <input type="password" class="form-control form-control-user" id="cpassword" placeholder="Enter Your Password Again.." name="cpassword" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 text-end mt-3 mb-3">
                                                                    <button type="submit" class="btn btn-primary btn-user btn-block" name="update_password">Update Password</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                                <!-- Bootstrap Modal -->
                                                <div class="modal fade" id="newPasswordModal" tabindex="-1" aria-labelledby="newPasswordModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title" id="newPasswordModalLabel">Update Password</h3>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="update_password.php" method="post" enctype="multipart/form-data">
                                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                                    <div class="container">
                                                                        <div class="row mb-4">
                                                                            <div class="col-md-12 mb-3">
                                                                                <div class="input-icon">
                                                                                    <i class="fas fa-lock"></i>
                                                                                    <label for="modal_password">New Password</label>
                                                                                    <input type="password" class="form-control form-control-user" id="modal_password" placeholder="Enter Your New Password Here.." name="password" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 mb-3">
                                                                                <div class="input-icon">
                                                                                    <i class="fas fa-lock"></i>
                                                                                    <label for="modal_cpassword">Confirm Password</label>
                                                                                    <input type="password" class="form-control form-control-user" id="modal_cpassword" placeholder="Enter Your Password Again.." name="cpassword" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 text-end mt-3 mb-3">
                                                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="update_password">Update Password</button>
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
                            </div>

                            <script>
                                // Update Password button click event handler
                                document.getElementById('check_password').addEventListener('click', function() {
                                    var currentPassword = document.getElementById('current_password').value;
                                    var userId = document.querySelector('input[name="id"]').value;

                                    var errorMessage = document.getElementById('error-current-password');

                                    if (currentPassword.trim() === '') {
                                        errorMessage.style.display = 'block'; // Show error message
                                        return;
                                    } else {
                                        errorMessage.style.display = 'none'; // Hide error message
                                    }

                                    var xhr = new XMLHttpRequest();
                                    xhr.open("POST", "check_password.php", true);
                                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                    xhr.onreadystatechange = function() {
                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                            if (xhr.responseText.trim() === "success") {
                                                // Populate modal fields with values from the form
                                                document.getElementById("modal_password").value = "";
                                                document.getElementById("modal_cpassword").value = ""; // Clear confirm password field
                                                // Show the modal
                                                $('#newPasswordModal').modal('show');
                                            } else {
                                                errorMessage.textContent = "Incorrect current password.";
                                                errorMessage.style.display = 'block'; // Show error message
                                            }
                                        }
                                    };
                                    xhr.send("current_password=" + encodeURIComponent(currentPassword) + "&id=" + encodeURIComponent(userId));
                                });
                            </script>




                            <!-- -------------------------------------- MMM section -------------------------------------- -->
                            <div class="tab-pane fade" id="nav-mmm" role="tabpanel" aria-labelledby="nav-mmm-tab">
                                <div class="container p-3">
                                    MMM content
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- right side colm md -4  -->



                </div>

            </div>

        </div>
    </div>



    <style>
        .profile-env>header {
            position: relative;
            z-index: 20;
            margin-top: 30px;
        }

        .dropdown-menu {
            left: -78px;
            /* margin-left: 10px; */
        }

        .profile-env>header .profile-picture {
            position: relative;
        }

        .profile-env>header .profile-picture img {
            float: right;
            -moz-box-shadow: 0px 0px 0px 5px rgba(255, 255, 255, 0.9);
            -webkit-box-shadow: 0px 0px 0px 5px rgba(255, 255, 255, 0.9);
            box-shadow: 0px 0px 0px 5px rgba(255, 255, 255, 0.9);
            -moz-transition: all 300ms ease-in-out;
            -webkit-transition: all 300ms ease-in-out;
            -o-transition: all 300ms ease-in-out;
            transition: all 300ms ease-in-out;
        }

        .profile-env>header .profile-picture:hover img {
            zoom: 1;
            -webkit-opacity: 0.5;
            -moz-opacity: 0.5;
            opacity: 0.5;
            filter: alpha(opacity=50);
        }

        .profile-env>header .profile-info-sections {
            margin: 0;
            padding: 0;
            margin-top: 15px;
            padding-left: 0;
            list-style: none;
            margin-left: -5px;
        }

        .profile-env>header .profile-info-sections>li {
            display: inline-block;
            padding-left: 5px;
            padding-right: 5px;
        }

        .profile-env>header .profile-info-sections .profile-name strong,
        .profile-env>header .profile-info-sections .profile-name span {
            display: block;
        }

        .profile-env>header .profile-info-sections .profile-name strong {
            font-size: 18px;
            font-weight: normal;
        }

        .profile-env>header .profile-info-sections .profile-name span {
            font-size: 12px;
            color: #bbbbbb;
        }

        .profile-env>header .profile-info-sections .profile-name span a {
            color: #bbbbbb;
            -moz-transition: all 300ms ease-in-out;
            -webkit-transition: all 300ms ease-in-out;
            -o-transition: all 300ms ease-in-out;
            transition: all 300ms ease-in-out;
        }

        .profile-env>header .profile-info-sections .profile-name span a:hover {
            color: #888888;
        }

        .profile-env>header .profile-info-sections .profile-name .user-status {
            position: relative;
            display: inline-block;
            background: #575d67;
            top: -2px;
            margin-left: 5px;
            width: 6px;
            height: 6px;
            -webkit-border-radius: 6px;
            -webkit-background-clip: padding-box;
            -moz-border-radius: 6px;
            -moz-background-clip: padding;
            border-radius: 6px;
            background-clip: padding-box;
            -moz-transition: all 300ms ease-in-out;
            -webkit-transition: all 300ms ease-in-out;
            -o-transition: all 300ms ease-in-out;
            transition: all 300ms ease-in-out;
        }

        .profile-env>header .profile-info-sections .profile-name .user-status.is-online {
            background-color: #06b53c;
        }

        .profile-env>header .profile-info-sections .profile-name .user-status.is-offline {
            background-color: #575d67;
        }

        .profile-env>header .profile-info-sections .profile-name .user-status.is-idle {
            background-color: #f7d227;
        }

        .profile-env>header .profile-info-sections .profile-name .user-status.is-busy {
            background-color: #ee4749;
        }

        .profile-env>header .profile-info-sections .profile-stat h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .profile-env>header .profile-info-sections .profile-stat span {
            color: #bbbbbb;
        }

        .profile-env>header .profile-info-sections .profile-stat span a {
            color: #bbbbbb;
            -moz-transition: all 300ms ease-in-out;
            -webkit-transition: all 300ms ease-in-out;
            -o-transition: all 300ms ease-in-out;
            transition: all 300ms ease-in-out;
        }

        .profile-env>header .profile-info-sections .profile-stat span a:hover {
            color: #888888;
        }

        .profile-env>header .profile-info-sections>li {
            padding: 0 40px;
            position: relative;
        }

        .profile-env>header .profile-info-sections>li+li:after {
            content: '';
            display: block;
            position: absolute;
            top: 15px;
            bottom: 0;
            left: 0;
            width: 1px;
            background: #ebebeb;
            margin: 8px 0;
        }

        .profile-env>header .profile-info-sections>li:first-child {
            padding-left: 0;
        }

        .profile-env>header .profile-buttons {
            margin-top: 35px;
        }

        .profile-env>header .profile-buttons a {
            margin: 0 4px;
            -moz-transition: all 300ms ease-in-out;
            -webkit-transition: all 300ms ease-in-out;
            -o-transition: all 300ms ease-in-out;
            transition: all 300ms ease-in-out;
        }

        .profile-env section {
            position: relative;
            z-index: 10;
        }

        .profile-env section.profile-info-tabs {
            position: relative;
            background: #f1f1f1;
            margin-left: -20px;
            margin-right: -20px;
            padding: 20px;
            margin-top: -20px;
            margin-bottom: 30px;
        }

        .profile-env section.profile-info-tabs .user-details {
            padding-left: 0;
            list-style: none;
        }

        .profile-env section.profile-info-tabs .user-details li {
            margin-bottom: 10px;
        }

        .profile-env section.profile-info-tabs .user-details li a {
            color: #a0a0a0;
            -moz-transition: all 300ms ease-in-out;
            -webkit-transition: all 300ms ease-in-out;
            -o-transition: all 300ms ease-in-out;
            transition: all 300ms ease-in-out;
        }

        .profile-env section.profile-info-tabs .user-details li a:hover {
            color: #606060;
        }

        .profile-env section.profile-info-tabs .user-details li a:hover span {
            color: #e72c28;
        }

        .profile-env section.profile-info-tabs .user-details li a i {
            margin-right: 5px;
        }

        .profile-env section.profile-info-tabs .user-details li a span {
            color: #ec5956;
            font-weight: normal;
            -moz-transition: all 300ms ease-in-out;
            -webkit-transition: all 300ms ease-in-out;
            -o-transition: all 300ms ease-in-out;
            transition: all 300ms ease-in-out;
        }

        .profile-env section.profile-info-tabs .nav-tabs {
            position: relative;
            margin-bottom: -20px;
            border-bottom: 0;
        }

        .profile-env section.profile-info-tabs .nav-tabs>li:first-child a {
            margin-left: 0;
        }

        .profile-env section.profile-info-tabs .nav-tabs li {
            margin-bottom: 0;
        }

        .profile-env section.profile-info-tabs .nav-tabs li a {
            border: none;
            padding: 10px 35px;
            font-size: 13px;
            background: #e1e1e1;
            margin-right: 10px;
        }

        .profile-env section.profile-info-tabs .nav-tabs li.active a {
            background: #fff;
        }

        .profile-env section.profile-feed {
            margin-bottom: 15px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .profile-env section.profile-feed .profile-post-form {
            border: 1px solid #ebebeb;
            margin-bottom: 30px;
            -webkit-border-radius: 3px;
            -webkit-background-clip: padding-box;
            -moz-border-radius: 3px;
            -moz-background-clip: padding;
            border-radius: 3px;
            background-clip: padding-box;
        }

        .profile-env section.profile-feed .profile-post-form .form-control {
            border: none;
            -moz-box-shadow: none;
            -webkit-box-shadow: none;
            box-shadow: none;
            margin: 0;
            background: #fff;
            min-height: 80px;
            -webkit-border-radius: 3px;
            -webkit-background-clip: padding-box;
            -moz-border-radius: 3px;
            -moz-background-clip: padding;
            border-radius: 3px;
            background-clip: padding-box;
        }

        .profile-env section.profile-feed .profile-post-form .form-options {
            background: #f3f3f3;
            border-top: 1px solid #ebebeb;
            padding: 10px;
        }

        .profile-env section.profile-feed .profile-post-form .form-options:before,
        .profile-env section.profile-feed .profile-post-form .form-options:after {
            content: " ";
            display: table;
        }

        .profile-env section.profile-feed .profile-post-form .form-options:after {
            clear: both;
        }

        .profile-env section.profile-feed .profile-post-form .form-options .post-type {
            float: left;
            padding-top: 6px;
        }

        .profile-env section.profile-feed .profile-post-form .form-options .post-type a {
            margin-left: 10px;
            font-size: 13px;
            color: #aaaaaa;
            -moz-transition: all 300ms ease-in-out;
            -webkit-transition: all 300ms ease-in-out;
            -o-transition: all 300ms ease-in-out;
            transition: all 300ms ease-in-out;
        }

        .profile-env section.profile-feed .profile-post-form .form-options .post-type a:hover {
            color: #303641;
        }

        .profile-env section.profile-feed .profile-post-form .form-options .post-submit {
            float: right;
        }

        .profile-env section.profile-feed .profile-post-form .form-options .post-submit .btn {
            padding-left: 20px;
            padding-right: 20px;
        }

        .profile-env section.profile-feed .profile-stories article.story {
            margin: 30px 0;
        }

        .profile-env section.profile-feed .profile-stories article.story:before,
        .profile-env section.profile-feed .profile-stories article.story:after {
            content: " ";
            display: table;
        }

        .profile-env section.profile-feed .profile-stories article.story:after {
            clear: both;
        }

        .profile-env section.profile-feed .profile-stories article.story .user-thumb {
            float: left;
            width: 8%;
        }

        .profile-env section.profile-feed .profile-stories article.story .user-thumb a img {
            -moz-box-shadow: 0px 0px 0px 3px rgba(0, 0, 0, 0.04);
            -webkit-box-shadow: 0px 0px 0px 3px rgba(0, 0, 0, 0.04);
            box-shadow: 0px 0px 0px 3px rgba(0, 0, 0, 0.04);
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content {
            float: right;
            width: 92%;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content header {
            display: block;
            margin-bottom: 10px;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content header:before,
        .profile-env section.profile-feed .profile-stories article.story .story-content header:after {
            content: " ";
            display: table;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content header:after {
            clear: both;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content header .publisher {
            float: left;
            color: #9b9fa6;
            font-size: 14px;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content header .publisher a {
            color: #303641;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content header .publisher em {
            display: block;
            font-style: normal;
            font-size: 12px;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content header .story-type {
            float: right;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content .story-main-content {
            font-size: 13px;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content .story-main-content p {
            font-size: 13px;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer {
            margin-top: 15px;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .liked i {
            color: #ff4e50;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer>a {
            margin-right: 30px;
            display: inline-block;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer>a span {
            zoom: 1;
            -webkit-opacity: 0.6;
            -moz-opacity: 0.6;
            opacity: 0.6;
            filter: alpha(opacity=60);
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments {
            list-style: none;
            margin: 0;
            padding: 0;
            margin-top: 30px;
            border-top: 1px solid #ebebeb;
            padding-top: 20px;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li {
            display: table;
            vertical-align: top;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li:before,
        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li:after {
            content: " ";
            display: table;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li:after {
            clear: both;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li+li {
            margin-top: 15px;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li .user-comment-thumb,
        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li .user-comment-content {
            display: table-cell;
            vertical-align: top;
            width: 100%;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li .user-comment-thumb {
            width: 1%;
            padding-right: 20px;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li .user-comment-content {
            border-bottom: 1px solid #ebebeb;
            padding-bottom: 15px;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li .user-comment-content .user-comment-name {
            font-weight: bold;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li .user-comment-content .user-comment-meta {
            font-size: 11px;
            margin-top: 15px;
            color: #9b9fa6;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li .user-comment-content .user-comment-meta a {
            color: #8d929a;
            margin-right: 5px;
            -moz-transition: all 300ms ease-in-out;
            -webkit-transition: all 300ms ease-in-out;
            -o-transition: all 300ms ease-in-out;
            transition: all 300ms ease-in-out;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li .user-comment-content .user-comment-meta a+a {
            margin-left: 5px;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li .user-comment-content .user-comment-meta a i {
            zoom: 1;
            -webkit-opacity: 0.8;
            -moz-opacity: 0.8;
            opacity: 0.8;
            filter: alpha(opacity=80);
            -moz-transition: all 300ms ease-in-out;
            -webkit-transition: all 300ms ease-in-out;
            -o-transition: all 300ms ease-in-out;
            transition: all 300ms ease-in-out;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li .user-comment-content .user-comment-meta a:hover {
            color: #737881;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li .user-comment-content .user-comment-meta a:hover i {
            zoom: 1;
            -webkit-opacity: 1;
            -moz-opacity: 1;
            opacity: 1;
            filter: alpha(opacity=100);
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li.comment-form .user-comment-content {
            position: relative;
            border-bottom: 0;
            padding-bottom: 0;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li.comment-form .user-comment-content .form-control {
            background: #eeeeee;
            border: 0;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li.comment-form .user-comment-content .btn {
            position: absolute;
            right: 5px;
            top: 5px;
            border: 0;
            background: transparent;
            color: #737881;
            font-size: 13px;
            zoom: 1;
            -webkit-opacity: 0.7;
            -moz-opacity: 0.7;
            opacity: 0.7;
            filter: alpha(opacity=70);
            -moz-transition: all 300ms ease-in-out;
            -webkit-transition: all 300ms ease-in-out;
            -o-transition: all 300ms ease-in-out;
            transition: all 300ms ease-in-out;
        }

        .profile-env>header .profile-picture img {
            width: 150px;
            float: none;
            display: inline-block;
            margin-bottom: 15px;
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content footer .comments li.comment-form .user-comment-content .btn:hover {
            zoom: 1;
            -webkit-opacity: 1;
            -moz-opacity: 1;
            opacity: 1;
            filter: alpha(opacity=100);
        }

        .profile-env section.profile-feed .profile-stories article.story .story-content hr {
            margin-top: 40px;
        }

        @media (max-width: 992px) {
            .profile-env>header .profile-picture img {
                width: 90%;
            }

            .dropdown-menu {
                left: -78px;
                margin: .125rem -100px 0;
                /* margin-left: 10px; */
            }

            .profile-env>header .profile-buttons {
                margin-top: 18px;
            }

            .profile-env>header .profile-info-sections .profile-name strong,
            .profile-env>header .profile-info-sections .profile-stat h3 {
                font-size: 16px;
            }

            .profile-env>header .profile-info-sections {
                margin-top: 0;
            }

            .profile-env>header .profile-info-sections>li {
                padding: 0 20px;
            }

            .profile-env section.profile-info-tabs .nav-tabs li a {
                padding-left: 25px;
                padding-right: 25px;
            }

            .profile-env section.profile-feed .profile-stories article.story .user-thumb {
                width: 10%;
            }

            .profile-env section.profile-feed .profile-stories article.story .story-content {
                width: 90%;
            }
        }

        @media (max-width: 768px) {
            .profile-env section.profile-info-tabs {
                margin-top: 30px;
            }

            .dropdown-menu {
                left: -78px;
                /* margin-left: 10px; */
                margin: .125rem -100px 0;
            }

            .profile-env>header .profile-picture img {
                float: none;
            }

            .profile-env>header .profile-buttons a {
                margin-bottom: 5px;
            }
        }

        @media (max-width: 601px) {
            .profile-env>header .profile-info-sections {
                margin-bottom: 10px;
            }

            .dropdown-menu {
                left: -78px;
                /* margin-left: 10px; */
                margin: .125rem -100px 0;
            }

            .profile-env>header .profile-info-sections li {
                padding: 15px;
            }

            .profile-env>header .profile-info-sections>li:first-child {
                padding-left: 0;
            }

            .profile-env>header .profile-buttons {
                margin-top: 0;
            }

            .profile-env>header .profile-picture {
                text-align: center;
                display: block;
            }

            .profile-env>header .profile-picture img {
                /* width: auto; */
                float: none;
                display: inline-block;
                margin-bottom: 15px;
            }

            .profile-env section.profile-feed .profile-stories article.story .user-thumb {
                width: 18%;
            }

            .profile-env section.profile-feed .profile-stories article.story .story-content {
                width: 82%;
            }

            .profile-env section.profile-info-tabs .nav-tabs li a {
                padding-left: 15px;
                padding-right: 15px;
                margin-right: 5px;
                font-size: 12px;
            }

            .profile-env section.profile-feed {
                padding: 0;
            }

            .profile-env .col-sm-7,
            .profile-env .col-sm-3 {
                text-align: center;
            }

            .profile-env .col-sm-7 .profile-info-sections,
            .profile-env .col-sm-3 .profile-info-sections,
            .profile-env .col-sm-7 .profile-buttons,
            .profile-env .col-sm-3 .profile-buttons {
                display: inline-block;
            }

            .profile-env>header .profile-info-sections>li+li:after {
                margin: 18px 0;
            }
        }
    </style>












    <!-- Additional Scripts -->
    </body>





















    <!-- ------------------- footer section below ------------------ -->
    <!-- ------------------- footer section  below------------------ -->
</main>

<?php include("includes/footer.php"); ?>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>


<!-- -------------------------------- FOoter Section ----------------------------------- -->
<!-- -------------------------------- FOoter Section ----------------------------------- -->
<!-- -------------------------------- FOoter Section ----------------------------------- -->

<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> -->




<script>
    <?php

    // messages from corect or not 

    if (isset($_SESSION['message'])) {
    ?>
        alertify.set('notifier', 'position', 'bottom-right');
        alertify.success('Current position : ' + alertify.get('notifier', 'position'));

        alertify.success('<?= $_SESSION['message'] ?>');
    <?php
        unset($_SESSION['message']);
    }
    ?>
</script>