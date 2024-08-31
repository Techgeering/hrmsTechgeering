<?php
session_start(); {
    $em_role = $_SESSION["em_role"];
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
    <title>Tables - SB Admin</title>
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
                                        <?php if ($em_role == '4') { ?>
                                            <th>View</th>
                                        <?php } ?>
                                        <?php if ($em_role == '1' || $em_role == '2' || $em_role == '3' || $em_role == '4') { ?>
                                            <th>Status</th>
                                        <?php } ?>

                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM emp_leave";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <th><?php echo $row["id"]; ?></th>
                                                <th><?php echo $row["apply_date"]; ?></th>
                                                <th><?php echo $row["em_id"]; ?></th>
                                                <th>
                                                    <?php
                                                    $typeid = $row["typeid"];
                                                    $sql2 = "SELECT * FROM leave_types WHERE type_id = $typeid";
                                                    $result2 = $conn->query($sql2);
                                                    $row2 = $result2->fetch_assoc();
                                                    echo htmlspecialchars($row2["name"], ENT_QUOTES, 'UTF-8');
                                                    ?>
                                                </th>
                                                <th><?php echo $row["start_date"]; ?></th>
                                                <th><?php echo $row["end_date"]; ?></th>
                                                <th><?php echo $row["leave_duration"]; ?></th>
                                                <th><?php echo $row["reason"]; ?></th>
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
                                                    <th>
                                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                            <div class="btn-group">
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
                                                                <input type="hidden" name="idd" value="<?php echo $row['id']; ?>">
                                                            </div>
                                                        </form>
                                                    </th>
                                                <?php } ?>
                                                <!-- <th>
                                                    <?php echo $row["leave_status"]; ?>
                                                </th> -->
                                                <?php if ($em_role == '1') { ?>
                                                    <!-- <th>
                                                        <i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i>
                                                        <i class="fa-solid fa-lock text-danger"></i>
                                                    </th> -->
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
                    <h1 class="modal-title fs-5" id="addDeptLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="empId">Employee id</label>
                            <input type="text" class="form-control" id="empId" name="empId">
                        </div>
                        <div class="form-group">
                            <label for="Leavetype">Leave type</label>
                            <select name="Leavetype" id="Leavetype" class="form-control">
                                <option value="">Leave type</option>
                                <?php
                                include "common/conn.php";
                                $result = mysqli_query($conn, "SELECT * FROM  leave_types");
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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
    if (isset($_POST['submit'])) {
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
        $sql1 = "INSERT INTO emp_leave (em_id, typeid, start_date, end_date, leave_duration, duration_hour, apply_date, reason,  leave_status)
            VALUES ('$empId', '$Leavetype', '$StartDate', '$EndDate', '$days', '$totalHours', '$currentDate', '$Reason', '1')";
        if ($conn->query($sql1) === TRUE) {
            echo " <script>alert('success')</script>";
        } else {
            echo " <script>alert('error')</script>";
        }
        $conn->close();
    }
    $conn->close();
    ?>
    <?php
    include "common/conn.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status_update']) && isset($_POST['idd'])) {
        $status = $_POST['status_update'];
        $id = $_POST['idd'];
        $sql10 = "UPDATE emp_leave SET leave_status='$status' WHERE id='$id'";
        if ($conn->query($sql10) === true) {
            echo " <script>alert('success')</script>";
            $currentDate = date('d/m/Y');
            $sql11 = "INSERT INTO leave_apply_approve (leaveapp_id, approved_by, datetime)
            VALUES ('$id', '$em_role', '$currentDate')";
            if ($conn->query($sql11) === TRUE) {
                // echo " <script>alert('success')</script>";
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