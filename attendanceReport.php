<?php
session_start(); {
    $em_role = $_SESSION["em_role"];
    $emp_id = $_SESSION["emp_id"];
}
?>

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
    <link href="assets/css/styles.css?v=<?php echo time(); ?>" rel="stylesheet" />
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
                                        <th>Adjustable Hour</th>
                                        <th>Payable Hour</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'common/conn.php';
                                    if ($em_role == '4' || $em_role == '2' || $em_role == '5') {
                                        $sql4 = "SELECT ar.*, e.full_name 
                                                FROM attadence_report ar
                                                JOIN employee e ON ar.emp_id = e.em_code WHERE ar.emp_id = '$emp_id' ORDER BY month DESC";
                                    } else {
                                        $sql4 = "SELECT ar.*, e.full_name 
                                                FROM attadence_report ar
                                                JOIN employee e ON ar.emp_id = e.em_code ORDER BY month DESC";
                                    }
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
                                                <td>
                                                    <?php if ($em_role == '1' || $em_role == '3') { ?>
                                                        <p class="edit"><?php echo $row4["adj_hour"]; ?></p>
                                                        <input type="text" class='txtedit' value='<?php echo $row4["adj_hour"]; ?>'
                                                            id='adj_hour-<?php echo $row4["id"]; ?>-attadence_report'
                                                            style="display:none;"></input>
                                                    <?php } else { ?>
                                                        <h6 class="form-control form-control-line">
                                                            <?php echo !empty($row4["adj_hour"]) ? $row4["adj_hour"] : "N/A"; ?>
                                                        <?php } ?>
                                                    </h6>
                                                </td>
                                                <td><?php echo $row4["payable_hour"]; ?></td>
                                                <td> <a onclick="confirmDelete(<?php echo $row['id']; ?>, tb='attadence_report', tbc='id',returnpage='attendanceReport.php');"
                                                        title="Delete">
                                                        <i class="fa-solid fa fa-trash text-danger" aria-hidden="true"></i>
                                                    </a>
                                                </td>
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
                                    document.write('<option value="' + (currentYear - 1) + '">' + (currentYear - 1) +
                                        '</option>');
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
                            const endDate =
                                `${year}-${month}-${lastDayOfMonth < 10 ? '0' + lastDayOfMonth : lastDayOfMonth}`;
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
                }
            }

            return $totalHours;
        }

        $year = $_POST["year"];
        $month = $_POST["month"];
        $monthYear = $month . "-" . $year;
        $WorkingHour = calculateTotalWorkingHours($year, $month);

        $sdate = DateTime::createFromFormat('Y-m-d', $_POST["startdate4"]);
        $edate = DateTime::createFromFormat('Y-m-d', $_POST["enddate4"]);

        $startDate = $sdate->format('Y-m-d');
        $endDate = $edate->format('Y-m-d');

        // Query for total holiday hours
        $sql6 = "SELECT SUM(number_of_holiday_hour) AS totalHolidayHour
             FROM holiday
             WHERE from_date BETWEEN '$startDate' AND '$endDate'";
        $result6 = $conn->query($sql6);
        $row6 = $result6->fetch_assoc();
        $totalHolidayHours = $row6["totalHolidayHour"] ?? 0;

        // Query for total working hours for each employee
        $sql5 = "SELECT emp_id, SUM(working_hour) AS total_working_hours
             FROM attendance
             WHERE atten_date BETWEEN '$startDate' AND '$endDate'
             GROUP BY emp_id";
        $result5 = $conn->query($sql5);

        if ($result5->num_rows > 0) {
            while ($row5 = $result5->fetch_assoc()) {
                $empid = $row5["emp_id"];
                $presentHour = $row5["total_working_hours"] ?? 0;

                // Query for total leave hours
                $sql7 = "SELECT SUM(duration_hour) AS totalLeaveDuration 
                     FROM emp_leave 
                     WHERE start_date BETWEEN '$startDate' AND '$endDate' 
                     AND leave_status = 1 
                     AND em_id = '$empid'";
                $result7 = $conn->query($sql7);
                $row7 = $result7->fetch_assoc();
                $totalLeaveDuration = $row7["totalLeaveDuration"] ?? 0;

                $payableHour = $presentHour + $totalHolidayHours + $totalLeaveDuration;

                // Check if record already exists in attadence_report
                $sql1 = "SELECT month, emp_id 
                     FROM attadence_report 
                     WHERE month = '$monthYear' AND emp_id = '$empid'";
                $result1 = $conn->query($sql1);

                if ($result1->num_rows === 0) {
                    // Insert new record
                    $sql = "INSERT INTO attadence_report (month, emp_id, working_hour, present_hour, holiday_hour, leave_hour, payable_hour,adj_hour)
                        VALUES ('$monthYear', '$empid', '$WorkingHour', '$presentHour', '$totalHolidayHours', '$totalLeaveDuration', '$payableHour','0')";
                } else {
                    // Update existing record
                    $sql = "UPDATE attadence_report 
                        SET working_hour = '$WorkingHour', present_hour = '$presentHour', holiday_hour = '$totalHolidayHours', leave_hour = '$totalLeaveDuration', payable_hour = '$payableHour'
                        WHERE month = '$monthYear' AND emp_id = '$empid'";
                }

                // Execute query
                if ($conn->query($sql) === TRUE) {
                    echo "Record processed successfully for emp_id: $empid";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        $conn->close();
    }
    ?>


    <!-- <p><?php //echo $row5["emp_id"] . " " . $row5["total_working_hours"]; ?></p> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.edit', function () {
                var txtEdit = $(this).next('.txtedit');
                var editText = $(this);
                txtEdit.show().focus();
                editText.hide();
                txtEdit.focusout(function () {
                    var field_name = txtEdit.attr('id').split("-")[0];
                    var edit_id = txtEdit.attr('id').split("-")[1];
                    var table_name = txtEdit.attr('id').split("-")[2];
                    var value = txtEdit.val();
                    console.log("Field:", field_name, "ID:", edit_id, "Table:", table_name,
                        "Value:", value);
                    if (value !== null && value.trim() !== '') {
                        var pattern = txtEdit.attr('pattern');
                        if (pattern) {
                            var regex = new RegExp(pattern);
                            if (!regex.test(value)) {
                                alert('Invalid pattern. Please enter a valid value.');
                                return;
                            }
                        }
                    }
                    editText.show();
                    editText.text(value);
                    txtEdit.hide();
                    $.ajax({
                        url: 'insert_attendance.php',
                        type: 'post',
                        data: {
                            field: field_name,
                            value: value,
                            id: edit_id,
                            tbnm: table_name
                        },
                        success: function (response) {
                            console.log("AJAX response:", response);
                            if (response == 1) {
                                console.log('Save Successfully');
                            } else {
                                console.log('Not Saved');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("AJAX error:", status, error);
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>