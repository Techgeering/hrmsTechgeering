<?php include 'common/conn.php';

$id = $_GET['delete'];
$tbname = $_GET['tb'];
$tbclnm = $_GET['tbc'];
$filename = $_GET['returnpage'];

$id = mysqli_real_escape_string($conn, $id);
$tbname = mysqli_real_escape_string($conn, $tbname);
$tbclnm = mysqli_real_escape_string($conn, $tbclnm);

$deleteSql2 = "DELETE FROM $tbname WHERE $tbclnm = '$id'";
if ($conn->query($deleteSql2) === true) {
    header("Location: $filename");
    exit; // Exiting script after redirection
}
// If none of the conditions are met or deletion fails, redirect to an error page
header("Location: error.php");
exit;
?>