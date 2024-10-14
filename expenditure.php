<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Expenditure - Hrms Techgeering</title>
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
                        <h2 class="my-2">Expenditure</h2>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addexpenditure">
                            <i class="fa-solid fa-plus"></i> Expenditure
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Expenditure Name</th>
                                        <th>Fixed Cost</th>
                                        <th>Duration</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM expenditure";
                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $slno; ?></td>
                                                <td><?php echo $row["expenditure_name"]; ?></td>
                                                <td><?php echo $row["fixed_cost"]; ?></td>
                                                <td><?php echo $row["duration"]; ?></td>
                                                <td>
                                                    <i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"
                                                        onclick="myfcn10(<?php echo $row['id']; ?>, '<?php echo addslashes($row['expenditure_name']); ?>', '<?php echo addslashes($row['fixed_cost']); ?>', '<?php echo $row['duration']; ?>')"
                                                        data-bs-toggle="modal" data-bs-target="#updateexp"></i>
                                                    <a onclick="confirmDelete('<?php echo $row['id']; ?>', 'expenditure', 'id', 'expenditure.php');"
                                                        class="fa-solid fa fa-trash text-danger"></a>

                                                </td>
                                            </tr>
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
    <div class="modal fade" id="addexpenditure" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Expenditure Name</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="DepartmentName">Expenditure Name</label>
                            <input type="text" class="form-control" name="expenditurename1">
                        </div>
                        <div class="form-group">
                            <label for="DepartmentName">Fixed Cost</label>
                            <input type="text" class="form-control" name="fixedcost1">
                        </div>
                        <div class="form-group">
                            <div class="mb-2">
                                <label for="duration" class="form-label">Duration</label>
                                <select class="form-select" name="duration1">
                                    <option value="" selected>Select Month</option>
                                    <option value="1month">1 Month</option>
                                    <option value="2months">2 Months</option>
                                    <option value="3months">3 Months</option>
                                    <option value="6months">6 Months</option>
                                    <option value="12months">1 Year</option>
                                </select>
                            </div>
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
        $expenditurename = $_POST["expenditurename1"];
        $fixedcost = $_POST["fixedcost1"];
        $duration = $_POST["duration1"];
        $sql = "INSERT INTO expenditure(expenditure_name, fixed_cost, duration) VALUES('$expenditurename','$fixedcost',' $duration')";
        if ($conn->query($sql) == true) {
            echo "<script>alert('success')</script>";
        } else {
            $conn->error;
        }
        $conn->close();
    }
    ?>
    <!-- update modal -->
    <div class="modal fade" id="updateexp" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <input type="hidden" name="id10" id="id10">
                        <div class="form-group">
                            <label for="DepartmentName">Expenditure Name</label>
                            <input type="text" class="form-control" name="expenditurename1" id="expenditure">
                        </div>
                        <div class="form-group">
                            <label for="DepartmentName">Fixed Cost</label>
                            <input type="text" class="form-control" name="fixedcost1" id="fixedcost">
                        </div>
                        <div class="form-group">
                            <div class="mb-2">
                                <label for="duration" class="form-label">Duration</label>
                                <select class="form-select" name="duration1" id="duration">
                                    <option value="" selected>Select Month</option>
                                    <option value="1month">1 Month</option>
                                    <option value="2months">2 Months</option>
                                    <option value="3months">3 Months</option>
                                    <option value="6months">6 Months</option>
                                    <option value="12months">1 Year</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="updatedeexpenditure">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['updatedeexpenditure'])) {
        include "common/conn.php";
        $expenditurename1 = htmlspecialchars($_POST["expenditurename1"]);
        $fixedcost1 = $_POST["fixedcost1"];
        $duration1 = $_POST["duration1"];
        $id = $_POST["id10"];
        $sql1 = "UPDATE expenditure SET expenditure_name='$expenditurename1', fixed_cost='$fixedcost1', duration='$duration1' WHERE id='$id'";
        if ($conn->query($sql1) === true) {
            echo " <script>alert('success')</script>";
        } else {
            echo $conn->error;
        }
        $conn->close();
    }
    ?>
    <script>
        function myfcn10(idx, expenditure, fixedcost, duration) {
            document.getElementById("id10").value = idx;
            document.getElementById("expenditure").value = expenditure;
            document.getElementById("fixedcost").value = fixedcost;
            document.getElementById("duration").value = duration;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js?v=1.7"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>

</html>