<?php
session_start();
include 'conn.php';
$mobileno = $_SESSION['emp_form_phone'];
echo "<script>alert($mobileno)</script>";
?>

<?php
include "conn.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cmp1_name = $_POST["cmp1_name"];
    $cmp1_position = $_POST["cmp1_position"];
    $cmp1_address = $_POST["cmp1_address"];
    $cmp1_from = $_POST["cmp1_from"];
    $cmp1_to = $_POST["cmp1_to"];
    $cmp1_salary = $_POST["cmp1_salary"];
    $cmp2_name = $_POST["cmp2_name"];
    $cmp2_position = $_POST["cmp2_position"];
    $cmp2_address = $_POST["cmp2_address"];
    $cmp2_from = $_POST["cmp2_from"];
    $cmp2_to = $_POST["cmp2_to"];
    $cmp2_saalry = $_POST["cmp2_saalry"];
    $cmp3_name = $_POST["cmp3_name"];
    $cmp3_position = $_POST["cmp3_position"];
    $cmp3_address = $_POST["cmp3_address"];
    $cmp3_from = $_POST["cmp3_from"];
    $cmp3_to = $_POST["cmp3_to"];
    $cmp3_salary = $_POST["cmp3_salary"];

    // $sql = "INSERT INTO emp_form (emp_form_cmpname1, emp_form_position1, emp_form_address1, emp_form_from1, emp_form_to1, emp_form_salary1, emp_form_cmpname2, emp_form_position2, emp_form_address2, emp_form_from2, emp_form_to2, emp_form_salary2, emp_form_cmpname3, emp_form_position3, emp_form_address3, emp_form_from3, emp_form_to3, emp_form_salary3)VALUES ('$cmp1_name','$cmp1_position','$cmp1_address','$cmp1_from','$cmp1_to','$cmp1_salary','$cmp2_name','$cmp2_position','$cmp2_address','$cmp2_from','$cmp2_to','$cmp2_saalry','$cmp3_name','$cmp3_position','$cmp3_address','$cmp3_from','$cmp3_to','$cmp3_salary')";


    $sql = "UPDATE emp_form SET emp_form_cmpname1='$cmp1_name', emp_form_position1='$cmp1_position', emp_form_address1='$cmp1_address', emp_form_from1='$cmp1_from', emp_form_to1='$cmp1_to', emp_form_salary1='$cmp1_salary', emp_form_cmpname2='$cmp2_name', emp_form_position2='$cmp2_position', emp_form_address2='$cmp2_address', emp_form_from2='$cmp2_from', emp_form_to2='$cmp2_to', emp_form_salary2='$cmp2_saalry', emp_form_cmpname3='$cmp3_name', emp_form_position3='$cmp3_position', emp_form_address3='$cmp3_address', emp_form_from3='$cmp3_from', emp_form_to3='$cmp3_to', emp_form_salary3='$cmp3_salary' WHERE emp_form_phone='$mobileno'";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>