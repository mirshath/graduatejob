<?php
session_start();
include("Database/connection.php");

// Redirect to index.php if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['id'];

    // Check if a file was uploaded
    if (isset($_FILES['updateStCV']) && $_FILES['updateStCV']['error'] == UPLOAD_ERR_OK) {
        $file = $_FILES['updateStCV'];
        $file_size = $file['size'];
        $file_tmp = $file['tmp_name'];
        $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        // $allowed_ext = ['pdf', 'doc', 'docx'];
        $allowed_ext = ['pdf', 'doc', 'docx'];

        // Validate file size (below 300 KB)
        if ($file_size > 307200) {
            echo "File size must be below 300 KB.";
            exit;
        }

        // Validate file extension
        if (!in_array($file_ext, $allowed_ext)) {
            echo "Invalid file type. Only PDF, DOC, and DOCX are allowed.";
       

            exit;
        }

        // Generate a unique file name
        $new_file_name = uniqid('cv_', true) . '.' . $file_ext;
        $upload_path = 'resumes/' . $new_file_name;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($file_tmp, $upload_path)) {
            // Update the database with the new file name
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "UPDATE userregister SET studentCV = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $new_file_name, $user_id);
            if ($stmt->execute()) {
                // echo "CV uploaded successfully.";
                header("location: userProfile");
            } else {
                echo "Database update failed: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "No file uploaded or file upload error.";
    }
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/1.13.1/alertify.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/1.13.1/css/alertify.min.css"/>

<script>
    <?php
    if (isset($_SESSION['message'])) {
    ?>
        alertify.set('notifier', 'position', 'top-right');
        alertify.success('<?= $_SESSION['message'] ?>');
    <?php
        unset($_SESSION['message']);
    }
    ?>
</script>
