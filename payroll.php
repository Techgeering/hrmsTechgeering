<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Payroll - Hrms Techgeering</title>
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
                                        <th>Total Earnings</th>
                                        <th>Total Deduction</th>
                                        <th>Net Pay</th>
                                        <th>Salary Slip</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    // $sql44 = "SELECT * FROM pay_salary";
                                    $sql44 = "SELECT * FROM pay_salary ORDER BY year DESC, month DESC";
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
                                                <td><?php echo $row44["total_earnings"]; ?></td>
                                                <td><?php echo $row44["total_deduction"]; ?></td>
                                                <td><?php echo $row44["net_pay"]; ?></td>
                                                <td>
                                                    <a href="payrollinvoice.php?id=<?php echo $row44["emp_id"]; ?>"
                                                        target="_blank">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
                                                </td>
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
                            <div class="col-3">
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
                            <div class="col-3">
                                <label for="subcategoryDropdown">Employee Name:</label>
                                <input type="text" class="form-control" name="name" id="name" readonly>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <div class="mb-2">
                                        <label for="month" class="form-label">Month</label>
                                        <input type="text" class="form-control" name="month" id="month1"
                                            value="<?php echo date('F', strtotime('first day of last month')); ?>"
                                            required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
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
                                        <input type="text" name="Basic" id="Basic" class="form-control"
                                            oninput="calculateGrossEarnings(); calculateannual();">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-2">
                                        <label for="insurance" class="form-label">House Rent</label>
                                        <input type="text" name="Houserent" id="Houserent" class="form-control"
                                            oninput="calculateGrossEarnings(); calculateannual();">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-2">
                                        <label for="insurance" class="form-label">Medical</label>
                                        <input type="text" name="Medical" id="Medical" class="form-control"
                                            oninput="calculateGrossEarnings(); calculateannual();">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-2">
                                        <label for="insurance" class="form-label">Travel</label>
                                        <input type="text" name="Travel" id="Travel" class="form-control"
                                            oninput="calculateGrossEarnings();">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- <div class="col-4">
                                    <div class="mb-2">
                                        <label for="insurance" class="form-label">Performance Bonus</label>
                                        <input type="text" name="Performance" id="Performance" class="form-control"
                                            oninput="calculateGrossEarnings()">
                                    </div>
                                </div> -->
                                <div class="col-4">
                                    <div class="mb-2">
                                        <label for="Performance" class="form-label">Performance Bonus</label>
                                        <input type="text" name="Performance" id="Performance" class="form-control"
                                            oninput="validatePerformance(this); calculateGrossEarnings(); calculateannual();">
                                        <input type="hidden" id="Performance1">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="insurance" class="form-label">Gross Total Monthly Earnings</label>
                                    <input type="text" name="Gross" id="Gross" class="form-control"
                                        oninput="calculateGrossEarnings(); calculateannual();">
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
                                                oninput="calculateGrossDeduction()"
                                                oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label for="year" class="form-label">TDS</label>
                                            <input type="text" class="form-control" name="tds" id="Tds"
                                                oninput="calculateGrossDeduction()"
                                                oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label for="insurance" class="form-label">Insurance</label>
                                            <input type="text" class="form-control" name="insurance" id="Insurance"
                                                value="0" oninput="calculateGrossDeduction()"
                                                oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label for="other" class="form-label">Other Deduction</label>
                                            <input type="text" class="form-control" name="other" id="Other"
                                                oninput="calculateGrossDeduction()"
                                                oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label for="gross" class="form-label">Gross Total Deduction</label>
                                            <input type="text" class="form-control" name="grossdeduction"
                                                id="grossdeduction" oninput="calculateGrossDeduction()" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h5>Net Pay:-</h5>
                                        <div class="col-6">
                                            <div class="mb-2">
                                                <input type="text" class="form-control" name="netpay" id="netpay"
                                                    oninput="calculateGrossDeduction()" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label>Insurance By Company</label>
                                                <input type="text" class="form-control" value="0"
                                                    name="insurance_company" id="insurance_company">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" name="epfcompany" id="epfcompany">
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
        $Performance0 = $_POST["Performance"];
        $Performance;
        if ($Performance0 == null || $Performance0 == 0) {
            $Performance = "0.00";
        } else {
            $Performance = $Performance0;
        }
        $ptax = $_POST["ptax"];
        $Epf = $_POST["Epf"];
        $tds = $_POST["tds"];
        $insurance = $_POST["insurance"];
        $other = $_POST["other"];
        $total_earings = $_POST["Gross"];
        $total_deduction = $_POST["grossdeduction"];
        $netpay = $_POST["netpay"];
        $epf_company = $_POST["epfcompany"];
        $insurance_company = $_POST["insurance_company"];
        $paid_company = floatval($netpay) + floatval($epf_company) + floatval($insurance_company);

        $sql1 = "SELECT month, emp_id, year
                     FROM pay_salary 
                     WHERE month = '$month' AND year = '$year' AND emp_id = '$empid'";
        $result1 = $conn->query($sql1);

        if ($result1->num_rows === 0) {

            $sql11 = "INSERT INTO pay_salary (emp_id, month, year, basic, house_rent, medical, transporting, performance_bonus, tax, provident_fund, tds, bima, other_diduction, total_earnings, total_deduction, net_pay, epf_company, insurance_company, paid_company) VALUES ('$empid','$month','$year','$Basic','$Houserent','$Medical','$Travel','$Performance','$ptax','$Epf','$tds','$insurance','$other',' $total_earings','$total_deduction','$netpay','$epf_company','$insurance_company','$paid_company')";
            if ($conn->query($sql11) === true) {
                echo "<script>window.location.href='payroll.php';</script>";
            } else {
                echo "Error: " . $sql11 . "<br>" . $conn->error;
            }
            $conn->close();
        } else {
            $sql12 = "UPDATE pay_salary 
                        SET basic = '$Basic', house_rent = '$Houserent', medical = '$Medical', transporting = '$Travel', performance_bonus = '$Performance', tax = '$ptax', provident_fund = '$Epf', tds = '$tds', bima = '$insurance', other_diduction = '$other', total_earnings = '$total_earings', total_deduction = '$total_deduction', net_pay = '$netpay', epf_company = '$epf_company',  insurance_company = '$insurance_company', paid_company = '$paid_company'   
                        WHERE month = '$month' AND year = '$year' AND emp_id = '$empid'";
            if ($conn->query($sql12) === TRUE) {
                echo "Record processed successfully for emp_id: $empid";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
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
                            if (data) {
                                var parsedData = JSON.parse(data);
                                // Update table data
                                $('#payrollTable tbody').html(parsedData.tableData);
                                // Update input fields
                                $('#name').val(parsedData.name);
                                $('#Basic').val(parseFloat(parsedData.basic).toFixed(2));
                                // $('#Houserent').val(parsedData.house_rent);
                                $('#Houserent').val(parseFloat(parsedData.house_rent).toFixed(2));
                                $('#Medical').val(parseFloat(parsedData.medical).toFixed(2));
                                $('#Travel').val(parseFloat(parsedData.travel).toFixed(2));
                                $('#Performance').val(parseFloat(parsedData.perform_bonus).toFixed(2));
                                $('#Performance1').val(parseFloat(parsedData.perform_bonus).toFixed(2));
                                $('#Gross').val(parseFloat(parsedData.total).toFixed(2));
                                $('#Grossannual').val(parseFloat(parsedData.annual).toFixed(2));
                                $('#Epf').val(parseFloat(parsedData.epf).toFixed(2));
                                $('#Tds').val(parseFloat(parsedData.tds).toFixed(2));
                                $('#Other').val(parseFloat(parsedData.other).toFixed(2));
                                $('#empid').val(parsedData.empidd);
                                $('#ptaxx').val(parseFloat(parsedData.ptax).toFixed(2));
                                $('#grossdeduction').val(parseFloat(parsedData.total_deduction).toFixed(2));
                                $('#netpay').val(parseFloat(parsedData.netpay).toFixed(2));
                                $('#epfcompany').val(parseFloat(parsedData.epfcompany).toFixed(2));
                                // $('#paidcompany').val(parseFloat(parsedData.paid_company).toFixed(2));
                            } else {
                                // If no data, set fields to blank
                                $('#payrollTable tbody').html('');
                                $('#Basic, #Houserent, #Medical, #Travel, #Performance, #Performance1, #Gross, #Grossannual, #Epf, #Tds, #Other, #empid, #ptaxx, #grossdeduction, #netpay, #epfcompany').val('');
                            }
                        }
                    });
                }
            });
        });
        function calculateGrossDeduction() {
            let tax = parseFloat(document.getElementById('ptaxx').value) || 0;
            let epf = parseFloat(document.getElementById('Epf').value) || 0;
            let tds = parseFloat(document.getElementById('Tds').value) || 0;
            let insurance = parseFloat(document.getElementById('Insurance').value) || 0;
            let other = parseFloat(document.getElementById('Other').value) || 0;
            let grossDeduction = tax + epf + tds + insurance + other;
            document.getElementById('grossdeduction').value = grossDeduction.toFixed(2);
        }
        function validatePerformance(input) {
            // Parse the current input value
            const currentValue = parseFloat(input.value);
            let previousValue = parseFloat(document.getElementById('Performance1').value);
            if (currentValue > previousValue) {
                input.value = previousValue;
            }

            calculateGrossEarnings();
        }

        function calculateGrossEarnings() {
            let basic = parseFloat(document.getElementById('Basic').value) || 0;
            let houserent = parseFloat(document.getElementById('Houserent').value) || 0;
            let medical = parseFloat(document.getElementById('Medical').value) || 0;
            let travel = parseFloat(document.getElementById('Travel').value) || 0;
            let performancebonus = parseFloat(document.getElementById('Performance').value) || 0;
            let grossEarnings = basic + houserent + medical + travel + performancebonus;
            document.getElementById('Gross').value = grossEarnings.toFixed(2);
        }

        function calculateannual() {
            let Gross = parseFloat(document.getElementById('Gross').value) || 0;
            let Earnings = Gross * 12;
            document.getElementById('Grossannual').value = Earnings.toFixed(2);
        }

        function calculatepaidcompany() {
            let netpay = parseFloat(document.getElementById('netpay').value) || 0;
            let insurancecompany = parseFloat(document.getElementById('insurance_company').value) || 0; // Corrected ID
            let epfcompany = parseFloat(document.getElementById('epfcompany').value) || 0;
            let grosspaidcompany = netpay + epfcompany;
            document.getElementById('paidcompany').value = grosspaidcompany.toFixed(2);
        }
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