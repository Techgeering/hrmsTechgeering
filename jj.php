<?php
$enddate = $rowpur["ser_end_dt"]; // Correctly fetch the end date
$today = date('Y-m-d');

if ($today > $enddate) { // Use $enddate instead of $end_date
    $status = 0; // Expired
} else {
    $status = 1; // Not expired
}

// Display the status message
if ($status === 0) {
    echo "Expired";
} else {
    echo "Not Expired";
}
?>