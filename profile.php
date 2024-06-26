<?php
session_start();
require "includes/header.php";
require "userDashboards/includes/head.php";
require "Database/connection.php";

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
    $row = mysqli_fetch_array($result);
    $cv_file = $row['studentCV'];
} else {
    echo "No user found ";
    exit();
}


// ----------------------------------------------- applicants and jobs and jobseekers ---------------- 



// $getting_job_applied_id = "SELECT * FROM applicants WHERE jobseeker_id = $user_id ";
// $getting_job_applied_id_run = mysqli_query($conn, $getting_job_applied_id);
// $get_id_applicants = mysqli_fetch_array($getting_job_applied_id_run);
// $j_id = $get_id_applicants['applied_job_id'];

// ----------------------------------------------- applicants and jobs and jobseekers ---------------- 






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/formstyle.css">


    <style>
        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            color: #ffffff;
            background-color: #000699;
            border-color: #dee2e6 #dee2e6 #fff;
            font-weight: 700;
        }

        .nav-tabs .nav-link {
            color: white;
        }


        /* -------- icon design ------------------ */
        .icon-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ffffff;
            /* White background for the circle */
            color: #000000;
            /* Icon color (change as needed) */
            font-size: 20px;
            /* Icon size (change as needed) */
        }


        .icon-circle:hover {
            background-color: #a70202;
            color: white;
        }

        .text-with-icon {
            display: flex;
            align-items: center;
        }


        /* -------- End icon design ------------------ */

        .update_pas_field .fa,
        .update_pas_field .fas {
            font-weight: 900;
            margin-top: 15px;
            /* position: relative; */
        }



        .img-thumbnail {
            border-radius: 100px;

        }


        /*--------------------  modal  ---------------------------------------------- */

        .modal-title {
            font-size: 30px;
            font-weight: 700;
        }

        .error-message {
            position: absolute;
            top: 100%;
            /* Position the error message below the input field */
            left: 0;
            color: red;
            /* Color for the error message */
            font-size: 12px;
            /* Adjust font size if needed */
            margin-top: 5px;
            /* Add some space between the input and the error message */
        }

        .profile-image {
            max-width: 240px;
            border-radius: 150px;
            animation: zoomInOut 5s infinite;
        }

        @keyframes zoomInOut {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.3);
            }
        }


        /* --------------- nav spave pagination -----------------  */
        .custom-pagination-item {
            margin: 0 5px;
        }


        /* end modal ------------------------------------  */
    </style>



<body class="body_backgorund">

    <?php require "includes/navbar.php"; ?>



    <!-- ----------------------------------------- New Trying --------------------------------- -->







    <!-- -----------------------------------------  -->

    <div class="container mt-4 mb-4">
        <div class="row">

            <div class="col-md-4 order-md-1 mb-4 order-2 d-flex justify-content-center">
                <div class="card shadow">
                    <div class="card-center d-flex justify-content-center">
                        <?php if (!empty($row["profile"])) : ?>
                            <img src="userDashboards/uploads/profiles/<?= $row["profile"] ?>" alt="Profile Image" class="img-fluid shadow profile-image">
                        <?php else : ?>
                            <img src="https://thumbs.dreamstime.com/b/businessman-avatar-image-beard-hairstyle-male-profile-vector-illustration-178545831.jpg" alt="Placeholder Image" class="img-fluid shadow profile-image" style="max-width: 200px; border-radius: 150px;">
                        <?php endif; ?>
                    </div>

                </div>
            </div>

            <div class="col-md-8 order-md-2 order-1 d-flex align-items-center">
                <div class="p-3 bbb" style="margin-left: 50px;">
                    <div class="chakra-petch-bold">
                        <h3 class="text-white mb-3" style="font-size: 40px;"><?= $row['firstname'] ?>
                            <?= $row['lastname'] ?>
                        </h3>
                        <p class="text-white text-with-icon mb-3" style="font-size: 20px;">
                            <span class="icon-circle"><i class="fas fa-envelope"></i></span> &nbsp; &nbsp;
                            <?= $row['email'] ?>
                        </p>
                        <p class="text-white text-with-icon mb-3" style="font-size: 20px;">
                            <span class="icon-circle"><i class="fas fa-phone"></i></span> &nbsp; &nbsp; +94
                            <?= $row['phone_no'] ?>
                        </p>
                        <p class="text-white text-with-icon mb-3" style="font-size: 20px;">
                            <span class="icon-circle"><i class="fas fa-map-marker-alt"></i></span> &nbsp; &nbsp;
                            <?= $row['St_address'] ?>
                        </p>
                    </div>
                    <hr class="custom-hr" style="width: 50%;">
                </div>
            </div>


        </div>
    </div>



    <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col-md-8">
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
                        <div class="container p-3 text-white">
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
                                                        <div class="row">
                                                            <div class="col-md-4 d-flex align-items-center justify-content-center">
                                                                <!-- Image -->
                                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-QCKIyHiPkoouLv349z1C4-vuEvaY8pX95A&s" alt="Image" class="img-fluid" style="max-width:100px; border-radius: 20px;">
                                                            </div>
                                                            <div class="col-md-4 d-flex align-items-center">
                                                                <div>
                                                                    <!-- Name and company -->
                                                                    <h4 class="chakra-petch-bold mb-2" style="font-size: 20px;"><?= $rows['job_title'] ?></h4>
                                                                    <p></p>
                                                                    <!-- Location -->
                                                                    <p><i class="fas fa-building mb-2" style="font-size: 15px;"></i> &nbsp; <?= $rows['company_name'] ?></p>
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
                                                                    <span class="<?= $badge_class ?> px-3 py-1"> <?= $status ?> </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 d-flex align-items-center">
                                                                <div>
                                                                    <!-- Application Date -->
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

                    </div>





                    <!--  -------------------------------------- Profile information section --------------------------------------  -->


                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="container p-3">
                                    <div class="row mt-4 mb-4">
                                        <div class="col-md-12">
                                            <h3 class="text-muted font-weight-bolder mb-3" style="font-size: 30px;">My
                                                Information</h3>
                                            <hr>
                                        </div>
                                    </div>
                                    <form action="update_jobseeker.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <!-- Add hidden input for user ID -->
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">

                                            <div class="col-md-6">
                                                <div class="form-group input-icon">
                                                    <i class="fas fa-user"></i>
                                                    <input type="text" class="form-control form-control-user" id="Fname" name="Fname" placeholder="First Name" value="<?= $row['firstname'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-icon">
                                                    <i class="fas fa-user"></i>
                                                    <input type="text" class="form-control form-control-user" id="Lastname" name="Lastname" placeholder="Last Name" value="<?= $row['lastname'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-icon">
                                                    <i class="fas fa-envelope"></i>
                                                    <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="example@gmail.com" value="<?= $row['email'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-icon">
                                                    <i class="fas fa-user-tag"></i>
                                                    <input type="text" class="form-control form-control-user" id="UserType" name="UserType" placeholder="User Type" value="<?= $row['usertype'] ?>" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-icon">
                                                    <i class="fas fa-phone"></i>
                                                    <input type="text" class="form-control form-control-user" id="Contact" name="Contact" placeholder="Contact" value="<?= $row['phone_no'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-icon">
                                                    <i class="fas fa-address-card"></i>
                                                    <input type="text" class="form-control form-control-user" id="St_address" name="St_address" placeholder="Address" value="<?= $row['St_address'] ?>" required>
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-group input-icon">
                                                    <!-- <i class="fas fa-image"></i> -->
                                                    <?php if (!empty($row["profile"])) : ?>
                                                        <div class="mb-3">
                                                            <img src="userDashboards/uploads/profiles/<?= $row["profile"] ?>" alt="Profile Image" class="img-thumbnail" style="max-width: 100px; ">
                                                        </div>
                                                    <?php endif; ?>
                                                    <input type="file" class="form-control-file" id="editCompanyLogo" name="editCompanyLogo">
                                                </div>
                                            </div>
                                            <div class="col-12 text-end">
                                                <button type="submit" class="btn btn-primary btn-user btn-block"><i class="fas fa-save"></i> &nbsp; Update
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>







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
                                <div class="card shadow">
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
                                                        <span class="error-message" id="error-current-password" style="display:none;">Please fill the current
                                                            password.</span>
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
                                                        <h3 class="modal-title" id="newPasswordModalLabel">Update
                                                            Password</h3>
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
                                                                            <label for="password">New Password</label>
                                                                            <input type="password" class="form-control form-control-user" id="password" placeholder="Enter Your New Password Here.." name="password" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 mb-3">
                                                                        <div class="input-icon">
                                                                            <i class="fas fa-lock"></i>
                                                                            <label for="cpassword">Confirm
                                                                                Password</label>
                                                                            <input type="password" class="form-control form-control-user" id="cpassword" placeholder="Enter Your Password Again.." name="cpassword" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 text-end mt-3 mb-3">
                                                                <button type="submit" class="btn btn-primary btn-user btn-block" name="update_password">Update
                                                                    Password</button>
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
                                        document.getElementById("password").value = currentPassword;
                                        document.getElementById("cpassword").value = ""; // Clear confirm password field
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
            <div class="col-md-4 text-center">
                <?php if (!empty($cv_file)) : ?>
                    <iframe src="resumes/<?= htmlspecialchars($cv_file) ?>#toolbar=0" width="400px" height="600px" style="border: none;"></iframe>
                <?php else : ?>
                    <h4 class="text-white">No CV available.</h4>
                <?php endif; ?>
            </div>


        </div>

    </div>



    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>