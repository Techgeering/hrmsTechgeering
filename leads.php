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
                        <h2 class="my-2">Leads</h2>
                        <?php if ($em_role == '1' || $em_role == '5') { ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                                <i class="fa-solid fa-plus"></i> Leads
                            </button>
                        <?php } ?>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Date</th>
                                        <th>Lead Name</th>
                                        <th>Company Name</th>
                                        <th>1st Phone Number</th>
                                        <th>2nd Phone Number</th>
                                        <th>3rd Phone Number</th>
                                        <th>1st Email Id</th>
                                        <th>2nd Email Id</th>
                                        <th>3rd Email Id</th>
                                        <th>city</th>
                                        <th>Website</th>
                                        <th>Intersted for</th>
                                        <th>Last Followup Date</th>
                                        <th>Next Followup Date</th>
                                        <th>Status</th>
                                        <th>Rejected</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM leads ORDER BY (status1 = 0) + (status = 6), status1";
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
                                                <td><?php echo $row["phone_no2"]; ?></td>
                                                <td><?php echo $row["phone_no3"]; ?></td>
                                                <td><?php echo $row["email_id1"]; ?></td>
                                                <td><?php echo $row["email_id2"]; ?></td>
                                                <td><?php echo $row["email_id3"]; ?></td>
                                                <td><?php echo $row["city"]; ?></td>
                                                <td><?php echo $row["websitee"]; ?></td>
                                                <td><?php echo $row["interested_in"]; ?></td>
                                                <td><?php echo $row["lastfollowupdate"]; ?></td>
                                                <td><?php echo $row["nextfollowupdate"]; ?></td>
                                                <td>
                                                    <?php if ($row['status'] == 6): ?>
                                                        <span style="color: gray;">
                                                            <?php
                                                            switch ($row['status']) {
                                                                case 1:
                                                                    echo "1st Stage";
                                                                    break;
                                                                case 2:
                                                                    echo "Proposal Send";
                                                                    break;
                                                                case 3:
                                                                    echo "Proposal After Discussion";
                                                                    break;
                                                                case 4:
                                                                    echo "Price Finalization";
                                                                    break;
                                                                case 5:
                                                                    echo "MOU Signed";
                                                                    break;
                                                                case 6:
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
                                                                    echo "1st Stage";
                                                                    break;
                                                                case 2:
                                                                    echo "Proposal Send";
                                                                    break;
                                                                case 3:
                                                                    echo "Proposal After Discussion";
                                                                    break;
                                                                case 4:
                                                                    echo "Price Finalization";
                                                                    break;
                                                                case 5:
                                                                    echo "MOU Signed";
                                                                    break;
                                                                case 6:
                                                                    echo "Customer";
                                                                    break;
                                                                default:
                                                                    echo "Unknown status";
                                                                    break;
                                                            }
                                                            ?>
                                                        </span>
                                                    <?php else: ?>
                                                        <button
                                                            onclick="confirmAction(<?php echo $row['id']; ?>, '<?php echo $row['status']; ?>')"
                                                            style="background-color: green; color: white; border: none; padding: 2px 10px; border-radius: 5px;">
                                                            <?php
                                                            switch ($row['status']) {
                                                                case 1:
                                                                    echo "1st Stage";
                                                                    break;
                                                                case 2:
                                                                    echo "Proposal Send";
                                                                    break;
                                                                case 3:
                                                                    echo "Proposal After Discussion";
                                                                    break;
                                                                case 4:
                                                                    echo "Price Finalization";
                                                                    break;
                                                                case 5:
                                                                    echo "MOU Signed";
                                                                    break;
                                                                case 6:
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
                                                                Rejected
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
                                                    <a href="leadview.php?id=<?php echo $encoded_id; ?>"><i
                                                            class="fa-solid fa-eye text-success"></i></a>
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
    <!-- Modal -->
    <div class="modal fade" id="addDept" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Add Leads</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="leadname" class="form-label">Lead Name</label>
                                    <input type="text" class="form-control" id="leadname" name="leadname">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="companyname" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" id="companyname" name="companyname">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="source" class="form-label">Source</label>
                                    <input type="text" class="form-control" id="source" name="source">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="phoneno" class="form-label">1st Phone Number</label>
                                    <input type="text" class="form-control" id="phoneno" name="phoneno1"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="phoneno" class="form-label">2nd Phone Number</label>
                                    <input type="text" class="form-control" id="phoneno" name="phoneno2"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="phoneno" class="form-label">3rd Phone Number</label>
                                    <input type="text" class="form-control" id="phoneno" name="phoneno3"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="email" class="form-label">1st Email Id</label>
                                    <input type="email" class="form-control" id="email" name="email1">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="email" class="form-label">2nd Email Id</label>
                                    <input type="email" class="form-control" id="email" name="email2">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="email" class="form-label">3rd Email Id</label>
                                    <input type="email" class="form-control" id="email" name="email3">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country" name="country">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="intersted" class="form-label">Intersted</label>
                                    <input type="text" class="form-control" id="intersted" name="interested">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="bussinesstype" class="form-label">Bussiness Type</label>
                                    <input type="text" class="form-control" id="bussinesstype" name="bussinesstype">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="bussinesstype" class="form-label">Website</label>
                                    <input type="text" class="form-control" id="website" name="website">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label for="remarks" class="form-label">Remarks</label>
                                    <textarea class="form-control" id="remarks" name="remarks" rows="4"></textarea>
                                </div>
                            </div>
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <?php
    include "common/conn.php";
    if (isset($_POST['submit'])) {
        $datee = date("Y-m-d");
        $leadname = htmlspecialchars($_POST["leadname"]);
        $companyname = htmlspecialchars($_POST["companyname"]);
        $phoneno1 = $_POST["phoneno1"];
        $phoneno2 = $_POST["phoneno2"];
        $phoneno3 = $_POST["phoneno3"];
        $email1 = $_POST["email1"];
        $email2 = $_POST["email2"];
        $email3 = $_POST["email3"];
        $city = htmlspecialchars($_POST["city"]);
        $state = htmlspecialchars($_POST["state"]);
        $country = htmlspecialchars($_POST["country"]);
        $source = htmlspecialchars($_POST["source"]);
        $website = htmlspecialchars($_POST["website"]);
        $interested = htmlspecialchars($_POST["interested"]);
        $bussinesstype = htmlspecialchars($_POST["bussinesstype"]);
        $remarks = htmlspecialchars($_POST["remarks"]);
        $currentDateTime = date('Y-m-d H:i:s');

        // Check if the phone number already exists
        $checkQuery = "SELECT * FROM leads WHERE phone_no1 = '$phoneno1' OR phone_no2 = '$phoneno1' OR phone_no3 = '$phoneno1' OR phone_no1 = '$phoneno1' OR phone_no2 = '$phoneno2' OR phone_no3 = '$phoneno2' OR phone_no1 = '$phoneno3' OR phone_no2 = '$phoneno3' OR phone_no3 = '$phoneno3' OR lead_name = '$leadname'";
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {
            echo "<script>alert('Either phone number or Lead name is already associated with a lead.');</script>";
        } else {
            // Insert if no existing record is found
            $sql = "INSERT INTO leads (add_date, lead_name, companyname, phone_no1, phone_no2, phone_no3, email_id1, email_id2, email_id3, city, state, country, source, websitee, interested_in, business_type, status, status1, lead_date, remarks)
        VALUES ('$datee','$leadname', '$companyname', '$phoneno1', '$phoneno2', '$phoneno3', '$email1', '$email2', '$email3', '$city', '$state', '$country', '$source', '$website', '$interested', '$bussinesstype', '1', '1', '$currentDateTime', '$remarks')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        $conn->close();
    }
    ?>

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