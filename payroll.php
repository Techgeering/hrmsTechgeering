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
                                    $sql = "SELECT ps.*, e.full_name 
                                            FROM pay_salary ps 
                                            JOIN employee e ON ps.emp_id = e.em_code";
                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td><?php echo $slno++; ?></td>
                                                <td><?php echo $row["emp_id"]; ?></td>
                                                <td><?php echo $row["full_name"]; ?></td>
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
                                                    $deduct = $row["bima"] + $row["provident_fund"] + $row["tax"] + $row["loan"] + $row["other_diduction"];
                                                    $netSalary = $earn - $deduct;
                                                    echo $netSalary;
                                                ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='15'>No records found</td></tr>";
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
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="empid">Employee ID</label>
                                    <select class="form-control" name="empid" id="empid" required>
                                        <option value="">Select EmployeeId</option>
                                        <?php
                                        include "common/conn.php";
                                        $sql2 = "SELECT e.full_name, e.em_code 
                                                 FROM employee e";
                                        $result2 = $conn->query($sql2);
                                        while ($row2 = $result2->fetch_assoc()) {
                                        ?>
                                            <option value="<?php echo $row2["em_code"]; ?>"
                                                data-empname="<?php echo $row2["full_name"]; ?>">
                                                <?php echo $row2["em_code"]; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="DepartmentName">Emp Name</label>
                                    <input type="text" class="form-control" id="empname1" name="empname" required readonly>
                                </div>
                            </div>
                            <!-- Other form fields remain the same -->
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
        $sqlpayroll = "INSERT INTO pay_salary (emp_id, month, year, basic, house_rent, medical, transporting, bonus, bima, provident_fund, tax, loan, other_diduction, total_pay) 
                       VALUES ('$empid', '$month', '$year', '$basic', '$houserent', '$medical', '$conveyance', '$bonus', '$insurance', '$providentfund', '$tax', '$loans', '$other', '$salarypaid')";
        if ($conn->query($sqlpayroll) === true) {
            echo "<script>alert('Form submitted successfully');</script>";
        } else {
            echo "Error: " . $conn->error;
        }
        $conn->close();
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#empid').on('change', function () {
                var selectedOption = $(this).find('option:selected');
                var empname = selectedOption.data('empname');
                $('#empname1').val(empname);
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>

</html>
