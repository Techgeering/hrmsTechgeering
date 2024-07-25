<?php
include "common/conn.php";
$project_name = $_POST['project_name'];
$user_name = $_POST['representative_name'];
$designation = $_POST['representative_designation'];
$mobile = $_POST['mobile_numberr1'];
$email = $_POST['emaill_id'];

$sqluser = "INSERT INTO representative (pro_id, user_name, user_designation, user_mobile_number, user_email) VALUES ('$project_name','$user_name', '$designation', '$mobile', '$email')";

if ($conn->query($sqluser) === true) {
    echo "success";
} else {
    error_log("Error in SQL task: " . $conn->error);
    echo $conn->error;
}

$conn->close();
?>