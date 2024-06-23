




functions 
++++++++++++++



function sendEmailNotification($to, $subject, $message) {
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







// Find subscribed job seekers for the company
        $sql_sel = "SELECT js.id, js.email
            FROM jobseeker_company_subscriptions jcs
            JOIN userregister js ON jcs.jobseeker_id = js.id
            WHERE jcs.company_id = (SELECT id FROM userregister WHERE company_name = '$companyName' LIMIT 1)";

        $result_select_mail = $conn->query($sql_sel);

        if ($result_select_mail->num_rows > 0) {
            // Send notification email to each subscribed job seeker
            while ($row = $result_select_mail->fetch_assoc()) {
                $jobseeker_email = $row['email'];

                // Send email notification
                $subject = "New Job Alert";
                $message = "A new job has been posted by a company you are subscribed to.\nJob Title: $jobTitle\nCompany: $companyName";
                sendEmailNotification($jobseeker_email, $subject, $message);
            }
        } else {
            echo "No subscribed job seekers found for the company.";
        }