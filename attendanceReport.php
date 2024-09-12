<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Attendance Report - Hrms Techgeering</title>
    <link rel="icon" type="image/png" href="assets/img/favicon-t.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- start Top Navbar -->
    <?php include 'common/topnav.php' ?>
    <!-- end Top Navbar -->
    <div id="layoutSidenav">
        <!-- start Side Navbar -->
        <?php include 'common/sidenav.php' ?>
        <!-- end Side Navbar -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="my-2">Attendance Report</h2>
                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                            <i class="fa-solid fa-plus"></i> Attendance Report
                        </button>
                        <?php } ?>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Month</th>
                                        <th>Emp Id</th>
                                        <th>Emp Name</th>
                                        <th>Working Hour</th>
                                        <th>Present Hour</th>
                                        <th>Holiday Hour</th>
                                        <th>Leave Hour</th>
                                        <th>Payable Hour</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'common/conn.php';
                                    $sql4 = "SELECT ar.*, e.full_name 
                                                FROM attadence_report ar
                                                JOIN employee e ON ar.emp_id = e.em_code";
                                    $result4 = $conn->query($sql4);

                                    if ($result4->num_rows > 0) {
                                        $slNo = 1;
                                        while ($row4 = $result4->fetch_assoc()) {
                                            ?>
                                    <tr>
                                        <td><?php echo $slNo; ?></td>
                                        <td><?php echo $row4["month"]; ?></td>
                                        <td><?php echo $row4["emp_id"]; ?></td>
                                        <td><?php echo $row4["full_name"]; ?></td>
                                        <td><?php echo $row4["working_hour"]; ?></td>
                                        <td><?php echo $row4["present_hour"]; ?></td>
                                        <td><?php echo $row4["holiday_hour"]; ?></td>
                                        <td><?php echo $row4["leave_hour"]; ?></td>
                                        <td><?php echo $row4["payable_hour"]; ?></td>
                                    </tr>
                                    <?php
                                            $slNo++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>0 results</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'common/copyrightfooter.php' ?>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addDept" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="modal-body">
        <div class="form-group d-flex">
            <select class="form-control m-2" name="month" id="month">
                <option value="" disabled selected>Month</option>
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
            <select class="form-control m-2" name="year" id="year">
                <script>
                    const currentYear = new Date().getFullYear();
                    document.write('<option value="' + currentYear + '">' + currentYear + '</option>');
                    document.write('<option value="' + (currentYear - 1) + '">' + (currentYear - 1) + '</option>');
                </script>
            </select>
            <input type="hidden" name="startdate4" id="startdate4" placeholder="Start Date">
            <input type="hidden" name="enddate4" id="enddate4" placeholder="End Date">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </div>
</form>

<script>
    document.getElementById('month').addEventListener('change', updateDates);
    document.getElementById('year').addEventListener('change', updateDates);

    function updateDates() {
        const month = document.getElementById('month').value;
        const year = document.getElementById('year').value;
        
        if (month && year) {
            const startDate = `${year}-${month}-01`;
            document.getElementById('startdate4').value = startDate;

            const lastDayOfMonth = new Date(year, month, 0).getDate();
            const endDate = `${year}-${month}-${lastDayOfMonth < 10 ? '0' + lastDayOfMonth : lastDayOfMonth}`;
            document.getElementById('enddate4').value = endDate;
        }
    }
</script>

            </div>
        </div>
    </div>
    <?php
    include "common/conn.php";
    if (isset($_POST['submit'])) {
        // $sql8 = "DELETE FROM attadence_report WHERE month ='$monthYear' ";
        // if ($conn->query($sql8) === TRUE) {
        //     } else {
        //         echo "Error: " . $sql . "<br>" . $conn->error;
        //     }

        function calculateTotalWorkingHours($year, $month)
            {
                $totalHours = 0;
                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
                    $dayOfWeek = date('N', strtotime($date)); // 1 (for Monday) through 7 (for Sunday)
        
                    if ($dayOfWeek >= 1 && $dayOfWeek <= 5) {
                        // Monday to Friday
                        $totalHours += 9;
                    } elseif ($dayOfWeek == 6) {
                        // Saturday
                        $totalHours += 5;
                    } else {
                        // Sunday
                        $totalHours += 0;
                    }
                }

                return $totalHours;
            }

        $year = $_POST["year"];
        $month = $_POST["month"];
        $WorkingHour = calculateTotalWorkingHours($year, $month);


        $sdate = DateTime::createFromFormat('Y-m-d', $_POST["startdate4"]);
        $edate = DateTime::createFromFormat('Y-m-d', $_POST["enddate4"]);
        
        $startDate =  $sdate->format('Y-m-d');
        $endDate =  $edate->format('Y-m-d');      


        include "common/conn.php";
        $sql6 = "SELECT  SUM(number_of_holiday_hour) AS totalHolidayHour
                FROM holiday
                WHERE from_date BETWEEN '$startDate' AND '$endDate' ";
        $result6 = $conn->query($sql6);
        $row6 = $result6->fetch_assoc();
        $totalHolidayHours = $row6["totalHolidayHour"];

        $sql5 = "SELECT  emp_id, SUM(working_hour) AS total_working_hours
                FROM attendance
                WHERE atten_date BETWEEN '$startDate' AND '$endDate'
                GROUP BY emp_id";
        $result5 = $conn->query($sql5);


        if ($result5->num_rows > 0) {
            $slNo = 1;
            while ($row5 = $result5->fetch_assoc()) {
                $empid = $row5["emp_id"];
                $presentHour = $row5["total_working_hours"];
                include "common/conn.php";
                $sql7 = "SELECT SUM(duration_hour) AS totalLeaveDuration FROM emp_leave WHERE start_date BETWEEN '$startDate' AND '$endDate' AND leave_status=1 AND em_id='$empid'";
                
                $result7 = $conn->query($sql7);
                $row7 = $result7->fetch_assoc();
                $totalLeaveDuration = $row7["totalLeaveDuration"];

                $payableHour = $presentHour + $totalHolidayHours + $totalLeaveDuration;
                    $sql = "INSERT INTO attadence_report (month,emp_id, working_hour, present_hour,holiday_hour,leave_hour,payable_hour)
                        VALUES ('$monthYear','$empid', '$WorkingHour', '$presentHour', '$totalHolidayHours', '$totalLeaveDuration', '$payableHour')";
                        if ($conn->query($sql) === TRUE) {
                            echo "New record created successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                $conn->close();
            }
            $conn->close();
        }
        $conn->close();
    }
    ?>
    <!-- <p><?php //echo $row5["emp_id"] . " " . $row5["total_working_hours"]; ?></p> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>

</html>