<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Department - Hrms Techgeering</title>
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
                        <h2 class="my-2">Payroll</h2>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                            <i class="fa-solid fa-plus"></i> Payroll
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Employee Id</th>
                                        <th>Employee Name</th>
                                        <th>Month-Year</th>
                                        <th>Basic</th>
                                        <th>House Rent</th>
                                        <th>Medical</th>
                                        <th>Conveyance</th>
                                        <th>Performance Bonus</th>
                                        <th>Insurance</th>
                                        <th>Provident Fund</th>
                                        <th>Tax</th>
                                        <th>Loans</th>
                                        <th>Others</th>
                                        <th>Salary Paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM pay_salary";
                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $slno; ?></td>
                                                <td><?php echo $row["emp_id"]; ?></td>
                                                <td><?php echo $row["emp_id"]; ?></td>
                                                <td><?php echo $row["month"] . '/' . $row["year"]; ?></td>
                                                <td><?php echo $row["basic"]; ?></td>
                                                <td><?php echo $row["house_rent"]; ?></td>
                                                <td><?php echo $row["medical"]; ?></td>
                                                <td><?php echo $row["transporting"]; ?></td>
                                                <td><?php echo $row["bonus"]; ?></td>
                                                <td><?php echo $row["bima"]; ?></td>
                                                <td><?php echo $row["provident_fund"]; ?></td>
                                                <td><?php echo $row["tax"]; ?></td>
                                                <td><?php echo $row["loan"]; ?></td>
                                                <td><?php echo $row["other_diduction"]; ?></td>
                                                <td><?php
                                                $earn = $row["basic"] + $row["house_rent"] + $row["medical"] + $row["transporting"] + $row["bonus"];
                                                $dedect = $earn - $row["bima"] - $row["provident_fund"] - $row["tax"] - $row["loan"] - $row["other_diduction"];

                                                echo $dedect;
                                                ?></td>
                                                <?php
                                                $slno++;
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
    <!-- update modal -->
    <div class="modal fade" id="updateDept" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Update Department</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <input type="hidden" name="id1" id="id1">
                        <div class="form-group">
                            <label for="DepartmentName">Department Name</label>
                            <input type="text" class="form-control" id="DepartmentNamee" name="DepartmentNamee">
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
        $departmentname = htmlspecialchars($_POST["DepartmentNamee"]);
        $id = $_POST["id1"];
        $sql1 = "UPDATE department SET dep_name='$departmentname' WHERE id='$id'";
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
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>

</html>