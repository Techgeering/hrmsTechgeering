<?php
session_start();
include "../common/conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // if (isset($_POST['mobile_number'])) {
    $mobile_number = $_POST['mobile_number'];
    $company = $_POST['company'];
    $sales = $_POST['sales'];

    $sql = "INSERT INTO leads (phone_no, companyname, interested_in) VALUES ('$mobile_number','$company','$sales')";
    if ($conn->query($sql) === TRUE) {
        // $_SESSION['mobile_number'] = $mobile_number;
        echo "success";
    } else {
        echo "Error: " . $conn->error;
    }
}
// }
$conn->close();
?>