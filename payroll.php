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
                            <div class="col-12">
                                <table class="table table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th>Basic</th>
                                            <th>House Rent Allownce</th>
                                            <th>Medical Allownce</th>
                                            <th>Travel Allownce</th>
                                            <th>Performance Bonus</th>
                                            <th>Gross Total Earnings</th>
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
                                        </tr>
                                    </tbody>
                                </table>
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
                            $('tbody').html(data);
                        }
                    });
                }
            });
        });
    </script>
    <script>
        function calculateEPF() {
            var grossTotalEarnings = parseFloat(document.getElementById("loans1").value) || 0;
            var epf = (grossTotalEarnings / 100) * 12;
            document.getElementById("epf").value = epf.toFixed(2);
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