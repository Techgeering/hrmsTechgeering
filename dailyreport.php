<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Daily Report - Hrms Techgeering</title>
    <link rel="icon" type="image/png" href="assets/img/favicon-t.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- start Top Navbar -->
    <?php include 'common/topnav.php' ?>
    <?php
    include "common/conn.php";
    $sql10 = "SELECT * FROM employee WHERE id=$userid";
    $result10 = $conn->query($sql10);
    if ($result10->num_rows > 0) {
        $row10 = $result10->fetch_assoc();
        $name = $row10["full_name"];
        $dept = $row["dep_id"];
        $em_code = $row["em_code"];
    }
    ?>
    <!-- end Top Navbar -->
    <div id="layoutSidenav">
        <!-- start Side Navbar -->
        <?php include 'common/sidenav.php' ?>
        <!-- end Side Navbar -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="my-2">Daily Report</h2>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                            <i class="fa-solid fa-plus"></i> Daily Report
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="btn-group mb-3">
                                <button type="button" class="btn btn-primary" id="weeklyBtn">Weekly</button>
                                <button type="button" class="btn btn-secondary" id="monthlyBtn">Monthly</button>
                                <button type="button" class="btn btn-success" id="quarterlyBtn">Quarterly</button>
                            </div>
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Emp Name</th>
                                        <th>Date</th>
                                        <th>Project Name</th>
                                        <th>Details Of Work</th>
                                        <th>Duration</th>
                                        <th>Edit</th>
                                        <th>Pdf</th>
                                    </tr>
                                </thead>
                                <tbody id="reportTableBody">
                                    <?php
                                    include "common/conn.php";
                                    if ($em_role == '4' || $em_role == '2' || $em_role == '5') {
                                        // $sql = "SELECT * FROM daily_report ORDER BY date21 DESC WHERE emp_id = '$userid'";
                                        $sql = "SELECT * FROM daily_report WHERE emp_id = '$em_code' ORDER BY date21 DESC";
                                    } else {
                                        $sql = "SELECT * FROM daily_report ORDER BY date21 DESC";
                                    }
                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    $today = date('Y-m-d');
                                    $yesterday = date('Y-m-d', strtotime('-1 day'));

                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row['id'];
                                            ?>
                                            <tr>
                                                <td><?php echo $slno; ?></td>
                                                <td>
                                                    <?php
                                                    $emp_id = $row["emp_id"];
                                                    $sql1 = "SELECT * FROM employee WHERE em_code = '$emp_id'";
                                                    $result1 = $conn->query($sql1);
                                                    $row1 = $result1->fetch_assoc();
                                                    echo htmlspecialchars($row1["full_name"], ENT_QUOTES, 'UTF-8');
                                                    ?>
                                                </td>
                                                <td><?php echo $row["date21"]; ?></td>
                                                <td>
                                                    <?php
                                                    $pro_id = $row["pro_id"];
                                                    $sql12 = "SELECT * FROM project WHERE id = $pro_id";
                                                    $result12 = $conn->query($sql12);
                                                    $row12 = $result12->fetch_assoc();
                                                    echo htmlspecialchars($row12["pro_name"], ENT_QUOTES, 'UTF-8');
                                                    ?>
                                                </td>
                                                <td>
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#paragraphmodal_<?php echo $id; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                                <td><?php echo $row["duration"]; ?></td>
                                                <td>
                                                    <?php
                                                    if ($row["date21"] == $today || $row["date21"] == $yesterday) {
                                                        echo '<button type="button" class="btn btn-light"
                                                            onclick="myfcn12(' . $row['id'] . ', \'' . $row['pro_id'] . '\', \'' . $row['work_details'] . '\', \'' . $row['duration'] . '\', \'' . $row['date21'] . '\')"
                                                            data-bs-toggle="modal" data-bs-target="#updateDept">
                                                            <i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i>
                                                        </button>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="dayinvoice.php?id=<?php echo $row["emp_id"]; ?>&&date=<?php echo $row["date21"]; ?>"
                                                        target="_blank">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="paragraphmodal_<?php echo $id; ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-success text-white">
                                                            <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php echo $row["work_details"]; ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $slno++;
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    $conn->close();
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Emp Id</th>
                                        <th>Date</th>
                                        <th>Project Name</th>
                                        <th>Details Of Work</th>
                                        <th>Duration</th>
                                        <th>Edit</th>
                                    </tr>
                                </tfoot>
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
                    <h1 class="modal-title fs-5" id="addDeptLabel">Daily Report</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="datee" class="form-label">Date</label>
                                <input type="date" class="form-control" id="datee" name="datee1">
                            </div>
                            <div id="form-container">
                                <div class="product-group">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="Project_Name" class="form-label">Project Name</label>
                                                <select class="form-select" name="project_name[]">
                                                    <option value="" disabled selected>Select a Project</option>
                                                    <option value="other">Other</option>
                                                    <?php
                                                    include "common/conn.php";
                                                    $sql_pro = "SELECT * FROM project";
                                                    $result_pro = $conn->query($sql_pro);
                                                    while ($row_pro = $result_pro->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?php echo $row_pro['id']; ?>">
                                                            <?php echo $row_pro['pro_name']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="DepartmentName">Work Details</label>
                                            <textarea class="form-control" id="workk" name="workk1[]"
                                                rows="4"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="duration">Duration (HH:MM)</label>
                                            <input type="text" class="form-control duration-input" name="duration[]"
                                                pattern="^([0-9]|[01][0-9]|2[0-3]):([0-5][0-9])$" required>
                                            <small class="form-text text-muted">Format: HH:MM (e.g., 02:30 for 2 hours
                                                and
                                                30 minutes)</small>
                                            <div class="error-message" style="color: red; display: none;">The total
                                                duration
                                                cannot exceed 8 hours (480 minutes).</div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-danger remove-product">-</button>
                                        <button type="button" class="btn btn-success add-product">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    include "common/conn.php";
    if (isset($_POST['submit'])) {
        $employee_names = $_POST['employee_name'];
        $datee1s = $_POST["datee1"];
        $project_names = $_POST["project_name"];
        $workks = $_POST["workk1"];
        $durations = $_POST["duration"];
        $em_codes = $em_code;
        foreach ($project_names as $index => $project_name) {
            $employee_name = $employee_names;
            $datee1 = $datee1s;
            $em_code = $em_codes;

            $workk = mysqli_real_escape_string($conn, $workks[$index]);
            $duration = mysqli_real_escape_string($conn, $durations[$index]);

            $sql_pur = "INSERT INTO daily_report (emp_id, date21, pro_id, work_details, duration) 
                VALUES ('$em_code','$datee1','$project_name','$workk','$duration')";
            if ($conn->query($sql_pur) === TRUE) {
                header("Location: dailyreport.php");
            } else {
                echo "Error: " . $sql_pur . "<br>" . $conn->error;
            }
        }
        $conn->close();
    }
    ?>
    <!-- update modal -->
    <div class="modal fade" id="updateDept" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Update Department</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <input type="hidden" name="id12" id="id12">
                        <input type="hidden" name="datet" id="datet">
                        <div class="col-12">
                            <div class="mb-2">
                                <label for="Project_Name" class="form-label">Project Name</label>
                                <select class="form-select" name="project_name" id="pro_nm">
                                    <option value="" disabled selected>Select a Project</option>
                                    <?php
                                    include "common/conn.php";
                                    $sql_pro = "SELECT * FROM project";
                                    $result_pro = $conn->query($sql_pro);
                                    while ($row_pro = $result_pro->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row_pro['id']; ?>">
                                            <?php echo $row_pro['pro_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="DepartmentName">Work Details</label>
                                <textarea class="form-control" id="workk_details" name="workk1" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="duration">Duration (HH:MM)</label>
                                <input type="text" class="form-control duration-input" name="duration"
                                    id="clock_duration" pattern="^([0-9]|[01][0-9]|2[0-3]):([0-5][0-9])$" required>
                                <small class="form-text text-muted">Format: HH:MM (e.g., 02:30 for 2 hours
                                    and
                                    30 minutes)</small>
                                <div class="error-message" style="color: red; display: none;">The total
                                    duration
                                    cannot exceed 8 hours (480 minutes).</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="updatedepartment">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['updatedepartment'])) {
        include "common/conn.php";
        $project_name = htmlspecialchars($_POST["project_name"]);
        $workk1 = htmlspecialchars($_POST["workk1"]);
        $duration = $_POST["duration"];
        $datew = $_POST["datet"];
        $id = $_POST["id12"];
        if ($duration < 0) {
            echo "<script>alert('Duration must be a positive number.');</script>";
            exit;
        }
        $sql_total_hours = "SELECT SUM(duration) AS total_hours FROM daily_report WHERE emp_id='$em_code' AND date21='$datew'";
        $result_hours = $conn->query($sql_total_hours);

        if ($result_hours && $row = $result_hours->fetch_assoc()) {
            $total_hours = $row['total_hours'] ? $row['total_hours'] : 0;
            $sql_current_duration = "SELECT duration FROM daily_report WHERE id='$id'";
            $result_current = $conn->query($sql_current_duration);
            $current_duration = 0;

            if ($result_current && $row_current = $result_current->fetch_assoc()) {
                $current_duration = $row_current['duration'];
            }
            $new_total_hours = $total_hours - $current_duration + $duration;
            if ($new_total_hours > 8) {
                echo "<script>alert('Cannot log more than 8 hours for this date. Total hours logged: $new_total_hours hours.');</script>";
            } else {
                $sql1 = "UPDATE daily_report SET pro_id='$project_name', work_details='$workk1', duration='$duration' WHERE id='$id'";
                if ($conn->query($sql1) === true) {
                    echo "<script>alert('Update successful');</script>";
                } else {
                    echo "Error: " . $conn->error;
                }
            }
        } else {
            echo "<script>alert('Error fetching total hours.');</script>";
        }

        $conn->close();
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            // Clone product form group
            $(document).on('click', '.add-product', function () {
                console.log('Add button clicked'); // Debugging message
                var productGroup = $('.product-group').first().clone(); // Clone the first group
                productGroup.find('input').val(''); // Clear input values in the cloned group
                productGroup.find('textarea').val(''); // Clear textarea values in the cloned group
                productGroup.find('select').prop('selectedIndex', 0); // Reset dropdowns
                $('#form-container').append(productGroup); // Append cloned group to the form container
                console.log('Product group added'); // Debugging message
            });

            // Remove product form group
            $(document).on('click', '.remove-product', function () {
                if ($('.product-group').length > 1) {
                    $(this).closest('.product-group').remove(); // Remove the closest product group
                    console.log('Product group removed'); // Debugging message
                } else {
                    alert('At least one data must remain.');
                }
            });
        });
    </script>

    <script>
        function parseDuration(duration) {
            const parts = duration.split(':');
            return parseInt(parts[0], 10) * 60 + parseInt(parts[1], 10); // Convert to total minutes
        }
        function totalDurationExceeded() {
            const durationInputs = document.querySelectorAll('.duration-input');
            let totalMinutes = 0;

            durationInputs.forEach(input => {
                if (input.value) {
                    totalMinutes += parseDuration(input.value);
                }
            });
            return totalMinutes > 480; // 480 minutes equals 8 hours
        }
        document.addEventListener('input', function () {
            const errorMessage = document.querySelector('.error-message');
            if (totalDurationExceeded()) {
                errorMessage.style.display = 'block'; // Show error message
            } else {
                errorMessage.style.display = 'none'; // Hide error message
            }
        });
    </script>

</body>

</html>