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
            $total_working_hour = $row_leave["working_hour"];//total working hour monthly
            $payable_hour = $row_leave["payable_hour"];//payable_hour monthly
            $deduction_hour = $total_working_hour - $payable_hour;//deduction_hour 
            $hourly_cost = $total / $total_working_hour;//hourly_cost
            $other1 = $deduction_hour * $hourly_cost;
            $other = number_format($other1, 2);
            $other = str_replace(',', '', $other);



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
                'total_deduction' => 0,
                'annual' => $grosstotalearning,
                'epf' => $epf,
                'tds' => 0,
                'other' => $other,
                'empid' => $emp_id,

            );

            // Get the current month
            $currentMonth = date('n'); // 'n' returns the numeric representation of a month without leading zeros (1 through 12)
            // Set Professional Tax value based on $grosstotalearning
            if ($grosstotalearning >= 160000 && $grosstotalearning <= 300000) {
                $response['ptax'] = 125; // No tax
                $response['total_deduction'] = $epf + $other + 125;
                // $response['ptax'] = $response['total_deduction'];

            } elseif ($grosstotalearning > 300000) {
                if ($currentMonth == 12) {
                    $response['ptax'] = 300; // December specific tax value
                    $response['total_deduction'] = $epf + $other + 300;
                } else {
                    $response['ptax'] = 200; // Default tax value for other cases
                    $response['total_deduction'] = $epf + $other + 200;
                }
            } else {
                $response['ptax'] = 0; // Tax value
                $response['total_deduction'] = $epf + $other;
            }
            $response['netpay'] = $total - $response['total_deduction'];

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
                'total_deduction' => '',
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