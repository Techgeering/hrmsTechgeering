<?php
include "../common/conn.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Function to handle file uploads
    function handleFileUpload($fieldName, $uploadDir)
    {
        $name = $_POST["name"];
        global $conn;
        $image_name = $_FILES[$fieldName]['name'];
        $image_size = $_FILES[$fieldName]['size'];
        $image_tmp = $_FILES[$fieldName]['tmp_name'];
        $file_type = pathinfo($image_name, PATHINFO_EXTENSION);
        // $new_file_name = uniqid() . '.' . $file_type;
        $new_file_name = $name . '.' . $file_type;


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

    // File upload directory for images
    $upload_dir = "../assets/uploads/intern/";

    // Handle image upload
    $new_file_name1 = handleFileUpload('imagess', $upload_dir);
    $name = $_POST["name"];

    // Handle PDF upload if exists
    if (isset($_FILES['doc'])) {
        $pdf1File = $_FILES['doc'];
        $pdf1FileName = $pdf1File['name'];
        $pdf1FileTmp = $pdf1File['tmp_name'];

        if ($pdf1FileName) {
            $pdf1FileType = pathinfo($pdf1FileName, PATHINFO_EXTENSION);
            $pdf1NewFileName = $name . '.' . $pdf1FileType;
            $pdf1UploadDir = "../assets/uploads/intern/";

            // Ensure upload directory for PDFs exists
            if (!is_dir($pdf1UploadDir)) {
                mkdir($pdf1UploadDir, 0777, true);
            }

            $pdf1TargetFile = $pdf1UploadDir . $pdf1NewFileName;

            // Move the PDF file to the directory
            move_uploaded_file($pdf1FileTmp, $pdf1TargetFile);
        }
    }

    // Get form data
    $name = $_POST["name"];
    $fathername = $_POST["fathername"];
    $address = htmlspecialchars($_POST["address"]);
    $emailid = $_POST["emailid"];
    $startdate = $_POST["startdt1"];
    $clgname = htmlspecialchars($_POST["clgname"]);
    $gender = $_POST["gender"];
    $mobilenumber = $_POST["mobilenumber"];
    $mothername = $_POST["mothername"];
    $idtype = $_POST["idtype"];
    $dob = $_POST["dob"];
    $currntedu = htmlspecialchars($_POST["currntedu"]);
    // $internship = $_POST["internship"];
    if (isset($_POST['internship'])) {
        $internship = implode(',', $_POST['internship']);  // Join the selected internships with commas
    } else {
        $internship = '';
    }
    $govtid = $_POST["govtid"];
    $clgid = $_POST["clgid"];

    $sql = "INSERT INTO internship (intern_name, father_name, intern_add, intern_email, start_date, clg_name, gender, phone, mother_name, id_type, dob, edu_qualification, internship_on, valid_govt_no, college_id, intern_image, intern_doc) 
            VALUES ('$name','$fathername','$address','$emailid','$startdate','$clgname','$gender','$mobilenumber','$mothername','$idtype','$dob','$currntedu','$internship','$govtid','$clgid','$new_file_name1','$pdf1NewFileName')";

    if ($conn->query($sql) === true) {
        // Validate inputs
        if (!empty($name) && filter_var($emailid, FILTER_VALIDATE_EMAIL)) {
            // Prepare the email message
            $message = "
        <p>Dear $name,</p>
        <p>You have successfully submitted.</p>
        ";

            // Send email using smtp_mailer function
            if (smtp_mailer($emailid, 'Submission Confirmation', $message)) {
                $response['status'] = 'success';
                $response['message'] = 'Email sent successfully';
            } else {
                $response['message'] = 'Failed to send email';
            }
        } else {
            $response['message'] = 'Invalid name or email';
        }
        // echo "<script>window.location.href='internship.php';</script>";
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
function smtp_mailer($to, $subject, $msg, $file_path = null)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Disable verbose debug output
        $mail->isSMTP();                                         // Send using SMTP
        $mail->Host = 'smtp.gmail.com';                          // Set the SMTP server to send through
        $mail->SMTPAuth = true;                                  // Enable SMTP authentication
        $mail->Username = 'dmonalisa949@gmail.com';              // Your Gmail Id
        $mail->Password = 'hsad ivab ppak rdll';                 // Your App password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable implicit TLS encryption
        $mail->Port = 465;                                       // TCP port to connect to

        //Recipients
        $mail->setFrom('dmonalisa949@gmail.com', 'Techgeering Solutions Pvt Ltd');
        $mail->addAddress($to);                                  // Add a recipient
        $mail->addReplyTo('dmonalisa949@gmail.com', 'Techgeering Solutions Pvt Ltd');

        //Attachments
        if ($file_path) {
            $mail->addAttachment($file_path, basename($file_path)); // Add attachments
        }

        //Content
        $mail->isHTML(true);                                     // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $msg;

        $mail->send();
        return true;  // Return true if email is sent successfully
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;  // Return false if email fails
    }
}
?>