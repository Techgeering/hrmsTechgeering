<?php
include 'common/conn.php';

$id = $_GET['id'];
$name = $_GET['name'];

if ($name == 'inactive') {
    $status = '0';
    $column = 'status1';
} elseif ($name == '1') {
    $status = '2';
    $column = 'status';
} elseif ($name == '2') {
    $status = '3';
    $column = 'status';
} elseif ($name == '3') {
    $status = '4';
    $column = 'status';
} else {
    echo "<script>alert('Invalid status')</script>";
    exit();
}
// Set the default timezone to Indian Standard Time (IST)
date_default_timezone_set('Asia/Kolkata');

if ($name == 'inactive') {
    // Get today's date based on Indian time
    $today = date('d'); // Get the day of the month (1-31)
    $month = date('m'); // Get the current month
    $year = date('Y'); // Get the current year

    // Calculate next month
    $nextMonth = $month + 1;
    $nextYear = $year;

    // Adjust year and month if the current month is December
    if ($nextMonth > 12) {
        $nextMonth = 1;
        $nextYear += 1;
    }

    // Determine the next follow-up date based on ranges
    if ($today <= 10) {
        $nextFollowUpDate = "$nextYear-" . str_pad($nextMonth, 2, '0', STR_PAD_LEFT) . "-10 12:00:00";
    } elseif ($today <= 20) {
        $nextFollowUpDate = "$nextYear-" . str_pad($nextMonth, 2, '0', STR_PAD_LEFT) . "-20 12:00:00";
    } else {
        // Default to the next month's last range
        $nextFollowUpDate = "$nextYear-" . str_pad($nextMonth, 2, '0', STR_PAD_LEFT) . "-31 12:00:00";
        // Ensure the day exists in the next month (e.g., February might not have 31 days)
        $timestamp = strtotime($nextFollowUpDate);
        $nextFollowUpDate = date('Y-m-d 12:00:00', $timestamp);
    }

    // Update the leads table
    $sqlUpdate = "UPDATE leads SET $column='$status', nextfollowupdate='$nextFollowUpDate' WHERE id='$id'";
    if ($conn->query($sqlUpdate) === true) {
        // Prepare data for lead_follow table
        $startdate = date('Y-m-d H:i:s'); // Current date and time
        $message = "Next follow-up scheduled at 12:00:00"; // Include explicit time in the message

        // Insert into lead_follow table
        $sqlInsert = "INSERT INTO lead_follow (lead_id, start_date, next_date, message)
                      VALUES ('$id', '$startdate', '$nextFollowUpDate', '$message')";
        if ($conn->query($sqlInsert) === true) {
            echo "<script>alert('Success'); window.location.href='leads.php';</script>";
        } else {
            echo "Error inserting into lead_follow: " . $conn->error;
        }
    } else {
        echo "Error updating leads: " . $conn->error;
    }
} else {
    $sql = "UPDATE leads SET $column='$status' WHERE id='$id'";
    if ($conn->query($sql) === true) {
        echo "<script>alert('success'); window.location.href='leads.php';</script>";
    } else {
        echo $conn->error;
    }
}
?>