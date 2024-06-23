<?php
session_start();
include("../Database/connection.php");

if (!isset($_SESSION['user_id'])) {
    header("location: ../index.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize inputs
    $id = intval($_POST["id"]); // Assuming you're passing the user ID in the form as a hidden input
    $company_name = htmlspecialchars($_POST["company_name"]);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $phone_no = htmlspecialchars($_POST["Contact"]);
    $websites = htmlspecialchars($_POST["websites"]);

    // Validate email
    if (!$email) {
        echo "Invalid email format.";
        exit();
    }

    // Handle file upload for company profile
    $profile = null;
    if (isset($_FILES["editCompanyLogo"]) && $_FILES["editCompanyLogo"]["error"] == 0) {
        $target_dir = "../Admin/uploads/company_profiles/";
        $target_file = $target_dir . basename($_FILES["editCompanyLogo"]["name"]);
        if (move_uploaded_file($_FILES["editCompanyLogo"]["tmp_name"], $target_file)) {
            $profile = basename($_FILES["editCompanyLogo"]["name"]);
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    }

    // Prepare SQL statement using prepared statements
    $sql = "UPDATE userregister SET company_name = ?, email = ?, phone_no = ?, websites = ?";
    
    // Append profile update if a new profile was uploaded
    if ($profile !== null) {
        $sql .= ", profile = ?";
    }
    
    $sql .= " WHERE id = ?";

    $stmt = $conn->prepare($sql);
    
    if ($profile !== null) {
        $stmt->bind_param("sssssi", $company_name, $email, $phone_no, $websites, $profile, $id);
    } else {
        $stmt->bind_param("ssssi", $company_name, $email, $phone_no, $websites, $id);
    }

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['message'] = "Record updated successfully";
        header("location: company_details.php"); // Redirect to a page, e.g., a page listing all users
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
