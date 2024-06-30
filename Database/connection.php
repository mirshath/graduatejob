<?php 


// define('BASE_URL', 	   'http://localhost/Jobprocess/');

$conn = new mysqli("localhost","root", "", "bms_job");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
}

?>



