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
                        <h2 class="my-2">Expenditure Calculator</h2>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addexpenditure">
                            <i class="fa-solid fa-plus"></i>Add
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Year</th>
                                        <th>Month</th>
                                        <th>Expenditure Name</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM expenditure_calculator";
                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row['id'];
                                            ?>
                                            <tr>
                                                <td><?php echo $slno; ?></td>
                                                <td><?php echo $row["year"]; ?></td>
                                                <td><?php echo $row["month"]; ?></td>
                                                <td><?php echo $row["name"]; ?></td>
                                                <td>
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#paragraphmodal_<?php echo $id; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="paragraphmodal_<?php echo $id; ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <?php
                                                        $id; ?>
                                                        <?php
                                                        include "common/conn.php";
                                                        $sql_show = "SELECT * FROM expenditure_list where expencal_id = '$id'";
                                                        $result_show = $conn->query($sql_show);
                                                        while ($row_show = $result_show->fetch_assoc()) {
                                                            ?>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        Expenditure Name:-
                                                                        <?php
                                                                        $exp = $row_show["expenname_id"];
                                                                        $sql41 = "SELECT * FROM expenditure WHERE id = $exp";
                                                                        $result41 = $conn->query($sql41);
                                                                        $row41 = $result41->fetch_assoc();
                                                                        echo $row41["expenditure_name"];
                                                                        ?>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        Price:-<?php echo $row_show["expen_price"]; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                        } ?>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $slno++;
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
    <div class="modal fade" id="addexpenditure" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-4">
                                <div class="mb-2">
                                    <label for="year" class="form-label">Year</label>
                                    <select class="form-select" name="year" id="year">
                                        <option value="" selected>Select Year</option>
                                        <?php
                                        $currentYear = date("Y");
                                        for ($year = 2000; $year <= $currentYear; $year++) {
                                            echo "<option value=\"$year\">$year</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <div class="mb-2">
                                    <label for="month" class="form-label">Month</label>
                                    <select class="form-select" name="month" id="month">
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
                            <?php
                            include "common/conn.php";
                            $sql = "SELECT * FROM expenditure";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="form-group col-4">
                                    <div class="mb-2">
                                        <label for="month"
                                            class="form-label"><?php echo $row['expenditure_name']; ?></label>
                                        <input type="text" class="form-control" value="<?php echo $row['fixed_cost']; ?>"
                                            name="<?php echo $row['expenditure_name']; ?>"
                                            id="<?php echo $row['expenditure_name']; ?>">
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- <div class="form-group">
                                <label for="DepartmentName">Total Cost</label>
                                <input type="text" class="form-control" id="totalcost" name="totalcost1" readonly>
                            </div> -->
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
        $year = $_POST["year"];
        $month = $_POST["month"];
        $namee = [];
        $sql = "SELECT * FROM expenditure";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $expenditurenames = $row['expenditure_name'];
            $value = $_POST[$expenditurenames];
            $namee[] = "$value";//8000,3000,4000,...
            $totalValue += $value;
        }
        $expen_name = implode(',', $namee);
        $sql = "INSERT INTO expenditure_calculator(year, month, name) VALUES('$year','$month','$totalValue')";
        if ($conn->query($sql) == true) {
            $last_id = $conn->insert_id;

            $sql1 = "SELECT * FROM expenditure";
            $result1 = $conn->query($sql1);
            while ($row1 = $result1->fetch_assoc()) {
                $expenditurenames1 = $row1['expenditure_name'];
                $id = $row1['id'];
                $value = $_POST[$expenditurenames1];
                $sql3 = "INSERT INTO expenditure_list(expencal_id, expenname_id, expen_price) VALUES('$last_id','$id','$value')";
                if ($conn->query($sql3) == true) {
                    echo "<script>alert('success')</script>";
                } else {
                    $conn->error;
                }
            }

            // echo "<script>alert('success')</script>";
        } else {
            $conn->error;
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