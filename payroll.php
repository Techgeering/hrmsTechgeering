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
                                        $sql2 = " SELECT e.full_name, e.em_code, s.basic, s.medical, s.house_rent, s.transporting, s.bonus, s.bima, s.tax, s.provident_fund, s.loan, s.other_diduction, s.performance_bonus
                                        FROM employee e
                                        JOIN pay_salary s ON e.em_code = s.emp_id
                                        ORDER BY s.year DESC, s.month DESC";
                                        $result2 = $conn->query($sql2);
                                        while ($row2 = $result2->fetch_assoc()) {
                                            ?>
                                        <option value="<?php echo $row2["em_code"]; ?>"
                                            data-empname="<?php echo $row2["full_name"]; ?>"
                                            data-basic="<?php echo $row2["basic"]; ?>"
                                            data-medical="<?php echo $row2["medical"]; ?>"
                                            data-house_rent="<?php echo $row2["house_rent"]; ?>"
                                            data-transporting="<?php echo $row2["transporting"]; ?>"
                                            data-bonus="<?php echo $row2["bonus"]; ?>"
                                            data-bima="<?php echo $row2["bima"]; ?>"
                                            data-tax="<?php echo $row2["tax"]; ?>"
                                            data-provident_fund="<?php echo $row2["provident_fund"]; ?>"
                                            data-loan="<?php echo $row2["loan"]; ?>"
                                            data-other="<?php echo $row2["other_diduction"]; ?>">
                                            <?php echo $row2["em_code"];
                                                ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="DepartmentName">Emp Name</label>
                                    <input type="text" class="form-control" id="empname1" name="empname" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="mb-2">
                                        <label for="month" class="form-label">Month</label>
                                        <input type="text" class="form-control" name="month" id="month1" required
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="year" class="form-label">Year</label>
                                    <input type="text" class="form-control" name="year" id="year1"
                                        value="<?php echo date('Y'); ?>" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="DepartmentName">Basic</label>
                                    <input type="text" class="form-control" id="basic1" name="basic"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="DepartmentName">House Rent</label>
                                    <input type="text" class="form-control" id="houserent1" name="houserent"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="DepartmentName">Medical</label>
                                    <input type="text" class="form-control" id="medical1" name="medical"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="DepartmentName">Conveyance</label>
                                    <input type="text" class="form-control" id="conveyance1" name="conveyance"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="DepartmentName">Bonus</label>
                                    <input type="text" class="form-control" id="bonus1" name="bonus"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="DepartmentName">Insurance</label>
                                    <input type="text" class="form-control" id="insurance1" name="insurance"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="DepartmentName">Provident Fund</label>
                                    <input type="text" class="form-control" id="providentfund1" name="providentfund"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="DepartmentName">Tax</label>
                                    <input type="text" class="form-control" id="tax1" name="tax"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="DepartmentName">Loans</label>
                                    <input type="text" class="form-control" id="loans1" name="loans"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="DepartmentName">Others</label>
                                    <input type="text" class="form-control" id="other1" name="other"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                        required>
                                </div>
                            </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#empid').on('change', function() {
            var empName = $(this).find(':selected').data('empname');
            var basic = $(this).find(':selected').data('basic');
            var medical = $(this).find(':selected').data('medical');
            var house_rent = $(this).find(':selected').data('house_rent');
            var transporting = $(this).find(':selected').data('transporting');
            var bima = $(this).find(':selected').data('bima');
            var tax = $(this).find(':selected').data('tax');
            var provident_fund = $(this).find(':selected').data('provident_fund');
            var loan = $(this).find(':selected').data('loan');
            var bonus = $(this).find(':selected').data('bonus');
            var other = $(this).find(':selected').data('other');
            $('#empname1').val(empName);
            $('#basic1').val(basic);
            $('#houserent1').val(house_rent);
            $('#medical1').val(medical);
            $('#conveyance1').val(transporting);
            $('#bonus1').val(bonus);
            $('#insurance1').val(bima);
            $('#providentfund1').val(provident_fund);
            $('#tax1').val(tax);
            $('#loans1').val(loan);
            $('#other1').val(other);
        });
    });
    var currentMonth = new Date().getMonth();
    var months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    var previousMonth = currentMonth - 1;
    document.getElementById('month1').value = months[previousMonth];
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>
</html>