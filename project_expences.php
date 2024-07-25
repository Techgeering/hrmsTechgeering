<?php
include "common/conn.php";
$project_name = $_POST['project_name'];
$Project_Details = $_POST['Project_Details'];
$assigned_users = $_POST['assigned_users'];
$Date = $_POST['Date'];
$Amount = $_POST['Amount'];

$sqltask = "INSERT INTO pro_expenses (pro_id, details, assign_to, date, amount) VALUES ('$project_name','$Project_Details', '$assigned_users', '$Date', '$Amount')";

if ($conn->query($sqltask) === true) {
    echo "success";
} else {
    error_log("Error in SQL task: " . $conn->error);
    echo $conn->error;
}

$conn->close();
?>