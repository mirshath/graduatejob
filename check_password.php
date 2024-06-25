<?php
session_start();
require 'Database/connection.php'; // Ensure this file contains your database connection

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST["current_password"];
    $userId = $_POST["id"];

    // Debugging: Log received values
    error_log("Current Password: $currentPassword, User ID: $userId");

    // Retrieve the stored hashed password from the database based on the user ID
    $sql = "SELECT password FROM userregister WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        error_log("Prepare failed: " . $conn->error);
        echo "failure";
        exit();
    }

    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];

        // Debugging: Log stored password
        // error_log("Stored Password: $storedPassword");

        // Verify the current password
        if (password_verify($currentPassword, $storedPassword)) {
            echo "success";
        } else {
            // error_log("Password verification failed");
            // $_SESSION['message'] = "Incorrect current password";
            echo "failure";
        }
    } else {
        // error_log("No matching user found or multiple entries");
        // $_SESSION['message'] = "Incorrect current password";

        echo "failure";
    }

    // Close statement
    $stmt->close();
    $conn->close();
}
?>