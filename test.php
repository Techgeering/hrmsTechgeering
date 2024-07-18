<?php
include "common/conn.php";
    $sql7 ="SELECT  SUM(leave_duration) AS totalLeaveDuration
                FROM emp_leave
                WHERE start_date BETWEEN '01-06-2024' AND '30-06-2024' AND em_id=123456";
    $result7 = $conn->query($sql7);
    $row7 = $result7->fetch_assoc();
    $totalLeaveDuration = $row7["totalLeaveDuration"];


            ?>
            <p>gjgjgjg: <?php echo $totalLeaveDuration; ?></p>
            <?php
       
?>