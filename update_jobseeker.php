<?php
session_start();
include("Database/connection.php");

// Redirect to index.php if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST["id"]; // Assuming you're passing the user ID in the form as a hidden input
    $firstname = $_POST["Fname"];
    $lastname = $_POST["Lastname"];
    $email = $_POST["email"];
    $phone_no = $_POST["Contact"];
    $St_address = $_POST["St_address"];
    $education_qualification = $_POST["educationQualification"];
    $interested_field = $_POST["interestedField"];
    $professional_qualification = $_POST["professionalQualification"];
    $studied_at = $_POST["studied_at"];
    $bio = $_POST["bio"]; // Assuming there's a textarea input for bio in your form

    // SQL query to update data in the database using prepared statements
    $sql = "UPDATE userregister SET 
        firstname = ?, 
        lastname = ?, 
        email = ?, 
        phone_no = ?,  
        St_address = ?,
        education_qualification = ?,
        interested_field = ?,
        professional_qualification = ?,
        studied_at = ?
        WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssi", $firstname, $lastname, $email, $phone_no, $St_address, $education_qualification, $interested_field, $professional_qualification, $studied_at, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Profile updated successfully";
    } else {
        $_SESSION['message'] = "Error updating record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();

// Redirect to appropriate page after processing
header("Location: userProfile.php");
exit();
?>
