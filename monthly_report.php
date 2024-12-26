<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Daily Report - Hrms Techgeering</title>
    <link rel="icon" type="image/png" href="assets/img/favicon-t.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css?v=1.2" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
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
                        <h2 class="my-2">Monthly Report</h2>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl No</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Employee Id</th>
                                        <th class="text-center">Employee Name</th>
                                        <th class="text-center">Project Name</th>
                                        <th class="text-center">Duration</th>
                                    </tr>
                                </thead>
                                <tbody id="reportTableBody">
                                    <?php
                                    include "common/conn.php";
                                    $date = new DateTime();
                                    $date->modify('first day of this month');
                                    $firstDayOfPreviousMonth = $date->modify('first day of last month')->format('Y-m-d');
                                    $lastDayOfPreviousMonth = (new DateTime($firstDayOfPreviousMonth))->modify('last day of this month')->format('Y-m-d');

                                    // Modified SQL query to get the total duration per project
                                    // $sql = "SELECT pro_id, DATE_FORMAT(date21, '%M %Y') AS month_year, 
                                    //         DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(duration))), '%H:%i') AS total_duration AND emp_id
                                    //         FROM daily_report
                                    //         WHERE date21 >= '$firstDayOfPreviousMonth' AND date21 <= '$lastDayOfPreviousMonth'
                                    //         GROUP BY pro_id
                                    //         ORDER BY pro_id DESC";
                                    $sql = "SELECT pro_id, 
                                            DATE_FORMAT(date21, '%M %Y') AS month_year, 
                                            DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(duration))), '%H:%i') AS total_duration, 
                                            emp_id
                                        FROM daily_report
                                        WHERE date21 >= '$firstDayOfPreviousMonth' AND date21 <= '$lastDayOfPreviousMonth'
                                        GROUP BY pro_id, emp_id
                                        ORDER BY pro_id DESC";

                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $monthYear = $row["month_year"];
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $slno; ?></td>
                                                <td class="text-center"><?php echo $monthYear; ?></td>
                                                <td class="text-center"><?php echo $row["emp_id"]; ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    $emp_id = $row["emp_id"];
                                                    $sql1 = "SELECT * FROM employee WHERE em_code = '$emp_id'";
                                                    $result1 = $conn->query($sql1);
                                                    $row1 = $result1->fetch_assoc();
                                                    echo htmlspecialchars($row1["full_name"], ENT_QUOTES, 'UTF-8');
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    $pro_id = $row["pro_id"];
                                                    if ($pro_id == 0) {
                                                        echo "Other";
                                                    } else {
                                                        // Fetch project name
                                                        $sql12 = "SELECT pro_name FROM project WHERE id = $pro_id";
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
                                                <td class="text-center"><?php echo $row["total_duration"]; ?></td>
                                                <!-- Display total duration per project -->
                                            </tr>
                                            <?php
                                            $slno++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='3'>0 results</td></tr>"; // Adjust for table structure
                                    }
                                    $conn->close();
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">Sl No</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Employee Id</th>
                                        <th class="text-center">Employee Name</th>
                                        <th class="text-center">Project Name</th>
                                        <th class="text-center">Duration</th>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
</body>

</html>