<?php
// Include database connection or configuration file
require_once "dbfoodbank.php";

// Fetch profile data from requests table
$sql = "SELECT * FROM requests";
$result = $mysqli->query($sql);

$student_requests = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $student_requests[] = $row;
    }
} else {
    echo "0 results";
}

// Close connection
$mysqli->close();
?>