<?php
session_start(); // Ensure session is started

include "Database/connection.php";
// require "includes/header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_GET['token'])) {
        // Database connection
    
    
        // Get token from URL
        $token = $_GET['token'];
    
        // Retrieve the input values
        $st_address = $_POST['st_address'];
        $education_qualification = $_POST['education_qualification'];
    
    
    
        // Check if token is valid
        $sql = "SELECT * FROM userregister WHERE token = ? AND user_active = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 1) {
    
            // Activate user and registered user datas
            $sql = "UPDATE userregister SET st_address = ?, education_qualification = ? , user_active = 1, token = '' WHERE token = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $token);
            $stmt->execute();
    
            echo "Email verified! You can now <a href='http://localhost/graduatejob/userLoginForm'>login</a>.";
                header("location: <a href='http://localhost/graduatejob/userLoginForm");
        } else {
            echo "Invalid or expired token.";
        }
    }
}
?>