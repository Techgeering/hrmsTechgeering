<?php
session_start();
$em_role = isset($_SESSION["em_role"]) ? $_SESSION["em_role"] : '';

include "common/conn.php";

$internId = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : null);
$internId = trim(base64_decode($internId));


if ($internId != null) {
    $sql1 = "SELECT * FROM leads WHERE id = $internId";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
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
                        <h2 class="my-2">Follow-Up</h2>
                        <?php if ($em_role == '1' || $em_role == '5') { ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                                <i class="fa-solid fa-plus"></i> Add Follow-Up
                            </button>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-12">
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
                                            $stmt = $conn->prepare("SELECT * FROM intern_follow WHERE intern_id = ? ORDER BY start_date DESC");
                                            $stmt->bind_param("i", $internId);
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
                    <input type="text" name="id" value="<?php echo htmlspecialchars($internId); ?>">
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
    $internId = $_POST["id"];
    $encodedinternId = base64_encode($internId);
    $sql = "INSERT INTO intern_follow (intern_id, start_date, next_date, message)
        VALUES ('$internId', '$startdate', '$nextdate', '$message')";

    if ($conn->query($sql) === TRUE) {
        include "common/conn.php";
        // header("Location: leadview.php?id=" . $leadId);
        $sql10 = "UPDATE intern_request SET lastfollow='$startdate' , nextfollow='$nextdate' WHERE id='$internId'";
        if ($conn->query($sql10) === TRUE) {
            echo "<script>window.location.href='intern_requestview.php?id=$encodedinternId';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}
?>

</html>