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
                        <h1 class="my-2">Apply Leave</h1>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                            Apply Leave
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Name</th>
                                        <th>Leave Type</th>
                                        <th>Apply Date</th>
                                        <th>Leave From</th>
                                        <th>Leave To</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Name</th>
                                        <th>Leave Type</th>
                                        <th>Apply Date</th>
                                        <th>Leave From</th>
                                        <th>Leave To</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT l.id, l.creation_date, l.leave_from, l.leave_to , e.name ,lc.catagory_name
                                    FROM leave_table l
                                    LEFT JOIN employees e on l.emp_id = e.id
                                    LEFT JOIN leave_catogory lc on l.leave_type = lc.id
                                    
                                    ";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <th><?php echo $row["id"]; ?></th>
                                                <th><?php echo $row["name"]; ?></th>
                                                <th><?php echo $row["catagory_name"]; ?></th>
                                                <th><?php echo $row["creation_date"]; ?></th>
                                                <th><?php echo $row["leave_from"]; ?></th>
                                                <th><?php echo $row["leave_to"]; ?></th>
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
                            <label for="LeaveType">Leave Type</label>
                            <!-- <input type="text" class="form-control" id="LeaveType" name="LeaveType"> -->
                            <select name="leaveType" id="leaveType" class="form-control">
                                <?php
                                include "common/conn.php";
                                $sql = "SELECT * FROM leave_catogory";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $row["id"]; ?>"><?php echo $row["catagory_name"]; ?></option>
                                <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                $conn->close();
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="LeaveMessageName">Leave Message</label>
                            <textarea class="form-control" id="LeaveMessageName" rows="3" name="LeaveMessageName"></textarea>

                        </div>
                        <div class="form-group">
                            <label for="leaveFrom">Leave From</label>
                            <input type="date" class="form-control" id="leaveFrom" name="leaveFrom">
                        </div>
                        <div class="form-group">
                            <label for="leaveto">Leave To</label>
                            <input type="date" class="form-control" id="leaveto" name="leaveto">
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
    if (isset($_POST['submit'])) {

        $leaveType = $_POST["leaveType"];
        $LeaveMessageName = $_POST["LeaveMessageName"];
        $leaveFrom = $_POST["leaveFrom"];
        $leaveto = $_POST["leaveto"];



        $sql = "INSERT INTO leave_table (emp_id, leave_type, leave_message, leave_from, leave_to, status)
                VALUES ('1', '$leaveType', '$LeaveMessageName',' $leaveFrom', ' $leaveto', 1)";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>

</html>