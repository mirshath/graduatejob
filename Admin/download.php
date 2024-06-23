<?php
require "../Database/connection.php"; // Include your database connection file

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Get the ID and ensure it's an integer

    // Fetch the file name from the database
    $sql = "SELECT resume_file FROM applicants WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($resume_file);
        $stmt->fetch();
        $stmt->close();

        if ($resume_file) {
            $file_path = "../resumes/" . $resume_file;

            // Check if file exists
            if (file_exists($file_path)) {
                // Set headers to download file rather than display
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . basename($file_path));
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file_path));
                readfile($file_path);
                exit;
            } else {
                echo "File not found.";
            }
        } else {
            echo "No resume found for the given ID.";
        }
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }
} else {
    echo "No ID specified.";
}
?>
