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
    <title>View Leave - Hrms Techgeering</title>
    <link rel="icon" type="image/png" href="assets/img/favicon-t.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- start Top Navbar -->
    <?php include 'common/topnav.php' ?>
    <?php
    include "common/conn.php";
    $sql13 = "SELECT * FROM employee WHERE id=$userid";
    $result13 = $conn->query($sql13);
    if ($result13->num_rows > 0) {
        $row13 = $result13->fetch_assoc();
        $name = $row13["full_name"];
        $dept = $row13["dep_id"];
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
                        <h2 class="my-2">Leave Application</h2>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                            <i class="fa-solid fa-plus"></i> Leave Application
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Apply Date</th>
                                        <th>Employee id</th>
                                        <th>Leave type</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Days</th>
                                        <th>Reason</th>
                                        <th>Leave Report</th>
                                        <?php if ($em_role == '4') { ?>
                                            <th>View</th>
                                        <?php } ?>
                                        <?php if ($em_role == '1' || $em_role == '2' || $em_role == '3' || $em_role == '4') { ?>
                                            <th>Status</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    if ($em_role == '4') {
                                        $sql = "SELECT * FROM emp_leave WHERE em_id = '$emp_id'";
                                    } elseif ($em_role == '2') {
                                        $sql = "SELECT el.* 
                                        FROM emp_leave el
                                        JOIN employee e ON el.em_id = e.em_code
                                        WHERE e.dep_id = '$dept'";
                                    } else {
                                        $sql = "SELECT * FROM emp_leave";
                                    }
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row["id"]; ?></td>
                                                <td><?php echo $row["apply_date"]; ?></td>
                                                <td><?php echo $row["em_id"]; ?></td>
                                                <td>
                                                    <?php
                                                    $typeid = $row["typeid"];
                                                    $sql2 = "SELECT * FROM leave_types WHERE type_id = $typeid and status = 1";
                                                    $result2 = $conn->query($sql2);
                                                    $row2 = $result2->fetch_assoc();
                                                    echo htmlspecialchars($row2["name"], ENT_QUOTES, 'UTF-8');
                                                    ?>
                                                </td>
                                                <td><?php echo $row["start_date"]; ?></td>
                                                <td><?php echo $row["end_date"]; ?></td>
                                                <td><?php echo $row["leave_duration"]; ?></td>
                                                <td><?php echo $row["reason"]; ?></td>
                                                <td>
                                                    <?php if (!empty($row['supportingdocument'])): ?>
                                                        <a href="<?php echo $row['supportingdocument']; ?>" target="_blank">
                                                            <i class="fas fa-file-pdf"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>

                                                <?php if ($em_role == '4') { ?>
                                                    <th>
                                                        <?php
                                                        $status = $row["leave_status"];
                                                        if ($status == '1') {
                                                            echo "Approved";
                                                        } elseif ($status == '2') {
                                                            echo "Not Approved";
                                                        } elseif ($status == '3') {
                                                            echo "Cancel";
                                                        } else {
                                                            echo "Pending";
                                                        }
                                                        ?>
                                                    </th>
                                                <?php } ?>
                                                <?php if ($em_role == '1' || $em_role == '2' || $em_role == '3' || $em_role == '4') { ?>
                                                    <td>
                                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                            <div class="btn-group">
                                                                <?php
                                                                $leave_status = $row['leave_status'];
                                                                if ($leave_status == '0' || $leave_status == '1' || $leave_status == '2') { ?>
                                                                    <button class="btn btn-success dropdown-toggle" type="button"
                                                                        id="dropdownMenuButton_<?php echo $row['id']; ?>"
                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <?php
                                                                        $leave_status = $row['leave_status'];
                                                                        echo ($leave_status == 0) ? "Pending" :
                                                                            (($leave_status == 1) ? "Approved" :
                                                                                (($leave_status == 2) ? "Not Approved" : "Cancel"));
                                                                        ?>
                                                                    </button>
                                                                <?php } ?>
                                                                <?php if ($leave_status == '3') { ?>
                                                                    <button class="btn btn-danger" type="button">Cancelled</button>
                                                                <?php } ?>
                                                                <?php if ($leave_status == '0') { ?>
                                                                    <ul class="dropdown-menu"
                                                                        aria-labelledby="dropdownMenuButton_<?php echo $row['id']; ?>">
                                                                        <li>
                                                                            <?php if ($em_role == '1' || $em_role == '2' || $em_role == '3') { ?>
                                                                                <button class="dropdown-item" type="submit"
                                                                                    name="status_update" value="1">Approved</button>
                                                                            <?php } ?>
                                                                        </li>
                                                                        <li>
                                                                            <?php if ($em_role == '1' || $em_role == '2' || $em_role == '3') { ?>
                                                                                <button class="dropdown-item" type="submit"
                                                                                    name="status_update" value="2">Not Approved</button>
                                                                            <?php } ?>
                                                                        </li>
                                                                        <li>
                                                                            <?php if ($em_role == '1' || $em_role == '2' || $em_role == '3' || $em_role == '4') { ?>
                                                                                <button class="dropdown-item" type="submit"
                                                                                    name="status_update" value="3">Cancel</button>
                                                                            <?php } ?>
                                                                        </li>
                                                                    </ul>
                                                                <?php } ?>
                                                                <?php if ($leave_status == '1' || $leave_status == '2') { ?>
                                                                    <ul class="dropdown-menu"
                                                                        aria-labelledby="dropdownMenuButton_<?php echo $row['id']; ?>">
                                                                        <li>
                                                                            <?php if ($em_role == '1' || $em_role == '2' || $em_role == '3' || $em_role == '4') { ?>
                                                                                <button class="dropdown-item" type="submit"
                                                                                    name="status_update" value="3">Cancel</button>
                                                                            <?php } ?>
                                                                        </li>
                                                                    </ul>
                                                                <?php } ?>
                                                                <input type="hidden" name="idd" value="<?php echo $row['id']; ?>">
                                                                <input type="hidden" name="em_id"
                                                                    value="<?php echo $row['em_id']; ?>">
                                                            </div>
                                                        </form>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    $conn->close();
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
                    <h1 class="modal-title fs-5" id="addDeptLabel">Leave Application</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="empId">Employee id</label>
                            <input type="text" class="form-control" id="empId" name="empId"
                                value="<?php echo $emp_id; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Leavetype">Leave type</label>
                            <select name="Leavetype" id="Leavetype" class="form-control">
                                <option value="">Leave type</option>
                                <?php
                                include "common/conn.php";
                                $result = mysqli_query($conn, "SELECT * FROM  leave_types where status = 1");
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <option value="<?php echo $row['type_id']; ?>">
                                        <?php echo $row["name"]; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="StartDate">Start Date</label>
                            <input type="date" class="form-control" id="StartDate" name="StartDate">
                        </div>
                        <div class="form-group">
                            <label for="EndDate">End Date</label>
                            <input type="date" class="form-control" id="EndDate" name="EndDate">
                        </div>
                        <div class="form-group">
                            <label for="Reason">Reason</label>
                            <input type="text" class="form-control" id="Reason" name="Reason">
                        </div>
                        <div class="form-group">
                            <label for="supportingdocument">Supporting Document</label>
                            <input type="file" class="form-control" id="supportingdocument" name="supportingdocument"
                                onchange="checkFileType(this)">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submitleave">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    include "common/conn.php";
    function calculateHours($date1, $date2)
    {
        $totalHours = 0;
        $endDate = clone $date2;
        // $endDate->modify('-1 day');
        while ($date1 < $endDate) {
            $dayOfWeek = $date1->format('N');
            if ($dayOfWeek == 6) {
                $totalHours += 5;
            } elseif ($dayOfWeek == 7) {
            } else {
                $totalHours += 9;
            }
            $date1->modify('+1 day');
        }
        return $totalHours;
    }
    if (isset($_POST['submitleave'])) {
        // Retrieve form data
        $empId = $_POST["empId"];
        $Leavetype = $_POST["Leavetype"];
        $StartDate = $_POST["StartDate"];
        $EndDate = $_POST["EndDate"];
        $Reason = $_POST["Reason"];
        $currentDate = date('d-m-Y');

        $date1 = new DateTime($StartDate);
        $date2 = new DateTime($EndDate);
        $interval = $date1->diff($date2);
        $days = $interval->days;
        $totalHours = calculateHours(clone $date1, $date2);

        if (!empty($_FILES["supportingdocument"]["name"])) {



            // Handle file upload
            $targetDir = "assets/uploads/employee/"; // Directory to save files
            $fileName = basename($_FILES["supportingdocument"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            // Allow certain file formats
    
            // Upload file to server
            if (move_uploaded_file($_FILES["supportingdocument"]["tmp_name"], $targetFilePath)) {
                $sql1 = "INSERT INTO emp_leave (em_id, typeid, start_date, end_date, leave_duration, duration_hour, apply_date, reason, leave_status, supportingdocument)
                    VALUES ('$empId', '$Leavetype', '$StartDate', '$EndDate', '$days', '$totalHours', '$currentDate', '$Reason', '0', '$targetFilePath')";
                if ($conn->query($sql1) === TRUE) {
                    echo "<script>alert('Leave application submitted successfully!');</script>";
                } else {
                    echo "<script>alert('Database error occurred.');</script>";
                }
            } else {
                echo "<script>alert('Error uploading file.');</script>";
            }

        } else {
            $sql1 = "INSERT INTO emp_leave (em_id, typeid, start_date, end_date, leave_duration, duration_hour, apply_date, reason, leave_status)
            VALUES ('$empId', '$Leavetype', '$StartDate', '$EndDate', '$days', '$totalHours', '$currentDate', '$Reason', '0')";
            if ($conn->query($sql1) === TRUE) {
                echo "<script>alert('Leave application submitted successfully!');</script>";
            } else {
                echo "<script>alert('Database error occurred.');</script>";
            }
        }

        $conn->close();
    }
    include "common/conn.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status_update']) && isset($_POST['idd'])) {
        $status = $_POST['status_update'];
        $id = $_POST['idd'];
        $em_id = $_POST['em_id'];
        $sql10 = "UPDATE emp_leave SET leave_status='$status' WHERE id='$id'";
        if ($conn->query($sql10) === true) {
            // echo " <script>alert('success')</script>";
            $currentDate = date('Y-m-d H:i:s');
            $sql11 = "INSERT INTO leave_apply_approve (leaveapp_id, approved_by, datetime)
            VALUES ('$id', '$em_role', '$currentDate')";
            if ($conn->query($sql11) === TRUE) {
                echo "<script>alert('success')</script>";
            } else {
                echo $conn->error;
            }
            $conn->close();
        }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>

</body>

</html>
