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
    <title>Leave Type - Hrms Techgeering</title>
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
                        <h2 class="my-2">Leave Type</h2>
                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                                <i class="fa-solid fa-plus"></i> Leave Type
                            </button>
                        <?php } ?>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Leave Type</th>
                                        <th>Days</th>
                                        <!-- <th>status</th> -->
                                        <?php if ($em_role == '1') { ?>
                                            <th>Action</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM  leave_types";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <th><?php echo $row["type_id"]; ?></th>
                                                <th><?php echo $row["name"]; ?></th>
                                                <th><?php echo $row["leave_day"]; ?></th>
                                                <?php if ($em_role == '1') { ?>
                                                    <th>

                                                        <i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"
                                                            onclick="myfcn5(<?php echo $row['type_id']; ?>,'<?php echo $row['name']; ?>','<?php echo $row['leave_day']; ?>')"
                                                            data-bs-toggle="modal" data-bs-target="#updateleavetype"></i>
                                                        <i class="fa-solid fa-lock text-danger"></i>
                                                    </th>
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
                            <label for="leaveType">Leave Type</label>
                            <input type="text" class="form-control" name="leaveType">
                        </div>
                        <div class="form-group">
                            <label for="days">Days</label>
                            <input type="num" class="form-control" name="days">
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
        // Retrieve form data
        $leaveType = $_POST["leaveType"];
        $days = $_POST["days"];

        $sql = "INSERT INTO leave_types (name, leave_day, status)
            VALUES ('$leaveType', '$days', '1')";

        if ($conn->query($sql) === TRUE) {
            echo " <script>alert('success')</script>";
        } else {
            echo " <script>alert('error')</script>";
        }
        // Close connection
        $conn->close();
    }
    $conn->close();
    ?>
    <!-- update modal -->
    <div class="modal fade" id="updateleavetype" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Update Department</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <input type="hidden" name="id5" id="id5">
                        <div class="form-group">
                            <label for="leaveType">Leave Type</label>
                            <input type="text" class="form-control" id="leaveTypee" name="leaveType">
                        </div>
                        <div class="form-group">
                            <label for="days">Days</label>
                            <input type="num" class="form-control" id="dayss" name="days">
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
        $id = $_POST["id5"];
        $leaveTypee = $_POST["leaveType"];
        $dayss = $_POST["days"];
        $sql1 = "UPDATE leave_types SET name='$leaveTypee', leave_day='$dayss' WHERE type_id='$id'";
        if ($conn->query($sql1) === true) {
            echo " <script>alert('success')</script>";
        } else {
            echo $conn->error;
        }
        $conn->close();
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js?v=1.2"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>

</html>