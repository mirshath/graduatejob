<?php
session_start(); // Start session if not already started
require '../Database/connection.php'; // Include database connection file

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Include PHPMailer autoload

// Function to send email notifications
function sendEmailNotification($to, $subject, $message)
{
    $mail = new PHPMailer(true); // Passing `true` enables exceptions

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'yournumplz@gmail.com'; // Your Gmail email address
        $mail->Password = 'uzsihqeugnntzwke'; // Your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom('yournumplz@gmail.com', 'Job Alert'); // Sender's email and name
        $mail->addAddress($to); // Recipient's email

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Send email
        if ($mail->send()) {
            echo 'Email sent successfully to ' . $to . '!<br>';
        } else {
            echo 'Mailer Error: ' . $mail->ErrorInfo . '<br>';
        }
    } catch (Exception $e) {
        echo "Failed to send email notification to: $to. Error: {$mail->ErrorInfo}<br>";
    }
}

// Function to fetch BMS students and send them email notifications
function sendBMSStudentNotifications($conn, $jobId)
{
    $stmt = $conn->prepare("SELECT email FROM userregister WHERE studied_at = 'BMS'");
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error . "<br>";
        return;
    }
    
    $stmt->execute();
    $results = $stmt->get_result();
    $num_rows = $results->num_rows;
    echo "Number of BMS students found: " . $num_rows . "<br>";
    
    $jobLink = "http://localhost/graduatejob/job-details.php?id=$jobId";
    $subject = "BMS Student Notification";
    // $message = "A new job has been posted. <a href='$jobLink'>View it here</a>.";
    $message = "A new job has been posted. <a href='$jobLink' style='display: inline-block; background-color: #00008B; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>View it here</a>.";


    while ($row = $results->fetch_assoc()) {
        $bms_student_email = $row['email'];
        sendEmailNotification($bms_student_email, $subject, $message);
    }
}

// Main script
// Check if the form is submitted and required data is set for job status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id']) && isset($_POST['status'])) {
    $postId = $_POST['post_id'];
    $status = $_POST['status'];
    $cname = $_POST['cname'];

    $updateStatusSql = "UPDATE jobs SET admin_status ='$status' WHERE id=$postId";
    if ($conn->query($updateStatusSql) === TRUE) {
        $_SESSION['message'] = "Successfully updated the status.";

        // Send notifications to subscribed job seekers
        $sql_sel = "SELECT js.id, js.email
                    FROM jobseeker_company_subscriptions jcs
                    JOIN userregister js ON jcs.jobseeker_id = js.id
                    WHERE jcs.company_id = (SELECT id FROM userregister WHERE company_name = '$cname' LIMIT 1)";
        
        $result_select_mail = $conn->query($sql_sel);

        $jobLink = "http://localhost/graduatejob/job-details.php?id=$postId";
        $subject = "New Job Alert";
        // $message = "A new job has been posted by $cname. <a href='$jobLink'>View it here</a>.";
        $message = "A new job has been posted by $cname. <a href='$jobLink' style='display: inline-block; background-color: #00008B; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>View it here</a>.";


        if ($result_select_mail->num_rows > 0) {
            while ($row = $result_select_mail->fetch_assoc()) {
                $jobseeker_email = $row['email'];
                sendEmailNotification($jobseeker_email, $subject, $message);
            }
        } else {
            echo "No subscribed job seekers found for the company.<br>";
        }

        // Send notifications to BMS students
        sendBMSStudentNotifications($conn, $postId);

        header("Location: pendingjobs.php");
        exit();
    } else {
        echo "Error updating status: " . $conn->error . "<br>";
    }
}
?>
