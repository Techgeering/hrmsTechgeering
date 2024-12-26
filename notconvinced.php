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
    <link href="assets/css/styles.css?v=1.2" rel="stylesheet" />
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
                        <h2 class="my-2">Not Convinced List</h2>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl.No</th>
                                        <th>Date</th>
                                        <th>Lead Name</th>
                                        <th>Company Name</th>
                                        <th>Mobile Number</th>
                                        <th>Email Id</th>
                                        <th>City</th>
                                        <th>Website</th>
                                        <th>Source</th>
                                        <th>Intersted for</th>
                                        <th>Last Followup Date</th>
                                        <th>Next Followup Date</th>
                                        <th>Status</th>
                                        <th>Not Convinced</th>
                                        <th>Renew</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM leads WHERE status1 = '0'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        $slno = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            $encoded_id = base64_encode($row['id']);
                                            ?>
                                            <tr>
                                                <td><?php echo $slno; ?></td>
                                                <td><?php echo $row["add_date"]; ?></td>
                                                <td><?php echo $row["lead_name"]; ?></td>
                                                <td><?php echo $row["companyname"]; ?></td>
                                                <td><?php echo $row["phone_no1"]; ?></td>
                                                <td><?php echo $row["email_id1"]; ?></td>
                                                <td><?php echo $row["city"]; ?></td>
                                                <td><?php echo $row["websitee"]; ?></td>
                                                <td><?php echo $row["source"]; ?></td>
                                                <td><?php echo $row["interested_in"]; ?></td>
                                                <td><?php echo $row["lastfollowupdate"]; ?></td>
                                                <td><?php echo $row["nextfollowupdate"]; ?></td>
                                                <td>
                                                    <?php if ($row['status'] == 6): ?>
                                                        <span style="color: gray;">
                                                            <?php
                                                            switch ($row['status']) {
                                                                case 1:
                                                                    echo "Requirement Understanding";
                                                                    break;
                                                                case 2:
                                                                    echo "Proposal Sent";
                                                                    break;
                                                                case 3:
                                                                    echo "MOU Signed";
                                                                    break;
                                                                case 4:
                                                                    echo "Customer";
                                                                    break;
                                                                default:
                                                                    echo "Unknown status";
                                                                    break;
                                                            }
                                                            ?>
                                                        </span>
                                                    <?php elseif ($row['status1'] == 0): ?>
                                                        <span style="color: gray;">
                                                            <?php
                                                            switch ($row['status']) {
                                                                case 1:
                                                                    echo "Requirement Understanding";
                                                                    break;
                                                                case 2:
                                                                    echo "Proposal Sent";
                                                                    break;
                                                                case 3:
                                                                    echo "MOU Signed";
                                                                    break;
                                                                case 4:
                                                                    echo "Customer";
                                                                    break;
                                                                default:
                                                                    echo "Unknown status";
                                                                    break;
                                                            }
                                                            ?>
                                                        </span>
                                                    <?php else: ?>
                                                        <button <?php if ($row['status'] != 4): ?>
                                                                onclick="confirmAction(<?php echo $row['id']; ?>, '<?php echo $row['status']; ?>')"
                                                            <?php endif; ?>
                                                            style="background-color: green; color: white; border: none; padding: 2px 10px; border-radius: 5px;">
                                                            <?php
                                                            switch ($row['status']) {
                                                                case 1:
                                                                    echo "Requirement Understanding";
                                                                    break;
                                                                case 2:
                                                                    echo "Proposal Sent";
                                                                    break;
                                                                case 3:
                                                                    echo "MOU Signed";
                                                                    break;
                                                                case 4:
                                                                    echo "Customer";
                                                                    break;
                                                                default:
                                                                    echo "Unknown status";
                                                                    break;
                                                            }
                                                            ?>
                                                        </button>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($row['status'] != 6): ?>
                                                        <?php if ($row['status1'] == 0): ?>
                                                            <span style="color: red;">Not Convinced</span>
                                                        <?php elseif ($row['status1'] == 1): ?>
                                                            <button onclick="confirmAction(<?php echo $row['id']; ?>, 'inactive')"
                                                                style="background-color: red; color: white; border: none; padding: 2px 10px; border-radius: 5px;">
                                                                Not Convinced
                                                            </button>
                                                        <?php else: ?>
                                                            <button onclick="confirmAction(<?php echo $row['id']; ?>, 'inactive')"
                                                                style="background-color: red; color: white; border: none; padding: 2px 10px; border-radius: 5px;">
                                                                Not Convinced
                                                            </button>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($row['status1'] == 0): ?>
                                                        <button onclick="confirmAction1(<?php echo $row['id']; ?>, '0')"
                                                            style="background-color: green; color: white; border: none; padding: 2px 10px; border-radius: 5px;">
                                                            Renew
                                                        </button>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="leadview.php?id=<?php echo $encoded_id; ?>" target="_blank">
                                                        <i class="fa-solid fa-eye text-success"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                            $slno++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>0 results</td></tr>";
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
    <script src="assets/js/scripts.js?v=1.3"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>

    <script>
        $(function () {
            $("#datatablesSimple").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>

</html>