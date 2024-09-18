<?php
$servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "hems";

$username = "u728233529_hrmstechg";
$password = "Prasim@1963";
$dbname = "u728233529_hrmstechg";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>