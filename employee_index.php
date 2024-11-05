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
    <title>Dashboard - Hrms Techgeering</title>
    <link rel="icon" type="image/png" href="assets/img/favicon-t.png">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css?v=<?php echo time(); ?>" rel="stylesheet" />
    <link href="assets/css/style1.css?v=<?php echo time(); ?>" rel="stylesheet" />
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
        <!-- start body content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="my-2">Dashboard</h1>
                    <div class="page-wrapper mdc-toolbar-fixed-adjust">
                        <main class="content-wrapper">
                            <div class="mdc-layout-grid">
                                <div class="mdc-layout-grid__inner">
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                                        <div class="mdc-card info-card info-card--success">
                                            <div class="card-inner">
                                                <h5 class="card-title">Total Projects</h5>
                                                <h5 class="font-weight-light pb-2 mb-1 border-bottom">
                                                    <?php
                                                    include "common/conn.php";
                                                    if ($conn) {
                                                        $query = "SELECT COUNT(*) as rowCount FROM project ";
                                                        $result = mysqli_query($conn, $query);
                                                        if ($result) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            echo isset($row['rowCount']) ? $row['rowCount'] : 0;
                                                        } else {
                                                            echo "Error executing query: " . mysqli_error($conn);
                                                        }

                                                        mysqli_close($conn);
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?>
                                                </h5>
                                                <p class="tx-12 text-muted">
                                                    <?php
                                                    include "common/conn.php";
                                                    if ($conn) {
                                                        $sql = "SELECT COUNT(DISTINCT p.id) AS completedProjectCount
                                                                FROM assign_task AS a
                                                                JOIN project AS p ON a.project_id = p.id
                                                                WHERE a.assign_user = '$emp_id'
                                                                AND a.user_type = 'Collaborators'
                                                                AND p.pro_status = 'complete'
                                                            ";
                                                        $result = $conn->query($sql);

                                                        if ($result && $result->num_rows > 0) {
                                                            $row = $result->fetch_assoc();
                                                            echo $row['completedProjectCount'] . " Completed";
                                                        } else {
                                                            echo "No assigned projects found.";
                                                        }
                                                        $conn->close();
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?>
                                                </p>
                                                <div class="card-icon-wrapper">
                                                    <i class="material-icons"><i class="fa fa-list-alt text-white fs-2"
                                                            aria-hidden="true"></i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                                        <div class="mdc-card info-card info-card--danger">
                                            <div class="card-inner">
                                                <h5 class="card-title">Ongoing & Hold</h5>
                                                <h5 class="font-weight-light pb-2 mb-1 border-bottom">
                                                    <?php
                                                    include "common/conn.php";
                                                    if ($conn) {
                                                        $query = "SELECT COUNT(*) as rowCount FROM project WHERE pro_status IN ('running', 'hold')";
                                                        $result = mysqli_query($conn, $query);
                                                        if ($result) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            echo isset($row['rowCount']) ? $row['rowCount'] : 0;
                                                        } else {
                                                            echo "Error executing query: " . mysqli_error($conn);
                                                        }
                                                        mysqli_close($conn);
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?>
                                                </h5>
                                                <p class="tx-12 text-muted">
                                                    <?php
                                                    include "common/conn.php";
                                                    if ($conn) {
                                                        $sql = "SELECT COUNT(DISTINCT p.id) AS holdProjectCount
                                                                FROM assign_task AS a
                                                                JOIN project AS p ON a.project_id = p.id
                                                                WHERE a.assign_user = '$emp_id'
                                                                AND a.user_type = 'Collaborators'
                                                                AND p.pro_status = 'hold'
                                                            ";
                                                        $result = $conn->query($sql);

                                                        if ($result && $result->num_rows > 0) {
                                                            $row = $result->fetch_assoc();
                                                            echo $row['holdProjectCount'];
                                                        } else {
                                                            echo "No assigned projects found.";
                                                        }
                                                        $conn->close();
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?> Hold
                                                </p>
                                                <div class="card-icon-wrapper">
                                                    <i class="material-icons"><i class="fa fa-usd text-white fs-2"
                                                            aria-hidden="true"></i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                                        <div class="mdc-card info-card info-card--primary">
                                            <div class="card-inner">
                                                <h5 class="card-title">Total Holidays</h5>
                                                <h5 class="font-weight-light pb-2 mb-1 border-bottom">
                                                    <?php
                                                    include "common/conn.php";
                                                    if ($conn) {
                                                        $query = "SELECT SUM(number_of_days) as totalDays FROM holiday";
                                                        $result = mysqli_query($conn, $query);
                                                        if ($result) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            echo isset($row['totalDays']) ? $row['totalDays'] : 0;
                                                        } else {
                                                            echo "Error executing query: " . mysqli_error($conn);
                                                        }
                                                        mysqli_close($conn);
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?>
                                                </h5>
                                                <p class="tx-12 text-muted">
                                                    <a href="holiday.php" class="text-muted">Go to Holiday Page</a>
                                                </p>
                                                <div class="card-icon-wrapper">
                                                    <i class="material-icons"><i
                                                            class="fa fa-line-chart text-white fs-2"
                                                            aria-hidden="true"></i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                                        <div class="mdc-card info-card info-card--info">
                                            <div class="card-inner">
                                                <h5 class="card-title">Total Leave Days</h5>
                                                <h5 class="font-weight-light pb-2 mb-1 border-bottom">
                                                    <?php
                                                    include "common/conn.php";
                                                    if ($conn) {
                                                        $query = "SELECT SUM(leave_day) as totalDays FROM leave_types";
                                                        $result = mysqli_query($conn, $query);
                                                        if ($result) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            echo isset($row['totalDays']) ? $row['totalDays'] : 0;
                                                        } else {
                                                            echo "Error executing query: " . mysqli_error($conn);
                                                        }
                                                        mysqli_close($conn);
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?>
                                                </h5>
                                                <p class="tx-12 text-muted">
                                                    <a href="leaveType.php" class="text-muted">Go to Leavetype Page</a>
                                                </p>
                                                <div class="card-icon-wrapper">
                                                    <i class="material-icons"><i class="fa fa-briefcase text-white fs-2"
                                                            aria-hidden="true"></i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                                        <div class="mdc-card info-card info-card--info">
                                            <div class="card-inner">
                                                <h5 class="card-title">Taken Leave</h5>
                                                <h5 class="font-weight-light pb-2 mb-1 border-bottom">
                                                    <?php
                                                    include "common/conn.php";
                                                    if ($conn) {
                                                        // Prepare the SQL query to sum taken leaves
                                                        $sqlTakenLeave = "SELECT SUM(leave_duration) AS taken_leave FROM emp_leave WHERE em_id = '$emp_id' AND leave_status = 1";

                                                        // Execute the query
                                                        $resultTakenLeave = $conn->query($sqlTakenLeave);
                                                        if ($resultTakenLeave) {
                                                            if ($resultTakenLeave->num_rows > 0) {
                                                                $rowTakenLeave = $resultTakenLeave->fetch_assoc();
                                                                $takenLeave = $rowTakenLeave["taken_leave"] ?? 0;
                                                            } else {
                                                                $takenLeave = 0;
                                                            }
                                                            echo $takenLeave;
                                                        } else {
                                                            echo "Error executing query: " . $conn->error;
                                                        }
                                                        mysqli_close($conn);
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?>
                                                </h5>
                                                <p class="tx-12 text-muted">
                                                    <?php
                                                    include "common/conn.php"; // Include the database connection file
                                                    
                                                    if ($conn) {
                                                        // Query to sum total leaves from leave_types table
                                                        $sqlTotalLeave = "SELECT SUM(leave_day) AS total_leave FROM leave_types";
                                                        $resultTotalLeave = $conn->query($sqlTotalLeave);

                                                        if ($resultTotalLeave) {
                                                            $rowTotalLeave = $resultTotalLeave->fetch_assoc();
                                                            $totalLeave = $rowTotalLeave["total_leave"] ?? 0; // Use total_leave as per alias in the query
                                                    
                                                            // Query to sum taken leaves for the specific employee
                                                            $sqlTakenLeave = "SELECT SUM(leave_duration) AS taken_leave FROM emp_leave WHERE em_id = '$emp_id' AND leave_status = 1";
                                                            $resultTakenLeave = $conn->query($sqlTakenLeave);

                                                            if ($resultTakenLeave) {
                                                                $rowTakenLeave = $resultTakenLeave->fetch_assoc();
                                                                $takenLeave = $rowTakenLeave["taken_leave"] ?? 0;

                                                                // Calculate remaining leaves
                                                                $remaining = $totalLeave - $takenLeave;
                                                                // echo $remaining;
                                                                echo "Rest Leave:$remaining";
                                                            } else {
                                                                echo "Error executing query for taken leaves: " . $conn->error;
                                                            }
                                                        } else {
                                                            echo "Error executing query for total leaves: " . $conn->error;
                                                        }

                                                        // Close the database connection
                                                        mysqli_close($conn);
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?>

                                                </p>
                                                <div class="card-icon-wrapper">
                                                    <i class="material-icons"><i class="fa fa-briefcase text-white fs-2"
                                                            aria-hidden="true">

                                                        </i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                                        <div class="mdc-card info-card info-card--primary">
                                            <div class="card-inner">
                                                <h5 class="card-title">Total Hour</h5>
                                                <h5 class="font-weight-light pb-2 mb-1 border-bottom">
                                                    <?php
                                                    include "common/conn.php";
                                                    $currentDate = new DateTime();

                                                    // Modify the date to go back one month
                                                    $currentDate->modify('-1 month');

                                                    // Get previous month and year
                                                    $previousMonth = $currentDate->format('m'); // Format as '01' to '12'
                                                    $previousYear = $currentDate->format('Y');  // Format as 'YYYY'
                                                    
                                                    if ($conn) {
                                                        $query = "SELECT working_hour FROM attadence_report where month = '$previousMonth-$previousYear'"; // Fetch the last balance
                                                        $result = mysqli_query($conn, $query);
                                                        if ($result) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            $workingHour = $row['working_hour'] ?? 0;

                                                            // Display the working hour
                                                            echo number_format($workingHour); // Format with 2 decimal places and thousands separator
                                                        } else {
                                                            echo "Error executing query: " . mysqli_error($conn);
                                                        }
                                                        mysqli_close($conn);
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?>
                                                </h5>
                                                <p class="tx-12 text-muted">
                                                    <?php
                                                    include "common/conn.php";
                                                    $currentDate = new DateTime();
                                                    // Modify the date to go back one month
                                                    $currentDate->modify('-1 month');
                                                    // Get previous month and year
                                                    $previousMonth = $currentDate->format('m'); // Format as '01' to '12'
                                                    $previousYear = $currentDate->format('Y');  // Format as 'YYYY'
                                                    if ($conn) {
                                                        $query = "SELECT payable_hour FROM attadence_report WHERE emp_id = '$emp_id' AND month = '$previousMonth-$previousYear'"; // Fetch the last balance
                                                        $result = mysqli_query($conn, $query);
                                                        if ($result) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            $payable_hour = $row['payable_hour'] ?? 0;
                                                            echo "Payable Hour:$payable_hour";
                                                        } else {
                                                            echo "Error executing query: " . mysqli_error($conn);
                                                        }
                                                        mysqli_close($conn);
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?>
                                                </p>
                                                <div class="card-icon-wrapper">
                                                    <i class="material-icons"><i
                                                            class="fa fa-line-chart text-white fs-2"
                                                            aria-hidden="true"></i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                        </footer>
                        <!-- partial -->
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl</th>
                                        <th class="text-center">Project Name</th>
                                        <th class="text-center">Project Title</th>
                                        <th class="text-center">Start date</th>
                                        <th class="text-center">End Date</th>
                                        <th class="text-center">Assigned Manager</th>
                                        <th class="text-center">Assigned Employees</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Desc</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql1 = "SELECT pt.id AS pro_task_id, 
        (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Team Head') AS team_head_id,
        (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Collaborators' LIMIT 1) AS collaborator_id,
        pt.pro_id, pt.task_title, pt.start_date, pt.end_date, pt.status,
        GROUP_CONCAT(CASE WHEN at.user_type = 'Collaborators' THEN at.assign_user END SEPARATOR ',') AS assign_users,
        (SELECT assign_user FROM assign_task WHERE task_id = pt.id AND user_type = 'Team Head') AS assigned_manager
        FROM pro_task pt
        LEFT JOIN assign_task at ON pt.id = at.task_id 
        WHERE pt.task_type = 'Field' 
            AND pt.status = 'Not Started' 
            AND FIND_IN_SET('$em_code', at.assign_user) > 0
        GROUP BY pt.id, pt.pro_id, pt.task_title, pt.start_date, pt.end_date 
        ORDER BY 
        CASE 
            WHEN status = 'Not Started' THEN 1
            WHEN status = 'Started' THEN 2
            WHEN status = 'Testing' THEN 3
            WHEN status = 'Complete' THEN 4
            WHEN status = 'Cancel' THEN 5
            ELSE 6 
        END";

                                    $result1 = $conn->query($sql1);
                                    $slno = 1;
                                    if ($result1->num_rows > 0) {
                                        while ($row1 = $result1->fetch_assoc()) {
                                            $idd = $row1["pro_task_id"];
                                            $teamHeadId = $row1["team_head_id"];
                                            $collaboratorId = $row1["collaborator_id"];
                                            $assignedManager = $row1['assigned_manager'];

                                            // Fetch the manager's name
                                            $sql34 = "SELECT full_name FROM employee WHERE em_code = '$assignedManager' AND em_role = '2'";
                                            $result34 = $conn->query($sql34);
                                            $managerName = ($result34->num_rows > 0) ? $result34->fetch_assoc()["full_name"] : "No manager assigned";

                                            // Fetch all employee names for collaborators (role 4) only once
                                            $sql33 = "SELECT full_name, em_code FROM employee WHERE em_role = '4'";
                                            $result33 = $conn->query($sql33);
                                            $employeeNames = [];
                                            while ($row33 = $result33->fetch_assoc()) {
                                                $employeeNames[$row33['em_code']] = $row33['full_name'];
                                            }

                                            // Fetch project name for each task
                                            $pro_id = $row1["pro_id"];
                                            $sqlProj = "SELECT pro_name FROM project WHERE id = $pro_id";
                                            $resultProj = $conn->query($sqlProj);
                                            $rowProj = $resultProj->fetch_assoc();
                                            $projectName = $rowProj ? htmlspecialchars($rowProj["pro_name"], ENT_QUOTES, 'UTF-8') : "Unknown Project";

                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $slno++; ?></td>
                                                <td class="text-center"><?php echo $projectName; ?></td>
                                                <td class="text-center">
                                                    <p><?php echo $row1['task_title']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?php echo $row1['start_date']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?php echo $row1['end_date']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?php echo $managerName; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex align-items-center">
                                                        <p class="mb-0 assigned-names">
                                                            <?php
                                                            $assignedUsers = explode(',', $row1['assign_users']);
                                                            $assignedNames = array_map(function ($code) use ($employeeNames) {
                                                                return isset($employeeNames[$code]) ? $employeeNames[$code] : null;
                                                            }, $assignedUsers);
                                                            $assignedNames = array_filter($assignedNames);

                                                            if (!empty($assignedNames)) {
                                                                echo implode(', ', $assignedNames);
                                                            } else {
                                                                echo "No employees assigned.";
                                                            }
                                                            ?>
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <p class="form-control form-control-line edit"
                                                        onclick="showDropdown('status-<?php echo $row1['pro_task_id']; ?>-pro_task')">
                                                        <?php echo $row1["status"]; ?>
                                                    </p>
                                                    <select class='txtedit'
                                                        id='status-<?php echo $row1["pro_task_id"]; ?>-pro_task'
                                                        style="display:none;">
                                                        <option value="Not Started" <?php if ($row1["status"] == "Not Started")
                                                            echo 'selected="selected"'; ?>>Not Started
                                                        </option>
                                                        <option value="Started" <?php if ($row1["status"] == "Started")
                                                            echo 'selected="selected"'; ?>>Started
                                                        </option>
                                                        <option value="Testing" <?php if ($row1["status"] == "Testing")
                                                            echo 'selected="selected"'; ?>>Testing
                                                        </option>
                                                        <option value="Complete" <?php if ($row1["status"] == "Complete")
                                                            echo 'selected="selected"'; ?>>Complete
                                                        </option>
                                                        <option value="Cancel" <?php if ($row1["status"] == "Cancel")
                                                            echo 'selected="selected"'; ?>>Cancel
                                                        </option>
                                                    </select>
                                                </td>
                                                <td class="text-center">
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#paragraphmodal_<?php echo $idd; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="paragraphmodal_<?php echo $idd; ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-success text-white">
                                                            <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <?php
                                                        $sql17 = "SELECT * FROM pro_task WHERE id =$idd";
                                                        $result17 = $conn->query($sql17);
                                                        $row17 = $result17->fetch_assoc();
                                                        ?>
                                                        <div class="modal-body">
                                                            <div class="row g-3">
                                                                <div class="col-md-12">
                                                                    <strong>Project Description:</strong>
                                                                    <?php if ($em_role == '1') { ?>
                                                                        <textarea class="form-control form-control-line col-6 edit"
                                                                            rows="6"
                                                                            cols="80"><?php echo $row17["description"]; ?></textarea>
                                                                    <?php } else { ?>
                                                                        <textarea class="form-control form-control-line" rows="6"
                                                                            cols="80" readonly>
                                                                                                                                                                                                             <?php echo htmlspecialchars($row17["description"]); ?></textarea>
                                                                    <?php } ?>
                                                                    <?php if ($em_role == '1') { ?>
                                                                        <textarea class='txtedit'
                                                                            id='description-<?php echo $row17["id"]; ?>-pro_task'
                                                                            style="display:none; width:100%; height:150px;"><?php echo $row17["description"]; ?></textarea>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
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
        <!-- start body content -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/js/font-awesome.min.js"></script>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/chartjs/Chart.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/chartjs.js"></script>
    <script src="assets/js/material.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- for ajax update -->
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
                        url: 'insert.php',
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