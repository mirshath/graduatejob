<?php
include "../Database/connection.php";
session_start();

// Ensure the user is authenticated
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
}

// Get all resumes
$getResumes = "SELECT resume_file FROM applicants";
$getResumes_run = mysqli_query($conn, $getResumes);

// Create a temporary file for the zip
$zipFileName = 'all_resumes.zip';
$zipFilePath = sys_get_temp_dir() . '/' . $zipFileName;
$zip = new ZipArchive();

if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
    exit("Cannot open <$zipFileName>\n");
}

if (mysqli_num_rows($getResumes_run) > 0) {
    // Add each resume file to the zip
    while ($row = mysqli_fetch_assoc($getResumes_run)) {
        $filePath = "../resumes/" . $row['resume_file'];
        if (file_exists($filePath)) {
            $zip->addFile($filePath, $row['resume_file']);
        }
    }
}

$zip->close();

// Serve the zip file for download
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
header('Content-Length: ' . filesize($zipFilePath));
readfile($zipFilePath);

// Clean up the temporary zip file
unlink($zipFilePath);
exit();
?>
