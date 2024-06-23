<?php
require "Database/connection.php";

$query = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';
$types = isset($_GET['type']) ? $_GET['type'] : [];
$categories = isset($_GET['category']) ? $_GET['category'] : [];
$careers = isset($_GET['career']) ? $_GET['career'] : [];
$educations = isset($_GET['education']) ? $_GET['education'] : [];

$sql = "SELECT * FROM jobs WHERE admin_status = 'Approved' AND application_status = 'active'";

if ($query) {
    $sql .= " AND (job_title LIKE '%$query%' OR company_name LIKE '%$query%' OR job_category LIKE '%$query%')";
}

if (!empty($types)) {
    $sql .= " AND employment_type IN ('" . implode("','", $types) . "')";
}

if (!empty($categories)) {
    $sql .= " AND job_category IN ('" . implode("','", $categories) . "')";
}

if (!empty($careers)) {
    $sql .= " AND career_level IN ('" . implode("','", $careers) . "')";
}

if (!empty($educations)) {
    $sql .= " AND education_level IN ('" . implode("','", $educations) . "')";
}

$result = mysqli_query($conn, $sql);
$jobs = [];

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $jobs[] = $row;
    }
}

echo json_encode($jobs);
?>
