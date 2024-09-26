<?php
require('fpdf/fpdf.php'); // Adjust the path as needed
include "common/conn.php";
$internId = $_GET["id"];
$internId = base64_decode($internId);
$sql = "SELECT * FROM internship where id = $internId";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Create a new PDF document
$pdf = new FPDF();
$pdf->AddPage();


// Specify the path to your image file
$imagePath = 'assets/img/head-img.jpg'; // Replace with the actual image path

// Add the image to the PDF
// Parameters: (image file path, x position, y position, width, height)
$pdf->Image($imagePath, 10, null, 190, 0, 'JPG'); // Adjust parameters as needed

// If you want to center the image, you can calculate the x position
// $pdf->Image($imagePath, ($pdf->GetPageWidth() - $width) / 2, $y, $width, 0, 'JPG');


$pdf->Ln(1);

$pdf->SetFont('Arial', 'BU', 10); // Bold and Underline
$pdf->Cell(0, 5, 'INTERN ENROLMENT FORM', 0, 1, 'C');


// Intern Details
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0, 7, 'Intern Name: ' . $row["intern_name"], 0, 1);
$pdf->Cell(0, 5, 'Father Name:' . $row["father_name"], 0, 1);
$pdf->Cell(0, 5, 'Mother Name:' . $row["mother_name"], 0, 1);
// Date of Birth    
$pdf->Cell(60, 7, 'Date of Birth:' . $row["dob"], 0, 0);
// Gender
$pdf->Cell(60, 7, 'Gender: ' . $row["gender"], 0, 0);
// Phone No
$pdf->Cell(60, 7, 'Phone No: ' . $row["phone"], 0, 1);

$pdf->Cell(0, 7, 'Email Id: ' . $row["intern_email"], 0, 1);
$pdf->Cell(0, 7, 'Address for Communication: ' . $row["intern_add"], 0, 1);
$pdf->Cell(0, 5, 'ID TYPE: ' . $row["id_type"] . ' (' . $row["valid_govt_no"] . ')', 0, 1);



// College Information
$pdf->Cell(0, 5, 'College ID Number: ' . $row["college_id"], 0, 1);
$pdf->Cell(0, 7, 'Current Educational Qualification: ' . $row["edu_qualification"], 0, 1);
$pdf->Cell(0, 7, 'College Name: ' . $row["clg_name"], 0, 1);
$pdf->Cell(0, 7, 'Internship On: ' . $row["internship_on"], 0, 1);

// Set font for the paragraph text
$pdf->SetFont('Arial', '', 9);

// Write a paragraph after the cell
$paragraph = "I accept that all the above mentioned details are true and also I have obtained for this internship program independently. I accept all terms of internship and if found violating it then may be disqualified or penalised for the same. I am also aware that doing this internship do not guarantee my job with Techgeering Solutions Pvt. Ltd.";

// Use MultiCell to create a paragraph
$pdf->MultiCell(0, 5, $paragraph);

// Optional: Add a line break after the paragraph
$pdf->Ln(5);

// Signature Section
$pdf->Cell(0, 7, 'Intern\'s Full Name: ' . $row["intern_name"], 0, 1);
$pdf->Cell(0, 7, 'Intern\'s Full Signature: ', 0, 1);
// $pdf->Cell(0, 7, 'Date: ', 0, 1);
// $pdf->Cell(0, 7, 'Place: ', 0, 1);

$pdf->Cell(0, 7, 'Date: ', 0, 1);
$pdf->Cell(0, 5, 'Place: ', 0, 1);

// Move below the last cell
$pdf->Ln(5); // Optional: adds some space between the cells and the box

// Draw a rectangle for the box
$pdf->Rect($pdf->GetX(), $pdf->GetY(), 50, 30); // Change width and height as needed

// Set position for the text inside the box
$pdf->SetXY($pdf->GetX() + 2, $pdf->GetY() + 10); // Adjust position to be inside the box

// Move the cursor down after the box (if needed, to prevent additional text from showing inside)
$pdf->Ln(20);
// Move down to make space below the box


// $pdf->SetXY(150, $pdf->GetY() - 35);


// $pdf->Rect(150, $pdf->GetY(), 40, 40); 


// $pdf->SetXY(170, $pdf->GetY() + 10); 

// Set the position for the box (adjust y to move up or down)
$pdf->SetXY(150, $pdf->GetY() - 35);

// Draw the box (adjust height as needed)
$pdf->Rect(150, $pdf->GetY(), 40, 40); // Height of 40

// Ensure image path is valid
$imagePath = 'assets/uploads/intern/' . $row["intern_image"];
if (file_exists($imagePath)) {
    $pdf->Image($imagePath, 152, $pdf->GetY() + 2, 36, 36); // Position image inside the box
} else {
    die("Image not found: " . $imagePath);
}

// Set the position for the text inside the box (adjust y-position for centering)
$pdf->SetXY(150, $pdf->GetY() + 45); // Move text position below the image



$pdf->Ln(-10);

// For Office Use Section
$pdf->Cell(0, 4, '*Documents submitted', 0, 1);
$pdf->Cell(0, 4, '1. Internship request letter from college.', 0, 1);
$pdf->Cell(0, 4, '2. Photocopy of self-attested Id Proof-Adhaar card/College Id card.', 0, 1);


// Add a new page if needed
// $pdf->AddPage();

// Set the position for the line after the text
$y = $pdf->GetY(); // Get the current Y position after the text

// Continue with your other content
$pdf->Cell(0, 7, '**All documents are subject to verification with the original documents. Aadhaar card is mandatory.', 0, 1);

// Move down to the next line
$pdf->Ln(5); // You can adjust the value to set space between text and line

// Get the current Y position again after the space
$y = $pdf->GetY();

// Draw the line from (x1, y1) to (x2, y2)
$pdf->Line(7, $y, 200, $y);

$pdf->Ln(1);
$pdf->SetFont('Arial', 'U', 9);
$pdf->Cell(0, 7, 'For Office Use', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0, 7, 'Documents submitted: ', 0, 1);
// Aadhaar Card
$pdf->Cell(10, 7, 'O', 0, 0); // Simulated radio button (Aadhaar)
$pdf->Cell(30, 7, 'Letter From College', 0, 0);

// Add spacing between Aadhaar and PAN
$pdf->Cell(10);

// PAN Card
$pdf->Cell(10, 7, 'O', 0, 0); // Simulated radio button (PAN)
$pdf->Cell(30, 7, 'Govt.ID Proof', 0, 0);

// Add spacing between PAN and Driving License
$pdf->Cell(10);

// Driving Licence
$pdf->Cell(10, 7, 'O', 0, 0); // Simulated radio button (Driving License)
$pdf->Cell(30, 7, 'College ID Card', 0, 0);

// Add spacing between Driving License and Others
$pdf->Cell(10);
$pdf->Ln(5);
$pdf->Cell(0, 12, 'Date of Joining: __ __ / __ __ / __ __ __ __', 0, 1);
$pdf->Cell(0, 7, 'Time of Internship: AM / PM', 0, 1);
$pdf->Cell(0, 5, 'Intern Registration Number:', 0, 1);
$pdf->Cell(0, 14, 'Authorized Signature: ', 0, 1, 'R');
// $pdf->Ln(10);
// Add footer
// Add extra space
// Adjust the value to add more or less space as needed

// Display the "1" in the center
$pdf->Cell(0, 5, '1', 0, 1, 'C');

// Move the Y position slightly down to draw the line just below the "1"
$pdf->Ln(2); // Adjust this to add a bit of space if needed

// Draw the horizontal line immediately after the "1"
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Adjust the X coordinates if necessary

// Add a small space and then the footer text
$pdf->Ln(2); // Adjust space between the line and footer
$pdf->Cell(0, 1, 'WWW.TECHGEERING.COM', 0, 0, 'C');






// Specify the path to your image file
$imagePath = 'assets/img/head-img.jpg'; // Replace with the actual image path

// Add the image to the PDF
// Parameters: (image file path, x position, y position, width, height)
$pdf->Image($imagePath, 10, null, 190, 0, 'JPG'); // Adjust parameters as needed
$pdf->Ln(5);
// Terms of Internship Section
$pdf->SetFont('Arial', 'BU', size: 11);
$pdf->Cell(0, 7, 'Terms of Internship', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', '', size: 9);

// First point
$pdf->Cell(5, 5, '1.', 0, ln: 0);
$pdf->MultiCell(0, 5, 'INTERN have obtained for this internship program independently.', 0, 1);

// Second point
$pdf->Cell(5, 5, '2.', 0, 0);
$pdf->MultiCell(0, 5, 'Internship period will be of approximately 3 months.', 0, 1);

// Third point
$pdf->Cell(5, 5, '3.', 0, 0);
$pdf->MultiCell(0, 5, 'That the company reserves the right to either extend the internship period fro further months OR reduce itdepending on INTERN performance or for factors beyond the control of COMPANY.', 0, 1);

$pdf->Cell(5, 5, '4.', 0, 0);
$pdf->MultiCell(0, 5, 'The INTERN needs to submit an internship request letter from his/her college in college letterhead.', 0, 1);

$pdf->Cell(5, 5, '5.', 0, 0);
$pdf->MultiCell(0, 5, 'If internship request letter from the college is not available then the INTERN is required to submit his/her college
id card photocopy.', 0, 1);

$pdf->Cell(5, 5, '6.', 0, 0);
$pdf->MultiCell(0, 5, 'That the COMPANY shall monitor the performance of INTERN through periodical reviews and evaluations.', 0, 1);

$pdf->Cell(5, 5, '7.', 0, 0);
$pdf->MultiCell(0, 5, 'The working days will be from Monday to Saturday (third Saturday will be an off) from 09:30 AM to 06:30 PM.', 0, 1);

$pdf->Cell(5, 5, '8.', 0, 0);
$pdf->MultiCell(0, 5, 'Intern is need to prepare a project work on the program they are interning for.', 0, 1);

$pdf->Cell(5, 5, '9.', 0, 0);
$pdf->MultiCell(0, 5, 'That in case INTERN wilfully remains absent from duties or causes unwarranted circumstances that is detrimental
to company, it will be considered as breach of agreement by INTERN and the period of internship may be increased
and the fees of internship(charged if any) may also be increased.', 0, 1);

$pdf->Cell(5, 5, '10.', 0, 0);
$pdf->MultiCell(0, 5, 'That in case of any misconduct, non-performance, fraud, dishonesty, disobedience, disorderly behaviour,
negligence, indiscipline and breach of agreement, the COMPANY reserves the right to terminate the INATERNSHIP
with immediate effect. In such case the COMPANY may not issue internship certificate and is entitled to recover the
damages from INTERN.', 0, 1);

$pdf->Cell(5, 5, '11.', 0, 0);
$pdf->MultiCell(0, 5, 'That INTERN has to comply with all rules and regulations such as maintaining decorum, office timings, leave, and discipline, brought into practice by the COMPANY from time to time.', 0, 1);

$pdf->Cell(5, 5, '12.', 0, 0);
$pdf->MultiCell(0, 5, ' That INTERN shall treat all information related to COMPANYs project documents, technologies, polices, resource profile, etc. as CONFIDENTIAL.', 0, 1);

$pdf->Cell(5, 5, '13.', 0, 0);
$pdf->MultiCell(0, 5, 'INTERN will be responsible for safekeeping and return the COMPANYs property in good condition, which may be in INTERNs custody.', 0, 1);

$pdf->Cell(5, 5, '14.', 0, 0);
$pdf->MultiCell(0, 5, 'INTERN will receive a certificate of internship completion only after complete internship period and on satisfactory submission of project', 0, 1);

$pdf->Cell(5, 5, '15.', 0, 0);
$pdf->MultiCell(0, 5, 'INTERN will receive a certificate of internship completion only after complete payment (charged if any) clearance.', 0, 1);

$pdf->Cell(5, 5, '16.', 0, 0);
$pdf->MultiCell(0, 5, 'All payments done are non-refundable/non-transferable.', 0, 1);

$pdf->Cell(5, 5, '17.', 0, 0);
$pdf->MultiCell(0, 5, 'All payments done are subject to realisation.', 0, 1);

$pdf->Cell(5, 5, '18.', 0, 0);
$pdf->MultiCell(0, 5, 'This internship program do not guarantee any job assurance with the COMPANY.', 0, 1);

$pdf->Cell(5, 5, '19.', 0, 0);
$pdf->MultiCell(0, 5, 'Rights to alter or modify Terms of Internship is reserved by the COMPANY and the same shall be informed to INTERN from time to time.', 0, 1);

$pdf->Cell(5, 5, '20.', 0, 0);
$pdf->MultiCell(0, 5, 'All details provided and documents submitted by the INTERN are true. All documents are subject to verification with original documents. If found incompatible then INTERN may be disqualified or penalised for the same.', 0, 1);

$pdf->Cell(5, 5, '21.', 0, 0);
$pdf->MultiCell(0, 5, 'If INTERN violets any of the Terms then he/she may be disqualified or penalised for the same.', 0, 1);

$pdf->Cell(5, 5, '22.', 0, 0);
$pdf->MultiCell(0, 5, 'All disputes arising from this agreement will be settled under Bhubaneswar jurisdiction.', 0, 1);

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10); // Bold only for the company name
$pdf->Cell(0, 2, 'I accept', 0, 1);

$pdf->Ln(5);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'Intern Full Signature', 0, 1);


$pdf->SetY(-30);
$pdf->SetFont('Arial', 'I', 9);

// Set text color to deep blue (RGB: 0, 0, 139)
$pdf->SetTextColor(0, 0, 0);
// Add footer content
// Add a cell
$pdf->Cell(0, 5, '2', 0, 1, 'C');

// Set the position for the line
$pdf->SetY($pdf->GetY()); // Make sure the line starts where the last cell ends

// Draw a horizontal line
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Adjust the X coordinates as needed

$pdf->Cell(0, 4, 'WWW.TECHGEERING.COM', 0, 0, 'C');


// Output the PDF
$pdf->Output('intern_enrollment_form.pdf', 'I');
?>