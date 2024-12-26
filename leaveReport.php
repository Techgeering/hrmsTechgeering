<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Leave Report - Hrms Techgeering</title>
    <link rel="icon" type="image/png" href="assets/img/favicon-t.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css?v=1.2" rel="stylesheet" />
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
                        <h2 class="my-2">Department</h2>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                            <i class="fa-solid fa-plus"></i> Department
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Leave Type</th>
                                        <th>Total Leave </th>
                                        <th>Taken Leave</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'common/conn.php';
                                    $sql4 = "SELECT * FROM leave_types";
                                    $result4 = $conn->query($sql4);

                                    if ($result4->num_rows > 0) {
                                        $slNo = 1;
                                        while ($row4 = $result4->fetch_assoc()) {
                                            // Calculate taken leave
                                            $leaveType = $row4["name"];
                                            $sqlTakenLeave = "SELECT COUNT(*) AS taken_leave FROM emp_leave WHERE leave_type = '$leaveType' AND em_id='123456'";
                                            $resultTakenLeave = $conn->query($sqlTakenLeave);
                                            $takenLeave = 0;
                                            if ($resultTakenLeave->num_rows > 0) {
                                                $rowTakenLeave = $resultTakenLeave->fetch_assoc();
                                                $takenLeave = $rowTakenLeave["taken_leave"];
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $slNo; ?></td>
                                                <td><?php echo $row4["name"]; ?></td>
                                                <td><?php echo $row4["leave_day"]; ?></td>
                                                <td><?php echo $takenLeave; ?></td>
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
                        <div class="form-group">
                            <label for="DepartmentName">Department Name</label>
                            <input type="text" class="form-control" id="DepartmentName" name="DepartmentName">
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
        $departmentName = $_POST["DepartmentName"];
        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO department (dep_name) VALUES (?)");
        $stmt->bind_param("s", $departmentName);
        // Execute SQL statement
        if ($stmt->execute() === TRUE) {
            echo " <script>alert('success')</script>";
        } else {
            echo " <script>alert('$stmt->error')</script>";
        }
        // Close connection
        $stmt->close();
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