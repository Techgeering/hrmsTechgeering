<?php
include "common/conn.php";

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$period = isset($_GET['period']) ? $_GET['period'] : '';

if (!$period) {
    echo "<tr><td colspan='8'>Invalid period provided</td></tr>";
    exit;
}

$today = date('Y-m-d');
$query = "";

switch ($period) {
    case 'weekly':
        // Get the starting (Monday) and ending (Sunday) of the previous week
        $startOfLastWeek = date('Y-m-d', strtotime('last week monday'));
        $endOfLastWeek = date('Y-m-d', strtotime('last week sunday'));
        $query = "SELECT * FROM daily_report WHERE date21 BETWEEN ? AND ? ORDER BY date21 DESC";
        break;

    case 'monthly':
        // Get the first and last day of the previous month
        $firstDayOfLastMonth = date('Y-m-01', strtotime('first day of last month'));
        $lastDayOfLastMonth = date('Y-m-t', strtotime('last day of last month'));
        $query = "SELECT * FROM daily_report WHERE date21 BETWEEN ? AND ? ORDER BY date21 DESC";
        break;

    case 'quarterly':
        // Get the last 3 full months
        $firstDayOfThreeMonthsAgo = date('Y-m-01', strtotime('first day of -3 months'));
        $lastDayOfLastMonth = date('Y-m-t', strtotime('last day of last month'));
        $query = "SELECT * FROM daily_report WHERE date21 BETWEEN ? AND ? ORDER BY date21 DESC";
        break;

    default:
        echo "<tr><td colspan='8'>Invalid period</td></tr>";
        exit;
}

// Prepare the statement
$stmt = $conn->prepare($query);

// Bind parameters based on the selected period
if ($period === 'weekly') {
    $stmt->bind_param('ss', $startOfLastWeek, $endOfLastWeek);
} elseif ($period === 'monthly') {
    $stmt->bind_param('ss', $firstDayOfLastMonth, $lastDayOfLastMonth);
} elseif ($period === 'quarterly') {
    $stmt->bind_param('ss', $firstDayOfThreeMonthsAgo, $lastDayOfLastMonth);
}

// Execute the statement
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $slno = 1;
    while ($row = $result->fetch_assoc()) {
        // Fetch employee details
        $emp_id = $row["emp_id"];
        $sql1 = "SELECT full_name FROM employee WHERE em_code = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $emp_id);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        $row1 = $result1->fetch_assoc();
        $emp_name = htmlspecialchars($row1["full_name"], ENT_QUOTES, 'UTF-8');

        // Fetch project details
        $pro_id = $row["pro_id"];
        $sql12 = "SELECT pro_name FROM project WHERE id = ?";
        $stmt12 = $conn->prepare($sql12);
        $stmt12->bind_param('i', $pro_id);
        $stmt12->execute();
        $result12 = $stmt12->get_result();
        $row12 = $result12->fetch_assoc();
        $pro_name = htmlspecialchars($row12["pro_name"], ENT_QUOTES, 'UTF-8');

        echo "
        <tr>
            <td>{$slno}</td>
            <td>{$emp_name}</td>
            <td>{$row['date21']}</td>
            <td>{$pro_name}</td>
            <td>{$row['work_details']}</td>
            <td>{$row['duration']}</td>
            <td>
                <button type='button' class='btn btn-light' onclick='myfcn12({$row['id']}, \"{$row['pro_id']}\", \"{$row['work_details']}\", \"{$row['duration']}\", \"{$row['date21']}\")' data-bs-toggle='modal' data-bs-target='#updateDept'>
                    <i class='fa-solid fa-pen-to-square me-2 ms-2 text-primary'></i>
                </button>
            </td>
            <td>
                <a href='dayinvoice.php?id={$row['emp_id']}&date={$row['date21']}' target='_blank'>
                    <i class='fas fa-file-pdf'></i>
                </a>
            </td>
        </tr>
        ";
        $slno++;
    }
} else {
    echo "<tr><td colspan='8'>No results found</td></tr>";
}

// Close statements and connection
$stmt->close();
$conn->close();
?>