<?php
// Start session
session_start();

$_SESSION = array();

session_destroy();

$_SESSION['message'] = "Logged Out Succesfully as a Admn";
header("Location: login.php");
exit();
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