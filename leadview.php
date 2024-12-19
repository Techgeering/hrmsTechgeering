<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$em_role = isset($_SESSION["em_role"]) ? $_SESSION["em_role"] : '';

include "common/conn.php";

$leadId = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : null);
$leadId = trim(base64_decode($leadId));

$encodedLeadId = base64_encode($leadId);


if ($leadId != null) {
    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM leads WHERE id = ?");
    $stmt->bind_param("i", $leadId);
    $stmt->execute();
    $result1 = $stmt->get_result();

    if ($result1 && $row1 = $result1->fetch_assoc()) {
        $id = $row1["id"];
        $leaddate = !empty($row1["add_date"]) ? htmlspecialchars($row1["add_date"]) : 'N/A';
        $leadname = !empty($row1["lead_name"]) ? htmlspecialchars($row1["lead_name"]) : 'N/A';
        $company = !empty($row1["companyname"]) ? htmlspecialchars($row1["companyname"]) : 'N/A';
        $phone_no1 = !empty($row1["phone_no1"]) ? htmlspecialchars($row1["phone_no1"]) : 'N/A';
        $phone_no2 = !empty($row1["phone_no2"]) ? htmlspecialchars($row1["phone_no2"]) : 'N/A';
        $phone_no3 = !empty($row1["phone_no3"]) ? htmlspecialchars($row1["phone_no3"]) : 'N/A';
        $email_id1 = !empty($row1["email_id1"]) ? htmlspecialchars($row1["email_id1"]) : 'N/A';
        $email_id2 = !empty($row1["email_id2"]) ? htmlspecialchars($row1["email_id2"]) : 'N/A';
        $email_id3 = !empty($row1["email_id3"]) ? htmlspecialchars($row1["email_id3"]) : 'N/A';
        $city = !empty($row1["city"]) ? htmlspecialchars($row1["city"]) : 'N/A';
        $state = !empty($row1["state"]) ? htmlspecialchars($row1["state"]) : 'N/A';
        $country = !empty($row1["country"]) ? htmlspecialchars($row1["country"]) : 'N/A';
        $interested_in = !empty($row1["interested_in"]) ? htmlspecialchars($row1["interested_in"]) : 'N/A';
        $status = !empty($row1["status"]) ? htmlspecialchars($row1["status"]) : 'N/A';
        $status_text = ($status === '1') ? 'ACTIVE' : 'INACTIVE';
        $source = !empty($row1["source"]) ? htmlspecialchars($row1["source"]) : 'N/A';
        $website = !empty($row1["websitee"]) ? htmlspecialchars($row1["websitee"]) : 'N/A';
        $business_type = !empty($row1["business_type"]) ? htmlspecialchars($row1["business_type"]) : 'N/A';
        $remarks = !empty($row1["remarks"]) ? htmlspecialchars($row1["remarks"]) : 'N/A';
    }
    $stmt->close();
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
                        <?php if ($em_role == '1' || $em_role == '5') { ?>
                            <button type="button" class="btn btn-primary"
                                onclick="window.location.href='viewupdate_record.php?id=<?php echo $encodedLeadId; ?>'">
                                <i class="fa-solid fa-plus"></i> View Update Record
                            </button>
                        <?php } ?>
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
                                                <p class="form-control edit">
                                                    <?php echo $leadname; ?>
                                                </p>
                                                <input type="text" class='txtedit' value='<?php echo $leadname; ?>'
                                                    id='lead_name-<?php echo $id; ?>-leads-<?php echo $leadname; ?>'
                                                    style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Lead Date</label>
                                                <p class="form-control edit">
                                                    <?php echo $leaddate; ?>
                                                </p>
                                                <input type="date" class='txtedit' value='<?php echo $leaddate; ?>'
                                                    id='add_date-<?php echo $id; ?>-leads-<?php echo $leaddate; ?>'
                                                    style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">1st Phone Number</label>
                                                <p class="form-control edit">
                                                    <?php echo $phone_no1; ?>
                                                </p>
                                                <input type="text" class='txtedit' value='<?php echo $phone_no1; ?>'
                                                    id='phone_no1-<?php echo $id; ?>-leads-<?php echo $phone_no1; ?>'
                                                    style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Source</label>
                                                <p class="form-control edit">
                                                    <?php echo $source; ?>
                                                </p>
                                                <input type="text" class='txtedit' value='<?php echo $source; ?>'
                                                    id='source-<?php echo $id; ?>-leads-<?php echo $source; ?>'
                                                    style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">2nd Phone Number</label>
                                                <p class="form-control edit">
                                                    <?php echo $phone_no2; ?>
                                                </p>
                                                <input type="text" class='txtedit' value='<?php echo $phone_no2; ?>'
                                                    id='phone_no2-<?php echo $id; ?>-leads-<?php echo $phone_no2; ?>'
                                                    style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">3rd Phone Number</label>
                                                <p class="form-control edit">
                                                    <?php echo $phone_no3; ?>
                                                </p>
                                                <input type="text" class='txtedit' value='<?php echo $phone_no3; ?>'
                                                    id='phone_no3-<?php echo $id; ?>-leads-<?php echo $phone_no3; ?>'
                                                    style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">1st Email</label>
                                                <p class="form-control edit">
                                                    <?php echo $email_id1; ?>
                                                </p>
                                                <input type="text" class='txtedit' value='<?php echo $email_id1; ?>'
                                                    id='email_id1-<?php echo $id; ?>-leads-<?php echo $email_id1; ?>'
                                                    style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">2nd Email</label>
                                                <p class="form-control edit">
                                                    <?php echo $email_id2; ?>
                                                </p>
                                                <input type="text" class='txtedit' value='<?php echo $email_id2; ?>'
                                                    id='email_id2-<?php echo $id; ?>-leads-<?php echo $email_id2; ?>'
                                                    style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">3rd Email</label>
                                                <p class="form-control edit">
                                                    <?php echo $email_id3; ?>
                                                </p>
                                                <input type="text" class='txtedit' value='<?php echo $email_id3; ?>'
                                                    id='email_id3-<?php echo $id; ?>-leads-<?php echo $email_id3; ?>'
                                                    style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">City</label>
                                                <p class="form-control edit">
                                                    <?php echo $city; ?>
                                                </p>
                                                <input type="text" class='txtedit' value='<?php echo $city; ?>'
                                                    id='city-<?php echo $id; ?>-leads-<?php echo $city; ?>'
                                                    style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">State</label>
                                                <p class="form-control edit">
                                                    <?php echo $state; ?>
                                                </p>
                                                <input type="text" class='txtedit' value='<?php echo $state; ?>'
                                                    id='state-<?php echo $id; ?>-leads-<?php echo $state; ?>'
                                                    style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Country</label>
                                                <p class="form-control edit">
                                                    <?php echo $country; ?>
                                                </p>
                                                <input type="text" class='txtedit' value='<?php echo $country; ?>'
                                                    id='country-<?php echo $id; ?>-leads-<?php echo $country; ?>'
                                                    style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Company Name</label>
                                                <p class="form-control edit">
                                                    <?php echo $company; ?>
                                                </p>
                                                <input type="text" class='txtedit' value='<?php echo $company; ?>'
                                                    id='companyname-<?php echo $id; ?>-leads-<?php echo $company; ?>'
                                                    style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Business Type</label>
                                                <p class="form-control edit">
                                                    <?php echo $business_type; ?>
                                                </p>
                                                <input type="text" class='txtedit' value='<?php echo $business_type; ?>'
                                                    id='business_type-<?php echo $id; ?>-leads-<?php echo $business_type; ?>'
                                                    style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Website</label>
                                                <p class="form-control edit">
                                                    <?php echo $website; ?>
                                                </p>
                                                <input type="text" class='txtedit' value='<?php echo $website; ?>'
                                                    id='websitee-<?php echo $id; ?>-leads-<?php echo $website; ?>'
                                                    style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Interested In</label>
                                                <p class="form-control edit">
                                                    <?php echo $interested_in; ?>
                                                </p>
                                                <input type="text" class='txtedit' value='<?php echo $interested_in; ?>'
                                                    id='interested_in-<?php echo $id; ?>-leads-<?php echo $interested_in; ?>'
                                                    style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name">Remarks</label>
                                                <textarea class="form-control edit">
                                                    <?php echo $remarks; ?>
                                                </textarea>
                                                <textarea class='txtedit'
                                                    id='remarks-<?php echo $id; ?>-leads-<?php echo htmlspecialchars($remarks); ?>'
                                                    style="display:none; width:100% !important; height:150px !important;"><?php echo htmlspecialchars(trim($remarks)); ?>
                                                </textarea>
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
                                                        <td><?php echo html_entity_decode($row2["message"]); ?></td>
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
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($leadId); ?>">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- for edit the field -->
    <script>
        $(document).ready(function () {
            $(document).on('click', '.edit', function () {
                var txtEdit = $(this).next('.txtedit');
                var editText = $(this);
                txtEdit.show().focus();
                editText.hide();
                txtEdit.focusout(function () {
                    var field_name = txtEdit.attr('id').split("-")[0];
                    var edit_id = txtEdit.attr('id').split("-")[1];
                    var table_name = txtEdit.attr('id').split("-")[2];
                    var old_name = txtEdit.attr('id').split("-")[3];

                    var value = txtEdit.val();
                    console.log("Field:", field_name, "ID:", edit_id, "Table:", table_name,
                        "Value:", value);
                    if (value !== null && value.trim() !== '') {
                        var pattern = txtEdit.attr('pattern');
                        if (pattern) {
                            var regex = new RegExp(pattern);
                            if (!regex.test(value)) {
                                alert('Invalid pattern. Please enter a valid value.');
                                return;
                            }
                        }
                    }
                    editText.show();
                    editText.text(value);
                    txtEdit.hide();
                    $.ajax({
                        url: 'update_record.php',
                        type: 'post',
                        data: {
                            field: field_name,
                            value: value,
                            id: edit_id,
                            tbnm: table_name,
                            oldnm: old_name
                        },
                        success: function (response) {
                            console.log("AJAX response:", response);
                            if (response == 1) {
                                console.log('Save Successfully');
                            } else {
                                console.log('Not Saved');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("AJAX error:", status, error);
                        }
                    });
                });
            });
        });
    </script>

</body>
<?php
include "common/conn.php";
if (isset($_POST['submit'])) {
    $startdate = date('Y-m-d H:i:s');
    $nextdate = date('Y-m-d H:i:s', strtotime($_POST["nextdate"]));
    $message = htmlspecialchars($_POST["message"]);
    $leadIdfrom = $_POST["id"];
    $encodedLeadId = base64_encode($leadIdfrom);
    // echo "<script>alert($leadIdfrom)</script>";
    $sql = "INSERT INTO lead_follow (lead_id, start_date, next_date, message)
        VALUES ('$leadIdfrom', '$startdate', '$nextdate', '$message')";

    if ($conn->query($sql) === TRUE) {
        include "common/conn.php";
        // header("Location: leadview.php?id=" . $leadId);
        $sql10 = "UPDATE leads SET lastfollowupdate='$startdate' , nextfollowupdate='$nextdate' WHERE id='$leadIdfrom'";
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