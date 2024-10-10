<?php
// Include your database connection
include "common/conn.php";

if (isset($_POST['year']) && isset($_POST['month'])) {
    $year = $_POST['year'];
    $month = $_POST['month'];

    // Create the SQL query directly
    $sql = "SELECT SUM(paid_company) as total_paid FROM pay_salary WHERE year = '$year' AND month = '$month'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Return the total sum
        echo $row['total_paid'] ? $row['total_paid'] : 0;
    } else {
        echo 0;
    }
}
?>