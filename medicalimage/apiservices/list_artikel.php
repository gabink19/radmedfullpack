<?php

// Create connection
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli("127.0.0.1", "root", "Disana4misbah@k", "medicalimage");
$conn->set_charset('utf8');

$sql = "SELECT * FROM tbl_artikel";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($rows);
} else {
    echo "no results found";
}