<?php
session_start(); {
    $em_role = $_SESSION["em_role"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Employees - Hrms Techgeering</title>
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
                        <h2 class="my-2">Employee</h2>
                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                            <a href="employeeAdd.php" type="button" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i> Employee
                            </a>
                        <?php } ?>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Employee Id</th>
                                        <th>Employee Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>User Type</th>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <th>Action</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM employee WHERE status='ACTIVE'";
                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $encoded_id = base64_encode($row['em_code']);
                                            ?>
                                            <tr>
                                                <td><?php echo $slno; ?></td>
                                                <th><?php echo $row["em_code"]; ?></th>
                                                <th><?php echo $row["full_name"] ?></th>
                                                <th><?php echo $row["em_email"]; ?></th>
                                                <th><?php echo $row["em_phone"]; ?></th>
                                                <th>
                                                    <?php
                                                    if ($row["em_role"] == 1) {
                                                        echo "Admin";
                                                    } elseif ($row["em_role"] == 2) {
                                                        echo "Manager";
                                                    } elseif ($row["em_role"] == 3) {
                                                        echo "HR";
                                                    } else {
                                                        echo "Employee";
                                                    }
                                                    ?>
                                                </th>
                                                <?php if ($em_role == '1' || $em_role == '3') { ?>
                                                    <th>
                                                        <a href="employeeDetail.php?em_id=<?php echo $encoded_id; ?>"> <i
                                                                class="fa-solid fa-eye  text-primary"></i></a>
                                                        <!-- <i class="fa-solid fa-lock text-danger mx-2"></i> -->
                                                        <!-- Disciplinary -->
                                                        <!-- <i class="fa-solid fa-exclamation-circle"></i> -->
                                                    </th>
                                                <?php } ?>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>

</html>