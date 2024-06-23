<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from demo.phpjabbers.com/free-web-templates/job-website-template-138/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 May 2024 08:12:56 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="https://demo.phpjabbers.com/free-web-templates/job-website-template-138/assets/images/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">

  <title>Job Portal</title>


  <style>
    .profile-image {
      margin-top: 267px;
      max-width: 240px;
      border-radius: 150px;
      transition: transform 0.3s ease;
      /* Add transition property */
    }

    .card:hover .profile-image {
      transform: scale(1.3);
      /* Scale up the image on hover */
    }

    .nav-tabs .nav-link:hover {
      background-color: #a70202;
      font-weight: 700;
      border-color: rgba(0, 0, 0, 0);
    }

    @media (max-width: 768px) {

      .profile-image {
        margin-top: 244px
      }

      .card-center {
        margin-top: -130px;
      }



      .bbb {
        text-align: center;
        /* margin-top: -149px;   */
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      .custom-hr {
        width: 50%;
        margin-left: auto;
        margin-right: auto;
      }


    }
  </style>
</head>





  <script>
    <?php

    // messages from corect or not 

    if (isset($_SESSION['message'])) {
    ?>
      alertify.set('notifier', 'position', 'bottom-right');
      alertify.success('<?= $_SESSION['message'] ?>');
    <?php
      unset($_SESSION['message']);
    }
    ?>
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>