<?php
session_start();
require 'Database/connection.php'; // Ensure this file contains your database connection


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_password'])) {
    $userId = $_POST["id"];
    $newPassword = $_POST["password"];
    $confirmNewPassword = $_POST["cpassword"];

    // Check if new password matches confirm password
    if ($newPassword !== $confirmNewPassword) {
        // echo "New passwords do not match!";
        $_SESSION['message'] = "New passwords do not match!";
        echo '<script>window.location.href = "userProfile";</script>';
        // header("Location: " . $_SERVER['PHP_SELF']);


        exit();
    }

    // Hash the new password
    $hashedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    // Update the password in the database
    $updateSql = "UPDATE userregister SET password = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("si", $hashedNewPassword, $userId);

    if ($updateStmt->execute()) {
        $_SESSION['message'] = "Password updated successfully";
        echo '<script>window.location.href = "userProfile";</script>';

        // header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error updating password: " . $updateStmt->error;
    }

    // Close statement
    $updateStmt->close();
    $conn->close();
}
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