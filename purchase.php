<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Purchase - Hrms Techgeering</title>
    <link rel="icon" type="image/png" href="assets/img/favicon-t.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- start Top Navbar -->
    <?php include 'common/topnav.php' ?>
    <?php
    include "common/conn.php";
    $sql10 = "SELECT * FROM employee WHERE id=$userid";
    $result10 = $conn->query($sql10);
    if ($result10->num_rows > 0) {
        $row10 = $result10->fetch_assoc();
        $name = $row10["full_name"];
        $dept = $row["dep_id"];
        $em_code = $row["em_code"];
    }
    ?>
    <!-- end Top Navbar -->
    <div id="layoutSidenav">
        <!-- start Side Navbar -->
        <?php include 'common/sidenav.php' ?>
        <!-- end Side Navbar -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="my-2">Purchase</h2>
                        <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                            data-bs-target="#addPurchase">
                            <i class="fa-solid fa-plus"></i>Purchase
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl.No</th>
                                        <th class="text-center">Project Name</th>
                                        <th class="text-center">Service Name</th>
                                        <th class="text-center">Date Of Purchase</th>
                                        <th class="text-center">Service Start Date</th>
                                        <th class="text-center">Service End Date</th>
                                        <th class="text-center">Duration</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Renewal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM purchase";
                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $slno; ?></td>
                                                <td>
                                                    <?php
                                                    $pro_id = $row["pro_id"];
                                                    $sql1 = "SELECT * FROM project WHERE id = $pro_id";
                                                    $result1 = $conn->query($sql1);
                                                    $row1 = $result1->fetch_assoc();
                                                    echo htmlspecialchars($row1["pro_name"], ENT_QUOTES, 'UTF-8');
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $service_id = $row["service_id"];
                                                    $sql2 = "SELECT * FROM service WHERE id = $service_id";
                                                    $result2 = $conn->query($sql2);
                                                    $row2 = $result2->fetch_assoc();
                                                    echo htmlspecialchars($row2["service_name"], ENT_QUOTES, 'UTF-8');
                                                    ?>
                                                </td>
                                                <td><?php echo $row["date_of_purchase"]; ?></td>
                                                <td><?php echo $row["ser_start_dt"]; ?></td>
                                                <td><?php echo $row["ser_end_dt"]; ?></td>
                                                <td><?php echo $row["duration"]; ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    $enddate = $row["ser_end_dt"];
                                                    $today = date('Y-m-d');
                                                    if ($today > $enddate) {
                                                        $status = 0;
                                                    } else {
                                                        $status = 1;
                                                    }
                                                    if ($status === 0) {
                                                        echo "<span style='color: red;'>Expired</span>";
                                                    } else {
                                                        echo "<span style='color: green;'>Not Expired</span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <i class="fa fa-refresh" aria-hidden="true" data-bs-toggle="modal"
                                                        onclick="myfcn11(<?php echo $row['id']; ?>,'<?php echo $row['pro_id']; ?>','<?php echo $row['service_id']; ?>')"
                                                        data-bs-target="#renewal"></i>
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
    <!-- Purchase modal -->
    <div class="modal fade" id="addPurchase" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Purchase</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" class="form-control" value="<?php echo $proId; ?>" id="project_name"
                                name="project_name" required>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label for="Project_Name" class="form-label">Project Name</label>
                                    <select class="form-select" name="project_name">
                                        <option value="" disabled selected>Select a project</option>
                                        <?php
                                        include "common/conn.php";
                                        $sql_pro = "SELECT * FROM project ";
                                        $result_pro = $conn->query($sql_pro);
                                        while ($row_pro = $result_pro->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row_pro['id']; ?>">
                                                <?php echo $row_pro['pro_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label for="assigned_users" class="form-label">Service Name</label>
                                    <select class="form-control" name="service_name" id="service_namee" required>
                                        <option value="" disabled selected>Select a Service</option>
                                        <?php
                                        include "common/conn.php";
                                        $sql_service = "SELECT * FROM service";
                                        $result_service = $conn->query($sql_service);
                                        while ($row_service = $result_service->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row_service['id']; ?>">
                                                <?php echo $row_service['service_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="insurance_company">Date Of Purchase</label>
                                <input type="date" class="form-control" name="date_of_pur" id="date_of_purchase"
                                    value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-6">
                                <label>Service Start Date</label>
                                <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                                    name="service_start_dt" id="service_start_date" onchange="calculateDuration()">
                            </div>
                            <div class="col-6">
                                <label>Service End Date</label>
                                <input type="date" class="form-control" name="service_end_dt" id="service_end_date"
                                    onchange="calculateDuration()">
                            </div>
                            <div class="col-6">
                                <label>Duration</label>
                                <input type="text" class="form-control" name="duration1" id="duration" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="project_purchase">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    include "common/conn.php";
    // Accessing form data via POST
    if (isset($_POST['project_purchase'])) {
        $project_name = $_POST['project_name'];
        $service_name = $_POST["service_name"];
        $date_of_pur = $_POST["date_of_pur"];
        $service_start_dt = $_POST["service_start_dt"];
        $service_end_dt = $_POST["service_end_dt"];
        $duration1 = $_POST["duration1"];
        $sql_pur = "INSERT INTO purchase (pro_id, service_id, date_of_purchase, ser_start_dt, ser_end_dt, duration, status) 
                VALUES ('$project_name','$service_name','$date_of_pur','$service_start_dt','$service_end_dt','$duration1','1')";
        if ($conn->query($sql_pur) === TRUE) {
            echo "Successfully submitted!";
        } else {
            echo "Error: " . $sql_pur . "<br>" . $conn->error;
        }
        $conn->close();
    }
    ?>
    <!-- purchase update modal -->
    <div class="modal fade" id="renewal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Renewal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form name="form_pur1" id="form_pur1" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id11" id="id11">
                        <div class="row">
                            <input type="hidden" class="form-control" value="<?php echo $proId; ?>" id="project_name"
                                name="project_name" required>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label for="Project_Name" class="form-label">Project Name</label>
                                    <select class="form-select" name="project_name" id="pro_namew">
                                        <option value="" disabled selected>Select a project</option>
                                        <?php
                                        include "common/conn.php";
                                        $sql_pro = "SELECT * FROM project ";
                                        $result_pro = $conn->query($sql_pro);
                                        while ($row_pro = $result_pro->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row_pro['id']; ?>">
                                                <?php echo $row_pro['pro_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label for="assigned_users" class="form-label">Service
                                        Name</label>
                                    <select class="form-control" name="service_name" id="service_namee11">
                                        <option value="" disabled selected>Select a Service</option>
                                        <?php
                                        include "common/conn.php";
                                        $sql_service = "SELECT * FROM service";
                                        $result_service = $conn->query($sql_service);
                                        while ($row_service = $result_service->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row_service['id']; ?>">
                                                <?php echo $row_service['service_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="insurance_company">Date Of Purchase</label>
                                <input type="date" class="form-control" name="date_of_pur" id="date_of_purchase"
                                    value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-6">
                                <label>Service Start Date</label>
                                <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                                    name="service_start_dt" id="service_start_date1" onchange="calculateDuration1()">
                            </div>
                            <div class="col-6">
                                <label>Service End Date</label>
                                <input type="date" class="form-control" name="service_end_dt" id="service_end_date1"
                                    onchange="calculateDuration1()">
                            </div>
                            <div class="col-6">
                                <label>Duration</label>
                                <input type="text" class="form-control" name="duration1" id="duration12" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="project_purchase">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>