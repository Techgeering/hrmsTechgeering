<?php
include "common/conn.php";
// $project_name = $_POST['project_name'];
$pro_value = trim($_POST['pro_value']);
$projecttitle = $_POST['Project_Title'];
$startdate = $_POST['start_Date'];
$enddate = $_POST['Project_EndDate'];
// $assigned_users = $_POST['assigned_users'];
$assigned_users = isset($_POST['assigned_users']) && !empty($_POST['assigned_users'])
    ? $_POST['assigned_users']
    : "NULL";
$assigned_users1 = $_POST['assigned_users1']; // This will be an array
$office = $_POST['office'];
$Status = $_POST['Status'];
$ProjectDescription = $_POST['ProjectDescription'];

$assigned_users1_list = implode(',', $assigned_users1); // Convert array to comma-separated string

if ($office == 1) {
    $sqltask = "INSERT INTO pro_task (pro_id, task_title, start_date, end_date, description, task_type, status) VALUES ('$pro_value', '$projecttitle', '$startdate', '$enddate', '$ProjectDescription', 'Office', '$Status')";
} else {
    $sqltask = "INSERT INTO pro_task (pro_id, task_title, start_date, end_date, description, task_type, status) VALUES ('$pro_value', '$projecttitle', '$startdate', '$enddate', '$ProjectDescription', 'Field', '$Status')";
}

if ($conn->query($sqltask) === true) {
    $last_id = $conn->insert_id;
    $sqltask1 = "INSERT INTO assign_task (task_id, project_id, assign_user, user_type) VALUES ('$last_id', '$pro_value', '$assigned_users', 'Team Head')";

    if ($conn->query($sqltask1) === true) {
        // Insert the comma-separated list of collaborators
        $sqltask2 = "INSERT INTO assign_task (task_id, project_id, assign_user, user_type) VALUES ('$last_id', '$pro_value', '$assigned_users1_list', 'Collaborators')";

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