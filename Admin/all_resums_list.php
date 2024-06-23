<?php
include "../Database/connection.php";
include "headerFiles/header.php";

session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
}

$getResumes = "SELECT * FROM applicants ORDER BY id DESC";
$getResumes_run = mysqli_query($conn, $getResumes);

// if (class_exists('ZipArchive')) {
//     echo 'ZipArchive is enabled.';
// } else {
//     echo 'ZipArchive is not enabled.';
// }

?>




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

                <!-- Page Heading -->
                <!-- Page Heading -->

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">All Resumes Are Here</h1>
                    <a href='download_all.php' class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i> &nbsp; &nbsp; All CV download</a>
                </div>




                <!-- DataTales Example -->
                <div class="card shadow mb-4 mt-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">All Resumes / CVs </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <p class="mr-3 mt-2">Filter</p>
                                        <input type="text" id="startDate" placeholder="Start Date" class="form-control" style="width: 150px; margin-right: 10px;">
                                        <input type="text" id="endDate" placeholder="End Date" class="form-control" style="width: 150px;">
                                    </div>
                                </div>
                            </div>

                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                   

                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Resume file</th>
                                        <th>Applied Date</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>

                                <tbody>


                                    <?php

                                    if (mysqli_num_rows($getResumes_run) > 0) {
                                        // output data of each row
                                        while ($row = mysqli_fetch_assoc($getResumes_run)) {


                                    ?>
                                            <tr>

                                                <td> <?= $row["name"] ?> </td>
                                                <td><?= $row["email"] ?></td>
                                                <td><a href="../resumes/<?= $row['resume_file'] ?>" target="_blank"><?= $row['resume_file'] ?></a></td>
                                                <td><?= date("Y-m-d", strtotime($row["applied_at"])) ?></td>
                                                <td>
                                                    <a href='download.php?id=<?= $row["id"] ?>' class='btn btn-success btn-sm'><i class="fas fa-download"></i></a>
                                                </td>
                                            </tr>


                                    <?php
                                        }
                                    } else {
                                        echo "0 results";
                                    }


                                    ?>





                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>






            </div>

        </div>

    </div>

</div>
<?php include("footer.php");  ?>


<!-- !-- jQuery UI CSS -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(function() {
        $("#startDate, #endDate").datepicker({
            dateFormat: "yy-mm-dd",
            onSelect: function() {
                filterTable();
            }
        });

        function filterTable() {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();

            if (startDate && endDate) {
                $('tbody tr').each(function() {
                    var appliedDate = $(this).find('td:nth-child(4)').text();
                    if (appliedDate >= startDate && appliedDate <= endDate) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        }
    });

    <?php
    if (isset($_SESSION['message'])) {
    ?>
        alertify.set('notifier', 'position', 'top-right');
        alertify.success('<?= $_SESSION['message'] ?>');
    <?php
        unset($_SESSION['message']);
    }
    ?>
</script>
