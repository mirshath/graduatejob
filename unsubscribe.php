<?php
session_start(); 

include("Database/connection.php"); 

// Get company ID from form
$company_id = $_POST['company_id'];

$jobseeker_id = $_SESSION['user_id']; // Example for session variable


// Unsubscribe job seeker from the company
$stmt = $conn->prepare("DELETE FROM jobseeker_company_subscriptions WHERE jobseeker_id = ? AND company_id = ?");
$stmt->bind_param("ii", $jobseeker_id, $company_id);
if ($stmt->execute()) {
    echo "Successfully unsubscribed from company ID: $company_id.";
} else {
    echo "Error unsubscribing from company ID: $company_id: " . $stmt->error;
}

$stmt->close(); // Close prepared statement
$conn->close(); // Close database connection
?>
