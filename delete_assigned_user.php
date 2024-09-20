<?php
include 'common/conn.php';

$em_code = $_POST['em_code'];
$pro_task_id = $_POST['pro_task_id'];

$sql = "SELECT assign_user FROM assign_task WHERE task_id = $pro_task_id AND user_type = 'Collaborators'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$assign_users = explode(',', $row['assign_user']);
$assign_users = array_filter($assign_users, function ($code) use ($em_code) {
    return trim($code) != $em_code;
});
$assign_users = implode(',', $assign_users);

$sql_update = "UPDATE assign_task SET assign_user = '$assign_users' WHERE task_id = $pro_task_id AND user_type = 'Collaborators'";
if ($conn->query($sql_update) === TRUE) {
    echo 'success';
} else {
    echo 'error';
}

$conn->close();
?>