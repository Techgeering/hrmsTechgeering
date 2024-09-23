<?php
session_start();
include 'conn.php';
$mobileno = $_SESSION['emp_form_phone'];
?>

<?php
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $targetDir = "upload/";
    $uniqueId = uniqid(); // Generate a unique ID

    // Function to handle file upload
    function uploadFile($fileInputName, $targetDir, $uniqueId)
    {
        $fileName = basename($_FILES[$fileInputName]["name"]);
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $targetFilePath = $targetDir . $uniqueId . "_" . $fileInputName . "." . $fileType;

        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $targetFilePath)) {
            return $targetFilePath;
        } else {
            return false;
        }
    }

    // Handling each document
    $pgDocument = uploadFile('pg_document', $targetDir, $uniqueId);
    $gradDocument = uploadFile('grad_document', $targetDir, $uniqueId);
    $class12Document = uploadFile('class12_document', $targetDir, $uniqueId);
    $class10Document = uploadFile('class10_document', $targetDir, $uniqueId);
    $aadharDocument = uploadFile('aadhar_document', $targetDir, $uniqueId);
    $panDocument = uploadFile('pan_document', $targetDir, $uniqueId);
    $bgDocument = uploadFile('bg_document', $targetDir, $uniqueId);
    $expDocument = uploadFile('exp_document', $targetDir, $uniqueId);
    $imageSign = uploadFile('image_sign', $targetDir, $uniqueId);

    // Check if all files were uploaded successfully

    // SQL query to insert data into the database
    // $sql = "INSERT INTO emp_form (emp_form_pgrad_doc, emp_form_grad_doc, emp_form_c12_doc, emp_form_c10_doc, emp_form_adhar_doc, emp_form_pan_doc, emp_form_bg_doc, emp_form_other_doc, emp_form_sign)
    //             VALUES ('$pgDocument', '$gradDocument', '$class12Document', '$class10Document', '$aadharDocument', '$panDocument', '$bgDocument', '$expDocument', '$imageSign')";

    $sql = "UPDATE emp_form SET emp_form_pgrad_doc='$pgDocument', emp_form_grad_doc='$gradDocument', emp_form_c12_doc='$class12Document', emp_form_c10_doc='$class10Document', emp_form_adhar_doc='$aadharDocument', emp_form_pan_doc='$panDocument', emp_form_bg_doc='$bgDocument', emp_form_other_doc='$expDocument', emp_form_sign='$imageSign' WHERE emp_form_phone='$mobileno'";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }


    $conn->close();
}
?>