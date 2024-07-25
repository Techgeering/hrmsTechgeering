<?php
include "common/conn.php";

$project_name = $_POST['project_name'];
$projecttitle = $_POST['Project_Title'];
$startdate = $_POST['start_Date'];
$enddate = $_POST['Project_EndDate'];
$assigned_users = $_POST['assigned_users'];
$assigned_users1 = $_POST['assigned_users1'];
$office = $_POST['office'];
$Status = $_POST['Status'];
// $running = $_POST['running'];
// $cancel = $_POST['cancel'];
$ProjectDescription = $_POST['ProjectDescription'];

// $status = '';
// if (!empty($_POST['complete'])) {
//     $status = $_POST['complete'];
// } elseif (!empty($_POST['running'])) {
//     $status = $_POST['running'];
// } elseif (!empty($_POST['cancel'])) {
//     $status = $_POST['cancel'];
// }

if ($office == 1) {
    $sqltask = "INSERT INTO pro_task (pro_id, task_title, start_date, end_date, description, task_type, status) VALUES ('$project_name', '$projecttitle', '$startdate', '$enddate', '$ProjectDescription', 'Office', '$Status')";
} else {
    $sqltask = "INSERT INTO pro_task (pro_id, task_title, start_date, end_date, description, task_type, status) VALUES ('$project_name', '$projecttitle', '$startdate', '$enddate', '$ProjectDescription', 'Field', '$Status')";
}

if ($conn->query($sqltask) === true) {
    $last_id = $conn->insert_id;
    $sqltask1 = "INSERT INTO assign_task (task_id, project_id, assign_user, user_type) VALUES ('$last_id', '$project_name', '$assigned_users', 'Team Head')";

    if ($conn->query($sqltask1) === true) {
        $sqltask2 = "INSERT INTO assign_task (task_id, project_id, assign_user, user_type) VALUES ('$last_id', '$project_name', '$assigned_users1', 'Collaborators')";

        if ($conn->query($sqltask2) === true) {
            echo "success";
        } else {
            error_log("Error in SQL task 2: " . $conn->error);
            echo $conn->error;
        }
    } else {
        error_log("Error in SQL task 1: " . $conn->error);
        echo $conn->error;
    }
} else {
    error_log("Error in SQL task: " . $conn->error);
    echo $conn->error;
}

$conn->close();
?>