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
    $tblnm = $_POST['tbnm'];
    $oldnm = $_POST['oldnm'];    // The table name where the update will occur.

    // Handle the case where the value is null
    if ($_POST['value'] === "") {
        $value = 'NA';
    } else {
        $value = $_POST['value'];
    }
    // Construct an SQL query to update the specified field in the specified table
    // for the record with a matching 'home_sno' value.
    if ($value == $oldnm) {
        echo 0;
    } else {
        $query = "UPDATE $tblnm SET $field='" . $value . "' WHERE id=$editid";
        if (mysqli_query($conn, $query)) {
            // If the query was successful, echo '1' to indicate success.
            echo 1;
            $sql = "INSERT INTO update_record (column_id, column_name, old_record, new_record) VALUES ('$editid', '$field', '$oldnm', '$value')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            // If the query failed, echo '0' to indicate failure.
            echo 0;
        }
    }
} else {
    echo 0;
}
echo "success";
?>