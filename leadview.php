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
                        <h2 class="my-2">Single Lead view</h2>
                        <?php if ($em_role == '1') { ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                                <i class="fa-solid fa-plus"></i> Leads
                            </button>
                        <?php }
                        include "common/conn.php";
                        $leadId = $_GET['id'];
                        $sql = "SELECT * FROM leads WHERE id = $leadId";
                        $result = $conn->query($sql);
                        $row1 = $result->fetch_assoc();
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Lead Name</label>
                                                <p class="form-control"> <?php echo $row1["lead_name"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Company Name</label>
                                                <p class="form-control"><?php echo $row1["companyname"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Phone</label>
                                                <p class="form-control"><?php echo $row1["phone_no"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Email</label>
                                                <p class="form-control"><?php echo $row1["email_id"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">city</label>
                                                <p class="form-control"><?php echo $row1["city"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">State</label>
                                                <p class="form-control"><?php echo $row1["state"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Intersted for</label>
                                                <p class="form-control"><?php echo $row1["interested_in"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Status</label>
                                                <p class="form-control"><?php echo $row1["status"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Source</label>
                                                <p class="form-control"><?php echo $row1["source"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Business Type</label>
                                                <p class="form-control"><?php echo $row1["business_type"]; ?></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <table id="example23"
                                        class="display nowrap table table-hover table-striped table-bordered"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Last followup Date</th>
                                                <th>Message</th>
                                                <th>Next Followup Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql2 = "SELECT * FROM  lead_follow WHERE lead_id = $leadId ORDER BY start_date DESC";
                                            $result2 = $conn->query($sql2);
                                            if ($result2->num_rows > 0) {
                                                while ($row2 = $result2->fetch_assoc()) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row2["start_date"]; ?></td>
                                                        <td><?php echo $row2["meaasge"]; ?> </td>
                                                        <td><?php echo $row2["next_date"]; ?></td>
                                                    </tr>
                                                <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
                    <h1 class="modal-title fs-5" id="addDeptLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="startdate" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="startdate" name="startdate" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="nextdate" class="form-label">Next Date</label>
                                    <input type="date" class="form-control" id="nextdate" name="nextdate" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label for="message" class="form-label">Message</label>
                                    <input type="text" class="form-control" name="message" id="message" required>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <?php
    include "common/conn.php";
    if (isset($_POST['submit'])) {
        $leadId = $_GET['id'];
        $startdate = $_POST["startdate"];
        $nextdate = $_POST["nextdate"];
        $message = $_POST["message"];
        $sql = "INSERT INTO lead_follow (lead_id, start_date, next_date, meaasge)
        VALUES ('$leadId', '$startdate', '$nextdate', '$message')";
        if ($conn->query($sql) === TRUE) {
            header("Location: leadview.php?id=$leadId");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    ?>
</body>

</html>