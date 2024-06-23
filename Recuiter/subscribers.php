<?php
session_start();
include "include/header.php";
include("../Database/connection.php");


$com_id = $_SESSION['user_id'];
$com_name = $_SESSION['company_name'];
$re_email = $_SESSION['user_email'];
// echo $com_id;

if (!isset($_SESSION['user_id'])) {
    header("location: ../index.php");
}



// ----------------------- 

// Constants for pagination
$results_per_page = 12; // Number of results per page

// Determine page number
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

// Calculate SQL LIMIT clause
$offset = ($page - 1) * $results_per_page;



$getUsers_query = "SELECT userregister.*
FROM jobseeker_company_subscriptions
INNER JOIN userregister ON jobseeker_company_subscriptions.jobseeker_id = userregister.id
WHERE jobseeker_company_subscriptions.company_id = '$com_id'
LIMIT $offset, $results_per_page;";



$getUsers_query_run = mysqli_query($conn, $getUsers_query);
$getUsers_query_count = mysqli_num_rows($getUsers_query_run);
//  echo $getUsers_query_count;





// -------------------------- fetching the job details ---------------------



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
                    <h1>Subscribers</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Subscribers</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a class="active" href="index">Home</a>
                        </li>
                    </ul>
                </div>
                <a href="#" class="" style="font-size: 20px;">
                    <i class="bx bxs-user"></i> &nbsp;&nbsp;
                </a>
            </div>


            <div class="container" id="followed_people">
                <div class="row">

                    <?php




                    //wanna check row
                    if ($getUsers_query_count > 0) {
                        while ($getUsers_query_row = mysqli_fetch_array($getUsers_query_run)) {





                    ?>

                            <div class=" col-md-3 col-xl-4">
                                <div class="card">
                                    <a  href='user_views?id=<?= $getUsers_query_row["id"]; ?>'>

                                        <div class="card-body p-4 d-flex align-items-center gap-3">
                                            <img src="../userDashboards/uploads/profiles/<?= $getUsers_query_row['profile']  ?>" alt="" class="rounded-circle" width="40" height="40">
                                            <div>
                                                <h6 class="fw-semibold mb-0"><?= $getUsers_query_row['firstname'] ?> <?= $getUsers_query_row['lastname'] ?> </h6>
                                                <span class="fs-2 d-flex align-items-center"><i class="ti ti-map-pin text-dark fs-3 me-1"></i><?= $getUsers_query_row['email'] ?> </span>
                                            </div>
                                            <button class="btn btn-primary py-1 px-2 ms-auto">Followed</button>
                                        </div>
                                    </a>
                                </div>
                            </div>


                    <?php
                        }
                    }

                    ?>

                    <!-- Pagination -->
                    <div class="pagination">
                        <?php
                        // Determine total number of pages
                        $total_pages_query = "SELECT COUNT(*) AS total FROM jobseeker_company_subscriptions WHERE company_id = '$com_id';";
                        $result = mysqli_query($conn, $total_pages_query);
                        $row = mysqli_fetch_assoc($result);
                        $total_pages = ceil($row['total'] / $results_per_page);

                        // Display pagination links
                        for ($i = 1; $i <= $total_pages; $i++) {
                            // Add a space between each pagination link
                            echo "<a href='?page=$i' class='pagination-link'>$i</a>";
                        }
                        ?>
                    </div>

                    <style>
                        .pagination {
                            margin-top: 20px;
                            text-align: center;
                        }

                        .pagination-link {
                            display: inline-block;
                            padding: 5px 10px;
                            margin-right: 5px;
                            /* Add space between each link */
                            background-color: #f5f5f5;
                            border: 1px solid #ddd;
                            color: #333;
                            text-decoration: none;
                            border-radius: 5px;
                        }

                        .pagination-link:hover {
                            background-color: #e9e9e9;
                        }

                        .pagination-link.active {
                            background-color: #5d87ff;
                            color: #fff;
                        }
                    </style>



                </div>
            </div>





            <body>




                <style type="text/css">
                    #followed_people .d-flex {
                        display: flex !important;
                        flex-wrap: nowrap;
                        justify-content: space-between;
                    }


                    #followed_people .img-fluid {
                        max-width: 100%;
                        height: auto;
                    }

                    #followed_people .card {
                        margin-bottom: 30px;
                    }

                    #followed_people .overflow-hidden {
                        overflow: hidden !important;
                    }

                    #followed_people .p-0 {
                        padding: 0 !important;
                    }

                    #followed_people .mt-n5 {
                        margin-top: -3rem !important;
                    }

                    #followed_people .linear-gradient {
                        background-image: linear-gradient(#50b2fc, #f44c66);
                    }

                    #followed_people .rounded-circle {
                        border-radius: 50% !important;
                    }

                    #followed_people .align-items-center {
                        align-items: center !important;
                    }

                    #followed_people .justify-content-center {
                        justify-content: center !important;
                    }

                    #followed_people .d-flex {
                        display: flex !important;
                    }

                    #followed_people .rounded-2 {
                        border-radius: 7px !important;
                    }

                    #followed_people .bg-light-info {
                        --bs-bg-opacity: 1;
                        background-color: rgba(235, 243, 254, 1) !important;
                    }

                    #followed_people .card {
                        margin-bottom: 30px;
                    }

                    #followed_people .position-relative {
                        position: relative !important;
                    }

                    #followed_people .shadow-none {
                        box-shadow: none !important;
                    }

                    #followed_people .overflow-hidden {
                        overflow: hidden !important;
                    }

                    #followed_people .border {
                        border: 1px solid #ebf1f6 !important;
                    }

                    #followed_people .fs-6 {
                        font-size: 1.25rem !important;
                    }

                    #followed_people .mb-2 {
                        margin-bottom: 0.5rem !important;
                    }

                    #followed_people.d-block {
                        display: block !important;
                    }

                    #followed_people a {
                        text-decoration: none;
                    }

                    #followed_people .user-profile-tab .nav-item .nav-link.active {
                        color: #5d87ff;
                        border-bottom: 2px solid #5d87ff;
                    }

                    #followed_people .mb-9 {
                        margin-bottom: 20px !important;
                    }

                    #followed_people .fw-semibold {
                        font-weight: 600 !important;
                    }

                    #followed_people .fs-4 {
                        font-size: 1rem !important;
                    }

                    #followed_people .card,
                    .bg-light {
                        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
                    }

                    #followed_people .fs-2 {
                        font-size: .75rem !important;
                    }

                    #followed_people .rounded-4 {
                        border-radius: 4px !important;
                    }

                    #followed_people .ms-7 {
                        margin-left: 30px !important;
                    }
                </style>










        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="script.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

</body>

</html>