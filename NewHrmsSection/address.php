<?php
session_start();
include 'conn.php';
$mobileno = $_SESSION['emp_form_phone'];
?>
<?php
include "conn.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $p_address = $_POST["p_address"];
    $pcity = $_POST["pcity"];
    $pdist = $_POST["pdist"];
    $pstate = $_POST["pstate"];
    $pcountry = $_POST["pcountry"];
    $p_pin = $_POST["p_pin"];
    $p_post = $_POST["p_post"];
    $p_police = $_POST["p_police"];
    $preaddrs = $_POST["preaddrs"];
    $precity = $_POST["precity"];
    $predist = $_POST["predist"];
    $prestate = $_POST["prestate"];
    $precountry = $_POST["precountry"];
    $prepin = $_POST["prepin"];
    $prepost = $_POST["prepost"];
    $prepolice = $_POST["prepolice"];
    // $sql = "INSERT INTO emp_form (emp_form_adrs, emp_form_city, emp_form_dist, emp_form_state, emp_form_post, emp_form_police, emp_form_country, emp_form_pin, emp_form_preadrs, emp_form_precity, emp_form_predist, emp_form_prestate, emp_form_precountry, emp_form_prepin, emp_form_prepost, emp_form_prepolice)VALUES ('$p_address','$pcity','$pdist','$pstate','$p_post','$p_police','$pcountry','$p_pin','$preaddrs','$precity','$predist','$prestate','$precountry','$prepin','$prepost','$prepolice')";

    $sql = "UPDATE emp_form SET emp_form_adrs='$p_address', emp_form_city='$pcity', emp_form_dist='$pdist', emp_form_state='$pstate', emp_form_post='$p_post', emp_form_police='$p_police', emp_form_country='$pcountry', emp_form_pin='$p_pin', emp_form_preadrs='$preaddrs', emp_form_precity='$precity', emp_form_predist='$predist', emp_form_prestate='$prestate', emp_form_precountry='$precountry', emp_form_prepin='$prepin', emp_form_prepost='$prepost', emp_form_prepolice='$prepolice' WHERE emp_form_phone='$mobileno'";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>