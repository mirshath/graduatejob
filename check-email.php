<?php
include "Database/connection.php";

// Check if email parameter exists
if(isset($_POST['email'])) {
    // Prepare and execute SQL query to check if email exists
    $email = $_POST['email'];
    $stmt = $conn->prepare("SELECT * FROM userregister WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if email exists
    if ($result->num_rows > 0) {
        // Email is already taken
        $response = array('status' => 'taken');
    } else {
        // Email is available
        $response = array('status' => 'available');
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // If email parameter is not set
    $response = array('status' => 'error', 'message' => 'Email parameter is missing.');
    header('Content-Type: application/json');
    http_response_code(400); // Bad Request
    echo json_encode($response);
}
?>
