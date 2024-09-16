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
                    <h1 class="modal-title fs-5" id="addDeptLabel">Payroll</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="DepartmentName">Emp Id</label>
                            <input type="text" class="form-control" id="empid1" name="empid">
                        </div>
                        <!-- <div class="form-group">
                            <label for="DepartmentName">Emp Name</label>
                            <input type="text" class="form-control" id="empname1" name="empname">
                        </div> -->
                        <div class="form-group col-6">
                            <div class="mb-2">
                                <label for="month" class="form-label">Month</label>
                                <select class="form-select" name="month" id="month1">
                                    <option value="" selected>Select Month</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="year" class="form-label">Year</label>
                            <select class="form-select" name="year" id="year1">
                                <option value="" selected>Select Year</option>
                                <?php
                                $currentYear = date("Y");
                                for ($year = 2000; $year <= $currentYear; $year++) {
                                    echo "<option value=\"$year\">$year</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="col-6">
                                <label for="DepartmentName">Basic</label>
                                <input type="text" class="form-control" id="basic1" name="basic">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="DepartmentName">House Rent</label>
                            <input type="text" class="form-control" id="houserent1" name="houserent">
                        </div>
                        <div class="form-group">
                            <label for="DepartmentName">Medical</label>
                            <input type="text" class="form-control" id="medical1" name="medical">
                        </div>
                        <div class="form-group">
                            <label for="DepartmentName">Conveyance</label>
                            <input type="text" class="form-control" id="conveyance1" name="conveyance">
                        </div>
                        <div class="form-group">
                            <label for="DepartmentName">Bonus</label>
                            <input type="text" class="form-control" id="bonus1" name="bonus">
                        </div>
                        <div class="form-group">
                            <label for="DepartmentName">Insurance</label>
                            <input type="text" class="form-control" id="insurance1" name="insurance">
                        </div>
                        <div class="form-group">
                            <label for="DepartmentName">Provident Fund</label>
                            <input type="text" class="form-control" id="providentfund1" name="providentfund">
                        </div>
                        <div class="form-group">
                            <label for="DepartmentName">Tax</label>
                            <input type="text" class="form-control" id="tax1" name="tax">
                        </div>
                        <div class="form-group">
                            <label for="DepartmentName">Loans</label>
                            <input type="text" class="form-control" id="loans1" name="loans">
                        </div>
                        <div class="form-group">
                            <label for="DepartmentName">Others</label>
                            <input type="text" class="form-control" id="other1" name="other">
                        </div>
                        <div class="form-group">
                            <label for="DepartmentName">Salary Paid</label>
                            <input type="text" class="form-control" id="salarypaid1" name="salarypaid">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submitpayroll">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['submitpayroll'])) {
        include "common/conn.php";
        $empid = $_POST["empid"];
        $month = $_POST["month"];
        $year = $_POST["year"];
        $basic = $_POST["basic"];
        $houserent = $_POST["houserent"];
        $medical = $_POST["medical"];
        $conveyance = $_POST["conveyance"];
        $bonus = $_POST["bonus"];
        $insurance = $_POST["insurance"];
        $providentfund = $_POST["providentfund"];
        $tax = $_POST["tax"];
        $loans = $_POST["loans"];
        $other = $_POST["other"];
        $salarypaid = $_POST["salarypaid"];
        $sqlpayroll = "INSERT INTO pay_salary (emp_id, month, year, basic, house_rent, medical, transporting, bonus, bima, provident_fund, tax, loan, other_diduction, total_pay) VALUES ('$empid','$month', '$year', '$basic', '$houserent', '$medical','$conveyance','$bonus','$insurance','$providentfund','$tax','$loans','$other',' $salarypaid')";
        if ($conn->query($sqlpayroll) === true) {
            echo "<script>alert('Form submitted successfully');</script>";
        } else {
            $conn->error;
        }
        $conn->close();
    }
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