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
                        <h2 class="my-2">Billing</h2>
                        <a href="billingadd.php" type="button" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i> Billing
                        </a>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Invoice Number</th>
                                        <th>Project Name</th>
                                        <th>Bill Amount</th>
                                        <th>GST(Amount)</th>
                                        <th>Total Bill Amount</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM project_invoice";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $invoice_num = base64_encode($row['invoice_number']);
                                            ?>
                                            <tr>
                                                <td><?php echo $row["date"]; ?></td>
                                                <td><?php echo $row["invoice_number"]; ?></td>
                                                <td>
                                                    <?php
                                                    $project_id = $row["project_id"];
                                                    $sql11 = "SELECT * FROM project WHERE id = $project_id";
                                                    $result11 = $conn->query($sql11);
                                                    if ($result11->num_rows > 0) {
                                                        $row11 = $result11->fetch_assoc();
                                                        echo htmlspecialchars($row11["pro_name"], ENT_QUOTES, 'UTF-8');
                                                    } else {
                                                        echo "Project not found";
                                                    }
                                                    ?>
                                                </td>
                                                <?php
                                                // Fetch and calculate total amount for the current invoice number
                                                $sqlf = "SELECT invoice_number, SUM(total_amount) AS total_amount1
                                                            FROM invoice_details
                                                            WHERE invoice_number = '{$row['invoice_number']}'
                                                            GROUP BY invoice_number";
                                                $resultf = $conn->query($sqlf);
                                                $totalSum = 0;
                                                if ($resultf->num_rows > 0) {
                                                    $rowf = $resultf->fetch_assoc();
                                                    $totalSum = $rowf["total_amount1"];
                                                }
                                                ?>
                                                <td><?php echo $totalSum; ?></td>
                                                <?php
                                                $gstamountt = ($totalSum * $row["pro_gst"]) / 100;
                                                ?>
                                                <td><?php echo $gstamountt; ?></td>
                                                <td>
                                                    <?php
                                                    $gstamount = ($totalSum * $row["pro_gst"]) / 100;
                                                    $totalamount = $totalSum + $gstamount;
                                                    echo $totalamount;
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="billing_invoice.php?invoice=<?php echo $invoice_num; ?>"
                                                        target="_blank" title="View PDF">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php }
                                    } ?>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Invoice Number</th>
                                        <th>Project Name</th>
                                        <th>Bill Amount</th>
                                        <th>GST(Amount)</th>
                                        <th>Total Bill Amount</th>
                                        <th>View</th>
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