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
    <link href="assets/css/styles.css?v=1.3" rel="stylesheet" />
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
                        <h2 class="my-2">Department</h2>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                            <i class="fa-solid fa-plus"></i> Department
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Dept Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM department";
                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $slno; ?></td>
                                                <td><?php echo $row["dep_name"]; ?></td>
                                                <td>
                                                    <!-- <button type="button" class="btn btn-light"
                                                        onclick="myfcn1(<?php echo $row['id']; ?>,'<?php echo $row['dep_name']; ?>')"
                                                        data-bs-toggle="modal" data-bs-target="#updateDept"><i
                                                            class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i>
                                                    </button> -->
                                                    <i class="fa-solid fa-pen-to-square text-primary"
                                                        onclick="myfcn1(<?php echo $row['id']; ?>,'<?php echo $row['dep_name']; ?>')"
                                                        data-bs-toggle="modal" data-bs-target="#updateDept"
                                                        style="cursor: pointer;">
                                                    </i>
                                                    <?php
                                                    $status = $row['status'];
                                                    $idm = $row['id'];
                                                    if ($status == 1) {
                                                        echo "<a href='active.php?status=$idm&tb=department&returnpage=departments.php' class='success'>
                                                            <i class='fa-solid fa-unlock text-success'></i>
                                                            </a>";
                                                    } else {
                                                        echo "<a href='inactive.php?status0=$idm&&tb=department&&returnpage=departments.php' class='danger'><i class='fa-solid fa-lock text-danger'></i></a>";
                                                    }
                                                    ?>
                                                    <a onclick="confirmDelete(<?php echo $row['id']; ?>, tb='department', tbc='id',returnpage='departments.php');"
                                                        title="Delete">
                                                        <i class="fa-solid fa fa-trash text-danger" aria-hidden="true"></i>
                                                    </a>
                                                    <!-- <i class="fa-solid fa-lock text-danger"></i> -->
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
                                        <th>Dept Name</th>
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
    <!--Add Modal -->
    <div class="modal fade" id="addDept" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Add Department</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="DepartmentName">Department Name</label>
                            <input type="text" class="form-control" id="DepartmentName" name="DepartmentName"
                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, ''); this.value = this.value.split(' ').map(function(word) {return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();}).join(' ');this.setCustomValidity(''); this.checkValidity();">
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
        $departmentName = trim($_POST["DepartmentName"]);
        if (!empty($departmentName)) {
            $stmt = $conn->prepare("INSERT INTO department (dep_name, status) VALUES (?, '1')");
            $stmt->bind_param("s", $departmentName);
            if ($stmt->execute() === TRUE) {
                echo "<script>
                        alert('Success');
                        window.location.href = 'departments.php';
                      </script>";
            } else {
                echo "<script>alert('Error: " . $stmt->error . "')</script>";
            }
            $stmt->close();

        } else {
            echo "<script>alert('Department name cannot be blank.')</script>";
        }
    }
    $conn->close();
    ?>
    <!--Update modal -->
    <div class="modal fade" id="updateDept" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Update Department</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <input type="hidden" name="id1" id="id1">
                        <div class="form-group">
                            <label for="DepartmentName">Department Name</label>
                            <input type="text" class="form-control" id="DepartmentNamee" name="DepartmentNamee"
                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, ''); this.value = this.value.split(' ').map(function(word) {return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();}).join(' ');this.setCustomValidity(''); this.checkValidity();">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="updatedepartment">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['updatedepartment'])) {
        include "common/conn.php";
        $departmentname = trim($_POST["DepartmentNamee"]);
        $id = trim($_POST["id1"]);
        if (!empty($departmentname) && !empty($id)) {
            $sql1 = "UPDATE department SET dep_name='$departmentname' WHERE id='$id'";
            if ($conn->query($sql1) === TRUE) {
                echo "<script>
                        alert('Success');
                        window.location.href = 'departments.php';
                      </script>";
            } else {
                echo "<script>alert('Error: " . $conn->error . "')</script>";
            }
        } else {
            echo "<script>alert('Department name and ID cannot be blank.')</script>";
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