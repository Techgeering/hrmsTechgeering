<?php
session_start();
include 'conn.php';
$mobileno = $_SESSION['emp_form_phone'];
?>
<?php
include "conn.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    function handleFileUpload($fieldName, $uploadDir)
    {
        global $conn;
        $image_name = $_FILES[$fieldName]['name'];
        $image_size = $_FILES[$fieldName]['size'];
        $image_tmp = $_FILES[$fieldName]['tmp_name'];
        $file_type = pathinfo($image_name, PATHINFO_EXTENSION);
        $new_file_name = uniqid() . '.' . $file_type;

        // Ensure upload directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Ensure directory is writable
        }

        $target_file = $uploadDir . $new_file_name;

        if (move_uploaded_file($image_tmp, $target_file)) {
            return $new_file_name; // Return the generated file name if upload succeeds
        } else {
            return null; // Return null if upload fails
        }
    }

    // File upload directory
    $upload_dir = "upload/";
    // Handle image uploads
    $new_file_name1 = handleFileUpload('profile-photo', $upload_dir);
    // Handle captured photo (base64) conversion and saving
    if (!empty($_POST['capture_photo'])) {
        $base64_image = $_POST['capture_photo'];
        $image_parts = explode(";base64,", $base64_image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $new_file_name2 = uniqid() . '.png'; // Save captured photo as PNG
        $file_path = $upload_dir . $new_file_name2;

        // Save the image file
        file_put_contents($file_path, $image_base64);
    } else {
        $new_file_name2 = null;
    }

    // Collect form data
    $fathername = $_POST["fathername"];
    $mothername = $_POST["mothername"];
    $bloodgrp = $_POST["bloodgrp"];
    $genderr = $_POST["genderr"];
    $maritalstatus = $_POST["maritalstatus"];
    $wpnumber = $_POST["wpnumber"];
    $adharnumber = $_POST["adharnumber"];
    $pannumber = $_POST["pannumber"];
    $emergencynumber = $_POST["emergencynumber"];
    $emergencyrelation = $_POST["emergencyrelation"];

    // Insert data into the database
    // $sql = "INSERT INTO emp_form (emp_form_fathername, emp_form_mothername, emp_form_bg, emp_form_gender, emp_form_marital, emp_form_wpnum, emp_form_adharnum, emp_form_pan, emp_form_emernum, emp_form_emerrel, emp_form_image, emp_form_livepic)
    // VALUES ('$fathername','$mothername', '$bloodgrp', '$genderr', '$maritalstatus', '$wpnumber', '$adharnumber', '$pannumber', '$emergencynumber', '$emergencyrelation', '$new_file_name1', '$new_file_name2')";


    $sql = "UPDATE emp_form SET emp_form_fathername='$fathername', emp_form_mothername='$mothername', emp_form_bg='$bloodgrp', emp_form_gender='$genderr', emp_form_marital='$maritalstatus', emp_form_wpnum='$wpnumber', emp_form_adharnum='$adharnumber', emp_form_pan='$pannumber', emp_form_emernum='$emergencynumber', emp_form_emerrel='$emergencyrelation', emp_form_image='$new_file_name1', emp_form_livepic='$new_file_name2' WHERE emp_form_phone='$mobileno'";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>