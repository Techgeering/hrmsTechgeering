<?php
include "common/conn.php";
if (isset($_POST['emp_id'])) {
    $emp_id = $_POST['emp_id'];

    $sql = "SELECT * FROM earnings WHERE emp_id = '$emp_id' AND status = '1'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total = $row['basic'] + $row['house_rent'] + $row['medical'] + $row['travel'] + $row['perform_bonus'];
        $epf = ($total / 100) * 12;
        $grosstotalearning = $total * 12;

        $sql_leave = "SELECT * FROM attadence_report WHERE emp_id = '$emp_id'";
        $result_leave = $conn->query($sql_leave);

        if ($result_leave->num_rows > 0) {
            $row_leave = $result_leave->fetch_assoc();
            $total_working_hour = $row_leave["working_hour"];
            $payable_hour = $row_leave["payable_hour"];
            $total_earning = $total / $total_working_hour;
            $deduction_other = $total_earning * $payable_hour;
            $other1 = $deduction_other - $total_working_hour;
            $other = number_format($other1, 2);

            // Prepare the table data
            $tableData = '<tr>
            <td>' . $row['basic'] . '</td>
            <td>' . $row['house_rent'] . '</td>
            <td>' . $row['medical'] . '</td>
            <td>' . $row['travel'] . '</td>
            <td>' . $row['perform_bonus'] . '</td>
            <td>' . $total . '</td>
            <td>' . $grosstotalearning . '</td>
            </tr>';

            $response = array(
                'tableData' => $tableData,
                'basic' => $row['basic'],
                'house_rent' => $row['house_rent'],
                'medical' => $row['medical'],
                'travel' => $row['travel'],
                'perform_bonus' => $row['perform_bonus'],
                'ptax' => 0,
                'total' => $total,
                'annual' => $grosstotalearning,
                'epf' => $epf,
                'other' => $other,
                'empid' => $emp_id,

            );

            // Get the current month
            $currentMonth = date('n'); // 'n' returns the numeric representation of a month without leading zeros (1 through 12)
            // Set Professional Tax value based on $grosstotalearning
            if ($grosstotalearning > 300000) {
                $response['ptax'] = 0; // No tax
            } elseif ($grosstotalearning > 160000) {
                $response['ptax'] = 125; // Tax value
            } elseif ($currentMonth == 12) {
                $response['ptax'] = 300; // December specific tax value
            } else {
                $response['ptax'] = 200; // Default tax value for other cases
            }


            echo json_encode($response);
        } else {
            // If no data found
            $tableData = '<tr>
    <td colspan="6">No earnings data found for this employee.</td>
</tr>';

            $response = array(
                'tableData' => $tableData,
                'basic' => '',
                'house_rent' => '',
                'medical' => '',
                'travel' => '',
                'perform_bonus' => '',
                'total' => '',
                'annual' => '',
                'epf' => '',
                'other' => '',
                'empid' => ''
            );
            echo json_encode($response);
        }
    }
}
?>