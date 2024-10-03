<?php
include "common/conn.php";

if (isset($_POST['emp_id'])) {
    $emp_id = $_POST['emp_id'];

    $sql = "SELECT * FROM earnings WHERE emp_id = '$emp_id' AND status = '1'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total = $row['basic'] + $row['house_rent'] + $row['medical'] + $row['travel'] + $row['perform_bonus'];
        echo '<tr>
                <td>' . $row['basic'] . '</td>
                <td>' . $row['house_rent'] . '</td>
                <td>' . $row['medical'] . '</td>
                <td>' . $row['travel'] . '</td>
                <td>' . $row['perform_bonus'] . '</td>
                <td>' . $total . '</td>
              </tr>';
    } else {
        echo '<tr><td colspan="5">No earnings data found for this employee.</td></tr>';
    }
}
?>