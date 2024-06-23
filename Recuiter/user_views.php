<?php
session_start();
include "include/header.php";
include("../Database/connection.php");


// $re_name = $_SESSION['first_name'];
$re_email = $_SESSION['user_email'];


if (!isset($_SESSION['user_id'])) {
    header("location: ../index.php");
}




?>


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
                    <h1>User Details </h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Recuiter </a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a class="active" href="subscribers">Followers </a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>

                        <li>
                            <a class="active" href="user_views">user_views </a>
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



            <!-- -------------------------- trying data ----------------------  -->


            <style>
               
                .profile-nav,
                .profile-info {
                    margin-top: 30px;
                }

                .profile-nav .user-heading {
                    background: #000739;
                    color: #fff;
                    border-radius: 4px 4px 0 0;
                    -webkit-border-radius: 29px 29px 29px 29px;
                    padding: 30px;
                    text-align: center;
                }

                .profile-nav .user-heading.round a {
                    border-radius: 50%;
                    -webkit-border-radius: 50%;
                    border: 10px solid rgba(255, 255, 255, 0.3);
                    display: inline-block;
                }

                .profile-nav .user-heading a img {
                    width: 112px;
                    height: 112px;
                    border-radius: 50%;
                    -webkit-border-radius: 50%;
                }

                .profile-nav .user-heading h1 {
                    font-size: 22px;
                    font-weight: 300;
                    margin-bottom: 5px;
                }

                .bio-graph-heading {
                    background: #000739;
                    color: #fff;
                    text-align: center;
                    font-style: italic;
                    padding: 40px 110px;
                    border-radius: 4px 4px 0 0;
                    -webkit-border-radius: 4px 4px 4px 0;
                    font-size: 16px;
                    font-weight: 300;
                }

                .bio-graph-info {
                    color: #89817e;
                }

                .bio-graph-info h1 {
                    font-size: 22px;
                    font-weight: 300;
                    margin: 0 0 20px;
                }

                .bio-row {
                    width: 50%;
                    float: left;
                    margin-bottom: 10px;
                    padding: 0 15px;
                }

                .bio-row p span {
                    width: 100px;
                    display: inline-block;
                }

                .bio-chart,
                .bio-desk {
                    float: left;
                }

                .bio-chart {
                    width: 40%;
                }

                .bio-desk {
                    width: 60%;
                }

                .bio-desk h4 {
                    font-size: 15px;
                    font-weight: 400;
                }

                .bio-desk h4.terques {
                    color: #4CC5CD;
                }

                .bio-desk h4.red {
                    color: #e26b7f;
                }

                .bio-desk h4.green {
                    color: #97be4b;
                }

                .bio-desk h4.purple {
                    color: #caa3da;
                }
            </style>


        <?php

        if(isset($_GET['id']))
        {
            $flw_id = $_GET['id'];
                // echo $flw_id;

                // $getFlwData = "SELECT userregister.*
                // FROM jobseeker_company_subscriptions
                // INNER JOIN userregister ON jobseeker_company_subscriptions.jobseeker_id = userregister.id
                // WHERE jobseeker_company_subscriptions.company_id = '$flw_id'";
                $getFlwData = "SELECT * FROM userregister WHERE id = '$flw_id'";
            $getFlwData_run = mysqli_query($conn, $getFlwData);
            $getFlwData_count = mysqli_num_rows($getFlwData_run);
            //fetch
            $getFlwData_fetch = mysqli_fetch_array($getFlwData_run);



            // echo $getFlwData_count;



            ?>
           
           

            <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"> -->
            <div class="container bootstrap snippets bootdey">
                <div class="table-data">
                <div class="row">
                    <div class="profile-nav col-md-3">
                        <div class="panel">
                            <div class="user-heading round">
                                <a href="#">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="">
                                </a>
                                <h1><?= $getFlwData_fetch['firstname'] ?></h1>
                                <p><?= $getFlwData_fetch['email'] ?></p>
                            </div>


                        </div>
                    </div>
                    <div class="profile-info col-md-9">

                        <div class="panel">
                            <div class="bio-graph-heading">
                                <!-- <h4> Bio Graph</h4> -->
                            </div>
                            <div class="panel-body bio-graph-info mt-4">
                                <div class="row">
                                    <div class="bio-row">
                                        <p><span>Full Name </span>: <?= $getFlwData_fetch['firstname'] ?> <?= $getFlwData_fetch['lastname'] ?></p>
                                    </div>
                                    
                                    <div class="bio-row">
                                        <p><span>Address </span>: <?= $getFlwData_fetch['St_address'] ?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Address </span>: <?= $getFlwData_fetch['St_address'] ?></p>
                                    </div>
                                    
                                    
                                    <div class="bio-row">
                                        <p><span>Email </span>: <?= $getFlwData_fetch['email'] ?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Mobile </span>: <?= $getFlwData_fetch['phone_no'] ?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Type </span>: <?= $getFlwData_fetch['usertype'] ?></p>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                
            </div>

            <!-- -------------------------- trying data ----------------------  -->


            <script src="script.js"></script>

            <?php

        }


       
