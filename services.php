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
                        <h2 class="my-2">Services</h2>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                            <i class="fa-solid fa-plus"></i> Services
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl No</th>
                                        <th class="text-center">Service Name</th>
                                        <th class="text-center">HSN Number</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM service";
                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $slno; ?></td>
                                                <td class="text-center"><?php echo $row["service_name"]; ?></td>
                                                <td class="text-center"><?php echo $row["hsn_num"]; ?></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-light"
                                                        onclick="myfcn13(<?php echo $row['id']; ?>,'<?php echo $row['service_name']; ?>','<?php echo $row['hsn_num']; ?>')"
                                                        data-bs-toggle="modal" data-bs-target="#updateDept"><i
                                                            class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i></button>
                                                </td>
                                                <td class="text-center">
                                                    <a onclick="confirmDelete(<?php echo $row['id']; ?>, tb='service', tbc='id',returnpage='services.php');"
                                                        title="Delete">
                                                        <i class="fa-solid fa fa-trash text-danger" aria-hidden="true"></i>
                                                    </a>
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
                                <tfoot>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Service Name</th>
                                        <th>HSN Number</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>
                                </tfoot>
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
                    <h1 class="modal-title fs-5" id="addDeptLabel">Services</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="DepartmentName">Service Name</label>
                            <input type="text" class="form-control" name="servicenmae"
                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, ''); this.value = this.value.split(' ').map(function(word) {return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();}).join(' ');this.setCustomValidity(''); this.checkValidity();"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="DepartmentName">HSN Number</label>
                            <input type="text" class="form-control" name="hsnnm"
                                oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                required>
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
        $servicenmae = $_POST['servicenmae'];
        $hsnnm = $_POST['hsnnm'];
        if (!empty($servicenmae) && !empty($hsnnm)) {
            $sql = "INSERT INTO service (service_name,hsn_num) VALUES ('$servicenmae','$hsnnm')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                        alert('Success');
                        window.location.href = 'services.php';
                      </script>";
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('Service name and HSN number cannot be blank.')</script>";
        }
        mysqli_close($conn);
    }
    ?>
    <!--Update modal -->
    <div class="modal fade" id="updateDept" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Update Service</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <input type="hidden" name="id13" id="id13">
                        <div class="form-group">
                            <label for="DepartmentName">Service Name</label>
                            <input type="text" class="form-control" id="servicenm" name="servicename"
                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, ''); this.value = this.value.split(' ').map(function(word) {return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();}).join(' ');this.setCustomValidity(''); this.checkValidity();"
                                placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <label for="DepartmentName">HSN Number</label>
                            <input type="text" class="form-control" id="hsn_nm" name="hsnnumber"
                                oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="updateservice">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['updateservice'])) {
        include "common/conn.php";
        $servicename = trim($_POST["servicename"]);
        $hsnnumber = trim($_POST["hsnnumber"]);
        $id = trim($_POST["id13"]);
        $sql1 = "UPDATE service SET service_name='$servicename', hsn_num='$hsnnumber' WHERE id='$id'";
        if ($conn->query($sql1) === TRUE) {
            echo "<script>
                        alert('Success');
                        window.location.href = 'services.php';
                      </script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "')</script>";
        }
        $conn->close();
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js?v=1.2"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>

</html>