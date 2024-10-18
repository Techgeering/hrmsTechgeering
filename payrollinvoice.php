<?php
require('fpdf/fpdf.php');
include "common/conn.php";
$empId = $_GET["id"];
$sql = "SELECT * FROM employee where em_code = '$empId'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$dep_id = $row["dep_id"];
$sql1 = "SELECT * FROM department WHERE id = $dep_id";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();

$des_id = $row["des_id"];
$sql2 = "SELECT * FROM designation WHERE id = $des_id";
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();

$empId = $_GET["id"];
$sql3 = "SELECT * FROM pay_salary WHERE emp_id = '$empId'";
$result3 = $conn->query($sql3);
$row3 = $result3->fetch_assoc();


$empId = $_GET["id"];
$sql4 = "SELECT * FROM earnings WHERE emp_id = '$empId'";
$result4 = $conn->query($sql4);
$row4 = $result4->fetch_assoc();
$total_earnings = $row4["basic"] + $row4["house_rent"] + $row4["travel"] + $row4["medical"] + $row4["perform_bonus"];
$total_earnings1 = $row4["basic"] + $row4["house_rent"] + $row4["medical"] + $row4["perform_bonus"];

$total_deduction = $row3["tax"] + $row3["provident_fund"] + $row3["tds"] + $row3["bima"] + $row3["other_diduction"];
$net_pay = $total_earnings1 - $total_deduction;

$empId = $_GET["id"];
$sql5 = "SELECT * FROM bank_info WHERE em_id = '$empId'";
$result5 = $conn->query($sql5);
$row5 = $result5->fetch_assoc();

$empId = $_GET["id"];
$sql6 = "SELECT * FROM attadence_report WHERE emp_id = '$empId'";
$result6 = $conn->query($sql6);
$row6 = $result6->fetch_assoc();

// Create a new PDF document
$pdf = new FPDF();
$pdf->AddPage();

// Specify the path to your image file
$imagePath = 'assets/img/head1.jpg'; // Replace with the actual image path

// Add the image to the PDF
// Parameters: (image file path, x position, y position, width, height)
$pdf->Image($imagePath, 10, null, 190, 0, 'JPG'); // Adjust parameters as needed


// Employee Details Section
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(95, 6, 'Employee Name: ' . $row["full_name"], 0, 0);
$pdf->Cell(95, 6, 'Employee ID: ' . $row["em_code"], 0, 1);
$pdf->Cell(95, 6, 'Designation: ' . $row2["des_name"], 0, 0);
$pdf->Cell(95, 6, 'Department: ' . $row1["dep_name"], 0, 1);
// $pdf->Cell(95, 6, 'Date of Joining: ' . $row["em_joining_date"], 0, 0);
$pdf->Cell(95, 6, 'PAN: ' . $row["em_pan"], 0, 0);
$pdf->Cell(95, 6, 'Salary Period: ' . $row3["month"] . ' ' . $row3["year"], 0, 1);



// Static Bank Details Section
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(95, 6, 'Bank Name: ' . $row5["bank_name"], 0, 0);
$pdf->Cell(95, 6, 'Account Number: ' . $row5["account_number"], 0, 1);
// $pdf->Cell(95, 6, 'IFSC Code: ', 0, 0);
$pdf->Cell(95, 6, 'EPF No: ', 0, 0);
$pdf->Cell(95, 6, 'ESIC No: ', 0, 1);
$pdf->Ln(10); // Add some space after bank details

// Add Total Working Days
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(40, 4, 'Total Working Days:' . $row6["working_hour"], 0, 0);


// Add Total Paid Days
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(40, 4, 'Total Paid Days:' . $row6["payable_hour"], 0, 0);
$pdf->Ln(10);
// Earnings Section
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(95, 6, 'Earnings', 1, 0, 'C');
$pdf->Cell(95, 6, 'Amount (INR)', 1, 1, 'C');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(95, 6, 'Basic Salary', 1, 0);
$pdf->Cell(95, 6, $row4["basic"], 1, 1);
$pdf->Cell(95, 6, 'House Rent Allowance (HRA)', 1, 0);
$pdf->Cell(95, 6, $row4["house_rent"], 1, 1);
$pdf->Cell(95, 6, 'Conveyance Allowance', 1, 0);
$pdf->Cell(95, 6, $row4["travel"], 1, 1);
$pdf->Cell(95, 6, 'Medical Allowance', 1, 0);
$pdf->Cell(95, 6, $row4["medical"], 1, 1);
$pdf->Cell(95, 6, 'Performance Bonus', 1, 0);
$pdf->Cell(95, 6, $row4["perform_bonus"], 1, 1);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(95, 6, 'Gross Total Earnings', 1, 0);
$pdf->Cell(95, 6, $total_earnings, 1, 1);
$pdf->Ln(10);

// Deductions Section
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(95, 6, 'Deductions', 1, 0, 'C');
$pdf->Cell(95, 6, 'Amount (INR)', 1, 1, 'C');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(95, 6, 'Professional Tax', 1, 0);
$pdf->Cell(95, 6, $row3["tax"], 1, 1);
$pdf->Cell(95, 6, 'EPF', 1, 0);
$pdf->Cell(95, 6, $row3["provident_fund"], 1, 1);
$pdf->Cell(95, 6, 'TDS', 1, 0);
$pdf->Cell(95, 6, $row3["tds"], 1, 1);
$pdf->Cell(95, 6, 'Insurance', 1, 0);
$pdf->Cell(95, 6, $row3["bima"], 1, 1);
$pdf->Cell(95, 6, 'Other Deduction', 1, 0);
$pdf->Cell(95, 6, $row3["other_diduction"], 1, 1);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(95, 6, 'Total Deductions', 1, 0);
$pdf->Cell(95, 6, $total_deduction, 1, 1);
$pdf->Ln(10);

// Net Salary Section
// $pdf->SetFont('Arial', 'B', 10);
// $pdf->Cell(95, 6, 'Net Pay', 1, 0);
// $pdf->Cell(95, 6, '51,800', 1, 1);

function convertNumberToWords($num)
{
    $ones = array(
        0 => "Zero",
        1 => "One",
        2 => "Two",
        3 => "Three",
        4 => "Four",
        5 => "Five",
        6 => "Six",
        7 => "Seven",
        8 => "Eight",
        9 => "Nine",
        10 => "Ten",
        11 => "Eleven",
        12 => "Twelve",
        13 => "Thirteen",
        14 => "Fourteen",
        15 => "Fifteen",
        16 => "Sixteen",
        17 => "Seventeen",
        18 => "Eighteen",
        19 => "Nineteen"
    );
    $tens = array(
        0 => "",
        1 => "Ten",
        2 => "Twenty",
        3 => "Thirty",
        4 => "Forty",
        5 => "Fifty",
        6 => "Sixty",
        7 => "Seventy",
        8 => "Eighty",
        9 => "Ninety"
    );
    $hundreds = array("", "Hundred", "Thousand", "Lakh", "Million", "Crore");

    if ($num == 0)
        return "Zero";

    $num_str = (string) $num;
    $num_str = str_pad($num_str, ceil(strlen($num_str) / 3) * 3, '0', STR_PAD_LEFT);
    $num_arr = str_split($num_str, 3);
    $result = [];
    foreach ($num_arr as $key => $chunk) {
        $num_chunk = (int) $chunk;
        if ($num_chunk == 0)
            continue;

        $hundred_part = $num_chunk / 100 >= 1 ? $ones[$num_chunk / 100] . " Hundred " : "";
        $tens_part = ($num_chunk % 100) < 20 ? $ones[$num_chunk % 100] : $tens[($num_chunk % 100) / 10] . " " . $ones[$num_chunk % 10];

        $result[] = trim($hundred_part . $tens_part) . " " . $hundreds[count($num_arr) - $key - 1];
    }

    return trim(implode(' ', $result));
}
$netPay = $net_pay; // Example net pay

// Convert net pay to words
$netPayInWords = convertNumberToWords($netPay);

// Display Net Pay in Numbers
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(95, 6, 'Net Pay', 1, 0);
$pdf->Cell(95, 6, number_format($netPay), 1, 1);

// Display Net Pay in Words
$pdf->Cell(95, 6, 'Net Pay (in words):-');
$pdf->Cell(95, 6, $netPayInWords);
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 6, 'Gross Total Earnings', 1, 0);
$pdf->Cell(140, 6, "Basic + HRA + Conveyance + Medical + Performance Bonus", 1, 1);
$pdf->Cell(50, 6, 'Total Deductions', 1, 0);
$pdf->Cell(140, 6, "Professional Tax + EPF + TDS + Insurance + Other Deduction", 1, 1);
$pdf->Cell(50, 6, 'Net Pay', 1, 0);
$pdf->Cell(140, 6, "Gross Total Earnings - Total Deductions", 1, 1);
$pdf->Ln(10);

//Footer Section
$pdf->Ln(20);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, '"This is system generated"', 0, 0, 'C');

// Output the PDF to the browser
$pdf->Output();
?>