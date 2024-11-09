 <?php
// $servername = "localhost";
// // $username = "root";
// // $password = "";
// // $dbname = "hems";

// $username = "u728233529_hrmstechg";
// $password = "Prasim@1963";
// $dbname = "Prasim@1963";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// 
?>
<?php
// Database connection details
$host = "localhost";
$user = "u728233529_hrmstechg";
$pass = "Prasim@1963";
$db = "u728233529_hrmstechg";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle file upload and processing
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file']['tmp_name'];
    
    if (($handle = fopen($file, "r")) !== FALSE) {
        $entries = [];

        // Skip header row
        fgetcsv($handle);

        while (($data = fgetcsv($handle)) !== FALSE) {
            $biometric_id = $data[2]; // Assuming biometric ID is in the 3rd column (index 2)
            $datetime = $data[9]; // Assuming date & time is in the 10th column (index 9)
            
            // Convert date and time to separate variables
            $date = date('Y-m-d', strtotime($datetime));
            $time = date('H:i:s', strtotime($datetime));

            // Fetch employee ID using biometric ID
            $query = $conn->prepare("SELECT em_code FROM employee WHERE biomatricid = ?");
            $query->bind_param("s", $biometric_id);
            $query->execute();
            $result = $query->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $employee_id = $row['em_code'];

                // Store entries by employee ID and date
                if (!isset($entries[$employee_id][$date])) {
                    $entries[$employee_id][$date] = ['in' => $time, 'out' => $time];
                } else {
                    if ($time < $entries[$employee_id][$date]['in']) {
                        $entries[$employee_id][$date]['in'] = $time;
                    }
                    if ($time > $entries[$employee_id][$date]['out']) {
                        $entries[$employee_id][$date]['out'] = $time;
                    }
                }
            }
        }
        fclose($handle);

        // Prepare output CSV
        $output_file = 'attendance_summary.csv';
        $output_handle = fopen($output_file, 'w');
        fputcsv($output_handle, ['Employee ID', 'Date', 'In Time', 'Out Time']);

        foreach ($entries as $employee_id => $dates) {
            foreach ($dates as $date => $times) {
                fputcsv($output_handle, [$employee_id, $date, $times['in'], $times['out']]);
            }
        }
        fclose($output_handle);

        // Force download of the generated file
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $output_file . '"');
        readfile($output_file);

        // Clean up
        unlink($output_file);
        exit;
    } else {
        echo "Failed to open file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Attendance CSV</title>
</head>
<body>
    <h2>Upload Attendance CSV File</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept=".csv" required>
        <button type="submit">Upload and Process</button>
    </form>
</body>
</html>
