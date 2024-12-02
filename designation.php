<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Designation - Hrms Techgeering</title>
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
                        <h2 class="my-2">Designation</h2>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                            <i class="fa-solid fa-plus"></i> Designation
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM designation";
                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $slno; ?></td>
                                                <td>
                                                    <?php
                                                    $dept_id = $row["dept_id"];
                                                    $sql10 = "SELECT * FROM department WHERE id = $dept_id";
                                                    $result10 = $conn->query($sql10);
                                                    $row10 = $result10->fetch_assoc();
                                                    echo htmlspecialchars($row10["dep_name"], ENT_QUOTES, 'UTF-8');
                                                    ?>
                                                </td>
                                                <td><?php echo $row["des_name"]; ?></td>
                                                <td>
                                                    <!-- <button type="button" class="btn btn-light"
                                                        onclick="myfcn2(<?php echo $row['id']; ?>,<?php echo $row['dept_id']; ?>,'<?php echo $row['des_name']; ?>')"
                                                        data-bs-toggle="modal" data-bs-target="#updateDes"><i
                                                            class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i>
                                                    </button> -->
                                                    <i class="fa-solid fa-pen-to-square text-primary me-2 ms-2"
                                                        onclick="myfcn2(<?php echo $row['id']; ?>, <?php echo $row['dept_id']; ?>, '<?php echo $row['des_name']; ?>')"
                                                        data-bs-toggle="modal" data-bs-target="#updateDes"
                                                        style="cursor: pointer;">
                                                    </i>
                                                    <?php
                                                    $status = $row['status'];
                                                    $idm = $row['id'];
                                                    if ($status == 1) {
                                                        echo "<a href='active.php?status=$idm&tb=designation&returnpage=designation.php' class='success'>
                                                            <i class='fa-solid fa-unlock text-success'></i>
                                                            </a>";
                                                    } else {
                                                        echo "<a href='inactive.php?status0=$idm&&tb=designation&&returnpage=designation.php' class='danger'><i class='fa-solid fa-lock text-danger'></i></a>";
                                                    }
                                                    ?>
                                                    <a onclick="confirmDelete(<?php echo $row['id']; ?>, tb='designation', tbc='id',returnpage='designation.php');"
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
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Action</th>
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
                    <h1 class="modal-title fs-5" id="addDeptLabel">Add Designation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-control" name="deptnm" required>
                                <option value="">Select Department</option>
                                <?php
                                include "common/conn.php";
                                $sql2 = "SELECT * FROM department";
                                $result2 = $conn->query($sql2);
                                while ($row2 = $result2->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row2["id"]; ?>">
                                        <?php echo $row2["dep_name"]; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="DesignationName">Designation Name</label>
                            <input type="text" class="form-control" name="DesignationName"
                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, ''); this.value = this.value.split(' ').map(function(word) {return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();}).join(' ');this.setCustomValidity(''); this.checkValidity();"
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
        // Retrieve form data
        $DepartmentName = $_POST["deptnm"];
        $DesignationName = $_POST["DesignationName"];
        if (!empty($DepartmentName) && !empty($DesignationName)) {
            $sql = "INSERT INTO designation (dept_id, des_name, status)
        VALUES ('$DepartmentName','$DesignationName','1')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>
                        alert('Success');
                        window.location.href = 'designation.php';
                      </script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        } else {
            echo "<script>alert('Form cannot be blank.')</script>";
        }
    }
    ?>
    <!-- update modal -->
    <div class="modal fade" id="updateDes" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Update Designation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <input type="hidden" name="id2" id="id2">
                        <div class="form-group">
                            <label for="category">Department</label>
                            <select class="form-control" id="department_name2" name="department_name">
                                <option value="">Select Department</option>
                                <?php
                                $sql8 = "SELECT * FROM department";
                                $result8 = $conn->query($sql8);
                                while ($row8 = $result8->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row8["id"]; ?>">
                                        <?php echo htmlspecialchars($row8["dep_name"], ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="DesignationName">Designation Name</label>
                            <input type="text" class="form-control" id="DesignationNamee" name="DesignationNamee"
                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, ''); this.value = this.value.split(' ').map(function(word) {return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();}).join(' ');this.setCustomValidity(''); this.checkValidity();"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="updatedesignation">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['updatedesignation'])) {
        include "common/conn.php";
        $department_name = $_POST["department_name"];
        $designation = $_POST["DesignationNamee"];
        $id = $_POST["id2"];
        if (!empty($designation) && !empty($designation) && !empty($id)) {
            $sql1 = "UPDATE designation SET dept_id='$department_name', des_name='$designation' WHERE id='$id'";
            if ($conn->query($sql1) === true) {
                echo "<script>
                        alert('Success');
                        window.location.href = 'designation.php';
                      </script>";
            } else {
                echo $conn->error;
            }
        } else {
            echo "<script>alert('Designation name and ID cannot be blank.')</script>";
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