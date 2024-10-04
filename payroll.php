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
                                        <th>Month-Year</th>
                                        <th>Basic</th>
                                        <th>House Rent</th>
                                        <th>Medical</th>
                                        <th>Conveyance</th>
                                        <th>Performance Bonus</th>
                                        <th>Professional Tax</th>
                                        <th>provident_fund</th>
                                        <th>TDS</th>
                                        <th>Insurance</th>
                                        <th>Other Deduction</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql44 = "SELECT * FROM pay_salary";
                                    $result44 = $conn->query($sql44);
                                    $slno = 1;
                                    if ($result44->num_rows > 0) {
                                        while ($row44 = $result44->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $slno; ?></td>
                                                <td><?php echo $row44["emp_id"]; ?></td>
                                                <td><?php echo $row44["month"] . '/' . $row44["year"]; ?></td>
                                                <td><?php echo $row44["basic"]; ?></td>
                                                <td><?php echo $row44["house_rent"]; ?></td>
                                                <td><?php echo $row44["medical"]; ?></td>
                                                <td><?php echo $row44["transporting"]; ?></td>
                                                <td><?php echo $row44["performance_bonus"]; ?></td>
                                                <td><?php echo $row44["tax"]; ?></td>
                                                <td><?php echo $row44["provident_fund"]; ?></td>
                                                <td><?php echo $row44["tds"]; ?></td>
                                                <td><?php echo $row44["bima"]; ?></td>
                                                <td><?php echo $row44["other_diduction"]; ?></td>
                                            </tr>
                                            <?php
                                            $slno++;
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    // $conn->close();
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Payroll</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <label for="subcategoryDropdown">Employee Id:</label>
                                <select class="form-control" name="value" required>
                                    <option value="">Select EmpId</option>
                                    <?php
                                    $sql2 = "SELECT * FROM employee";
                                    $result2 = $conn->query($sql2);
                                    while ($row2 = $result2->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row2["em_code"]; ?>">
                                            <?php echo $row2["em_code"]; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="mb-2">
                                        <label for="month" class="form-label">Month</label>
                                        <input type="text" class="form-control" name="month" id="month1"
                                            value="<?php echo date('F', strtotime('first day of last month')); ?>"
                                            required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="year" class="form-label">Year</label>
                                    <input type="text" class="form-control" name="year" id="year1"
                                        value="<?php echo date('Y'); ?>" readonly>
                                </div>
                            </div>
                            <h5>Earnings:-</h5>
                            <div class="row">
                                <div class="col-3">
                                    <div class="mb-2">
                                        <label for="insurance" class="form-label">Basic</label>
                                        <input type="text" name="Basic" id="Basic" class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-2">
                                        <label for="insurance" class="form-label">House Rent</label>
                                        <input type="text" name="Houserent" id="Houserent" class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-2">
                                        <label for="insurance" class="form-label">Medical</label>
                                        <input type="text" name="Medical" id="Medical" class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-2">
                                        <label for="insurance" class="form-label">Travel</label>
                                        <input type="text" name="Travel" id="Travel" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-2">
                                        <label for="insurance" class="form-label">Performance Bonus</label>
                                        <input type="text" name="Performance" id="Performance" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="insurance" class="form-label">Gross Total Earnings</label>
                                    <input type="text" name="Gross" id="Gross" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label for="insurance" class="form-label">Gross Annual Earnings</label>
                                    <input type="text" name="Grossannual" id="Grossannual" class="form-control">
                                </div>
                            </div>
                            <h5>Deduction:-</h5>
                            <div class="col-12">
                                <!-- <table id="payrollTable" class="table table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th>Basic</th>
                                            <th>House Rent Allownce</th>
                                            <th>Medical Allownce</th>
                                            <th>Travel Allownce</th>
                                            <th>Performance Bonus</th>
                                            <th>Gross Total Earnings</th>
                                            <th>Gross Annual Earnings</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table> -->
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label for="year" class="form-label">Professional Tax</label>
                                            <input type="text" class="form-control" name="ptax" id="ptaxx"
                                                oninput="calculateGrossDeduction()" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label for="year" class="form-label">EPF</label>
                                            <input type="text" class="form-control" name="Epf" id="Epf"
                                                oninput="calculateGrossDeduction()">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label for="year" class="form-label">TDS</label>
                                            <input type="text" class="form-control" name="tds" id="Tds" value="0"
                                                oninput="calculateGrossDeduction()">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label for="insurance" class="form-label">Insurance</label>
                                            <input type="text" class="form-control" name="insurance" id="Insurance"
                                                value="0" oninput="calculateGrossDeduction()">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label for="other" class="form-label">Other Deduction</label>
                                            <input type="text" class="form-control" name="other" id="Other"
                                                oninput="calculateGrossDeduction()">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label for="gross" class="form-label">Gross Total Deduction</label>
                                            <input type="text" class="form-control" name="gross" id="grossdeduction"
                                                oninput="calculateGrossDeduction()" readonly>
                                        </div>
                                    </div>
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
        include 'common/conn.php';
        $empid = $_POST["value"];
        $month = $_POST["month"];
        $year = $_POST["year"];
        $Basic = $_POST["Basic"];
        $Houserent = $_POST["Houserent"];
        $Medical = $_POST["Medical"];
        $Travel = $_POST["Travel"];
        $Performance = $_POST["Performance"];
        $ptax = $_POST["ptax"];
        $Epf = $_POST["Epf"];
        $tds = $_POST["tds"];
        $insurance = $_POST["insurance"];
        $other = $_POST["other"];

        $sql11 = "INSERT INTO pay_salary (emp_id, month, year, basic, house_rent, medical, transporting, performance_bonus, tax, provident_fund, tds, bima, other_diduction) VALUES ('$empid','$month','$year','$Basic','$Houserent','$Medical','$Travel','$Performance','$ptax','$Epf','$tds','$insurance','$other')";
        if ($conn->query($sql11) === true) {
            echo "<script>window.location.href='payroll.php';</script>";
        } else {
            echo "Error: " . $sql11 . "<br>" . $conn->error;
        }
        $conn->close();
    }
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('select[name="value"]').on('change', function () {
                var emp_id = $(this).val();
                if (emp_id) {
                    $.ajax({
                        url: "fetch_employee_earnings.php",
                        type: "POST",
                        data: { emp_id: emp_id },
                        success: function (data) {
                            var parsedData = JSON.parse(data);
                            // Update table data
                            $('#payrollTable tbody').html(parsedData.tableData);
                            // Update input fields
                            $('#Basic').val(parsedData.basic);
                            $('#Houserent').val(parsedData.house_rent);
                            $('#Medical').val(parsedData.medical);
                            $('#Travel').val(parsedData.travel);
                            $('#Performance').val(parsedData.perform_bonus);
                            $('#Gross').val(parsedData.total);
                            $('#Grossannual').val(parsedData.grosstotalearning);
                            $('#Epf').val(parsedData.epf);
                            $('#Other').val(parsedData.other);
                            $('#empid').val(parsedData.empidd);
                            $('#ptaxx').val(parsedData.ptax);
                        }
                    });
                }
            });
        });
    </script>

    <script>
        function calculateGrossDeduction() {
            const ptaxx = parseFloat(document.getElementById('ptaxx').value) || 0;
            const Epf = parseFloat(document.getElementById('Epf').value) || 0;
            const Tds = parseFloat(document.getElementById('Tds').value) || 0;
            const Insurance = parseFloat(document.getElementById('Insurance').value) || 0;
            const Other = parseFloat(document.getElementById('Other').value) || 0;

            // Calculate gross deduction
            const grossDeduction = ptaxx + Epf + Tds + Insurance + Other;

            // Set the value of the gross deduction field, format it to 2 decimal places
            document.getElementById('grossdeduction').value = ptaxx.toFixed(2);
        }

        // Call calculateGrossDeduction on page load to initialize values
        document.addEventListener("DOMContentLoaded", function () {
            calculateGrossDeduction();
        });

        // Ensure calculation is done when input values are changed
        document.querySelectorAll('input , select').forEach(input => {
            input.addEventListener('input', function () {
                calculateGrossDeduction();
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>

</html>