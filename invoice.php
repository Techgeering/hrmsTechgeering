<?php
require('fpdf/fpdf.php');
include 'db.php';


// $id = isset($_GET['id']) ? $_GET['id'] : '';
// $pid = isset($_GET['pid']) ? $_GET['pid'] : '';
// $price = isset($_GET['price']) ? $_GET['price'] : '';
// $date = isset($_GET['date']) ? $_GET['date'] : '';
// $installment = isset($_GET['installment']) ? $_GET['installment'] : '';
$sql3 = "SELECT * FROM price WHERE id = '$id'";
$resulta = $conn->query($sql3);
$rowa = $resulta->fetch_assoc();
$pid = $rowa['pid'];
$price = $rowa['price'];
$date = $rowa['date'];
$installment = $rowa['installmentno'];
$currentYear = date('Y');
$currentMonth = date('m');



$sql = "SELECT projectt.pid, projectt.pname, projectt.fullprice, projectt.igst, projectt.cgst, projectt.sgst, company.cname, company.address,projectt.gst, projectt.rate, projectt.discount, projectt.price, company.gst,projectt.paidprice,projectt.restprice,projectt.gstt
        FROM projectt
        INNER JOIN company ON projectt.cid = company.cid
        WHERE projectt.pid='$pid'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();


    // Replace these with your actual data
    $invoiceNumber = $currentYear . $currentMonth . $id;
    $invoiceDate = $date;
    $projectName = $row['pname'];
    // $invoiceno=$row['invoiceno'];
    $discount = $row['discount'];
    $projectprice = $price;
    $total = $price;
    $igst = $row['igst'];
    $sgst = $row['sgst'];
    $cgst = $row['cgst'];
    // $totall= $price;
    $fullprice = $row['fullprice'];
    $paidprice = $row['paidprice'];
    $restprice = $row['restprice'];
    $gst = $row['gstt'];


    // $discounted = $price / 100 * $discount;
    // $discountedPrice = $price - $discounted;

    // $totall= $discountedPrice + $igstt + $cgstt + $sgstt;

    //GST calculator
    $totalAmount = $price / (1 + $gst / 100);
    $igstt = $totalAmount / 100 * $igst;
    $cgstt = $totalAmount / 100 * $cgst;
    $sgstt = $totalAmount / 100 * $sgst;

    //calculate the rate
    $discountpercentage = 100 - $discount;
    $rate = $totalAmount / $discountpercentage * 100;

    //     echo "Invoice Number: $invoiceNumber<br>";
// echo "Invoice Date: $invoiceDate<br>";
// echo "Project Name: $projectName<br>";
// echo "Rate: $rate<br>";
// echo "Discount: $discount<br>";
// echo "Project Price: $projectprice<br>";
// echo "Total: $total<br>";
// echo "IGST: $igst<br>";
// echo "SGST: $sgst<br>";
// echo "CGST: $cgst<br>";
// echo "Total Price: $totall<br>";
// echo "Paid Price: $paidprice<br>";
// echo "Remaining Price: $restprice<br>";

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

    $pdf->SetFont('Arial', 'I', 13);
    $pdf->Cell(0, 5, 'Our Preparation - Your Profit', 0, 1, 'L');
    $pdf->Ln(5); // Move down a bit more

    $pdf->SetY(5);

    // Output tax invoice, date, and invoice number at the top right
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 5, 'Tax Invoice', 0, 1, 'R');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Date: ' . $invoiceDate, 0, 1, 'R');
    $pdf->Cell(0, 5, 'Invoice No: TG' . $invoiceNumber, 0, 1, 'R');
    $pdf->SetFont('Arial', '', 12);

    //from section
    $pdf->Ln(10);
    $pdf->Cell(20, 6, 'From,', 0, 0, 'L');
    $pdf->Ln(); // Move to the next line
    $pdf->Cell(0, 6, 'Techgeering Solutions Pvt. Ltd,', 0, 1, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 6, 'Plot no:M-25/14, Panchasakhanagar,', 0, 1, 'L');
    $pdf->Cell(0, 6, 'Dumduma, Bhubaneswar,', 0, 1, 'L');
    $pdf->Cell(0, 6, 'Odisha, India-751019', 0, 1, 'L');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 6, 'CIN: U72900OR2020PTC032855', 0, 1, 'L');
    $pdf->Cell(0, 6, 'GSTIN: 21AAHCT8177F1Z8', 0, 1, 'L');
    $pdf->Cell(0, 6, 'PAN: AAHCT8177F', 0, 1, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln();

    // Move to the right side
    $pdf->SetY(35);

    $pdf->Cell(0, 6, 'To,', 0, 1, 'R');
    $pdf->Cell(0, 6, $row['cname'], 0, 1, 'R');
    $pdf->Cell(0, 6, $row['address'], 0, 1, 'R');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 6, 'GST:' . $row['gst'], 0, 1, 'R');
    $pdf->Cell(0, 6, 'Project Id:' . $row['pid'], 0, 1, 'R');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln();

    // Add a gap between sections
    $pdf->Ln(20);


    // New table heading
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(20, 10, 'Sl. No', 1);
    $pdf->Cell(78, 10, 'Description', 1);
    $pdf->Cell(30, 10, 'HSN/SAC', 1);
    $pdf->Cell(20, 10, 'Rate', 1);
    $pdf->Cell(20, 10, 'Discount', 1);
    $pdf->Cell(22, 10, 'Amount', 1);

    // $pdf->Cell(20, 10, 'Total', 1);
// $pdf->Cell(20, 10, 'Gst', 1);
// $pdf->Cell(20, 10, 'Igst', 1);
// $pdf->Cell(20, 10, 'Sgst', 1);
// $pdf->Cell(20, 10, 'Cgst', 1);
// $pdf->Cell(20, 10, 'Grand Total', 1);
    $pdf->Ln();

    // Sample Table Data for Sl. No and Description
    $tableData = array(
        // No need for this array if you want static data in the heading
    );

    // Static data for the table heading
    $pdf->Cell(20, 10, '1', 1); // Sl. No
    $pdf->Cell(78, 10, $projectName . ' (' . $installment . ')', 1);
    $pdf->Cell(30, 10, 67588, 1);
    $pdf->Cell(20, 10, number_format($rate, 2, '.', ''), 1);
    $pdf->Cell(20, 10, $discount, 1);
    $pdf->Cell(22, 10, number_format($totalAmount, 2, '.', ''), 1);




    // $pdf->Cell(20, 10, $total, 1);
// $pdf->Cell(20, 10, 18, 1);
// $pdf->Cell(20, 10, $igst, 1);
// $pdf->Cell(20, 10, $sgst, 1);
// $pdf->Cell(20, 10, $cgst, 1);
// $pdf->Cell(20, 10, $totall, 1);
    $pdf->Ln();
    $pdf->Cell(20, 10, '2', 1); // Sl. No
    $pdf->Cell(78, 10, NULL, 1);
    $pdf->Cell(30, 10, NULL, 1);
    $pdf->Cell(20, 10, NULL, 1);
    $pdf->Cell(20, 10, NULL, 1);
    $pdf->Cell(22, 10, NULL, 1);
    $pdf->Ln();

    $pdf->Cell(20, 10, '3', 1); // Sl. No
    $pdf->Cell(78, 10, NULL, 1);
    $pdf->Cell(30, 10, NULL, 1);
    $pdf->Cell(20, 10, NULL, 1);
    $pdf->Cell(20, 10, NULL, 1);
    $pdf->Cell(22, 10, NULL, 1);

    $pdf->Ln();
    $pdf->Cell(20, 10, NULL, 0); // Sl. No
    $pdf->Cell(78, 10, NULL, 0);
    $pdf->Cell(30, 10, 'Total', 1);


    $pdf->Cell(20, 10, number_format($rate, 2, '.', ''), 1);
    $pdf->Cell(20, 10, 0, 1);
    // $pdf->Cell(20, 10, NULL, 1);
    $pdf->Cell(22, 10, number_format($totalAmount, 2, '.', ''), 1);


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
                    if ($quotient >= 10 && $quotient <= 19) {
                        $result .= $words[$quotient] . ' ' . $divisorText . ' ';
                    } else {
                        $tens = floor($quotient / 10);
                        $ones = $quotient % 10;

                        if ($tens > 0) {
                            $result .= $words[$tens * 10] . ' ';
                        }

                        if ($ones > 0) {
                            $result .= $words[$ones] . ' ';
                        }

                        $result .= $divisorText . ' ';
                    }
                }
            }
        }

        if ($number > 0) {
            $result .= $words[$number] ?? '';
        }

        return $result;
    }

    $amountInWords = convertToWords($price);


    $pdf->Ln();
    $pdf->Cell(20, 10, NULL, 0); // Sl. No
    $pdf->Cell(78, 10, NULL, 0);
    $pdf->Cell(30, 10, NULL, 0);
    $pdf->Cell(20, 10, 'IGST', 1);
    $pdf->Cell(20, 10, $igst, 1);
    // $pdf->Cell(20, 10, NULL, 1);
    $pdf->Cell(22, 10, number_format($igstt, 2, '.', ''), 1);




    $pdf->Ln();
    $pdf->Cell(20, 10, NULL, 0); // Sl. No
    $pdf->Cell(78, 10, NULL, 0);
    $pdf->Cell(30, 10, NULL, 0);
    $pdf->Cell(20, 10, 'CGST', 1);
    $pdf->Cell(20, 10, $cgst, 1);
    // $pdf->Cell(20, 10, NULL, 1);
    $pdf->Cell(22, 10, number_format($cgstt, 2), 1);

    $pdf->Ln();
    $pdf->Cell(20, 10, NULL, 0); // Sl. No
    $pdf->Cell(78, 10, NULL, 0);
    $pdf->Cell(30, 10, NULL, 0);
    $pdf->Cell(20, 10, 'SGST', 1);
    $pdf->Cell(20, 10, $sgst, 1);
    // $pdf->Cell(20, 10, NULL, 1);
    $pdf->Cell(22, 10, number_format($sgstt, 2), 1);

    $pdf->Ln();
    $pdf->Cell(20, 10, NULL, 0); // Sl. No
    $pdf->Cell(78, 10, NULL, 0);
    $pdf->Cell(30, 10, NULL, 0);
    $pdf->Cell(20, 10, 'Grand Total', 2);
    $pdf->Cell(20, 10, NULL, 0);
    // $pdf->Cell(20, 10, NULL, 1);
    $pdf->Cell(22, 10, $price, 1);


    $pdf->Ln(-22);
    $pdf->SetFont('Arial', 'B', 14);
    // $pdf->Cell(0, 5, 'Tax Invoice', 0, 1, 'R');
    $pdf->Cell(0, 10, 'Total Amount in Word :', 0, 1, 'L');
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(0, 10, $amountInWords, 0, 1, 'L');



    $pdf->Ln(21);
    // New table heading
    $pdf->SetFont('Arial', 'B', 12);

    // Column 1
    $pdf->Cell(50, 10, 'Total Project Cost', 1);
    $pdf->Cell(50, 10, $fullprice, 1);
    $pdf->Ln(); // Move to the next line

    // Column 2
    $pdf->Cell(50, 10, 'Total Paid Amount', 1);
    $pdf->Cell(50, 10, $paidprice, 1);
    $pdf->Ln(); // Move to the next line

    // Column 3
    $pdf->Cell(50, 10, 'Total Due Balance', 1);
    $pdf->Cell(50, 10, $restprice, 1);
    $pdf->Ln(); // Move to the next line

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


    // Save or output the PDF
    ob_clean();  // Clean the output buffer
    $pdf->Output('invoice.pdf', 'I');

} else {
    echo "No data found for the specified project ID.";
}
$conn->close();
?>