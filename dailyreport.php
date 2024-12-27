<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Employee Details - Hrms Techgeering</title>
    <link rel="icon" type="image/png" href="assets/img/favicon-t.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css?v=<?php echo time(); ?>" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 10px 12px;
            transition: 0.3s;
            font-size: 15px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
            animation: fadeEffect 1s;
        }

        /* Go from zero to full opacity */
        @keyframes fadeEffect {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <!-- start Top Navbar -->
    <?php include 'common/topnav.php' ?>
    <?php
    include "common/conn.php";
    $sql10 = "SELECT * FROM employee WHERE id=$userid";
    $result10 = $conn->query($sql10);
    if ($result10->num_rows > 0) {
        $row10 = $result10->fetch_assoc();
        $name = $row10["full_name"];
        $dept = $row["dep_id"];
        $em_code = $row["em_code"];
    }
    ?>
    <!-- end Top Navbar -->
    <div id="layoutSidenav">
        <!-- start Side Navbar -->
        <?php include 'common/sidenav.php' ?>
        <!-- end Side Navbar -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="my-2">Daily Report</h2>
                    </div>
                    <div class="tab profile ">
                        <button class="tablinks" onclick="openDilog(event, 'Daily')" id="defaultOpen"> Daily</button>
                        <button class="tablinks" onclick="openDilog(event, 'Weekly')" id="defaultOpen"> Weekly</button>
                        <button class="tablinks" onclick="openDilog(event, 'Monthly')"> Monthly </button>
                        <button class="tablinks" onclick="openDilog(event, 'Quarterly')"> Quarterly </button>
                    </div>
                    <div id="Daily" class="tabcontent">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                            <i class="fa-solid fa-plus"></i> Daily Report
                        </button>
                        <div class="card p-2 m-2">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Emp Name</th>
                                        <th>Date</th>
                                        <th>Project Name</th>
                                        <th>Details Of Work</th>
                                        <th>Duration</th>
                                        <th>Edit</th>
                                        <th>Work Details</th>
                                        <th>Pdf</th>
                                    </tr>
                                </thead>
                                <tbody id="reportTableBody">
                                    <?php
                                    include "common/conn.php";
                                    if ($em_role == '4' || $em_role == '2' || $em_role == '5') {
                                        $sql = "SELECT * FROM daily_report WHERE emp_id = '$em_code' ORDER BY date21 DESC";
                                    } else {
                                        $sql = "SELECT * FROM daily_report ORDER BY date21 DESC";
                                    }
                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    $today = date('Y-m-d');
                                    $yesterday = date('Y-m-d', strtotime('-1 day'));

                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row['id'];
                                            ?>
                                            <tr>
                                                <td><?php echo $slno; ?></td>
                                                <td>
                                                    <?php
                                                    $emp_id = $row["emp_id"];
                                                    $sql1 = "SELECT * FROM employee WHERE em_code = '$emp_id'";
                                                    $result1 = $conn->query($sql1);
                                                    $row1 = $result1->fetch_assoc();
                                                    echo htmlspecialchars($row1["full_name"], ENT_QUOTES, 'UTF-8');
                                                    ?>
                                                </td>
                                                <td><?php echo $row["date21"]; ?></td>
                                                <td>
                                                    <?php
                                                    $pro_id = $row["pro_id"];
                                                    if ($pro_id == 0) {
                                                        echo "Other";
                                                    } else {
                                                        $sql12 = "SELECT * FROM project WHERE id = $pro_id";
                                                        $result12 = $conn->query($sql12);

                                                        if ($result12 && $result12->num_rows > 0) {
                                                            $row12 = $result12->fetch_assoc();
                                                            echo htmlspecialchars($row12["pro_name"], ENT_QUOTES, 'UTF-8');
                                                        } else {
                                                            echo "Project not found";
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#paragraphmodal_<?php echo $id; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                                <td><?php echo $row["duration"]; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-light" onclick="myfcn12(
                                                    <?php echo $row['id']; ?>,
                                                            '<?php echo addslashes($row['pro_id']); ?>',
                                                            '<?php echo addslashes(htmlspecialchars_decode($row['work_details'])); ?>',
                                                            '<?php echo $row['duration']; ?>',
                                                            '<?php echo $row['date21']; ?>'
                                                        )" data-bs-toggle="modal" data-bs-target="#updateDept">
                                                        <i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <a href="dayinvoice.php?id=<?php echo $row["emp_id"]; ?>&&date=<?php echo $row["date21"]; ?>"
                                                        target="_blank">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="dayinvoice.php?id=<?php echo $row["emp_id"]; ?>&&date=<?php echo $row["date21"]; ?>&&status=1"
                                                        target="_blank">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="paragraphmodal_<?php echo $id; ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-success text-white">
                                                            <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php echo nl2br($row["work_details"]); ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $slno++;
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    $conn->close();
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Emp Name</th>
                                        <th>Date</th>
                                        <th>Project Name</th>
                                        <th>Details Of Work</th>
                                        <th>Duration</th>
                                        <th>Edit</th>
                                        <th>Work Details</th>
                                        <th>Pdf</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div id="Weekly" class="tabcontent">
                        <div class="card p-2 m-2">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl No</th>
                                        <th class="text-center">Employee Id</th>
                                        <th class="text-center">Employee Name</th>
                                        <th class="text-center">Project Name</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Pdf</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    // Get the start (Monday) and end (Saturday) of the previous week
                                    $lastWeekStart = (new DateTime('last week'))->modify('monday')->format('Y-m-d');
                                    $lastWeekEnd = (new DateTime('last week'))->modify('saturday')->format('Y-m-d');

                                    if ($em_role == '4' || $em_role == '2' || $em_role == '5') {
                                        $sql3 = "SELECT * FROM daily_report 
                                                WHERE emp_id = '$em_code' 
                                                AND DATE(date21) BETWEEN '$lastWeekStart' AND '$lastWeekEnd' GROUP BY emp_id";

                                    } else {
                                        $sql3 = "SELECT * FROM daily_report 
                                            WHERE DATE(date21) BETWEEN '$lastWeekStart' AND '$lastWeekEnd' GROUP BY emp_id";
                                    }

                                    $result3 = $conn->query($sql3);
                                    $slno = 1;

                                    if ($result3 && $result3->num_rows > 0) {
                                        while ($row3 = $result3->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $slno; ?></td>
                                                <td class="text-center">
                                                    <?php echo $row3["emp_id"]; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    $emp_id = $row3["emp_id"];
                                                    $sql1 = "SELECT * FROM employee WHERE em_code = '$emp_id'";
                                                    $result1 = $conn->query($sql1);
                                                    $row1 = $result1->fetch_assoc();
                                                    echo htmlspecialchars($row1["full_name"], ENT_QUOTES, 'UTF-8');
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    $pro_id = $row3["pro_id"];
                                                    if ($pro_id == 0) {
                                                        echo "Other";
                                                    } else {
                                                        $sql12 = "SELECT * FROM project WHERE id = $pro_id";
                                                        $result12 = $conn->query($sql12);

                                                        if ($result12 && $result12->num_rows > 0) {
                                                            $row12 = $result12->fetch_assoc();
                                                            echo htmlspecialchars($row12["pro_name"], ENT_QUOTES, 'UTF-8');
                                                        } else {
                                                            echo "Project not found";
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row3["date21"]; ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="weeklyinvoice.php?id=<?php echo $row3["emp_id"]; ?>&&startday=<?php echo $lastWeekStart; ?>&&endday=<?php echo $lastWeekEnd; ?>"
                                                        target="_blank">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                            $slno++;
                                        }
                                    } else {
                                        echo "No records found.";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="Monthly" class="tabcontent">
                        <div class="card p-2 m-2">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl No</th>
                                        <th class="text-center">Emp Id</th>
                                        <th class="text-center">Emp Name</th>
                                        <th class="text-center">Month/Year</th>
                                        <th class="text-center">Pdf</th>
                                    </tr>
                                </thead>
                                <tbody id="reportTableBody">
                                    <?php
                                    include "common/conn.php";
                                    $previousMonthStart = (new DateTime('first day of last month'))->format('Y-m-d');
                                    $previousMonthEnd = (new DateTime('last day of last month'))->format('Y-m-d');

                                    if ($em_role == '4' || $em_role == '2' || $em_role == '5') {
                                        $sql31 = "SELECT * FROM daily_report 
                                                WHERE emp_id = '$em_code' 
                                                AND DATE(date21) BETWEEN '$previousMonthStart' AND '$previousMonthEnd' 
                                                GROUP BY emp_id";
                                    } else {
                                        $sql31 = "SELECT * FROM daily_report 
                                            WHERE DATE(date21) BETWEEN '$previousMonthStart' AND '$previousMonthEnd' GROUP BY emp_id";
                                    }

                                    $result31 = $conn->query($sql31);
                                    $slno = 1;

                                    if ($result31 && $result31->num_rows > 0) {
                                        while ($row31 = $result31->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $slno; ?></td>
                                                <td class="text-center">
                                                    <?php echo $row31["emp_id"]; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    $emp_id = $row31["emp_id"];
                                                    $sql1 = "SELECT * FROM employee WHERE em_code = '$emp_id'";
                                                    $result1 = $conn->query($sql1);
                                                    $row1 = $result1->fetch_assoc();
                                                    echo htmlspecialchars($row1["full_name"], ENT_QUOTES, 'UTF-8');
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo date("F Y", strtotime($row31["date21"])); ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="monthlyinvoice.php?id=<?php echo $row31["emp_id"]; ?>&&startdate=<?php echo $previousMonthStart; ?>&&enddate=<?php echo $previousMonthEnd; ?>"
                                                        target="_blank">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                            $slno++;
                                        }
                                    } else {
                                        echo "No records found.";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">Sl No</th>
                                        <th class="text-center">Emp Id</th>
                                        <th class="text-center">Emp Name</th>
                                        <th class="text-center">Month/Year</th>
                                        <th class="text-center">Pdf</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div id="Quarterly" class="tabcontent">
                        <div class="card p-2 m-2">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl No</th>
                                        <th class="text-center">Emp Id</th>
                                        <th class="text-center">Emp Name</th>
                                        <th class="text-center">Month/Year</th>
                                        <th class="text-center">Pdf</th>
                                    </tr>
                                </thead>
                                <tbody id="reportTableBody">
                                    <?php
                                    // Get the current date
                                    $currentDate = new DateTime();

                                    // Extract the current year and month
                                    $currentYear = (int) $currentDate->format('Y');
                                    $currentMonth = (int) $currentDate->format('m');

                                    // Determine the quarter based on the current month
                                    if ($currentMonth >= 1 && $currentMonth <= 3) {
                                        // Current quarter: Q1 (Jan-Mar), so previous quarter is Q4 of the previous year
                                        $startDate = new DateTime(($currentYear - 1) . '-10-01');
                                        $endDate = new DateTime(($currentYear - 1) . '-12-31');
                                    } elseif ($currentMonth >= 4 && $currentMonth <= 6) {
                                        // Current quarter: Q2 (Apr-Jun), so previous quarter is Q1
                                        $startDate = new DateTime($currentYear . '-01-01');
                                        $endDate = new DateTime($currentYear . '-03-31');
                                    } elseif ($currentMonth >= 7 && $currentMonth <= 9) {
                                        // Current quarter: Q3 (Jul-Sep), so previous quarter is Q2
                                        $startDate = new DateTime($currentYear . '-04-01');
                                        $endDate = new DateTime($currentYear . '-06-30');
                                    } else {
                                        // Current quarter: Q4 (Oct-Dec), so previous quarter is Q3
                                        $startDate = new DateTime($currentYear . '-07-01');
                                        $endDate = new DateTime($currentYear . '-09-30');
                                    }
                                    $startDate = $startDate->format('Y-m-d');
                                    $endDate = $endDate->format('Y-m-d');

                                    include "common/conn.php";
                                    $previousMonthStart = (new DateTime('first day of last month'))->format('Y-m-d');
                                    $previousMonthEnd = (new DateTime('last day of last month'))->format('Y-m-d');

                                    if ($em_role == '4' || $em_role == '2' || $em_role == '5') {
                                        $sql33 = "
                                                SELECT * 
                                                FROM daily_report 
                                                WHERE emp_id = '$em_code' 
                                                AND date21 BETWEEN '$startDate' AND '$endDate' 
                                                GROUP BY emp_id";

                                    } else {
                                        $sql33 = "SELECT * FROM daily_report 
                                            WHERE DATE(date21) BETWEEN '$startDate' AND '$endDate' GROUP BY emp_id";
                                    }

                                    $result33 = $conn->query($sql33);
                                    $slno = 1;

                                    if ($result33 && $result33->num_rows > 0) {
                                        while ($row33 = $result33->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $slno; ?></td>
                                                <td class="text-center">
                                                    <?php echo $row33["emp_id"]; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    $emp_id = $row33["emp_id"];
                                                    $sql1 = "SELECT * FROM employee WHERE em_code = '$emp_id'";
                                                    $result1 = $conn->query($sql1);
                                                    $row1 = $result1->fetch_assoc();
                                                    echo htmlspecialchars($row1["full_name"], ENT_QUOTES, 'UTF-8');
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    $date = strtotime($row33["date21"]);
                                                    $month = date("n", $date); // Get the numeric month (1-12)
                                                    $year = date("Y", $date); // Get the year
                                            
                                                    // Determine the quarter based on the month
                                                    if ($month >= 1 && $month <= 3) {
                                                        $quarterText = "4th Qtr(Jan-Mar)";
                                                    } elseif ($month >= 4 && $month <= 6) {
                                                        $quarterText = "1st Qtr(Apr-Jun)";
                                                    } elseif ($month >= 7 && $month <= 9) {
                                                        $quarterText = "2nd Qtr(Jul-Sep)";
                                                    } else {
                                                        $quarterText = "3rd Qtr(Oct-Dec)";
                                                    }
                                                    echo $quarterText . " " . $year;
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="quarterlyinvoice.php?id=<?php echo $row33["emp_id"]; ?>&&startdt=<?php echo $startDate; ?>&&enddt=<?php echo $endDate; ?>"
                                                        target="_blank">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                            $slno++;
                                        }
                                    } else {
                                        echo "No records found.";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">Sl No</th>
                                        <th class="text-center">Emp Id</th>
                                        <th class="text-center">Emp Name</th>
                                        <th class="text-center">Month/Year</th>
                                        <th class="text-center">Pdf</th>
                                    </tr>
                                </tfoot>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Daily Report</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="datee" class="form-label">Date</label>
                                <input type="date" class="form-control" id="datee" name="datee1" required>
                            </div>
                            <div id="form-container">
                                <div class="product-group11">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- <div class="mb-2">
                                                <label for="Project_Name" class="form-label">Project Name</label>
                                                <input type="text" id="projectInput" class="form-control"
                                                    placeholder="Enter project name...." autocomplete="off" required>
                                                <div id="projectSuggestions" class="dropdown-menu"
                                                    style="display: none; max-height: 200px; overflow-y: auto; border: 1px solid #ccc; position: absolute; z-index: 1000;">
                                                </div>
                                               
                                                <input type="hidden" id="projectId" name="project_name[]">
                                            </div> -->
                                            <div class="mb-2">
                                                <label for="Project_Name" class="form-label">Project Name</label>
                                                <input type="text" id="projectInput" class="form-control"
                                                    placeholder="Enter project name...." autocomplete="off" required>
                                                <div id="projectSuggestions" class="dropdown-menu"
                                                    style="display: none; max-height: 200px; overflow-y: auto; border: 1px solid #ccc; position: absolute; z-index: 1000;">
                                                </div>
                                                <input type="hidden" id="projectId" name="project_name[]">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="DepartmentName">Work Details</label>
                                            <textarea class="form-control" id="workk" name="workk1[]" rows="4"
                                                required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="duration">Duration (HH:MM)</label>
                                            <input type="text" class="form-control duration-input" name="duration[]"
                                                pattern="^([0-9]|[01][0-9]|2[0-3]):([0-5][0-9])$" required>
                                            <small class="form-text text-muted">Format: HH:MM (e.g., 02:30 for 2 hours
                                                and 30
                                                minutes)</small>
                                            <div class="error-message" style="color: red; display: none;">The total
                                                duration cannot
                                                exceed 8 hours (480 minutes).</div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-danger remove-product">-</button>
                                        <button type="button" class="btn btn-success add-product">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <?php
    include "common/conn.php";
    if (isset($_POST['submit'])) {
        $employee_names = $_POST['employee_name'];
        $datee1s = $_POST["datee1"];
        $project_names = $_POST["project_name"];
        $workks = $_POST["workk1"];
        $durations = $_POST["duration"];
        $em_codes = $em_code;
        foreach ($project_names as $index => $project_name) {
            $employee_name = $employee_names;
            $datee1 = $datee1s;
            $em_code = $em_codes;

            $workk = mysqli_real_escape_string($conn, $workks[$index]);
            $duration = mysqli_real_escape_string($conn, $durations[$index]);

            $sql_daily = "SELECT * FROM daily_report WHERE pro_id = '$project_name' AND date21 = '$datee1' AND emp_id = '$em_code'";
            $result = $conn->query($sql_daily);
            if ($result->num_rows > 0) {
                echo "<script>alert('This project is already present on this date. Please update it instead.');</script>";
            } else {
                $sql_pur = "INSERT INTO daily_report (emp_id, date21, pro_id, work_details, duration) 
                VALUES ('$em_code','$datee1','$project_name','$workk','$duration')";
                if ($conn->query($sql_pur) === TRUE) {
                    // header("Location: dailyreport.php");
                    echo "<script>
                        alert('Success');
                        window.location.href = 'dailyreport.php';
                      </script>";
                } else {
                    echo "Error: " . $sql_pur . "<br>" . $conn->error;
                }
            }
        }
        $conn->close();
    }
    ?>
    <!-- update modal -->
    <div class="modal fade" id="updateDept" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Update Daily Report</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <input type="hidden" name="id12" id="id12">
                        <input type="hidden" name="datet" id="datet">
                        <div class="col-12">
                            <div class="mb-2">
                                <label for="Project_Name" class="form-label">Project Name</label>
                                <select class="form-select" name="project_name" id="pro_nm">
                                    <option value="" disabled selected>Select a Project</option>
                                    <option value="0">Other</option>
                                    <?php
                                    include "common/conn.php";
                                    $sql_pro = "SELECT * FROM project";
                                    $result_pro = $conn->query($sql_pro);
                                    while ($row_pro = $result_pro->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row_pro['id']; ?>">
                                            <?php echo $row_pro['pro_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="DepartmentName">Work Details</label>
                                <textarea class="form-control" id="workk_details" name="workk1" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="duration">Duration (HH:MM)</label>
                                <input type="text" class="form-control duration-input" name="duration"
                                    id="clock_duration" pattern="^([0-9]|[01][0-9]|2[0-3]):([0-5][0-9])$" required>
                                <small class="form-text text-muted">Format: HH:MM (e.g., 02:30 for 2 hours
                                    and
                                    30 minutes)</small>
                                <div class="error-message" style="color: red; display: none;">The total
                                    duration
                                    cannot exceed 8 hours (480 minutes).</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="updatedepartment">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['updatedepartment'])) {
        include "common/conn.php";
        $project_name = htmlspecialchars($_POST["project_name"]);
        $workk1 = htmlspecialchars($_POST["workk1"]);
        $duration = $_POST["duration"];
        $datew = $_POST["datet"];
        $id = $_POST["id12"];
        if ($duration < 0) {
            echo "<script>alert('Duration must be a positive number.');</script>";
            exit;
        }
        $sql_total_hours = "SELECT SUM(duration) AS total_hours FROM daily_report WHERE emp_id='$em_code' AND date21='$datew'";
        $result_hours = $conn->query($sql_total_hours);

        if ($result_hours && $row = $result_hours->fetch_assoc()) {
            $total_hours = $row['total_hours'] ? $row['total_hours'] : 0;
            $sql_current_duration = "SELECT duration FROM daily_report WHERE id='$id'";
            $result_current = $conn->query($sql_current_duration);
            $current_duration = 0;

            if ($result_current && $row_current = $result_current->fetch_assoc()) {
                $current_duration = $row_current['duration'];
            }
            $new_total_hours = $total_hours - $current_duration + $duration;
            if ($new_total_hours > 8) {
                echo "<script>alert('Cannot log more than 8 hours for this date. Total hours logged: $new_total_hours hours.');</script>";
            } else {
                $sql1 = "UPDATE daily_report SET pro_id='$project_name', work_details='$workk1', duration='$duration' WHERE id='$id'";
                if ($conn->query($sql1) === true) {
                    echo "<script>alert('Update successful');</script>";
                } else {
                    echo "Error: " . $conn->error;
                }
            }
        } else {
            echo "<script>alert('Error fetching total hours.');</script>";
        }

        $conn->close();
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function openDilog(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
        document.getElementById("defaultOpen").click();
    </script>
    <!-- all for daily report -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const formContainer = document.getElementById('form-container');

            // Function to attach suggestion functionality
            function attachProjectInputEvents(inputField) {
                const suggestionsContainer = inputField.parentElement.querySelector('#projectSuggestions');

                inputField.addEventListener('input', function () {
                    const selectedProject = this.value;
                    if (selectedProject) {
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', 'get_projects.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                        xhr.onload = function () {
                            if (xhr.status === 200) {
                                const projects = JSON.parse(xhr.responseText);
                                suggestionsContainer.innerHTML = ''; // Clear previous suggestions

                                // Add "Other" as a static option
                                const otherItem = document.createElement('div');
                                otherItem.textContent = 'Other';
                                otherItem.className = 'dropdown-item';
                                otherItem.style.cursor = 'pointer';

                                // Set project ID to 0 when "Other" is selected
                                otherItem.addEventListener('click', function () {
                                    inputField.value = 'Other';
                                    inputField.parentElement.querySelector('#projectId').value = 0; // Static ID for "Other"
                                    suggestionsContainer.style.display = 'none'; // Hide suggestions
                                });

                                suggestionsContainer.appendChild(otherItem);

                                // Append dynamic suggestions
                                if (projects.length > 0) {
                                    projects.forEach(project => {
                                        const suggestionItem = document.createElement('div');
                                        suggestionItem.textContent = project.pro_name; // Adjust according to your data
                                        suggestionItem.className = 'dropdown-item';
                                        suggestionItem.style.cursor = 'pointer';

                                        // When a suggestion is clicked
                                        suggestionItem.addEventListener('click', function () {
                                            inputField.value = project.pro_name;
                                            inputField.parentElement.querySelector('#projectId').value = project.id; // Store project ID
                                            suggestionsContainer.style.display = 'none'; // Hide suggestions
                                        });

                                        suggestionsContainer.appendChild(suggestionItem);
                                    });
                                }

                                suggestionsContainer.style.display = 'block'; // Show suggestions
                            }
                        };
                        xhr.send('pro_name=' + encodeURIComponent(selectedProject));
                    } else {
                        suggestionsContainer.style.display = 'none'; // Hide if input is empty
                    }
                });

                // Hide suggestions when clicking outside
                document.addEventListener('click', function (e) {
                    if (!inputField.contains(e.target) && !suggestionsContainer.contains(e.target)) {
                        suggestionsContainer.style.display = 'none';
                    }
                });
            }

            // Attach event listeners to existing project input fields
            formContainer.querySelectorAll('#projectInput').forEach(attachProjectInputEvents);

            // Add new project field
            formContainer.addEventListener('click', function (event) {
                if (event.target.classList.contains('add-product')) {
                    event.preventDefault();

                    // Clone the product group
                    const newProductGroup = formContainer.querySelector('.product-group11').cloneNode(true);

                    // Clear the input fields in the new clone
                    newProductGroup.querySelector('#projectInput').value = '';
                    newProductGroup.querySelector('#projectId').value = '';
                    newProductGroup.querySelector('#workk').value = '';
                    newProductGroup.querySelector('.duration-input').value = '';

                    // Append the new clone to the form container
                    formContainer.appendChild(newProductGroup);

                    // Attach event listeners to the new input field
                    attachProjectInputEvents(newProductGroup.querySelector('#projectInput'));
                }
            });

            // Remove project field
            formContainer.addEventListener('click', function (event) {
                if (event.target.classList.contains('remove-product')) {
                    event.preventDefault();

                    // Only remove if there is more than one product group
                    const productGroups = formContainer.querySelectorAll('.product-group11');
                    if (productGroups.length > 1) {
                        event.target.closest('.product-group11').remove();
                    }
                }
            });
        });
    </script>

    <!-- for date disable -->
    <script>
        const today = new Date().toISOString().split("T")[0];
        document.getElementById("datee").setAttribute("min", today);
    </script>
    <script>
        function parseDuration(duration) {
            const parts = duration.split(':');
            return parseInt(parts[0], 10) * 60 + parseInt(parts[1], 10); // Convert to total minutes
        }
        function totalDurationExceeded() {
            const durationInputs = document.querySelectorAll('.duration-input');
            let totalMinutes = 0;

            durationInputs.forEach(input => {
                if (input.value) {
                    totalMinutes += parseDuration(input.value);
                }
            });
            return totalMinutes > 480; // 480 minutes equals 8 hours
        }
        document.addEventListener('input', function () {
            const errorMessage = document.querySelector('.error-message');
            if (totalDurationExceeded()) {
                errorMessage.style.display = 'block'; // Show error message
            } else {
                errorMessage.style.display = 'none'; // Hide error message
            }
        });
    </script>

</body>

</html>