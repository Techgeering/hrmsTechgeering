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
                        <h1 class="my-2">Designation</h1>
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
                                                <td><?php echo $row["des_name"]; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-light"
                                                        onclick="myfcn2(<?php echo $row['id']; ?>,'<?php echo $row['des_name']; ?>')"
                                                        data-bs-toggle="modal" data-bs-target="#updateDes"><i
                                                            class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i></button>
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

                                                    <!-- <i class="fa-solid fa-lock text-danger"></i> -->
                                                    <!-- <i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i> -->
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
                    <h1 class="modal-title fs-5" id="addDeptLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="DesignationName">Designation Name</label>
                            <input type="text" class="form-control" id="DesignationName" name="DesignationName">
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
        $DesignationName = $_POST["DesignationName"];
        $sql = "INSERT INTO designation (des_name)
        VALUES ('$DesignationName')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    ?>
    <!-- update modal -->
    <div class="modal fade" id="updateDes" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <input type="hidden" name="id2" id="id2">
                        <div class="form-group">
                            <label for="DesignationName">Designation Name</label>
                            <input type="text" class="form-control" id="DesignationNamee" name="DesignationNamee">
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
        $designation = htmlspecialchars($_POST["DesignationNamee"]);
        $id = $_POST["id2"];
        $sql1 = "UPDATE designation SET des_name='$designation' WHERE id='$id'";
        if ($conn->query($sql1) === true) {
            echo " <script>alert('success')</script>";
        } else {
            echo $conn->error;
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