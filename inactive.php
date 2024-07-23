<?php
include 'common/conn.php';
?>
<?php
$id = $_GET["status0"];
$id1 = $_GET["tb"];
$id2 = $_GET["returnpage"];
$sql1 = "UPDATE $id1 SET status='1' WHERE id='$id'";
if ($conn->query($sql1) == true) {
    header("location:$id2");
} else {
    $conn->error;
}
$conn->close();
?>