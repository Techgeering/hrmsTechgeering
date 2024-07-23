<?php
include 'common/conn.php';
?>
<?php
$id = $_GET["status"];
$id1 = $_GET["tb"];
$id2 = $_GET["returnpage"];
$sql = "UPDATE $id1 SET status='0' WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
    header("location:$id2");
} else {
    $conn->error;
}
$conn->close();

?>