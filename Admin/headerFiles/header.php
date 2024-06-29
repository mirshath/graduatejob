<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- ------------------------------- alertify notification ----------------------------------- -->
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />

    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


    <!-- script for CKeditor -->

    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

</head>

<style>
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



    /* card  */



    .card {
        transition: background-color 0.4s ease;
    }

    .hoverEffect:hover .card {
        background-color: #f0f0f0;
        /* Change to your desired background color */
    }

    .card-center {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    @media (max-width: 768px) {
        .card-center {
            margin-top: -120px;
            /* Adjust this value for mobile view */
        }
    }

    @media (min-width: 769px) {
        .card-center {
            margin-top: -140px;
            /* Adjust this value for web view */
        }
    }


    /* End  card  */
</style>



<body id="page-top">