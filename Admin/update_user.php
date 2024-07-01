<?php
session_start();

// Include database connection
include "../Database/connection.php";

// // Check if user is authenticated
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php");
//     exit();
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["userId"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phoneNo = $_POST["phone_no"]; // Add phone number
    $websites = $_POST["websites"]; // Add websites

    // Check if the email already exists in the database for another user
    $emailCheckQuery = "SELECT id FROM userregister WHERE email = '$email' AND id != $userId";
    $emailCheckResult = $conn->query($emailCheckQuery);
    $existingUser = $emailCheckResult->fetch_assoc();

    if ($existingUser) {



        // SQL query to update user data    
        $sql = "UPDATE userregister SET 
                firstname = '$firstName', 
                lastname = '$lastName', 
                phone_no = '$phoneNo',
                websites = '$websites'"; // Add websites column

        // Handle profile image upload
        if (isset($_FILES["editCompanyLogo"]) && $_FILES["editCompanyLogo"]["error"] == 0) {
            $target_dir = "uploads/user_profiles/";
            $target_file = $target_dir . basename($_FILES["editCompanyLogo"]["name"]);
            if (move_uploaded_file($_FILES["editCompanyLogo"]["tmp_name"], $target_file)) {
                $profileImage = basename($_FILES["editCompanyLogo"]["name"]);
                $sql .= ", profile = '$profileImage'";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        $sql .= " WHERE id = $userId";

        // Execute SQL query
        $sql_run = $conn->query($sql);

        // Check if query executed successfully
        if ($sql_run === TRUE) {
            echo "Record updated successfully";
            // Redirect to profile page or any other page
            echo '<script>window.location.href = "employment.php";</script>';
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // Email doesn't exist, proceed with updating the user data

        // SQL query to update user data
        $sql = "UPDATE userregister SET 
                firstname = '$firstName', 
                lastname = '$lastName', 
                email = '$email',
                phone_no = '$phoneNo',
                websites = '$websites'"; // Add websites column

        // Handle profile image upload
        if (isset($_FILES["editCompanyLogo"]) && $_FILES["editCompanyLogo"]["error"] == 0) {
            $target_dir = "../userDashboards/uploads/profiles/";
            $target_file = $target_dir . basename($_FILES["editCompanyLogo"]["name"]);
            if (move_uploaded_file($_FILES["editCompanyLogo"]["tmp_name"], $target_file)) {
                $profileImage = basename($_FILES["editCompanyLogo"]["name"]);
                $sql .= ", profile = '$profileImage'";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        $sql .= " WHERE id = $userId";

        // Execute SQL query
        $sql_run = $conn->query($sql);

        // Check if query executed successfully
        if ($sql_run === TRUE) {
            echo "Record updated successfully";
            // Redirect to profile page or any other page   
            header("Location: ViewUser.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
