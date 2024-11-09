<?php
session_start(); {
    $em_role = $_SESSION["em_role"];
    $emp_id = $_SESSION["emp_id"];
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
    <title>Dashboard - Hrms Techgeering</title>
    <link rel="icon" type="image/png" href="assets/img/favicon-t.png">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css?v=<?php echo time(); ?>" rel="stylesheet" />
    <link href="assets/css/style1.css?v=<?php echo time(); ?>" rel="stylesheet" />
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
        <!-- start body content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="my-2">Dashboard</h1>
                    <div class="page-wrapper mdc-toolbar-fixed-adjust">
                        <main class="content-wrapper">
                            <div class="mdc-layout-grid">
                                <div class="mdc-layout-grid__inner">
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                                        <div class="mdc-card info-card info-card--success">
                                            <div class="card-inner">
                                                <h5 class="card-title">Total Projects</h5>
                                                <h5 class="font-weight-light pb-2 mb-1 border-bottom">
                                                    <?php
                                                    include "common/conn.php";
                                                    if ($conn) {
                                                        $query = "SELECT COUNT(*) as rowCount FROM project ";
                                                        $result = mysqli_query($conn, $query);
                                                        if ($result) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            echo isset($row['rowCount']) ? $row['rowCount'] : 0;
                                                        } else {
                                                            echo "Error executing query: " . mysqli_error($conn);
                                                        }

                                                        mysqli_close($conn);
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?>
                                                </h5>
                                                <p class="tx-12 text-muted">
                                                    <?php
                                                    include "common/conn.php";
                                                    if ($conn) {
                                                        $sql = "SELECT COUNT(DISTINCT p.id) AS completedProjectCount
                                                                FROM assign_task AS a
                                                                JOIN project AS p ON a.project_id = p.id
                                                                WHERE a.assign_user = '$emp_id'
                                                                AND a.user_type = 'Collaborators'
                                                                AND p.pro_status = 'complete'
                                                            ";
                                                        $result = $conn->query($sql);

                                                        if ($result && $result->num_rows > 0) {
                                                            $row = $result->fetch_assoc();
                                                            echo $row['completedProjectCount'] . " Completed";
                                                        } else {
                                                            echo "No assigned projects found.";
                                                        }
                                                        $conn->close();
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?>
                                                </p>
                                                <div class="card-icon-wrapper">
                                                    <i class="material-icons"><i class="fa fa-list-alt text-white fs-2"
                                                            aria-hidden="true"></i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                                        <div class="mdc-card info-card info-card--danger">
                                            <div class="card-inner">
                                                <h5 class="card-title">Ongoing & Hold</h5>
                                                <h5 class="font-weight-light pb-2 mb-1 border-bottom">
                                                    <?php
                                                    include "common/conn.php";
                                                    if ($conn) {
                                                        $query = "SELECT COUNT(*) as rowCount FROM project WHERE pro_status IN ('running', 'hold')";
                                                        $result = mysqli_query($conn, $query);
                                                        if ($result) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            echo isset($row['rowCount']) ? $row['rowCount'] : 0;
                                                        } else {
                                                            echo "Error executing query: " . mysqli_error($conn);
                                                        }
                                                        mysqli_close($conn);
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?>
                                                </h5>
                                                <p class="tx-12 text-muted">
                                                    <?php
                                                    include "common/conn.php";
                                                    if ($conn) {
                                                        $sql = "SELECT COUNT(DISTINCT p.id) AS holdProjectCount
                                                                FROM assign_task AS a
                                                                JOIN project AS p ON a.project_id = p.id
                                                                WHERE a.assign_user = '$emp_id'
                                                                AND a.user_type = 'Collaborators'
                                                                AND p.pro_status = 'hold'
                                                            ";
                                                        $result = $conn->query($sql);

                                                        if ($result && $result->num_rows > 0) {
                                                            $row = $result->fetch_assoc();
                                                            echo $row['holdProjectCount'];
                                                        } else {
                                                            echo "No assigned projects found.";
                                                        }
                                                        $conn->close();
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?> Hold
                                                </p>
                                                <div class="card-icon-wrapper">
                                                    <i class="material-icons"><i class="fa fa-usd text-white fs-2"
                                                            aria-hidden="true"></i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                                        <div class="mdc-card info-card info-card--primary">
                                            <div class="card-inner">
                                                <h5 class="card-title">Total Holidays</h5>
                                                <h5 class="font-weight-light pb-2 mb-1 border-bottom">
                                                    <?php
                                                    include "common/conn.php";
                                                    if ($conn) {
                                                        $query = "SELECT SUM(number_of_days) as totalDays FROM holiday";
                                                        $result = mysqli_query($conn, $query);
                                                        if ($result) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            echo isset($row['totalDays']) ? $row['totalDays'] : 0;
                                                        } else {
                                                            echo "Error executing query: " . mysqli_error($conn);
                                                        }
                                                        mysqli_close($conn);
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?>
                                                </h5>
                                                <p class="tx-12 text-muted">
                                                    <a href="holiday.php" class="text-muted">Go to Holiday Page</a>
                                                </p>
                                                <div class="card-icon-wrapper">
                                                    <i class="material-icons"><i
                                                            class="fa fa-line-chart text-white fs-2"
                                                            aria-hidden="true"></i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                                        <div class="mdc-card info-card info-card--info">
                                            <div class="card-inner">
                                                <h5 class="card-title">Total Leave Days</h5>
                                                <h5 class="font-weight-light pb-2 mb-1 border-bottom">
                                                    <?php
                                                    include "common/conn.php";
                                                    if ($conn) {
                                                        $query = "SELECT SUM(leave_day) as totalDays FROM leave_types";
                                                        $result = mysqli_query($conn, $query);
                                                        if ($result) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            echo isset($row['totalDays']) ? $row['totalDays'] : 0;
                                                        } else {
                                                            echo "Error executing query: " . mysqli_error($conn);
                                                        }
                                                        mysqli_close($conn);
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?>
                                                </h5>
                                                <p class="tx-12 text-muted">
                                                    <a href="leaveType.php" class="text-muted">Go to Leavetype Page</a>
                                                </p>
                                                <div class="card-icon-wrapper">
                                                    <i class="material-icons"><i class="fa fa-briefcase text-white fs-2"
                                                            aria-hidden="true"></i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                                        <div class="mdc-card info-card info-card--info">
                                            <div class="card-inner">
                                                <h5 class="card-title">Taken Leave</h5>
                                                <h5 class="font-weight-light pb-2 mb-1 border-bottom">
                                                    <?php
                                                    include "common/conn.php";
                                                    if ($conn) {
                                                        // Prepare the SQL query to sum taken leaves
                                                        $sqlTakenLeave = "SELECT SUM(leave_duration) AS taken_leave FROM emp_leave WHERE em_id = '$emp_id' AND leave_status = 1";

                                                        // Execute the query
                                                        $resultTakenLeave = $conn->query($sqlTakenLeave);
                                                        if ($resultTakenLeave) {
                                                            if ($resultTakenLeave->num_rows > 0) {
                                                                $rowTakenLeave = $resultTakenLeave->fetch_assoc();
                                                                $takenLeave = $rowTakenLeave["taken_leave"] ?? 0;
                                                            } else {
                                                                $takenLeave = 0;
                                                            }
                                                            echo $takenLeave;
                                                        } else {
                                                            echo "Error executing query: " . $conn->error;
                                                        }
                                                        mysqli_close($conn);
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?>
                                                </h5>
                                                <p class="tx-12 text-muted">
                                                    <?php
                                                    include "common/conn.php"; // Include the database connection file
                                                    
                                                    if ($conn) {
                                                        // Query to sum total leaves from leave_types table
                                                        $sqlTotalLeave = "SELECT SUM(leave_day) AS total_leave FROM leave_types";
                                                        $resultTotalLeave = $conn->query($sqlTotalLeave);

                                                        if ($resultTotalLeave) {
                                                            $rowTotalLeave = $resultTotalLeave->fetch_assoc();
                                                            $totalLeave = $rowTotalLeave["total_leave"] ?? 0; // Use total_leave as per alias in the query
                                                    
                                                            // Query to sum taken leaves for the specific employee
                                                            $sqlTakenLeave = "SELECT SUM(leave_duration) AS taken_leave FROM emp_leave WHERE em_id = '$emp_id' AND leave_status = 1";
                                                            $resultTakenLeave = $conn->query($sqlTakenLeave);

                                                            if ($resultTakenLeave) {
                                                                $rowTakenLeave = $resultTakenLeave->fetch_assoc();
                                                                $takenLeave = $rowTakenLeave["taken_leave"] ?? 0;

                                                                // Calculate remaining leaves
                                                                $remaining = $totalLeave - $takenLeave;
                                                                // echo $remaining;
                                                                echo "Rest Leave:$remaining";
                                                            } else {
                                                                echo "Error executing query for taken leaves: " . $conn->error;
                                                            }
                                                        } else {
                                                            echo "Error executing query for total leaves: " . $conn->error;
                                                        }

                                                        // Close the database connection
                                                        mysqli_close($conn);
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?>

                                                </p>
                                                <div class="card-icon-wrapper">
                                                    <i class="material-icons"><i class="fa fa-briefcase text-white fs-2"
                                                            aria-hidden="true">

                                                        </i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                                        <div class="mdc-card info-card info-card--primary">
                                            <div class="card-inner">
                                                <h5 class="card-title">Total Hour</h5>
                                                <h5 class="font-weight-light pb-2 mb-1 border-bottom">
                                                    <?php
                                                    include "common/conn.php";
                                                    $currentDate = new DateTime();

                                                    // Modify the date to go back one month
                                                    $currentDate->modify('-1 month');

                                                    // Get previous month and year
                                                    $previousMonth = $currentDate->format('m'); // Format as '01' to '12'
                                                    $previousYear = $currentDate->format('Y');  // Format as 'YYYY'
                                                    
                                                    if ($conn) {
                                                        $query = "SELECT working_hour FROM attadence_report where month = '$previousMonth-$previousYear'"; // Fetch the last balance
                                                        $result = mysqli_query($conn, $query);
                                                        if ($result) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            $workingHour = $row['working_hour'] ?? 0;

                                                            // Display the working hour
                                                            echo number_format($workingHour); // Format with 2 decimal places and thousands separator
                                                        } else {
                                                            echo "Error executing query: " . mysqli_error($conn);
                                                        }
                                                        mysqli_close($conn);
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?>
                                                </h5>
                                                <p class="tx-12 text-muted">
                                                    <?php
                                                    include "common/conn.php";
                                                    $currentDate = new DateTime();
                                                    // Modify the date to go back one month
                                                    $currentDate->modify('-1 month');
                                                    // Get previous month and year
                                                    $previousMonth = $currentDate->format('m'); // Format as '01' to '12'
                                                    $previousYear = $currentDate->format('Y');  // Format as 'YYYY'
                                                    if ($conn) {
                                                        $query = "SELECT payable_hour FROM attadence_report WHERE emp_id = '$emp_id' AND month = '$previousMonth-$previousYear'"; // Fetch the last balance
                                                        $result = mysqli_query($conn, $query);
                                                        if ($result) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            $payable_hour = $row['payable_hour'] ?? 0;
                                                            echo "Payable Hour:$payable_hour";
                                                        } else {
                                                            echo "Error executing query: " . mysqli_error($conn);
                                                        }
                                                        mysqli_close($conn);
                                                    } else {
                                                        echo "Error connecting to the database: " . mysqli_connect_error();
                                                    }
                                                    ?>
                                                </p>
                                                <div class="card-icon-wrapper">
                                                    <i class="material-icons"><i
                                                            class="fa fa-line-chart text-white fs-2"
                                                            aria-hidden="true"></i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                        </footer>
                    </div>
                    <!-- <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl</th>
                                        <th class="text-center">Lead Name</th>
                                        <th class="text-center">Phone Number</th>
                                        <th class="text-center">City & State</th>
                                        <th class="text-center">Company Name</th>
                                        <th class="text-center">Next Follow-Up Date</th>
                                        <th class="text-center">Desc</th>
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
                                                <td><?php echo $slno; ?></td>
                                                <td><?php echo $row["lead_name"]; ?></td>
                                                <td><?php echo $row["phone_no1"]; ?></td>
                                                <td>
                                                    <?php
                                                    echo (!empty($row["city"]) && !empty($row["state"]))
                                                        ? $row["city"] . ', ' . $row["state"]
                                                        : $row["city"] . $row["state"];
                                                    ?>
                                                </td>
                                                <td><?php echo $row["lastfollowupdate"]; ?></td>
                                                <td><?php echo $row["nextfollowupdate"]; ?></td>
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
                    </div> -->
                    <div class="row">
                        <div class="col-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <h3>New Leads</h3>
                                        <div class="col-12">
                                            <table id="example23"
                                                class="display nowrap table table-hover table-striped table-bordered"
                                                cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Lead Name</th>
                                                        <th class="text-center">Company Name</th>
                                                        <th class="text-center">Country</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include "common/conn.php";
                                                    $sql = "SELECT * FROM leads WHERE lastfollowupdate IS NULL AND nextfollowupdate IS NULL";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            ?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $row["lead_name"]; ?></td>
                                                                <td class="text-center"><?php echo $row["companyname"]; ?></td>
                                                                <td class="text-center"><?php echo $row["country"]; ?></td>
                                                            </tr>
                                                            <?php
                                                            $slno++;
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='15'>0 results</td></tr>";
                                                    }
                                                    $conn->close();
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Follow-up Date</h3>
                                    <table id="example23"
                                        class="display nowrap table table-hover table-striped table-bordered"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Message</th>
                                                <th class="text-center">Next Follow-up Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include "common/conn.php";
                                            $sql1 = "SELECT * FROM leads";
                                            $result1 = $conn->query($sql1);
                                            if ($result1->num_rows > 0) {
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    $id = $row1['id'];
                                                    $sql2 = "SELECT * FROM lead_follow WHERE lead_id = $id AND next_date < CURDATE()";
                                                    $result2 = $conn->query($sql2);
                                                    if ($result2->num_rows > 0) {
                                                        while ($row2 = $result2->fetch_assoc()) {
                                                            ?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $row2["message"]; ?></td>
                                                                <td class="text-center"><?php echo $row1["nextfollowupdate"]; ?></td>
                                                            </tr>
                                                            <?php
                                                            $slno++;
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='15'>0 results</td></tr>";
                                                    }
                                                }
                                            }
                                            $conn->close();
                                            ?>
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
        <!-- start body content -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/js/font-awesome.min.js"></script>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/chartjs/Chart.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/chartjs.js"></script>
    <script src="assets/js/material.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- for ajax update -->
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
                        url: 'insert.php',
                        type: 'post',
                        data: {
                            field: field_name,
                            value: value,
                            id: edit_id,
                            tbnm: table_name
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

</html>