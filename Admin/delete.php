<?php
session_start();
include '../Database/connection.php';

if (isset($_GET['type'], $_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];

    // Check if there are associated records
    if ($type === 'category') {
        $check_jobs_sql = "SELECT COUNT(*) as job_count FROM jobs WHERE job_category = ?";
        $stmt_check = $conn->prepare($check_jobs_sql);



        if ($stmt_check) {
            $stmt_check->bind_param("s", $id); // Assuming category_name is a string
            $stmt_check->execute();
            $result = $stmt_check->get_result();
            $row = $result->fetch_assoc();
            $stmt_check->close();

            if ($row['job_count'] > 0) {
                $_SESSION['error'] = "Cannot delete category: Jobs exist in this category.";

                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }
        } else {    
            $_SESSION['error'] = "Error preparing statement: " . $conn->error;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }




    // Perform deletion based on type
    switch ($type) {
        case 'user':
            $sql = "DELETE FROM userregister WHERE id = ?";
            break;
        case 'job':
            $sql = "DELETE FROM jobs WHERE id = ?";
            break;
        case 'category':
            $sql = "DELETE FROM category WHERE category_name = ?";
            break;
        default:
            $_SESSION['error'] = "Invalid type";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
    }

    // Prepare and execute deletion query
    $stmt = $conn->prepare($sql);






    if ($stmt) {
        $stmt->bind_param("s", $id); // Assuming id is a string for category_name
        if ($stmt->execute()) {
            $_SESSION['message'] = "Record deleted successfully";
        } else {
            $_SESSION['error'] = "Error deleting record: "; 
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Error preparing statement: " . $conn->error;
    }





    // Handle user-specific deletion (update company name)
    if ($type === 'user') {
        $sql_company = "UPDATE userregister SET company_name = NULL WHERE id = ?";
        $stmt_company = $conn->prepare($sql_company);

        if ($stmt_company) {
            $stmt_company->bind_param("i", $id);
            if (!$stmt_company->execute()) {
                $_SESSION['error'] .= " Error updating company name: " . $stmt_company->error;
            }
            $stmt_company->close();
        } else {
            $_SESSION['error'] .= " Error preparing company update statement: " . $conn->error;
        }
    }



    // Redirect back to the referring page
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    $_SESSION['error'] = "Missing parameters";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
