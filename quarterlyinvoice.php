<?php
require('fpdf/fpdf.php');
include "common/conn.php";
$empId = $_GET["id"];
$startDate = $_GET["startdt"];
$endDate = $_GET["enddt"];
$sql = "SELECT * FROM employee where em_code = '$empId'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$image = $row["em_image"];


// Create PDF instance
$pdf = new FPDF();
$pdf->AddPage();

// Specify the path to your image file
$imagePath = 'assets/img/head1.jpg';

// Add the image to the PDF
// Parameters: (image file path, x position, y position, width, height)
$pdf->Image($imagePath, 10, null, 190, 0, 'JPG');

// Set font
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, 'Quarterly Work Report', 0, 1, 'C');
$pdf->Ln(7); // Add space

// Set font for date and employee details
$pdf->SetFont('Arial', '', 9);

// Add static employee image
$imagePath = $image; // Path to the static image
$imageWidth = 40; // Width of the image
$imageHeight = 30; // Height of the image

// Calculate X position for the image (right-align)
$imageX = $pdf->GetPageWidth() - $imageWidth - 10; // 10 units from the right edge
$imageY = 40; // Set Y position for the image (10 units from the top)

// Add the image with specified width and height
$pdf->Image($imagePath, $imageX, $imageY, $imageWidth, $imageHeight);

// Move Y position down for text
$pdf->Ln(-4); // Adjust this value to move down from the top (20 units in this case)


// Add text information
$pdf->Cell(0, 5, 'Date: ' . date('Y-m-d'), 0, 1);
$pdf->Cell(0, 5, 'Employee Name: ' . $row["full_name"], 0, 1);
$pdf->Cell(0, 5, 'Employee ID: ' . $row["em_code"], 0, 1);
$pdf->Cell(0, 5, 'Mobile No: ' . $row["em_phone"], 0, 1);
$pdf->Cell(0, 5, 'Email Id: ' . $row["em_email"], 0, 1);
$pdf->Ln(7);

// Assuming you have already created a PDF object $pdf
$pdf->SetFont('Arial', 'B', 9);

// Table headers
$pdf->Cell(10, 10, 'Sl. No', 1, 0, 'C');
$pdf->Cell(30, 10, 'Date', 1, 0, 'C');
$pdf->Cell(40, 10, 'Project Name', 1, 0, 'C');
$pdf->Cell(90, 10, 'Work Details', 1, 0, 'C');
$pdf->Cell(20, 10, 'Duration', 1, 0, 'C');
$pdf->Ln();

// Set font for data
$pdf->SetFont('Arial', '', 9);

// Sample Table Data for Sl. No and Description
$tableData = array();
$totalAmount = 0; // Initialize totalAmount to avoid undefined behavior
$slNo = 1; // Initialize serial number

$previousMonthStart = (new DateTime('first day of last month'))->format('Y-m-d');
$previousMonthEnd = (new DateTime('last day of last month'))->format('Y-m-d');

$sql2 = "SELECT * FROM daily_report WHERE emp_id = '$empId' AND DATE(date21) BETWEEN '$startDate' AND '$endDate' ";
$result2 = $conn->query($sql2);
$slNo = 1; // Initialize serial number

while ($row2 = $result2->fetch_assoc()) {

    $pro_id = $row2["pro_id"];
    if ($pro_id == 0) {
        $project_name = "Other";
    } else {
        $sql1 = "SELECT * FROM project WHERE id = '$pro_id'";
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        $project_name = $row1["pro_name"];
    }

    // Dynamic serial number and cell data
    $pdf->SetFont('Arial', '', 10);

    // Serial Number, Date, and Project Name cells
    $pdf->Cell(10, 10, $slNo, 1, 0, 'C'); // Serial Number cell with center alignment
    $pdf->Cell(30, 10, $row2["date21"], 1, 0, 'C'); // Date cell with center alignment
    $pdf->Cell(40, 10, $project_name, 1, 0, 'C'); // Project name cell with center alignment

    // Capture the current X and Y positions
    $currentX = $pdf->GetX();
    $currentY = $pdf->GetY();

    // Work details cell with wrapping text
    $pdf->MultiCell(90, 10, $row2["work_details"], 1, 'C'); // Wrap text in work details cell

    // Reset X and Y position for the duration cell
    $pdf->SetXY($currentX + 90, $currentY);

    // Duration cell with center alignment
    $pdf->Cell(20, 10, $row2["duration"], 1, 0, 'C');

    // Move to the next line
    $pdf->Ln();
    $slNo++;
}
// Output the PDF
$pdf->Output();
// Output the PDF
$pdf->Output('I', 'Daily_Work_Report.pdf');
?>