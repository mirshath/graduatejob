<?php
session_start();
include "headerFiles/header.php";
// include "Database/connection.php";
// $conn = new mysqli("localhost", "root", "", "BMS_JOB");
include '../Database/connection.php';



?>

<style>
    .circle-img {
        border-radius: 50%;
        width: 300px;
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


                // Check if the ID parameter is set
                if (isset($_GET['id'])) {

                    $userId = $_GET['id'];



                    $sql = "SELECT * FROM userregister WHERE id = $userId";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                        $user = mysqli_fetch_array($result);


                ?>



                        <!-- ---------------------- new update edit user page ----------------------------  -->


                        <div class="">
                            <!-- container set above  -->


                            <div class="card shadow p-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="javascript:history.back()">
                                                <div class="circle-icon">
                                                    <i class="fas fa-arrow-left"></i>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="h4 text-center">Update Your Profile Here &nbsp;&nbsp; <i class="fas fa-user"></i>
                                                &nbsp; <?= $user['firstname'] ?> &nbsp;&nbsp; </div>
                                            <hr>
                                        </div>
                                    </div>

                                    <form action="update_user.php" method="post" enctype="multipart/form-data">

                                        <input type="hidden" name="userId" value="<?= $user['id'] ?>">

                                        <div class="row mt-4 mb-4">
                                            <div class="col-md-5 d-flex justify-content-center align-items-center">
                                                <?php if (!empty($user["profile"])) : ?>
                                                    <img src="../userDashboards/uploads/profiles/<?= htmlspecialchars($user["profile"]); ?>" alt="profile pic" style="max-width: 250px;  border-radius: 25px;">
                                                <?php else : ?>
                                                    <img src="https://cdn-icons-png.freepik.com/512/3135/3135715.png" alt="default profile pic" class="img-fluid circle-img shadow" style="max-width: 50px; max-height: 50px; border-radius: 25px;">
                                                <?php endif; ?>
                                                <div class="d-flex flex-column align-items-center mt-4">
                                                    <input type="file" class="form-control-file mb-4" id="editCompanyLogo" name="editCompanyLogo">
                                                </div>
                                            </div>




                                            <div class="col-md-7">
                                                <div class="row mt-4 mb-4">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="firstName">First Name</label>
                                                            <input type="text" class="form-control" id="firstName" name="firstName" value="<?= $user['firstname'] ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="lastName">Last Name</label>
                                                            <input type="text" class="form-control" id="lastName" name="lastName" value="<?= $user['lastname'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email">Email Address</label>
                                                            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email">User Type</label>
                                                            <input type="email" class="form-control" readonly id="usertype" name="usertype" value="<?= $user['usertype'] ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email">Contact number</label>
                                                            <input type="text" class="form-control" id="phone_no" name="phone_no" value="<?= $user['phone_no'] ?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-7 d-flex justify-content-end align-items-center p-4">
                                                        <button type="submit" class="btn btn-primary">Update Profiles</button>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>



                                    </form>
                                </div>
                            </div>
                        </div>

                <?php

                    } else {
                        echo "No job found with ID: $jobId";
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

<?php


?>