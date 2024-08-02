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
                                        <th>Status</th>
                                        <th>Action</th>
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
                                                <th><?php echo $row["leave_type"]; ?></th>
                                                <th><?php echo $row["start_date"]; ?></th>
                                                <th><?php echo $row["end_date"]; ?></th>
                                                <th><?php echo $row["leave_duration"]; ?></th>
                                                <th><?php echo $row["reason"]; ?></th>
                                                <th><?php echo $row["leave_status"]; ?></th>
                                                <th>
                                                    <i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i>
                                                    <i class="fa-solid fa-lock text-danger"></i>
                                                </th>
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

        $sql1 = "INSERT INTO emp_leave (em_id, typeid, leave_type,start_date,end_date,leave_duration,duration_hour,apply_date,reason)
            VALUES ('$empId', '$Leavetype','', '$StartDate','$EndDate','$days', '$totalHours','$currentDate','$Reason')";

        if ($conn->query($sql1) === TRUE) {
            echo " <script>alert('success')</script>";
        } else {
            echo " <script>alert('error')</script>";
        }
        // Close connection
        $conn->close();
    }
    $conn->close();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>

</html>