<?php
include "common/conn.php";

$sql10 = "ALTER TABLE `earnings` ADD COLUMN `date_of_earnings` VARCHAR(20) NULL AFTER `id";

// Execute the SQL query
if ($conn->query($sql10) === TRUE) {
    echo "Column 'date_of_earnings' added successfully to the earnings table";
} else {
    echo "Error adding column 'date_of_earnings' to the earnings table: " . $conn->error;
}

$conn->close();