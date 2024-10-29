<?php
session_start();
$em_role = isset($_SESSION["em_role"]) ? $_SESSION["em_role"] : '';

include "common/conn.php";

$leadId = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : null);
$leadId = trim(base64_decode($leadId));


if ($leadId != null) {
    $sql1 = "SELECT * FROM leads WHERE id = $leadId";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
    $leadname = htmlspecialchars($row1["lead_name"] ?? 'N/A');
    $company = htmlspecialchars($row1["companyname"] ?? 'N/A');
    $phone_no = htmlspecialchars($row1["phone_no"] ?? 'N/A');
    $email_id = htmlspecialchars($row1["email_id"] ?? 'N/A');
    $city = htmlspecialchars($row1["city"] ?? 'N/A');
    $state = htmlspecialchars($row1["state"] ?? 'N/A');
    $interested_in = htmlspecialchars($row1["interested_in"] ?? 'N/A');
    $status = htmlspecialchars($row1["status"] ?? 'N/A');
    $status_text = ($status == '1') ? 'ACTIVE' : 'INACTIVE';
    echo $status_text;
    $source = htmlspecialchars($row1["source"] ?? 'N/A');
    $business_type = htmlspecialchars($row1["business_type"] ?? 'N/A');
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
    <title>Single Lead View - Hrms Techgeering</title>
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
                        <h2 class="my-2">Single Lead View</h2>
                        <?php if ($em_role == '1' || $em_role == '5') { ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                                <i class="fa-solid fa-plus"></i> Add Follow-Up
                            </button>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Lead Name</label>
                                                <p class="form-control">
                                                    <?php echo $leadname; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Company Name</label>
                                                <p class="form-control">
                                                    <?php echo $company; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Phone</label>
                                                <p class="form-control">
                                                    <?php echo $phone_no; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Email</label>
                                                <p class="form-control">
                                                    <?php echo $email_id; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">City</label>
                                                <p class="form-control">
                                                    <?php echo $city; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">State</label>
                                                <p class="form-control">
                                                    <?php echo $state; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Interested In</label>
                                                <p class="form-control">
                                                    <?php echo $interested_in; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Status</label>
                                                <p class="form-control">
                                                    <?php echo $status_text; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Source</label>
                                                <p class="form-control">
                                                    <?php echo $source; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Business Type</label>
                                                <p class="form-control">
                                                    <?php echo $business_type; ?>
                                                </p>
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
                                                <th>Last Follow-up Date</th>
                                                <th>Message</th>
                                                <th>Next Follow-up Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare("SELECT * FROM lead_follow WHERE lead_id = ? ORDER BY start_date DESC");
                                            $stmt->bind_param("i", $leadId);
                                            $stmt->execute();
                                            $result2 = $stmt->get_result();
                                            if ($result2->num_rows > 0) {
                                                while ($row2 = $result2->fetch_assoc()) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($row2["start_date"]); ?></td>
                                                        <td><?php echo htmlspecialchars($row2["message"]); ?> </td>
                                                        <td><?php echo htmlspecialchars($row2["next_date"]); ?></td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr>
                                                    <td colspan="3">No follow-up records found.</td>
                                                </tr>
                                            <?php } ?>
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
                    <h1 class="modal-title fs-5" id="addDeptLabel">Add Follow-Up</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="text" name="id" value="<?php echo htmlspecialchars($leadId); ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-2">
                                    <label for="nextdate" class="form-label">Next Date and Time</label>
                                    <input type="datetime-local" class="form-control" id="nextdate" name="nextdate"
                                        required>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>
<?php
include "common/conn.php";
if (isset($_POST['submit'])) {
    $startdate = date('Y-m-d H:i:s');
    $nextdate = date('Y-m-d H:i:s', strtotime($_POST["nextdate"]));
    $message = $_POST["message"];
    $leadId = $_POST["id"];
    $encodedLeadId = base64_encode($leadId);
    $sql = "INSERT INTO lead_follow (lead_id, start_date, next_date, message)
        VALUES ('$leadId', '$startdate', '$nextdate', '$message')";

    if ($conn->query($sql) === TRUE) {
        include "common/conn.php";
        // header("Location: leadview.php?id=" . $leadId);
        $sql10 = "UPDATE leads SET lastfollowupdate='$startdate' , nextfollowupdate='$nextdate' WHERE id='$leadId'";
        if ($conn->query($sql10) === TRUE) {
            echo "<script>window.location.href='leadview.php?id=$encodedLeadId';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}
?>

</html>