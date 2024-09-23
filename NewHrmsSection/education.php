<?php
session_start();
include 'conn.php';
$mobileno = $_SESSION['emp_form_phone'];
?>

<?php
include "conn.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pgcourse = $_POST["pgcourse"];
    $pgstream = $_POST["pgstream"];
    $pgyear = $_POST["pgyear"];
    $pgresult = $_POST["pgresult"];
    $pguniversity = $_POST["pguniversity"];
    $pginstitute = $_POST["pginstitute"];
    $pglocation = $_POST["pglocation"];
    $gra_course = $_POST["gra_course"];
    $gra_stream = $_POST["gra_stream"];
    $gra_year = $_POST["gra_year"];
    $gra_result = $_POST["gra_result"];
    $gra_university = $_POST["gra_university"];
    $gra_institude = $_POST["gra_institude"];
    $gra_location = $_POST["gra_location"];
    $dip_course = $_POST["dip_course"];
    $dip_stream = $_POST["dip_stream"];
    $dip_year = $_POST["dip_year"];
    $dip_result = $_POST["dip_result"];
    $dip_board = $_POST["dip_board"];
    $dip_institute = $_POST["dip_institute"];
    $dip_location = $_POST["dip_location"];
    $th_pass = $_POST["10th_pass"];
    $th_result = $_POST["10th_result"];
    $th_board = $_POST["10th_board"];
    $th_institute = $_POST["10th_institute"];
    $th_location = $_POST["10th_location"];
    // $sql = "INSERT INTO emp_form (emp_form_pgrad_type, emp_form_pgrad_stream, emp_form_pgrad_yearpass, emp_form_pgrad_result, emp_form_pgrad_univ, emp_form_pgrad_insti, emp_form_pgrad_location, emp_form_grad_type, emp_form_grad_stream, emp_form_grad_yearpass, emp_form_grad_res, emp_form_grad_univ, emp_form_grad_insti, emp_form_grad_location, emp_form_c12type, emp_form_c12_stream, emp_form_c12yearpass, emp_form_c12result, emp_form_c12board, emp_form_c12school, emp_form_c12location, emp_form_c10yearpass, emp_form_c10result, emp_form_c10board, emp_form_c10school, emp_form_c10location)VALUES ('$pgcourse','$pgstream','$pgyear','$pgresult','$pguniversity','$pginstitute','$pglocation','$gra_course','$gra_stream','$gra_year','$gra_result','$gra_university','$gra_institude','$gra_location','$dip_course','$dip_stream','$dip_year','$dip_result','$dip_board','$dip_institute','$dip_location','$th_pass','$th_result','$th_board','$th_institute','$th_location')";

    $sql = "UPDATE emp_form SET emp_form_pgrad_type='$pgcourse', emp_form_pgrad_stream='$pgstream', emp_form_pgrad_yearpass='$pgyear', emp_form_pgrad_result='$pgresult', emp_form_pgrad_univ='$pguniversity', emp_form_pgrad_insti='$pginstitute', emp_form_pgrad_location='$pglocation', emp_form_grad_type='$gra_course', emp_form_grad_stream='$gra_stream', emp_form_grad_yearpass='$gra_year', emp_form_grad_res='$gra_result', emp_form_grad_univ='$gra_university', emp_form_grad_insti='$gra_institude', emp_form_grad_location='$gra_location', emp_form_c12type='$dip_course', emp_form_c12_stream='$dip_stream', emp_form_c12yearpass='$dip_year', emp_form_c12result='$dip_result', emp_form_c12board='$dip_board', emp_form_c12school='$dip_institute', emp_form_c12location='$dip_location', emp_form_c10yearpass='$th_pass', emp_form_c10result='$th_result', emp_form_c10board='$th_board', emp_form_c10school='$th_institute', emp_form_c10location='$th_location' WHERE emp_form_phone='$mobileno'";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>