<?php
include "headerFiles/header.php";
// include "Database/connection.php";
// $conn = new mysqli("localhost", "root", "", "BMS_JOB");
include '../Database/connection.php';





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
                <h1 class="h3 mb-2 text-gray-800">Pending Jobs Listing</h1>
                <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->



                <!-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addJobModal">Add New Job</button> -->

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary mt-3 mb-4">Pending Job Listing</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Job Title</th>
                                        <th class="text-center">Company Name</th>
                                        <th class="text-center">Images</th>
                                        <th class="text-center">Job Category</th>
                                        <th class="text-center">Job Post Date</th>
                                        <th class="text-center">Job Deadline</th>
                                        <th class="text-center">Action</th>

                                    </tr>
                                </thead>
                              
                                <tbody>

                                    <?php
                                    // user fetch code 
                                    // Fetch data from the database
                                    $sql = "SELECT * FROM jobs WHERE admin_status = 'Pending' ";
                                    $sql_run = mysqli_query($conn, $sql);


                                    // Check if there are any results
                                    if ($sql_run->num_rows > 0) {
                                        // Output data rows
                                        while ($row = mysqli_fetch_array($sql_run)) {
                                    ?>
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle;"> <?= $row["job_title"]; ?></td>
                                                <td style="text-align: center; vertical-align: middle;"> <?= $row["company_name"]; ?></td>
                                                <td style="text-align: center; vertical-align: middle;"><img src="uploads/<?= $row["company_logo"]; ?>" alt="Company Logo" style="width: 50px; border-radius: 25px;"></td>

                                                <td style="text-align: center; vertical-align: middle;"> <?= $row["job_category"]; ?></td>
                                                <td style="text-align: center; vertical-align: middle;"> <?= $row["created_at"]; ?></td>
                                                <td style="text-align: center; vertical-align: middle;"> <?= $row["application_deadline"]; ?> <br>
                                                    <?php
                                                    if ($row["application_deadline"] < date("Y-m-d")) {
                                                        echo "<span class='badge badge-danger'>Date Expired</span>";
                                                    } else {
                                                        echo "<span class='badge badge-success'>Active</span>";
                                                    }

                                                    ?></td>



                                                <td style="text-align: center; vertical-align: middle;">
                                                    <!-- Edit and View buttons -->
                                                    <a href='edit_job.php?id=<?php echo $row["id"]; ?>' class='btn btn-primary btn-sm'><i class="fas fa-edit"></i> &nbsp; &nbsp;<i class="fas fa-eye"></i></a>

                                                    <!-- <a href='view_job.php?id=<?php echo $row["id"]; ?>' class='btn btn-primary btn-sm'>View</a> -->

                                                    <!-- Delete button -->
                                                    <a href='delete.php?id=<?php echo $row["id"]; ?>' class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this job?')"> <i class="fas fa-trash-alt"></i> </a>

                                                    <!-- Dropdown for approve/reject -->
                                                    <form method="POST" action="update_status.php" style="display: inline-block; margin-top: 10px; margin-bottom: 10px;">
                                                        <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
                                                        <input type="hidden" name="cname" value="<?php echo $row['company_name']; ?>">
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton_<?php echo $row['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Choose Status
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $row['id']; ?>">
                                                                <button class="dropdown-item" type="submit" name="status" value="Approved">Approve</button>
                                                                <button class="dropdown-item" type="submit" name="status" value="Rejected">Reject</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </td>


                                            </tr>
                                    <?php

                                        }
                                    }

                                    ?>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>





            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->



    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->



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

</body>

</html>



<?php


?>



<script>
    <?php

    // messages from corect or not 

    if (isset($_SESSION['message'])) {
    ?>
        alertify.set('notifier', 'position', 'top-right');
        alertify.success('<?= $_SESSION['message'] ?>');
    <?php
        unset($_SESSION['message']);
    }
    ?>
</script>