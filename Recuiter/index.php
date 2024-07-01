<?php
session_start();
include "include/header.php";
include("../Database/connection.php");


$re_email = $_SESSION['user_email'];
$com_name = $_SESSION['company_name'];

if (!isset($_SESSION['user_id'])) {
  header("location: recruiterLoginForm");
}


// -------------------------- fetching the job details ---------------------



// echo $com_name;




$job_data = "SELECT * FROM jobs WHERE company_name='$com_name' ORDER BY id DESC LIMIT 5";
$job_result = mysqli_query($conn, $job_data);

// Check if the query executed successfully
if ($job_result) {
  // Count the number of rows returned
  $num_jobs = mysqli_num_rows($job_result);
} else {
  // Handle the case where the query failed
  echo "Error executing query: " . mysqli_error($conn);
}


// -------------------------- END fetching the job details ---------------------



?>

<link rel="stylesheet" href="style.css">
<style>
  .no-data {
    text-align: center;
    color: red;
    font-size: 18px;
    font-weight: bold;
    padding: 20px;
  }

  .no-data-icon {
    font-size: 24px;
    margin-right: 8px;
    vertical-align: middle;
  }
</style>

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
          <h1>Dashboard</h1>
          <ul class="breadcrumb">
            <li>
              <a href="#">Dashboard</a>
            </li>
            <li><i class="bx bx-chevron-right"></i></li>
            <li>
              <a class="active" href="index">Home</a>
            </li>
          </ul>
        </div>
        <a href="#" class="" style="font-size: 20px;">
          <i class="bx bxs-user"></i> &nbsp;&nbsp;
          <span class="text">Welcome <span class="" style="font-weight: 900;"> <?= $com_name ?></span> </span>
        </a>
      </div>




      <ul class="box-info">
        <li>
          <i class="bx bxs-calendar-check"></i>
          <span class="text">
            <h3><?= $num_jobs ?></h3>
            <p>Posted Jobs</p>
          </span>
        </li>
        <li>
          <i class="bx bxs-group"></i>
          <span class="text">
            <h3>2834</h3>
            <p>Followers</p>
          </span>
        </li>
        <li>
          <i class="bx bxs-dollar-circle"></i>
          <span class="text">
            <h3>$2543</h3>
            <p>CV recieved</p>
          </span>
        </li>

      </ul>

      <div class="table-data">
        <div class="order">
          <div class="head">
            <h3>Recent Posted Jobs</h3>
            <!-- <i class="bx bx-search">more</i> -->
            <!-- <i class="bx bx-filter"></i> -->
            <a href="job_listing">more</a>
          </div>
          <table>
            <thead>
              <tr>
                <th>Title </th>
                <th>Job Posted date</th>
                <th>Deadline date</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>




              <?php
              if (mysqli_num_rows($job_result) > 0) {
                while ($job_getting_data = mysqli_fetch_assoc($job_result)) {
                  $job_title = $job_getting_data['job_title'];
                  $job_posted_date = $job_getting_data['created_at'];
                  $application_deadline = $job_getting_data['application_deadline'];
                  $admin_status = $job_getting_data['admin_status'];



              ?>
                  <tr>
                    <td>
                      <img src="../Admin/uploads/job_posters/<?= $job_getting_data['company_logo'] ?> " />
                      <p><?= $job_title ?></p>
                    </td>
                    <td><?= $job_posted_date ?></td>
                    <td><?= $application_deadline ?></td>
                    <td><?= $admin_status ?></td>
                  </tr>

                <?php
                }
              } else {

                ?>
                <tr>
                  <td colspan="4" class="no-data">
                    <i class="fas fa-exclamation-circle no-data-icon"></i>
                    No data found
                  </td>
                </tr>
              <?php
              }
              ?>

            </tbody>
          </table>
        </div>
        <div class="todo">
          <div class="head">
            <h3>Todos</h3>
            <i class="bx bx-plus"></i>
            <i class="bx bx-filter"></i>
          </div>
          <ul class="todo-list">
            <li class="completed">
              <p>Todo List</p>
              <i class="bx bx-dots-vertical-rounded"></i>
            </li>
            <li class="completed">
              <p>Todo List</p>
              <i class="bx bx-dots-vertical-rounded"></i>
            </li>
            <li class="not-completed">
              <p>Todo List</p>
              <i class="bx bx-dots-vertical-rounded"></i>
            </li>
            <li class="completed">
              <p>Todo List</p>
              <i class="bx bx-dots-vertical-rounded"></i>
            </li>
            <li class="not-completed">
              <p>Todo List</p>
              <i class="bx bx-dots-vertical-rounded"></i>
            </li>
          </ul>
        </div>
      </div>
    </main>
    <!-- MAIN -->
  </section>
  <!-- CONTENT -->

  <script src="script.js"></script>
</body>

</html>