<?php
include '../Database/connection.php';

// Use PHPMailer for sending emails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// Function to send email notifications
function sendEmailNotification($to, $subject, $message)
{
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'yournumplz@gmail.com';
        $mail->Password = 'uzsihqeugnntzwke';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('yournumplz@gmail.com', 'Job Alert');
        $mail->addAddress($to);

        // Content
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        echo "Email notification sent to: $to";
    } catch (Exception $e) {
        echo "Failed to send email notification to: $to. Error: {$mail->ErrorInfo}";
    }
}

// Check if the form is submitted and required data is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id']) && isset($_POST['status'])) {
    $postId = $_POST['post_id'];
    $status = $_POST['status'];
    $cname = $_POST['cname'];


    // Prepare and execute the SQL query to update the status
    $updateStatusSql = "UPDATE jobs SET admin_status ='$status' WHERE id=$postId";
    if ($conn->query($updateStatusSql) === TRUE) {
        // Set a success message
        $_SESSION['message'] = "Successfully updated the status.";

        // Find subscribed job seekers for the company
        $sql_sel = "SELECT js.id, js.email
                    FROM jobseeker_company_subscriptions jcs
                    JOIN userregister js ON jcs.jobseeker_id = js.id
                    WHERE jcs.company_id = (SELECT id FROM userregister WHERE company_name = '$cname' LIMIT 1)";

        $result_select_mail = $conn->query($sql_sel);

        if ($result_select_mail->num_rows > 0) {
            // Send notification email to each subscribed job seeker
            while ($row = $result_select_mail->fetch_assoc()) {
                $jobseeker_email = $row['email'];

                // Send email notification
                $subject = "New Job Alert";
                $message = "A new job has been posted by a company you are subscribed to.\nJob Title: \n Company: $cname";
                sendEmailNotification($jobseeker_email, $subject, $message);
            }
        } else {
            echo "No subscribed job seekers found for the company.";
        }

        // Redirect back to the previous page
        header("Location: pendingjobs.php");
        exit();
    } else {
        // If there's an error, display it
        echo "Error updating status: " . $conn->error;
    }
}
