<?php
include "common/conn.php";

// Get the search term from the query string
$searchTerm = isset($_GET['term']) ? $_GET['term'] : '';

// Escape the search term to prevent SQL injection
$searchTerm = $conn->real_escape_string($searchTerm);

// Prepare the SQL query
$query = "SELECT service_name, hsn_num FROM service WHERE service_name LIKE '%$searchTerm%'";

$result = $conn->query($query);
$services = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}

// Close the connection
$conn->close();

// Return the result as JSON
header('Content-Type: application/json');
echo json_encode($services);
?>