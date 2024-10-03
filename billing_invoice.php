<?php
require('fpdf/fpdf.php');
include 'common/conn.php';
$invoiceNum = $_GET["invoice"];
$invoiceNum = base64_decode($invoiceNum);
$sql = "SELECT * FROM project_invoice where invoice_number = $invoiceNum";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$pro_id = $row["project_id"];
$sql1 = "SELECT * FROM project where id = $pro_id";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();

$invoice = $row["invoice_number"];
$sql2 = "SELECT * FROM invoice_details where invoice_number = $invoice";
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();

$gst = $row["pro_gst"];
$state = $row1["state"];

// Create PDF instance
$pdf = new FPDF();
$pdf->AddPage();

// Set font
$pdf->SetFont('Arial', '', 12);

// Move cursor down for extra space at the top
$pdf->Ln(10);

// Add logo to the left side
$logoPath = 'https://techgeering.com/assets/img/tech-logo21.png';
$pdf->Image($logoPath, 10, 10, 40);

$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 5, 'Our Preparation - Your Profit', 0, 1, 'L');
$pdf->Ln(5); // Move down a bit more

$pdf->SetY(5);

// Output tax invoice, date, and invoice number at the top right
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, 'Tax Invoice', 0, 1, 'R');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Date: ' . $row["date"], 0, 1, 'R');
$pdf->Cell(0, 5, 'Invoice No: ' . $row["invoice_number"], 0, 1, 'R');
$pdf->SetFont('Arial', '', 12);

$pdf->Ln(10);
$pdf->SetFont('Arial', '', 10); // Decrease the font size
$pdf->Cell(20, 6, 'From,', 0, 0, 'L');
$pdf->Ln(); // Move to the next line
$pdf->Cell(0, 6, 'Techgeering Solutions Pvt. Ltd,', 0, 1, 'L');
$pdf->Cell(0, 6, 'Plot no:M-25/14, Panchasakhanagar,', 0, 1, 'L');
$pdf->Cell(0, 6, 'Dumduma, Bhubaneswar,', 0, 1, 'L');
$pdf->Cell(0, 6, 'Odisha, India-751019', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10); // Decrease bold font size
$pdf->Cell(0, 6, 'CIN: U72900OR2020PTC032855', 0, 1, 'L');
$pdf->Cell(0, 6, 'GSTIN: 21AAHCT8177F1Z8', 0, 1, 'L');
$pdf->Cell(0, 6, 'PAN: AAHCT8177F', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10); // Set back to regular smaller font
$pdf->Ln();


// Move to the right side
$pdf->SetY(35);

$pdf->Cell(0, 6, 'To,', 0, 1, 'R');
// $pdf->Cell(0, 6, $row['cname'], 0, 1, 'R');
$pdf->Cell(0, 6, $row1['pro_address'], 0, 1, 'R');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 6, 'GST:' . $row1["pro_gstno"], 0, 1, 'R');
$pdf->Cell(0, 6, 'Project Id:' . $row['project_id'], 0, 1, 'R');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln();

// Add a gap between sections
$pdf->Ln(20);


// New table heading
$pdf->SetFont('Arial', 'B', 10); // Bold font for Sl. No
$pdf->Cell(30, 10, 'Sl. No', 1);

$pdf->SetFont('Arial', '', 10); // Regular font for the rest
$pdf->Cell(88, 10, 'Description of goods/services', 1);
$pdf->Cell(40, 10, 'HSN/SAC', 1);
$pdf->Cell(33, 10, 'Total Charges', 1);
$pdf->Ln();


// Sample Table Data for Sl. No and Description
$tableData = array();
$totalAmount = 0; // Initialize totalAmount to avoid undefined behavior
$slNo = 1; // Initialize serial number

$sql2 = "SELECT * FROM invoice_details WHERE invoice_number = $invoice";
$result2 = $conn->query($sql2);

while ($row2 = $result2->fetch_assoc()) {
    $totalAmount += (float) $row2['total_amount']; // Corrected to $row2['total_amount']

    // Dynamic serial number and cell data
    $pdf->Cell(30, 10, $slNo, 1); // Sl. No
    $pdf->Cell(88, 10, $row2["description"], 1);
    $pdf->Cell(40, 10, $row2["hsn_num"], 1);
    $pdf->Cell(33, 10, number_format($row2["total_amount"], 2, '.', ''), 1);

    $pdf->Ln(); // Line break
    $slNo++; // Increment serial number for each row
}

// Display total amount
// $pdf->Cell(30, 10, NULL, 0); // Empty Sl. No column
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(158, 10, 'Bill Amount', 1, 0, 'R');
// $pdf->Cell(40, 10, NULL, 0); // Empty HSN number column
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(33, 10, number_format($totalAmount, 2, '.', ''), 1); // Display total amount


function convertToWords($number)
{
    $words = array(
        '0' => 'Zero',
        '1' => 'One',
        '2' => 'Two',
        '3' => 'Three',
        '4' => 'Four',
        '5' => 'Five',
        '6' => 'Six',
        '7' => 'Seven',
        '8' => 'Eight',
        '9' => 'Nine',
        '10' => 'Ten',
        '11' => 'Eleven',
        '12' => 'Twelve',
        '13' => 'Thirteen',
        '14' => 'Fourteen',
        '15' => 'Fifteen',
        '16' => 'Sixteen',
        '17' => 'Seventeen',
        '18' => 'Eighteen',
        '19' => 'Nineteen',
        '20' => 'Twenty',
        '30' => 'Thirty',
        '40' => 'Forty',
        '50' => 'Fifty',
        '60' => 'Sixty',
        '70' => 'Seventy',
        '80' => 'Eighty',
        '90' => 'Ninety'
    );

    $divisors = array(
        10000000 => 'Crore',
        100000 => 'Lakh',
        1000 => 'Thousand',
        100 => 'Hundred'
    );

    $result = '';

    foreach ($divisors as $divisor => $divisorText) {
        $quotient = floor($number / $divisor);
        $number %= $divisor;

        if ($quotient > 0) {
            if ($quotient >= 100) {
                $result .= convertToWords($quotient) . ' ' . $divisorText . ' ';
            } else {
                // Handle numbers from 10 to 19
                if ($quotient >= 10 && $quotient <= 19) {
                    $result .= $words[$quotient] . ' ' . $divisorText . ' ';
                } else {
                    $tens = floor($quotient / 10) * 10;  // Get the tens
                    $ones = $quotient % 10;  // Get the ones

                    if ($tens > 0) {
                        $result .= $words[$tens] . ' ';
                    }

                    if ($ones > 0) {
                        $result .= $words[$ones] . ' ';
                    }

                    $result .= $divisorText . ' ';
                }
            }
        }
    }

    // Handle the last part for numbers below 100
    if ($number > 0) {
        if ($number < 20) {
            $result .= $words[$number];
        } else {
            $tens = floor($number / 10) * 10;
            $ones = $number % 10;

            $result .= $words[$tens] . ' ';

            if ($ones > 0) {
                $result .= $words[$ones];
            }
        }
    }

    return trim($result);
}


if ($state == 'odisha') {
    $igst = 0;
    $cgst = $gst / 2;
    $sgst = $gst / 2;

    $igstt = 0;
    $cgstt = $totalAmount / 100 * $cgst;
    $sgstt = $totalAmount / 100 * $sgst;
    $price = $totalAmount + $cgstt + $sgstt;
} else {
    $igst = $gst;
    $cgst = 0;
    $sgst = 0;

    $igstt = $totalAmount / 100 * $igst;
    $cgstt = 0;
    $sgstt = 0;
    $price = $totalAmount + $igstt;
}

$amountInWords = convertToWords($price);

if ($igst > 0) {
    $pdf->Ln();
    // $pdf->Cell(30, 10, NULL, 0); // Sl. No
    // $pdf->Cell(88, 10, NULL, 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(158, 10, 'IGST @' . $igst . ' %', 1, 0, 'R');
    $pdf->Cell(33, 10, number_format($igstt, 2, '.', ''), 1);
}

if ($cgst > 0) {
    $pdf->Ln();
    // $pdf->Cell(30, 10, NULL, 0); // Sl. No
    // $pdf->Cell(88, 10, NULL, 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(158, 10, 'CGST @' . $cgst . ' %', 1, 0, 'R');
    $pdf->Cell(33, 10, number_format($cgstt, 2), 1);
}

if ($sgst > 0) {
    $pdf->Ln();
    // $pdf->Cell(30, 10, NULL, 0); // Sl. No
    // $pdf->Cell(88, 10, NULL, 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(158, 10, 'SGST @' . $sgst . ' %', 1, 0, 'R');
    $pdf->Cell(33, 10, number_format($sgstt, 2), 1);
}

$pdf->Ln();
$pdf->Cell(30, 10, NULL, 0); // Sl. No
$pdf->Cell(88, 10, NULL, 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 10, 'Total Bill Amount', 2, 0, 'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(33, 10, number_format($price, 2), 1);


$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Total Amount in Word :', 0, 1, 'L');
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(0, 10, $amountInWords, 0, 1, 'L');

$pdf->Ln(21);
// New table heading
$pdf->SetFont('Arial', 'B', 10);

$pdf->SetY(192);

$pdf->Cell(0, 6, 'For:Techgeering Solutions Private Limited', 0, 1, 'R');

$pdf->Ln(17);

$pdf->Cell(0, 6, 'Authorized Signature', 0, 1, 'R');


$pdf->Ln(5);
// Add note at the left bottom
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'Note,', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10); // 'B' for bold, 'I' for italic
$pdf->Cell(0, 6, 'Issue All Cheques In The Name Of Techgeering', 0, 1, 'L');
$pdf->Cell(0, 6, 'Solutions Private Limited.', 0, 1, 'L');
$pdf->Cell(0, 6, 'All Payments Done Are Non-refundable And Non-', 0, 1, 'L');
$pdf->Cell(0, 6, 'transferable.', 0, 1, 'L');
$pdf->Cell(0, 6, 'All Payments Done Are Subject To Realisation.', 0, 1, 'L');
$pdf->Cell(0, 6, 'All Disputes Are Subject To Bhubaneswar', 0, 1, 'L');
$pdf->Cell(0, 6, 'Jurisdiction Only.', 0, 1, 'L');

$pdf->SetY(230);

// Add the next line of text
$pdf->SetFont('Arial', 'B', 10); // 'B' for bold, 'I' for italic
$pdf->Cell(0, 6, 'Bank Account Details,', 0, 1, 'R'); // Add the text on the right side
$pdf->Cell(0, 6, 'Name: Techgeering Solutions Private Limited', 0, 1, 'R');
$pdf->Cell(0, 6, 'Current Account Number: 50200068410184', 0, 1, 'R');
$pdf->Cell(0, 6, 'Bank Name: Hdfc Bank', 0, 1, 'R');
$pdf->Cell(0, 6, 'Branch: Baramunda,Bhubaneswar', 0, 1, 'R');
$pdf->Cell(0, 6, 'Ifsc Code: Hdfc0002457', 0, 1, 'R');


ob_clean();
$pdf->Output('invoice.pdf', 'I');

$conn->close();
