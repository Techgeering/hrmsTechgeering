<?php
include "common/conn.php";
if (isset($_POST['submit'])) {
    $startdate = date('Y-m-d H:i:s');
    $nextdate = date('Y-m-d H:i:s', strtotime($_POST["nextdate"]));
    $message = $_POST["message"];
    $leadId = $_POST["id"];

    $sql = "INSERT INTO lead_follow (lead_id, start_date, next_date, message)
        VALUES ('$leadId', '$startdate', '$nextdate', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "success1";
        // header("Location: leadview.php?id=" . $leadId);

    }
    $sql10 = "UPDATE leads SET lastfollowupdate='$startdate' , nextfollowupdate='$nextdate' WHERE id=1";
    if ($conn->query($sql10) === TRUE) {
        // echo "<script>window.location.href='leadview.php?id=$leadId';</script>";
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>