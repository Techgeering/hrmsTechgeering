<?php
include "common/conn.php";
$project_name = $_POST['project_name'];
$details = $_POST['filenamenotes'];
$assign_to = $_POST['assignedusernotes'];

$sqlnotes = "INSERT INTO pro_notes (pro_id, details, assign_to, pro_status)VALUES ('$project_name','$details', '$assign_to','1')";

if ($conn->query($sqlnotes) === true) {
    echo "success";
} else {
    error_log("Error in SQL task: " . $conn->error);
    echo $conn->error;
}

$conn->close();
?>