<?php
session_start();
include("Database/connection.php");

// Get company ID from form
$selected_company_id = $_POST['company_id'];

// Get job seeker ID from session or user input (assuming you have a login system)
$jobseeker_id = $_SESSION['user_id']; // Example for session variable

// Check if job seeker is already subscribed to the company
$sql_check = "SELECT * FROM jobseeker_company_subscriptions WHERE jobseeker_id = $jobseeker_id AND company_id = $selected_company_id";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    echo "You are already subscribed to company ID: $selected_company_id.";
} else {
    // Subscribe job seeker to the company
    $sql_subscribe = "INSERT INTO jobseeker_company_subscriptions (jobseeker_id, company_id) VALUES ($jobseeker_id, $selected_company_id)";
    if ($conn->query($sql_subscribe) === TRUE) {
        echo "Successfully subscribed to company ID: $selected_company_id.";
    } else {
        echo "Error subscribing to company ID: $selected_company_id: " . $conn->error;
    }
}

$conn->close();
?>
