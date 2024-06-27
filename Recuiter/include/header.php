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

  <!-- Bootstrap core CSS -->
  <link href="https://demo.phpjabbers.com/free-web-templates/job-website-template-138/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Additional CSS Files -->
  <!-- <link rel="stylesheet" href="https://demo.phpjabbers.com/free-web-templates/job-website-template-138/assets/css/fontawesome.css">
    <link rel="stylesheet" href="https://demo.phpjabbers.com/free-web-templates/job-website-template-138/assets/css/style.css">
    <link rel="stylesheet" href="https://demo.phpjabbers.com/free-web-templates/job-website-template-138/assets/css/owl.css">
 -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


  <!-- ------------------------------- alertify notification ----------------------------------- -->
  <!-- CSS -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />

  <!-- JavaScript -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>

  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />


    <!-- script for CKeditor -->

    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>





  <!-- ---------- new dash recruiter  ------------------- -->
  <link
      href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"
      rel="stylesheet" />


    <!-- My CSS -->
    <link rel="stylesheet" href="style.css" />
    <!-- unicon link  -->

  

  <!-- ---------- new dash recruiter  ------------------- -->




</head>


<style>
  .alertify-notifier .ajs-message.ajs-success {
            color: black;
        }

  .circle-icon {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    /* Ensures the icon is vertically centered */
    border-radius: 50%;
    background-color: #ddd;
    /* Background color of the circle */
    text-align: center;
    color: #333;
    /* Icon color */
    font-size: 20px;
    /* Adjust size as needed */
  }

  ol, ul {
    padding-left: 0.5rem;
}



</style>


<body>



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