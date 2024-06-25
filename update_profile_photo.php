<?php

session_start();
require 'Database/connection.php'; // Ensure this file contains your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['editProfilePhoto']) && isset($_POST['id'])) {
    $userId = $_POST['id'];
    $uploadDir = 'userDashboards/uploads/profiles/';
    $fileName = uniqid() . '.jpg'; // Generate a unique file name for the uploaded image
    $uploadFile = $uploadDir . $fileName;

    // Handle the uploaded blob
    if (move_uploaded_file($_FILES['editProfilePhoto']['tmp_name'], $uploadFile)) {
        // Update the database with the new file name only
        $sql = "UPDATE userregister SET profile = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $fileName, $userId);
        if ($stmt->execute()) {
            $_SESSION['message'] = 'Profile photo updated successfully!';
            echo 'success';
        } else {
            $_SESSION['message'] = 'Error updating profile photo.';
            echo 'error';
        }

        $stmt->close();
        $conn->close();
    } else {
        $_SESSION['message'] = 'Error uploading file.';
        echo 'error';
    }
} else {
    $_SESSION['message'] = 'Invalid request.';
    echo 'error';
}
