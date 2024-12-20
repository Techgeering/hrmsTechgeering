<?php
session_start(); {
    $em_role = $_SESSION["em_role"];
    $emp_id = $_SESSION["emp_id"];
}
?>
<?php
include 'common/conn.php';
$leadId = isset($_GET['id']) ? $_GET['id'] : NULL;
$leadId = trim(base64_decode($leadId));
?>
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
                        <!-- <h2 class="my-2">View Update Record</h2> -->
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl.No</th>
                                        <th>Field id</th>
                                        <th>Field Name</th>
                                        <th>Old_record</th>
                                        <th>New_record</th>
                                        <th>Date_time</th>
                                        <th>Employee Id</th>
                                        <th>Employee Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM update_record ORDER BY date_time DESC";
                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $slno; ?></td>
                                                <td><?php echo $row["column_id"]; ?></td>
                                                <td><?php echo $row["column_name"]; ?></td>
                                                <td><?php echo $row["old_record"]; ?></td>
                                                <td><?php echo $row["new_record"]; ?></td>
                                                <td><?php echo $row["date_time"]; ?></td>
                                                <td><?php echo $row["emp_id"]; ?></td>
                                                <td>
                                                    <?php
                                                    $emp_id = $row["emp_id"];
                                                    $sql1 = "SELECT * FROM employee WHERE em_code = '$emp_id'";
                                                    $result1 = $conn->query($sql1);
                                                    $row1 = $result1->fetch_assoc();
                                                    echo htmlspecialchars($row1["full_name"], ENT_QUOTES, 'UTF-8');
                                                    ?>
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
                                        <th>Column id</th>
                                        <th>Column Name</th>
                                        <th>old_record</th>
                                        <th>new_record</th>
                                        <th>date_time</th>
                                        <th>Employee Id</th>
                                        <th>Employee Name</th>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>

</html>