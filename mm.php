<?php
include "common/conn.php";
if (isset($_POST['submit'])) {
    $year = $_POST["year"];
    $month = $_POST["month"];

    // $expenditurenames = [];
    $nameColumn = [];
    $sql = "SELECT * FROM expenditure";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $expenditurenames = $row['expenditure_name'];


        // $expenditurenames[] = "$expenditurenames";
        $nameColumn[] = "$expenditureName=$value";
    }
    // $expen_name = implode(', ', $expenditurenames);

    $expen_name = implode(',', $nameColumn);
    $sql = "INSERT INTO expenditure_calculator(year, month, name) VALUES('$year','$month','$expen_name')";
    if ($conn->query($sql) == true) {
        echo "<script>alert('success')</script>";
    } else {
        $conn->error;
    }
    $conn->close();
}
?>