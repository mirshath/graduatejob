<?php
include "Database/connection.php";

$type = isset($_GET['type']) ? $_GET['type'] : [];
$category = isset($_GET['category']) ? $_GET['category'] : [];
$career = isset($_GET['career']) ? $_GET['career'] : [];
$education = isset($_GET['education']) ? $_GET['education'] : [];



// Initialize the SQL query
$sql = "SELECT * FROM jobs WHERE admin_status = 'Approved' AND application_status = 'active'";

// Add filters to the query
if (!empty($type)) { 
    $type = implode("','", $type);
    $sql .= " AND employment_type IN ('$type')";
}

if (!empty($category)) {
    $category = implode("','", $category);
    $sql .= " AND job_category IN ('$category')";
}

if (!empty($career)) {
    $career = implode("','", $career);
    $sql .= " AND experience_level IN ('$career')";
}

if (!empty($education)) {
    $education = implode("','", $education);
    $sql .= " AND education_level IN ('$education')";
}



$result = mysqli_query($conn, $sql);

$jobs = [];
while ($row = mysqli_fetch_assoc($result)) {
    $jobs[] = $row;
}

// Return the filtered results as JSON
echo json_encode($jobs);
?>
