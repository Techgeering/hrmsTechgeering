<?php
include 'common/conn.php';

// Retrieve the ID and status from the URL
$id = $_GET['id'];
$current_status = $_GET['status'];

// Validate and toggle the status
if ($current_status == '0') {
    $new_status = '1';
} else {
    echo "<script>alert('Invalid status'); window.location.href='notconvinced.php';</script>";
    exit();
}

// Update the database with the new status
$sql = "UPDATE leads SET renew_status='1', status1='1' WHERE id='$id'";
if ($conn->query($sql) === true) {
    echo "<script>alert('Status updated successfully'); window.location.href='notconvinced.php';</script>";
} else {
    echo "<script>alert('Error: " . $conn->error . "');</script>";
}
?>