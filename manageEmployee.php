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
    <link href="css/styles.css" rel="stylesheet" />
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
                    <h1 class="my-2">Employee</h1>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Employee Id</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Designation</th>
                                        <th>Department</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Employee Id</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Designation</th>
                                        <th>Department</th>
                                        <th>Manage</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        include "common/conn.php";
                                        $sql = "SELECT e.id, e.employee_id, e.image_path, e.name AS employee_name, d.designation, dep.name 
                                        FROM employees e
                                        LEFT JOIN designation d ON e.designation = d.id
                                        LEFT JOIN departments dep ON e.department = dep.id
                                         WHERE e.id = '3'";

                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <th><?php echo $row["id"]; ?></th>
                                                <th><?php echo $row["employee_id"]; ?></th>
                                                <th><?php echo $row["employee_name"]; ?></th>
                                                <th><img src="<?php echo $row["image_path"]; ?>" alt="" height="20" width="20"></th>
                                                <th><?php echo $row["designation"]; ?></th>
                                                <th><?php echo $row["name"]; ?></th>
                                                <th>
                                                    <a href="employeeDetails.php?id=<?php echo $row["id"]; ?>"><i class="fa-solid fa-eye text-success"></i></a>
                                                    <i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i>
                                                    <i class="fa-solid fa-lock text-danger"></i>
                                                </th>
                                            </tr>
                                    <?php
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>