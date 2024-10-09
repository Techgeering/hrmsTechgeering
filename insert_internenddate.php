<?php
include "common/conn.php";
if (isset($_POST['field']) && isset($_POST['value']) && isset($_POST['id']) && isset($_POST['tbnm'])) {
    $field = $_POST['field'];
    $value = $_POST['value'];
    $id = $_POST['id'];
    $table = $_POST['tbnm'];

    // Assuming you have a database connection established
    $sql1 = "UPDATE $table SET $field='$value' WHERE id='$id'";
    if ($conn->query($sql1) === true) {
        echo " <script>alert('success')</script>";
    } else {
        echo $conn->error;
    }
    $conn->close();
}
?>