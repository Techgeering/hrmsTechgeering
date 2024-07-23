<?php
include 'common/conn.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}
//  var_dump($_POST['id']);exit();


// Check if the 'field', 'value', and 'id' parameters are set in the POST request.
if (isset($_POST['field']) && isset($_POST['value']) && isset($_POST['id'])) {

    // Retrieve the values from the POST parameters.
    $field = $_POST['field'];   // The field to be updated in the database.
    // $value = $_POST['value'];   // The new value to set for the specified field.
    $editid = $_POST['id'];     // The unique identifier for the record to be updated.
    $tblnm = $_POST['tbnm'];    // The table name where the update will occur.

    // Handle the case where the value is null
    if ($_POST['value'] === "") {
        $value = 'NA';
    } else {
        $value = $_POST['value'];
    }
    // Construct an SQL query to update the specified field in the specified table
    // for the record with a matching 'home_sno' value.
    $query = "UPDATE $tblnm SET $field='" . $value . "' WHERE id=$editid";

    // Execute the SQL query using the mysqli_query function.
    if (mysqli_query($conn, $query)) {
        // If the query was successful, echo '1' to indicate success.
        echo 1;
    } else {
        // If the query failed, echo '0' to indicate failure.
        echo 0;
    }
} else {
    // If the 'field', 'value', or 'id' parameters were not set in the POST request,
    // echo '0' to indicate a failure.
    echo 0;
}

// Regardless of whether the update operation succeeded or not, this line will always be executed.
echo "success";
?>