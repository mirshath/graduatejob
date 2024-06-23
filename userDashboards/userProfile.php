<?php
session_start();
require "includes/header.php";
require "includes/head.php";
require "Database/connection.php";

// Redirect to index.php if user is not logged in
if (!isset($_SESSION['user_id'])) {
    // header("location: index.php");
    echo '<script>window.location.href = "index";</script>';
    exit();
}



?>

<?php require "includes/navbar.php"; ?>

<!-- preloder  -->
 <!-- Preloader CSS -->
<style>
    #preloader {
        position: fixed;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background: #fff;
        z-index: 9999;
    }

    .jumper {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .jumper>div {
        width: 15px;
        height: 15px;
        margin: 3px;
        background: #333;
        border-radius: 100%;
        animation: jump 1s infinite;
    }

    .jumper>div:nth-child(2) {
        animation-delay: 0.1s;
    }

    .jumper>div:nth-child(3) {
        animation-delay: 0.2s;
    }

    @keyframes jump {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-15px);
        }
    }
</style>


<!-- ***** Preloader Start ***** -->
<div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!-- ***** Preloader End ***** -->

<!-- Preloader Script -->
<script>
    window.addEventListener('load', function() {
        document.getElementById('preloader').style.display = 'none';
    });
</script>
