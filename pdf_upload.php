<?php
if (isset($_FILES['file']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $file = $_FILES['file'];

    // Validate file type
    if ($file['type'] !== 'application/pdf') {
        echo "Invalid file type. Only PDF files are allowed.";
        exit;
    }
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $pdf_name = $_FILES['file']['name'];
        $pdf_size = $_FILES['file']['size'];
        $pdf_tmp = $_FILES['file']['tmp_name'];
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
                include "common/conn.php";
                $sql = "UPDATE project_file SET file_url = '$new_file_name' WHERE id = $id";
                if ($conn->query($sql) === TRUE) {
                    echo "File uploaded and database updated successfully.";
                } else {
                    echo "Error updating database: " . $conn->error;
                }
                $conn->close();
            } else {
                echo "<script>alert('File not uploaded');</script>";
            }
        } else {
            echo "<script>alert('Invalid file type. Only PDFs are allowed.');</script>";
        }
    } else {
        echo "<script>alert('No file uploaded or file upload error.');</script>";
    }
} else {
    echo "No file or ID received.";
}
?>