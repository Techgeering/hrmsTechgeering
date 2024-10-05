<?php include 'common/conn.php';

$id = $_GET['delete'];
$tbname = $_GET['tb'];
$tbclnm = $_GET['tbc'];
$filename = $_GET['returnpage'];

$id = mysqli_real_escape_string($conn, $id);
$tbname = mysqli_real_escape_string($conn, $tbname);
$tbclnm = mysqli_real_escape_string($conn, $tbclnm);

$imageColumns = ['image', 'image1', 'image2', 'image3', 'image4'];

// Loop through each image column
foreach ($imageColumns as $imageColumn) {
    // Check if the image column exists in the table
    $checkColumnSql = "SHOW COLUMNS FROM $tbname LIKE '$imageColumn'";
    $columnResult = mysqli_query($conn, $checkColumnSql);

    if ($columnResult && mysqli_num_rows($columnResult) > 0) {
        // The image column exists in the table, so proceed to delete it

        // Fetch the image file name associated with the record
        $sql = "SELECT $imageColumn FROM $tbname WHERE $tbclnm = '$id'";
        $result = mysqli_query($conn, $sql);

        // Check if the query was successful and fetch the result
        if ($result && $row = mysqli_fetch_assoc($result)) {
            $imageToDelete = $row[$imageColumn]; // Get the image file name to delete

            // Define the path to the image file
            $imagePath = 'upload/' . $imageToDelete;

            // Check if the image file exists and delete it
            if (file_exists($imagePath)) {
                if (unlink($imagePath)) {
                    echo "<script>alert('Image Deleted Successfully');</script>";
                } else {
                    echo "Error deleting image: $imagePath"; // Display an error message if the image cannot be deleted
                }
            }
        }
    }
}
$deleteSql2 = "DELETE FROM $tbname WHERE $tbclnm = '$id'";
if ($conn->query($deleteSql2) === true) {
    header("Location: $filename");
    exit; // Exiting script after redirection
}
// If none of the conditions are met or deletion fails, redirect to an error page
header("Location: error.php");
exit;
?>