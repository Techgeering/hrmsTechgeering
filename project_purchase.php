<?php
include "common/conn.php";

// Accessing form data via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_name = $_POST['project_name'];
    $service_name = $_POST["service_name"];
    $date_of_pur = $_POST["date_of_pur"];
    $service_start_dt = $_POST["service_start_dt"];
    $service_end_dt = $_POST["service_end_dt"];
    $duration1 = $_POST["duration1"];
    $sql_pur = "INSERT INTO purchase (pro_id, service_id, date_of_purchase, ser_start_dt, ser_end_dt, duration, status) 
                VALUES ('$project_name','$service_name','$date_of_pur','$service_start_dt','$service_end_dt','$duration1','1')";
    if ($conn->query($sql_pur) === TRUE) {
        echo "Successfully submitted!";
    } else {
        echo "Error: " . $sql_pur . "<br>" . $conn->error;
    }
    $conn->close();
}
?>