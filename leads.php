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
                        <?php if ($em_role == '1') { ?>
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
                                        <th>Lead Name</th>
                                        <th>Company Name</th>
                                        <th>Phone</th>
                                        <th>city</th>
                                        <th>Intersted for</th>
                                        <th>Last Followup Date</th>
                                        <th>Next Followup Date</th>
                                        <th>Status</th>
                                        <th>View</th>
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
                                            $encoded_id = base64_encode($row['id']);
                                            ?>
                                            <tr>
                                                <th><?php echo $slno; ?></th>
                                                <td><?php echo $row["lead_name"]; ?></td>
                                                <td><?php echo $row["companyname"]; ?></td>
                                                <td><?php echo $row["phone_no"]; ?></td>
                                                <td><?php echo $row["city"]; ?></td>
                                                <td><?php echo $row["interested_in"]; ?></td>
                                                <td><?php echo $row["lastfollowupdate"]; ?></td>
                                                <td><?php echo $row["nextfollowupdate"]; ?></td>
                                                <td><?php echo $row["status"]; ?></td>
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
                                    <input type="text" class="form-control" id="leadname" name="leadname" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="companyname" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" id="companyname" name="companyname"
                                        required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="phoneno" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phoneno" name="phoneno" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="email" class="form-label">Email Id</label>
                                    <input type="text" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country" name="country" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="source" class="form-label">Source</label>
                                    <input type="text" class="form-control" id="source" name="source" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="intersted" class="form-label">Intersted</label>
                                    <input type="text" class="form-control" id="intersted" name="interested" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="bussinesstype" class="form-label">Bussiness Type</label>
                                    <input type="text" class="form-control" id="bussinesstype" name="bussinesstype"
                                        required>
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
        $leadname = $_POST["leadname"];
        $companyname = $_POST["companyname"];
        $phoneno = $_POST["phoneno"];
        $email = $_POST["email"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $country = $_POST["country"];
        $source = $_POST["source"];
        $interested = $_POST["interested"];
        $bussinesstype = $_POST["bussinesstype"];
        $currentDateTime = date('Y-m-d H:i:s');

        $sql = "INSERT INTO leads (lead_name, companyname, phone_no, email_id, city, state, country, source, interested_in, business_type, status, lead_date)
        VALUES ('$leadname', '$companyname', '$phoneno', '$email', '$city', '$state', '$country', '$source', '$interested', '$bussinesstype', '1', '$currentDateTime')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    ?>

</body>

</html>