<?php
// if (isset($_POST['add_file'])) {
include "common/conn.php";
$project_name = $_POST["project_name"];
// Check if file was uploaded
if (isset($_FILES['pdf1']) && $_FILES['pdf1']['error'] == 0) {
    $pdf_name = $_FILES['pdf1']['name'];
    $pdf_size = $_FILES['pdf1']['size'];
    $pdf_tmp = $_FILES['pdf1']['tmp_name'];
    $file_type = pathinfo($pdf_name, PATHINFO_EXTENSION);
    $allowed_types = ['pdf']; // Allowed file types

    // Validate file type
    if (in_array($file_type, $allowed_types)) {
        $new_file_name = uniqid() . '.' . $file_type;
        $upload_dir = "uploads/";

        // Create directory if it does not exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir);
        }

        $target_file = $upload_dir . $new_file_name;

        // Move uploaded file to target directory
        if (move_uploaded_file($pdf_tmp, $target_file)) {
            echo "file success";
        } else {
            echo "<script>alert('File not uploaded');</script>";
        }
    } else {
        echo "<script>alert('Invalid file type. Only PDFs are allowed.');</script>";
    }
} else {
    echo "<script>alert('No file uploaded or file upload error.');</script>";
}
// Get form data
$filename = $_POST["file_name"];
$assigned_users = $_POST["assigned_users"];


$sqlfile = "INSERT INTO project_file (pro_id, file_details, file_url, assigned_to) 
                                     VALUES ('$project_name','$filename','$new_file_name','$assigned_users')";
if ($conn->query($sqlfile) === true) {
    echo "success";

} else {
    echo $conn->error;
}
echo $conn->close();
// }
?>