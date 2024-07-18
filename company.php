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
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="my-2">Company</h1>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                            <i class="fa-solid fa-plus"></i> Company
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl.No</th>
                                        <th class="text-center">Company Name</th>
                                        <th class="text-center">Phone Number</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center">GST Number</th>
                                        <th class="text-center">State</th>
                                        <th class="th-sm">Manage</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">Sl.No</th>
                                        <th class="text-center">Company Name</th>
                                        <th class="text-center">Phone Number</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center">GST Number</th>
                                        <th class="text-center">State</th>
                                        <th class="th-sm">Manage</th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM company";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <th><?php echo $row["id"]; ?></th>
                                                <th><?php echo $row["comp_name"]; ?></th>
                                                <th><?php echo $row["comp_mob"]; ?></th>
                                                <th><?php echo $row["comp_email"]; ?></th>
                                                <th><?php echo $row["gst_no"]; ?></th>
                                                <th><?php echo $row["comp_address"]; ?></th>
                                                <th><?php echo $row["state"]; ?></th>
                                                <th>
                                                    <i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i>
                                                    
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
    <!-- Modal -->
    <div class="modal fade" id="addDept" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Add Company</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="CompanyName">Company Name</label>
                            <input type="text" class="form-control" name="company" id="CompanyName">
                        </div>
                        <div class="form-group">
                            <label for="compMob">Mobile Number</label>
                            <input type="text" class="form-control" name="compmob" id="compMob">
                        </div>
                        <div class="form-group">
                            <label for="email">Email ID</label>
                            <input type="text" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="gst">GST No.</label>
                            <input type="text" class="form-control" name="gst" id="gst">
                        </div>
                        <div class="form-group">
                            <label for="Address">Address</label>
                            <textarea class="form-control" name="address" id="Address" row="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="State">State</label>
                            <input type="text" class="form-control" name="state" id="State">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include "common/conn.php";
    if (isset($_POST['submit'])) {
        $company = $_POST["company"];
        $compmob = $_POST["compmob"];
        $email = $_POST["email"];
        $gst = $_POST["gst"];
        $Address = $_POST["Address"];
        $state = $_POST["state"];

        $sql = "INSERT INTO company (comp_name, comp_mob, comp_email, comp_address, gst_no, state)
                    VALUES ('$company', '$compmob', '$email','$Address', '$gst', '$state')";

        if ($conn->query($sql) === TRUE) {
            echo " <script>alert('success')</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>