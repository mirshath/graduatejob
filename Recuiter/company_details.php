<?php
session_start();
include "include/header.php";
include("../Database/connection.php");


if (!isset($_SESSION['user_id'])) {
    header("location: ../index.php");
}


// side bar 
include("include/sidenav.php");



$rec_id = $_SESSION['user_id'];

$getUsers = "SELECT * FROM userregister WHERE id='$rec_id'";
$getUsers_run = mysqli_query($conn, $getUsers);

$row = mysqli_fetch_array($getUsers_run);
$profile = $row['profile'];




?>

<link rel="stylesheet" href="style.css">


<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <?php include("include/nav.php"); ?>
    <!-- NAVBAR -->


    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Company Details </h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Company Details </a>
                    </li>
                    <li><i class="bx bx-chevron-right"></i></li>
                    <li>
                        <a class="active" href="company_details"> Details</a>
                    </li>
                </ul>
            </div>
            <a href="#" class="btn-download">
                <i class="bx bxs-cloud-download"></i>
                <span class="text">Download PDF</span>
            </a>
        </div>

        <!-- --------------------------------  -->

        <div class="table-data mt-5">
            <div class="">
                <div class=" p-5" style="border-radius: 15px;">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="image-container">
                                <?php if (!empty($profile)) : ?>
                                    <img src="../Admin/uploads/company_profiles/<?= $profile ?>" alt="Profile Image" class="shadow" width="50%" style="border-radius: 25px;">
                                <?php else : ?>
                                    <img src="">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="container">
                                <form action="update_company.php" method="post" enctype="multipart/form-data">
                                    <div class="row mb-4">
                                        <!-- Add hidden input for user ID -->
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">

                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="websites">Company Name</label>
                                                <input type="text" class="form-control" readonly id="company_name" name="company_name" value="<?= $row['company_name'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="Email">Email</label>
                                                <input type="text" class="form-control" readonly id="email" name="email" value="<?= $row['email'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="UserType">UserType</label>
                                                <input type="text" class="form-control" readonly id="UserType" name="UserType" value="<?= $row['usertype'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="Contact">Contact</label>
                                                <input type="text" class="form-control" id="Contact" name="Contact" value="<?= $row['phone_no'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="websites">Websites</label>
                                                <input type="text" class="form-control" id="websites" name="websites" value="<?= $row['websites'] ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="editCompanyLogo">Company Profiles</label>
                                                <?php if (!empty($row["profiles"])) : ?>
                                                    <div class="mb-3">
                                                        <img src="../Admin/uploads/company_profiles/<?= $row["profiles"] ?>" alt="Company profiles logo" class="img-thumbnail" style="max-width: 150px;">
                                                    </div>
                                                <?php endif; ?>
                                                <input type="file" class="form-control-file" id="editCompanyLogo" name="editCompanyLogo">
                                            </div>
                                        </div>
                                        <div class="col-12 text-end">
                                            <input type="submit" value="Update The Company Details" name="update_company_details_btn" class="btn btn-primary ">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php

        ?>



        <script src="script.js"></script>