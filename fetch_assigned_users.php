<?php
include "common/conn.php";

$project = $_POST['project'];

if ($project == '-1') {
    // Fetch all interns for Internship
    $sql = "SELECT * FROM internship";
    $result = $conn->query($sql);

    echo '<select class="form-control" name="assigned_users" id="assigned_users">';
    echo '<option value="" disabled selected>Select a user</option>';

    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['intern_name'] . '">' . $row['intern_name'] . '</option>';
    }

    echo '</select>';

} elseif ($project == '0') {
    // Fetch employees where des_id = 1 for Loan
    $sql = "SELECT * FROM employee WHERE des_id = 1";
    $result = $conn->query($sql);

    echo '<select class="form-control" name="assigned_users" id="assigned_users">';
    echo '<option value="" disabled selected>Select a user</option>';

    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['full_name'] . '">' . $row['full_name'] . '</option>';
    }

    echo '</select>';

} else {
    // For other projects, fetch all employees
    $sql = "SELECT * FROM employee";
    $result = $conn->query($sql);

    echo '<select class="form-control" name="assigned_users" id="assigned_users">';
    echo '<option value="" disabled selected>Select a user</option>';

    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['full_name'] . '">' . $row['full_name'] . '</option>';
    }

    echo '</select>';
}
?>