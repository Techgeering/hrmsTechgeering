<?php
include 'common/conn.php';

$em_code = $_POST['em_code'];
$pro_task_id = $_POST['pro_task_id'];

$sql = "UPDATE assign_task SET assign_user = CONCAT(assign_user, ',$em_code') WHERE task_id = $pro_task_id AND user_type = 'Collaborators'";
if ($conn->query($sql) === TRUE) {
    echo 'success';
} else {
    echo 'error';
}

$conn->close();
?>