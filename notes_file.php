<?php
include "common/conn.php";
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_notes'])) {
// Retrieve form data
$project_name = $_POST['project_name'];
$details = $_POST['filenamenotes'];
$assign_to = $_POST['assignedusernotes'];

$sqlnotes = "INSERT INTO pro_notes (pro_id, details, assign_to, pro_status)VALUES ('$project_name','$details', '$assign_to','1')";
if (mysqli_query($conn, $sqlnotes)) {
    echo "file success";
} else {
    echo "ERROR: Could not able to execute $sqlnotes. " . mysqli_error($conn);
}
// Close connection
mysqli_close($conn);
// }
?>