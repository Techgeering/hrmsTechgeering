<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Leads - Hrms Techgeering</title>
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
                        <h2 class="my-2">Pending Followup Date</h2>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl.No</th>
                                        <th class="text-center">Lead Name</th>
                                        <th class="text-center">Company Name</th>
                                        <th class="text-center">Country</th>
                                        <th class="text-center">Mobile Number</th>
                                        <th class="text-center">Pending Followup Date</th>
                                        <th class="text-center">View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";

                                    $sql = "SELECT * FROM leads";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        $slno = 1;

                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row['id'];
                                            $encoded_id = base64_encode($row['id']);
                                            // Query to get follow-up records with next_date greater than today
                                            $sql2 = "SELECT * FROM lead_follow WHERE lead_id = $id AND next_date < CURDATE() ORDER BY next_date DESC";
                                            $result2 = $conn->query($sql2);

                                            if ($result2->num_rows > 0) {
                                                while ($row2 = $result2->fetch_assoc()) {
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $slno; ?></td>
                                                        <td class="text-center"><?php echo htmlspecialchars($row["lead_name"]); ?></td>
                                                        <td class="text-center"><?php echo htmlspecialchars($row["companyname"]); ?>
                                                        </td>
                                                        <td class="text-center"><?php echo htmlspecialchars($row["country"]); ?></td>
                                                        <td class="text-center"><?php echo htmlspecialchars($row["phone_no1"]); ?></td>
                                                        <td class="text-center"><?php echo htmlspecialchars($row2["next_date"]); ?></td>
                                                        <td>
                                                            <a href="leadview.php?id=<?php echo $encoded_id; ?>" target="_blank">
                                                                <i class="fa-solid fa-eye text-success"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $slno++;
                                                }
                                            }
                                        }
                                        // If no follow-up records found in total, display "No follow-up records" row
                                        if ($slno === 1) {
                                            echo "<tr><td colspan='5' class='text-center'>No follow-up records found</td></tr>";
                                        }

                                    } else {
                                        // If no leads found
                                        echo "<tr><td colspan='5' class='text-center'>No leads found</td></tr>";
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>

</html>