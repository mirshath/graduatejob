<?php
session_start(); // Start the session
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
header("Location: index"); // Redirect to the homepage
exit();
?>



   
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