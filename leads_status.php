<?php
include 'common/conn.php';

$id = $_GET['id'];
$name = $_GET['name'];

if ($name == 'inactive') {
    $status = '0';
    $column = 'status1';
} elseif ($name == '1') {
    $status = '2';
    $column = 'status';
} elseif ($name == '2') {
    $status = '3';
    $column = 'status';
} elseif ($name == '3') {
    $status = '4';
    $column = 'status';
} elseif ($name == '4') {
    $status = '5';
    $column = 'status';
} elseif ($name == '5') {
    $status = '6';
    $column = 'status';
} else {
    echo "<script>alert('Invalid status')</script>";
    exit();
}
$sql = "UPDATE leads SET $column='$status' WHERE id='$id'";
if ($conn->query($sql) === true) {
    echo "<script>alert('success'); window.location.href='leads.php';</script>";
} else {
    echo $conn->error;
}
?>