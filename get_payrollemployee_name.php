<?php
include "common/conn.php";

if (isset($_GET['emp_code'])) {
    $emp_code = $conn->real_escape_string($_GET['emp_code']);
    $query = "SELECT em_code, full_name FROM employee WHERE em_code LIKE '%$emp_code%' OR full_name LIKE '%$emp_code%'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Display both the employee code and name in the suggestions
            echo '<div class="suggestion-item" data-em_code="' . $row['em_code'] . '">' . $row['em_code'] . ' - ' . $row['full_name'] . '</div>';
        }
    } else {
        echo '<div class="suggestion-item">No results found</div>';
    }
}
$conn->close();
?>