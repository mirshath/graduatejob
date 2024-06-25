<?php
session_start();
include ("Database/connection.php");

// Redirect to index.php if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("location: index");
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
    $updateStCV = $_FILES["updateStCV"]["name"] ? basename($_FILES["updateStCV"]["name"]) : '';

    

    // Handle file upload for CV
    // if (isset($_FILES["updateStCV"]) && $_FILES["updateStCV"]["error"] == 0) {
    //     $cv_target_dir = "resumes/";
    //     $cv_target_file = $cv_target_dir . basename($_FILES["updateStCV"]["name"]);
    //     if (!move_uploaded_file($_FILES["updateStCV"]["tmp_name"], $cv_target_file)) {
    //         echo "Sorry, there was an error uploading your CV.";
    //         exit();
    //     }
    // }
    // SQL query to update data in the database using prepared statements
    $sql = "UPDATE userregister SET 
        firstname = ?, 
        lastname = ?, 
        email = ?, 
        phone_no = ?, 
        studentCV = ?, 
        St_address = ?";

    // Append profile update if a new profile was uploaded
    // if ($profile !== null) {
    //     $sql .= ", profile = ?";
    // }

    $sql .= " WHERE id = ?";

    $stmt = $conn->prepare($sql);

    // if ($profile !== null) {
    //     // Bind parameters including the profile
    //     $stmt->bind_param("sssssssi", $firstname, $lastname, $email, $phone_no, $updateStCV, $St_address, $profile, $id);
    // } else {
    //     // Bind parameters excluding the profile
    //     $stmt->bind_param("ssssssi", $firstname, $lastname, $email, $phone_no, $updateStCV, $St_address, $id);
    // }

    // Execute SQL query
    if ($stmt->execute() === TRUE) {
        $_SESSION['message'] = "Profile updated successfully";
        header("Location: userProfile"); // Include '.php' in the URL
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

}


// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['updateStCV'])) {
//     $uploadDir = 'resumes/';
//     $uploadFile = $uploadDir . basename($_FILES['updateStCV']['name']);

//     // Check if the file is uploaded without errors
//     if (move_uploaded_file($_FILES['updateStCV']['tmp_name'], $uploadFile)) {
//         // Update the database with the new file name if necessary
//         // Assuming you have a function `updateCVFile` to handle the database update
//         // updateCVFile($uploadFile);

//         echo "File is valid, and was successfully uploaded.\n";
//     } else {
//         echo "Possible file upload attack!\n";
//     }
// }
?>


<script>
    <?php

    // messages from corect or not 
    
    if (isset($_SESSION['message'])) {
        ?>
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success('<?= $_SESSION['message'] ?>');
                    <?php
                    unset($_SESSION['message']);
    }
    ?>
    </script>



