<?php
include "common/conn.php";

// Fetch form data
$project_name = $_POST['project_name'];
$Project_Details = $_POST['Project_Details'];
$gst = $_POST['gst'];
$assigned_users = $_POST['assigned_users'];
$Date = $_POST['Date'];
$Amount = $_POST['Amount'];


// Fetch the last balance
$sql2 = "SELECT balance FROM pro_expenses ORDER BY id DESC LIMIT 1";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
    $balance = $row2['balance'];
    $updatedbalance = $Amount + $balance;
} else {
    $updatedbalance = $Amount;
}

// Insert the new record
$sqltask = "INSERT INTO pro_expenses (pro_id, details, gst, assign_to, date, amount, balance) 
            VALUES ('$project_name', '$Project_Details', '$gst', '$assigned_users', '$Date', '$Amount', '$updatedbalance')";

if ($conn->query($sqltask) === TRUE) {
    echo "success";
} else {
    error_log("Error in SQL task: " . $conn->error);
    echo $conn->error;
}

// Close connection
$conn->close();
?>